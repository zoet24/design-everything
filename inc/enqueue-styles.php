<?php
/**
 * Enqueue front-end styles and block scripts
 */

function de_theme_enqueue_styles() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Main Sass-compiled CSS
    if ( file_exists( $theme_dir . '/style.css' ) ) {
        wp_enqueue_style(
            'de-style',
            $theme_uri . '/style.css',
            [],
            filemtime( $theme_dir . '/style.css' )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'de_theme_enqueue_styles' );

function de_register_blocks() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Register JS
    wp_register_script(
        'de-blocks',
        $theme_uri . '/build/index.js',
        [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' ],
        filemtime( $theme_dir . '/build/index.js' ),
        true
    );

    // Register CSS
    wp_register_style(
        'de-blocks-style',
        $theme_uri . '/build/style-index.css',
        [],
        filemtime( $theme_dir . '/build/style-index.css' )
    );

    // Register block
    register_block_type( 'de/fullscreen-columns', [
        'editor_script' => 'de-blocks',
        'editor_style'  => 'de-blocks-style',
        'style'         => 'de-blocks-style',
    ] );
}
add_action( 'init', 'de_register_blocks' );

