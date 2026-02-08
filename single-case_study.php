<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$post_id = get_the_ID();

get_header();

$cs_get_field = function ( $key, $default = '' ) use ( $post_id ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $key, $post_id );
		if ( $value !== null && $value !== '' ) {
			return $value;
		}
	}
	$meta = get_post_meta( $post_id, $key, true );
	if ( $meta !== '' ) {
		return $meta;
	}
	return $default;
};

$hero_bg = $cs_get_field( 'case_study_hero_background' );
if ( empty( $hero_bg ) ) {
	$hero_bg = get_the_post_thumbnail_url( $post_id, 'full' );
}
if ( empty( $hero_bg ) ) {
	$hero_bg = get_template_directory_uri() . '/assets/images/services-bg.jpg';
}

$kicker      = $cs_get_field( 'case_study_kicker', 'Case Study' );
$subtitle    = $cs_get_field( 'case_study_subtitle' );
$stat_value  = $cs_get_field( 'case_study_stat_value' );
$stat_label  = $cs_get_field( 'case_study_stat_label', 'Primary Result' );
$about_title = $cs_get_field( 'case_study_about_title', 'About Our Partner' );
$about_small = $cs_get_field( 'case_study_about_small', 'Partner Overview' );
$who_title   = $cs_get_field( 'case_study_who_title', 'Who They Are' );
$who_text    = $cs_get_field( 'case_study_who_text' );
$what_title  = $cs_get_field( 'case_study_what_title', 'What They Do' );
$what_text   = $cs_get_field( 'case_study_what_text' );
$problem_title = $cs_get_field( 'case_study_problem_title', 'The Problem' );
$problem     = $cs_get_field( 'case_study_problem' );
$solution_title = $cs_get_field( 'case_study_solution_title', 'The Solution' );
$solution    = $cs_get_field( 'case_study_solution' );
$solution_tabs = function_exists( 'get_field' ) ? get_field( 'case_study_solution_tabs', $post_id ) : array();
if ( ! is_array( $solution_tabs ) ) {
	$solution_tabs = array();
}
$results_title = $cs_get_field( 'case_study_results_title', 'Results' );
$results     = $cs_get_field( 'case_study_results' );
$cta_button       = function_exists( 'get_field' ) ? get_field( 'case_study_cta_button', $post_id ) : null;

$list_from_text = function ( $text ) {
	if ( ! $text ) {
		return array();
	}
	$lines = preg_split( '/\r\n|\r|\n/', wp_strip_all_tags( $text ) );
	$items = array();
	foreach ( $lines as $line ) {
		$line = trim( $line );
		if ( $line !== '' ) {
			$items[] = $line;
		}
	}
	return $items;
};

$ace_assets_text      = $cs_get_field( 'case_study_ace_assets' );
$ace_control_text     = $cs_get_field( 'case_study_ace_control' );
$ace_experiment_text  = $cs_get_field( 'case_study_ace_experimentation' );
$ace_assets_items     = $list_from_text( $ace_assets_text );
$ace_control_items    = $list_from_text( $ace_control_text );
$ace_experiment_items = $list_from_text( $ace_experiment_text );

$results_table = function_exists( 'get_field' ) ? get_field( 'case_study_results_table', $post_id ) : array();
if ( ! is_array( $results_table ) ) {
	$results_table = array();
}
$results_columns = function_exists( 'get_field' ) ? get_field( 'case_study_results_columns', $post_id ) : array();
if ( ! is_array( $results_columns ) ) {
	$results_columns = array();
}
$results_rows = function_exists( 'get_field' ) ? get_field( 'case_study_results_rows', $post_id ) : array();
if ( ! is_array( $results_rows ) ) {
	$results_rows = array();
}

$selected_testimonials = function_exists( 'get_field' ) ? get_field( 'case_study_testimonials', $post_id ) : array();
if ( ! is_array( $selected_testimonials ) ) {
	$selected_testimonials = array();
}
?>

