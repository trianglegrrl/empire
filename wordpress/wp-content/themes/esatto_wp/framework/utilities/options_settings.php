<?php

/**
 * Option/Settings Helper Functions
 *
 * @category Utilities
 * @package Spyropress
 *
 */

/** Option Getter and Formatter **********************/

function get_float_class( $float ) {
    
    // check for null
    if ( ! $float ) return;

    $allowed_floats = array( 'left' => 'pull-left', 'right' => 'pull-right' );

    if ( in_array( $float, array_keys( $allowed_floats ) ) )
        $float = $allowed_floats[$float];

    return $float;
}

/**
 * Row Class
 */
function get_row_class( $return = false ) {
    global $spyropress;

    if ( $return )
        return $spyropress->row_class;
    echo $spyropress->row_class;
}

/**
 * Column Class
 */
function get_column_class( $column ) {

    $class = 'span12';

    switch ( $column ) {
        case 2:
            $class = 'span6';
            break;
        case 3:
            $class = 'span4';
            break;
        case 4:
            $class = 'span3';
            break;
        case 6:
            $class = 'span2';
            break;
    }

    return $class;
}

/** Data Sources for Post Type and Taxonomies **********************/

/**
 * Buckets
 */
function spyropress_get_buckets() {
    
    $buckets = array();
    
    if ( ! post_type_exists( 'bucket' ) ) return $buckets;
    
    // get posts
    $args = array(
        'post_type' => 'bucket',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'asc'
    );
    $posts = get_posts( $args );
    if ( !empty( $posts ) ) {
        foreach ( $posts as $post ) {
            $buckets[$post->ID] = $post->post_title;
        }
    }

    return $buckets;
}

/**
 * Custom Taxonomies
 */
function spyropress_get_taxonomies( $tax = '' ) {
    
    if ( ! $tax ) return;

    $terms = get_terms( $tax );
    $taxs = array();
    if ( $terms )
        foreach ( $terms as $term )
            $taxs[$term->slug] = $term->name;

    return $taxs;
}

/** Custom Data Sources ********************************************/

/**
 * jQuery Easing Options
 */
function spyropress_get_options_easing() {
    return array(
        'linear' => __( 'linear', 'spyropress' ),
        'jswing' => __( 'jswing', 'spyropress' ),
        'def' => __( 'def', 'spyropress' ),
        'easeInQuad' => __( 'easeInQuad', 'spyropress' ),
        'easeOutQuad' => __( 'easeOutQuad', 'spyropress' ),
        'easeInOutQuad' => __( 'easeInOutQuad', 'spyropress' ),
        'easeInCubic' => __( 'easeInCubic', 'spyropress' ),
        'easeOutCubic' => __( 'easeOutCubic', 'spyropress' ),
        'easeInOutCubic' => __( 'easeInOutCubic', 'spyropress' ),
        'easeInQuart' => __( 'easeInQuart', 'spyropress' ),
        'easeOutQuart' => __( 'easeOutQuart', 'spyropress' ),
        'easeInOutQuart' => __( 'easeInOutQuart', 'spyropress' ),
        'easeInQuint' => __( 'easeInQuint', 'spyropress' ),
        'easeOutQuint' => __( 'easeOutQuint', 'spyropress' ),
        'easeInOutQuint' => __( 'easeInOutQuint', 'spyropress' ),
        'easeInSine' => __( 'easeInSine', 'spyropress' ),
        'easeOutSine' => __( 'easeOutSine', 'spyropress' ),
        'easeInOutSine' => __( 'easeInOutSine', 'spyropress' ),
        'easeInExpo' => __( 'easeInExpo', 'spyropress' ),
        'easeOutExpo' => __( 'easeOutExpo', 'spyropress' ),
        'easeInOutExpo' => __( 'easeInOutExpo', 'spyropress' ),
        'easeInCirc' => __( 'easeInCirc', 'spyropress' ),
        'easeOutCirc' => __( 'easeOutCirc', 'spyropress' ),
        'easeInOutCirc' => __( 'easeInOutCirc', 'spyropress' ),
        'easeInElastic' => __( 'easeInElastic', 'spyropress' ),
        'easeOutElastic' => __( 'easeOutElastic', 'spyropress' ),
        'easeInOutElastic' => __( 'easeInOutElastic', 'spyropress' ),
        'easeInBack' => __( 'easeInBack', 'spyropress' ),
        'easeOutBack' => __( 'easeOutBack', 'spyropress' ),
        'easeInOutBack' => __( 'easeInOutBack', 'spyropress' ),
        'easeInBounce' => __( 'easeInBounce', 'spyropress' ),
        'easeOutBounce' => __( 'easeOutBounce', 'spyropress' ),
        'easeInOutBounce' => __( 'easeInOutBounce', 'spyropress' ),
    );
}

function spyropress_get_options_float() {
    return array(
        'none' => __( 'None', 'spyropress' ),
        'left' => __( 'Left', 'spyropress' ),
        'right' => __( 'Right', 'spyropress' ),
    );
}

