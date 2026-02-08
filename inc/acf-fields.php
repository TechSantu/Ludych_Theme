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

	acf_add_local_field_group( array(
		'key'                   => 'group_case_study_details',
		'title'                 => __( 'Case Study Details', 'ludych-theme' ),
		'fields'                => array(
			array(
				'key'   => 'field_cs_tab_hero',
				'label' => 'Hero',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_case_study_hero_background',
				'label'         => 'Hero Background Image',
				'name'          => 'case_study_hero_background',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'           => 'field_case_study_kicker',
				'label'         => 'Kicker',
				'name'          => 'case_study_kicker',
				'type'          => 'text',
				'default_value' => 'Ads Case Study',
			),
			array(
				'key'           => 'field_case_study_subtitle',
				'label'         => 'Subtitle',
				'name'          => 'case_study_subtitle',
				'type'          => 'text',
				'default_value' => 'Self Reliance Outfitters',
			),
			array(
				'key'           => 'field_case_study_stat_value',
				'label'         => 'Hero Stat Value',
				'name'          => 'case_study_stat_value',
				'type'          => 'text',
				'default_value' => '161%',
			),
			array(
				'key'           => 'field_case_study_stat_label',
				'label'         => 'Hero Stat Label',
				'name'          => 'case_study_stat_label',
				'type'          => 'text',
				'default_value' => 'Increase in Revenue',
			),

			array(
				'key'   => 'field_cs_tab_partner',
				'label' => 'Partner Overview',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_case_study_about_title',
				'label'         => 'Section Title',
				'name'          => 'case_study_about_title',
				'type'          => 'text',
				'default_value' => 'About Our Partner',
			),
			array(
				'key'           => 'field_case_study_about_small',
				'label'         => 'Small Title',
				'name'          => 'case_study_about_small',
				'type'          => 'text',
				'default_value' => 'Partner Overview',
			),
			array(
				'key'           => 'field_case_study_who_title',
				'label'         => 'Who Title',
				'name'          => 'case_study_who_title',
				'type'          => 'text',
				'default_value' => 'Who They Are',
			),
			array(
				'key'           => 'field_case_study_who_text',
				'label'         => 'Who Text',
				'name'          => 'case_study_who_text',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => 'An American-owned premium outdoor sporting goods company focused on bushcraft and self-reliance. The brand offers 500+ products designed to help outdoor enthusiasts thrive in the field.',
			),
			array(
				'key'           => 'field_case_study_what_title',
				'label'         => 'What Title',
				'name'          => 'case_study_what_title',
				'type'          => 'text',
				'default_value' => 'What They Do',
			),
			array(
				'key'           => 'field_case_study_what_text',
				'label'         => 'What Text',
				'name'          => 'case_study_what_text',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => 'They sell camping gear, hunting equipment, survival knives, and apparel. The company also runs survival and specialty classes and publishes guides and booklets for their community.',
			),

			array(
				'key'   => 'field_cs_tab_problem',
				'label' => 'Problem',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_case_study_problem_title',
				'label'         => 'Problem Title',
				'name'          => 'case_study_problem_title',
				'type'          => 'text',
				'default_value' => 'The Problem',
			),
			array(
				'key'           => 'field_case_study_problem',
				'label'         => 'Problem Content',
				'name'          => 'case_study_problem',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => 'Before partnering with our team, the brand had never used an agency for paid media. Revenue and sales had plateaued, and leadership wanted growth through search and paid media. Earlier Facebook campaigns had triggered policy issues, which left their account restricted and unable to scale.',
			),

			array(
				'key'   => 'field_cs_tab_solution',
				'label' => 'Solution',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_case_study_solution_title',
				'label'         => 'Solution Title',
				'name'          => 'case_study_solution_title',
				'type'          => 'text',
				'default_value' => 'The Solution',
			),
			array(
				'key'           => 'field_case_study_solution',
				'label'         => 'Solution Content',
				'name'          => 'case_study_solution',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => 'We audited the account and traced the restriction to products flagged as potentially harmful. By refining the catalog and removing restricted items from paid placements, we lifted the policy block. We rebuilt the program with prospecting and remarketing audiences and launched a Facebook Shop to showcase products organically. We then applied our A.C.E. framework to scale.',
			),
			array(
				'key'          => 'field_case_study_solution_tabs',
				'label'        => 'Solution Tabs',
				'name'         => 'case_study_solution_tabs',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add Tab',
				'sub_fields'   => array(
					array(
						'key'   => 'field_case_study_solution_tab_title',
						'label' => 'Tab Title',
						'name'  => 'tab_title',
						'type'  => 'text',
					),
					array(
						'key'          => 'field_case_study_solution_tab_content',
						'label'        => 'Tab Content',
						'name'         => 'tab_content',
						'type'         => 'wysiwyg',
						'tabs'         => 'all',
						'toolbar'      => 'basic',
						'media_upload' => 0,
					),
				),
			),

			array(
				'key'   => 'field_cs_tab_results',
				'label' => 'Results',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_case_study_results_title',
				'label'         => 'Results Title',
				'name'          => 'case_study_results_title',
				'type'          => 'text',
				'default_value' => 'Results',
			),
			array(
				'key'           => 'field_case_study_results',
				'label'         => 'Results Content',
				'name'          => 'case_study_results',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => 'Results below are shown with client permission for the 2021 calendar year. The engagement began in February 2021. Q1 and Q2 produced strong revenue and ROAS after resolving policy issues and aligning to best practices. Q3 started well but dropped sharply due to iOS 14 attribution changes. We adjusted measurement to account for lost tracking. In Q4, we added Google Ads to capture incremental demand, leading to a 161% revenue increase compared to Q1 2021.',
			),
			array(
				'key'           => 'field_case_study_results_table_html',
				'label'         => 'Results Table (WYSIWYG)',
				'name'          => 'case_study_results_table_html',
				'type'          => 'wysiwyg',
				'tabs'          => 'all',
				'toolbar'       => 'basic',
				'media_upload'  => 0,
				'default_value' => '<table class="table table-bordered"><tbody><tr><td>Year 2021</td><td>Spend</td><td>Purchases</td><td>Revenue</td><td>ROAS</td></tr><tr><td>Q1</td><td>$1,966.29</td><td>1,034</td><td>$81,939.40</td><td>41.67</td></tr><tr><td>Q2</td><td>$4,428.00</td><td>1,373</td><td>$112,794.72</td><td>25.47</td></tr><tr><td>Q3<br><small>(iOS 14 changes)</small></td><td>$4,419.93</td><td>916</td><td>$69,038.54</td><td>15.61</td></tr><tr><td>Q4</td><td>$8,614.49</td><td>2,093</td><td>$213,717.45</td><td>24.80</td></tr></tbody></table>',
			),


			array(
				'key'   => 'field_cs_tab_cta',
				'label' => 'CTA',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_case_study_cta_button',
				'label' => 'CTA Button',
				'name'  => 'case_study_cta_button',
				'type'  => 'link',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'case_study',
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

	acf_add_local_field_group( array(
		'key'                   => 'group_about_page_fields',
		'title'                 => __( 'About Page Fields', 'ludych-theme' ),
		'fields'                => array(
			array(
				'key'   => 'field_about_tab_hero',
				'label' => 'Hero',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_about_hero_background',
				'label'         => 'Hero Background Image',
				'name'          => 'about_hero_background',
				'type'          => 'image',
				'return_format' => 'url',
			),
			array(
				'key'   => 'field_about_hero_kicker',
				'label' => 'Hero Kicker',
				'name'  => 'about_hero_kicker',
				'type'  => 'text',
			),
			array(
				'key'           => 'field_about_hero_title',
				'label'         => 'Hero Title (HTML allowed)',
				'name'          => 'about_hero_title',
				'type'          => 'textarea',
				'instructions'  => 'You can include <span> for styling.',
				'rows'          => 2,
				'new_lines'     => '',
			),
			array(
				'key'       => 'field_about_hero_subtitle',
				'label'     => 'Hero Subtitle',
				'name'      => 'about_hero_subtitle',
				'type'      => 'textarea',
				'rows'      => 2,
				'new_lines' => '',
			),

			array(
				'key'   => 'field_about_tab_why',
				'label' => 'Why Choose Us',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_why_title',
				'label' => 'Section Title',
				'name'  => 'about_why_title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_about_why_kicker',
				'label' => 'Kicker Text',
				'name'  => 'about_why_kicker',
				'type'  => 'text',
			),
			array(
				'key'           => 'field_about_why_heading',
				'label'         => 'Heading (HTML allowed)',
				'name'          => 'about_why_heading',
				'type'          => 'textarea',
				'instructions'  => 'You can include <span> for styling.',
				'rows'          => 2,
				'new_lines'     => '',
			),
			array(
				'key'          => 'field_about_why_items',
				'label'        => 'Why Items',
				'name'         => 'about_why_items',
				'type'         => 'repeater',
				'button_label' => 'Add Item',
				'sub_fields'   => array(
					array(
						'key'   => 'field_about_why_item_title',
						'label' => 'Title',
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'           => 'field_about_why_item_image',
						'label'         => 'Image',
						'name'          => 'image',
						'type'          => 'image',
						'return_format' => 'url',
					),
					array(
						'key'       => 'field_about_why_item_description',
						'label'     => 'Description',
						'name'      => 'description',
						'type'      => 'textarea',
						'rows'      => 3,
						'new_lines' => '',
					),
					array(
						'key'   => 'field_about_why_item_link',
						'label' => 'Link',
						'name'  => 'link',
						'type'  => 'link',
					),
				),
			),

			array(
				'key'   => 'field_about_tab_story',
				'label' => 'Our Story',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_story_title',
				'label' => 'Section Title',
				'name'  => 'about_story_title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_about_story_kicker',
				'label' => 'Kicker Text',
				'name'  => 'about_story_kicker',
				'type'  => 'text',
			),
			array(
				'key'           => 'field_about_story_heading',
				'label'         => 'Heading (HTML allowed)',
				'name'          => 'about_story_heading',
				'type'          => 'textarea',
				'instructions'  => 'You can include <span> for styling.',
				'rows'          => 2,
				'new_lines'     => '',
			),
			array(
				'key'          => 'field_about_story_content',
				'label'        => 'Story Content',
				'name'         => 'about_story_content',
				'type'         => 'wysiwyg',
				'tabs'         => 'all',
				'toolbar'      => 'basic',
				'media_upload' => 0,
			),
			array(
				'key'   => 'field_about_story_author_name',
				'label' => 'Author Name',
				'name'  => 'about_story_author_name',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_about_story_author_title',
				'label' => 'Author Title',
				'name'  => 'about_story_author_title',
				'type'  => 'text',
			),
			array(
				'key'           => 'field_about_story_image',
				'label'         => 'Story Image',
				'name'          => 'about_story_image',
				'type'          => 'image',
				'return_format' => 'url',
			),

			array(
				'key'   => 'field_about_tab_values',
				'label' => 'Values',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_values_title',
				'label' => 'Section Title',
				'name'  => 'about_values_title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_about_values_kicker',
				'label' => 'Kicker Text',
				'name'  => 'about_values_kicker',
				'type'  => 'text',
			),
			array(
				'key'           => 'field_about_values_heading',
				'label'         => 'Heading (HTML allowed)',
				'name'          => 'about_values_heading',
				'type'          => 'textarea',
				'instructions'  => 'You can include <span> and <br> for styling.',
				'rows'          => 2,
				'new_lines'     => '',
			),
			array(
				'key'          => 'field_about_values_items',
				'label'        => 'Values Items',
				'name'         => 'about_values_items',
				'type'         => 'repeater',
				'button_label' => 'Add Item',
				'sub_fields'   => array(
					array(
						'key'   => 'field_about_values_item_title',
						'label' => 'Title (HTML allowed)',
						'name'  => 'title',
						'type'  => 'textarea',
						'rows'  => 2,
					),
					array(
						'key'           => 'field_about_values_item_icon',
						'label'         => 'Icon',
						'name'          => 'icon',
						'type'          => 'image',
						'return_format' => 'url',
					),
					array(
						'key'       => 'field_about_values_item_description',
						'label'     => 'Description',
						'name'      => 'description',
						'type'      => 'textarea',
						'rows'      => 3,
						'new_lines' => '',
					),
				),
			),

			array(
				'key'   => 'field_about_tab_mission',
				'label' => 'Mission & Vision',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_mission_title',
				'label' => 'Mission Title',
				'name'  => 'about_mission_title',
				'type'  => 'text',
			),
			array(
				'key'       => 'field_about_mission_content',
				'label'     => 'Mission Content',
				'name'      => 'about_mission_content',
				'type'      => 'textarea',
				'rows'      => 3,
				'new_lines' => '',
			),
			array(
				'key'   => 'field_about_vision_title',
				'label' => 'Vision Title',
				'name'  => 'about_vision_title',
				'type'  => 'text',
			),
			array(
				'key'       => 'field_about_vision_content',
				'label'     => 'Vision Content',
				'name'      => 'about_vision_content',
				'type'      => 'textarea',
				'rows'      => 3,
				'new_lines' => '',
			),
			array(
				'key'   => 'field_about_value_title',
				'label' => 'Value Title',
				'name'  => 'about_value_title',
				'type'  => 'text',
			),
			array(
				'key'          => 'field_about_value_content',
				'label'        => 'Value Content (HTML allowed)',
				'name'         => 'about_value_content',
				'type'         => 'textarea',
				'instructions' => 'You can include <strong> and <br> for formatting.',
				'rows'         => 4,
				'new_lines'    => '',
			),

			array(
				'key'   => 'field_about_tab_blog',
				'label' => 'Blog Section',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_blog_title',
				'label' => 'Section Title',
				'name'  => 'about_blog_title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_about_blog_kicker',
				'label' => 'Kicker Text',
				'name'  => 'about_blog_kicker',
				'type'  => 'text',
			),
			array(
				'key'           => 'field_about_blog_heading',
				'label'         => 'Heading (HTML allowed)',
				'name'          => 'about_blog_heading',
				'type'          => 'textarea',
				'instructions'  => 'You can include <span> for styling.',
				'rows'          => 2,
				'new_lines'     => '',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page',
					'operator' => '==',
					'value'    => '530',
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
