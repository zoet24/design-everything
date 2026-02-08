<?php
/*
Template Name: Home
*/
get_header();

// Get page intro fields
$intro_background_image = get_field('page_background_image');
$intro_title = get_field('page_intro_title');
$intro_post = get_field('page_intro_text');

// Get hero background image
$background_image = '';
$image_ids = get_field( 'hero_image_ids' );

if ( $image_ids ) {
  $ids = array_map( 'trim', explode( ',', $image_ids ) );
  $ids = array_filter( $ids ); // Remove empty values
  
  if ( ! empty( $ids ) ) {
    $random_id = $ids[ array_rand( $ids ) ];
    $background_image = wp_get_attachment_image_url( $random_id, 'full' );
  }
}
?>

<div class="page-content" data-nav-position="top-center">
    <?php if ($intro_background_image && $intro_post): ?>
        <div 
            class="text-box-slide" 
            style="background-image: url('<?php echo esc_url($intro_background_image['url']); ?>');"
            data-origin="top-center"
        >
            <div class="text-box-content">
                <h2><?php echo esc_html($intro_title); ?></h2>
                <?php 
                // Display the full post content with formatting
                echo apply_filters('the_content', $intro_post->post_content); 
                ?>
            </div>
        </div>
    <?php endif; ?>

    <main class="home-hero" style="background-image: url('<?php echo esc_url( $background_image ); ?>');">
      <div class="home-hero__overlay">
        <img
          src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/de-logo-white.png' ); ?>"
          alt="<?php bloginfo( 'name' ); ?>"
          class="home-hero__logo"
        />
      </div>
    </main>
</div>

<?php
get_footer();
?>