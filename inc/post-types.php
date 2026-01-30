<?php
/**
 * Register Custom Post Types and Taxonomies
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_register_custom_post_types() {
	register_post_type( 'technology', array(
		'labels'       => array(
			'name'          => __( 'Technologies', 'ludych-theme' ),
			'singular_name' => __( 'Technology', 'ludych-theme' ),
			'add_new'       => __( 'Add New Technology', 'ludych-theme' ),
			'add_new_item'  => __( 'Add New Technology', 'ludych-theme' ),
			'edit_item'     => __( 'Edit Technology', 'ludych-theme' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'supports'     => array( 'title', 'thumbnail', 'editor' ),
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-rest-api',
		'taxonomies'   => array( 'technology_cat' ),
	) );

	register_taxonomy( 'technology_cat', 'technology', array(
		'labels'            => array(
			'name'          => __( 'Technology Categories', 'ludych-theme' ),
			'singular_name' => __( 'Technology Category', 'ludych-theme' ),
			'menu_name'     => __( 'Categories', 'ludych-theme' ),
		),
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tech-category' ),
	) );

	register_post_type( 'testimonial', array(
		'labels'       => array(
			'name'          => __( 'Testimonials', 'ludych-theme' ),
			'singular_name' => __( 'Testimonial', 'ludych-theme' ),
			'add_new'       => __( 'Add New Testimonial', 'ludych-theme' ),
			'add_new_item'  => __( 'Add New Testimonial', 'ludych-theme' ),
			'edit_item'     => __( 'Edit Testimonial', 'ludych-theme' ),
		),
		'public'       => true,
		'has_archive'  => false,
		'supports'     => array( 'title', 'thumbnail', 'editor' ),
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-testimonial',
	) );
}
add_action( 'init', 'ludych_register_custom_post_types' );
