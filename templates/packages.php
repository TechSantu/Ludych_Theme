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
?>
<?php
get_template_part( 'template-parts/packages/hero' );
get_template_part( 'template-parts/packages/intro' );
get_template_part( 'template-parts/packages/pricing-cards' );
get_template_part( 'template-parts/packages/comparison' );
get_template_part( 'template-parts/packages/faq' );

get_footer();
?>