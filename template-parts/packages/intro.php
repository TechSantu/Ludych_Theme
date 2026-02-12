<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$intro_badge       = ( $acf_ready ? get_field( 'packages_intro_badge', $post_id ) : '' ) ?: 'Arizona\'s #1 Digital Agency';
$intro_title       = ( $acf_ready ? get_field( 'packages_intro_title', $post_id ) : '' ) ?: 'Empowering <span class="text-gradient">Local Businesses</span> with ROI-Driven Marketing';
$intro_description = ( $acf_ready ? get_field( 'packages_intro_description', $post_id ) : '' ) ?: 'Looking for top-notch digital marketing packages in Arizona? Look no further! We offer various affordable options at Ludych Technology Agency to suit every need and budget. Our packages start from as low as $800 per month, ensuring that even small and local businesses and bootstrapped startups can access quality digital marketing services.<br><br>Whether you\'re just starting out or running a well-established enterprise, we have the perfect package for you. Our comprehensive digital marketing services cover all the essentials to boost your online presence. From stunning web design and eCommerce development to expert Search Engine Optimization (SEO) strategies, Social Media Marketing (SMM), and Pay Per Click (PPC) online ads management, we\'ve got you covered.<br><br>Why choose us? Well, apart from our competitive prices, we bring a wealth of expertise and over five years of experience to the table. We\'ve successfully helped over 20+ companies establish their online presence and achieve impressive growth through our ROI-focused digital marketing strategies. Your success is our priority! To make things even better, we offer customizable packages tailored to your specific requirements. We understand that each business is unique, so we\'re here to listen to your needs and deliver a solution that perfectly aligns with your goals and objectives.';

$intro_image = $acf_ready ? get_field( 'packages_intro_image', $post_id ) : '';
if ( is_array( $intro_image ) ) {
	$intro_image = $intro_image['url'] ?? '';
}
$intro_image = $intro_image ?: get_template_directory_uri() . '/assets/images/about-left.jpg';

$stat_1_number = ( $acf_ready ? get_field( 'packages_stat_1_number', $post_id ) : '' ) ?: '5+';
$stat_1_label  = ( $acf_ready ? get_field( 'packages_stat_1_label', $post_id ) : '' ) ?: 'Years Experience';
$stat_2_number = ( $acf_ready ? get_field( 'packages_stat_2_number', $post_id ) : '' ) ?: '20+';
$stat_2_label  = ( $acf_ready ? get_field( 'packages_stat_2_label', $post_id ) : '' ) ?: 'Global Clients';

$badge_number = ( $acf_ready ? get_field( 'packages_badge_number', $post_id ) : '' ) ?: '+250%';
$badge_label  = ( $acf_ready ? get_field( 'packages_badge_label', $post_id ) : '' ) ?: 'Avg. Revenue Growth';
?>

<section class="packages-lp-intro py-5 overflow-hidden">
	<div class="custom-container">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<div class="lp-intro-badge mb-3">
					<span class="badge rounded-pill bg-soft-primary px-3 py-2 text-primary font-weight-bold"><?php echo esc_html( $intro_badge ); ?></span>
				</div>
				<h2 class="display-5 fw-bold mb-4"><?php echo wp_kses_post( $intro_title ); ?></h2>
				<p class="lead text-muted mb-4 text-justify"><?php echo wp_kses_post( $intro_description ); ?></p>
				
				<div class="lp-stats row g-4 mt-2">
					<div class="col-6">
						<div class="lp-stat-card p-3 border rounded-3 bg-white shadow-sm">
							<h3 class="fw-bold text-primary mb-1"><?php echo esc_html( $stat_1_number ); ?></h3>
							<p class="small text-muted mb-0"><?php echo esc_html( $stat_1_label ); ?></p>
						</div>
					</div>
					<div class="col-6">
						<div class="lp-stat-card p-3 border rounded-3 bg-white shadow-sm">
							<h3 class="fw-bold text-primary mb-1"><?php echo esc_html( $stat_2_number ); ?></h3>
							<p class="small text-muted mb-0"><?php echo esc_html( $stat_2_label ); ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 position-relative">
				<div class="lp-intro-image-wrap ps-lg-5">
					<div class="lp-main-img-bg"></div>
					<img src="<?php echo esc_url( $intro_image ); ?>" alt="Ludych Technology" class="img-fluid rounded-4 shadow-lg position-relative z-index-1">
					<div class="floating-badge shadow-lg rounded-3 p-3 bg-white position-absolute top-10 start-0 z-index-2 animate-bounce">
						<div class="d-flex align-items-center gap-3">
							<div class="badge-icon bg-success-soft p-2 rounded-circle">
								<i class="fas fa-chart-line text-success"></i>
							</div>
							<div>
								<h6 class="mb-0 fw-bold"><?php echo esc_html( $badge_number ); ?></h6>
								<p class="small text-muted mb-0"><?php echo esc_html( $badge_label ); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
