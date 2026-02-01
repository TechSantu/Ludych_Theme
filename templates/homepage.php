<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Template Name: Home Page
 */

global $post_id;
$post_id = get_the_ID();
get_header();
?>

<?php
$parts = array(
	'Home/banner',
	'Home/about',
	'common/services',
	'common/our_work',
	'Home/why_choose_us',
	'common/our_work_progress',
	'Home/testimonials',
	'common/our_blog',
	'Home/faq_section',
	'common/contect',
);

foreach ( $parts as $part ) {
	get_template_part( 'template-parts/' . $part );
}
?>

<?php
get_footer();
