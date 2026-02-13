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
			'desc'    => 'Boost your organic visibility and drive qualified traffic with comprehensive SEO strategies that deliver long-term results.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2" /></svg>',
			'bullets' => "Keyword Research\nOn-Page Optimization\nTechnical SEO\nContent Strategy",
		),
		array(
			'title'   => 'Pay-Per-Click Advertising',
			'desc'    => 'Maximize your ad spend with targeted PPC campaigns across Google, Bing, and social media platforms.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>',
			'bullets' => "Google Ads\nSocial Media Ads\nRemarketing\nCampaign Optimization",
		),
		array(
			'title'   => 'Email Marketing',
			'desc'    => 'Build lasting relationships and drive conversions through personalized, automated email campaigns.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" /><polyline points="22,6 12,13 2,6" /></svg>',
			'bullets' => "List Building\nAutomation\nA/B Testing\nPerformance Tracking",
		),
		array(
			'title'   => 'Analytics & Reporting',
			'desc'    => 'Make data-driven decisions with comprehensive analytics, tracking, and detailed performance reports.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83" /><path d="M22 12A10 10 0 0 0 12 2v10z" /></svg>',
			'bullets' => "Google Analytics\nCustom Dashboards\nROI Tracking\nMonthly Reports",
		),
		array(
			'title'   => 'Content Marketing',
			'desc'    => 'Engage your audience with compelling content that educates, entertains, and converts prospects into customers.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" /><polyline points="18 13 12 7 6 13" /><line x1="12" y1="7" x2="12" y2="21" /></svg>',
			'bullets' => "Content Strategy\nBlog Writing\nVideo Content\nSocial Content",
		),
		array(
			'title'   => 'Social Media Marketing',
			'desc'    => 'Build brand awareness and engage your community across all major social media platforms.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>',
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
					<?php
					if ( isset( $srv['svg'] ) && ! empty( $srv['svg'] ) ) {
						echo $srv['svg']; // Output raw SVG
					} else {
						// Fallback to Icon class if SVG not present (e.g. from ACF if not updated to support SVG)
						$icon_class = $srv['icon'] ?? 'fa-circle';
						echo '<i class="fas ' . esc_attr( $icon_class ) . '"></i>';
					}
					?>
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
