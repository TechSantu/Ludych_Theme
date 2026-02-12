<?php
/*
Template Name: Packages Page
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id   = get_the_ID();
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

// Hero Section
$hero_bg = $acf_ready ? get_field( 'packages_hero_background', $post_id ) : '';
if ( is_array( $hero_bg ) ) {
	$hero_bg = $hero_bg['url'] ?? '';
}
if ( ! $hero_bg ) {
	$hero_bg = get_template_directory_uri() . '/assets/images/services-bg.jpg';
}

$hero_kicker   = 'Digital Marketing Packages';
$hero_title    = 'Pricing & Cost <span>In Arizona</span>';
$hero_subtitle = 'Looking for top-notch digital marketing packages in Arizona? We offer various affordable options at Ludych Technology Agency to suit every need and budget.';

get_header();
?>

<section class="inner-banner-wrap with-overlay text-center" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
	<div class="custom-container">
		<div class="inner-banner">
			<div class="global-header about-head">
				<h2>Packages</h2>
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

<section class="packages-lp-intro py-5 overflow-hidden">
	<div class="custom-container">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-4 mb-lg-0">
				<div class="lp-intro-badge mb-3">
					<span class="badge rounded-pill bg-soft-primary px-3 py-2 text-primary font-weight-bold">Arizona's #1 Digital Agency</span>
				</div>
				<h2 class="display-5 fw-bold mb-4">Empowering <span class="text-gradient">Local Businesses</span> with ROI-Driven Marketing</h2>
				<p class="lead text-muted mb-4 text-justify">Our packages start from as low as <strong>$800 per month</strong>, ensuring that even small and local businesses and bootstrapped startups can access quality digital marketing services. Whether you're just starting out or running a well-established enterprise, we have the perfect package for you.</p>
				
				<div class="lp-stats row g-4 mt-2">
					<div class="col-6">
						<div class="lp-stat-card p-3 border rounded-3 bg-white shadow-sm">
							<h3 class="fw-bold text-primary mb-1">5+</h3>
							<p class="small text-muted mb-0">Years Experience</p>
						</div>
					</div>
					<div class="col-6">
						<div class="lp-stat-card p-3 border rounded-3 bg-white shadow-sm">
							<h3 class="fw-bold text-primary mb-1">20+</h3>
							<p class="small text-muted mb-0">Global Clients</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 position-relative">
				<div class="lp-intro-image-wrap ps-lg-5">
					<div class="lp-main-img-bg"></div>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-left.jpg" alt="Ludych Technology" class="img-fluid rounded-4 shadow-lg position-relative z-index-1">
					<div class="floating-badge shadow-lg rounded-3 p-3 bg-white position-absolute top-10 start-0 z-index-2 animate-bounce">
						<div class="d-flex align-items-center gap-3">
							<div class="badge-icon bg-success-soft p-2 rounded-circle">
								<i class="fas fa-chart-line text-success"></i>
							</div>
							<div>
								<h6 class="mb-0 fw-bold">+250%</h6>
								<p class="small text-muted mb-0">Avg. Revenue Growth</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="modern-pricing-section py-5 position-relative bg-light">
	<!-- Decorative background elements -->
	<div class="pricing-blob blob-1"></div>
	<div class="pricing-blob blob-2"></div>
	
	<div class="custom-container position-relative z-index-1">
		<div class="global-header middle-align mb-5 pb-4">
			<h2>Our Plans</h2>
			<div class="min-title">
				<h6>Strategic Growth Tiers</h6>
			</div>
			<h5 class="fw-bold">Scale Your Business with <span>Precision</span></h5>
		</div>

		<div class="row g-4 align-items-stretch">
			<!-- Starter -->
			<div class="col-lg-4">
				<div class="modern-card package-starter h-100">
					<div class="card-header-v2">
						<div class="pkg-icon mb-4"><i class="fas fa-rocket"></i></div>
						<h4>Starter Growth</h4>
						<p class="text-muted small mb-4">Perfect for startups and local businesses looking to establish their presence.</p>
						<div class="pkg-price mb-4">
							<span class="price-val">$800</span>
							<span class="price-label">/ month starting</span>
						</div>
					</div>
					<div class="card-body-v2">
						<ul class="pkg-features">
							<li><i class="fas fa-check"></i> WordPress Dev (5 Pages)</li>
							<li><i class="fas fa-check"></i> Foundational On-page SEO</li>
							<li><i class="fas fa-check"></i> PPC Setup (Google/Bing)</li>
							<li><i class="fas fa-check"></i> Social Media Ads Setup</li>
							<li><i class="fas fa-check"></i> 1 Email Campaign / Month</li>
							<li><i class="fas fa-check"></i> Monthly Performance Report</li>
						</ul>
					</div>
					<div class="card-footer-v2 mt-auto pt-4 border-0 bg-transparent">
						<div class="outcome-pill mb-4">
							<span class="small fw-bold text-primary"><i class="fas fa-bullseye me-2"></i> GROUNDWORK FOR SCALE</span>
						</div>
						<a href="<?php echo esc_url(home_url('/contact')); ?>" class="lp-btn lp-btn-outline w-100">Select Plan</a>
					</div>
				</div>
			</div>

			<!-- Advanced -->
			<div class="col-lg-4">
				<div class="modern-card package-advanced featured h-100 position-relative">
					<div class="featured-badge">MOST POPULAR</div>
					<div class="card-header-v2">
						<div class="pkg-icon mb-4 text-white"><i class="fas fa-bolt"></i></div>
						<h4 class="text-white">Advanced Performance</h4>
						<p class="text-white opacity-75 small mb-4">Designed for businesses ready to accelerate leads and dominate traffic.</p>
						<div class="pkg-price mb-4 text-white font-custom-style">
							<span class="price-val">$1,800</span>
							<span class="price-label opacity-75">/ month starting</span>
						</div>
					</div>
					<div class="card-body-v2">
						<ul class="pkg-features text-white">
							<li><i class="fas fa-check"></i> 8-12 Page Custom WP Site</li>
							<li><i class="fas fa-check"></i> Technical & Competitor SEO</li>
							<li><i class="fas fa-check"></i> Managed Ad Budget Up to $1,500</li>
							<li><i class="fas fa-check"></i> FB & IG Retargeting Campaigns</li>
							<li><i class="fas fa-check"></i> 2 Automated Email Funnels</li>
							<li><i class="fas fa-check"></i> Enhanced Conversion Tracking</li>
						</ul>
					</div>
					<div class="card-footer-v2 mt-auto pt-4 border-0 bg-transparent">
						<div class="outcome-pill featured-pill mb-4">
							<span class="small fw-bold text-white"><i class="fas fa-chart-line me-2"></i> MEASURABLE LEAD GROWTH</span>
						</div>
						<a href="<?php echo esc_url(home_url('/contact')); ?>" class="lp-btn lp-btn-primary w-100">Select Plan</a>
					</div>
				</div>
			</div>

			<!-- Enterprise -->
			<div class="col-lg-4">
				<div class="modern-card package-enterprise h-100">
					<div class="card-header-v2">
						<div class="pkg-icon mb-4"><i class="fas fa-crown"></i></div>
						<h4>Enterprise Booster</h4>
						<p class="text-muted small mb-4">Full-channel dominance with deep optimization and dedicated coordination.</p>
						<div class="pkg-price mb-4">
							<span class="price-val">$4,500</span>
							<span class="price-label">/ month starting</span>
						</div>
					</div>
					<div class="card-body-v2">
						<ul class="pkg-features">
							<li><i class="fas fa-check"></i> Custom eCommerce/CRM Integration</li>
							<li><i class="fas fa-check"></i> High-Authority Link Building</li>
							<li><i class="fas fa-check"></i> Managed Budget $5,000+</li>
							<li><i class="fas fa-check"></i> Cross-Channel Retargeting</li>
							<li><i class="fas fa-check"></i> Advanced Automation Workflows</li>
							<li><i class="fas fa-check"></i> Weekly Strategic Calls</li>
						</ul>
					</div>
					<div class="card-footer-v2 mt-auto pt-4 border-0 bg-transparent">
						<div class="outcome-pill mb-4">
							<span class="small fw-bold text-primary"><i class="fas fa-chess-king me-2"></i> MARKET DOMINANCE</span>
						</div>
						<a href="<?php echo esc_url(home_url('/contact')); ?>" class="lp-btn lp-btn-outline w-100">Select Plan</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="pricing-comparison-lp py-5">
	<div class="custom-container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="comparison-teaser text-center mb-5">
					<h5 class="fw-bold mb-3">Not sure which one fits?</h5>
					<p class="text-muted">Prices vary depending on deliverables, goals, and scope. Every business is unique, and so are our solutions.</p>
				</div>
				
				<div class="pricing-tier-summary p-4 bg-white rounded-4 shadow-sm border">
					<div class="row align-items-center mb-3 pb-3 border-bottom g-3">
						<div class="col-6 col-md-5">
							<span class="fw-bold text-dark">Starter Growth</span>
						</div>
						<div class="col-6 col-md-7 text-end">
							<span class="pricing-range py-1 px-3 bg-light rounded-pill">$800 – $1,500 / mo</span>
						</div>
					</div>
					<div class="row align-items-center mb-3 pb-3 border-bottom g-3">
						<div class="col-6 col-md-5">
							<span class="fw-bold text-dark">Advanced Performance</span>
						</div>
						<div class="col-6 col-md-7 text-end">
							<span class="pricing-range py-1 px-3 bg-light rounded-pill">$1,800 – $3,500 / mo</span>
						</div>
					</div>
					<div class="row align-items-center g-3">
						<div class="col-6 col-md-5">
							<span class="fw-bold text-dark">Enterprise Brand Booster</span>
						</div>
						<div class="col-6 col-md-7 text-end">
							<span class="pricing-range py-1 px-3 bg-light rounded-pill">$4,500 – $10,000+ / mo</span>
						</div>
					</div>
				</div>
				
				<div class="text-center mt-5">
					<p class="text-muted mb-4">We offer free digital marketing consultations followed by detailed quotations.</p>
					<a href="<?php echo esc_url(home_url('/contact')); ?>" class="globalBtnDark"><span>Request Detailed Quote</span> <i class="fa-solid fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="lp-faq-section py-5 bg-grey overflow-hidden">
	<div class="custom-container">
		<div class="row g-5">
			<div class="col-lg-4">
				<div class="faq-intro h-100 d-flex flex-column">
					<h6 class="text-primary fw-bold text-uppercase ls-1">Common Queries</h6>
					<h2 class="display-6 fw-bold mb-4">Digital Marketing <br><span class="text-primary">Pricing FAQ 2026</span></h2>
					<p class="text-muted mb-4">Clear answers to help you navigate your digital investment decisions with Ludych Technology.</p>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/custom-icon-star.svg" alt="" class="mt-auto faq-deco-img opacity-25 animate-spin">
				</div>
			</div>
			<div class="col-lg-8">
				<div class="accordion modern-faq-accordion" id="lpFAQ">
					<?php
					$faqs = array(
						array(
							'q' => 'What is the average monthly cost in the USA?',
							'a' => 'Starting from $1,000 - depending on scope, services, and agency.',
						),
						array(
							'q' => 'Which digital marketing services offer the best ROI?',
							'a' => 'SEO and content marketing offer high ROI over time. PPC delivers faster but costlier results.',
						),
						array(
							'q' => 'Can I hire an agency on a project basis?',
							'a' => 'Yes. Project-based pricing is ideal for one-time campaigns, such as product launches or audits.',
						),
						array(
							'q' => 'How do I choose the right pricing model?',
							'a' => 'Startups often prefer project-based or hybrid retainers. Performance-based works if you need ROI-based accountability.',
						),
						array(
							'q' => 'Is digital marketing expensive for small businesses?',
							'a' => 'Not if planned well. Start with essentials like SEO and social media. Agencies like Ludych Technology offer entry-level plans.',
						),
						array(
							'q' => 'Does pricing vary by industry?',
							'a' => 'Yes. Competitive sectors, such as real estate, finance, and e-commerce, often require higher ad spends and technical SEO.',
						),
						array(
							'q' => 'How transparent is your pricing?',
							'a' => 'Reputed agencies, such as Ludych Technology, share a detailed scope of work, performance KPIs, and monthly reports to ensure clarity.',
						),
					);
					foreach ( $faqs as $i => $faq ) :
						?>
					<div class="accordion-item mb-3">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lp-faq-<?php echo $i; ?>">
								<span class="faq-num me-3">0<?php echo $i + 1; ?></span> <?php echo $faq['q']; ?>
							</button>
						</h2>
						<div id="lp-faq-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#lpFAQ">
							<div class="accordion-body">
								<?php echo $faq['a']; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
?>
