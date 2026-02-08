<?php
/**
 * Custom Nav Walker to add background images to menu items
 */

class Background_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        // Determine which page to get background from based on menu item title or URL
        $background_url = '';
        $position = '';
        
        $title_lower = strtolower($item->title);
        
        if (strpos($title_lower, 'design everything') !== false || $item->url === home_url('/')) {
            $page = get_page_by_path('design-everything');
            $position = 'top-center';
        } elseif (strpos($title_lower, 'people') !== false) {
            $page = get_page_by_path('people');
            $position = 'bottom-left';
        } elseif (strpos($title_lower, 'platform') !== false) {
            $page = get_page_by_path('platform');
            $position = 'bottom-center';
        } elseif (strpos($title_lower, 'progress') !== false) {
            $page = get_page_by_path('progress');
            $position = 'bottom-right';
        }
        
        if (isset($page)) {
            $background_image = get_field('page_background_image', $page->ID);
            if ($background_image) {
                $background_url = $background_image['url'];
            }
        }

        $atts = array();
        $atts['href'] = !empty($item->url) ? $item->url : '';
        
        if ($background_url) {
            $atts['style'] = '--hover-bg: url(\'' . esc_url($background_url) . '\');';
            $atts['data-position'] = $position;
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        $output .= '<a' . $attributes . '>';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }
}