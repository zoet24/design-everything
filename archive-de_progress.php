<?php
/**
 * Archive template for Progress Items
 * Displays all 'de_progress' posts in a grid.
 */

get_header();

$progress_page = get_page_by_path('progress');

if ($progress_page) {
    setup_postdata($progress_page);
    
    // Get ACF fields from the Progress page
    $intro_background_image = get_field('page_background_image', $progress_page->ID);
    $intro_title = get_field('page_intro_title', $progress_page->ID);
    $intro_post = get_field('page_intro_text', $progress_page->ID);
    
    wp_reset_postdata();
}
?>

<div class="page-content" data-nav-position="bottom-right">
    <?php if ($intro_background_image && $intro_post): ?>
        <div 
            class="text-box-slide" 
            style="background-image: url('<?php echo esc_url($intro_background_image['url']); ?>');"
            data-origin="bottom-right"
        >
            <div class="text-box-content">
                <h2><?php echo esc_html($intro_title); ?></h2>
                <?php 
                    if ($intro_post) {
                        echo apply_filters('the_content', $intro_post->post_content);
                    }
                ?>
            </div>
        </div>
    <?php endif; ?>


    <main id="site-content" role="main" style="--page-bg-image: url('<?php echo esc_url($intro_background_image['url']); ?>');">
        <div class="container progress">
            <div class="progress__grid">

            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>