<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Template Name: Home Page
 */


global $post_id;
$post_id = get_the_ID();
?>

<?php get_header(); ?>

<?php
$parts = array(
	'banner',
	'about',
	'services',
	'our_work',
	'why_choose_us',
	'our_work_progress',
	'testimonials',
	'our_blog',
	'faq_section',
);
foreach ( $parts as $part ) {
	get_template_part( 'template-parts/Home/' . $part );
}
?>
<?php get_template_part( 'template-parts/common/contect' ); ?>
<?php
get_footer();
?>