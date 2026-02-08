<?php
/**
 * Register 'de_person' CPT and server-side rendered People Grid block
 */

// Register 'de_person' CPT
function de_register_person_cpt() {
    $labels = [
        'name'               => 'People',
        'singular_name'      => 'Person',
        'menu_name'          => 'People',
        'name_admin_bar'     => 'Person',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Person',
        'edit_item'          => 'Edit Person',
        'new_item'           => 'New Person',
        'view_item'          => 'View Person',
        'all_items'          => 'All People',
        'search_items'       => 'Search People',
        'not_found'          => 'No people found.',
        'not_found_in_trash' => 'No people found in Trash.'
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => 'people', // 👈 change this from false
        'rewrite'            => ['slug' => 'people', 'with_front' => false],
        'supports'           => ['title', 'editor', 'thumbnail'],
        'menu_icon'          => 'dashicons-admin-users',
    ];

    register_post_type('de_person', $args);
}
add_action('init', 'de_register_person_cpt');