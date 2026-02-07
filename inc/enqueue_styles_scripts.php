<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function theme_enqueue_assets() {
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
	wp_enqueue_style( 'google-font-sacramento', 'https://fonts.googleapis.com/css2?family=Sacramento&display=swap', array(), null );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.3.4' );
	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/assets/css/style.css', array( 'bootstrap-css' ), '1.0' );
	wp_enqueue_style( 'theme-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array( 'theme-style' ), '1.0' );

	wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/assets/js/popper.min.js', array( 'jquery' ), '2.11.6', true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery', 'popper-js' ), '5.0', true );
	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
	wp_enqueue_script( 'theme-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '1.0', true );

	wp_localize_script(
		'theme-custom-js',
		'ludych_ajax_obj',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_assets' );
