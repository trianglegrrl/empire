<?php

// Setup Instance for view
$instance = spyropress_clean_array( $instance );
$instance['callback'] = 'generate_masonary_items';

// tempalte
$tmpl = '{content}{pagination}';

$this->display_filters( $instance, 'all-masonry' );

echo '<div id="masonry" class="work-list">';    

    // output content
    echo $this->query( $instance, $tmpl );

echo '</div>';
?>