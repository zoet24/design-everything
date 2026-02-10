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
        <div class="container progresses">
            <div class="progresses__grid">
                <?php
                    $progress = new WP_Query([
                        'post_type' => 'de_progress',
                        'posts_per_page' => -1,
                    ]);

                    if ($progress->have_posts()) :
                        while ($progress->have_posts()) : $progress->the_post();
                            $description = get_field('description');
                            $date = get_field('date');
                            $image = get_field('progress_image');
                    ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="progress">
                        <div class="progress__content">
                            <h3 class="progress__name"><?php the_title(); ?></h3>
                            <p class="progress__description"><?php echo esc_html($description); ?></p>
                            <p class="progress__date"><?php echo esc_html($date); ?></p>
                        </div>    
                    
                        <?php if ($image) : ?>
                            <div class="progress__photo">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                    
                        
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