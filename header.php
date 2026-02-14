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
    <div class="nav-center">
      <?php
      wp_nav_menu([
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'nav-menu nav-menu--primary',
          'walker' => new Background_Nav_Walker(),
      ]);
      ?>
    </div>

    <?php 
    // Check if on progress page or single progress post
    $nav_class = (is_post_type_archive('de_progress')) ? 'nav-left' : 'nav-right';
    ?>

    <div class="<?php echo esc_attr($nav_class); ?>">
      <?php
      wp_nav_menu([
          'theme_location' => 'header_secondary',
          'container' => false,
          'menu_class' => 'nav-menu nav-menu--secondary',
      ]);
      ?>
    </div>
  </nav>
</header>

