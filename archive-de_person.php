<?php 
/**
 * Archive template for Progress Items
 * Displays all 'de_progress' posts in a grid.
 */

    get_header(); 

    $people_page = get_page_by_path('people');

    if ($people_page) {
        setup_postdata($people_page);
    }
?>

<main id="site-content" role="main">
    <div class="container">
        <section class="people-page">
            <div class="people-grid">
                <?php
                $people = new WP_Query([
                    'post_type' => 'de_person',
                    'posts_per_page' => -1,
                ]);

                if ($people->have_posts()) :
                    while ($people->have_posts()) : $people->the_post();
                        $image = get_field('image');
                        $bio = get_field('bio');
                        $categories = get_field('category');
                        $contact1 = get_field('contact-1');
                        $contact2 = get_field('contact-2');
                ?>
                        <div class="person-card">
                            <?php if ($image) : ?>
                                <div class="person-photo">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

                                    <?php if ($bio || $categories) : ?>
                                        <div class="person-overlay">
                                            <div class="person-bio-container">
                                                <?php if ($bio) : ?>
                                                    <p class="person-bio"><?php echo esc_html($bio); ?></p>
                                                <?php endif; ?>

                                                <?php if ($categories) : ?>
                                                    <div class="person-categories">
                                                        <?php
                                                        if (is_array($categories)) {
                                                            foreach ($categories as $category) {
                                                                echo '<span class="person-category">' . esc_html($category) . '</span>';
                                                            }
                                                        } else {
                                                            echo '<span class="person-category">' . esc_html($categories) . '</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="person-content">
                                <h3 class="person-name"><?php the_title(); ?></h3>

                                <?php if ($contact1 && is_array($contact1)) : ?>
                                    <p class="person-links">
                                        <a href="<?php echo esc_url($contact1['url']); ?>" target="<?php echo esc_attr($contact1['target'] ?? '_blank'); ?>">
                                            <?php echo esc_html($contact1['title'] ?? 'Contact 1'); ?>
                                        </a>

                                        <?php if ($contact2 && is_array($contact2)) : ?>
                                            <a href="<?php echo esc_url($contact2['url']); ?>" target="<?php echo esc_attr($contact2['target'] ?? '_blank'); ?>">
                                                <?php echo esc_html($contact2['title'] ?? 'Contact 2'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
