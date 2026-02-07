<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<header class="top-navbar navbar navbar-expand-lg" id="navbar">
		<div class="custom-container">
			<?php
			if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
				<a class="navbar-brand top-logo-part" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</a>
			<?php endif; ?>

			<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbar-content">
				<div class="hamburger-toggle">
					<div class="hamburger">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</button>
			<div class="collapse navbar-collapse" id="navbar-content">
				<div class="only_mobile_view">
					<div class="mobile_logo">
						<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						if ( $custom_logo_id ) :
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
								echo wp_get_attachment_image(
									$custom_logo_id,
									'full',
									false,
									array(
										'class' => 'mobile-logo-img',
										'alt'   => esc_attr( get_bloginfo( 'name' ) ),
									)
								);
								?>
							</a>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="mobile-logo-img">
							</a>
						<?php endif; ?>
					</div>
					<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbar-content">
						<div class="hamburger-toggle">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/close-btn.png' ); ?>" alt="">
						</div>
					</button>
				</div>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'navbar-nav',
						'container'      => false,
						'fallback_cb'    => '__return_empty_string',
						'walker'         => class_exists( 'Ludych_Walker_Nav_Menu' ) ? new Ludych_Walker_Nav_Menu() : null,
					)
				);
				?>
				<div class="loginBtn-cntn">
					<a href="<?php echo esc_url( get_theme_mod( 'ludych_lets_connect_url', home_url( '/contact-us/' ) ) ); ?>" class="globalBtnOutline">
						<span><?php echo esc_html( get_theme_mod( 'ludych_lets_connect_label', "LET's CONNECT" ) ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</header>
