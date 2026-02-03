<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_page_url = get_field( 'cta_button_link', $post_id );
if ( ! $contact_page_url ) {
	$contact_page_url = home_url( '/contact-us/' );
}

$cta_heading = get_field( 'cta_heading', $post_id );
if ( ! $cta_heading ) {
	$cta_heading = 'Ready to Ship Something Real?';
}

$cta_desc = get_field( 'cta_description', $post_id );
if ( ! $cta_desc ) {
	$cta_desc = 'From discovery to deploy, we build platforms that scale. No junior devs, no scope creep, just working software.';
}
?>

<section class="ready-to-ship">
	<div class="custom-container">
		<div class="intro-text">
			<h6><?php echo esc_html( $cta_heading ); ?></h6>
			<h2><?php echo esc_html( $cta_desc ); ?></h2>
		</div>
		
		<div class="schedule-call">
			<a href="<?php echo esc_url( $contact_page_url ); ?>" class="schedule-call-btn">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/grey-arrow-up-right.svg" alt="" />
			</a>
			
			<div class="schedule-call-text">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/ctablack-curve-text.svg" alt="" />
			</div>
		</div>
	</div>
</section>
