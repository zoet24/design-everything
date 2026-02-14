<?php
/**
 * Enqueue JavaScript files
 */

function theme_enqueue_scripts() {
    // Page intros script (all pages)
    wp_enqueue_script(
        'page-intro',
        get_template_directory_uri() . '/src/js/page-intros.js',
        array(),
        '1.0.0',
        true
    );

    // Home page loading script (only on home page)
    if (is_page_template('page-home.php')) {
        wp_enqueue_script(
            'home-loading',
            get_template_directory_uri() . '/src/js/home-loading.js',
            array(),
            '1.0.0',
            true
        );
    }

    // Home page carousel script (only on home page)
    if (is_page_template('page-home.php')) {
        wp_enqueue_script(
            'home-carousel',
            get_template_directory_uri() . '/src/js/carousel.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');