<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$faq_title = ( $acf_ready ? get_field( 'packages_faq_title', $post_id ) : '' ) ?: 'Frequently Asked Questions';
$faqs      = $acf_ready ? get_field( 'packages_faqs', $post_id ) : array();

if ( empty( $faqs ) ) {
	$faqs = array(
		array(
			'question' => 'How long does it take to see results from digital marketing?',
			'answer'   => 'Results vary by strategy and industry. SEO typically takes 3-6 months for significant results, while PPC advertising can show immediate traffic.',
		),
		array(
			'question' => 'What\'s included in your marketing audit?',
			'answer'   => 'Our comprehensive marketing audit includes website analysis, SEO performance review, competitor analysis, and existing campaign assessment.',
		),
		array(
			'question' => 'Do you work with businesses in my industry?',
			'answer'   => 'We have experience across virtually all industries including e-commerce, SaaS, healthcare, finance, education, and more.',
		),
		array(
			'question' => 'How do you measure marketing success?',
			'answer'   => 'We track KPIs relevant to your business goals: website traffic, lead generation, conversion rates, and ROI.',
		),
	);
}
?>

<section class="section-faq">
	<div class="faq-container">
		<h2 class="font-inria text-center section-title"><?php echo esc_html( $faq_title ); ?></h2>
		<div class="faq-list">
			<?php foreach ( $faqs as $i => $faq ) : ?>
			<div class="faq-item <?php echo $i === 0 ? 'active' : ''; ?>">
				<button class="faq-quest">
					<?php echo esc_html( $faq['question'] ); ?>
					<span class="faq-toggle"><?php echo $i === 0 ? '-' : '+'; ?></span>
				</button>
				<div class="faq-ans" style="<?php echo $i === 0 ? 'max-height: 300px; padding-bottom: 2rem;' : ''; ?>">
					<p><?php echo esc_html( $faq['answer'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<script>
// Inline JS for FAQ (or move to global js file)
document.addEventListener('DOMContentLoaded', function() {
	document.querySelectorAll('.faq-quest').forEach(button => {
		button.addEventListener('click', () => {
			const item = button.parentElement;
			const isOpen = item.classList.contains('active');

			// Close all others
			document.querySelectorAll('.faq-item').forEach(i => {
				i.classList.remove('active');
				i.querySelector('.faq-toggle').textContent = '+';
				i.querySelector('.faq-ans').style.maxHeight = null;
				i.querySelector('.faq-ans').style.paddingBottom = null;
			});

			if (!isOpen) {
				item.classList.add('active');
				button.querySelector('.faq-toggle').textContent = '-';
				const ans = item.querySelector('.faq-ans');
				ans.style.maxHeight = ans.scrollHeight + "px";
				ans.style.paddingBottom = "2rem";
			}
		});
	});
});
</script>

<?php
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
<script type="application/ld+json">
<?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>

