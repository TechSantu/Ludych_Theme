<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_load_more_services() {
	$paged     = isset( $_POST['page'] ) ? $_POST['page'] : 1;
	$post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'services';

	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => 3,
		'paged'          => $paged,
		'post_status'    => 'publish',
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			?>
			<div class="col-xl-4 col-md-6 col-sm-12">
				<div class="partner-item">
					<h3><?php the_title(); ?></h3>
					<div class="partner-thumb-item">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large' ); ?>
						<?php else : ?>
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/custom-development-2.jpg" alt="">
						<?php endif; ?>
					</div>
					<?php the_excerpt(); ?>
					<?php
					$features = get_field( 'features' );
					if ( $features ) :
						?>
						<ul>
							<?php foreach ( $features as $feature ) : ?>
								<li>
									<span><i class="fa-solid fa-circle-check"></i></span>
									<p><?php echo esc_html( is_array( $feature ) ? $feature['feature_text'] : $feature ); ?></p>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<a href="<?php the_permalink(); ?>" class="learnBtn">read more...</a>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}

	wp_die();
}

add_action( 'wp_ajax_load_more_services', 'ludych_load_more_services' );
add_action( 'wp_ajax_nopriv_load_more_services', 'ludych_load_more_services' );
