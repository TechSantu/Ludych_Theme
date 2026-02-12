<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$pricing_title    = ( $acf_ready ? get_field( 'packages_pricing_title', $post_id ) : '' ) ?: 'Our Plans';
$pricing_subtitle = ( $acf_ready ? get_field( 'packages_pricing_subtitle', $post_id ) : '' ) ?: 'Strategic Growth Tiers';
$pricing_heading  = ( $acf_ready ? get_field( 'packages_pricing_heading', $post_id ) : '' ) ?: 'Scale Your Business with <span>Precision</span>';

$packages = $acf_ready ? get_field( 'packages_pricing_packages', $post_id ) : array();

if ( empty( $packages ) ) {
	$packages = array(
		array(
			'name'         => 'Starter Growth Package — “Launch & Optimize”',
			'description'  => 'Ideal for small businesses, startups, local shops & first-time online advertisers.',
			'price'        => '$800 – $1,500',
			'price_label'  => '/ month typical',
			'icon'         => 'fa-rocket',
			'features'     => array(
				'<strong>WordPress Web Development</strong>: Up to 5 pages, mobile responsive, basic on-page SEO',
				'<strong>Search Engine Optimization</strong>: Keyword research, on-page optimization, monthly report',
				'<strong>PPC Advertising</strong>: Search setup, $500 spend management, bid monitoring',
				'<strong>Social Media Ads</strong>: FB/IG setup, creatives, monthly reporting',
				'<strong>Email Marketing</strong>: 1 monthly campaign, integration & automation',
				'<strong>Analytics & Reporting</strong>: GA+GTM config, monthly performance summary',
			),
			'outcome'      => 'BOOSTS ONLINE PRESENCE, EARLY TRAFFIC & GROUNDWORK FOR SCALE',
			'outcome_icon' => 'fa-bullseye',
			'is_featured'  => false,
			'button_text'  => 'Select Plan',
			'button_url'   => home_url( '/contact-us/' ),
		),
		array(
			'name'         => 'Advanced Performance Package — “Accelerate Growth”',
			'description'  => 'Ideal for small–medium businesses ready to scale traffic and leads.',
			'price'        => '$1,800 – $3,500',
			'price_label'  => '/ month typical',
			'icon'         => 'fa-bolt',
			'features'     => array(
				'<strong>WordPress Web Development</strong>: 8–12 pages, custom UI/UX, SEO-ready structure',
				'<strong>Comprehensive SEO</strong>: Competitor analysis, technical SEO, monthly blog content',
				'<strong>PPC Advertising</strong>: Full Search/Display, $1,500 budget management, optimization',
				'<strong>Social Media Ads</strong>: Targeting strategy, retargeting & lookalike setups',
				'<strong>Email Marketing</strong>: Automated funnels, 2 campaigns / month + reporting',
				'<strong>Conversion Tracking</strong>: Enhanced analytics, call tracking, custom dashboards',
			),
			'outcome'      => 'PRODUCES MEASURABLE ROI, TRAFFIC GROWTH & LEAD GENERATION',
			'outcome_icon' => 'fa-chart-line',
			'is_featured'  => true,
			'button_text'  => 'Select Plan',
			'button_url'   => home_url( '/contact-us/' ),
		),
		array(
			'name'         => 'Enterprise Brand Booster — “Dominant Market Presence”',
			'description'  => 'Ideal for established brands wanting deep optimization, high traffic, and multi-channel dominance.',
			'price'        => '$4,500 – $10,000+',
			'price_label'  => '/ month typical',
			'icon'         => 'fa-crown',
			'features'     => array(
				'<strong>Premium WordPress Web Dev</strong>: Full custom site, eCommerce/CRM integration, CRO',
				'<strong>Enterprise SEO</strong>: Full technical schema, ongoing link building & audits',
				'<strong>Advanced PPC Management</strong>: Full Google/YT/Display funnels, $5,000+ management',
				'<strong>Social Media Advertising</strong>: FB/IG/LinkedIn dynamic ads, audience segmentation',
				'<strong>Email Automation</strong>: List segmentation, nurture sequences, full growth strategy',
				'<strong>Advanced Analytics</strong>: Heatmaps, A/B testing, weekly/monthly strategic calls',
			),
			'outcome'      => 'HOLISTIC DOMINANCE, CROSS-CHANNEL SYNERGY & STRONGER BRANDING',
			'outcome_icon' => 'fa-chess-king',
			'is_featured'  => false,
			'button_text'  => 'Select Plan',
			'button_url'   => home_url( '/contact-us/' ),
		),
	);
}
?>

