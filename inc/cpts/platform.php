<?php
/**
 * Register 'de_platform' custom post type
 */
function de_register_platform_cpt() {
    $labels = [
        'name'                  => 'Platform',
        'singular_name'         => 'Platform Item',
        'menu_name'             => 'Platform',
        'name_admin_bar'        => 'Platform Item',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Platform Item',
        'edit_item'             => 'Edit Platform Item',
        'new_item'              => 'New Platform Item',
        'view_item'             => 'View Platform Item',
        'all_items'             => 'All Platform',
        'search_items'          => 'Search Platform',
        'not_found'             => 'No platform items found.',
        'not_found_in_trash'    => 'No platform items found in Trash.',
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'show_in_rest'          => true,
        'has_archive'           => true,
        'rewrite'               => ['slug' => 'platform'],
        'supports'              => ['title', 'editor', 'thumbnail'],
        'menu_icon'             => 'dashicons-format-chat',
    ];

    register_post_type('de_platform', $args);
}
add_action('init', 'de_register_platform_cpt');
