<?php
/**
 * Template Name: Thank You Page
 */

get_header();
?>

	<section class="thank-you middle-align section-padding" style="padding: 100px 0; text-align: center;">
		<div class="custom-container">
			<div class="thank-you-content">
				<div class="icon-box" style="font-size: 80px; color: #3d72fb; margin-bottom: 20px;">
					<i class="fa-solid fa-circle-check"></i>
				</div>
				<h2 style="font-size: 48px; margin-bottom: 20px;">Thank You!</h2>
				<p style="font-size: 20px; margin-bottom: 40px; color: #666;">Your message has been received. Our team will get back to you shortly.</p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="globalBtnDark"><span>Return to Home <i class="fa-solid fa-arrow-right-long"></i></span></a>
			</div>
		</div>
	</section>

<?php
get_footer();
