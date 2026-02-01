<?php
/**
 * Template part for displaying posts in list view
 */
$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? $categories[0]->name : '';
?>

<div class="col-lg-6 col-md-12">
	<div class="blog-item2">
		<div class="blog-thumbnail">
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'medium_large' ); ?>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-1.png" alt="<?php the_title_attribute(); ?>">
				</a>
			<?php endif; ?>
			
			<?php if ( $cat_name ) : ?>
			<span class="blog-tag">
				<?php echo esc_html( $cat_name ); ?>
			</span>
			<?php endif; ?>
		</div>
		<div class="blog-info">
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="btn-text">Read More</a>
		</div>
	</div>
</div>
