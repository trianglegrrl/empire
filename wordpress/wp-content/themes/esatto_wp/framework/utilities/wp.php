<?php

/**
 * Wordpress Helper Functions
 *
 * @author SpyroSol
 * @category Utilities
 * @package Spyropress
 *
 */

/**
 * Get Page ID
 *
 * Get page id by passing slug
 */
function get_page_id( $slug ) {

    // get page by slug
    $page = get_page_by_path( $slug );

    if ( $page ) return $page->ID;

    return null;
}

/**
 * Current Post Type
 *
 * Try to get the current post type for the current post get rendering either in admin or at single
 */
function get_current_post_type() {
    global $post, $typenow, $current_screen;

    // we have a post so we can just get the post type from that
    if ( $post && $post->post_type )
        return $post->post_type;

    // check the global $typenow - set in admin.php
    elseif ( $typenow )
        return $typenow;

    // check the global $current_screen object - set in screen.php
    elseif ( $current_screen && $current_screen->post_type )
        return $current_screen->post_type;

    // lastly check the post_type querystring
    elseif ( isset( $_REQUEST['post_type'] ) )
        return sanitize_key( $_REQUEST['post_type'] );

    // we do not know the post type!
    return null;
}

/**
 * Get query page var
 */
function get_page_query() {
    global $paged;

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    return $paged;
}

/**
 * Check ShortCode existance in current post content
 */
/*
function has_shortcode( $shortcode = '' ) {

    // if no short code was provided, return false
    if ( ! $shortcode ) return false;

    // get current post by post_id to check for shortcode
    $post_to_check = get_post( get_the_ID() );

    // check the post content for the short code
    if ( false !== stripos( $post_to_check->post_content, '[' . $shortcode ) ) return true;

    // if not found
    return false;
}
 */
/**
 * Get meta value using get_the_ID()
 */
function get_meta_setting( $key = '', $single = false) {

    // Check for null
    if ( ! $key ) return;

    // return value
    return get_post_meta( get_the_ID(), $key, $single );
}

/**
 * Remove WordPress auto formatting
 */
function spyropress_remove_formatting( $content ) {
    $content = do_shortcode( shortcode_unautop( $content ) );
    return preg_replace( '#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content );
}

function spyropress_pass() {
    the_post_thumbnail();
    posts_nav_link();
    paginate_links();
    next_posts_link();
    previous_posts_link();
    
}
?>
