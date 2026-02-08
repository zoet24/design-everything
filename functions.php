<?php
/**
 * Main theme functions file
 */

// Include separate PHP files
require get_template_directory() . '/inc/enqueue-styles.php';
require get_template_directory() . '/inc/enqueue-scripts.php';
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/cpts/people.php';
require get_template_directory() . '/inc/cpts/platform.php';
require get_template_directory() . '/inc/cpts/progress.php';
