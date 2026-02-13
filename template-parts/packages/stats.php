<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$stats = $acf_ready ? get_field( 'packages_stats', $post_id ) : array();

if ( empty( $stats ) ) {
	$stats = array(
		array(
			'val' => '$50M+',
			'lbl' => 'Revenue Generated',
		),
		array(
			'val' => '2M+',
			'lbl' => 'Leads Delivered',
		),
		array(
			'val' => '150+',
			'lbl' => 'Happy Clients',
		),
		array(
			'val' => '5+',
			'lbl' => 'Years Experience',
		),
	);
}
?>

<section class="section-results">
	<div class="custom-container">
		<div class="results-card">
			<div class="results-grid">
			<?php
			foreach ( $stats as $i => $stat ) :
				$class = 'result-stat';
				// Match index5.html classes: 
				// 2nd item (index 1) has 'border-x'
				// 3rd item (index 2) has 'border-right'
				if ( $i === 1 ) {
					$class .= ' border-x';
				} elseif ( $i === 2 ) {
					$class .= ' border-right';
				}
				?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<h2><?php echo esc_html( $stat['val'] ); ?></h2>
				<p><?php echo esc_html( $stat['lbl'] ); ?></p>
			</div>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
