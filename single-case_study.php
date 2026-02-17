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

$kicker         = $cs_get_field( 'case_study_kicker', 'Case Study' );
$subtitle       = $cs_get_field( 'case_study_subtitle' );
$stat_value     = $cs_get_field( 'case_study_stat_value' );
$stat_label     = $cs_get_field( 'case_study_stat_label', 'Primary Result' );
$about_title    = $cs_get_field( 'case_study_about_title', 'About Our Partner' );
$about_small    = $cs_get_field( 'case_study_about_small', 'Partner Overview' );
$who_title      = $cs_get_field( 'case_study_who_title', 'Who They Are' );
$who_text       = $cs_get_field( 'case_study_who_text' );
$what_title     = $cs_get_field( 'case_study_what_title', 'What They Do' );
$what_text      = $cs_get_field( 'case_study_what_text' );
$gallery_title  = $cs_get_field( 'case_study_gallery_title', 'Project Gallery' );
$gallery_intro  = $cs_get_field( 'case_study_gallery_intro' );
$gallery_images = function_exists( 'get_field' ) ? get_field( 'case_study_gallery_images', $post_id ) : array();
if ( ! is_array( $gallery_images ) ) {
	$gallery_images = array();
}
$problem_title  = $cs_get_field( 'case_study_problem_title', 'The Problem' );
$problem        = $cs_get_field( 'case_study_problem' );
$solution_title = $cs_get_field( 'case_study_solution_title', 'The Solution' );
$solution       = $cs_get_field( 'case_study_solution' );
$solution_tabs  = function_exists( 'get_field' ) ? get_field( 'case_study_solution_tabs', $post_id ) : array();
if ( ! is_array( $solution_tabs ) ) {
	$solution_tabs = array();
}
$results_title     = $cs_get_field( 'case_study_results_title', 'Results' );
$results           = $cs_get_field( 'case_study_results' );
$cta_button        = function_exists( 'get_field' ) ? get_field( 'case_study_cta_button', $post_id ) : null;
$closing_cta_title = $cs_get_field( 'case_study_closing_cta_title' );
$closing_cta_text  = $cs_get_field( 'case_study_closing_cta_text' );

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

$results_table_html = $cs_get_field( 'case_study_results_table_html' );

$selected_testimonials = function_exists( 'get_field' ) ? get_field( 'case_study_testimonials', $post_id ) : array();
if ( ! is_array( $selected_testimonials ) ) {
	$selected_testimonials = array();
}

