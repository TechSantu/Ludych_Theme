<?php
/**
 * Contact Form AJAX Handler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_handle_contact_form() {
	// Security check
	check_ajax_referer( 'ludych_contact_nonce', 'nonce' );

	$name     = sanitize_text_field( $_POST['name'] ?? '' );
	$email    = sanitize_email( $_POST['email'] ?? '' );
	$phone    = sanitize_text_field( $_POST['phone'] ?? '' );
	$company  = sanitize_text_field( $_POST['company'] ?? '' );
	$message  = sanitize_textarea_field( $_POST['message'] ?? '' );
	$page_url = esc_url_raw( $_POST['page_url'] ?? '' );

	if ( empty( $name ) || ! is_email( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid name, email, and message.', 'ludych-theme' ) ) );
	}

	if ( ! empty( $phone ) && ! preg_match( '/^[0-9+() \-]{7,20}$/', $phone ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid phone number.', 'ludych-theme' ) ) );
	}

	$ip_address = $_SERVER['REMOTE_ADDR'];
	$date_time  = current_time( 'mysql' );

	// 1. Record in Database (CPT)
	$post_id = wp_insert_post( array(
		'post_type'    => 'form_submission',
		'post_title'   => sprintf( 'Submission from %s - %s', $name, $date_time ),
		'post_content' => $message,
		'post_status'  => 'publish',
	) );

	if ( $post_id ) {
		update_post_meta( $post_id, '_submission_email', $email );
		update_post_meta( $post_id, '_submission_phone', $phone );
		update_post_meta( $post_id, '_submission_company', $company );
		update_post_meta( $post_id, '_submission_ip', $ip_address );
		update_post_meta( $post_id, '_submission_page_url', $page_url );
		update_post_meta( $post_id, '_submission_date', $date_time );
	}

	// 2. Send Email
	$admin_email  = get_option( 'admin_email' );
	$custom_email = get_theme_mod( 'ludych_contact_notification_email', $admin_email );

	$subject = sprintf( '[%s] New Contact Form Submission', get_bloginfo( 'name' ) );

	// Branded HTML Email Template
	$body = '
	<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px;">
		<div style="text-align: center; margin-bottom: 30px;">
			<h2 style="color: #3d72fb; margin: 0;">New Inquiry Received</h2>
			<p style="color: #666; font-size: 14px;">Submission details from your website.</p>
		</div>
		<table style="width: 100%; border-collapse: collapse;">
			<tr>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; width: 30%; color: #888;">Name:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; font-weight: bold;">' . esc_html( $name ) . '</td>
			</tr>
			<tr>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; color: #888;">Email:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0;">' . esc_html( $email ) . '</td>
			</tr>
			<tr>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; color: #888;">Phone:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0;">' . esc_html( $phone ) . '</td>
			</tr>
			<tr>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; color: #888;">Company:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0;">' . esc_html( $company ) . '</td>
			</tr>
			<tr>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; vertical-align: top; color: #888;">Message:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; line-height: 1.6;">' . nl2br( esc_html( $message ) ) . '</td>
			</tr>
		</table>
		<div style="margin-top: 30px; font-size: 12px; color: #999; line-height: 1.5;">
			<p><strong>Submitted on:</strong> ' . esc_html( $date_time ) . '</p>
			<p><strong>Page Source:</strong> ' . esc_url( $page_url ) . '</p>
			<p><strong>IP Address:</strong> ' . esc_html( $ip_address ) . '</p>
		</div>
	</div>';

	$headers = array( 'Content-Type: text/html; charset=UTF-8', "Reply-To: $name <$email>" );

	wp_mail( $custom_email, $subject, $body, $headers );

	// 3. Response
	$redirect_url = get_theme_mod( 'ludych_contact_redirect_url', home_url( '/thank-you' ) );

	wp_send_json_success( array(
		'message'      => __( 'Your message has been sent successfully.', 'ludych-theme' ),
		'redirect_url' => $redirect_url,
	) );
}

add_action( 'wp_ajax_ludych_contact_form', 'ludych_handle_contact_form' );
add_action( 'wp_ajax_nopriv_ludych_contact_form', 'ludych_handle_contact_form' );
