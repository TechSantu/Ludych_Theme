<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$processes = array(
	array(
		'title'       => 'Analyze',
		'description' => 'Assess your market position and identify growth opportunities',
		'svg'         => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2D3748" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>',
		'bg_class'    => 'bg-light-teal',
	),
	array(
		'title'       => 'Strategize',
		'description' => 'Develop data-driven marketing strategies tailored to your goals',
		'svg'         => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2D3748" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',
		'bg_class'    => 'bg-light-orange',
	),
	array(
		'title'       => 'Execute',
		'description' => 'Launch multi-channel campaigns with precision and creativity',
		'svg'         => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2D3748" stroke-width="2"><path d="M4 11V1m16 10V1m-8 10V1M4 23v-5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5"/><path d="M9 15v-4a3 3 0 0 1 6 0v4"/></svg>',
		'bg_class'    => 'bg-light-yellow',
	),
	array(
		'title'       => 'Optimize',
		'description' => 'Continuously improve performance based on real-time data',
		'svg'         => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2D3748" stroke-width="2"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>',
		'bg_class'    => 'bg-light-orange',
	),
	array(
		'title'       => 'Scale',
		'description' => 'Expand successful campaigns to maximize ROI and growth',
		'svg'         => '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2D3748" stroke-width="2"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>',
		'bg_class'    => 'bg-light-teal',
	),
);
?>

<section class="section-process">
	<div class="custom-container">
		<div class="process-grid">
			<?php
			foreach ( $processes as $process ) :
				$bg = $process['bg_class'] ?? 'bg-light-teal';
				?>
			<div class="process-item">
				<div class="process-icon <?php echo esc_attr( $bg ); ?>">
					<?php
					if ( isset( $process['svg'] ) && ! empty( $process['svg'] ) ) {
						echo $process['svg'];
					} else {
						$icon = $process['icon'] ?? 'fa-circle';
						echo '<i class="fas ' . esc_attr( $icon ) . ' fa-lg"></i>';
					}
					?>
				</div>
				<h3><?php echo esc_html( $process['title'] ); ?></h3>
				<p><?php echo esc_html( $process['description'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
