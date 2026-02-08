<?php
/**
 * Archive template for Platform Items
 * Displays all 'de_platform' posts in a grid.
 */

    get_header();

    $platform_page = get_page_by_path('platform');

    if ($platform_page) {
        setup_postdata($platform_page);
    }
?>

<main id="site-content" role="main">
    <div class="container">
        <section class="platform-page">

            <?php if (have_posts()) : ?>
                <div class="platform-grid">
                    <?php while (have_posts()) : the_post();

                        // Get ACF fields
                        $mainImage = get_field('main-image');
                        $customTitle = get_field('custom-title');

                        // Fallbacks
                        $title = $customTitle ? esc_html($customTitle) : get_the_title();
                        ?>

                        <div class="platform-card">
                            <a href="<?php the_permalink(); ?>" class="platform-link">
                                <?php if ($mainImage) : ?>
                                    <div class="platform-photo">
                                        <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>" />
                                    </div>
                                <?php endif; ?>

                                <div class="platform-content">
                                    <h3 class="platform-title"><?php echo esc_html($title); ?></h3>
                                </div>
                            </a>
                        </div>

                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>No platform items found.</p>
            <?php endif; ?>

        </section>
    </div>
</main>

<?php get_footer(); ?>
