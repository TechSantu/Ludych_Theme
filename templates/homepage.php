<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Template Name: Home Page
 */


global $post_id;
$post_id = get_the_ID();
?>

<?php get_header(); ?>

<?php
$parts = array(
	'banner',
	'about',
	'services',
	'our_work',
	'why_choose',
	'our_work_progress',
	'testimonial',
	'our_blog',
	'faq_section',
);
foreach ( $parts as $part ) {
	get_template_part( 'template-parts/Home/' . $part );
}
?>

	<!-- contact us start -->
	<section class="contact-us">
		<div class="custom-container">
			<div class="row">
				<div class="col-xl-4 col-md-4 col-sm-12">
					<div class="contact-cntn">
						<div class="cntc-box">
							<h4>Address</h4>
							<p>1820 E Ray Road, STE A110, Chandler, Arizona 85225</p>
						</div>
						<div class="cntc-box">
							<h4>Contact</h4>
							<ul>
								<li><span>Phone:</span> <a href="tel:520-660-8791">520-660-8791</a></li>
								<li><span>Email:</span> <a href="mailto:biz@ludych.com"> biz@ludych.com</a></li>
							</ul>
						</div>
						<div class="cntc-box">
							<h4>Open Time</h4>
							<p>Monday - Friday: 10:00 - 20:00</p>
						</div>
						<div class="social-box">
							<ul>
								<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xl-8 col-md-8 col-sm-12">
					<div class="contact-form">
						<div class="global-header left-align">
							<h2>Get In Touch</h2>
							<div class="min-title">
								<div class="icon-box">
									<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
										fill="none">
										<path
											d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z"
											fill="url(#a)" />
										<defs>
											<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311"
												gradientUnits="userSpaceOnUse">
												<stop stop-color="#3D72FB" />
												<stop offset="1" stop-color="#fff" />
											</linearGradient>
										</defs>
									</svg>
								</div>
								<h6>Testimonials</h6>
							</div>
							<h5>Get Your <span>Free Quote</span> Today!</h5>
						</div>
						<form>
							<div class="row">
								<div class="col-xl-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Your Name</label>
										<input type="text" class="form-control" placeholder="Name*">
									</div>
								</div>
								<div class="col-xl-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Email Addresse</label>
										<input type="email" class="form-control" placeholder="Email Address*">
									</div>
								</div>
								<div class="col-xl-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Phone Number</label>
										<input type="text" class="form-control" placeholder="Phone Number*">
									</div>
								</div>
								<div class="col-xl-6 col-md-6 col-sm-12">
									<div class="form-group">
										<label>Company Name</label>
										<input type="text" class="form-control" placeholder="Company Name">
									</div>
								</div>
								<div class="col-xl-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label>Please describe your project requirements*</label>
										<textarea name="message" class="form-control"
											placeholder="Write your message..."></textarea>
									</div>
								</div>
							</div>
							<button type="submit" class="btn">Inquiry Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- contact us end -->

<?php
get_footer();
?>