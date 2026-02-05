<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Template Name: Contact Page
 */

global $post_id;
$post_id = get_the_ID();

get_header();
?>

<?php
get_template_part( 'template-parts/common/contact-banner' );
?>

<?php
get_template_part( 'template-parts/common/contact-us' );
get_template_part( 'template-parts/common/contact-expertise' );
?>

<?php
get_footer();