// Fallback copy to show layout if fields are empty.
if ( empty( $who_text ) ) {
	$who_text = 'Our partner is an American-owned and operated premium Outdoor Sporting Goods Company that provides bushcraft and outdoor self-reliance gear. They provide over 500 high-quality products designed to help outdoor enthusiasts find their niche in the great outdoors.';
}
if ( empty( $what_text ) ) {
	$what_text = 'Our partner provides the equipment and knowledge for the modern outdoor enthusiast. Their products include camping gear, hunting gear, survival knives, and apparel. They also host survival and specialty classes and provide survival guides and booklets.';
}
if ( empty( $problem ) ) {
	$problem = 'Before they worked with our team, the partner had never worked with another agency for paid media. Revenue and sales volume had plateaued, and the brand wanted to increase these metrics through search engine marketing. Prior Facebook campaigns had policy issues that restricted their account.';
}
if ( empty( $solution ) ) {
	$solution = 'We started by diagnosing the policy issues and refining the product catalog to comply with platform rules. Once restrictions were removed, we built prospecting and remarketing audiences and launched a Facebook Shop to create an organic storefront. We then scaled using our A.C.E. framework.';
}
if ( empty( $solution_tabs ) ) {
	$solution_tabs = array(
		array(
			'tab_title'   => 'Assets',
			'tab_content' => '<ul><li>Built memorable ads to appeal to both current and potential customers</li><li>Created original content that strengthened product offerings</li><li>Built a Facebook Shop to organically showcase products to page followers</li></ul>',
		),
		array(
			'tab_title'   => 'Control',
			'tab_content' => '<ul><li>Improved previous audience targeting</li><li>Aggregated events to optimize event tracking</li></ul>',
		),
		array(
			'tab_title'   => 'Experimentation',
			'tab_content' => '<ul><li>Tested our prospecting campaign against a controlled audience</li><li>Conducted ad A/B testing using ad-set level budgets to ensure a 50/50 split</li></ul>',
		),
	);
}
if ( empty( $results ) ) {
	$results = 'The results below are provided with permission from the brand and cover the 2021 calendar year. Q1 and Q2 were strong for both revenue and ROAS, achieved through policy resolution and best-practice execution. Q3 saw a downturn due to iOS 14 attribution changes, but adjustments helped account for tracking loss. In Q4, adding Google Ads captured additional demand, producing a 161% revenue increase versus Q1 2021.';
}
if ( empty( $results_table_html ) ) {
	$results_table_html = '<table class="table table-bordered"><tbody><tr><td>Year 2021</td><td>Spend</td><td>Purchases</td><td>Revenue</td><td>ROAS</td></tr><tr><td>Q1</td><td>$1,966.29</td><td>1,034</td><td>$81,939.40</td><td>41.67</td></tr><tr><td>Q2</td><td>$4,428.00</td><td>1,373</td><td>$112,794.72</td><td>25.47</td></tr><tr><td>Q3<br><small>(iOS 14 changes)</small></td><td>$4,419.93</td><td>916</td><td>$69,038.54</td><td>15.61</td></tr><tr><td>Q4</td><td>$8,614.49</td><td>2,093</td><td>$213,717.45</td><td>24.80</td></tr></tbody></table>';
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
					$default_cta_url   = home_url( '/contact-us/' );
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
				<div class="row gy-4">
					<?php if ( $who_text ) : ?>
						<div class="cs-col-1 pt-5 col-lg-6">
							<p class="cs-col-title"><?php echo esc_html( $who_title ); ?></p>
							<div class="cs-col-desc">
								<?php echo wpautop( $who_text ); ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( $what_text ) : ?>
						<div class="cs-col-2 pt-5 col-lg-6">
							<p class="cs-col-title"><?php echo esc_html( $what_title ); ?></p>
							<div class="cs-col-desc">
								<?php echo wpautop( $what_text ); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $gallery_images ) ) : ?>
	<section class="cs-section case-study-gallery-section py-5">
		<div class="custom-container">
			<h2 class="cs-section-title mt-0 mb-4 text-center"><?php echo esc_html( $gallery_title ); ?></h2>
			<?php if ( ! empty( $gallery_intro ) ) : ?>
				<div class="case-study-gallery-intro">
					<?php echo wpautop( $gallery_intro ); ?>
				</div>
			<?php endif; ?>
			<div class="case-study-gallery-grid" data-case-study-gallery>
				<?php foreach ( $gallery_images as $image ) : ?>
					<?php
					$full_url  = '';
					$thumb_url = '';
					$alt       = '';
					$caption   = '';

					if ( is_array( $image ) ) {
						$full_url  = isset( $image['url'] ) ? $image['url'] : '';
						$thumb_url = isset( $image['sizes']['large'] ) ? $image['sizes']['large'] : $full_url;
						$alt       = isset( $image['alt'] ) ? $image['alt'] : '';
						$caption   = isset( $image['caption'] ) ? $image['caption'] : '';
					} else {
						$full_url  = (string) $image;
						$thumb_url = (string) $image;
					}

					if ( empty( $full_url ) ) {
						continue;
					}
					?>
					<button
						type="button"
						class="case-study-gallery-item"
						data-gallery-src="<?php echo esc_url( $full_url ); ?>"
						data-gallery-alt="<?php echo esc_attr( $alt ); ?>"
						data-gallery-caption="<?php echo esc_attr( wp_strip_all_tags( $caption ) ); ?>"
					>
						<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" decoding="async" />
					</button>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<div class="case-study-lightbox" data-case-study-lightbox aria-hidden="true">
		<div class="case-study-lightbox__backdrop" data-gallery-close></div>
		<div class="case-study-lightbox__dialog" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr__( 'Case study gallery preview', 'ludych-theme' ); ?>">
			<button type="button" class="case-study-lightbox__close" data-gallery-close aria-label="<?php echo esc_attr__( 'Close gallery', 'ludych-theme' ); ?>">
				<i class="fa-solid fa-xmark" aria-hidden="true"></i>
			</button>
			<button type="button" class="case-study-lightbox__nav case-study-lightbox__nav--prev" data-gallery-prev aria-label="<?php echo esc_attr__( 'Previous image', 'ludych-theme' ); ?>">
				<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
			</button>
			<figure class="case-study-lightbox__figure">
				<img src="" alt="" data-gallery-image />
				<figcaption class="case-study-lightbox__caption" data-gallery-caption></figcaption>
			</figure>
			<button type="button" class="case-study-lightbox__nav case-study-lightbox__nav--next" data-gallery-next aria-label="<?php echo esc_attr__( 'Next image', 'ludych-theme' ); ?>">
				<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
			</button>
		</div>
	</div>
<?php endif; ?>

<?php if ( $problem ) : ?>
	<section class="cs-section cs-cols-section cs-prob-section bg-light-blue py-5">
		<div class="custom-container">
			<h2 class="cs-section-title mt-0 mb-4"><?php echo esc_html( $problem_title ); ?></h2>
			<div class="cs-cols">
				<div class="row">
					<div class="pt-lg-0 pt-5 col-lg-12">
						<div class="cs-col-desc">
							<?php echo wpautop( $problem ); ?>
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
										<?php echo wpautop( $solution ); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<div class="cs-expertise-grid">
							<?php foreach ( $solution_tabs as $tab ) : ?>
								<div class="expertise-card">
									<div class="expertise-info">
										<h3><?php echo esc_html( isset( $tab['tab_title'] ) ? $tab['tab_title'] : '' ); ?></h3>
										<?php echo wpautop( isset( $tab['tab_content'] ) ? $tab['tab_content'] : '' ); ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $results || $results_table_html ) : ?>
	<section class="cs-section cs-cols-section cs-result-section py-lg-5 border-bottom-0">
		<div class="custom-container">
			<h2 class="cs-section-title mt-0 mb-4"><?php echo esc_html( $results_title ); ?></h2>
			<?php if ( $results ) : ?>
				<div class="cs-section-desc pb-4">
					<?php echo wpautop( $results ); ?>
				</div>
			<?php endif; ?>

			<div class="cs-results-tholder pb-3">
				<div class="cs-table-box mb-4 table-responsive">
					<div class="table-responsive table-selfr">
						<?php if ( $results_table_html ) : ?>
							<?php echo $results_table_html; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $closing_cta_title || $closing_cta_text ) : ?>
	<section class="cs-section py-5">
		<div class="custom-container">
			<div class="case-study-cta">
				<div class="case-study-cta__content">
					<?php if ( $closing_cta_title ) : ?>
						<h2><?php echo esc_html( $closing_cta_title ); ?></h2>
					<?php endif; ?>
					<?php if ( $closing_cta_text ) : ?>
						<p><?php echo esc_html( $closing_cta_text ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/Home/client-logos' ); ?>

<?php
get_footer();
