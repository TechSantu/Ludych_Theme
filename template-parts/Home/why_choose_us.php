<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post_id;

$why_text       = get_field('why_choose_us_text', $post_id);
$why_text_small = get_field('why_choose_us_text_small', $post_id);
$why_title      = get_field('why_choose_us_title', $post_id);
$why_image      = get_field('why_choose_us_image', $post_id);
?>

<!-- why choose us start -->
<section class="why-Onchoose-us">
	<div class="custom-container">
		<div class="global-header left-align">

			<?php if ( $why_text ) : ?>
				<h2><?php echo esc_html( $why_text ); ?></h2>
			<?php endif; ?>

			<?php if ( $why_text_small ) : ?>
				<div class="min-title">
					<div class="icon-box">
						<!-- SVG remains static -->
						<?php /* keep your SVG here */ ?>
					</div>
					<h6><?php echo esc_html( $why_text_small ); ?></h6>
				</div>
			<?php endif; ?>

			<?php if ( $why_title ) : ?>
				<h5><?php echo esc_html( $why_title ); ?></h5>
			<?php endif; ?>

		</div>

		<div class="row">
			<div class="col-xl-6 col-md-6 col-sm-12">
				<?php if ( $why_image ) : ?>
					<div class="thumbnail-box">
						<img src="<?php echo esc_url( $why_image['url'] ); ?>" alt="<?php echo esc_attr( $why_image['alt'] ); ?>">
					</div>
				<?php endif; ?>
			</div>

			<div class="col-xl-6 col-md-6 col-sm-12">
				<div class="content-wrapper">

					<?php if ( have_rows( 'why_choose_us_box', $post_id ) ) : ?>
						<?php while ( have_rows( 'why_choose_us_box', $post_id ) ) : the_row(); 
							$box_image = get_sub_field('box_image');
							$box_text  = get_sub_field('box_text');
							$box_desc  = get_sub_field('box_desc');
						?>
							<div class="content-box-inner">

								<?php if ( $box_image ) : ?>
									<img src="<?php echo esc_url( $box_image['url'] ); ?>" alt="<?php echo esc_attr( $box_image['alt'] ); ?>">
								<?php endif; ?>

								<?php if ( $box_text ) : ?>
									<h3><?php echo esc_html( $box_text ); ?></h3>
								<?php endif; ?>

								<?php if ( $box_desc ) : ?>
									<p><?php echo esc_html( $box_desc ); ?></p>
								<?php endif; ?>

							</div>
						<?php endwhile; ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- why choose us end -->
