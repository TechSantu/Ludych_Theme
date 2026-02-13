<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$cta_title       = ( $acf_ready ? get_field( 'packages_cta_title', $post_id ) : '' ) ?: 'Still Have Questions?';
$cta_description = ( $acf_ready ? get_field( 'packages_cta_description', $post_id ) : '' ) ?: 'Our marketing experts are here to help. Schedule a free consultation to discuss your specific needs and get personalized recommendations.';
$cta_btn_text    = ( $acf_ready ? get_field( 'packages_cta_button_text', $post_id ) : '' ) ?: 'Schedule Free Consultation';
$cta_btn_url     = ( $acf_ready ? get_field( 'packages_cta_button_url', $post_id ) : '' ) ?: home_url('/contact-us/');
?>
<section class="section-gradient-cta">
	<div class="gradient-banner">
		<h2 class="font-inria"><?php echo esc_html( $cta_title ); ?></h2>
		<p><?php echo esc_html( $cta_description ); ?></p>
		<a class="globalBtnDark" href="<?php echo esc_url( $cta_btn_url ); ?>">
			<span><?php echo esc_html( $cta_btn_text ); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
		</a>
	</div>
</section>
