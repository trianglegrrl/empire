<?php

/**
 * Module: Skills
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Skills extends SpyropressBuilderModule {

    /**
     * Constructor
     */
    public function __construct() {

        $this->path = dirname(__FILE__);
        // Widget variable settings
        $this->cssclass = 'module-skills';
        $this->description = __( 'Display a skill.', 'spyropress' );
        $this->id_base = 'spyropress_skills';
        $this->name = __( 'Skill', 'spyropress' );
        
        // Fields
        $this->fields = array (
        
            array(
                'label' => __( 'Label', 'spyropress' ),
                'id' => 'title',
                'type' => 'text'
            ),
            
            array(
                'label' => __( 'Percentage', 'spyropress' ),
                'id' => 'percentage',
                'type' => 'range_slider',
            )
        );
        
        $this->create_widget();
    }

    function widget( $args, $instance ) {
        
        // extracting info
        extract( $args ); extract( $instance );
        
        echo '
        <h5 class="progress-text">' . $title . ' <span>' . $percentage . '%</span></h5>
        <div class="progress">
            <div class="bar" style="width: ' . $percentage . '%"></div>
        </div>';
    }

}

spyropress_builder_register_module( 'Spyropress_Module_Skills' );

?>