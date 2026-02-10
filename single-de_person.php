<?php
/**
 * Single template for individual People Items
 */

get_header();

// Get person fields
$person_profile = get_field('profile_image');
$person_email = get_field('email');
$person_insta = get_field('insta');
$person_website = get_field('website');
$person_description = get_field('description');

$people_page = get_page_by_path('people');

if ($people_page) {
    setup_postdata($people_page);
    
    // Get background image from the People page
    $intro_background_image = get_field('page_background_image', $people_page->ID);
    
    wp_reset_postdata();
}
?>

<div class="page-content" data-nav-position="bottom-left">
    <?php if ($intro_background_image): ?>
        <div 
            class="text-box-slide" 
            style="background-image: url('<?php echo esc_url($intro_background_image['url']); ?>');"
            data-origin="bottom-left"
        >
            <div class="text-box-content person-profile">
                <h2><a href="/people">People</a> / <?php echo esc_html(get_the_title()); ?></h2>
                <?php if ($person_profile) : ?>
                    <div class="person-profile__photo">
                        <img src="<?php echo esc_url($person_profile['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                <?php endif; ?>
                <div class="person-profile__contact">
                    <a href="mailto:<?php echo antispambot(esc_attr($person_email)); ?>">
                        <?php echo esc_html($person_email); ?>
                    </a>
                    <?php if ($person_insta): ?>
                        <a href="https://instagram.com/<?php echo esc_attr($person_insta); ?>" target="_blank" rel="noopener">
                            @<?php echo esc_html($person_insta); ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($person_website); ?>" target="_blank" rel="noopener">
                        <?php echo esc_html($person_website); ?>
                    </a>
                </div>
                <div class="person-profile__description">
                    <p><?php echo esc_html($person_description); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <main id="site-content" role="main" style="--page-bg-image: url('<?php echo esc_url($intro_background_image['url']); ?>');">
        <div class="container person-post">
            <div class="person-post__content">
                <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            the_content();
                        endwhile;
                    endif;
                ?>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>