<?php
/**
 * Plugin Name:       WP Custom Post Style
 * Plugin URI:        #
 * Description:       Provides Custom Post Style
 * Author:            Team Techvengers
 * Author URI:        https://techvengers.com
 * Text Domain:       wp-custom-post-style
 */

// Register Post Type

function add_my_custom_page() {
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( 'My Custom Page' ),
      'post_content'  => '<div>Hello World</div>',
      'post_status'   => 'publish',
      'post_type'     => 'page',
    );

    // Insert the post into the database
    wp_insert_post( $my_post );
}

register_activation_hook(__FILE__, 'add_my_custom_page');

function on_deactivating_your_plugin() {

    $page = get_page_by_path( 'My Custom Page' );
    wp_delete_post($page->ID);

}
register_deactivation_hook( __FILE__, 'on_deactivating_your_plugin' );



function pluginprefix_setup_post_type() {
    register_post_type( 'book', ['public' => true ] ); 
} 
add_action( 'init', 'pluginprefix_setup_post_type' );
// Plugin Activation
function pluginprefix_activate() {
    pluginprefix_setup_post_type();
    flush_rewrite_rules(); 
}
register_activation_hook( 'wp-custom-post-style', 'pluginprefix_activate' );
// Plugin Deactivation
function pluginprefix_deactivate() {
    unregister_post_type( 'book' );
    flush_rewrite_rules();
}
register_deactivation_hook( 'wp-custom-post-style', 'pluginprefix_deactivate' );