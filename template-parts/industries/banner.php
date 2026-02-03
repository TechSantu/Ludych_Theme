<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post_id;

$banner_bg = get_field( 'banner_background_image', $post_id );
if ( ! $banner_bg ) {
	$banner_bg = get_template_directory_uri() . '/assets/images/services-bg.jpg';
}

$banner_heading = get_field( 'banner_heading', $post_id );
if ( ! $banner_heading ) {
	$banner_heading = get_the_title();
}

$banner_eyebrow = get_field( 'banner_eyebrow', $post_id );
if ( ! $banner_eyebrow ) {
	$terms = get_the_terms( $post_id, 'industry_category' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$banner_eyebrow = $terms[0]->name;
	} else {
		$banner_eyebrow = 'Industry';
	}
}

$banner_desc = get_field( 'banner_description', $post_id );
if ( ! $banner_desc ) {
	$banner_desc = get_the_excerpt();
}
?>

<section class="inner-banner-wrap with-overlay text-center" style="background-image: url('<?php echo esc_url( $banner_bg ); ?>');">
	<div class="custom-container">
		<div class="inner-banner">
			<div class="global-header services-head">
				<h2>Services</h2> <!-- Static label "Services" per HTML but technically this is an Industry page. User might want "Industries". Keeping as "Services" to match HTML or maybe make it dynamic? HTML says "Services". -->
				<div class="min-title">
					<div class="icon-box">
						<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
							<path d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z" fill="url(#a)"></path>
							<defs>
								<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311" gradientUnits="userSpaceOnUse">
									<stop stop-color="#3D72FB"></stop>
									<stop offset="1" stop-color="#fff"></stop>
								</linearGradient>
							</defs>
						</svg>
					</div>
					<h6><?php echo esc_html( $banner_eyebrow ); ?></h6>
				</div>
				<h5><?php echo wp_kses_post( $banner_heading ); ?></h5>
				<?php if ( $banner_desc ) : ?>
					<p><?php echo esc_html( $banner_desc ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
