<?php
/**
 * Single Post Template for Services
 * 
 * Template for displaying single services posts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		
		global $post_id;
		$post_id = get_the_ID();
		
		$parts = array(
			'services/banner',
			'common/our_work_progress',
			'services/expertise',
			'services/industries',
			'common/our_work',
			'common/our_blog',
			'services/cta',
			'common/contect',
		);

		foreach ( $parts as $part ) {
			get_template_part( 'template-parts/' . $part );
		}
		
	endwhile;
endif;

get_footer();
