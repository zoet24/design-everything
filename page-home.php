<?php
/*
Template Name: Home
*/
get_header();

// Get page intro fields
$intro_background_image = get_field('page_background_image');
$intro_title = get_field('page_intro_title');
$intro_post = get_field('page_intro_text');

// Get all hero images for carousel
$image_ids = get_field('hero_image_ids');
$carousel_images = [];

if ($image_ids) {
    $ids = array_filter(array_map('trim', explode(',', $image_ids)));
    
    if (!empty($ids)) {
        foreach ($ids as $id) {
            $image_url = wp_get_attachment_image_url($id, 'full');
            if ($image_url) {
                $carousel_images[] = [
                    'url' => $image_url,
                    'title' => get_the_title($id),
                    'caption' => wp_get_attachment_caption($id)
                ];
            }
        }
        
        // Ensure at least 5 images by duplicating if needed
        while (count($carousel_images) < 5) {
            $carousel_images = array_merge($carousel_images, $carousel_images);
        }
        
        // Shuffle and pick random starting point
        shuffle($carousel_images);
    }
}
?>

<div class="page-content" data-nav-position="top-center">
    <?php if ($intro_background_image && $intro_post): ?>
        <div 
            class="text-box-slide text-box-slide--toggleable" 
            style="background-image: url('<?php echo esc_url($intro_background_image['url']); ?>');"
            data-origin="top-center"
        >
            <div class="text-box-content">
                <h2 class="text-box-toggle">
                    <?php echo esc_html($intro_title); ?>
                    <span class="chevron">↓</span>
                </h2>
                <div class="text-box-post">
                    <?php echo apply_filters('the_content', $intro_post->post_content); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <main class="home-hero" style="--yellow-paper: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/papers/yellow.jpg'); ?>');">
        <div class="home-hero__overlay">
            <img
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/de-logo-white.png'); ?>"
                alt="<?php bloginfo('name'); ?>"
                class="home-hero__logo"
            />
        </div>
        
        <?php if (!empty($carousel_images)): ?>
            <div class="carousel" data-images='<?php echo json_encode(array_values($carousel_images)); ?>'>
                <div class="carousel__track"></div>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>