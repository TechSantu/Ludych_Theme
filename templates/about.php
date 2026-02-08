<?php
/*
Template Name: About Page
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id   = get_the_ID();
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$hero_bg = $acf_ready ? get_field( 'about_hero_background', $post_id ) : '';
if ( is_array( $hero_bg ) ) {
	$hero_bg = $hero_bg['url'] ?? '';
}
if ( ! $hero_bg ) {
	$hero_bg = get_template_directory_uri() . '/assets/images/services-bg.jpg';
}

$hero_kicker = $acf_ready ? get_field( 'about_hero_kicker', $post_id ) : '';
if ( ! $hero_kicker ) {
	$hero_kicker = 'About Ludych';
}

$hero_title = $acf_ready ? get_field( 'about_hero_title', $post_id ) : '';
if ( ! $hero_title ) {
	$hero_title = 'Building Platforms <span>That Scale. Shipping Software</span> That Matters.';
}

$hero_subtitle = $acf_ready ? get_field( 'about_hero_subtitle', $post_id ) : '';
if ( ! $hero_subtitle ) {
	$hero_subtitle = 'We bridge the gap between technical excellence and measurable business outcomes.';
}

$why_title = $acf_ready ? get_field( 'about_why_title', $post_id ) : '';
if ( ! $why_title ) {
	$why_title = 'Why Choose Us';
}

$why_kicker = $acf_ready ? get_field( 'about_why_kicker', $post_id ) : '';
if ( ! $why_kicker ) {
	$why_kicker = 'Why Choose Us';
}

$why_heading = $acf_ready ? get_field( 'about_why_heading', $post_id ) : '';
if ( ! $why_heading ) {
	$why_heading = 'Not Your Typical Agency <span>Here\'s Why.</span>';
}

$why_items_fallback = array(
	array(
		'title'       => 'Digital Excellence',
		'image'       => get_template_directory_uri() . '/assets/images/custom-development-2.jpg',
		'description' => 'Cutting-edge technology solutions that drive innovation and competitive advantage for your business.',
		'link_text'   => 'read more...',
		'link_url'    => 'javascript:void(0)',
	),
	array(
		'title'       => 'Strategic Partnership',
		'image'       => get_template_directory_uri() . '/assets/images/custom-development-2.jpg',
		'description' => 'Collaborative approach ensuring your vision aligns perfectly with our technical expertise and delivery.',
		'link_text'   => 'read more...',
		'link_url'    => 'javascript:void(0)',
	),
	array(
		'title'       => 'Scalable Growth',
		'image'       => get_template_directory_uri() . '/assets/images/custom-development-2.jpg',
		'description' => 'Future-proof solutions designed to evolve and scale with your business requirements and ambitions.',
		'link_text'   => 'read more...',
		'link_url'    => 'javascript:void(0)',
	),
	array(
		'title'       => 'Expert Support',
		'image'       => get_template_directory_uri() . '/assets/images/custom-development-2.jpg',
		'description' => 'Dedicated team of professionals providing ongoing support and maintenance for lasting success.',
		'link_text'   => 'read more...',
		'link_url'    => 'javascript:void(0)',
	),
);

$story_title = $acf_ready ? get_field( 'about_story_title', $post_id ) : '';
if ( ! $story_title ) {
	$story_title = 'Our Story';
}

$story_kicker = $acf_ready ? get_field( 'about_story_kicker', $post_id ) : '';
if ( ! $story_kicker ) {
	$story_kicker = 'Our Story';
}

$story_heading = $acf_ready ? get_field( 'about_story_heading', $post_id ) : '';
if ( ! $story_heading ) {
	$story_heading = '<span>Built by Engineers</span> Who Were Tired of the Status Quo';
}

$story_content = $acf_ready ? get_field( 'about_story_content', $post_id ) : '';
if ( ! $story_content ) {
	$story_content = '<p>Ludych exists because we believe software agencies can&mdash;and should&mdash;do better. Too many promise &ldquo;world-class&rdquo; work and deliver junior developers. Too many run &ldquo;agile&rdquo; sprints without PMO discipline. Too many ship code without proper testing.</p>
	<p>We built an agency around principles, not just profits. Every engineer is mid-to-senior level with 5+ years of production experience. Every project gets RACI clarity, RAID tracking, and transparent roadmaps. Every deployment includes automated testing in CI/CD. Every decision is backed by tracking and dashboards from Day 1.</p>
	<p>Based in Chandler, Arizona, we serve technical leaders who understand that velocity without visibility is reckless&mdash;and that strategy without execution is theater.</p>
	<p><strong>Build boldly. Grow smart.</strong></p>';
}

$story_author_name  = $acf_ready ? get_field( 'about_story_author_name', $post_id ) : '';
$story_author_title = $acf_ready ? get_field( 'about_story_author_title', $post_id ) : '';
if ( ! $story_author_name ) {
	$story_author_name = 'Joseph Appleton';
}
if ( ! $story_author_title ) {
	$story_author_title = 'Founder & Managing Partner';
}

$story_image = $acf_ready ? get_field( 'about_story_image', $post_id ) : '';
if ( is_array( $story_image ) ) {
	$story_image = $story_image['url'] ?? '';
}
if ( ! $story_image ) {
	$story_image = get_template_directory_uri() . '/assets/images/about-left.jpg';
}

$values_title = $acf_ready ? get_field( 'about_values_title', $post_id ) : '';
if ( ! $values_title ) {
	$values_title = 'Work By';
}

$values_kicker = $acf_ready ? get_field( 'about_values_kicker', $post_id ) : '';
if ( ! $values_kicker ) {
	$values_kicker = 'Values we live and work by';
}

$values_heading = $acf_ready ? get_field( 'about_values_heading', $post_id ) : '';
if ( ! $values_heading ) {
	$values_heading = 'The Standards We Hold<br> <span>Ourselves</span> To.';
}

$values_items_fallback = array(
	array(
		'title'       => 'Senior<br> Engineering Only',
		'icon'        => get_template_directory_uri() . '/assets/images/icon-consultation.svg',
		'description' => 'Every engineer is mid-to-senior level with 5+ years of production experience. No bootcamp grads learning at your expense. We staff projects with people who\'ve already made&mdash;and fixed&mdash;the mistakes.',
	),
	array(
		'title'       => 'PMO<br> Rigor From Day 1',
		'icon'        => get_template_directory_uri() . '/assets/images/icon-consultation.svg',
		'description' => 'RACI matrices, RAID logs, and sprint rituals aren\'t optional&mdash;they\'re standard. You\'ll always know what shipped, what\'s blocked, and what\'s next. No status confusion, no "let me get back to you."',
	),
	array(
		'title'       => 'Automated QA,<br> Not Hope',
		'icon'        => get_template_directory_uri() . '/assets/images/icon-consultation.svg',
		'description' => 'Jest + Playwright run in CI/CD before any code ships. Accessibility audits. Performance testing. Load testing. We catch bugs before your users do&mdash;because hoping it works isn\'t a quality strategy.',
	),
	array(
		'title'       => 'Transparency<br> & Data',
		'icon'        => get_template_directory_uri() . '/assets/images/icon-consultation.svg',
		'description' => 'Fixed-scope SOWs, no surprise invoices. GA4 tracking from Day 1. KPI dashboards by Week 2. Direct access to project boards and reports. We make decisions based on metrics, not opinions.',
	),
);

$mission_title   = $acf_ready ? get_field( 'about_mission_title', $post_id ) : '';
$mission_content = $acf_ready ? get_field( 'about_mission_content', $post_id ) : '';
if ( ! $mission_title ) {
	$mission_title = 'Our Mission';
}
if ( ! $mission_content ) {
	$mission_content = 'Ship working software that drives measurable growth. Bridge technical excellence with business outcomes through senior engineering, PMO discipline, and QA rigor. Build boldly. Grow smart.';
}

$vision_title   = $acf_ready ? get_field( 'about_vision_title', $post_id ) : '';
$vision_content = $acf_ready ? get_field( 'about_vision_content', $post_id ) : '';
if ( ! $vision_title ) {
	$vision_title = 'Our Vision';
}
if ( ! $vision_content ) {
	$vision_content = 'To be the go-to full-stack agency for technical leaders who refuse to compromise on quality, velocity, or transparency. Where execution meets measurement.';
}

$value_title   = $acf_ready ? get_field( 'about_value_title', $post_id ) : '';
$value_content = $acf_ready ? get_field( 'about_value_content', $post_id ) : '';
if ( ! $value_title ) {
	$value_title = 'Our Value';
}
if ( ! $value_content ) {
	$value_content = '<strong>Transparency</strong>  - Fixed-scope SOWs, no surprise invoices<br>
	<strong>Quality</strong>  - Jest + Playwright in CI, WCAG 2.2 AA compliance<br>
	<strong>Ownership</strong> - RACI clarity, RAID logs, sprint rituals<br>
	<strong>Data</strong> - Tracking plans Day 1, KPIs by Week 2<br>
	<strong>Velocity</strong> - 5+ years experience minimum, no exceptions';
}

$blog_title   = $acf_ready ? get_field( 'about_blog_title', $post_id ) : '';
$blog_kicker  = $acf_ready ? get_field( 'about_blog_kicker', $post_id ) : '';
$blog_heading = $acf_ready ? get_field( 'about_blog_heading', $post_id ) : '';
if ( ! $blog_title ) {
	$blog_title = 'News & Blog';
}
if ( ! $blog_kicker ) {
	$blog_kicker = 'News & Blog';
}
if ( ! $blog_heading ) {
	$blog_heading = 'Our Latest <span>News & Blog</span>';
}

$blog_fallback_items = array(
	array(
		'image'       => get_template_directory_uri() . '/assets/images/blog-1.png',
		'tag'         => 'Website Development',
		'title'       => 'Digital Marketing Strategies for the Healthcare Industry',
		'description' => 'The healthcare industry continues to experience rapid digital transformation. Patients now rely on search engines, online reviews, and digital platforms to evaluate providers, compare services, and make informed decisions. To remain competitive and compliant, healthcare organizations must adopt structured, data-driven digital marketing strategies. As a digital marketing agency in Arizona, Ludych works with healthcare providers, clinics, and medical organizations to design scalable marketing systems that improve visibility, patient acquisition, and long-term trust&mdash;without compromising regulatory standards.',
		'link_url'    => '#',
	),
	array(
		'image'       => get_template_directory_uri() . '/assets/images/blog-2.png',
		'tag'         => 'Website Development',
		'title'       => 'The Future of B2B Digital Marketingin 2024',
		'description' => 'Explore emerging trends and technologies that are reshaping how B2B companies approach digital marketing strategies.',
		'link_url'    => '#',
	),
	array(
		'image'       => get_template_directory_uri() . '/assets/images/blog-3.jpg',
		'tag'         => 'Website Development',
		'title'       => 'Do Your Business with Expert Digital Solutions',
		'description' => 'Do Your Business with Expert Digital Solutions In today&rsquo;s fast-paced digital world, success is no longer defined solely by hard work or traditional marketing strategies.',
		'link_url'    => '#',
	),
);

get_header();
?>

<section class="inner-banner-wrap with-overlay text-center" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
	<div class="custom-container">
		<div class="inner-banner">
			<div class="global-header about-head">
				<h2><?php echo esc_html( $hero_kicker ); ?></h2>
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
					<h6><?php echo esc_html( $hero_kicker ); ?></h6>
				</div>
				<h1 class="page-title"><?php echo wp_kses_post( $hero_title ); ?></h1>
				<p><?php echo esc_html( $hero_subtitle ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="our-services about-wrap">
	<div class="custom-container">
		<div class="global-header left-align">
			<h2><?php echo esc_html( $why_title ); ?></h2>
			<div class="min-title">
				<div class="icon-box">
					<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
						<path
							d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z"
							fill="url(#a)" />
						<defs>
							<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311"
								gradientUnits="userSpaceOnUse">
								<stop stop-color="#3D72FB" />
								<stop offset="1" stop-color="#fff" />
							</linearGradient>
						</defs>
					</svg>
				</div>
				<h6><?php echo esc_html( $why_kicker ); ?></h6>
			</div>
			<h5><?php echo wp_kses_post( $why_heading ); ?></h5>
		</div>

		<div class="busines-partner-items">
			<div class="row">
				<?php
				if ( $acf_ready && have_rows( 'about_why_items', $post_id ) ) :
					while ( have_rows( 'about_why_items', $post_id ) ) :
						the_row();
						$item_title = get_sub_field( 'title' );
						$item_image = get_sub_field( 'image' );
						$item_desc  = get_sub_field( 'description' );
						$item_link  = get_sub_field( 'link' );
						$item_url   = is_array( $item_link ) ? ( $item_link['url'] ?? '' ) : $item_link;
						$item_text  = is_array( $item_link ) ? ( $item_link['title'] ?? 'read more...' ) : 'read more...';
						if ( is_array( $item_image ) ) {
							$item_image = $item_image['url'] ?? '';
						}
						if ( ! $item_image ) {
							$item_image = get_template_directory_uri() . '/assets/images/custom-development-2.jpg';
						}
						?>
						<div class="col-xl-3 col-md-6 col-sm-12">
							<div class="partner-item">
								<h4><?php echo esc_html( $item_title ); ?></h4>
								<div class="partner-thumb-item">
									<img src="<?php echo esc_url( $item_image ); ?>" alt="">
								</div>
								<p><?php echo esc_html( $item_desc ); ?></p>
								<?php if ( $item_url ) : ?>
									<a href="<?php echo esc_url( $item_url ); ?>" class="text-link"><?php echo esc_html( $item_text ); ?></a>
								<?php endif; ?>
							</div>
						</div>
						<?php
					endwhile;
				else :
					foreach ( $why_items_fallback as $item ) :
						?>
						<div class="col-xl-3 col-md-6 col-sm-12">
							<div class="partner-item">
								<h4><?php echo esc_html( $item['title'] ); ?></h4>
								<div class="partner-thumb-item">
									<img src="<?php echo esc_url( $item['image'] ); ?>" alt="">
								</div>
								<p><?php echo esc_html( $item['description'] ); ?></p>
								<a href="<?php echo esc_url( $item['link_url'] ); ?>" class="text-link"><?php echo esc_html( $item['link_text'] ); ?></a>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="about-us">
	<div class="custom-container">
		<div class="row">
			<div class="col-xl-6 col-md-6 col-sm-12">
				<div class="about-cntn">
					<div class="global-header left-align">
						<h2><?php echo esc_html( $story_title ); ?></h2>
						<div class="min-title">
							<div class="icon-box">
								<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
									fill="none">
									<path
										d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z"
										fill="url(#a)" />
									<defs>
										<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311"
											gradientUnits="userSpaceOnUse">
											<stop stop-color="#3D72FB" />
											<stop offset="1" stop-color="#fff" />
										</linearGradient>
									</defs>
								</svg>
							</div>
							<h6><?php echo esc_html( $story_kicker ); ?></h6>
						</div>
						<h5><?php echo wp_kses_post( $story_heading ); ?></h5>
					</div>
					<?php echo wp_kses_post( $story_content ); ?>
					<div class="author-signature">
						<h5><?php echo esc_html( $story_author_name ); ?></h5>
						<p><?php echo esc_html( $story_author_title ); ?></p>
					</div>

				</div>
			</div>

			<div class="col-xl-6 col-md-6 col-sm-12">
				<div class="about-thumb">
					<img src="<?php echo esc_url( $story_image ); ?>" alt="">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="our-Journey-wrap workby-wrap">
	<div class="custom-container">
		<div class="our-Journey">
			<div class="global-header with-left-header">
				<h2><?php echo esc_html( $values_title ); ?></h2>
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
					<h6><?php echo esc_html( $values_kicker ); ?></h6>
				</div>
				<h5><?php echo wp_kses_post( $values_heading ); ?></h5>
			</div>

			<div class="row mb-5">
				<div class="col-12">
					<div class="content-wrapper">
						<?php
						if ( $acf_ready && have_rows( 'about_values_items', $post_id ) ) :
							while ( have_rows( 'about_values_items', $post_id ) ) :
								the_row();
								$item_title = get_sub_field( 'title' );
								$item_icon  = get_sub_field( 'icon' );
								$item_desc  = get_sub_field( 'description' );
								if ( is_array( $item_icon ) ) {
									$item_icon = $item_icon['url'] ?? '';
								}
								if ( ! $item_icon ) {
									$item_icon = get_template_directory_uri() . '/assets/images/icon-consultation.svg';
								}
								?>
								<div class="content-box-inner">
									<img src="<?php echo esc_url( $item_icon ); ?>" alt="">
									<h3><?php echo wp_kses_post( $item_title ); ?></h3>
									<p><?php echo esc_html( $item_desc ); ?></p>
								</div>
							<?php endwhile; ?>
						<?php else : ?>
							<?php foreach ( $values_items_fallback as $item ) : ?>
								<div class="content-box-inner">
									<img src="<?php echo esc_url( $item['icon'] ); ?>" alt="">
									<h3><?php echo wp_kses_post( $item['title'] ); ?></h3>
									<p><?php echo wp_kses_post( $item['description'] ); ?></p>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="content-wrapper mission-vision">
						<div class="content-box-inner">
							<h3><?php echo esc_html( $mission_title ); ?></h3>
							<p><?php echo esc_html( $mission_content ); ?></p>
						</div>
						<div class="content-box-inner">
							<h3><?php echo esc_html( $vision_title ); ?></h3>
							<p><?php echo esc_html( $vision_content ); ?></p>
						</div>
						<div class="content-box-inner">
							<h3><?php echo esc_html( $value_title ); ?></h3>
							<p><?php echo wp_kses_post( $value_content ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="our-blog grey-bg">
	<div class="custom-container">
		<div class="global-header middle-align">
			<h2><?php echo esc_html( $blog_title ); ?></h2>
			<div class="min-title">
				<div class="icon-box">
					<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
						<path
							d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z"
							fill="url(#a)" />
						<defs>
							<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311"
								gradientUnits="userSpaceOnUse">
								<stop stop-color="#3D72FB" />
								<stop offset="1" stop-color="#fff" />
							</linearGradient>
						</defs>
					</svg>
				</div>
				<h6><?php echo esc_html( $blog_kicker ); ?></h6>
			</div>
			<h5><?php echo wp_kses_post( $blog_heading ); ?></h5>
		</div>
		<div class="row">
			<?php
			$blog_query = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'post_status'    => 'publish',
				)
			);
			if ( $blog_query->have_posts() ) :
				while ( $blog_query->have_posts() ) :
					$blog_query->the_post();
					$categories    = get_the_category();
					$category_name = ! empty( $categories ) ? $categories[0]->name : '';
					$thumb_url     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : get_template_directory_uri() . '/assets/images/blog-1.png';
					?>
					<div class="col-xl-4 col-md-6 col-sm-12">
						<div class="blog-Item">
							<div class="blog-thumbnail">
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
								<?php if ( $category_name ) : ?>
									<span class="blog-tag">
										<?php echo esc_html( $category_name ); ?>
									</span>
								<?php endif; ?>
							</div>
							<div class="cntn-outer">
								<h4><?php the_title(); ?></h4>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30, '...' ) ); ?></p>
							</div>
							<div class="action-btn">
								<a href="<?php the_permalink(); ?>" class="btn">Read More</a>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				foreach ( $blog_fallback_items as $item ) :
					?>
					<div class="col-xl-4 col-md-6 col-sm-12">
						<div class="blog-Item">
							<div class="blog-thumbnail">
								<img src="<?php echo esc_url( $item['image'] ); ?>" alt="">
								<span class="blog-tag">
									<?php echo esc_html( $item['tag'] ); ?>
								</span>
							</div>
							<div class="cntn-outer">
								<h4><?php echo esc_html( $item['title'] ); ?></h4>
								<p><?php echo wp_kses_post( $item['description'] ); ?></p>
							</div>
							<div class="action-btn">
								<a href="<?php echo esc_url( $item['link_url'] ); ?>" class="btn">Read More</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
?>
