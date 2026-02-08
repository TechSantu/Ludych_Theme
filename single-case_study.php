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
$reviews_kicker = $cs_get_field( 'case_study_reviews_kicker', 'Searchbloom' );
$reviews_rating = $cs_get_field( 'case_study_reviews_rating', '4.9/5.0 Based on 99 Reviews' );
$reviews_badge  = $cs_get_field( 'case_study_reviews_badge', 'Top Rated Agency' );
$partners_heading = $cs_get_field( 'case_study_partners_heading', 'You Are Much More Than a Client.' );
$partners_text    = $cs_get_field( 'case_study_partners_text', 'Hundreds of brands trust our team with growth. Here are a few we are proud to work with.' );
$cta_heading      = $cs_get_field( 'case_study_cta_heading', 'Want similar results? Contact us now!' );
$cta_text         = $cs_get_field( 'case_study_cta_text', 'While every site is different, we will help you make your mark.' );
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
	<section class="case-study-section">
		<div class="custom-container">
			<div class="global-header text-center">
				<h2><?php echo esc_html( $about_title ); ?></h2>
				<div class="min-title">
					<div class="icon-box">
						<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
							<path d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z" fill="url(#a)"></path>
							<defs>
								<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311" gradientUnits="userSpaceOnUse">
									<stop stop-color="#3D72FB"></stop>
									<stop offset="1" stop-color="#fff"></stop>
								</linearGradient>
							</defs>
						</svg>
					</div>
					<h6><?php echo esc_html( $about_small ); ?></h6>
				</div>
			</div>
			<div class="row case-study-about-grid">
				<?php if ( $who_text ) : ?>
					<div class="col-lg-6">
						<div class="case-study-about-card">
							<h3><?php echo esc_html( $who_title ); ?></h3>
							<?php echo wp_kses_post( wpautop( $who_text ) ); ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $what_text ) : ?>
					<div class="col-lg-6">
						<div class="case-study-about-card">
							<h3><?php echo esc_html( $what_title ); ?></h3>
							<?php echo wp_kses_post( wpautop( $what_text ) ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $problem ) : ?>
	<section class="case-study-section grey-bg">
		<div class="custom-container">
			<div class="global-header">
				<h2><?php echo esc_html( $problem_title ); ?></h2>
			</div>
			<?php echo wp_kses_post( wpautop( $problem ) ); ?>
		</div>
	</section>
<?php endif; ?>

