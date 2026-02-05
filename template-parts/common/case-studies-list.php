<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$active_term = isset( $_GET['case-study-category'] ) ? sanitize_text_field( wp_unslash( $_GET['case-study-category'] ) ) : '';
$terms       = get_terms( array(
	'taxonomy'   => 'case_study_category',
	'hide_empty' => true,
) );

$query_args = array(
	'post_type'      => 'case_study',
	'posts_per_page' => 12,
);

if ( $active_term ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'case_study_category',
			'field'    => 'slug',
			'terms'    => $active_term,
		),
	);
}

$case_studies = new WP_Query( $query_args );
?>

<section class="case-studies-weap grey-bg">
	<div class="custom-container">
		<div class="cs-tabs">
			<ul>
				<li>
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="<?php echo $active_term ? '' : 'active'; ?>">All Services</a>
				</li>
				<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
					<?php foreach ( $terms as $term ) : ?>
						<?php
							$term_url = add_query_arg( 'case-study-category', $term->slug, get_permalink() );
							$is_active = $active_term === $term->slug;
							?>
							<li>
								<a href="<?php echo esc_url( $term_url ); ?>" class="<?php echo $is_active ? 'active' : ''; ?>">
									<?php echo esc_html( $term->name ); ?>
								</a>
							</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>

		<div class="cs-lists">
			<ul>
				<?php if ( $case_studies->have_posts() ) : ?>
					<?php while ( $case_studies->have_posts() ) : ?>
						<?php
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
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<li>
						<div class="cs-tool-box">
							<div class="cs-box-desc">
								<h3>No case studies found.</h3>
							</div>
						</div>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</section>
