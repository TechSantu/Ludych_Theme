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
	<div class="custom-container">
		<div class="global-header middle-align">
			<h2>Packages</h2>
			<div class="min-title">
				<div class="icon-box">
					<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
						<path d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z" fill="url(#pkg-pricing-grad)" />
						<defs>
							<linearGradient id="pkg-pricing-grad" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311" gradientUnits="userSpaceOnUse">
								<stop stop-color="#3D72FB" />
								<stop offset="1" stop-color="#fff" />
							</linearGradient>
						</defs>
					</svg>
				</div>
				<h6>Pricing</h6>
			</div>
			<h5><?php echo esc_html( $pricing_title ); ?></h5>
			<p><?php echo esc_html( $pricing_subtitle ); ?></p>
		</div>

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
