<?php
$related_args = array(
	'post_type'      => 'post',
	'posts_per_page' => 4,
	'post__not_in'   => array( get_the_ID() ),
	'orderby'        => 'rand',
);

$categories = get_the_category();
if ( ! empty( $categories ) ) {
	$cat_ids = array();
	foreach ( $categories as $cat ) {
		$cat_ids[] = $cat->term_id;
	}
	$related_args['category__in'] = $cat_ids;
}

$related_query = new WP_Query( $related_args );

if ( $related_query->have_posts() ) :
	?>
<div class="col-12">
	<div class="related-post mt-5">
		<h2>Related Post</h2>

		<div class="row mt-4">
			<?php
			while ( $related_query->have_posts() ) :
				$related_query->the_post();

				$rel_cats     = get_the_category();
				$rel_cat_name = '';

				if ( ! empty( $rel_cats ) ) {
					foreach ( $rel_cats as $category ) {
						// Skip 'Uncategorized' and get the first real category
						if ( 'uncategorized' !== strtolower( $category->name ) ) {
							$rel_cat_name = $category->name;
							break;
						}
					}
				}
				?>
				<div class="col-md-2 col-lg-3">
					<div class="blog-cart">
						<div class="blog-thumbnail">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium' ); ?>
								</a>
							<?php else : ?>
								<a href="<?php the_permalink(); ?>">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-1.png" alt="<?php the_title_attribute(); ?>">
								</a>
							<?php endif; ?>
							<?php if ( $rel_cat_name ) : ?>
								<span class="blog-tag"><?php echo esc_html( $rel_cat_name ); ?></span>
							<?php endif; ?>
						</div>
						<div class="blog-text">
							<h4>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h4>
							<span class="date"><?php echo get_the_date( 'F j, Y' ); ?></span>                                                                  
						</div>                                    
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>
<?php endif; ?>
