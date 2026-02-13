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

	$name             = sanitize_text_field( $_POST['name'] ?? '' );
	$first_name       = sanitize_text_field( $_POST['first_name'] ?? '' );
	$last_name        = sanitize_text_field( $_POST['last_name'] ?? '' );
	$email            = sanitize_email( $_POST['email'] ?? '' );
	$phone            = sanitize_text_field( $_POST['phone'] ?? '' );
	$company          = sanitize_text_field( $_POST['company'] ?? '' );
	$service          = sanitize_text_field( $_POST['service'] ?? '' );
	$message          = sanitize_textarea_field( $_POST['message'] ?? '' );
	$page_url         = esc_url_raw( $_POST['page_url'] ?? '' );
	$recaptcha_token  = sanitize_text_field( $_POST['recaptcha_token'] ?? '' );
	$recaptcha_action = sanitize_text_field( $_POST['recaptcha_action'] ?? '' );
	$redirect_url     = esc_url_raw( $_POST['redirect_url'] ?? '' );

	$full_name = trim( $name );
	if ( empty( $full_name ) ) {
		$full_name = trim( $first_name . ' ' . $last_name );
	}

	if ( strlen( $full_name ) < 2 || strlen( $full_name ) > 100 ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid name (2-100 characters).', 'ludych-theme' ) ) );
	}

	if ( isset( $_POST['first_name'] ) && strlen( trim( $first_name ) ) < 2 ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid first name.', 'ludych-theme' ) ) );
	}

	if ( ! empty( $last_name ) && strlen( trim( $last_name ) ) < 2 ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid last name.', 'ludych-theme' ) ) );
	}

	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid email address.', 'ludych-theme' ) ) );
	}

	if ( strlen( trim( $message ) ) < 10 ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a message with at least 10 characters.', 'ludych-theme' ) ) );
	}

	if ( ! empty( $company ) && strlen( trim( $company ) ) < 2 ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid company name.', 'ludych-theme' ) ) );
	}

	if ( ! empty( $phone ) && ! preg_match( '/^[0-9+() \-]{7,20}$/', $phone ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid phone number.', 'ludych-theme' ) ) );
	}

	$ip_address = $_SERVER['REMOTE_ADDR'];
	$date_time  = current_time( 'mysql' );

	$recaptcha_enabled         = (bool) get_theme_mod( 'ludych_recaptcha_enabled', false );
	$recaptcha_site_key        = get_theme_mod( 'ludych_recaptcha_site_key', '' );
	$recaptcha_secret_key      = get_theme_mod( 'ludych_recaptcha_secret_key', '' );
	$recaptcha_threshold       = floatval( get_theme_mod( 'ludych_recaptcha_score_threshold', 0.5 ) );
	$recaptcha_action_expected = 'contact_form';

	if ( $recaptcha_enabled && $recaptcha_site_key && $recaptcha_secret_key ) {
		if ( empty( $recaptcha_token ) ) {
			wp_send_json_error( array( 'message' => __( 'reCAPTCHA verification failed. Please try again.', 'ludych-theme' ) ) );
		}

		$verify_response = wp_remote_post(
			'https://www.google.com/recaptcha/api/siteverify',
			array(
				'timeout' => 10,
				'body'    => array(
					'secret'   => $recaptcha_secret_key,
					'response' => $recaptcha_token,
					'remoteip' => $ip_address,
				),
			)
		);

		if ( is_wp_error( $verify_response ) ) {
			wp_send_json_error( array( 'message' => __( 'reCAPTCHA service error. Please try again later.', 'ludych-theme' ) ) );
		}

		$verify_body = wp_remote_retrieve_body( $verify_response );
		$verify_data = json_decode( $verify_body, true );
		$score       = isset( $verify_data['score'] ) ? floatval( $verify_data['score'] ) : 0.0;
		$action      = isset( $verify_data['action'] ) ? sanitize_text_field( $verify_data['action'] ) : '';

		if ( empty( $verify_data['success'] ) ) {
			wp_send_json_error( array( 'message' => __( 'reCAPTCHA verification failed. Please try again.', 'ludych-theme' ) ) );
		}

		if ( $recaptcha_action && $recaptcha_action_expected !== $action ) {
			wp_send_json_error( array( 'message' => __( 'reCAPTCHA action mismatch. Please try again.', 'ludych-theme' ) ) );
		}

		if ( $score < $recaptcha_threshold ) {
			wp_send_json_error( array( 'message' => __( 'reCAPTCHA score too low. Please try again.', 'ludych-theme' ) ) );
		}
	}

	// 1. Record in Database (CPT)
	$post_id = wp_insert_post( array(
		'post_type'    => 'form_submission',
		'post_title'   => sprintf( 'Submission from %s - %s', $full_name, $date_time ),
		'post_content' => $message,
		'post_status'  => 'publish',
	), true );

	if ( is_wp_error( $post_id ) || 0 === $post_id ) {
		wp_send_json_error( array( 'message' => __( 'Unable to save your submission. Please try again later.', 'ludych-theme' ) ) );
	}

	update_post_meta( $post_id, '_submission_email', $email );
	update_post_meta( $post_id, '_submission_phone', $phone );
	update_post_meta( $post_id, '_submission_company', $company );
	update_post_meta( $post_id, '_submission_first_name', $first_name );
	update_post_meta( $post_id, '_submission_last_name', $last_name );
	update_post_meta( $post_id, '_submission_service', $service );
	update_post_meta( $post_id, '_submission_ip', $ip_address );
	update_post_meta( $post_id, '_submission_page_url', $page_url );
	update_post_meta( $post_id, '_submission_date', $date_time );

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
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; font-weight: bold;">' . esc_html( $full_name ) . '</td>
			</tr>
			<tr>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; color: #888;">First Name:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0;">' . esc_html( $first_name ) . '</td>
			</tr>
			<tr>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; color: #888;">Last Name:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0;">' . esc_html( $last_name ) . '</td>
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
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0; color: #888;">Service:</td>
				<td style="padding: 10px; border-bottom: 1px solid #f0f0f0;">' . esc_html( $service ) . '</td>
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

	$from_name  = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
	$from_email = is_email( $admin_email ) ? $admin_email : 'no-reply@' . wp_parse_url( home_url(), PHP_URL_HOST );
	$headers    = array(
		'Content-Type: text/html; charset=UTF-8',
		"From: {$from_name} <{$from_email}>",
		"Reply-To: {$full_name} <{$email}>",
	);

	$mail_sent = wp_mail( $custom_email, $subject, $body, $headers );
	if ( ! $mail_sent ) {
		wp_send_json_error( array( 'message' => __( 'Your message was saved, but the email notification failed. Please try again or contact us directly.', 'ludych-theme' ) ) );
	}

	// 3. Response
	$theme_redirect = get_theme_mod( 'ludych_contact_redirect_url', '' );
	$redirect_url   = $redirect_url ?: $theme_redirect;
	if ( empty( $redirect_url ) ) {
		$redirect_url = home_url( '/thank-you' );
	}

	wp_send_json_success( array(
		'message'      => __( 'Your message has been sent successfully.', 'ludych-theme' ),
		'redirect_url' => $redirect_url,
	) );
}

add_action( 'wp_ajax_ludych_contact_form', 'ludych_handle_contact_form' );
add_action( 'wp_ajax_nopriv_ludych_contact_form', 'ludych_handle_contact_form' );
