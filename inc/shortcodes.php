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