<?php

echo $before_widget;
if ( $title != '' )
    echo $before_title . $title . $after_title;

if( $photo ) {
    echo '<div class="img-frame ' . get_float_class( $float ) . '">';
    if ( $size )
        $photo = spyropress_image( 'src=' . $photo . '&height=false&width=' . $size );
    else
        echo '<img src="' . $photo . '" alt="" />';
    echo '</div>';
}
echo '<div class="text">' . ( isset($instance['filter'] ) ? wpautop( $content ) : $content ) . '</div><div class="clear"></div>';
echo $after_widget;

?>