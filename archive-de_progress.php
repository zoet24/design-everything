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
    $intro_text = get_field('page_intro_text', $progress_page->ID);
    
    wp_reset_postdata();
}
?>

<div class="page-content" data-nav-position="bottom-right">
    <?php if (!empty($intro_background_image)): ?>
        <div 
            class="text-box-slide" 
            style="background-image: url('<?php echo esc_url($intro_background_image['url']); ?>');"
            data-origin="bottom-right"
        >
            <div class="text-box-content">
                <?php echo wp_kses_post($intro_text); ?>
            </div>
        </div>
    <?php endif; ?>

    <main id="site-content" role="main">
        <div class="container">
            <section class="progress-page">

                <?php if (have_posts()) : ?>
                    <div class="progress-grid">
                        <?php while (have_posts()) : the_post();

                            // Get ACF fields
                            $mainImage = get_field('main-image');
                            $customDate = get_field('custom-date');
                            $customTitle = get_field('custom-title');
                            $description = get_field('description');

                            // Fallbacks
                            if ($customDate) {
                                // ACF default date format is YYYYMMDD
                                $dateObj = DateTime::createFromFormat('Ymd', $customDate);
                                $date = $dateObj ? $dateObj->format(get_option('date_format')) : get_the_date();
                            } else {
                                $date = get_the_date();
                            }
                            $title = $customTitle ? esc_html($customTitle) : get_the_title();
                            ?>

                            <div class="progress-card">
                                <a href="<?php the_permalink(); ?>" class="progress-link">
                                    <?php if ($mainImage) : ?>
                                        <div class="progress-photo">
                                            <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>" />
                                        </div>
                                    <?php endif; ?>

                                    <div class="progress-content">
                                        <p class="progress-date"><?php echo esc_html($date); ?></p>
                                        <h3 class="progress-title"><?php echo esc_html($title); ?></h3>

                                        <?php if ($description) : ?>
                                            <p class="progress-description"><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>

                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p>No progress items found.</p>
                <?php endif; ?>

            </section>
        </div>
    </main>
</div>

<?php get_footer(); ?>