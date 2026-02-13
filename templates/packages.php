<?php
/*
Template Name: Packages Page
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$post_id = get_the_ID();

wp_enqueue_style(
	'theme-packages-style',
	get_template_directory_uri() . '/assets/css/packages.css',
	array( 'theme-style' ),
	'1.0'
);

get_header();

get_template_part( 'template-parts/packages/hero' );
get_template_part( 'template-parts/packages/process' );
get_template_part( 'template-parts/packages/integrated-solutions' );
get_template_part( 'template-parts/packages/services-grid' );
get_template_part( 'template-parts/packages/stats' );
get_template_part( 'template-parts/packages/pricing-cards' );
get_template_part( 'template-parts/packages/inclusions' );
get_template_part( 'template-parts/packages/faq' );
get_template_part( 'template-parts/packages/cta' );

get_footer();