<section class="modern-pricing-section py-5 position-relative bg-light">
	<!-- Decorative background elements -->
	<div class="pricing-blob blob-1"></div>
	<div class="pricing-blob blob-2"></div>
	
	<div class="custom-container position-relative z-index-1">
		<div class="global-header middle-align mb-5 pb-4">
			<h2><?php echo esc_html( $pricing_title ); ?></h2>
			<div class="min-title">
				<h6><?php echo esc_html( $pricing_subtitle ); ?></h6>
			</div>
			<h5 class="fw-bold"><?php echo wp_kses_post( $pricing_heading ); ?></h5>
		</div>

		<div class="row g-4 align-items-stretch">
			<?php
			foreach ( $packages as $package ) :
				$is_featured   = isset( $package['is_featured'] ) && $package['is_featured'];
				$package_class = $is_featured ? 'package-advanced featured' : 'package-starter';
				$pkg_name      = ! empty( $package['name'] ) ? $package['name'] : 'Package Name';
				$pkg_desc      = ! empty( $package['description'] ) ? $package['description'] : '';
				$pkg_price     = ! empty( $package['price'] ) ? $package['price'] : '$0';
				$pkg_price_lbl = ! empty( $package['price_label'] ) ? $package['price_label'] : '/ month';
				$pkg_icon      = ! empty( $package['icon'] ) ? $package['icon'] : 'fa-rocket';
				$pkg_btn_text  = ! empty( $package['button_text'] ) ? $package['button_text'] : 'Select Plan';
				$pkg_btn_url   = ! empty( $package['button_url'] ) ? $package['button_url'] : home_url('/contact-us/');
				$pkg_outcome   = ! empty( $package['outcome'] ) ? $package['outcome'] : 'OUTCOME';
				$pkg_out_icon  = ! empty( $package['outcome_icon'] ) ? $package['outcome_icon'] : 'fa-bullseye';
				?>
			<div class="col-lg-4">
				<div class="modern-card <?php echo esc_attr( $package_class ); ?> h-100 position-relative">
					<?php if ( $is_featured ) : ?>
						<div class="featured-badge">MOST POPULAR</div>
					<?php endif; ?>
					
					<div class="card-header-v2">
						<div class="pkg-icon mb-4">
							<i class="fas <?php echo esc_attr( $pkg_icon ); ?>"></i>
						</div>
						<h4 <?php echo $is_featured ? 'class="text-white"' : ''; ?>>
							<?php echo esc_html( $pkg_name ); ?>
						</h4>
						<p class="<?php echo $is_featured ? 'text-white opacity-75' : 'text-muted'; ?> small mb-4">
							<?php echo esc_html( $pkg_desc ); ?>
						</p>
						<div class="pkg-price mb-4 <?php echo $is_featured ? 'text-white font-custom-style' : ''; ?>">
							<span class="price-val d-block mb-1"><?php echo esc_html( $pkg_price ); ?></span>
							<span class="price-label d-block small <?php echo $is_featured ? 'opacity-75' : 'text-muted'; ?>">
								<?php echo esc_html( $pkg_price_lbl ); ?>
							</span>
						</div>
					</div>
					
					<div class="card-body-v2">
						<ul class="pkg-features <?php echo $is_featured ? 'text-white' : ''; ?>">
							<?php
							$features = ! empty( $package['features'] ) ? $package['features'] : array();

							// Handle fallback (array of strings) vs ACF Repeater (array of arrays)
							if ( is_string( $features ) ) {
								$features = explode( "\n", $features );
							}

							foreach ( (array) $features as $feature_item ) :
								$feature_text = is_array( $feature_item ) ? ( $feature_item['feature'] ?? '' ) : $feature_item;
								$feature_text = trim( (string) $feature_text );

								if ( empty( $feature_text ) ) {
									continue;
								}

								$parts = explode( ':', $feature_text, 2 );
								$label = trim( $parts[0] );
								$value = isset( $parts[1] ) ? trim( $parts[1] ) : '';
								?>
								<li>
									<i class="fas fa-check"></i>
									<div class="feature-info">
										<span class="f-label"><?php echo wp_kses_post( $label ); ?></span>
										<?php if ( ! empty( $value ) ) : ?>
											<span class="f-sep">:</span>
											<span class="f-value"><?php echo wp_kses_post( $value ); ?></span>
										<?php endif; ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					
					<div class="card-footer-v2 mt-auto pt-4 border-0 bg-transparent">
						<div class="outcome-pill <?php echo $is_featured ? 'featured-pill' : ''; ?> mb-4">
							<span class="small fw-bold <?php echo $is_featured ? 'text-white' : 'text-primary'; ?>">
								<i class="fas <?php echo esc_attr( $pkg_out_icon ); ?> me-2"></i> 
								<?php echo esc_html( $pkg_outcome ); ?>
							</span>
						</div>
						<a href="<?php echo esc_url( $pkg_btn_url ); ?>" 
							class="lp-btn <?php echo $is_featured ? 'lp-btn-primary' : 'lp-btn-outline'; ?> w-100">
							<?php echo esc_html( $pkg_btn_text ); ?>
						</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
$offers_schema = array();
foreach ( $packages as $package ) {
	$price_value = preg_replace('/[^0-9.]/', '', $package['price'] ?? '0');

	$features = $package['features'] ?? array();
	if ( is_string( $features ) ) {
		$features = explode( "\n", $features );
	}
	$features = array_filter( array_map( 'trim', $features ) );

	$offers_schema[] = array(
		'@type'              => 'Offer',
		'name'               => $package['name'] ?? '',
		'description'        => $package['description'] ?? '',
		'price'              => $price_value,
		'priceCurrency'      => 'USD',
		'priceSpecification' => array(
			'@type'         => 'UnitPriceSpecification',
			'price'         => $price_value,
			'priceCurrency' => 'USD',
			'unitText'      => 'MONTH',
		),
		'itemOffered'        => array(
			'@type'       => 'Service',
			'name'        => $package['name'] ?? '',
			'description' => implode( ', ', $features ),
		),
		'url'                => $package['button_url'] ?? home_url('/contact-us/'),
	);
}

$service_schema = array(
	'@context'    => 'https://schema.org',
	'@type'       => 'Service',
	'serviceType' => 'Digital Marketing',
	'provider'    => array(
		'@type' => 'Organization',
		'name'  => 'Ludych Technology',
		'url'   => home_url(),
	),
	'areaServed'  => array(
		'@type' => 'State',
		'name'  => 'Arizona',
	),
	'offers'      => $offers_schema,
);
?>

<script type="application/ld+json">
<?php echo wp_json_encode( $service_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>
