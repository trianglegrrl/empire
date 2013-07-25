<?php

/**
 * Theme Meta Info for internal usage
 * 
 * Dont Mess with it.
 */
add_action('spyropress_init', 'spyropress_setup_theme');
function spyropress_setup_theme() {
    global $spyropress;
    
    $spyropress->internal_name = 'esatto';
    $spyropress->theme_name = 'Esatto';
    $spyropress->theme_version = '1.0';
    
    $spyropress->row_class = 'row';
}
?>