<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$pricing_title    = $acf_ready ? get_field( 'packages_pricing_title', $post_id ) : 'Our Plans';
$pricing_subtitle = $acf_ready ? get_field( 'packages_pricing_subtitle', $post_id ) : 'Strategic Growth Tiers';
$pricing_heading  = $acf_ready ? get_field( 'packages_pricing_heading', $post_id ) : 'Scale Your Business with <span>Precision</span>';

$packages = $acf_ready ? get_field( 'packages_pricing_packages', $post_id ) : array();

if ( empty( $packages ) ) {
	$packages = array(
		array(
			'name'         => 'Starter Growth',
			'description'  => 'Perfect for startups and local businesses looking to establish their presence.',
			'price'        => '$800',
			'price_label'  => '/ month starting',
			'icon'         => 'fa-rocket',
			'features'     => array(
				'WordPress Dev (5 Pages)',
				'Foundational On-page SEO',
				'PPC Setup (Google/Bing)',
				'Social Media Ads Setup',
				'1 Email Campaign / Month',
				'Monthly Performance Report',
			),
			'outcome'      => 'GROUNDWORK FOR SCALE',
			'outcome_icon' => 'fa-bullseye',
			'is_featured'  => false,
			'button_text'  => 'Select Plan',
			'button_url'   => home_url('/contact-us/'),
		),
		array(
			'name'         => 'Advanced Performance',
			'description'  => 'Designed for businesses ready to accelerate leads and dominate traffic.',
			'price'        => '$1,800',
			'price_label'  => '/ month starting',
			'icon'         => 'fa-bolt',
			'features'     => array(
				'8-12 Page Custom WP Site',
				'Technical & Competitor SEO',
				'Managed Ad Budget Up to $1,500',
				'FB & IG Retargeting Campaigns',
				'2 Automated Email Funnels',
				'Enhanced Conversion Tracking',
			),
			'outcome'      => 'MEASURABLE LEAD GROWTH',
			'outcome_icon' => 'fa-chart-line',
			'is_featured'  => true,
			'button_text'  => 'Select Plan',
			'button_url'   => home_url('/contact-us/'),
		),
		array(
			'name'         => 'Enterprise Booster',
			'description'  => 'Full-channel dominance with deep optimization and dedicated coordination.',
			'price'        => '$4,500',
			'price_label'  => '/ month starting',
			'icon'         => 'fa-crown',
			'features'     => array(
				'Custom eCommerce/CRM Integration',
				'High-Authority Link Building',
				'Managed Budget $5,000+',
				'Cross-Channel Retargeting',
				'Advanced Automation Workflows',
				'Weekly Strategic Calls',
			),
			'outcome'      => 'MARKET DOMINANCE',
			'outcome_icon' => 'fa-chess-king',
			'is_featured'  => false,
			'button_text'  => 'Select Plan',
			'button_url'   => home_url('/contact-us/'),
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
				$is_featured   = isset( $package['is_featured'] ) ? $package['is_featured'] : false;
				$package_class = $is_featured ? 'package-advanced featured' : 'package-starter';
				?>
			<div class="col-lg-4">
				<div class="modern-card <?php echo esc_attr( $package_class ); ?> h-100 position-relative">
					<?php if ( $is_featured ) : ?>
						<div class="featured-badge">MOST POPULAR</div>
					<?php endif; ?>
					
					<div class="card-header-v2">
						<div class="pkg-icon mb-4">
							<i class="fas <?php echo esc_attr( $package['icon'] ?? 'fa-rocket' ); ?>"></i>
						</div>
						<h4 <?php echo $is_featured ? 'class="text-white"' : ''; ?>>
							<?php echo esc_html( $package['name'] ?? 'Package Name' ); ?>
						</h4>
						<p class="<?php echo $is_featured ? 'text-white opacity-75' : 'text-muted'; ?> small mb-4">
							<?php echo esc_html( $package['description'] ?? '' ); ?>
						</p>
						<div class="pkg-price mb-4 <?php echo $is_featured ? 'text-white font-custom-style' : ''; ?>">
							<span class="price-val"><?php echo esc_html( $package['price'] ?? '$0' ); ?></span>
							<span class="price-label <?php echo $is_featured ? 'opacity-75' : ''; ?>">
								<?php echo esc_html( $package['price_label'] ?? '/ month' ); ?>
							</span>
						</div>
					</div>
					
					<div class="card-body-v2">
						<ul class="pkg-features <?php echo $is_featured ? 'text-white' : ''; ?>">
							<?php
							$features = $package['features'] ?? array();
							if ( is_string( $features ) ) {
								$features = explode( "\n", $features );
							}
							foreach ( $features as $feature ) :
								$feature = trim( $feature );
								if ( empty( $feature ) ) {
									continue;
								}
								?>
								<li><i class="fas fa-check"></i> <?php echo esc_html( $feature ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
					
					<div class="card-footer-v2 mt-auto pt-4 border-0 bg-transparent">
						<div class="outcome-pill <?php echo $is_featured ? 'featured-pill' : ''; ?> mb-4">
							<span class="small fw-bold <?php echo $is_featured ? 'text-white' : 'text-primary'; ?>">
								<i class="fas <?php echo esc_attr( $package['outcome_icon'] ?? 'fa-bullseye' ); ?> me-2"></i> 
								<?php echo esc_html( $package['outcome'] ?? 'OUTCOME' ); ?>
							</span>
						</div>
						<a href="<?php echo esc_url( $package['button_url'] ?? home_url('/contact-us/') ); ?>" 
							class="lp-btn <?php echo $is_featured ? 'lp-btn-primary' : 'lp-btn-outline'; ?> w-100">
							<?php echo esc_html( $package['button_text'] ?? 'Select Plan' ); ?>
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
