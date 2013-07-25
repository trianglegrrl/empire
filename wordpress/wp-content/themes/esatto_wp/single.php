<?php

/**
 * Default Page Template
 */
?>
<?php get_header(); ?>
    <?php spyropress_before_main_container(); ?>
    <div class="wrapper-blog">
    <?php
    spyropress_before_loop();
    while( have_posts() ) {
        the_post();
        
        spyropress_before_post();
        spyropress_before_post_content();
        
        $teaser = get_post_meta( get_the_ID(), 'teaser', true );
    ?>
    	<h1<?php echo ( !$teaser ) ? ' class="margin"' : ''; ?>><?php the_title(); ?></h1>
        <?php
            if( $teaser ) {
                echo '<p class="lead">' . $teaser . '</p>';
            }
        ?>
    	<div class="container">
    		<div class="row">
    			<!-- Sidebar -->
    			<div class="span2 sidebar">
    				<?php
                    if( $title = get_post_meta( get_the_ID(), 'title', true ) ) {
                        echo '<h4 class="half-margin">' . $title . '</h4>';
                    }
                    ?>
    				<p>by <?php the_author(); ?> on <span><?php echo get_the_date(); ?></span></p>
    				<hr />
    				<dl>
    					<dt>Categories</dt>
    					<dd><?php the_category( ', ') ?></dd>
    				</dl>
                    <?php the_tags( '<dl><dt>Tags</dt><dd>', ', ', '</dd></dl>' ); ?>	
    			</div>
    			<div class="span8">
                    <div class="post-content">
                        <?php get_image( 'width=9999&class=margin' ); ?>
                        <?php spyropress_the_content(); ?>
                    </div>
                    <?php comments_template( '', true ); ?>
    			</div>
    			<div class="span2">
    			</div>
    		</div>
    	</div>
    <?php                
        spyropress_after_post_content();
        spyropress_after_post();
    }
    wp_pagenavi();
    spyropress_after_loop();
    ?>        
    </div>
    <?php spyropress_after_main_container();spyropress_get_template_part('part=templates/footer-content'); ?>
<?php get_footer(); ?>