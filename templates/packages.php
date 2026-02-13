<?php
/*
Template Name: Packages Page
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$post_id = get_the_ID();

get_header();

// Include Google Fonts (Inria Serif & Roboto)
echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
echo '<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@400;700&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">';

// Include Packages CSS
echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/assets/css/packages.css">';

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
