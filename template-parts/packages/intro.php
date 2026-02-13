<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$intro_badge       = ( $acf_ready ? get_field( 'packages_intro_badge', $post_id ) : '' ) ?: 'Arizona\'s #1 Digital Agency';
$intro_title       = ( $acf_ready ? get_field( 'packages_intro_title', $post_id ) : '' ) ?: 'Empowering <span class="text-gradient">Local Businesses</span> with ROI-Driven Marketing';
$intro_description = ( $acf_ready ? get_field( 'packages_intro_description', $post_id ) : '' ) ?: 'Looking for top-notch digital marketing packages in Arizona? Look no further! We offer various affordable options at Ludych Technology Agency to suit every need and budget. Our packages start from as low as $800 per month, ensuring that even small and local businesses and bootstrapped startups can access quality digital marketing services.<br><br>Whether you\'re just starting out or running a well-established enterprise, we have the perfect package for you. Our comprehensive digital marketing services cover all the essentials to boost your online presence. From stunning web design and eCommerce development to expert Search Engine Optimization (SEO) strategies, Social Media Marketing (SMM), and Pay Per Click (PPC) online ads management, we\'ve got you covered.<br><br>Why choose us? Well, apart from our competitive prices, we bring a wealth of expertise and over five years of experience to the table. We\'ve successfully helped over 20+ companies establish their online presence and achieve impressive growth through our ROI-focused digital marketing strategies. Your success is our priority! To make things even better, we offer customizable packages tailored to your specific requirements. We understand that each business is unique, so we\'re here to listen to your needs and deliver a solution that perfectly aligns with your goals and objectives.';

$stat_1_number = ( $acf_ready ? get_field( 'packages_stat_1_number', $post_id ) : '' ) ?: '5+';
$stat_1_label  = ( $acf_ready ? get_field( 'packages_stat_1_label', $post_id ) : '' ) ?: 'Years Experience';
$stat_2_number = ( $acf_ready ? get_field( 'packages_stat_2_number', $post_id ) : '' ) ?: '20+';
$stat_2_label  = ( $acf_ready ? get_field( 'packages_stat_2_label', $post_id ) : '' ) ?: 'Global Clients';
?>

<section class="packages-lp-intro py-5 overflow-hidden">
	<div class="custom-container">
		<div class="row align-items-center">
			<div class="col-lg-12">
				<div class="lp-intro-badge mb-3">
					<span class="badge rounded-pill bg-soft-primary px-3 py-2 text-primary font-weight-bold"><?php echo esc_html( $intro_badge ); ?></span>
				</div>
				<div class="global-header left-align pkg-intro-header">
					<h2>Overview</h2>
					<div class="min-title">
						<div class="icon-box">
							<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
								<path d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z" fill="url(#pkg-intro-grad)" />
								<defs>
									<linearGradient id="pkg-intro-grad" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311" gradientUnits="userSpaceOnUse">
										<stop stop-color="#3D72FB" />
										<stop offset="1" stop-color="#fff" />
									</linearGradient>
								</defs>
							</svg>
						</div>
						<h6><?php echo esc_html( $intro_badge ); ?></h6>
					</div>
					<h5><?php echo wp_kses_post( $intro_title ); ?></h5>
					<p><?php echo wp_kses_post( $intro_description ); ?></p>
				</div>
				
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
		</div>
	</div>
</section>
