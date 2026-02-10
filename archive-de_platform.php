<?php
/**
 * Archive template for Platform Items
 * Displays all 'de_platform' posts in a grid.
 */

get_header();

$platform_page = get_page_by_path('platform');

if ($platform_page) {
    setup_postdata($platform_page);
    
    // Get ACF fields from the Platform page
    $intro_background_image = get_field('page_background_image', $platform_page->ID);
    $intro_title = get_field('page_intro_title', $platform_page->ID);
    $intro_post = get_field('page_intro_text', $platform_page->ID);
    
    wp_reset_postdata();
}
?>

<div class="page-content" data-nav-position="bottom-center">
    <?php if ($intro_background_image && $intro_post): ?>
        <div 
            class="text-box-slide" 
            style="background-image: url('<?php echo esc_url($intro_background_image['url']); ?>');"
            data-origin="bottom-center"
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
        <div class="container platforms">
            <div class="platforms__grid">
                <?php
                    $platform = new WP_Query([
                        'post_type' => 'de_platform',
                        'posts_per_page' => -1,
                    ]);

                    if ($platform->have_posts()) :
                        while ($platform->have_posts()) : $platform->the_post();
                            $image = get_field('platform_image');
                    ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="platform">
                        <?php if ($image) : ?>
                            <div class="platform__photo">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                    
                        <div class="platform__content">
                            <h3 class="platform__name"><?php the_title(); ?></h3>
                        </div>
                    </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>