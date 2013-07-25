<?php

// Setup Instance for view
$instance = spyropress_clean_array( $instance );
$instance['row_class'] = get_row_class( true ) . ' work-list';
// tempalte
$tmpl = '{content}{pagination}';

$this->display_filters( $instance );

echo $this->query( $instance, $tmpl );
?>