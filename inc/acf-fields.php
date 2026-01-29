<?php
/**
 * Register ACF Local Field Groups
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'acf_add_local_field_group' ) ) :

	// Field Group for Technology Post Type
	acf_add_local_field_group( array(
		'key'                   => 'group_technology_details',
		'title'                 => __( 'Technology Details', 'ludych-theme' ),
		'fields'                => array(
			array(
				'key'          => 'field_tech_icon',
				'label'        => __( 'Technology Icon (SVG Code)', 'ludych-theme' ),
				'name'         => 'tech_icon',
				'type'         => 'textarea',
				'instructions' => __( 'Paste the raw SVG code here if you are not using a Featured Image.', 'ludych-theme' ),
				'required'     => 0,
				'rows'         => 4,
				'new_lines'    => '',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'technology',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	) );

	// Field Group for Home Page / Sections (Example for tech_stack_title and tech_stack_text)
	// You might want to assign this to your Front Page or a specific template.
	acf_add_local_field_group( array(
		'key'                   => 'group_tech_stack_settings',
		'title'                 => __( 'Technology Stack Section Settings', 'ludych-theme' ),
		'fields'                => array(
			array(
				'key'   => 'field_tech_stack_title',
				'label' => __( 'Section Title', 'ludych-theme' ),
				'name'  => 'tech_stack_title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_tech_stack_text',
				'label' => __( 'Section Description', 'ludych-theme' ),
				'name'  => 'tech_stack_text',
				'type'  => 'textarea',
				'rows'  => 3,
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	) );

endif;
