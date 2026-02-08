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
          'walker' => new Background_Nav_Walker(),
        ]);
      ?>
    </nav>
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
