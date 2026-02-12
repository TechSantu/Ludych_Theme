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

$hero_kicker = 'Digital Marketing Packages';
$hero_title  = 'Pricing & Cost <span>In Arizona</span>';
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

<section class="packages-intro-section py-5">
    <div class="custom-container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="packages-intro-content">
                    <p class="mb-4">Our packages start from as low as <strong>$800 per month</strong>, ensuring that even small and local businesses and bootstrapped startups can access quality digital marketing services. Whether you're just starting out or running a well-established enterprise, we have the perfect package for you.</p>
                    <p>Our comprehensive digital marketing services cover all the essentials to boost your online presence. From stunning web design and eCommerce development to expert Search Engine Optimization (SEO) strategies, Social Media Marketing (SMM), and Pay Per Click (PPC) online ads management, we've got you covered.</p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="packages-cta-box p-4 bg-light rounded shadow-sm border-left-blue">
                    <h4 class="mb-3">Why choose Ludych?</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> 5+ Years of Industry Experience</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> 20+ Companies Successfully Helped</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> ROI-Focused Strategies</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Customizable Tailored Solutions</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="globalBtnDark mt-3"><span>Get a Free Consultation</span> <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pricing-plans-section py-5 bg-grey">
    <div class="custom-container">
        <div class="global-header middle-align mb-5">
            <h2>Pricing Plans</h2>
            <div class="min-title">
                <h6>Choose Your Growth Path</h6>
            </div>
            <h5>Our <span>Digital Marketing</span> Packages</h5>
        </div>

        <div class="row">
            <!-- Starter Growth Package -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card h-100">
                    <div class="pricing-header">
                        <span class="package-status">Starter</span>
                        <h3>Starter Growth</h3>
                        <p class="package-ideal">Ideal for: Small businesses, startups, local shops.</p>
                        <div class="price-box">
                            <span class="currency">$</span>
                            <span class="amount">800</span>
                            <span class="period">/mo starting</span>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <ul>
                            <li><strong>WordPress Web Dev:</strong> Up to 5 pages, Mobile responsive, Basic SEO</li>
                            <li><strong>SEO:</strong> Keyword research, Meta tags, Monthly report</li>
                            <li><strong>PPC Ads:</strong> Setup for Google/Bing, Up to $500 spend mgmt</li>
                            <li><strong>Social Media Ads:</strong> FB + IG setup, Audience targeting</li>
                            <li><strong>Email Marketing:</strong> 1 campaign monthly, Basic automation</li>
                            <li><strong>Analytics:</strong> GA + GTM setup, Monthly summary</li>
                        </ul>
                        <div class="package-outcome mt-3 p-3 bg-light rounded">
                            <h6 class="mb-1 text-primary">Outcome:</h6>
                            <p class="small mb-0">Boosts online presence, generates early traffic & creates groundwork for future scaling.</p>
                        </div>
                    </div>
                    <div class="pricing-footer text-center">
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="globalBtnOutline w-100"><span>Get Started</span></a>
                    </div>
                </div>
            </div>

            <!-- Advanced Performance Package -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card featured h-100">
                    <div class="pricing-header">
                        <span class="package-status">Popular</span>
                        <h3>Advanced Performance</h3>
                        <p class="package-ideal">Ideal for: Small–medium businesses ready to scale.</p>
                        <div class="price-box">
                            <span class="currency">$</span>
                            <span class="amount">1,800</span>
                            <span class="period">/mo starting</span>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <ul>
                            <li><strong>WordPress Web Dev:</strong> 8–12 pages, UX enhancement, SEO-ready</li>
                            <li><strong>Comprehensive SEO:</strong> Tech SEO, Competitor analysis, Blog opt</li>
                            <li><strong>PPC Mgmt:</strong> Full campaigns, Up to $1,500 budget mgmt</li>
                            <li><strong>FB & IG Ads:</strong> Retargeting, Lookalike setup, Insights</li>
                            <li><strong>Email Marketing:</strong> 2 campaigns/mo, Automated funnels</li>
                            <li><strong>Conversion Tracking:</strong> Enhanced tracking, Call tracking</li>
                        </ul>
                        <div class="package-outcome mt-3 p-3 rounded" style="background: rgba(61, 114, 251, 0.1);">
                            <h6 class="mb-1 text-primary">Outcome:</h6>
                            <p class="small mb-0">Produces measurable ROI with traffic growth, lead generation, & enhanced brand visibility.</p>
                        </div>
                    </div>
                    <div class="pricing-footer text-center">
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="globalBtnDark w-100"><span>Accelerate Growth</span> <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Enterprise Brand Booster -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card h-100">
                    <div class="pricing-header">
                        <span class="package-status">Enterprise</span>
                        <h3>Enterprise Brand Booster</h3>
                        <p class="package-ideal">Ideal for: Established brands wanting dominance.</p>
                        <div class="price-box">
                            <span class="currency">$</span>
                            <span class="amount">4,500</span>
                            <span class="period">/mo starting</span>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <ul>
                            <li><strong>Premium Web Dev:</strong> Full custom + eCommerce/CRM, Advanced speed</li>
                            <li><strong>Enterprise SEO:</strong> Full tech + Schema, Link building, Audits</li>
                            <li><strong>Advanced PPC:</strong> Google, YouTube, Display, Full funnel</li>
                            <li><strong>SMM Advertising:</strong> LinkedIn ads, Multi-audience segmentation</li>
                            <li><strong>Full Email Automation:</strong> Abandoned cart, Nurture sequences</li>
                            <li><strong>Strategic Insights:</strong> Data dashboards, Heatmaps, Weekly calls</li>
                        </ul>
                        <div class="package-outcome mt-3 p-3 bg-light rounded">
                            <h6 class="mb-1 text-primary">Outcome:</h6>
                            <p class="small mb-0">Holistic digital marketing dominance — increased conversions, stronger branding, and cross-channel synergy.</p>
                        </div>
                    </div>
                    <div class="pricing-footer text-center">
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="globalBtnOutline w-100"><span>Go Enterprise</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pricing-table-section py-5">
    <div class="custom-container">
        <div class="global-header middle-align mb-5">
            <h2>Comparison</h2>
            <div class="min-title">
                <h6>Deliverables Overview</h6>
            </div>
            <h5>Package <span>Guideline</span> Prices</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered custom-pricing-table">
                <thead>
                    <tr>
                        <th class="feature-col">Package</th>
                        <th>Typical Monthly Range (USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="feature-name">Starter Growth</td>
                        <td>$800–$1,500</td>
                    </tr>
                    <tr>
                        <td class="feature-name">Advanced Performance</td>
                        <td>$1,800–$3,500</td>
                    </tr>
                    <tr>
                        <td class="feature-name">Enterprise Brand Booster</td>
                        <td>$4,500–$10,000+</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-4 text-center text-muted"><em>Keep in mind that these are general guidelines and pricing can vary widely depending on the specific company and the level of service provided. It's important to get detailed pricing information for each service.</em></p>
    </div>
</section>

<section class="packages-faq-section py-5 bg-grey">
    <div class="custom-container">
        <div class="global-header middle-align mb-5">
            <h2>FAQ</h2>
            <div class="min-title">
                <h6>Common Questions</h6>
            </div>
            <h5>Digital Marketing <span>Pricing 2026</span></h5>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion custom-accordion" id="packagesFAQ">
                    <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                1. What is the average monthly cost of digital marketing in the USA?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#packagesFAQ">
                            <div class="accordion-body p-4 pt-0 text-muted">
                                Starting from $1000 - depending on scope, services, and agency.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                2. Which digital marketing services offer the best ROI?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#packagesFAQ">
                            <div class="accordion-body p-4 pt-0 text-muted">
                                SEO and content marketing offer high ROI over time. PPC delivers faster but costlier results.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                3. Can I hire a digital marketing agency on a project basis?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#packagesFAQ">
                            <div class="accordion-body p-4 pt-0 text-muted">
                                Yes. Project-based pricing is ideal for one-time campaigns, such as product launches or audits.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                4. How do I choose the right pricing model?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#packagesFAQ">
                            <div class="accordion-body p-4 pt-0 text-muted">
                                Startups often prefer project-based or hybrid retainers. Performance-based works if you need ROI-based accountability.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                5. Is digital marketing expensive for small businesses?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#packagesFAQ">
                            <div class="accordion-body p-4 pt-0 text-muted">
                                Not if planned well. Start with essentials like SEO and social media. Agencies like Ludych Technology offer entry-level plans.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                6. Does pricing vary by industry?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#packagesFAQ">
                            <div class="accordion-body p-4 pt-0 text-muted">
                                Yes. Competitive sectors, such as real estate, finance, and e-commerce, often require higher ad spends and technical SEO.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3 border-0 rounded shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                7. How transparent is digital marketing agency pricing?
                            </button>
                        </h2>
                        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#packagesFAQ">
                            <div class="accordion-body p-4 pt-0 text-muted">
                                Reputed agencies, such as Ludych Technology, share a detailed scope of work, performance KPIs, and monthly reports to ensure clarity.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>
