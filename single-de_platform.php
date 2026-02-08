<?php
/**
 * Single template for individual Platform Items
 */

get_header();
?>

<main id="site-content" role="main">
    <div class="container content-narrow">
        <article class="platform-item">
            <?php while (have_posts()) : the_post();

                $mainImage = get_field('main-image');
                // $customDate = get_field('custom-date');
                $customTitle = get_field('custom-title');

                // $date = $customDate ? date_i18n(get_option('date_format'), strtotime($customDate)) : get_the_date();
                $title = $customTitle ? esc_html($customTitle) : get_the_title();
            ?>

                <div class="platform-header">
                    <h1 class="platform-title"><?php echo esc_html($title); ?></h1>
                    <!-- <p class="platform-date"><?php echo esc_html($date); ?></p> -->
                </div>

                <?php if ($mainImage) : ?>
                    <div class="platform-photo">
                        <img src="<?php echo esc_url($mainImage['url']); ?>" alt="<?php echo esc_attr($mainImage['alt']); ?>" />
                    </div>
                <?php endif; ?>

                <div class="platform-content">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>
        </article>
    </div>
</main>

<?php get_footer(); ?>
