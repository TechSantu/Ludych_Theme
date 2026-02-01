<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

	<?php get_template_part( 'template-parts/blog/banner' ); ?>

	<section class="our-blog grey-bg">
		<div class="custom-container">            
			<div class="row">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/blog/content' );
					endwhile;

					the_posts_pagination( array(
						'mid_size'  => 2,
						'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
						'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
					) );

				else :
					echo '<div class="col-12"><p>No posts found.</p></div>';
				endif;
				?>
			</div>
		</div>
	</section>

<?php
get_footer();
