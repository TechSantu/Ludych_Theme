<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$hero_bg = $acf_ready ? get_field( 'packages_hero_background', $post_id ) : '';
if ( is_array( $hero_bg ) ) {
	$hero_bg = $hero_bg['url'] ?? '';
}

$hero_title    = ( $acf_ready ? get_field( 'packages_hero_title', $post_id ) : '' ) ?: 'Digital Marketing That Drives <span class="results-box">Results</span>';
$hero_subtitle = ( $acf_ready ? get_field( 'packages_hero_subtitle', $post_id ) : '' ) ?: 'Accelerate your business growth with data-driven marketing strategies that deliver measurable ROI and sustainable success across all digital channels.';
$hero_btn_text = ( $acf_ready ? get_field( 'packages_hero_btn_text', $post_id ) : '' ) ?: 'Boost Your Marketing';
$hero_btn_url  = ( $acf_ready ? get_field( 'packages_hero_btn_url', $post_id ) : '' ) ?: home_url( '/contact-us/' );

// Hero background image logic from previous implementation is less relevant in the new design which uses a radial gradient,
// but we can keep it as an overlay if needed, or ignore if strict design adherence.
// The new design uses CSS background on .hero. We will stick to the new design's CSS.
?>

<section class="hero">
	<div class="hero-bg-glow"></div>

	<!-- Floating Shapes -->
	<div class="shape diamond outline"></div>
	<div class="shape square solid-dark"></div>
	<div class="shape circle outline"></div>
	<div class="shape circle solid-small"></div>

	<div class="hero-content">
		<h1><?php echo wp_kses_post( $hero_title ); ?></h1>
		<p><?php echo esc_html( $hero_subtitle ); ?></p>
		<div class="hero-actions">
			<button class="btn-orange hero-btn" onclick="window.location.href='<?php echo esc_url( $hero_btn_url ); ?>'"><?php echo esc_html( $hero_btn_text ); ?></button>
		</div>
	</div>
</section>

<?php
$breadcrumb_schema = array(
	'@context'        => 'https://schema.org',
	'@type'           => 'BreadcrumbList',
	'itemListElement' => array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => 'Home',
			'item'     => home_url(),
		),
		array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => 'Packages',
			'item'     => get_permalink( $post_id ),
		),
	),
);
?>

<script type="application/ld+json">
<?php echo wp_json_encode( $breadcrumb_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>
