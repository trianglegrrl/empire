<?php

/**
 * Default Page Template
 */
?>
<?php get_header(); ?>
    <?php spyropress_before_main_container(); ?>
    <div class="wrapper-blog">
        <h1><?php echo 'Search results for <span>' . get_search_query() . '</span>';?></h1>
        <p class="lead"><?php get_setting_e( 'blog_teaser' ); ?></p>
            
        <!-- Masonry container -->
        <div id="masonry"> 
            <?php
            spyropress_before_loop();
            while( have_posts() ) {
                the_post();
                
                spyropress_before_post();
                spyropress_before_post_content();
                
                $class = 'single';
                $is_featured = get_post_meta( get_the_ID(), 'highlight', true );
                $class .= ( $is_featured ) ? ' big' : '';
            ?>
            <div class="<?php echo $class; ?>">
            	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            	<em class="data-time">
            		by <?php the_author(); ?> on <span><?php echo get_the_date(); ?></span>
            	</em>
            	<?php
                    get_image( array(
                        'width' => ( $is_featured ) ? 999 : 300,
                        'type' => 'rel',
                        'rel' => 'tag',
                        'link_class' => 'fancybox'                        
                    ) );
                ?>
                <small class="blog-comments"><span class="sosa">g</span><?php comments_number( '0 Comments' ) ?></small>
            	<?php spyropress_the_content(); ?>
            </div>    
            <?php                
                spyropress_after_post_content();
                spyropress_after_post();
            }
            ?>
        </div>
        <div class="container">
        <?php 
            previous_posts_link();
            next_posts_link();
            spyropress_after_loop();
        ?>
        </div>
    </div>
    <?php spyropress_after_main_container();spyropress_get_template_part('part=templates/footer-content'); ?>
<?php get_footer(); ?>