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
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/blog/content', 'single' );
				endwhile;

				get_template_part( 'template-parts/blog/related', 'posts' );
				?>
			</div>
		</div>
	</section>

<?php
get_footer();
