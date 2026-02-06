<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$process_heading = get_field( 'process_intro_heading', $post_id );
if ( ! $process_heading ) {
	$process_heading = 'Our Process';
}

$process_subtitle = get_field( 'process_intro_subtitle', $post_id );
if ( ! $process_subtitle ) {
	$process_subtitle = 'Transforming Ideas Into Scalable Digital Success';
}

$process_title = get_field( 'process_intro_title', $post_id );
if ( ! $process_title ) {
	$process_title = 'Discovery to Deploy.,<br> <span>Zero Surprises.</span>';
}

$process_image = get_field( 'process_intro_image', $post_id );
if ( ! is_array( $process_image ) ) {
	$process_image = array();
}

$process_description = get_field( 'process_intro_description', $post_id );
if ( ! $process_description ) {
	$process_description = 'Ludych is a full-stack digital agency based in Chandler, AZ. We ship platforms, integrations, and data products—not just websites. Our team blends senior engineering talent with rigorous PMO discipline and QA rigor, delivering end-to-end services across custom development, data analytics, DevOps/SRE, digital marketing, and product consulting.';
}

$process_steps = get_field( 'process_intro_steps', $post_id );
if ( ! is_array( $process_steps ) ) {
	$process_steps = array();
}
$process_steps_filtered = array_values(
	array_filter(
		$process_steps,
		function ( $step ) {
			if ( ! is_array( $step ) ) {
				return false;
			}
			return ! empty( $step['step_title'] )
				|| ! empty( $step['step_description'] )
				|| ! empty( $step['step_icon'] );
		}
	)
);
$process_steps_count = count( $process_steps_filtered );
$process_steps_map   = array(
	1 => 'col-12',
	2 => 'col-xl-6 col-lg-6 col-md-6 col-sm-12',
	3 => 'col-xl-4 col-lg-4 col-md-6 col-sm-12',
	4 => 'col-xl-3 col-lg-3 col-md-6 col-sm-12',
);
$process_step_col_class = $process_steps_map[ $process_steps_count ] ?? 'col-xl-4 col-lg-4 col-md-6 col-sm-12';
?>

<section class="our-work-progress with-our-process">
	<div class="custom-container">
		<div class="global-header middle-align">
			<h2><?php echo esc_html( $process_heading ); ?></h2>
			<div class="min-title">
				<div class="icon-box">
					<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
						<path
							d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z"
							fill="url(#a)" />
						<defs>
							<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311"
								gradientUnits="userSpaceOnUse">
								<stop stop-color="#3D72FB" />
								<stop offset="1" stop-color="#fff" />
							</linearGradient>
						</defs>
					</svg>
				</div>
				<h6><?php echo esc_html( $process_subtitle ); ?></h6>
			</div>
			<h5><?php echo wp_kses_post( $process_title ); ?></h5>
		</div>

		<?php if ( ! empty( $process_image ) || $process_description ) : ?>
			<div class="service-full row">
				<?php if ( ! empty( $process_image ) ) : ?>
					<?php
					$process_image_url = $process_image['url'] ?? '';
					$process_image_alt = $process_image['alt'] ?? '';
					if ( ! $process_image_alt ) {
						$process_image_alt = $process_heading;
					}
					?>
					<div class="image col-lg-6">
						<img src="<?php echo esc_url( $process_image_url ); ?>" alt="<?php echo esc_attr( $process_image_alt ); ?>">
					</div>
				<?php endif; ?>
				<?php if ( $process_description ) : ?>
					<div class="left-content col-lg-6">
						<?php echo wp_kses_post( $process_description ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $process_steps_filtered ) ) : ?>
			<div class="row">
				<?php foreach ( $process_steps_filtered as $step ) : ?>
					<?php
					$icon  = $step['step_icon'] ?? '';
					$title = $step['step_title'] ?? '';
					$desc  = $step['step_description'] ?? '';
					?>
					<div class="<?php echo esc_attr( $process_step_col_class ); ?>">
						<div class="work-progress-card">

							<?php if ( $icon ) : ?>
								<div class="img-box">
									<?php if ( is_array( $icon ) ) : ?>
										<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>">
									<?php else : ?>
										<?php echo wp_kses_post( $icon ); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if ( $title ) : ?>
								<h3><?php echo esc_html( $title ); ?></h3>
							<?php endif; ?>

							<?php if ( $desc ) : ?>
								<div class="content">
									<?php echo wp_kses_post( $desc ); ?>
								</div>
							<?php endif; ?>

						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
