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
			// Tab: Our Process
			array(
				'key'   => 'field_tab_process',
				'label' => 'Our Process',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_work_progress_heading',
				'label'         => 'Process Section Heading',
				'name'          => 'work_progress_heading',
				'type'          => 'text',
				'default_value' => 'Our Process',
			),
			array(
				'key'           => 'field_work_progress_small_title',
				'label'         => 'Process Small Title (Icon)',
				'name'          => 'work_progress_small_title',
				'type'          => 'text',
				'default_value' => 'Process',
			),
			array(
				'key'   => 'field_work_progress_title',
				'label' => 'Process Main Title',
				'name'  => 'work_progress_title',
				'type'  => 'text',
				'default_value' => 'Our Working Process',
			),
			array(
				'key'        => 'field_work_progress_steps',
				'label'      => 'Process Steps',
				'name'       => 'work_progress_steps',
				'type'       => 'repeater',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_step_icon',
						'label'         => 'Step Icon',
						'name'          => 'step_icon',
						'type'          => 'image',
						'return_format' => 'array',
					),
					array(
						'key'   => 'field_step_title',
						'label' => 'Step Title',
						'name'  => 'step_title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_step_description',
						'label' => 'Step Description',
						'name'  => 'step_description',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// Tab: Technology Stack
			array(
				'key'   => 'field_tab_tech_stack',
				'label' => 'Technology Stack',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_tech_stack_title_service', // Unique key
				'label'         => 'Tech Stack Title',
				'name'          => 'tech_stack_title',
				'type'          => 'text',
				'default_value' => 'Technology Stack',
			),
			array(
				'key'   => 'field_tech_stack_text_service', // Unique key
				'label' => 'Tech Stack Description',
				'name'  => 'tech_stack_text',
				'type'  => 'textarea',
				'rows'  => 3,
			),

			// Tab: News & Blog
			array(
				'key'   => 'field_tab_blog',
				'label' => 'News & Blog',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_blog_section_subtitle',
				'label'         => 'Blog Section Subtitle',
				'name'          => 'blog_section_subtitle',
				'type'          => 'text',
				'default_value' => 'News & Blog',
			),
			array(
				'key'           => 'field_blog_section_title',
				'label'         => 'Blog Section Small Title',
				'name'          => 'blog_section_title',
				'type'          => 'text',
				'default_value' => 'News & Blog',
			),
			array(
				'key'   => 'field_blog_section_heading',
				'label' => 'Blog Section Heading',
				'name'  => 'blog_section_heading',
				'type'  => 'text',
				'default_value' => 'Read Our Latest News',
			),

			// End of new fields
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

	// Industries Page Fields
	acf_add_local_field_group( array(
		'key'                   => 'group_industries_details',
		'title'                 => __( 'Industries Page Details', 'ludych-theme' ),
		'fields'                => array(
			// Tab: Banner
			array(
				'key'   => 'field_ind_tab_banner',
				'label' => 'Banner Section',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ind_banner_bg',
				'label'         => 'Banner Background Image',
				'name'          => 'banner_background_image',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'          => 'field_ind_banner_heading',
				'label'        => 'Banner Heading',
				'name'         => 'banner_heading',
				'type'         => 'text',
				'instructions' => 'Overrides Page Title if set.',
			),
			array(
				'key'          => 'field_ind_banner_eyebrow',
				'label'        => 'Banner Eyebrow / Subtitle',
				'name'         => 'banner_eyebrow',
				'type'         => 'text',
				'instructions' => 'Overrides Category Name if set.',
			),
			array(
				'key'   => 'field_ind_banner_desc',
				'label' => 'Banner Description',
				'name'  => 'banner_description',
				'type'  => 'textarea',
				'rows'  => 3,
			),

			// Tab: Solutions (Grid)
			array(
				'key'   => 'field_ind_tab_solutions',
				'label' => 'Solutions Grid',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_solutions_heading',
				'label'         => 'Section Heading',
				'name'          => 'solutions_heading',
				'type'          => 'text',
				'default_value' => 'Solutions',
			),
			array(
				'key'           => 'field_solutions_subtitle',
				'label'         => 'Section Subtitle',
				'name'          => 'solutions_subtitle',
				'type'          => 'text',
				'default_value' => 'Healthcare Solutions',
			),
			array(
				'key'           => 'field_solutions_title',
				'label'         => 'Main Title',
				'name'          => 'solutions_title',
				'type'          => 'text',
				'default_value' => 'Comprehensive Healthcare Solutions',
			),
			array(
				'key'        => 'field_solutions_items',
				'label'      => 'Solution Items',
				'name'       => 'solutions_items',
				'type'       => 'repeater',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'   => 'field_sol_title',
						'label' => 'Title',
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'           => 'field_sol_image',
						'label'         => 'Image',
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'url',
					),
					array(
						'key'   => 'field_sol_desc',
						'label' => 'Description',
						'name'  => 'description',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'        => 'field_sol_features',
						'label'      => 'Feature List',
						'name'       => 'features',
						'type'       => 'repeater',
						'layout'     => 'table',
						'sub_fields' => array(
							array(
								'key'   => 'field_sol_feature_text',
								'label' => 'Text',
								'name'  => 'text',
								'type'  => 'text',
							),
						),
					),
				),
			),

			// Tab: Journey
			array(
				'key'   => 'field_ind_tab_journey',
				'label' => 'Our Journey',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_journey_heading',
				'label'         => 'Section Heading',
				'name'          => 'journey_heading',
				'type'          => 'text',
				'default_value' => 'Journey',
			),
			array(
				'key'           => 'field_journey_subtitle',
				'label'         => 'Section Subtitle',
				'name'          => 'journey_subtitle',
				'type'          => 'text',
				'default_value' => 'Our Journey',
			),
			array(
				'key'           => 'field_journey_title',
				'label'         => 'Main Title',
				'name'          => 'journey_title',
				'type'          => 'text',
				'default_value' => 'End-to-End Patient Journey Optimization',
			),
			array(
				'key'           => 'field_journey_image',
				'label'         => 'Side Image',
				'name'          => 'journey_image',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'        => 'field_journey_items',
				'label'      => 'Journey Steps',
				'name'       => 'journey_items',
				'type'       => 'repeater',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'           => 'field_j_icon',
						'label'         => 'Icon / Image',
						'name'          => 'icon',
						'type'          => 'image',
						'return_format' => 'url',
					),
					array(
						'key'   => 'field_j_title',
						'label' => 'Title',
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_j_desc',
						'label' => 'Description',
						'name'  => 'description',
						'type'  => 'text',
					),
				),
			),

			// Tab: Detailed Solution
			array(
				'key'   => 'field_ind_tab_detail',
				'label' => 'Detailed Solution',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_detail_heading',
				'label'         => 'Section Heading',
				'name'          => 'detail_heading',
				'type'          => 'text',
				'default_value' => 'Solution',
			),
			array(
				'key'           => 'field_detail_subtitle',
				'label'         => 'Section Subtitle',
				'name'          => 'detail_subtitle',
				'type'          => 'text',
				'default_value' => 'Healthcare Solution',
			),
			array(
				'key'           => 'field_detail_title',
				'label'         => 'Main Title',
				'name'          => 'detail_title',
				'type'          => 'text',
				'default_value' => 'Healthcare Security & Compliance Excellence',
			),
			array(
				'key'           => 'field_detail_image',
				'label'         => 'Side Image',
				'name'          => 'detail_image',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'   => 'field_detail_description',
				'label' => 'Description',
				'name'  => 'detail_description',
				'type'  => 'textarea',
				'rows'  => 4,
			),
			array(
				'key'        => 'field_detail_features',
				'label'      => 'Bullet Points',
				'name'       => 'detail_features',
				'type'       => 'repeater',
				'layout'     => 'table',
				'sub_fields' => array(
					array(
						'key'   => 'field_df_text',
						'label' => 'Text',
						'name'  => 'text',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'        => 'field_detail_counters',
				'label'      => 'Counters (Bottom)',
				'name'       => 'detail_counters',
				'type'       => 'repeater',
				'layout'     => 'table',
				'sub_fields' => array(
					array(
						'key'   => 'field_dc_value',
						'label' => 'Value',
						'name'  => 'value',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_dc_suffix',
						'label' => 'Suffix',
						'name'  => 'suffix',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_dc_label',
						'label' => 'Label',
						'name'  => 'label',
						'type'  => 'text',
					),
					array(
						'key'           => 'field_dc_style',
						'label'         => 'Style Class',
						'name'          => 'style_class',
						'type'          => 'select',
						'choices'       => array(
							'bg-blue' => 'Blue Background',
							'bg-dark' => 'Dark Background',
						),
						'default_value' => 'bg-blue',
					),
				),
			),

			// Tab: Measurable outcomes
			array(
				'key'   => 'field_ind_tab_measurable',
				'label' => 'Measurable Outcomes',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_measurable_bg',
				'label'         => 'Background Image',
				'name'          => 'measurable_bg_image',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'           => 'field_measurable_heading',
				'label'         => 'Section Heading',
				'name'          => 'measurable_heading',
				'type'          => 'text',
				'default_value' => 'Measurable',
			),
			array(
				'key'           => 'field_measurable_subtitle',
				'label'         => 'Section Subtitle',
				'name'          => 'measurable_subtitle',
				'type'          => 'text',
				'default_value' => 'Measurable',
			),
			array(
				'key'           => 'field_measurable_title',
				'label'         => 'Main Title',
				'name'          => 'measurable_title',
				'type'          => 'text',
				'default_value' => 'Measurable Healthcare Outcomes',
			),
			array(
				'key'        => 'field_measurable_counters',
				'label'      => 'Outcome Counters',
				'name'       => 'measurable_counters',
				'type'       => 'repeater',
				'layout'     => 'table',
				'sub_fields' => array(
					array(
						'key'   => 'field_mc_value',
						'label' => 'Value',
						'name'  => 'value',
						'type'  => 'number',
					),
					array(
						'key'           => 'field_mc_decimals',
						'label'         => 'Decimals',
						'name'          => 'decimals',
						'type'          => 'number',
						'default_value' => 0,
					),
					array(
						'key'   => 'field_mc_suffix',
						'label' => 'Suffix',
						'name'  => 'suffix',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_mc_label',
						'label' => 'Label',
						'name'  => 'label',
						'type'  => 'text',
					),
					array(
						'key'     => 'field_mc_color',
						'label'   => 'Border Color',
						'name'    => 'border_color',
						'type'    => 'select',
						'choices' => array(
							'border-blue'  => 'Blue',
							'border-pink'  => 'Pink',
							'border-cyan'  => 'Cyan',
							'border-green' => 'Green',
						),
					),
				),
			),

			// Tab: News & Blog (Partial - Heading/Titles only)
			array(
				'key'   => 'field_ind_tab_blog',
				'label' => 'News & Blog',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ind_blog_subtitle',
				'label'         => 'Blog Section Subtitle',
				'name'          => 'blog_section_subtitle',
				'type'          => 'text',
				'default_value' => 'News & Blog',
			),
			array(
				'key'           => 'field_ind_blog_title',
				'label'         => 'Blog Section Small Title',
				'name'          => 'blog_section_title',
				'type'          => 'text',
				'default_value' => 'News & Blog',
			),
			array(
				'key'           => 'field_ind_blog_heading',
				'label'         => 'Blog Section Heading',
				'name'          => 'blog_section_heading',
				'type'          => 'text',
				'default_value' => 'Our Latest News & Blog',
			),

			// Tab: CTA
			array(
				'key'   => 'field_ind_tab_cta',
				'label' => 'CTA Section',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ind_cta_heading',
				'label'         => 'CTA Heading',
				'name'          => 'cta_heading',
				'type'          => 'text',
				'default_value' => 'Ready to Ship Something Real?',
			),
			array(
				'key'           => 'field_ind_cta_desc',
				'label'         => 'CTA Description',
				'name'          => 'cta_description',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'From discovery to deploy, we build platforms that scale. No junior devs, no scope creep, just working software.',
			),
			array(
				'key'   => 'field_ind_cta_link',
				'label' => 'CTA Button Link',
				'name'  => 'cta_button_link',
				'type'  => 'url',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'industries',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
	) );

endif;
