<?php
/**
 * Template part for displaying single post content
 */
$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Uncategorized';
?>
<div class="col-12">
    <div class="blog-details">
        <div class="blog-thumbnail">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'full' ); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-1.png" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            <span class="blog-tag">
                <?php echo esc_html( $cat_name ); ?>
            </span>
        </div>
        <div class="blog-detail-text">
            <span class="post-date"><?php echo get_the_date( 'l F j, Y' ); ?></span>

            <h1><?php the_title(); ?></h1>
            
            <?php the_content(); ?>
        </div>                        
    </div>
</div>
