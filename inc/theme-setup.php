<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_theme_setup() {
	add_theme_support( 'title-tag' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary'           => __( 'Primary Menu', 'ludych-theme' ),
			'footer_company'    => __( 'Footer Company Menu', 'ludych-theme' ),
			'footer_industries' => __( 'Footer Industries Menu', 'ludych-theme' ),
			'footer_services'   => __( 'Footer Services Menu', 'ludych-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'ludych_theme_setup' );

function ludych_filter_custom_logo( $html ) {
	if ( empty( $html ) ) {
		return $html;
	}

	$html = str_replace(
		'class="custom-logo-link',
		'class="custom-logo-link navbar-brand top-logo-part',
		$html
	);

	return $html;
}
add_filter( 'get_custom_logo', 'ludych_filter_custom_logo' );
