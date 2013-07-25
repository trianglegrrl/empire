<?php

/**
 * Post Component
 * 
 * @package		SpyroPress
 * @category	Components
 */

class SpyropressPost extends SpyropressComponent {

    private $path;
    
    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
    }

    function register() {

        // Init Post Type
        $post = new SpyropressCustomPostType( 'Post' );
        
        // Add Meta Boxes
        $meta_fields['post'] = array(
            array(
                'label' => 'Post',
                'type' => 'heading',
                'slug' => 'post'
            ),
            
            array(
                'type' => 'checkbox',
                'id' => 'highlight',
                'options' => array(
                    '1' => 'Highlight this post'
                )
            ),
            
            array(
                'type' => 'text',
                'id' => 'title',
                'label' => 'Title in Sidebar '
            ),
            
            array(
                'type' => 'textarea',
                'id' => 'teaser',
                'label' => 'Teaser Text',
                'rows' => 8
            ),
        );
        
        $post->add_meta_box( 'post_highlight', 'Details', $meta_fields, false, false );
    }
}

/**
 * Init the Component
 */
new SpyropressPost();
?>