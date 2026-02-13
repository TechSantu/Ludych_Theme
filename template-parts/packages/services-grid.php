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
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
			'bullets' => "Keyword Research\nOn-Page Optimization\nTechnical SEO\nContent Strategy",
		),
		array(
			'title'   => 'Pay-Per-Click Advertising',
			'desc'    => 'Maximize your ad spend with targeted PPC campaigns across Google, Bing, and social media platforms.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
			'bullets' => "Google Ads\nSocial Media Ads\nRemarketing\nCampaign Optimization",
		),
		array(
			'title'   => 'Email Marketing',
			'desc'    => 'Build lasting relationships and drive conversions through personalized, automated email campaigns.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
			'bullets' => "List Building\nAutomation\nA/B Testing\nPerformance Tracking",
		),
		array(
			'title'   => 'Analytics & Reporting',
			'desc'    => 'Make data-driven decisions with comprehensive analytics, tracking, and detailed performance reports.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
			'bullets' => "Google Analytics\nCustom Dashboards\nROI Tracking\nMonthly Reports",
		),
		array(
			'title'   => 'Content Marketing',
			'desc'    => 'Engage your audience with compelling content that educates, entertains, and converts prospects.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5 5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>',
			'bullets' => "Content Strategy\nBlog Writing\nVideo Content\nSocial Content",
		),
		array(
			'title'   => 'Social Media Marketing',
			'desc'    => 'Build brand awareness and engage your community across all major social media platforms.',
			'svg'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>',
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
