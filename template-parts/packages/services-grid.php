<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$services_title    = ( $acf_ready ? get_field( 'packages_services_title', $post_id ) : '' ) ?: 'Comprehensive Marketing Services';
$services_subtitle = ( $acf_ready ? get_field( 'packages_services_subtitle', $post_id ) : '' ) ?: 'From strategy to execution, we provide end-to-end digital marketing solutions that drive growth and deliver measurable results.';

$services = $acf_ready ? get_field( 'packages_services_list', $post_id ) : array();

if ( empty( $services ) ) {
	$services = array(
		array(
			'title'   => 'Search Engine Optimization',
			'desc'    => 'Boost your organic visibility and drive qualified traffic with comprehensive SEO strategies.',
			'icon'    => 'fa-search',
			'bullets' => "Keyword Research\nOn-Page Optimization\nTechnical SEO\nContent Strategy",
		),
		array(
			'title'   => 'Pay-Per-Click Advertising',
			'desc'    => 'Maximize your ad spend with targeted PPC campaigns across Google, Bing, and social media platforms.',
			'icon'    => 'fa-bullseye',
			'bullets' => "Google Ads\nSocial Media Ads\nRemarketing\nCampaign Optimization",
		),
		array(
			'title'   => 'Email Marketing',
			'desc'    => 'Build lasting relationships and drive conversions through personalized, automated email campaigns.',
			'icon'    => 'fa-envelope',
			'bullets' => "List Building\nAutomation\nA/B Testing\nPerformance Tracking",
		),
		array(
			'title'   => 'Analytics & Reporting',
			'desc'    => 'Make data-driven decisions with comprehensive analytics, tracking, and detailed performance reports.',
			'icon'    => 'fa-chart-bar',
			'bullets' => "Google Analytics\nCustom Dashboards\nROI Tracking\nMonthly Reports",
		),
		array(
			'title'   => 'Content Marketing',
			'desc'    => 'Engage your audience with compelling content that educates, entertains, and converts prospects.',
			'icon'    => 'fa-pen-nib',
			'bullets' => "Content Strategy\nBlog Writing\nVideo Content\nSocial Content",
		),
		array(
			'title'   => 'Social Media Marketing',
			'desc'    => 'Build brand awareness and engage your community across all major social media platforms.',
			'icon'    => 'fa-share-alt',
			'bullets' => "Strategy Development\nContent Creation\nCommunity Management\nSocial Advertising",
		),
	);
}
?>

<section class="section-services">
	<div class="custom-container text-center">
		<h2 class="font-inria section-title"><?php echo esc_html( $services_title ); ?></h2>
		<p class="section-subtitle"><?php echo esc_html( $services_subtitle ); ?></p>

		<div class="services-grid">
			<?php
			foreach ( $services as $srv ) :
				$bullets = $srv['bullets'] ?? '';
				if ( is_string( $bullets ) ) {
					$bullets = explode( "\n", $bullets );
				}
				?>
			<div class="service-card text-left">
				<div class="service-icon-box small-cyan">
					<i class="fas <?php echo esc_attr( $srv['icon'] ?? 'fa-circle' ); ?>"></i>
				</div>
				<h3 class="font-inria"><?php echo esc_html( $srv['title'] ); ?></h3>
				<p><?php echo esc_html( $srv['desc'] ); ?></p>
				<ul class="orange-bullets">
					<?php
					foreach ( (array) $bullets as $bullet ) :
						if ( trim( $bullet ) ) :
							?>
						<li><?php echo esc_html( trim( $bullet ) ); ?></li>
							<?php
					endif;
endforeach;
					?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
