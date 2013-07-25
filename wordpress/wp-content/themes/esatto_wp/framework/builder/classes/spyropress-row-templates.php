<?php

/**
 * SpyroPress Builder
 * Default builder row types
 *
 * @author 		SpyroSol
 * @category 	Builder
 * @package 	Spyropress
 */

/**
 * One Column Row
 */
class one_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '1Col Row', 'spyropress' ),
            'description' => __( 'Full width row.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/1col.png' ),
            'columns' => array(
                array( 'type' => 'col_11' )
            )
        );
    }
}
spyropress_builder_register_row( 'one_col_row_class' );

/**
 * Two Column Row
 */
class two_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '2Col Row', 'spyropress' ),
            'description' => __( 'Row contain 2 half columns.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/2col.png' ),
            'columns' => array(
                array( 'type' => 'col_12' ),
                array( 'type' => 'col_12' )
            )
        );
    }
}
spyropress_builder_register_row( 'two_col_row_class' );

/**
 * Three Column Row
 */
class three_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '3Col Row', 'spyropress' ),
            'description' => __( 'Row contain 3 one-fourth columns.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/3col.png' ),
            'columns' => array(
                array( 'type' => 'col_13' ),
                array( 'type' => 'col_13' ),
                array( 'type' => 'col_13' )
            )
        );
    }
}
spyropress_builder_register_row( 'three_col_row_class' );

/**
 * Four Column Row
 */
class four_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '4Col Row', 'spyropress' ),
            'description' => __( 'Row contain 4 one-third columns.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/4col.png' ),
            'columns' => array(
                array( 'type' => 'col_14' ),
                array( 'type' => 'col_14' ),
                array( 'type' => 'col_14' ),
                array( 'type' => 'col_14' )
            )
        );
    }
}
spyropress_builder_register_row( 'four_col_row_class' );

/**
 * Six Column Row
 */
class six_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( '6Col Row', 'spyropress' ),
            'description' => __( 'Row contain 6 one-sixth columns.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/6col.png' ),
            'columns' => array(
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' )
            )
        );
    }
}
spyropress_builder_register_row( 'six_col_row_class' );

/**
 * Left Sidebar Row
 */
class left_sidebar_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( 'Left Sidebar', 'spyropress' ),
            'description' => __( 'Row has left sidebar.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/left-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_13' ),
                array( 'type' => 'col_23' )
            )
        );
    }
}
spyropress_builder_register_row( 'left_sidebar_row_class' );

/**
 * Right Sidebar Row
 */
class right_sidebar_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( 'Right Sidebar', 'spyropress' ),
            'description' => __( 'Row has right sidebar.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/right-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_23' ),
                array( 'type' => 'col_13' )
            )
        );
    }
}
spyropress_builder_register_row( 'right_sidebar_row_class' );


/**
 * Google Map Rpw
 */
class gmap_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => __( 'Map Row', 'spyropress' ),
            'description' => __( 'Google map row.', 'spyropress' ),
            'icon' => get_panel_img_path( 'layouts/1col.png' ),
            'columns' => array(
                array( 'type' => 'col_11' )
            )
        );
    }
    
    function row_wrapper( $row_ID, $row ) {
        $section_class = ' class="map-cont"';
        $row_html = sprintf( '
            <div id="%1$s"%2$s>
                %3$s
            </div>', $row_ID, $section_class, builder_render_frontend_columns( $row['columns'] )
        );
        
        return $row_html;
    }
}
spyropress_builder_register_row( 'gmap_row_class' );
?>