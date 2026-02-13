<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$pricing_title    = ( $acf_ready ? get_field( 'packages_pricing_title', $post_id ) : '' ) ?: 'Marketing Combo Packages';
$pricing_subtitle = ( $acf_ready ? get_field( 'packages_pricing_subtitle', $post_id ) : '' ) ?: 'Integrated multi-channel marketing solutions designed to grow your business. Each package builds on the previous tier with additional channels and advanced features.';

$packages = $acf_ready ? get_field( 'packages_pricing_packages', $post_id ) : array();

if ( empty( $packages ) ) {
	$packages = array(
		array(
			'name'        => 'Marketing Starter',
			'description' => 'Essential multi-channel marketing for small businesses and startups.',
			'price'       => '$400-700',
			'price_label' => '/month',
			'is_featured' => false,
			'features'    => array(
				'SEO optimization (5 keywords)',
				'PPC basics (Google Ads)',
				'Social media basics',
				'Monthly reporting',
			),
			'bg_class'    => 'cyan', // Helper for demo
		),
		array(
			'name'        => 'Growth Bundle',
			'description' => 'Comprehensive marketing solution for growing businesses seeking scale.',
			'price'       => '$800-1,200',
			'price_label' => '/month',
			'is_featured' => true,
			'features'    => array(
				'Full SEO optimization',
				'Multi-platform PPC',
				'Advanced automation',
				'Content creation (4/mo)',
			),
			'bg_class'    => 'orange',
		),
		array(
			'name'        => 'Full Marketing',
			'description' => 'Complete marketing operations for established companies.',
			'price'       => '$1,500-2,000',
			'price_label' => '/month',
			'is_featured' => false,
			'features'    => array(
				'All marketing channels active',
				'Cusom automation flows',
				'Weekly strategy sessions',
				'Dedicated manager',
			),
			'bg_class'    => 'cyan',
		),
	);
}
?>

<section class="section-packages">
	<div class="custom-container text-center">
		<h2 class="font-inria section-title"><?php echo esc_html( $pricing_title ); ?></h2>
		<p class="section-subtitle"><?php echo esc_html( $pricing_subtitle ); ?></p>

		<div class="package-grid">
			<?php
			foreach ( $packages as $i => $package ) :
				$is_featured = isset( $package['is_featured'] ) && $package['is_featured'];
				$class       = 'package-card';
				if ( $is_featured ) {
					$class .= ' popular';
				}

				// Determine header color logic if not set in ACF
				$bg_class = $package['bg_class'] ?? ( $is_featured ? 'orange' : 'cyan' );
				?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php if ( $is_featured ) : ?>
					<div class="popular-tag">Most Popular</div>
				<?php endif; ?>
				
				<div class="p-header <?php echo esc_attr( $bg_class ); ?>"></div>
				<h3 class="font-inria"><?php echo esc_html( $package['name'] ); ?></h3>
				<div class="p-price"><?php echo esc_html( $package['price'] ); ?><span><?php echo esc_html( $package['price_label'] ); ?></span></div>
				<p class="p-desc"><?php echo esc_html( $package['description'] ); ?></p>
				
				<ul class="p-list">
					<?php
					$features = $package['features'] ?? array();
					if ( is_string( $features ) ) {
						$features = explode( "\n", $features );
					}
					foreach ( (array) $features as $feat ) :
						$feat_text = is_array( $feat ) ? ( $feat['feature'] ?? '' ) : $feat;
						if ( empty( trim( $feat_text ) ) ) {
							continue;
						}
						?>
					<li><span>✓</span> <?php echo wp_kses_post( $feat_text ); ?></li>
					<?php endforeach; ?>
				</ul>
				
				<button class="<?php echo $is_featured ? 'btn-orange' : 'btn-outline-orange'; ?> w-full" onclick="window.location.href='<?php echo home_url('/contact-us/'); ?>'">Get Started</button>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
// Schema Markup
$offers_schema = array();
foreach ( $packages as $package ) {
	$price_value     = preg_replace('/[^0-9.]/', '', $package['price'] ?? '0');
	$offers_schema[] = array(
		'@type'         => 'Offer',
		'name'          => $package['name'] ?? '',
		'description'   => $package['description'] ?? '',
		'price'         => $price_value,
		'priceCurrency' => 'USD',
		'url'           => home_url('/contact-us/'),
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
	'offers'      => $offers_schema,
);
?>
<script type="application/ld+json">
<?php echo wp_json_encode( $service_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>