<?php if ( $solution || $solution_tabs || $ace_assets_items || $ace_control_items || $ace_experiment_items ) : ?>
	<section class="case-study-section">
		<div class="custom-container">
			<div class="global-header">
				<h2><?php echo esc_html( $solution_title ); ?></h2>
			</div>
			<?php if ( $solution ) : ?>
				<?php echo wp_kses_post( wpautop( $solution ) ); ?>
			<?php endif; ?>

			<?php if ( ! empty( $solution_tabs ) ) : ?>
				<div class="case-study-tabs" data-case-study-tabs>
					<div class="case-study-tabs__nav" role="tablist">
						<?php foreach ( $solution_tabs as $index => $tab ) : ?>
							<?php
							$tab_id = 'cs-tab-' . ( $index + 1 );
							$is_active = 0 === $index;
							?>
							<button class="case-study-tabs__btn<?php echo $is_active ? ' is-active' : ''; ?>" type="button" data-tab-target="<?php echo esc_attr( $tab_id ); ?>" role="tab" aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
								<?php echo esc_html( isset( $tab['tab_title'] ) ? $tab['tab_title'] : '' ); ?>
							</button>
						<?php endforeach; ?>
					</div>
					<div class="case-study-tabs__panels">
						<?php foreach ( $solution_tabs as $index => $tab ) : ?>
							<?php
							$tab_id = 'cs-tab-' . ( $index + 1 );
							$is_active = 0 === $index;
							?>
							<div class="case-study-tabs__panel<?php echo $is_active ? ' is-active' : ''; ?>" id="<?php echo esc_attr( $tab_id ); ?>" role="tabpanel">
								<?php echo wp_kses_post( wpautop( isset( $tab['tab_content'] ) ? $tab['tab_content'] : '' ) ); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php elseif ( $ace_assets_items || $ace_control_items || $ace_experiment_items ) : ?>
				<div class="row case-study-ace-grid">
					<?php if ( $ace_assets_items ) : ?>
						<div class="col-lg-4">
							<div class="case-study-ace-card">
								<h4>Assets</h4>
								<ul>
									<?php foreach ( $ace_assets_items as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( $ace_control_items ) : ?>
						<div class="col-lg-4">
							<div class="case-study-ace-card">
								<h4>Control</h4>
								<ul>
									<?php foreach ( $ace_control_items as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( $ace_experiment_items ) : ?>
						<div class="col-lg-4">
							<div class="case-study-ace-card">
								<h4>Experimentation</h4>
								<ul>
									<?php foreach ( $ace_experiment_items as $item ) : ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php if ( $results || $results_table || $results_columns || $results_rows ) : ?>
	<section class="case-study-section grey-bg">
		<div class="custom-container">
			<div class="global-header">
				<h2><?php echo esc_html( $results_title ); ?></h2>
			</div>
			<?php if ( $results ) : ?>
				<?php echo wp_kses_post( wpautop( $results ) ); ?>
			<?php endif; ?>

			<?php if ( $results_columns && $results_rows ) : ?>
				<div class="case-study-table-wrap">
					<table class="case-study-table">
						<thead>
							<tr>
								<?php foreach ( $results_columns as $column ) : ?>
									<th><?php echo esc_html( isset( $column['column_label'] ) ? $column['column_label'] : '' ); ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
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
				</div>
			<?php elseif ( $results_table ) : ?>
				<div class="case-study-table-wrap">
					<table class="case-study-table">
						<thead>
							<tr>
								<th>Period</th>
								<th>Spend</th>
								<th>Purchases</th>
								<th>Revenue</th>
								<th>ROAS</th>
							</tr>
						</thead>
						<tbody>
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
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<section class="case-study-reviews">
	<div class="custom-container">
		<div class="case-study-reviews__header">
			<?php if ( $reviews_kicker ) : ?>
				<span class="case-study-reviews__kicker"><?php echo esc_html( $reviews_kicker ); ?></span>
			<?php endif; ?>
			<?php if ( $reviews_rating ) : ?>
				<h2><?php echo esc_html( $reviews_rating ); ?></h2>
			<?php endif; ?>
			<?php if ( $reviews_badge ) : ?>
				<span class="case-study-reviews__badge"><?php echo esc_html( $reviews_badge ); ?></span>
			<?php endif; ?>
		</div>

		<div class="case-study-reviews__grid">
			<?php
			$testimonial_posts = array();
			if ( ! empty( $selected_testimonials ) ) {
				$testimonial_posts = $selected_testimonials;
			} else {
				$testimonial_query = new WP_Query( array(
					'post_type'      => 'testimonial',
					'posts_per_page' => 3,
					'post_status'    => 'publish',
				) );
				if ( $testimonial_query->have_posts() ) {
					$testimonial_posts = $testimonial_query->posts;
				}
			}
			?>
			<?php foreach ( $testimonial_posts as $testimonial_post ) : ?>
				<?php
				$testimonial_id          = is_object( $testimonial_post ) ? $testimonial_post->ID : $testimonial_post;
				$testimonial_name        = get_the_title( $testimonial_id );
				$testimonial_role        = function_exists( 'get_field' ) ? get_field( 'testimonial_role', $testimonial_id ) : '';
				$testimonial_designation = function_exists( 'get_field' ) ? get_field( 'testimonial_designation', $testimonial_id ) : '';
				$testimonial_content     = get_post_field( 'post_content', $testimonial_id );
				?>
				<article class="case-study-review-card">
					<p><?php echo wp_kses_post( wpautop( $testimonial_content ) ); ?></p>
					<div class="case-study-review-card__meta">
						<strong><?php echo esc_html( $testimonial_name ); ?></strong>
						<?php if ( $testimonial_role || $testimonial_designation ) : ?>
							<span><?php echo esc_html( $testimonial_role ? $testimonial_role : $testimonial_designation ); ?></span>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="case-study-partners">
	<div class="custom-container">
		<div class="global-header text-center">
			<h2><?php echo esc_html( $partners_heading ); ?></h2>
			<?php if ( $partners_text ) : ?>
				<p><?php echo esc_html( $partners_text ); ?></p>
			<?php endif; ?>
		</div>
		<div class="case-study-logo-grid">
			<?php
			$logos_query = new WP_Query( array(
				'post_type'      => 'client_logo',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			) );

			if ( $logos_query->have_posts() ) :
				while ( $logos_query->have_posts() ) :
					$logos_query->the_post();
					$logo_id  = get_post_thumbnail_id();
					$logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
					if ( $logo_id ) :
						?>
						<div class="case-study-logo-item">
							<?php
							echo wp_get_attachment_image(
								$logo_id,
								'full',
								false,
								array(
									'alt' => esc_attr( $logo_alt ? $logo_alt : get_the_title() ),
								)
							);
							?>
						</div>
						<?php
					endif;
				endwhile;
				wp_reset_postdata();
			else :
				$default_logos = array(
					get_template_directory_uri() . '/assets/images/case-studies/logo-1.png',
					get_template_directory_uri() . '/assets/images/case-studies/logo-2.png',
					get_template_directory_uri() . '/assets/images/case-studies/logo-3.png',
					get_template_directory_uri() . '/assets/images/case-studies/logo-4.png',
					get_template_directory_uri() . '/assets/images/case-studies/logo-5.png',
				);
				foreach ( $default_logos as $logo_url ) :
					?>
					<div class="case-study-logo-item">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="Client Logo">
					</div>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<section class="case-study-section">
	<div class="custom-container case-study-cta">
		<div>
			<h2><?php echo wp_kses_post( $cta_heading ); ?></h2>
			<p><?php echo wp_kses_post( $cta_text ); ?></p>
		</div>
		<?php
		if ( is_array( $cta_button ) && ! empty( $cta_button['url'] ) ) :
			?>
			<a href="<?php echo esc_url( $cta_button['url'] ); ?>" target="<?php echo esc_attr( $cta_button['target'] ? $cta_button['target'] : '_self' ); ?>" class="globalBtnDark">
				<span><?php echo esc_html( $cta_button['title'] ? $cta_button['title'] : 'Free Action Plan' ); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
			</a>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="globalBtnDark">
				<span>Free Action Plan <i class="fa-solid fa-arrow-right-long"></i></span>
			</a>
		<?php endif; ?>
	</div>
</section>

<?php get_template_part( 'template-parts/Home/client-logos' ); ?>

<?php
get_footer();
