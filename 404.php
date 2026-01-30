<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

	<section class="error-404 not-found middle-align section-padding" style="padding: 100px 0; text-align: center;">
		<div class="custom-container">
			<div class="error-content">
				<h1 style="font-size: 150px; font-weight: 700; background: linear-gradient(90deg, #3d72fb 0%, #3058c1 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 20px;">404</h1>
				<h2 style="font-size: 36px; margin-bottom: 20px;">Oops! Page Not Found</h2>
				<p style="font-size: 18px; margin-bottom: 40px; color: #666;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="globalBtnDark"><span>Back to Home <i class="fa-solid fa-arrow-right-long"></i></span></a>
			</div>
		</div>
	</section>

<?php
get_footer();
