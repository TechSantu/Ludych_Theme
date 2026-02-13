<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$processes = $acf_ready ? get_field( 'packages_process_items', $post_id ) : array();

if ( empty( $processes ) ) {
	$processes = array(
		array(
			'title'       => 'Analyze',
			'description' => 'Assess your market position and identify growth opportunities',
			'icon'        => 'fa-search',
			'bg_class'    => 'bg-light-teal',
		),
		array(
			'title'       => 'Strategize',
			'description' => 'Develop data-driven marketing strategies tailored to your goals',
			'icon'        => 'fa-crosshairs',
			'bg_class'    => 'bg-light-orange',
		),
		array(
			'title'       => 'Execute',
			'description' => 'Launch multi-channel campaigns with precision and creativity',
			'icon'        => 'fa-cogs',
			'bg_class'    => 'bg-light-yellow',
		),
		array(
			'title'       => 'Optimize',
			'description' => 'Continuously improve performance based on real-time data',
			'icon'        => 'fa-chart-line',
			'bg_class'    => 'bg-light-orange',
		),
		array(
			'title'       => 'Scale',
			'description' => 'Expand successful campaigns to maximize ROI and growth',
			'icon'        => 'fa-rocket',
			'bg_class'    => 'bg-light-teal',
		),
	);
}
?>

<section class="section-process">
	<div class="custom-container">
		<div class="process-grid">
			<?php foreach ( $processes as $process ) : 
				$icon = $process['icon'] ?? 'fa-circle';
				$bg   = $process['bg_class'] ?? 'bg-light-teal';
			?>
			<div class="process-item">
				<div class="process-icon <?php echo esc_attr( $bg ); ?>">
					<i class="fas <?php echo esc_attr( $icon ); ?> fa-lg"></i>
				</div>
				<h3><?php echo esc_html( $process['title'] ); ?></h3>
				<p><?php echo esc_html( $process['description'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
