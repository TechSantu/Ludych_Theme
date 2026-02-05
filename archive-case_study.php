<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php
get_template_part( 'template-parts/common/case-studies-banner' );
get_template_part( 'template-parts/common/case-studies-list' );
?>

<?php
get_footer();
