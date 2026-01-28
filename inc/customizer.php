<?php
if (!defined('ABSPATH')) {
    exit;
}

function ludych_customize_register( $wp_customize ) {
    $wp_customize->add_section(
        'ludych_header_section',
        array(
            'title'       => __('Header Settings', 'ludych-theme'),
            'priority'    => 30,
            'description' => __('Controls for the main header area.', 'ludych-theme'),
        )
    );

    $wp_customize->add_setting(
        'ludych_lets_connect_label',
        array(
            'default'           => __("LET's CONNECT", 'ludych-theme'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'ludych_lets_connect_label',
        array(
            'label'   => __("LET's CONNECT Button Label", 'ludych-theme'),
            'section' => 'ludych_header_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_lets_connect_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'ludych_lets_connect_url',
        array(
            'label'   => __("LET's CONNECT Button URL", 'ludych-theme'),
            'section' => 'ludych_header_section',
            'type'    => 'url',
        )
    );

    $wp_customize->add_section(
        'ludych_footer_section',
        array(
            'title'       => __('Footer Settings', 'ludych-theme'),
            'priority'    => 40,
            'description' => __('Controls for the main footer area.', 'ludych-theme'),
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_logo',
        array(
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'ludych_footer_logo',
            array(
                'label'    => __('Footer Logo', 'ludych-theme'),
                'section'  => 'ludych_footer_section',
                'mime_type'=> 'image',
            )
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_description',
        array(
            'default'           => __('Ludych was born from a simple realization: businesses needed partners who could ship working software and measurable growth—not just reports. Founded by Joseph Appleton, we\'re a full-stack agency delivering custom development, data analytics, DevOps, digital marketing, PMO, and QA. Build boldly. Grow smart.', 'ludych-theme'),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_description',
        array(
            'label'   => __('Footer Description', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_email',
        array(
            'default'           => 'support@ludych.com',
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_email',
        array(
            'label'   => __('Footer Email', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_skype',
        array(
            'default'           => 'Ludych',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_skype',
        array(
            'label'   => __('Footer Skype', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office1_title',
        array(
            'default'           => __('New York HQ', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_office1_title',
        array(
            'label'   => __('Office 1 Title', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office1_address',
        array(
            'default'           => __('123 Digital Avenue New York, NY 10001', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_office1_address',
        array(
            'label'   => __('Office 1 Address', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office1_phone',
        array(
            'default'           => __('+1 (555) 123-4567', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_office1_phone',
        array(
            'label'   => __('Office 1 Phone', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office1_image',
        array(
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'ludych_footer_office1_image',
            array(
                'label'     => __('Office 1 Image', 'ludych-theme'),
                'section'   => 'ludych_footer_section',
                'mime_type' => 'image',
            )
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office2_title',
        array(
            'default'           => __('San Francisco', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_office2_title',
        array(
            'label'   => __('Office 2 Title', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office2_address',
        array(
            'default'           => __('456 Tech Street San Francisco, CA 94102', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_office2_address',
        array(
            'label'   => __('Office 2 Address', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office2_phone',
        array(
            'default'           => __('+1 (555) 987-6543', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_office2_phone',
        array(
            'label'   => __('Office 2 Phone', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_office2_image',
        array(
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'ludych_footer_office2_image',
            array(
                'label'     => __('Office 2 Image', 'ludych-theme'),
                'section'   => 'ludych_footer_section',
                'mime_type' => 'image',
            )
        )
    );

    $social_defaults = array(
        'ludych_footer_facebook'  => '#',
        'ludych_footer_twitter'   => '#',
        'ludych_footer_google'    => '#',
        'ludych_footer_pinterest' => '#',
    );

    foreach ( $social_defaults as $setting_id => $default ) {
        $wp_customize->add_setting(
            $setting_id,
            array(
                'default'           => $default,
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $label_key = strtoupper( str_replace( array('ludych_footer_', '_'), array('', ' '), $setting_id ) );

        $wp_customize->add_control(
            $setting_id,
            array(
                'label'   => sprintf( __('%s URL', 'ludych-theme'), $label_key ),
                'section' => 'ludych_footer_section',
                'type'    => 'url',
            )
        );
    }

    $wp_customize->add_setting(
        'ludych_footer_copyright_name',
        array(
            'default'           => __('Ludych Digital Agency', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_copyright_name',
        array(
            'label'   => __('Copyright Name', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'ludych_footer_copyright_suffix',
        array(
            'default'           => __('All rights reserved.', 'ludych-theme'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'ludych_footer_copyright_suffix',
        array(
            'label'   => __('Copyright Suffix', 'ludych-theme'),
            'section' => 'ludych_footer_section',
            'type'    => 'text',
        )
    );
}
add_action('customize_register', 'ludych_customize_register');

