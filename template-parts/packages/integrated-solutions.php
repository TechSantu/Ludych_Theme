<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$info_img = $acf_ready ? get_field( 'packages_info_image', $post_id ) : '';
if ( is_array( $info_img ) ) {
	$info_img = $info_img['url'] ?? '';
}
$info_img = $info_img ?: 'https://www.ludych.com/lovable-uploads/professional-headshot.jpg'; // Ideally replace with local asset if available

$stat_val = ( $acf_ready ? get_field( 'packages_info_stat_val', $post_id ) : '' ) ?: '$1.8M';
$stat_lbl = ( $acf_ready ? get_field( 'packages_info_stat_lbl', $post_id ) : '' ) ?: 'Customer Acquisition Cost Ratio';
$btn_text = ( $acf_ready ? get_field( 'packages_info_btn_text', $post_id ) : '' ) ?: 'LET\'S WORK TOGETHER';
$btn_url  = ( $acf_ready ? get_field( 'packages_info_btn_url', $post_id ) : '' ) ?: home_url('/contact-us/');

$features = $acf_ready ? get_field( 'packages_info_features', $post_id ) : array();
if ( empty( $features ) ) {
	$features = array(
		array(
			'title' => 'Integrated Digital Marketing Solutions',
			'desc'  => 'We are a one-stop-shop for digital marketing, offering integrated solutions from start to finish that support your entire customer journey.',
			'icon'  => 'fa-layer-group',
		),
		array(
			'title' => 'Deep Expertise Across Marketing Disciplines',
			'desc'  => 'Get access to a purpose-led team of problem-solvers who possess the in-depth knowledge and experience to tackle any challenge.',
			'icon'  => 'fa-brain',
		),
		array(
			'title' => 'Discover Your Partner in Growth',
			'desc'  => 'For more than two decades, we\'ve unlocked the growth potential of our clients through effective, full-service digital marketing strategies.',
			'icon'  => 'fa-handshake',
		),
	);
}
?>

<section class="section-info dark">
	<div class="custom-container">
		<div class="info-grid">
			<div class="info-image-container">
				<img src="<?php echo esc_url( $info_img ); ?>" alt="Marketing Specialist" class="consultant-img">
				<div class="stat-badge floating">
					<div class="val"><?php echo esc_html( $stat_val ); ?></div>
					<div class="lbl"><?php echo esc_html( $stat_lbl ); ?></div>
				</div>
			</div>
			<div class="info-content">
				<?php foreach ( $features as $feature ) : ?>
				<div class="info-feature">
					<div class="feature-icon-circle orange">
						<i class="fas <?php echo esc_attr( $feature['icon'] ?? 'fa-check' ); ?>"></i>
					</div>
					<div class="feature-text">
						<h3><?php echo esc_html( $feature['title'] ); ?></h3>
						<p><?php echo esc_html( $feature['desc'] ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
				<a href="<?php echo esc_url( $btn_url ); ?>" class="btn-yellow info-btn"><?php echo esc_html( $btn_text ); ?></a>
			</div>
		</div>
	</div>
</section>
