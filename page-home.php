<?php
/*
Template Name: Home
*/
get_header();

$background_image = '';

// Get comma-separated image IDs from ACF (no 'option' parameter)
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

<main class="home-hero" style="background-image: url('<?php echo esc_url( $background_image ); ?>');">
  <div class="home-hero__overlay">
    <img
      src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/de-logo-white.png' ); ?>"
      alt="<?php bloginfo( 'name' ); ?>"
      class="home-hero__logo"
    />
  </div>
</main>

<?php
get_footer();
?>