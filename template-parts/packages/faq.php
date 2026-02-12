<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$faq_kicker      = $acf_ready ? get_field( 'packages_faq_kicker', $post_id ) : 'Common Queries';
$faq_title       = $acf_ready ? get_field( 'packages_faq_title', $post_id ) : 'Digital Marketing <br><span class="text-primary">Pricing FAQ 2026</span>';
$faq_description = $acf_ready ? get_field( 'packages_faq_description', $post_id ) : 'Clear answers to help you navigate your digital investment decisions with Ludych Technology.';

$faqs = $acf_ready ? get_field( 'packages_faqs', $post_id ) : array();

if ( empty( $faqs ) ) {
	$faqs = array(
		array(
			'question' => 'What is the average monthly cost in the USA?',
			'answer'   => 'Starting from $1,000 - depending on scope, services, and agency.',
		),
		array(
			'question' => 'Which digital marketing services offer the best ROI?',
			'answer'   => 'SEO and content marketing offer high ROI over time. PPC delivers faster but costlier results.',
		),
		array(
			'question' => 'Can I hire an agency on a project basis?',
			'answer'   => 'Yes. Project-based pricing is ideal for one-time campaigns, such as product launches or audits.',
		),
		array(
			'question' => 'How do I choose the right pricing model?',
			'answer'   => 'Startups often prefer project-based or hybrid retainers. Performance-based works if you need ROI-based accountability.',
		),
		array(
			'question' => 'Is digital marketing expensive for small businesses?',
			'answer'   => 'Not if planned well. Start with essentials like SEO and social media. Agencies like Ludych Technology offer entry-level plans.',
		),
		array(
			'question' => 'Does pricing vary by industry?',
			'answer'   => 'Yes. Competitive sectors, such as real estate, finance, and e-commerce, often require higher ad spends and technical SEO.',
		),
		array(
			'question' => 'How transparent is your pricing?',
			'answer'   => 'Reputed agencies, such as Ludych Technology, share a detailed scope of work, performance KPIs, and monthly reports to ensure clarity.',
		),
	);
}

$faq_schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array(),
);

foreach ( $faqs as $faq ) {
	$faq_schema['mainEntity'][] = array(
		'@type'          => 'Question',
		'name'           => $faq['question'] ?? '',
		'acceptedAnswer' => array(
			'@type' => 'Answer',
			'text'  => $faq['answer'] ?? '',
		),
	);
}
?>

<section class="lp-faq-section py-5 bg-grey overflow-hidden">
	<div class="custom-container">
		<div class="row g-5">
			<div class="col-lg-4">
				<div class="faq-intro h-100 d-flex flex-column">
					<h6 class="text-primary fw-bold text-uppercase ls-1"><?php echo esc_html( $faq_kicker ); ?></h6>
					<h2 class="display-6 fw-bold mb-4"><?php echo wp_kses_post( $faq_title ); ?></h2>
					<p class="text-muted mb-4"><?php echo esc_html( $faq_description ); ?></p>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/custom-icon-star.svg" alt="" class="mt-auto faq-deco-img opacity-25 animate-spin">
				</div>
			</div>
			<div class="col-lg-8">
				<div class="accordion modern-faq-accordion" id="lpFAQ">
					<?php foreach ( $faqs as $i => $faq ) : ?>
						<div class="accordion-item mb-3">
							<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#lp-faq-<?php echo $i; ?>">
									<span class="faq-num me-3">0<?php echo $i + 1; ?></span> 
									<?php echo esc_html( $faq['question'] ?? '' ); ?>
								</button>
							</h2>
							<div id="lp-faq-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#lpFAQ">
								<div class="accordion-body">
									<?php echo esc_html( $faq['answer'] ?? '' ); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="application/ld+json">
<?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>
