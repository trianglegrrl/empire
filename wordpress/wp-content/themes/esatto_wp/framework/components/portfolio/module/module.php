<?php

/**
 * Module: Portfolio
 * Display a list of portfolio
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Portfolio extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->path = dirname( __FILE__ );
        $this->cssclass = 'module-portfolio';
        $this->description = __( 'Display a list of portfolio.', 'spyropress' );
        $this->id_base = 'spyropress_portfolio';
        $this->name = __( 'Portfolio', 'spyropress' );

        // Tempaltes
        $this->templates['masonary'] = array(
            'label' => 'Masonary',
            'class' => 'masonary',
            'view' => 'masonary.php'
        );
        // Fields
        $this->fields = array(

            array(
                'label' => __( 'Portfolio Style', 'spyropress' ),
                'id' => 'template',
                'type' => 'select',
                'options' => $this->get_option_templates(),
                'desc' => 'Default layout is Column.'
            ),

            array(
                'label' => __( 'Number of items per page', 'spyropress' ),
                'id' => 'limit',
                'type' => 'range_slider',
                'max' => 30,
                'std' => 4
            ),
            
            array(
                'label' => __( 'Number of Columns', 'spyropress' ),
                'id' => 'columns',
                'type' => 'range_slider',
                'max' => 4,
                'std' => 4,
                'desc' => 'Applied only to column layout.'
            ),
                
            array(
                'label' => __( 'Portfolio Category', 'spyropress' ),
                'id' => 'cat',
                'type' => 'multi_select',
                'options' => spyropress_get_taxonomies( 'portfolio_category' )
            ),

            array(
                'label' => __('Enable Features', 'spyropress'),
                'id' => 'features',
                'type' => 'checkbox',
                'desc' => 'Will show pagination if portfolio per page is set.',
                'options' => array(
                    'pagination' => __('Enable pagination for the next page', 'spyropress'),
                    'filters' => __('Enable filters for items', 'spyropress')
                )
            )
        );

        $this->create_widget();
    }

    function widget( $args, $instance ) {
        
        // extracting info
        extract( $args );

        // get view to render
        include $this->get_view( $instance['template'] );
    }
    
    function display_filters( $instance, $all_id = 'all' ) {
        
        if( !isset( $instance['features'] ) || !in_array( 'filters', $instance['features'] ) ) return;
        
        $cats = spyropress_get_taxonomies( 'portfolio_category' );
        
        if( empty( $cats ) ) return;
        
        echo '<div class="nav-folio text-center"><a id="' . $all_id . '">All</a> ';
        
        foreach( $cats as $slug => $name ) {
            echo '<a id="' . $slug . '">' . $name . '</a> ';
        }
        
        echo '</div>';
    }
    
    function query( $atts, $content = null ) {

        $default = array (
            'post_type' => 'portfolio',
            'limit' => -1,
            'columns' => false,
            'pagination' => false,
            'callback' => 'generate_portfolio_item',
            'item_class' => 'portfolio-entry'
        );
        $atts = wp_parse_args( $atts, $default );
    
        if ( ! empty( $atts['cat'] ) ) {
    
            $atts['tax_query']['relation'] = 'OR';
            if ( ! empty( $atts['cat'] ) ) {
                $atts['tax_query'][] = array(
                    'taxonomy' => 'portfolio_category',
                    'field' => 'slug',
                    'terms' => $atts['cat'],
                    );
                unset( $atts['cat'] );
            }
        }
    
        if ( $content )
            return token_repalce( $content, spyropress_query_generator( $atts ) );
    
        return spyropress_query_generator( $atts );
    }

}

spyropress_builder_register_module( 'Spyropress_Module_Portfolio' );


// Item HTML Generator
/**
 * generate_masonary_items()
 * 
 * @param mixed $post_ID
 * @param mixed $atts
 * @return
 */
function generate_masonary_items( $post_ID, $atts ) {
    
    $is_featured = get_post_meta( $post_ID, 'highlight', true );
    $class = ( $is_featured ) ? 'single big' : 'single';
    $cats = get_the_terms( $post_ID, 'portfolio_category' );
    
    if( !empty( $cats ) ) {
        foreach( $cats as $cat )
            $class .= ' ' . $cat->slug;
    }
    $image = get_image( array(
        'width' => ( $is_featured ) ? 999 : 300,
        'type' => 'rel',
        'rel' => 'tag',
        'link_class' => 'fancybox',
        'echo' => false                       
    ) );
    
    $image = str_replace( '</a>', '<span class="sosa">]</span></a>', $image );
    return '
    <div class="' . $class . '">
        ' . $image . '
        <h3><a href="#">' . get_the_title( $post_ID ) . '</a></h3>
    </div>';
}

function generate_portfolio_item( $post_ID, $atts ) {

    $class = 'work-box ' . $atts['column_class'];
    $cats = get_the_terms( $post_ID, 'portfolio_category' );
    
    if( !empty( $cats ) ) {
        foreach( $cats as $cat )
            $class .= ' ' . $cat->slug;
    }
    $width = 300;
    if( 2 == $atts['columns'] ) $width = 999;
    elseif( 1 == $atts['columns'] ) $width = 9999;
    
    $image = get_image( array(
        'width' => $width,
        'echo' => false                       
    ) );
    
    return '
    <div class="' . $class . '">
        <div class="thumbnail">
            ' . $image . '
            <a href="' . get_permalink( $post_ID ) . '" class="sosa fancybox" rel="tag" title="Work">]</a>
            <p>' . get_the_title( $post_ID ) . '</p>
        </div>
    </div>';
}
?>