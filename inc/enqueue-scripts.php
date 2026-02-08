<?php
/**
 * Enqueue JavaScript files
 */

function theme_enqueue_scripts() {
    wp_enqueue_script(
        'page-intro',
        get_template_directory_uri() . '/src/js/page-intro.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');