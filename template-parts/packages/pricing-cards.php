<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$pricing_title    = ( $acf_ready ? get_field( 'packages_pricing_title', $post_id ) : '' ) ?: 'Website Packages';
$pricing_subtitle = ( $acf_ready ? get_field( 'packages_pricing_subtitle', $post_id ) : '' ) ?: 'Choose the website package that best fits your business stage and goals.';
$pricing_heading  = ( $acf_ready ? get_field( 'packages_pricing_heading', $post_id ) : '' ) ?: 'Pricing';
$pricing_note     = ( $acf_ready ? get_field( 'packages_pricing_note', $post_id ) : '' ) ?: 'Keep in mind that these are general guidelines and pricing can vary widely depending on the specific company and the level of service provided. It\'s important to get detailed pricing information for each service and that is why we offer a free digital marketing consultation followed by detailed quotations with breakdowns for each of our digital marketing services. Actual Ludych pricing should be customized based on deliverables, goals, and scope.';

$packages = $acf_ready ? get_field( 'packages_pricing_packages', $post_id ) : array();

if ( empty( $packages ) ) {
	$packages = array(
		array(
			'name'        => 'Starter Website Package',
			'description' => 'Perfect for startups or small businesses looking for a simple and minimalist brochure website with affordable web design.',
			'price'       => 'from $1,500 +VAT',
			'price_label' => '',
			'is_featured' => false,
			'features'    => array(
				'Up to 5 pages',
				'Custom design',
				'Mobile friendly design',
				'Unlimited revisions',
				'Intuitive website builder included',
				'Custom contact forms',
				'Up to 10 premium stock images',
				'Social media linking',
				'Training video on how to maintain your new website',
				'We take your website live on your domain name',
			),
			'bg_class'    => 'cyan',
		),
		array(
			'name'        => 'Small to Medium Website Package',
			'description' => 'Elevate your established business to new heights with additional pages for your website.',
			'price'       => 'from $2,000 +VAT',
			'price_label' => '',
			'is_featured' => true,
			'features'    => array(
				'Up to 10 pages',
				'Custom design',
				'Mobile friendly design',
				'Unlimited revisions',
				'Page speed optimisation',
				'Intuitive website builder included',
				'Custom contact forms',
				'Unlimited premium stock imagery',
				'Social media linking',
				'Google Analytics setup and install',
				'Search Engine Submission',
				'Up to three training videos on how to maintain your new website',
				'We take your website live on your domain name',
			),
			'bg_class'    => 'orange',
		),
		array(
			'name'        => 'Enterprise Website Packages',
			'description' => 'For established businesses looking to dominate their market with custom website design.',
			'price'       => 'Enquire for a quote',
			'price_label' => '',
			'is_featured' => false,
			'features'    => array(
				'Unlimited pages',
				'Custom design',
				'Custom development for advanced functionality',
				'Mobile friendly design',
				'Unlimited revisions',
				'Page speed optimisation',
				'Intuitive website builder included',
				'Custom contact forms',
				'Unlimited premium stock imagery',
				'Social media linking',
				'Google Analytics setup and install',
				'Google Search Console setup and install',
				'Search Engine Submission',
				'Unlimited training videos on how to maintain your new website',
				'We take your website live on your domain name',
			),
			'bg_class'    => 'cyan',
		),
	);
}

$standalone_title       = ( $acf_ready ? get_field( 'packages_standalone_title', $post_id ) : '' ) ?: 'Marketing Starter Services';
$standalone_description = ( $acf_ready ? get_field( 'packages_standalone_description', $post_id ) : '' ) ?: 'Start with one focused service and scale as your business grows.';
$standalone_packages    = $acf_ready ? get_field( 'packages_standalone_packages', $post_id ) : array();
if ( empty( $standalone_packages ) ) {
	$standalone_packages = array(
		array(
			'name'        => 'Marketing Starter',
			'description' => 'Essential digital marketing support for businesses getting started.',
			'price'       => 'from $500 - $700',
			'price_label' => '/month',
			'is_featured' => false,
			'features'    => array(
				'Entry-level marketing plan',
				'Basic campaign setup',
				'Monthly performance reporting',
			),
			'bg_class'    => 'cyan',
		),
		array(
			'name'        => 'SEO Starter',
			'description' => 'Improve visibility with foundational SEO optimisations.',
			'price'       => '$250',
			'price_label' => '/month',
			'is_featured' => false,
			'features'    => array(
				'Keyword targeting',
				'On-page SEO basics',
				'Search visibility improvements',
			),
			'bg_class'    => 'cyan',
		),
	);
}

