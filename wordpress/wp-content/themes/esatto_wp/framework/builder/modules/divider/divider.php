<?php

/**
 * Module: Divider 
 * Separate sections of the layout.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Divider extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->cssclass = 'module-divider';
        $this->description = __( 'Separate sections of the layout.', 'spyropress' );
        $this->id_base = 'spyropress_divider';
        $this->name = __( 'Divider', 'spyropress' );

        $this->fields = array(
            array(
                'label' => __( 'Style', 'spyropress' ),
                'id' => 'style',
                'type' => 'select',
                'options' => array(
                    's2' => 'Style 1'
                )
            )
        );

        $this->create_widget();

    }

    function widget( $args, $instance ) {
        
        $style = false;
        // outputs the content of the widget
        extract( $instance );
        
        $style = ( $style ) ? ' class="' . $style . '"' : '';
        echo '<hr' . $style . '/>';
    }

}

spyropress_builder_register_module( 'Spyropress_Module_Divider' );

?>