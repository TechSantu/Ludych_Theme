<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$expertise_heading = get_field( 'contact_expertise_heading', 'option' );
if ( ! $expertise_heading ) {
	$expertise_heading = 'Why Choose Us';
}

$expertise_subtitle = get_field( 'contact_expertise_subtitle', 'option' );
if ( ! $expertise_subtitle ) {
	$expertise_subtitle = 'Why Choose Ludych?';
}

$expertise_title = get_field( 'contact_expertise_title', 'option' );
if ( ! $expertise_title ) {
	$expertise_title = 'Not Your Typical Agency <span>Here\'s Why.</span>';
}

$expertise_description = get_field( 'contact_expertise_description', 'option' );
if ( ! $expertise_description ) {
	$expertise_description = "We're not just another digital agency. We're your strategic partner in building </br> digital experiences that drive real business results.";
}

$expertise_items = get_field( 'contact_expertise_items', 'option' );
if ( ! is_array( $expertise_items ) || empty( $expertise_items ) ) {
	$expertise_items = array(
		array(
			'title'       => 'Expert Team',
			'description' => 'Experienced professionals across all digital disciplines',
			'col_class'   => 'col-md-6 col-lg-4 mt-3 mb-3',
		),
		array(
			'title'       => 'Ongoing Support',
			'description' => 'Continuous optimization and dedicated account management',
			'col_class'   => 'col-md-6 col-lg-4 mt-3 mb-3',
		),
		array(
			'title'       => 'Custom Solutions',
			'description' => 'Tailored strategies that fit your unique business needs',
			'col_class'   => 'col-md-6 col-lg-4 mt-3 mb-3',
		),
		array(
			'title'       => 'Quick Response',
			'description' => 'We respond to all inquiries within 24 hours',
			'col_class'   => 'col-xl-6 col-md-6 col-sm-12',
		),
		array(
			'title'       => 'Free Consultation',
			'description' => '30-minute strategy session at no cost',
			'col_class'   => 'col-xl-6 col-md-6 col-sm-12',
		),
	);
}
?>

<section class="our-expertise-wrap">
	<div class="custom-container">
		<div class="our-expertise">
			<div class="global-header">
				<h2><?php echo esc_html( $expertise_heading ); ?></h2>
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
					<h6><?php echo esc_html( $expertise_subtitle ); ?></h6>
				</div>
				<h5><?php echo wp_kses_post( $expertise_title ); ?></h5>
				<p><?php echo wp_kses_post( $expertise_description ); ?></p>
			</div>

			<div class="row">
				<?php foreach ( $expertise_items as $item ) : ?>
					<?php
						$title = $item['title'] ?? '';
						$desc  = $item['description'] ?? '';
						$col   = $item['col_class'] ?? 'col-md-6 col-lg-4 mt-3 mb-3';
					if ( ! $title && ! $desc ) {
						continue;
					}
					?>
						<div class="<?php echo esc_attr( $col ); ?>">
							<div class="expertise-card">
								<div class="expertise-info">
									<?php if ( $title ) : ?>
										<h3><?php echo esc_html( $title ); ?></h3>
									<?php endif; ?>
									<?php if ( $desc ) : ?>
										<p><?php echo esc_html( $desc ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
