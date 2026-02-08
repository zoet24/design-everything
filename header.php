<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <nav class="nav">
    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'menu_class' => 'nav-menu',
        'container' => false,
    ]);
    ?>
  </nav>

  <?php
    $bubble_text = null;

    // Home page
    if (is_front_page() || is_home()) {
      $home_page_id = get_option('page_on_front');
      if ($home_page_id) {
          $bubble_text = get_field('nav_text', $home_page_id);
      }
  }

    // Normal pages
    // if (is_page()) {
    //     $bubble_text = get_field('nav_text');
    // }

    // // CPTs
    // if (is_post_type_archive()) {
    //   $post_type = get_post_type(); // e.g. 'de_person', 'de_platform', 'de_progress'
  
    //   $cpt_page_map = [
    //       'de_person' => 'people',
    //       'de_platform'  => 'platform',
    //       'de_progress'  => 'progress',
    //   ];
  
    //   if (isset($cpt_page_map[$post_type])) {
    //       $controller_page = get_page_by_path($cpt_page_map[$post_type]);
  
    //       if ($controller_page) {
    //           $bubble_text = get_field('nav_text', $controller_page->ID);
    //       }
    //   }
  // }
  ?>
  
  <!-- TOZO - Move out of header -->
  <?php if ($bubble_text): ?>
    <div class="header-bubble" data-open="true">
      <?php echo wp_kses_post($bubble_text); ?>
    </div>
  <?php endif; ?>
</header>

