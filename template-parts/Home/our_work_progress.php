<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post_id;

$heading     = get_field('work_progress_heading', $post_id);
$small_title = get_field('work_progress_small_title', $post_id);
$main_title  = get_field('work_progress_title', $post_id);
?>

<!-- our work progress start -->
<section class="our-work-progress">
	<div class="custom-container">

		<div class="global-header middle-align">

			<?php if ( $heading ) : ?>
				<h2><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<div class="min-title">
				<div class="icon-box">
					<!-- keep your static SVG here -->
				</div>

				<?php if ( $small_title ) : ?>
					<h6><?php echo esc_html( $small_title ); ?></h6>
				<?php endif; ?>
			</div>

			<?php if ( $main_title ) : ?>
				<h5><?php echo wp_kses_post( $main_title ); ?></h5>
			<?php endif; ?>

		</div>

		<div class="row">

			<?php if ( have_rows('work_progress_steps', $post_id) ) : ?>
				<?php while ( have_rows('work_progress_steps', $post_id) ) : the_row(); 
					$icon  = get_sub_field('step_icon');
					$title = get_sub_field('step_title');
					$desc  = get_sub_field('step_description');
				?>
					<div class="col-xl-3 col-md-6 col-sm-12">
						<div class="work-progress-card">

							<?php if ( $icon ) : ?>
								<div class="img-box">
									<img 
										src="<?php echo esc_url( $icon['url'] ); ?>" 
										alt="<?php echo esc_attr( $icon['alt'] ); ?>">
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
				<?php endwhile; ?>
			<?php endif; ?>

		</div>
	</div>
</section>
<!-- our work progress end -->
