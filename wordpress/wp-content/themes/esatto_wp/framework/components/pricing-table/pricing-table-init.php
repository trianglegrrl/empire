<?php

/**
 * Pricing Table Component
 *
 * @package		SpyroPress
 * @category	Components
 */

/**
 * SpyropressPricingTable
 *
 * @package Default-WP
 * @author phpdesigner
 * @copyright 2013
 * @version $Id$
 * @access public
 */
class SpyropressPricingTable extends SpyropressComponent {

    private $path;

    function __construct() {

        $this->path = dirname(__FILE__);
        add_action( 'spyropress_register_taxonomy', array( $this, 'register' ) );
        add_shortcode( 'pricing_table',  array( $this, 'shortcode_handler' ) );
        //add_filter( 'builder_include_modules', array( $this, 'register_module' ) );
    }

    function register() {

        // Init Post Type
        $args = array( 'supports' => array( 'title' ) );
        $post_type = new SpyropressCustomPostType( 'Pricing Table', 'pricingtable', $args );

        // Shortcode Meta Box
        $instructions = '<p>' . __( 'Display price table anywhere into your posts, pages, custom post types or widgets by using the shortcode below:', 'spyropress' ) . '</p>';
        $instructions .= '<p><code>[pricing_table id={post_id}]</code></p>';

        $sc_fields['shortcode'] = array(
            array(
                'label' => 'shortcode',
                'type' => 'heading',
                'slug' => 'shortcode'
            ),

            array(
                'id' => 'instruction_info',
                'type' => 'raw_info',
                'function' => array( $this, 'set_post_id' ),
                'desc' => $instructions,
            )
        );

        $post_type->add_meta_box( 'shortcode', 'Shortcode', $sc_fields, false, false, 'side' );

        // Add Meta Boxes
        $meta_fields['table'] = array(
            array(
                'label' => 'Table',
                'type' => 'heading',
                'slug' => 'table'
            ),

            array(
                'label' => __( 'Table', 'spyropress' ),
                'type' => 'repeater',
                'id' => 'tables',
                'item_title' => 'title',
                'hide_label' => true,
                'fields' => array(

                    array( 'type' => 'row' ),

                        array( 'type' => 'col', 'size' => 6 ),

                            array(
                                'label' => __( 'Title', 'spyropress' ),
                                'id' => 'title',
                                'type' => 'text'
                            ),
                            
                            array(
                                'label' => __( 'Price', 'spyropress' ),
                                'id' => 'price',
                                'type' => 'text'
                            ),

                            array(
                                'label' => __( 'Button Text', 'spyropress' ),
                                'id' => 'text',
                                'type' => 'text'
                            ),

                        array( 'type' => 'col_end' ),

                        array( 'type' => 'col', 'size' => 6 ),

                            array(
                                'label' => __( 'Sub-title', 'spyropress' ),
                                'id' => 'sub_title',
                                'type' => 'text'
                            ),
                            
                            array(
                                'label' => __( 'Currency', 'spyropress' ),
                                'id' => 'currency',
                                'type' => 'text'
                            ),

                            array(
                                'label' => __( 'Button URL', 'spyropress' ),
                                'id' => 'url',
                                'type' => 'text'
                            ),

                        array( 'type' => 'col_end' ),

                    array( 'type' => 'row_end' ),

                    array(
                        'label' => __( 'Description', 'spyropress' ),
                        'id' => 'description',
                        'type' => 'textarea',
                        'rows' => 4
                    ),
                    
                    array(
                        'id' => 'icon',
                        'type' => 'select',
                        'label' => 'Icon',
                        'options' => spyropress_get_options_icons()
                    ),

                    array(
                        'label' => __( 'Features', 'spyropress' ),
                        'type' => 'repeater',
                        'id' => 'features',
                        'item_title' => 'title',
                        'fields' => array(
                            array(
                                'label' => __( 'Title', 'spyropress' ),
                                'id' => 'title',
                                'type' => 'text'
                            )
                        )
                    )
                )
            )
        );

        $post_type->add_meta_box( 'tables', 'Tables', $meta_fields, false, false );
    }

    /**
     * Callback for post_ID for instruction box
     */
    function set_post_id( $output ) {
        global $post;
        return str_replace( '{post_id}', $post->ID, $output );
    }

    /**
     * Shortcode handler
     */
    function shortcode_handler( $atts, $content = '' ) {

        // check
        if( ! isset( $atts['id'] ) || empty( $atts['id'] ) ) return;

        $slider_id = $atts['id'];

        // get slider meta
        $meta = get_post_custom( $slider_id );

        // get slider type
        $columns = maybe_unserialize( $meta['tables'][0] );
        if( empty( $columns ) ) return;

        // get template
        $template = 'pricing';
        if( isset( $meta['template'] ) )
            $template = maybe_unserialize( $meta['template'][0] );

        $func = "render_table_design_pricing";
        return $this->{$func}( $columns );
    }

    function render_table_design_pricing( $columns ) {
        $tables = '';
        foreach( $columns as $column ) {

            $features = '';
            foreach( $column['features'] as $feature ) {
                $features .= '<li>' . $feature['title'] . '</li>';
            }

            $tables .= '
            <div class="span3">
            	<div class="thumbnail hover pricing">
            		<span class="sosa bg">&#x' . $column['icon'] . ';</span>
            		<h3><span>' . $column['title'] . '</span> ' . $column['sub_title'] . '</h3>
            		<p>' . $column['description'] . '</p>
            		<ul class="nav">
            			<li class="price">' . $column['currency'] . ' ' . $column['price'] . '</li>
            			' . $features . '
            		</ul>
            		<a href="' . $column['url'] . '" class="btn btn-large">' . $column['text'] . '</a>
            	</div>
            </div>';
        }
        return '<div class="row">' . $tables . '</div>';
    }

    function render_table_design_banner( $columns ) {
        $tables = '';
        foreach( $columns as $column ) {

            $class = 'product-header-pricing clearfix';

            $features = '';
            foreach( $column['features'] as $feature ) {
                $features .= '<p>' . $feature['title'] . '</p>';
            }

            $tables .= '
            <div class="' . $class . '">
                <div class="header-pricing">
                    <h3>' . $column['title'] . '</h3>
                    <p>' . $column['currency'] . $column['price'] . '</p>
                    <span>' . $column['description'] . '</span>
                </div>
                <div class="header-cta">
                    <a href="' . $column['url'] . '" class="big-button">' . $column['text'] . ' <i class="icon-chevron-right"></i></a>
                    ' . $features . '
                </div>
            </div>';
        }
        return $tables;
    }

    function register_module( $modules ) {

        $modules[] = $this->path . '/module/price-table.php';

        return $modules;
    }
}

/**
 * Init the Component
 */
new SpyropressPricingTable();
?>