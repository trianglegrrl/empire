<?php

/**
 * Module: Heading
 * Add headings into the page layout wherever needed.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Heading extends SpyropressBuilderModule {

    public function __construct() {

        $this->path = dirname(__FILE__);
        // Widget variable settings
        $this->cssclass = 'module-heading';
        $this->description = __( 'Add headings into the page layout wherever needed.', 'spyropress' );
        $this->id_base = 'spyropress_heading';
        $this->name = __( 'Heading', 'spyropress' );

        // Fields
        $this->fields = array(
        
            array(
                'id' => 'small',
                'type' => 'checkbox',
                'options' => array(
                    '1' => __( 'Make Heading Small', 'spyropress' ),
                )
            ),

            array(
                'label' => __( 'Heading Text', 'spyropress' ),
                'id' => 'heading',
                'type' => 'text'
            ),
            
            array(
                'label' => __( 'Sub Text', 'spyropress' ),
                'id' => 'sub_heading',
                'type' => 'text'
            ),
            
            array(
                'label' => __( 'Teaser Content', 'spyropress' ),
                'id' => 'teaser',
                'type' => 'textarea',
                'rows' => 5
            ),
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        $small = false;
        extract( $args ); extract( $instance );

        if( empty( $heading ) && empty( $sub_heading ) && empty( $teaser ) ) return;

        // Setup Data
        $tag = ( $small ) ? 'h3' : 'h1';
        if( $sub_heading ) $sub_heading = '<span>' . $sub_heading . '</span>';
        if( $heading ) $heading = '<' . $tag . '>' . $heading . $sub_heading . '</' . $tag . '>';
        if( $teaser ) $teaser = '<p class="lead">' . $teaser . '</p>';
                
        echo $heading . $teaser;
    }
}

spyropress_builder_register_module( 'Spyropress_Module_Heading' );

?>