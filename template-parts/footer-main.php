<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<footer class="footer">
		<div class="custom-container">
			<div class="row">
				<div class="col-xl-12 col-md-12 col-sm-12">
					<div class="ftr-upper-part">
						<?php
						$footer_logo_id = get_theme_mod( 'ludych_footer_logo' );
						if ( $footer_logo_id ) {
							echo wp_get_attachment_image( $footer_logo_id, 'full', false, array( 'class' => 'ftr-logo' ) );
						} else {
							?>
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" class="ftr-logo" alt="">
						<?php } ?>
						<p>
							<?php
							echo wp_kses_post(
								get_theme_mod(
									'ludych_footer_description',
									__( 'Ludych was born from a simple realization: businesses needed partners who could ship working software and measurable growth—not just reports. Founded by Joseph Appleton, we\'re a full-stack agency delivering custom development, data analytics, DevOps, digital marketing, PMO, and QA. Build boldly. Grow smart.', 'ludych-theme' )
								)
							);
							?>
						</p>
					</div>
				</div>

				<div class="col-xl-8 col-md-12 col-sm-12">
					<div class="footer-right">
						<div class="footer-nav">
							<h6>Company</h6>
							<ul>
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer_company',
										'container'      => '',
										'fallback_cb'    => '__return_empty_string',
										'items_wrap'     => '%3$s',
									)
								);
								?>
							</ul>
						</div>
						<div class="footer-nav">
							<h6>Industries</h6>
							<ul>
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer_industries',
										'container'      => '',
										'fallback_cb'    => '__return_empty_string',
										'items_wrap'     => '%3$s',
									)
								);
								?>
							</ul>
						</div>
						<div class="footer-nav">
							<h6>Services</h6>
							<ul>
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer_services',
										'container'      => '',
										'fallback_cb'    => '__return_empty_string',
										'items_wrap'     => '%3$s',
									)
								);
								?>
							</ul>
						</div>
						<div class="footer-nav">
							<h6>Email</h6>
							<?php
							$footer_email = get_theme_mod( 'ludych_contact_email', 'biz@ludych.com' );
							if ( $footer_email ) :
								?>
								<a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a>
							<?php endif; ?>
							<h6>Skype</h6>
							<?php
							$footer_skype = get_theme_mod( 'ludych_footer_skype', 'Ludych' );
							if ( $footer_skype ) :
								?>
								<a href="skype:<?php echo esc_attr( $footer_skype ); ?>?chat"><?php echo esc_html( $footer_skype ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-md-12 col-sm-12">
					<div class="office-wrapper">
						<h6>Global Office</h6>
						<div class="row">
							<div class="col-xl-6 col-md-6 col-sm-12">
								<div class="office-item">
									<?php
									$office1_image_id = get_theme_mod( 'ludych_footer_office1_image' );
									if ( $office1_image_id ) {
										echo wp_get_attachment_image( $office1_image_id, 'full', false, array() );
									} else {
										?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/new-york.png' ); ?>" alt="">
									<?php } ?>
									<h5><?php echo esc_html( get_theme_mod( 'ludych_footer_office1_title', __( 'New York HQ', 'ludych-theme' ) ) ); ?></h5>
									<p><?php echo esc_html( get_theme_mod( 'ludych_footer_office1_address', __( '123 Digital Avenue New York, NY 10001', 'ludych-theme' ) ) ); ?></p>
									<h6><?php echo esc_html( get_theme_mod( 'ludych_footer_office1_phone', __( '+1 (555) 123-4567', 'ludych-theme' ) ) ); ?></h6>
								</div>
							</div>
							<div class="col-xl-6 col-md-6 col-sm-12">
								<div class="office-item">
									<?php
									$office2_image_id = get_theme_mod( 'ludych_footer_office2_image' );
									if ( $office2_image_id ) {
										echo wp_get_attachment_image( $office2_image_id, 'full', false, array() );
									} else {
										?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/San-Francisco.png' ); ?>" alt="">
									<?php } ?>
									<h5><?php echo esc_html( get_theme_mod( 'ludych_footer_office2_title', __( 'San Francisco', 'ludych-theme' ) ) ); ?></h5>
									<p><?php echo esc_html( get_theme_mod( 'ludych_footer_office2_address', __( '456 Tech Street San Francisco, CA 94102', 'ludych-theme' ) ) ); ?></p>
									<h6><?php echo esc_html( get_theme_mod( 'ludych_footer_office2_phone', __( '+1 (555) 987-6543', 'ludych-theme' ) ) ); ?></h6>
								</div>
							</div>
							<div class="col-12">
								<div class="office-item">
									<div class="footer-map">
										<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d51376610.418691374!2d-99.091086!3d38.191797!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xaa3076b5283652d9%3A0x2a5b6ef1354a7b77!2sLudych%20Technology!5e0!3m2!1sen!2sus!4v1770576168737!5m2!1sen!2sus" width="500" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copy-right">
				<p class="copyright-text">
					© <?php echo date( 'Y' ); ?> <?php echo esc_html( get_theme_mod( 'ludych_footer_copyright_name', 'Ludych Digital Agency' ) ); ?>. <?php echo esc_html( get_theme_mod( 'ludych_footer_copyright_suffix', 'All rights reserved.' ) ); ?>
				</p>
				<div class="copy-right-btns">
					<?php
					for ( $i = 1; $i <= 5; $i++ ) {
						$icon = trim( (string) get_theme_mod( "ludych_footer_social_{$i}_icon" ) );
						$url  = trim( (string) get_theme_mod( "ludych_footer_social_{$i}_url", '#' ) );

						if ( '' === $icon || '' === $url ) {
							continue;
						}

						echo '<a href="' . esc_url( $url ) . '"><i class="' . esc_attr( $icon ) . '"></i></a>';
					}
					?>
				</div>
			</div>
		</div>
	</footer>