function spyropress_get_options_link( $fields ) {
    // check for emptiness
    if ( empty( $fields ) ) $fields = array();

    return array_merge( $fields, array(
        array(
            'label' => __( 'URL/Link Setting', 'spyropress' ),
            'type' => 'toggle'
        ),

        array(
            'label' => __( 'Link Text', 'spyropress' ),
            'id' => 'url_text',
            'type' => 'text'
        ),

        array(
            'label' => __( 'URL/Hash', 'spyropress' ),
            'id' => 'url',
            'type' => 'text'
        ),

        array(
            'label' => __( 'Link to Post/Page', 'spyropress' ),
            'id' => 'link_url',
            'type' => 'custom_post',
            'post_type' => array( 'post', 'page' )
        ),

        array( 'type' => 'toggle_end' )
    ) );
}

function spyropress_get_options_icons() {
    return array(
        '0021' => __( 'Exclamation', 'spyropress' ),
        '0024' => __( 'Dollar', 'spyropress' ),
        '0026' => __( 'Ampersand', 'spyropress' ),
        '002f' => __( 'Mobile', 'spyropress' ),
        '0030' => __( 'Headphones', 'spyropress' ),
        '0031' => __( 'Photo Camera', 'spyropress' ),
        '0032' => __( 'Video Camera', 'spyropress' ),
        '0033' => __( 'Printer', 'spyropress' ),
        '0034' => __( 'Landphone', 'spyropress' ),
        '0035' => __( 'iPhone', 'spyropress' ),
        '0036' => __( 'iPad', 'spyropress' ),
        '0037' => __( 'Macbook', 'spyropress' ),
        '0038' => __( 'iMac', 'spyropress' ),
        '0039' => __( 'Microphone', 'spyropress' ),
        '003a' => __( 'TV', 'spyropress' ),
        '003b' => __( 'Radio', 'spyropress' ),
        '003c' => __( 'Tone', 'spyropress' ),
        '003d' => __( 'Tetris', 'spyropress' ),
        '003e' => __( 'Gamepad', 'spyropress' ),
        '003f' => __( 'Question', 'spyropress' ),
        '0040' => __( 'Video', 'spyropress' ),
        '0041' => __( 'Photo', 'spyropress' ),
        '0042' => __( 'Quote Left', 'spyropress' ),
        '0043' => __( 'Quote Eight', 'spyropress' ),
        '0044' => __( 'Code', 'spyropress' ),
        '0045' => __( 'Bar Chart', 'spyropress' ),
        '0046' => __( 'Pie Chart', 'spyropress' ),
        '0047' => __( 'Line Chart', 'spyropress' ),
        '0049' => __( 'Area Chart', 'spyropress' ),
        '0048' => __( 'Polaroid', 'spyropress' ),
        '004a' => __( 'Car', 'spyropress' ),
        '004b' => __( 'Truck', 'spyropress' ),
        '004c' => __( 'Bicycle', 'spyropress' ),
        '004d' => __( 'Motocycle', 'spyropress' ),
        '004e' => __( 'Play', 'spyropress' ),
        '004f' => __( 'Pause', 'spyropress' ),
        '0050' => __( 'Stop', 'spyropress' ),
        '0051' => __( 'Play Next', 'spyropress' ),
        '0052' => __( 'Play Prev', 'spyropress' ),
        '0053' => __( 'Foward', 'spyropress' ),
        '0054' => __( 'Rewind', 'spyropress' ),
        '0055' => __( 'Loop', 'spyropress' ),
        '0056' => __( 'Tool', 'spyropress' ),
        '0057' => __( 'Gear', 'spyropress' ),
        '0058' => __( 'Gear Alt', 'spyropress' ),
        '0059' => __( 'Gears', 'spyropress' ),
        '005a' => __( 'Chess', 'spyropress' ),
        '005b' => __( 'Clock', 'spyropress' ),
        '005c' => __( 'Magnifying Left', 'spyropress' ),
        '005d' => __( 'Magnifying Right', 'spyropress' ),
        '005e' => __( 'Magnifying More', 'spyropress' ),
        '005f' => __( 'Magnifying Less', 'spyropress' ),
        '0060' => __( 'Pencil Big', 'spyropress' ),
        '0061' => __( 'Pencil', 'spyropress' ),
        '0062' => __( 'Clip', 'spyropress' ),
        '0063' => __( 'Heart', 'spyropress' ),
        '0064' => __( 'Heart Alt', 'spyropress' ),
        '0065' => __( 'Star', 'spyropress' ),
        '0066' => __( 'Star Alt', 'spyropress' ),
        '0067' => __( 'Comment', 'spyropress' ),
        '0068' => __( 'Chat', 'spyropress' ),
        '0069' => __( 'Info', 'spyropress' ),
        '006a' => __( 'Flag', 'spyropress' ),
        '006b' => __( 'Tag', 'spyropress' ),
        '006c' => __( 'Tags', 'spyropress' ),
        '006d' => __( 'Ribbon', 'spyropress' ),
        '006e' => __( 'Maps Full', 'spyropress' ),
        '006f' => __( 'Maps', 'spyropress' ),
        '0070' => __( 'Share', 'spyropress' ),
        '0071' => __( 'Social', 'spyropress' ),
        '0072' => __( 'rss', 'spyropress' ),
        '0073' => __( 'Podcast', 'spyropress' ),
        '0074' => __( 'Twitter', 'spyropress' ),
        '0075' => __( 'Twitter Alt', 'spyropress' ),
        '0076' => __( 'Facebook', 'spyropress' ),
        '0077' => __( 'Flickr', 'spyropress' ),
        '0078' => __( 'Vimeo', 'spyropress' ),
        '0100' => __( 'Windows', 'spyropress' ),
        '0101' => __( 'Windows8', 'spyropress' ),
        '0102' => __( 'Apple', 'spyropress' ),
        '0103' => __( 'Android', 'spyropress' ),
        '0105' => __( 'Linkedin', 'spyropress' ),
        '0106' => __( 'Google+', 'spyropress' ),
        '0107' => __( 'Instagram', 'spyropress' ),
        '0108' => __( 'Credit Card', 'spyropress' ),
        '0109' => __( 'Visa Card', 'spyropress' ),
        '010a' => __( 'Master Card', 'spyropress' ),
        '010b' => __( 'American Express', 'spyropress' ),
        '010c' => __( 'Paypal', 'spyropress' ),
        '010d' => __( 'Sold', 'spyropress' ),
        '010e' => __( 'Disover', 'spyropress' ),
        '010f' => __( 'Maestro', 'spyropress' ),
        '0079' => __( 'Update', 'spyropress' ),
        '007a' => __( 'Refresh', 'spyropress' ),
        '007b' => __( 'Plus', 'spyropress' ),
        '007c' => __( 'Minus', 'spyropress' ),
        '007d' => __( 'Divide', 'spyropress' ),
        '007e' => __( 'Multiply', 'spyropress' ),
        '00a3' => __( 'Pound', 'spyropress' ),
        '00b0' => __( 'Musicloud', 'spyropress' ),
        '00bc' => __( 'Responsive', 'spyropress' ),
        '00c4' => __( 'Shop', 'spyropress' ),
        '00c5' => __( 'Shop Alt', 'spyropress' ),
        '00c7' => __( 'Home', 'spyropress' ),
        '00c9' => __( 'Mail', 'spyropress' ),
        '00d1' => __( 'Mail Open', 'spyropress' ),
        '00d6' => __( 'Mail Open Alt', 'spyropress' ),
        '00dc' => __( 'User', 'spyropress' ),
        '00dd' => __( 'Users', 'spyropress' ),
        '00e0' => __( 'Input', 'spyropress' ),
        '00e2' => __( 'Output', 'spyropress' ),
        '00e4' => __( 'Link', 'spyropress' ),
        '00e3' => __( 'Error', 'spyropress' ),
        '00e5' => __( 'Success', 'spyropress' ),
        '00e7' => __( 'Trash', 'spyropress' ),
        '00e9' => __( 'File', 'spyropress' ),
        '00eb' => __( 'Folder', 'spyropress' ),
        '00e8' => __( 'Lock', 'spyropress' ),
        '00ea' => __( 'Unlock', 'spyropress' ),
        '00ec' => __( 'Up Alt', 'spyropress' ),
        '00ed' => __( 'Down Alt', 'spyropress' ),
        '00ee' => __( 'Up', 'spyropress' ),
        '00ef' => __( 'Down', 'spyropress' ),
        '00f1' => __( 'Right', 'spyropress' ),
        '00f3' => __( 'Left', 'spyropress' ),
        '00f2' => __( 'Bright', 'spyropress' ),
        '00f4' => __( 'Cloud', 'spyropress' ),
        '00f6' => __( 'Cloudy', 'spyropress' ),
        '00f5' => __( 'Rain', 'spyropress' ),
        '00fa' => __( 'Storm', 'spyropress' ),
        '00f9' => __( 'Snow', 'spyropress' ),
        '00fb' => __( 'Snow Alt', 'spyropress' ),
        '00fc' => __( 'download Alt', 'spyropress' ),
    );
}

function spyropress_get_options_social_icons() {
    return array(
        '0076' => __( 'Facebook', 'spyropress' ),
        '0077' => __( 'Flickr', 'spyropress' ),
        '0106' => __( 'Google+', 'spyropress' ),
        '0107' => __( 'Instagram', 'spyropress' ),
        '0105' => __( 'Linkedin', 'spyropress' ),
        '0074' => __( 'Twitter', 'spyropress' ),
        '0078' => __( 'vimeo', 'spyropress' )
    );
}
?>