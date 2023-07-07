<?php
/**
 * Plugin Name: WordPress Support Engineer
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: wse-addon
 */

function wse_tast_elementor_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/wse-blog.php' );
	require_once( __DIR__ . '/widgets/wse-team.php' );
	require_once( __DIR__ . '/widgets/wse-carousel.php' );

	$widgets_manager->register( new \Wse_Blog_Elementor_Widget() );
	$widgets_manager->register( new \Wse_Team_Elementor_Widget() );
	$widgets_manager->register( new \Wse_Carousel_Elementor_Widget() );

}
add_action( 'elementor/widgets/register', 'wse_tast_elementor_widget' );

// Register Style enqueue
function wse_task_enqueue_widget_css() {

	wp_register_style( 'carousel-widget-css', plugin_dir_url( __FILE__ ) . '/assets/css/wse-carousel.css', array(), '1.0', 'all' );
	wp_register_style( 'blog-widget-css', plugin_dir_url( __FILE__ ) . '/assets/css/wse-blog.css', array(), '1.0', 'all' );
	wp_register_style( 'team-widget-css', plugin_dir_url( __FILE__ ) . '/assets/css/wse-team.css', array(), '1.0', 'all' );
	wp_register_style( 'slick', plugin_dir_url( __FILE__ ) . '/assets/css/slick.min.css', array(), '1.0', 'all' );

	global $post;
	// WSE Team Widget CSS
	if ( 'wse_blog_widget' === $post->post_name ) {
		wp_enqueue_style( 'blog-widget-css' );
	}
	// WSE Team Widget CSS
	if ( 'wse_team_widget' === $post->post_name ) {
		wp_enqueue_style( 'team-widget-css' );
	}
	// WSE Carousel Widget CSS
	if ( 'wse_carousel_widget' === $post->post_name ) {
		wp_enqueue_style( 'slick' );
		wp_enqueue_style( 'carousel-widget-css' );
	}

}
add_action( 'elementor/frontend/after_enqueue_styles', 'wse_task_enqueue_widget_css' );


// Enqueue Scripts
function wse_task_frontend_scripts() {
	wp_register_script( 'slick', plugins_url( '/assets/js/slick.min.js', __FILE__ ) );
	wp_register_script( 'wse-widgets-scripts', plugins_url( '/assets/js/wse-widgets.js', __FILE__ ) );

	// Check if the current widget is the specific one you want to target
	global $post;
	if ( 'wse_carousel_widget' === $post->post_name ) {
		wp_enqueue_script( 'slick' );
		wp_enqueue_script( 'wse-widgets-scripts' );
	}
}
add_action( 'elementor/frontend/after_register_scripts', 'wse_task_frontend_scripts' );
