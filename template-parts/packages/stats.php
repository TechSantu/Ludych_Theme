<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$stats = $acf_ready ? get_field( 'packages_stats', $post_id ) : array();

if ( empty( $stats ) ) {
	$stats = array(
		array( 'val' => '$50M+', 'lbl' => 'Revenue Generated' ),
		array( 'val' => '2M+', 'lbl' => 'Leads Delivered' ),
		array( 'val' => '150+', 'lbl' => 'Happy Clients' ),
		array( 'val' => '5+', 'lbl' => 'Years Experience' ),
	);
}
?>

<section class="section-results">
	<div class="custom-container">
		<div class="results-card">
			<div class="results-grid">
				<?php 
				$count = count( $stats );
				$i = 0;
				foreach ( $stats as $stat ) : 
					$border_class = '';
					if ( $i < $count - 1 ) {
						// Add border logic if needed, simplistically implemented via CSS classes in original design
						// The original design had classes like 'border-x', 'border-right'.
						// We can just rely on CSS :not(:last-child) or specific classes.
						// For now, let's just output divs and handle borders in CSS.
					}
					// Mapping classes from original HTML roughly
					$class = 'result-stat';
					if ( $i == 1 ) $class .= ' border-x'; // roughly middle
					if ( $i == 2 ) $class .= ' border-right'; 
					
					// Better approach: use CSS nth-child in the new CSS file.
				?>
				<div class="result-stat">
					<h2><?php echo esc_html( $stat['val'] ); ?></h2>
					<p><?php echo esc_html( $stat['lbl'] ); ?></p>
				</div>
				<?php $i++; endforeach; ?>
			</div>
		</div>
	</div>
</section>
