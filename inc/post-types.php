<?php
/**
 * Register Custom Post Types and Taxonomies
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_register_custom_post_types() {
	// Technology Post Type
	register_post_type( 'technology', array(
		'labels'      => array(
			'name'          => __( 'Technologies', 'ludych-theme' ),
			'singular_name' => __( 'Technology', 'ludych-theme' ),
			'add_new'       => __( 'Add New Technology', 'ludych-theme' ),
			'add_new_item'  => __( 'Add New Technology', 'ludych-theme' ),
			'edit_item'     => __( 'Edit Technology', 'ludych-theme' ),
		),
		'public'      => true,
		'has_archive' => false,
		'supports'    => array( 'title', 'thumbnail', 'editor' ),
		'show_in_rest' => true,
		'menu_icon'   => 'dashicons-rest-api',
		'taxonomies'  => array( 'technology' ),
	) );

	// Technology Taxonomy (Hierarchical)
	register_taxonomy( 'technology', 'technology', array(
		'labels'            => array(
			'name'          => __( 'Technology Categories', 'ludych-theme' ),
			'singular_name' => __( 'Technology Category', 'ludych-theme' ),
			'menu_name'     => __( 'Categories', 'ludych-theme' ),
		),
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'technology-category' ),
	) );
}
add_action( 'init', 'ludych_register_custom_post_types' );
