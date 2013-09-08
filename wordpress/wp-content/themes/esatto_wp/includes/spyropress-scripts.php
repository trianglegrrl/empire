<?php

/**
 * Enqueue scripts and stylesheets
 *
 * @category Core
 * @package SpyroPress
 *
 */

/**
 * Register StyleSheets
 */
function spyropress_register_stylesheets() {

    $scheme = get_setting( 'theme_scheme', 'service' );
    $color = get_setting( 'theme_color', 'service' );
    $is_responsive = !get_setting( 'responsive_layout' );
    
    // Default stylesheets    
    wp_enqueue_style( 'bootstrap', assets_css() . 'bootstrap.min.css', false, '2.3.1' );
    if( $is_responsive) wp_enqueue_style( 'bootstrap-rep', assets_css() . 'bootstrap-responsive.min.css', false, '2.3.1' );
    
    wp_enqueue_style( 'esatto', assets_css() . 'esatto.css', false, '1.0' );
    if( $is_responsive) wp_enqueue_style( 'esatto-responsive', assets_css() . "esatto-responsive.css", false, '1.0' );
    wp_enqueue_style( 'scheme', assets_css() . "$scheme.css", false );
    wp_enqueue_style( 'color', assets_css() . "color/$color.css", false );
    
    wp_enqueue_style( 'superslides', assets_css() . 'superslides.css', false, '2.0.4' );
    wp_enqueue_style( 'masonry', assets_css() . 'masonry.css', false, '2.0.4' );
    wp_enqueue_style( 'fancybox', assets_css() . "fancybox.css", false );
    
    
    wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300', false, '2.0.4' );

    // Dynamic StyleSheet
    if ( file_exists( template_path() . 'assets/css/dynamic.css' ) )
        wp_enqueue_style( 'dynamic', assets_css() . 'dynamic.css', false, '2.0.0' );

    // Builder StyleSheet
    /*if ( file_exists( template_path() . 'assets/css/builder.css' ) )
        wp_enqueue_style( 'builder', assets_css() . 'builder.css', false, '2.0.0' );*/
    
    wp_enqueue_script( 'jquery' );
}

/**
 * Enqueque Scripts
 */
function spyropress_register_scripts() {

    /**
     * Register Scripts
     */
    // threaded comments
    if ( is_single() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Plugins
    wp_register_script( 'bootstrap', assets_js() . 'bootstrap.min.js', false, '', true );
    wp_register_script( 'jquery-scrollTo', assets_js() . 'jquery.scrollTo.min.js', false, '', true );
    wp_register_script( 'jquery-localscroll', assets_js() . 'jquery.localscroll.min.js', false, '', true );
    wp_register_script( 'jquery-nav', assets_js() . 'jquery.nav.min.js', false, '', true );
    wp_register_script( 'jquery-superslides', assets_js() . 'jquery.superslides.min.js', false, '', true );
    wp_register_script( 'jquery-easing', assets_js() . 'jquery.easing.1.3.js', false, '', true );
    wp_register_script( 'jquery-nicescroll', assets_js() . 'jquery.nicescroll.min.js', false, '', true );
    wp_register_script( 'jquery-filterable', assets_js() . 'jquery.filterable.min.js', false, '', true );
    wp_register_script( 'vanilla-masonry', assets_js() . 'jquery.masonry.min.js', false, '', true );
    wp_register_script( 'jquery-fancybox', assets_js() . 'jquery.fancybox.min.js', false, '', true );
    wp_register_script( 'jquery-fullscreen', assets_js() . 'jquery.fullscreen-min.js', false, '', true );
    wp_register_script( 'googleapis', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', false, '', true );
    
    $deps = array(
        'bootstrap',
        'jquery-scrollTo',
        'jquery-localscroll',
        'jquery-nav',
        'jquery-superslides',
        'jquery-easing',
        'jquery-nicescroll',
        'jquery-filterable',
        'vanilla-masonry',
        'jquery-fancybox',
        'jquery-fullscreen',
        'googleapis'
    );
    
    $data = array(
        'assets_url' => assets_img(),
        'is_front_page' => is_front_page() ? 1 : 0
    );
    wp_localize_script( 'googleapis', 'settings', $data );

    // custom scripts
    wp_register_script( 'custom-script', assets_js() . 'settings.js', $deps, '2.1', true );

    /**
     * Enqueue All
     */
    wp_enqueue_script( 'custom-script' );
}
?>