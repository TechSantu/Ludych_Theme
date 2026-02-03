<?php
/**
 * Register ACF Local Field Groups
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'acf_add_local_field_group' ) ) :

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

	acf_add_local_field_group( array(
		'key'                   => 'group_testimonial_details',
		'title'                 => __( 'Testimonial Details', 'ludych-theme' ),
		'fields'                => array(
			array(
				'key'   => 'field_testimonial_designation',
				'label' => __( 'Designation / Location', 'ludych-theme' ),
				'name'  => 'testimonial_designation',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_testimonial_role',
				'label' => __( 'Role (e.g. Developer)', 'ludych-theme' ),
				'name'  => 'testimonial_role',
				'type'  => 'text',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'testimonial',
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

	// Services Page Fields
	acf_add_local_field_group( array(
		'key'                   => 'group_services_details',
		'title'                 => __( 'Services Page Details', 'ludych-theme' ),
		'fields'                => array(
			// Tab: Banner
			array(
				'key'   => 'field_tab_banner',
				'label' => 'Banner Section',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_banner_background_image',
				'label'         => 'Banner Background Image',
				'name'          => 'banner_background_image',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'          => 'field_banner_heading',
				'label'        => 'Banner Heading',
				'name'         => 'banner_heading',
				'type'         => 'text',
				'instructions' => 'Overrides Page Title if set.',
			),
			array(
				'key'          => 'field_banner_eyebrow',
				'label'        => 'Banner Eyebrow / Subtitle',
				'name'         => 'banner_eyebrow',
				'type'         => 'text',
				'instructions' => 'Overrides Category Name if set.',
			),
			array(
				'key'          => 'field_banner_description',
				'label'        => 'Banner Description',
				'name'         => 'banner_description',
				'type'         => 'textarea',
				'rows'         => 3,
				'instructions' => 'Overrides Excerpt if set.',
			),

			// Tab: Expertise
			array(
				'key'   => 'field_tab_expertise',
				'label' => 'Expertise Section',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_expertise_heading',
				'label'         => 'Section Heading',
				'name'          => 'expertise_heading',
				'type'          => 'text',
				'default_value' => 'Our Expertise',
			),
			array(
				'key'           => 'field_expertise_subtitle',
				'label'         => 'Section Subtitle (Icon Text)',
				'name'          => 'expertise_subtitle',
				'type'          => 'text',
				'default_value' => 'Our Expertise',
			),
			array(
				'key'   => 'field_expertise_title',
				'label' => 'Main Title',
				'name'  => 'expertise_title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_expertise_description',
				'label' => 'Description',
				'name'  => 'expertise_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'        => 'field_expertise_items',
				'label'      => 'Expertise Items',
				'name'       => 'expertise_items',
				'type'       => 'repeater',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_item_image',
						'label'         => 'Icon / Image',
						'name'          => 'item_image',
						'type'          => 'image',
						'return_format' => 'array',
					),
					array(
						'key'   => 'field_item_title',
						'label' => 'Title',
						'name'  => 'item_title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_item_description',
						'label' => 'Description',
						'name'  => 'item_description',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// Tab: Industries / Related
			array(
				'key'   => 'field_tab_industries',
				'label' => 'Industries / Related Services',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_industries_heading',
				'label' => 'Section Heading',
				'name'  => 'industries_heading',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_industries_subtitle',
				'label' => 'Section Subtitle',
				'name'  => 'industries_subtitle',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_industries_title',
				'label' => 'Main Title',
				'name'  => 'industries_title',
				'type'  => 'text',
			),

			// Tab: CTA
			array(
				'key'   => 'field_tab_cta',
				'label' => 'CTA Section',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_cta_heading',
				'label'         => 'CTA Heading',
				'name'          => 'cta_heading',
				'type'          => 'text',
				'default_value' => 'Ready to Ship Something Real?',
			),
			array(
				'key'           => 'field_cta_description',
				'label'         => 'CTA Description',
				'name'          => 'cta_description',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'From discovery to deploy, we build platforms that scale. No junior devs, no scope creep, just working software.',
			),
			array(
				'key'          => 'field_cta_button_link',
				'label'        => 'CTA Button Link',
				'name'         => 'cta_button_link',
				'type'         => 'url',
				'instructions' => 'Defaults to /contact-us/ if empty.',
			),

			// Tab: Card Features (for other pages)
			array(
				'key'          => 'field_tab_card_features',
				'label'        => 'Service Card Features',
				'type'         => 'tab',
				'instructions' => 'These features appear on the service card when displayed on other pages.',
			),
			array(
				'key'        => 'field_features',
				'label'      => 'Card Features',
				'name'       => 'features',
				'type'       => 'repeater',
				'layout'     => 'table',
				'sub_fields' => array(
					array(
						'key'   => 'field_feature_text',
						'label' => 'Feature Text',
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
		'hide_on_screen'        => array(
			0 => 'the_content',
		),
		'active'                => true,
	) );

endif;
