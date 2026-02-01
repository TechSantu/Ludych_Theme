<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_page_url = home_url( '/contact-us/' );
?>

<section class="ready-to-ship">
	<div class="custom-container">
		<div class="intro-text">
			<h6>Ready to Ship Something Real?</h6>
			<h2>From discovery to deploy, we build platforms that scale. No junior devs, no scope creep, just working software.</h2>
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
