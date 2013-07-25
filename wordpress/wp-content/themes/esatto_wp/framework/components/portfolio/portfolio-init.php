<?php

/**
 * Portfolio Component
 * 
 * @package		SpyroPress
 * @category	Components
 */

class SpyropressPortfolio extends SpyropressComponent {

    private $path;
    
    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
        add_filter( 'builder_include_modules', array( $this, 'register_module' ) );
        //add_action( 'spyropress_register_widgets', array( $this, 'register_widget' ) );
    }

    function register() {

        // Init Post Type
        $post = new SpyropressCustomPostType( 'Portfolio' );
        
        // Add Taxonomy
        $post->add_taxonomy( 'Portfolio Category', '', 'Categories', array( 'hierarchical' => true ) );
        $post->add_taxonomy( 'Portfolio Tag', '', 'Tags' );
        
        // Add Meta Boxes
        $meta_fields['portfolio'] = array(
            array(
                'label' => 'Portfolio',
                'type' => 'heading',
                'slug' => 'portfolio'
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
        
        $post->add_meta_box( 'portfolio_highlight', 'Highlight', $meta_fields, false, false );
    }
    
    function register_widget( $widgets ) {
        
        $widgets[] = $this->path . '/widget';
        
        return $widgets;
    }
    
    function register_module( $modules ) {

        $modules[] = $this->path . '/module/module.php';

        return $modules;
    }
}

/**
 * Init the Component
 */
new SpyropressPortfolio();
?>