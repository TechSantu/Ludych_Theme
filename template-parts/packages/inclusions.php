<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$inclusions = $acf_ready ? get_field( 'packages_inclusions', $post_id ) : array();

if ( empty( $inclusions ) ) {
	$inclusions = array(
		array( 'text' => 'Setup & Onboarding', 'color' => 'green', 'icon' => 'fa-play' ),
		array( 'text' => '24/7 Support', 'color' => 'yellow', 'icon' => 'fa-headset' ),
		array( 'text' => 'No Setup Fees', 'color' => 'orange', 'icon' => 'fa-ban' ),
		array( 'text' => '30-Day Guarantee', 'color' => 'dark-orange', 'icon' => 'fa-shield-alt' ),
	);
}
?>

<section class="section-inclusions">
	<div class="custom-container text-center">
		<div class="inclusions-card">
			<h2 class="font-inria">All Plans Include</h2>
			<div class="inclusions-grid">
				<?php foreach ( $inclusions as $inc ) : ?>
				<div class="inclusion-item">
					<div class="inclusion-icon <?php echo esc_attr( $inc['color'] ?? 'green' ); ?>">
						<i class="fas <?php echo esc_attr( $inc['icon'] ?? 'fa-check' ); ?> text-white"></i>
					</div>
					<span><?php echo esc_html( $inc['text'] ); ?></span>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<p class="inclusion-footer-text">Ready to get started? Choose a package above or contact us for a custom marketing solution.</p>
		<button class="btn-black-large" onclick="window.location.href='<?php echo home_url('/contact-us/'); ?>'">Get Started Today</button>
	</div>
</section>
