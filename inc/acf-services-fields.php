<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_register_services_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_services_fields',
		'title' => 'Services Fields',
		'fields' => array(
			array(
				'key' => 'field_expertise_tab',
				'label' => 'Expertise Section',
				'name' => '',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_expertise_title',
				'label' => 'Expertise Title',
				'name' => 'expertise_title',
				'type' => 'wysiwyg',
				'instructions' => 'Main title with HTML support for <span> and <br> tags',
				'required' => 1,
				'toolbar' => 'basic',
				'media_upload' => 0,
			),
			array(
				'key' => 'field_expertise_description',
				'label' => 'Expertise Description',
				'name' => 'expertise_description',
				'type' => 'textarea',
				'rows' => 4,
			),
			array(
				'key' => 'field_expertise_items',
				'label' => 'Expertise Items',
				'name' => 'expertise_items',
				'type' => 'repeater',
				'layout' => 'block',
				'button_label' => 'Add Expertise Item',
				'sub_fields' => array(
					array(
						'key' => 'field_expertise_item_image',
						'label' => 'Item Image',
						'name' => 'item_image',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'medium',
					),
					array(
						'key' => 'field_expertise_item_title',
						'label' => 'Item Title',
						'name' => 'item_title',
						'type' => 'wysiwyg',
						'instructions' => 'Use <br> for line breaks',
						'toolbar' => 'basic',
						'media_upload' => 0,
					),
					array(
						'key' => 'field_expertise_item_description',
						'label' => 'Item Description',
						'name' => 'item_description',
						'type' => 'textarea',
						'rows' => 4,
					),
				),
			),
			array(
				'key' => 'field_industries_tab',
				'label' => 'Industries Section',
				'name' => '',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_industries_heading',
				'label' => 'Industries Heading',
				'name' => 'industries_heading',
				'type' => 'text',
				'default_value' => 'Industry We Serve',
				'required' => 1,
			),
			array(
				'key' => 'field_industries_subtitle',
				'label' => 'Industries Subtitle',
				'name' => 'industries_subtitle',
				'type' => 'text',
				'default_value' => 'Industry We Serve',
				'required' => 1,
			),
			array(
				'key' => 'field_industries_title',
				'label' => 'Industries Title',
				'name' => 'industries_title',
				'type' => 'wysiwyg',
				'instructions' => 'Main title with HTML support for <span> tags',
				'required' => 1,
				'toolbar' => 'basic',
				'media_upload' => 0,
			),
			array(
				'key' => 'field_industries_items',
				'label' => 'Industries Items',
				'name' => 'industries_items',
				'type' => 'repeater',
				'layout' => 'block',
				'button_label' => 'Add Industry Item',
				'sub_fields' => array(
					array(
						'key' => 'field_industry_item_title',
						'label' => 'Item Title',
						'name' => 'item_title',
						'type' => 'text',
					),
					array(
						'key' => 'field_industry_item_image',
						'label' => 'Item Image',
						'name' => 'item_image',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'medium',
					),
					array(
						'key' => 'field_industry_item_description',
						'label' => 'Item Description',
						'name' => 'item_description',
						'type' => 'textarea',
						'rows' => 3,
					),
					array(
						'key' => 'field_industry_item_features',
						'label' => 'Features List',
						'name' => 'item_features',
						'type' => 'repeater',
						'layout' => 'table',
						'button_label' => 'Add Feature',
						'sub_fields' => array(
							array(
								'key' => 'field_industry_feature_text',
								'label' => 'Feature',
								'name' => 'feature_text',
								'type' => 'text',
							),
						),
					),
					array(
						'key' => 'field_industry_item_link',
						'label' => 'Read More Link',
						'name' => 'item_link',
						'type' => 'url',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'services',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
	) );
}
add_action( 'acf/init', 'ludych_register_services_acf_fields' );

function ludych_register_service_category_taxonomy() {
	register_taxonomy( 'service_category', array( 'services' ), array(
		'labels' => array(
			'name' => 'Service Categories',
			'singular_name' => 'Service Category',
			'search_items' => 'Search Categories',
			'all_items' => 'All Categories',
			'parent_item' => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item' => 'Edit Category',
			'update_item' => 'Update Category',
			'add_new_item' => 'Add New Category',
			'new_item_name' => 'New Category Name',
			'menu_name' => 'Categories',
		),
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'service-category' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'ludych_register_service_category_taxonomy' );
