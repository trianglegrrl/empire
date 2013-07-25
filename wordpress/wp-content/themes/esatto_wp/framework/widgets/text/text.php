<?php

/**
 * Text and Photo Widget
 * Display static text and photo.
 *
 * @package		SpyroPress
 * @category	Widgets
 * @author		SpyroSol
 */

class SpyroPress_Widget_TextPhoto extends SpyropressWidget {

    /**
     * Constructor
     */
    function __construct() {

        // Widget variable settings.
        $this->cssclass = 'text-photo';
        $this->description = __( 'Display static text and photo.', 'spyropress' );
        $this->id_base = 'spyropress_textphoto';
        $this->name = __( 'Spyropress: Text & Photo', 'spyropress' );

        $this->templates['about'] = array (
            'label' => __( 'About', 'spyropress' ),
            'class' => 'about'
        );

        $this->fields = array(

            array(
                'label' => __( 'Title', 'spyropress' ),
                'id' => 'title',
                'type' => 'text',
            ),

            array(
                'label' => __( 'Content', 'spyropress' ),
                'id' => 'content',
                'type' => 'textarea',
            ),

            array(
                'id' => 'filter',
                'type' => 'checkbox',
                'options' => array(
                    '1' => __( 'Automatically add paragraphs', 'spyropress' )
                )
            ),

            array(
                'label' => 'Templates',
                'id' => 'template',
                'type' => 'select',
                'options' => $this->get_option_templates()
            ),

            array( 'label' => 'Image', 'type' => 'toggle'),
            array(
                'label' => __( 'Photo', 'spyropress' ),
                'id' => 'photo',
                'type' => 'upload',
            ),

            array(
                'label' => __( 'Image Photo Width', 'spyropress' ),
                'id' => 'size',
                'type' => 'range_slider',
                'max' => 800
            ),

            array(
                'label' => __( 'Align Photo', 'spyropress' ),
                'id' => 'float',
                'type' => 'select',
                'options' => spyropress_get_options_float()
            ),

            array( 'type' => 'toggle_end'),
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {

        // extracting info
        $photo = false;
        extract( $args );
        extract( spyropress_clean_array( $instance ) );

        if ( ! $content ) return;

        // get view to render
        include $this->get_view();
    }
} // class SpyroPress_Widget_TextPhoto

register_widget( 'SpyroPress_Widget_TextPhoto' );
?>