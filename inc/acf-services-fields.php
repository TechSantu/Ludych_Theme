<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ludych_register_services_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'                   => 'group_services_fields',
		'title'                 => 'Services Fields',
		'fields'                => array(
			array(
				'key'       => 'field_process_tab',
				'label'     => 'Our Process Section',
				'name'      => '',
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'           => 'field_work_progress_heading',
				'label'         => 'Process Heading',
				'name'          => 'work_progress_heading',
				'type'          => 'text',
				'default_value' => 'Our Process',
				'required'      => 1,
			),
			array(
				'key'           => 'field_work_progress_small_title',
				'label'         => 'Process Small Title',
				'name'          => 'work_progress_small_title',
				'type'          => 'text',
				'default_value' => 'Transforming Ideas Into Scalable Digital Success',
			),
			array(
				'key'          => 'field_work_progress_title',
				'label'        => 'Process Main Title',
				'name'         => 'work_progress_title',
				'type'         => 'wysiwyg',
				'instructions' => 'Use <span> and <br> tags for styling',
				'toolbar'      => 'basic',
				'media_upload' => 0,
			),
			array(
				'key'          => 'field_work_progress_steps',
				'label'        => 'Process Steps',
				'name'         => 'work_progress_steps',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add Step',
				'min'          => 0,
				'max'          => 4,
				'sub_fields'   => array(
					array(
						'key'           => 'field_step_icon',
						'label'         => 'Step Icon',
						'name'          => 'step_icon',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'thumbnail',
					),
					array(
						'key'   => 'field_step_title',
						'label' => 'Step Title',
						'name'  => 'step_title',
						'type'  => 'text',
					),
					array(
						'key'          => 'field_step_description',
						'label'        => 'Step Description',
						'name'         => 'step_description',
						'type'         => 'wysiwyg',
						'toolbar'      => 'basic',
						'media_upload' => 0,
					),
				),
			),
			array(
				'key'       => 'field_tech_stack_tab',
				'label'     => 'Technology Stack Section',
				'name'      => '',
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'           => 'field_tech_stack_title_services',
				'label'         => 'Tech Stack Title',
				'name'          => 'tech_stack_title',
				'type'          => 'text',
				'default_value' => 'Technology Stack',
			),
			array(
				'key'   => 'field_tech_stack_text_services',
				'label' => 'Tech Stack Description',
				'name'  => 'tech_stack_text',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'       => 'field_expertise_tab',
				'label'     => 'Expertise Section',
				'name'      => '',
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'          => 'field_expertise_title',
				'label'        => 'Expertise Title',
				'name'         => 'expertise_title',
				'type'         => 'wysiwyg',
				'instructions' => 'Main title with HTML support for <span> and <br> tags',
				'required'     => 1,
				'toolbar'      => 'basic',
				'media_upload' => 0,
			),
			array(
				'key'   => 'field_expertise_description',
				'label' => 'Expertise Description',
				'name'  => 'expertise_description',
				'type'  => 'textarea',
				'rows'  => 4,
			),
			array(
				'key'          => 'field_expertise_items',
				'label'        => 'Expertise Items',
				'name'         => 'expertise_items',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add Expertise Item',
				'sub_fields'   => array(
					array(
						'key'           => 'field_expertise_item_image',
						'label'         => 'Item Image',
						'name'          => 'item_image',
						'type'          => 'image',
						'return_format' => 'array',
						'preview_size'  => 'medium',
					),
					array(
						'key'          => 'field_expertise_item_title',
						'label'        => 'Item Title',
						'name'         => 'item_title',
						'type'         => 'wysiwyg',
						'instructions' => 'Use <br> for line breaks',
						'toolbar'      => 'basic',
						'media_upload' => 0,
					),
					array(
						'key'   => 'field_expertise_item_description',
						'label' => 'Item Description',
						'name'  => 'item_description',
						'type'  => 'textarea',
						'rows'  => 4,
					),
				),
			),
			array(
				'key'       => 'field_industries_tab',
				'label'     => 'Industries Section',
				'name'      => '',
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'           => 'field_industries_heading',
				'label'         => 'Industries Heading',
				'name'          => 'industries_heading',
				'type'          => 'text',
				'default_value' => 'Industry We Serve',
				'required'      => 1,
			),
			array(
				'key'           => 'field_industries_subtitle',
				'label'         => 'Industries Subtitle',
				'name'          => 'industries_subtitle',
				'type'          => 'text',
				'default_value' => 'Industry We Serve',
				'required'      => 1,
			),
			array(
				'key'          => 'field_industries_title',
				'label'        => 'Industries Title',
				'name'         => 'industries_title',
				'type'         => 'wysiwyg',
				'instructions' => 'Main title with HTML support for <span> tags',
				'required'     => 1,
				'toolbar'      => 'basic',
				'media_upload' => 0,
			),
			array(
				'key'       => 'field_blog_tab',
				'label'     => 'News & Blog Section',
				'name'      => '',
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'           => 'field_blog_section_subtitle',
				'label'         => 'Section Subtitle',
				'name'          => 'blog_section_subtitle',
				'type'          => 'text',
				'default_value' => 'Our Blog',
			),
			array(
				'key'           => 'field_blog_section_title',
				'label'         => 'Section Title',
				'name'          => 'blog_section_title',
				'type'          => 'text',
				'default_value' => 'Latest News & Blog',
			),
			array(
				'key'          => 'field_blog_section_heading',
				'label'        => 'Section Heading',
				'name'         => 'blog_section_heading',
				'type'         => 'wysiwyg',
				'toolbar'      => 'basic',
				'media_upload' => 0,
			),
			array(
				'key'       => 'field_service_card_tab',
				'label'     => 'Service Card Details',
				'name'      => '',
				'type'      => 'tab',
				'placement' => 'top',
			),
			array(
				'key'          => 'field_card_features',
				'label'        => 'Card Features List',
				'name'         => 'card_features',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add Feature',
				'sub_fields'   => array(
					array(
						'key'   => 'field_card_feature_text',
						'label' => 'Feature',
						'name'  => 'feature_text',
						'type'  => 'text',
					),
				),
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'services',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	) );
}
add_action( 'acf/init', 'ludych_register_services_acf_fields' );

function ludych_register_service_category_taxonomy() {
	register_taxonomy( 'service_category', array( 'services' ), array(
		'labels'            => array(
			'name'              => 'Service Categories',
			'singular_name'     => 'Service Category',
			'search_items'      => 'Search Categories',
			'all_items'         => 'All Categories',
			'parent_item'       => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item'         => 'Edit Category',
			'update_item'       => 'Update Category',
			'add_new_item'      => 'Add New Category',
			'new_item_name'     => 'New Category Name',
			'menu_name'         => 'Categories',
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'service-category' ),
		'show_in_rest'      => true,
	) );
}
add_action( 'init', 'ludych_register_service_category_taxonomy' );
