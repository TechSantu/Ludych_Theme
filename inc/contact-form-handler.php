<?php
/**
 * Contact Form AJAX Handler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_handle_contact_form() {
	// Security check
	// check_ajax_referer( 'ludych_contact_nonce', 'nonce' );

	$name    = sanitize_text_field( $_POST['name'] ?? '' );
	$email   = sanitize_email( $_POST['email'] ?? '' );
	$phone   = sanitize_text_field( $_POST['phone'] ?? '' );
	$company = sanitize_text_field( $_POST['company'] ?? '' );
	$message = sanitize_textarea_field( $_POST['message'] ?? '' );
	$page_url = esc_url_raw( $_POST['page_url'] ?? '' );

	if ( empty( $name ) || ! is_email( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'Please provide a valid name, email, and message.', 'ludych-theme' ) ) );
	}

	if ( ! empty( $phone ) && ! preg_match( '/^[\d\s+\-()]{7,20}$/', $phone ) ) {
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
	$admin_email = get_option( 'admin_email' );
	$custom_email = get_theme_mod( 'ludych_contact_notification_email', $admin_email );
	
	$subject = sprintf( '[%s] New Contact Form Submission', get_bloginfo( 'name' ) );
	$body    = "Name: $name\n";
	$body   .= "Email: $email\n";
	$body   .= "Phone: $phone\n";
	$body   .= "Company: $company\n\n";
	$body   .= "Message:\n$message\n\n";
	$body   .= "-------------------------\n";
	$body   .= "Submitted on: $date_time\n";
	$body   .= "Page: $page_url\n";
	$body   .= "IP Address: $ip_address\n";

	$headers = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: $name <$email>" );

	wp_mail( $custom_email, $subject, $body, $headers );

	// 3. Response
	$redirect_url = get_theme_mod( 'ludych_contact_redirect_url', home_url( '/thank-you' ) );
	
	wp_send_json_success( array( 
		'message'      => __( 'Your message has been sent successfully.', 'ludych-theme' ),
		'redirect_url' => $redirect_url 
	) );
}

add_action( 'wp_ajax_ludych_contact_form', 'ludych_handle_contact_form' );
add_action( 'wp_ajax_nopriv_ludych_contact_form', 'ludych_handle_contact_form' );
