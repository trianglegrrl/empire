<?php

/**
 * Default Page Template
 */
?>
<?php get_header(); ?>

    <?php spyropress_before_main_container(); ?>
        <?php
        spyropress_before_loop();
        while( have_posts() ) {
            the_post();
            
            spyropress_before_post();
            spyropress_before_post_content();
            if( is_front_page() ) {
                echo '<div class="wrapper">';
                    spyropress_the_content();
                    spyropress_get_template_part('part=templates/footer-content');
                echo '</div>';
            }
            else {
        ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class( 'wrapper-simple' ); ?>>
        <?php
                    spyropress_the_content();
                    wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'spyropress' ), 'after' => '</div>' ) );
                echo '</div>';
                spyropress_get_template_part('part=templates/footer-content');
            }
            
            spyropress_after_post_content();
            spyropress_after_post();
        }
        spyropress_after_loop();
        ?>
    <?php spyropress_after_main_container(); ?>
<?php get_footer(); ?>