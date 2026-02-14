<?php
/**
 * Shortcode to list all people alphabetically
 */
function list_all_people_shortcode() {
    $people = new WP_Query([
        'post_type' => 'de_person',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_status' => 'publish',
    ]);

    if (!$people->have_posts()) {
        return '<p>No people found.</p>';
    }

    $output = '<ul class="people-list">';
    
    while ($people->have_posts()) {
        $people->the_post();
        $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    
    $output .= '</ul>';
    
    wp_reset_postdata();
    
    return $output;
}
add_shortcode('people_list', 'list_all_people_shortcode');

/**
 * Shortcode to list all platforms
 */
function list_all_platform_shortcode() {
    $platform = new WP_Query([
        'post_type' => 'de_platform',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ]);

    if (!$platform->have_posts()) {
        return '<p>No platforms found.</p>';
    }

    $output = '<div class="platform-list shortcode-list"><h4>Exhibitions</h4><ul>';
    
    while ($platform->have_posts()) {
        $platform->the_post();
        $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    
    $output .= '</ul></div>';
    
    wp_reset_postdata();
    
    return $output;
}
add_shortcode('platform_list', 'list_all_platform_shortcode');

/**
 * Shortcode to list all progress
 */
function list_all_progress_shortcode() {
    $progress = new WP_Query([
        'post_type' => 'de_progress',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ]);

    if (!$progress->have_posts()) {
        return '<p>No progress found.</p>';
    }

    $output = '<div class="progress-list shortcode-list"><h4>Resources</h4><ul>';
    
    while ($progress->have_posts()) {
        $progress->the_post();
        $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    
    $output .= '</ul></div>';
    
    wp_reset_postdata();
    
    return $output;
}
add_shortcode('progress_list', 'list_all_progress_shortcode');