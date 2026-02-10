<?php
/**
 * Single template for individual Progress Items
 */

get_header();
?>

<div class="page-content" data-nav-position="bottom-right">
    <main id="site-content" role="main">
        <div class="container container--narrow progress-single">
            <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                endif;
            ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