<section class="case-study-hero with-overlay" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
	<div class="custom-container">
		<div class="case-study-hero__grid">
			<div class="case-study-hero__content">
				<?php if ( $kicker ) : ?>
					<span class="case-study-kicker"><?php echo esc_html( $kicker ); ?></span>
				<?php endif; ?>
				<h1><?php the_title(); ?></h1>
				<?php if ( $subtitle ) : ?>
					<p class="case-study-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
				<div class="case-study-hero__cta">
					<?php
					$default_cta_url   = home_url( '/contact/' );
					$default_cta_title = 'Free Action Plan';
					if ( is_array( $cta_button ) && ! empty( $cta_button['url'] ) ) :
						?>
						<a href="<?php echo esc_url( $cta_button['url'] ); ?>" target="<?php echo esc_attr( $cta_button['target'] ? $cta_button['target'] : '_self' ); ?>" class="globalBtnDark">
							<span><?php echo esc_html( $cta_button['title'] ? $cta_button['title'] : $default_cta_title ); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( $default_cta_url ); ?>" class="globalBtnDark">
							<span><?php echo esc_html( $default_cta_title ); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $stat_value ) : ?>
				<div class="case-study-hero__stat">
					<div class="case-study-stat-card">
						<span class="case-study-stat"><?php echo esc_html( $stat_value ); ?></span>
						<p><?php echo esc_html( $stat_label ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if ( $who_text || $what_text ) : ?>
	<section class="cs-section cs-cols-section py-5">
		<div class="custom-container">
			<h2 class="cs-section-title mt-0 mb-4"><?php echo esc_html( $about_title ); ?></h2>
			<div class="cs-cols pt-lg-5">
				<div class="row">
					<?php if ( $who_text ) : ?>
						<div class="cs-col-1 pt-lg-0 pt-5 col-lg-6">
							<p class="cs-col-title"><?php echo esc_html( $who_title ); ?></p>
							<div class="cs-col-desc">
								<?php echo wp_kses_post( wpautop( $who_text ) ); ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( $what_text ) : ?>
						<div class="cs-col-2 pt-lg-0 pt-5 col-lg-6">
							<p class="cs-col-title"><?php echo esc_html( $what_title ); ?></p>
							<div class="cs-col-desc">
								<?php echo wp_kses_post( wpautop( $what_text ) ); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $problem ) : ?>
	<section class="cs-section cs-cols-section cs-prob-section bg-light-blue py-5">
		<div class="custom-container">
			<h2 class="cs-section-title mt-0 mb-4"><?php echo esc_html( $problem_title ); ?></h2>
			<div class="cs-cols">
				<div class="row">
					<div class="pt-lg-0 pt-5 col-lg-12">
						<div class="cs-col-desc">
							<?php echo wp_kses_post( wpautop( $problem ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $solution || $solution_tabs || $ace_assets_items || $ace_control_items || $ace_experiment_items ) : ?>
	<section class="cs-section cs-cols-section cs-sol-section py-5">
		<div class="custom-container">
			<h2 class="cs-section-title mt-0 mb-4"><?php echo esc_html( $solution_title ); ?></h2>
			<div class="row pt-lg-4">
				<div class="pt-lg-0 pt-5 col-lg-12 has-only-race">
					<div class="cs-race-content mb-4">
						<?php if ( $solution ) : ?>
							<div class="race-intro text-center pb-4">
								<div class="row justify-content-center">
									<div class="col-lg-9">
										<?php echo wp_kses_post( wpautop( $solution ) ); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $solution_tabs ) ) : ?>
							<div class="row d-md-flex d-none">
								<div class="col-xl-3 col-lg-4 col-md-5">
									<ul class="nav nav-pills nav-stacked flex-column h-100" role="tablist" aria-orientation="vertical">
										<?php foreach ( $solution_tabs as $index => $tab ) : ?>
											<?php
											$tab_id    = 'tab_' . ( $index + 1 );
											$is_active = 0 === $index;
											?>
											<li class="<?php echo $is_active ? 'active' : ''; ?>">
												<span class="nav-link d-block w-100<?php echo $is_active ? ' active' : ''; ?>" data-tab="<?php echo esc_attr( $tab_id ); ?>">
													<?php echo esc_html( isset( $tab['tab_title'] ) ? $tab['tab_title'] : '' ); ?>
												</span>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-xl-9 col-lg-8 col-md-7">
									<div class="tab-content p-0 d-flex flex-column h-100">
										<?php foreach ( $solution_tabs as $index => $tab ) : ?>
											<?php
											$tab_id    = 'tab_' . ( $index + 1 );
											$is_active = 0 === $index;
											?>
											<div class="tab-pane<?php echo $is_active ? ' active' : ''; ?>" id="<?php echo esc_attr( $tab_id ); ?>" role="tabpanel">
												<?php echo wp_kses_post( wpautop( isset( $tab['tab_content'] ) ? $tab['tab_content'] : '' ) ); ?>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>

							<div class="d-md-none">
								<div id="tabContentCS">
									<ul class="nav flex-column point-list mw-100">
										<?php foreach ( $solution_tabs as $index => $tab ) : ?>
											<?php
											$collapse_id = 'collapse' . ( $index + 1 );
											$is_active   = 0 === $index;
											?>
											<li data-toggle="collapse" data-target="#<?php echo esc_attr( $collapse_id ); ?>" aria-expanded="<?php echo $is_active ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $collapse_id ); ?>">
												<div class="point-title">
													<span class="ptitle"><?php echo esc_html( isset( $tab['tab_title'] ) ? $tab['tab_title'] : '' ); ?></span>
													<i class="point-caret fa fa-caret-down" aria-hidden="true"></i>
												</div>
												<div id="<?php echo esc_attr( $collapse_id ); ?>" class="collapse<?php echo $is_active ? ' show' : ''; ?>" data-parent="#tabContentCS">
													<div class="point-desc">
														<?php echo wp_kses_post( wpautop( isset( $tab['tab_content'] ) ? $tab['tab_content'] : '' ) ); ?>
													</div>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						<?php elseif ( $ace_assets_items || $ace_control_items || $ace_experiment_items ) : ?>
							<div class="row d-md-flex d-none">
								<div class="col-xl-3 col-lg-4 col-md-5">
									<ul class="nav nav-pills nav-stacked flex-column h-100" role="tablist" aria-orientation="vertical">
										<?php if ( $ace_assets_items ) : ?>
											<li class="active"><span class="nav-link d-block w-100 active" data-tab="tab_assets">Assets</span></li>
										<?php endif; ?>
										<?php if ( $ace_control_items ) : ?>
											<li><span class="nav-link d-block w-100" data-tab="tab_control">Control</span></li>
										<?php endif; ?>
										<?php if ( $ace_experiment_items ) : ?>
											<li><span class="nav-link d-block w-100" data-tab="tab_experimentation">Experimentation</span></li>
										<?php endif; ?>
									</ul>
								</div>
								<div class="col-xl-9 col-lg-8 col-md-7">
									<div class="tab-content p-0 d-flex flex-column h-100">
										<?php if ( $ace_assets_items ) : ?>
											<div class="tab-pane active" id="tab_assets" role="tabpanel">
												<ul>
													<?php foreach ( $ace_assets_items as $item ) : ?>
														<li><?php echo esc_html( $item ); ?></li>
													<?php endforeach; ?>
												</ul>
											</div>
										<?php endif; ?>
										<?php if ( $ace_control_items ) : ?>
											<div class="tab-pane" id="tab_control" role="tabpanel">
												<ul>
													<?php foreach ( $ace_control_items as $item ) : ?>
														<li><?php echo esc_html( $item ); ?></li>
													<?php endforeach; ?>
												</ul>
											</div>
										<?php endif; ?>
										<?php if ( $ace_experiment_items ) : ?>
											<div class="tab-pane" id="tab_experimentation" role="tabpanel">
												<ul>
													<?php foreach ( $ace_experiment_items as $item ) : ?>
														<li><?php echo esc_html( $item ); ?></li>
													<?php endforeach; ?>
												</ul>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $results || $results_table || $results_columns || $results_rows ) : ?>
	<section class="cs-section cs-cols-section cs-result-section py-lg-5 border-bottom-0">
		<div class="custom-container">
			<h2 class="cs-section-title mt-0 mb-4"><?php echo esc_html( $results_title ); ?></h2>
			<?php if ( $results ) : ?>
				<div class="cs-section-desc pb-4">
					<?php echo wp_kses_post( wpautop( $results ) ); ?>
				</div>
			<?php endif; ?>

			<div class="cs-results-tholder pb-3">
				<div class="cs-table-box mb-4 table-responsive">
					<div class="table-responsive table-selfr">
						<?php if ( $results_columns && $results_rows ) : ?>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<?php foreach ( $results_columns as $column ) : ?>
											<td><?php echo esc_html( isset( $column['column_label'] ) ? $column['column_label'] : '' ); ?></td>
										<?php endforeach; ?>
									</tr>
									<?php foreach ( $results_rows as $row ) : ?>
										<?php
										$row_values = isset( $row['row_values'] ) && is_array( $row['row_values'] ) ? $row['row_values'] : array();
										$column_count = count( $results_columns );
										?>
										<tr>
											<?php
											if ( ! empty( $row_values ) ) :
												$cell_index = 0;
												foreach ( $row_values as $cell ) :
													?>
													<td><?php echo esc_html( isset( $cell['value'] ) ? $cell['value'] : '' ); ?></td>
													<?php
													$cell_index++;
												endforeach;
												for ( $i = $cell_index; $i < $column_count; $i++ ) :
													?>
													<td></td>
													<?php
												endfor;
											elseif ( ! empty( $row['row_label'] ) ) :
												?>
												<td colspan="<?php echo esc_attr( max( 1, $column_count ) ); ?>"><?php echo esc_html( $row['row_label'] ); ?></td>
												<?php
											endif;
											?>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php elseif ( $results_table ) : ?>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>Year 2021</td>
										<td>Spend</td>
										<td>Purchases</td>
										<td>Revenue</td>
										<td>ROAS</td>
									</tr>
									<?php foreach ( $results_table as $row ) : ?>
										<tr>
											<td><?php echo esc_html( isset( $row['period'] ) ? $row['period'] : '' ); ?></td>
											<td><?php echo esc_html( isset( $row['spend'] ) ? $row['spend'] : '' ); ?></td>
											<td><?php echo esc_html( isset( $row['purchases'] ) ? $row['purchases'] : '' ); ?></td>
											<td><?php echo esc_html( isset( $row['revenue'] ) ? $row['revenue'] : '' ); ?></td>
											<td><?php echo esc_html( isset( $row['roas'] ) ? $row['roas'] : '' ); ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/Home/client-logos' ); ?>

<?php
get_footer();
