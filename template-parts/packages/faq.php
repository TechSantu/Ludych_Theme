<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;
$acf_ready = function_exists( 'get_field' ) && function_exists( 'acf' ) && is_object( acf() );

$faq_title = ( $acf_ready ? get_field( 'packages_faq_title', $post_id ) : '' ) ?: 'FAQs: Digital Marketing Pricing 2026';
$faqs      = $acf_ready ? get_field( 'packages_faqs', $post_id ) : array();

if ( empty( $faqs ) ) {
	$faqs = array(
		array(
			'question' => 'What is the average monthly cost of digital marketing in the USA?',
			'answer'   => 'Starting from $1000 - depending on scope, services, and agency.',
		),
		array(
			'question' => 'Which digital marketing services offer the best ROI?',
			'answer'   => 'SEO and content marketing offer high ROI over time. PPC delivers faster but costlier results.',
		),
		array(
			'question' => 'Can I hire a digital marketing agency on a project basis?',
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
			'question' => 'How transparent is digital marketing agency pricing?',
			'answer'   => 'Reputed agencies, such as Ludych Technology, share a detailed scope of work, performance KPIs, and monthly reports to ensure clarity.',
		),
	);
}
?>

<section class="section-faq">
	<div class="faq-container">
		<div class="global-header middle-align">
			<h2>FAQs</h2>
			<div class="min-title">
				<div class="icon-box">
					<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
						<path d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z" fill="url(#pkg-faq-grad)" />
						<defs>
							<linearGradient id="pkg-faq-grad" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311" gradientUnits="userSpaceOnUse">
								<stop stop-color="#3D72FB" />
								<stop offset="1" stop-color="#fff" />
							</linearGradient>
						</defs>
					</svg>
				</div>
				<h6>Questions</h6>
			</div>
			<h5><?php echo esc_html( $faq_title ); ?></h5>
		</div>
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