$development_title       = ( $acf_ready ? get_field( 'packages_development_title', $post_id ) : '' ) ?: 'Development Packages';
$development_description = ( $acf_ready ? get_field( 'packages_development_description', $post_id ) : '' ) ?: 'Product-ready development bundles for websites, stores, and custom applications with scalable delivery.';
$development_packages    = $acf_ready ? get_field( 'packages_development_packages', $post_id ) : array();
if ( empty( $development_packages ) ) {
	$development_packages = array(
		array(
			'name'        => 'Website Launch',
			'description' => 'Professional business website build with conversion-focused pages and fast launch.',
			'price'       => '$900-1,800',
			'price_label' => '/project',
			'is_featured' => false,
			'features'    => array(
				'Up to 6 pages',
				'Responsive UI build',
				'On-page SEO basics',
				'Contact form integration',
				'Speed optimization',
				'CMS handover',
			),
			'bg_class'    => 'cyan',
		),
		array(
			'name'        => 'Ecommerce Build',
			'description' => 'Launch a conversion-ready online store with payment, shipping, and product workflows.',
			'price'       => '$1,800-3,500',
			'price_label' => '/project',
			'is_featured' => true,
			'features'    => array(
				'Store setup & structure',
				'Product & category templates',
				'Payment gateway setup',
				'Shipping/tax configuration',
				'Cart + checkout optimization',
				'Analytics integration',
			),
			'bg_class'    => 'orange',
		),
		array(
			'name'        => 'Custom Web App',
			'description' => 'Build tailored business workflows with secure, scalable custom application development.',
			'price'       => '$3,500-8,000+',
			'price_label' => '/project',
			'is_featured' => false,
			'features'    => array(
				'Discovery & architecture',
				'Custom frontend + backend',
				'Role-based access control',
				'API integration',
				'QA & deployment',
				'Post-launch support',
			),
			'bg_class'    => 'cyan',
		),
	);
}

$render_package_cards = static function ( $cards ) {
	foreach ( $cards as $package ) :
		$is_featured = isset( $package['is_featured'] ) && $package['is_featured'];
		$class       = 'package-card';
		if ( $is_featured ) {
			$class .= ' popular';
		}

		$bg_class = $package['bg_class'] ?? ( $is_featured ? 'orange' : 'cyan' );
		$btn_text = $package['button_text'] ?? 'Get Started';
		$btn_url  = $package['button_url'] ?? home_url( '/contact-us/' );
		if ( empty( $btn_text ) ) {
			$btn_text = 'Get Started';
		}
		if ( empty( $btn_url ) ) {
			$btn_url = home_url( '/contact-us/' );
		}
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
			
			<button class="<?php echo $is_featured ? 'btn-orange' : 'btn-outline-orange'; ?> w-full" onclick="window.location.href='<?php echo esc_url( $btn_url ); ?>'"><?php echo esc_html( $btn_text ); ?></button>
		</div>
		<?php
	endforeach;
};
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
				<h6><?php echo esc_html( $pricing_heading ); ?></h6>
			</div>
			<h5><?php echo esc_html( $pricing_title ); ?></h5>
			<p><?php echo esc_html( $pricing_subtitle ); ?></p>
		</div>

		<div class="package-grid">
			<?php $render_package_cards( $packages ); ?>
		</div>

		<div class="package-subsection">
			<div class="global-header middle-align package-subsection__header">
				<h5><?php echo esc_html( $standalone_title ); ?></h5>
				<p><?php echo esc_html( $standalone_description ); ?></p>
			</div>
			<div class="package-grid package-grid--four">
				<?php $render_package_cards( $standalone_packages ); ?>
			</div>
		</div>

		<div class="package-subsection">
			<div class="global-header middle-align package-subsection__header">
				<h5><?php echo esc_html( $development_title ); ?></h5>
				<p><?php echo esc_html( $development_description ); ?></p>
			</div>
			<div class="package-grid package-grid--three">
				<?php $render_package_cards( $development_packages ); ?>
			</div>
		</div>

		<?php if ( ! empty( $pricing_note ) ) : ?>
			<p class="text-center text-muted mt-4"><?php echo esc_html( $pricing_note ); ?></p>
		<?php endif; ?>
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
foreach ( $standalone_packages as $package ) {
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
foreach ( $development_packages as $package ) {
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
