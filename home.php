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
				// Layout Logic
				$blog_layout = isset( $_GET['layout'] ) && $_GET['layout'] === 'list' ? 'list' : 'grid';
				$part_slug   = $blog_layout === 'list' ? 'list' : 'content';
				?>
				<div class="col-12 mb-4 text-end">
					<div class="layout-switcher">
						<a href="?layout=grid" class="btn <?php echo $blog_layout !== 'list' ? 'btn-secondary' : 'btn-light'; ?>"><i class="fa-solid fa-border-all"></i></a>
						<a href="?layout=list" class="btn <?php echo $blog_layout === 'list' ? 'btn-secondary' : 'btn-light'; ?>"><i class="fa-solid fa-list"></i></a>
					</div>
				</div>

				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/blog/content', $blog_layout === 'list' ? 'list' : '' );
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
