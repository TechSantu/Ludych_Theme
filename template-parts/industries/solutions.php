<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post_id;

$heading  = get_field( 'solutions_heading', $post_id );
$subtitle = get_field( 'solutions_subtitle', $post_id );
$title    = get_field( 'solutions_title', $post_id );
$fallback_icon = '<svg aria-hidden="true" class="e-font-icon-svg e-fas-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>';
?>

<section class="our-services industry-serve future-ready-section">
	<div class="custom-container">
		<div class="global-header">
			<?php if ( $heading ) : ?>
				<h2><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<div class="min-title">
				<div class="icon-box">
					<svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none">
						<path d="M3.17827 26.2127c.17154-.0247 2.32423-.0489 4.80266-.0684 6.44077-.0183 12.28407-.0631 16.78827-.1267.7236-.0079 1.6447-.1217 2.02299-.243 1.7294-.5367 3.062-2.273 3.1985-4.1527l.0283-.5605-1.3019.0542-1.32.0538-.0128.3798c-.0189.5877-.1586.9476-.5333 1.3223-.4371.4372-.6808.479-3.0417.4912-2.3971.0116-4.9842.0296-9.4613.0845-1.8905.0188-4.3597.0475-5.4814.0499-1.13089-.0068-2.4063.0024-2.83144.0055l-.77788.0072.03852-.4789c.04719-.5059.49483-1.4857.85168-1.8426.11598-.1159.43842-.3466.71651-.5146.55642-.3179 1.23414-.3717 4.94284-.3921 3.564-.0225 8.7558-.0764 9.4883-.0933 1.5915-.05 3.0642-.8255 3.9511-2.0976 1.0109-1.4514 1.0267-1.614-.2493-9.04493-.0849-2.19041-.1643-4.62499-.2024-5.41256-.0201-.78731-.084-1.47573-.1299-1.52161-.156-.15597-.9392.11349-1.4314.49559-1.029.80881-1.028 0.88119-.7487 8.54741.0742 2.0726.0825 3.9544.0042 4.1794-.0601.2254-.3077.638-.5299.9153-.7469.9304-.9727.9544-8.2543 1.0062-5.94273.0524-6.78357.0858-7.64814.3632-1.8999.6338-3.30335 1.8354-4.05816 3.4893-.53533 1.1776-.67812 1.9626-.63797 3.5373.03073 1.5473.11406 1.6842.81804 1.5674z" fill="url(#a)" />
						<defs>
							<linearGradient id="a" x1="2.10682" y1="24.5083" x2="28.4018" y2="11.5311" gradientUnits="userSpaceOnUse">
								<stop stop-color="#3D72FB" />
								<stop offset="1" stop-color="#fff" />
							</linearGradient>
						</defs>
					</svg>
				</div>
				<?php if ( $subtitle ) : ?>
					<h6><?php echo esc_html( $subtitle ); ?></h6>
				<?php endif; ?>
			</div>
			<?php if ( $title ) : ?>
				<h5><?php echo wp_kses_post( $title ); ?></h5>
			<?php endif; ?>
		</div>

		<?php if ( have_rows( 'solutions_items', $post_id ) ) : ?>
			<div class="Future-Ready">
				<div class="rows future-ready-grid">
					<?php
					while ( have_rows( 'solutions_items', $post_id ) ) :
						the_row();
						$item_title       = get_sub_field( 'title' );
						$item_description = get_sub_field( 'description' );
						?>
						<div class="future-ready-items">
							<div class="Future-Ready-item">
								<div class="items-thumb">
									<?php echo $fallback_icon; ?>
								</div>
								<div class="items-inner">
									<?php if ( $item_title ) : ?>
										<h3><?php echo esc_html( $item_title ); ?></h3>
									<?php endif; ?>
									<?php if ( $item_description ) : ?>
										<p><?php echo esc_html( $item_description ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
