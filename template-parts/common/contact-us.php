<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp;

$address   = get_theme_mod( 'ludych_contact_address', get_field( 'contact_address', 'option' ) );
$phone     = get_theme_mod( 'ludych_contact_phone', get_field( 'contact_phone', 'option' ) );
$email     = get_theme_mod( 'ludych_contact_email', get_field( 'contact_email', 'option' ) );
$open_time = get_theme_mod( 'ludych_contact_open_time', get_field( 'contact_open_time', 'option' ) );

if ( empty( $address ) ) {
	$address = '1820 E Ray Road, STE A110, Chandler, Arizona 85225';
}
if ( empty( $phone ) ) {
	$phone = '520-660-8791';
}
if ( empty( $email ) ) {
	$email = 'biz@ludych.com';
}
if ( empty( $open_time ) ) {
	$open_time = 'Monday - Friday: 10:00 - 20:00<br>Friday - 9AM to 5PM<br>Saturday - Sunday - Closed';
}

$subtitle           = get_theme_mod( 'ludych_contact_form_subtitle', 'Get In Touch' );
$title              = get_theme_mod( 'ludych_contact_form_title', 'Get Your <span>Free Quote</span> Today!' );
$recaptcha_enabled  = (bool) get_theme_mod( 'ludych_recaptcha_enabled', false );
$recaptcha_site_key = get_theme_mod( 'ludych_recaptcha_site_key', '' );
$redirect_url       = get_theme_mod( 'ludych_contact_redirect_url', '' );
if ( empty( $redirect_url ) ) {
	$redirect_url = home_url( '/thank-you' );
}
?>

<section class="contact-us">
	<div class="custom-container">
		<div class="row">
			<div class="col-xl-4 col-md-5 col-sm-12">
				<div class="contact-cntn">
					<?php if ( $address ) : ?>
						<div class="cntc-box">
							<h4>Address</h4>
							<p><?php echo nl2br( esc_html( $address ) ); ?></p>
						</div>
					<?php endif; ?>

					<?php if ( $phone || $email ) : ?>
						<div class="cntc-box">
							<h4>Contact</h4>
							<ul>
								<?php if ( $phone ) : ?>
									<li><span>Phone:</span> <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
								<?php endif; ?>
								<?php if ( $email ) : ?>
									<li><span>Email:</span> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
								<?php endif; ?>
								<li><span>Calendly:</span> <a href="https://calendly.com/appleton-ludych" target="_blank">Book a meeting</a></li>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( $open_time ) : ?>
						<div class="cntc-box">
							<h4>Open Time</h4>
							<p><?php echo $open_time; ?></p>
						</div>
					<?php endif; ?>

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
			<div class="col-xl-8 col-md-7 col-sm-12">
				<div class="contact-form">
					<div class="global-header left-align">
						<h2><?php echo esc_html( $subtitle ); ?></h2>
						<div class="min-title">
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
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
							<h6><?php echo esc_html( $subtitle ); ?></h6>
						</div>
						<h5><?php echo ( $title ); ?></h5>
					</div>
					<form id="ludych-contact-form" method="post" action="" data-recaptcha-sitekey="<?php echo esc_attr( $recaptcha_site_key ); ?>" data-recaptcha-enabled="<?php echo $recaptcha_enabled ? '1' : '0'; ?>" data-redirect-url="<?php echo esc_url( $redirect_url ); ?>">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>First Name *</label>
									<input type="text" name="first_name" class="form-control" placeholder="Enter your first name" minlength="2" maxlength="60" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Last Name *</label>
									<input type="text" name="last_name" class="form-control" placeholder="Enter your last name" minlength="2" maxlength="60" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Email Address *</label>
									<input type="email" name="email" class="form-control" placeholder="Enter your email address" maxlength="190" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Phone Number</label>
									<input type="tel" name="phone" class="form-control" placeholder="Enter your phone number" pattern="[0-9+() \\-]{7,20}" title="Please enter a valid phone number.">
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label>Company Name *</label>
									<input type="text" name="company" class="form-control" placeholder="Enter your company name" minlength="2" maxlength="120" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Service Interested In</label>
									<select name="service" class="form-control">
										<option value="" selected>Web Development</option>
										<option value="wordpress-development">WordPress Development</option>
										<option value="software-development">Software Development</option>
										<option value="ui-ux">UI/UX Design</option>
										<option value="digital-marketing">Digital Marketing</option>
										<option value="seo">SEO</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Project Budget</label>
									<select name="budget" class="form-control">
										<option value="" selected>$10k - $25k</option>
										<option value="under-10k">Under $10k</option>
										<option value="25k-50k">$25k - $50k</option>
										<option value="50k-100k">$50k - $100k</option>
										<option value="100k-plus">$100k+</option>
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Project Details *</label>
									<textarea name="message" class="form-control" placeholder="Write your message..." minlength="10" required></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="action" value="ludych_contact_form">
						<input type="hidden" name="recaptcha_token" value="">
						<input type="hidden" name="recaptcha_action" value="contact_form">
						<input type="hidden" name="redirect_url" value="<?php echo esc_url( $redirect_url ); ?>">
						<?php wp_nonce_field( 'ludych_contact_nonce', 'nonce' ); ?>
						<input type="hidden" name="page_url" value="<?php echo esc_url( home_url( $wp->request ) ); ?>">
						<button type="submit" class="btn"><span>Inquiry Now</span></button>
						<div class="form-message mt-3"></div>
					</form>
					<?php if ( $recaptcha_enabled && $recaptcha_site_key ) : ?>
						<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr( $recaptcha_site_key ); ?>"></script>
					<?php endif; ?>
				</div>
			</div>
	</div>

	<div class="custom-container mt-5">
		<div class="row">
			<div class="col-12">
				<div class="calendly-wrapper">
					<div class="global-header middle-align">
						<h2>Booking</h2>
						<h5>Schedule a <span>Meeting</span></h5>
					</div>
					<div class="calendly-iframe-container">
						<iframe src="https://calendly.com/appleton-ludych" width="100%" height="700" frameborder="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
