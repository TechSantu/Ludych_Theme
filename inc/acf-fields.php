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

			// Tab: Process Intro
			array(
				'key'   => 'field_tab_process_intro',
				'label' => 'Process Intro',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_process_intro_heading',
				'label'         => 'Section Heading',
				'name'          => 'process_intro_heading',
				'type'          => 'text',
				'default_value' => 'Our Process',
			),
			array(
				'key'           => 'field_process_intro_subtitle',
				'label'         => 'Section Subtitle (Icon Text)',
				'name'          => 'process_intro_subtitle',
				'type'          => 'text',
				'default_value' => 'Transforming Ideas Into Scalable Digital Success',
			),
			array(
				'key'           => 'field_process_intro_title',
				'label'         => 'Main Title',
				'name'          => 'process_intro_title',
				'type'          => 'textarea',
				'rows'          => 2,
				'default_value' => 'Discovery to Deploy.,<br> <span>Zero Surprises.</span>',
			),
			array(
				'key'           => 'field_process_intro_image',
				'label'         => 'Image',
				'name'          => 'process_intro_image',
				'type'          => 'image',
				'return_format' => 'array',
			),
			array(
				'key'           => 'field_process_intro_description',
				'label'         => 'Description',
				'name'          => 'process_intro_description',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => 'Ludych is a full-stack digital agency based in Chandler, AZ. We ship platforms, integrations, and data products—not just websites. Our team blends senior engineering talent with rigorous PMO discipline and QA rigor, delivering end-to-end services across custom development, data analytics, DevOps/SRE, digital marketing, and product consulting.',
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
			array(
				'key'        => 'field_industries_items',
				'label'      => 'Industry Items',
				'name'       => 'industries_items',
				'type'       => 'repeater',
				'layout'     => 'block',
				'sub_fields' => array(
					array(
						'key'   => 'field_industries_item_title',
						'label' => 'Title',
						'name'  => 'item_title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_industries_item_description',
						'label' => 'Description',
						'name'  => 'item_description',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'        => 'field_industries_item_features',
						'label'      => 'Features',
						'name'       => 'item_features',
						'type'       => 'repeater',
						'layout'     => 'table',
						'sub_fields' => array(
							array(
								'key'   => 'field_industries_item_feature_text',
								'label' => 'Feature Text',
								'name'  => 'feature_text',
								'type'  => 'text',
							),
						),
					),
				),
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
				'key'           => 'field_work_progress_title',
				'label'         => 'Process Main Title',
				'name'          => 'work_progress_title',
				'type'          => 'text',
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
				'key'           => 'field_blog_section_heading',
				'label'         => 'Blog Section Heading',
				'name'          => 'blog_section_heading',
				'type'          => 'text',
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

			// Tab: Strategies
			array(
				'key'   => 'field_ind_tab_strategies',
				'label' => 'Strategies',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_strategies_bg',
				'label'         => 'Background Image',
				'name'          => 'strategies_bg_image',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'           => 'field_strategies_heading',
				'label'         => 'Section Heading',
				'name'          => 'strategies_heading',
				'type'          => 'text',
				'default_value' => 'Smart Solutions',
			),
			array(
				'key'           => 'field_strategies_subtitle',
				'label'         => 'Section Subtitle',
				'name'          => 'strategies_subtitle',
				'type'          => 'text',
				'default_value' => 'Empowering Businesses with Smart Solutions',
			),
			array(
				'key'   => 'field_strategies_title',
				'label' => 'Main Title',
				'name'  => 'strategies_title',
				'type'  => 'textarea',
				'rows'  => 2,
			),
			array(
				'key'   => 'field_strategies_description',
				'label' => 'Description',
				'name'  => 'strategies_description',
				'type'  => 'wysiwyg',
				'rows'  => 6,
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
