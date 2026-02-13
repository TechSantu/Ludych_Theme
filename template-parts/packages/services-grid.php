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
	<div class="custom-container">
		<div class="global-header middle-align">
			<h2>Services</h2>
			<div class="min-title">
				<div class="icon-box">
					<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
						<path d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z" fill="url(#pkg-services-grad)" />
						<defs>
							<linearGradient id="pkg-services-grad" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311" gradientUnits="userSpaceOnUse">
								<stop stop-color="#3D72FB" />
								<stop offset="1" stop-color="#fff" />
							</linearGradient>
						</defs>
					</svg>
				</div>
				<h6><?php echo esc_html( $services_title ); ?></h6>
			</div>
			<h5><?php echo esc_html( $services_title ); ?></h5>
			<p><?php echo esc_html( $services_subtitle ); ?></p>
		</div>

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
