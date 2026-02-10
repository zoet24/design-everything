<?php 
/**
 * Archive template for People Items
 * Displays all 'de_person' posts in a grid.
 */

get_header(); 

$people_page = get_page_by_path('people');

if ($people_page) {
    setup_postdata($people_page);
    
    // Get ACF fields from the People page
    $intro_background_image = get_field('page_background_image', $people_page->ID);
    $intro_title = get_field('page_intro_title', $people_page->ID);
    $intro_post = get_field('page_intro_text', $people_page->ID);
    
    wp_reset_postdata();
}
?>

<div class="page-content" data-nav-position="bottom-left">
    <?php if ($intro_background_image && $intro_post): ?>
        <div 
            class="text-box-slide" 
            style="background-image: url('<?php echo esc_url($intro_background_image['url']); ?>');"
            data-origin="bottom-left"
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
        <div class="container people">
            <div class="people__grid">
                <?php
                $people = new WP_Query([
                    'post_type' => 'de_person',
                    'posts_per_page' => -1,
                ]);

                if ($people->have_posts()) :
                    while ($people->have_posts()) : $people->the_post();
                        $image = get_field('profile_image');
                ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="person">
                            <?php if ($image) : ?>
                                <div class="person__photo">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                </div>
                            <?php endif; ?>

                            <div class="person__content">
                                <h3 class="person__name"><?php the_title(); ?></h3>
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