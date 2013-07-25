<?php
/**
 * Module: Hero Unit
 * A lightweight, flexible component to showcase key content on your site.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Hero_Unit extends SpyropressBuilderModule {

    public function __construct() {
        
        global $spyropress;
        
        // Widget variable settings.
        $this->cssclass = 'hero-unit';
        $this->description = __( 'Hero Unit', 'spyropress' );
        $this->idbase = 'hero_unit';
        $this->name = __( 'Hero Unit', 'spyropress' );

        // Fields
        $this->fields = array(
        
            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text'
            ),

            array(
                'label' => __( 'Teaser', 'spyropress' ),
                'id' => 'teaser',
                'type' => 'editor',
                'rows' => 5
            ),
            
            array(
                'label' => __( 'Button Text', 'spyropress' ),
                'id' => 'btn_text',
                'type' => 'text',
                'std' => 'Button'
            ),
            
            array(
                'label' => __( 'Button URL', 'spyropress' ),
                'id' => 'btn_url',
                'type' => 'text',
                'std' => '#'
            )
                       
        );

        $this->create_widget();
    }
    
    function widget( $args, $instance ) {
        
        // extracting info
        extract($args); extract( spyropress_clean_array( $instance ) );
        
        include $this->get_view();
    }
}

spyropress_builder_register_module('Spyropress_Module_Hero_Unit');
?>