<?php
/**
 * The template for displaying the footer
 */
?>

<footer class="site-footer">
  <?php if (has_nav_menu('footer')) : ?>
    <nav class="nav">
      <?php
        wp_nav_menu([
          'theme_location' => 'footer',
          'container'      => false,
          'menu_class'     => 'footer-menu',
        ]);
      ?>
    </nav>
  <?php endif; ?>

  <?php
    $footer_bubble_text = null;

    // Home page
    // if (is_front_page() || is_home()) {
    //     $home_page_id = get_option('page_on_front');
    //     if ($home_page_id) {
    //         $footer_bubble_text = get_field('nav_text', $home_page_id);
    //     }
    // }

    // // Normal pages
    // if (is_page()) {
    //     $footer_bubble_text = get_field('nav_text');
    // }

    // CPT archives
    if (is_post_type_archive()) {
        $post_type = get_post_type();
        $cpt_page_map = [
            'de_person'   => 'people',
            'de_platform' => 'platform',
            'de_progress' => 'progress',
        ];

        if (isset($cpt_page_map[$post_type])) {
            $controller_page = get_page_by_path($cpt_page_map[$post_type]);
            if ($controller_page) {
                $footer_bubble_text = get_field('nav_text', $controller_page->ID);
            }
        }
    }
  ?>

  <?php if ($footer_bubble_text): ?>
    <div class="footer-bubble" data-open="true">
      <?php echo wp_kses_post($footer_bubble_text); ?>
    </div>
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
