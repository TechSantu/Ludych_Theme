<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$comparison_title = $acf_ready ? get_field( 'packages_comparison_title', $post_id ) : 'Not sure which one fits?';
$comparison_description = $acf_ready ? get_field( 'packages_comparison_description', $post_id ) : 'Prices vary depending on deliverables, goals, and scope. Every business is unique, and so are our solutions.';
$comparison_cta_text = $acf_ready ? get_field( 'packages_comparison_cta_text', $post_id ) : 'We offer free digital marketing consultations followed by detailed quotations.';
$comparison_button_text = $acf_ready ? get_field( 'packages_comparison_button_text', $post_id ) : 'Request Detailed Quote';
$comparison_button_url = $acf_ready ? get_field( 'packages_comparison_button_url', $post_id ) : home_url('/contact-us/');

$pricing_tiers = $acf_ready ? get_field( 'packages_pricing_tiers', $post_id ) : array();

if ( empty( $pricing_tiers ) ) {
	$pricing_tiers = array(
		array(
			'name' => 'Starter Growth',
			'range' => '$800 – $1,500 / mo'
		),
		array(
			'name' => 'Advanced Performance',
			'range' => '$1,800 – $3,500 / mo'
		),
		array(
			'name' => 'Enterprise Brand Booster',
			'range' => '$4,500 – $10,000+ / mo'
		)
	);
}
?>

<section class="pricing-comparison-lp py-5">
	<div class="custom-container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="comparison-teaser text-center mb-5">
					<h5 class="fw-bold mb-3"><?php echo esc_html( $comparison_title ); ?></h5>
					<p class="text-muted"><?php echo esc_html( $comparison_description ); ?></p>
				</div>
				
				<div class="pricing-tier-summary p-4 bg-white rounded-4 shadow-sm border">
					<?php 
					$tier_count = count( $pricing_tiers );
					foreach ( $pricing_tiers as $index => $tier ) : 
						$is_last = ( $index === $tier_count - 1 );
					?>
						<div class="row align-items-center <?php echo !$is_last ? 'mb-3 pb-3 border-bottom' : ''; ?> g-3">
							<div class="col-6 col-md-5">
								<span class="fw-bold text-dark"><?php echo esc_html( $tier['name'] ?? '' ); ?></span>
							</div>
							<div class="col-6 col-md-7 text-end">
								<span class="pricing-range py-1 px-3 bg-light rounded-pill"><?php echo esc_html( $tier['range'] ?? '' ); ?></span>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				
				<div class="text-center mt-5">
					<p class="text-muted mb-4"><?php echo esc_html( $comparison_cta_text ); ?></p>
					<a href="<?php echo esc_url( $comparison_button_url ); ?>" class="globalBtnDark">
						<span><?php echo esc_html( $comparison_button_text ); ?></span> 
						<i class="fa-solid fa-arrow-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
