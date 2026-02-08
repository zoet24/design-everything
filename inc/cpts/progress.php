<?php
/**
 * Register 'de_progress' custom post type
 */
function de_register_progress_cpt() {
    $labels = [
        'name'                  => 'Progress',
        'singular_name'         => 'Progress Item',
        'menu_name'             => 'Progress',
        'name_admin_bar'        => 'Progress Item',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Progress Item',
        'edit_item'             => 'Edit Progress Item',
        'new_item'              => 'New Progress Item',
        'view_item'             => 'View Progress Item',
        'all_items'             => 'All Progress',
        'search_items'          => 'Search Progress',
        'not_found'             => 'No progress items found.',
        'not_found_in_trash'    => 'No progress items found in Trash.',
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'show_in_rest'          => true,
        'has_archive'           => true,
        'rewrite'               => ['slug' => 'progress'],
        'supports'              => ['title', 'editor', 'thumbnail'],
        'menu_icon'             => 'dashicons-chart-bar',
    ];

    register_post_type('de_progress', $args);
}
add_action('init', 'de_register_progress_cpt');
