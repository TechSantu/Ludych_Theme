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
					<?php
					$features = get_field( 'features' );
					if ( $features ) {
						the_excerpt();
						?>
						<ul>
							<?php foreach ( $features as $feature ) : ?>
								<li>
									<span><i class="fa-solid fa-circle-check"></i></span>
									<p><?php echo esc_html( is_array( $feature ) ? $feature['feature_text'] : $feature ); ?></p>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php
					} else {
						the_content();
					}
					?>
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

function ludych_ajax_blog_filter() {
	$paged    = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1;
	$layout   = isset( $_POST['layout'] ) && $_POST['layout'] === 'list' ? 'list' : 'grid';
	$base_url = isset( $_POST['base_url'] ) ? esc_url( $_POST['base_url'] ) : home_url( '/blog/' );

	$args = array(
		'post_type'   => 'post',
		'paged'       => $paged,
		'post_status' => 'publish',
	);

	$query = new WP_Query( $args );

	$response = array();

	if ( $query->have_posts() ) {
		ob_start();
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/blog/content', $layout === 'list' ? 'list' : '' );
		}
		$response['content'] = ob_get_clean();

		ob_start();
		$big = 999999999;
		echo paginate_links( array(
			'base'      => $base_url . '%_%',
			'format'    => '?paged=%#%',
			'total'     => $query->max_num_pages,
			'current'   => max( 1, $paged ),
			'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
			'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
		) );
		$response['pagination'] = ob_get_clean();

	} else {
		$response['content']    = '<div class="col-12"><p>' . esc_html__( 'No posts found.', 'ludych-theme' ) . '</p></div>';
		$response['pagination'] = '';
	}

	wp_reset_postdata();

	wp_send_json( $response );
}
add_action( 'wp_ajax_ludych_ajax_blog_filter', 'ludych_ajax_blog_filter' );
add_action( 'wp_ajax_nopriv_ludych_ajax_blog_filter', 'ludych_ajax_blog_filter' );

function ludych_ajax_case_studies_filter() {
	$term = isset( $_POST['term'] ) ? sanitize_text_field( wp_unslash( $_POST['term'] ) ) : '';

	$query_args = array(
		'post_type'      => 'case_study',
		'posts_per_page' => 12,
		'post_status'    => 'publish',
	);

	if ( $term ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'case_study_category',
				'field'    => 'slug',
				'terms'    => $term,
			),
		);
	}

	$case_studies = new WP_Query( $query_args );

	ob_start();
	if ( $case_studies->have_posts() ) {
		while ( $case_studies->have_posts() ) {
			$case_studies->the_post();
			$subtitle = get_field( 'case_study_subtitle' );
			if ( ! $subtitle ) {
				$subtitle = get_the_excerpt();
			}
			$logo_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			?>
			<li>
				<a href="<?php the_permalink(); ?>" class="cs-tool-box">
					<?php if ( $logo_url ) : ?>
						<figure>
							<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
						</figure>
					<?php endif; ?>
					<div class="cs-box-desc">
						<h3><?php the_title(); ?></h3>
						<?php if ( $subtitle ) : ?>
							<h4><?php echo esc_html( $subtitle ); ?></h4>
						<?php endif; ?>
					</div>
				</a>
			</li>
			<?php
		}
		wp_reset_postdata();
	} else {
		?>
		<li>
			<div class="cs-tool-box">
				<div class="cs-box-desc">
					<h3><?php esc_html_e( 'No case studies found.', 'ludych-theme' ); ?></h3>
				</div>
			</div>
		</li>
		<?php
	}
	$content = ob_get_clean();

	wp_send_json(
		array(
			'content' => $content,
		)
	);
}

add_action( 'wp_ajax_ludych_ajax_case_studies_filter', 'ludych_ajax_case_studies_filter' );
add_action( 'wp_ajax_nopriv_ludych_ajax_case_studies_filter', 'ludych_ajax_case_studies_filter' );
