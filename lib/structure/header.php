<?php
/**
 * Header HTML markup structures
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

add_action ( 'widgets_init', __NAMESPACE__ . '\register_header_widgets' );
/**
 * Register footer widget areas
 *
 * @since 1.0.0
 *
 * @return void
 */
function register_header_widgets() {

	genesis_register_sidebar( array(
		'id' => 'top-header-widgets',
		'name' => __( 'Top Bar', CHILD_TEXT_DOMAIN ),
		'description' => __( 'This appears in the red bar at the top of the website', CHILD_TEXT_DOMAIN ),
	) );

}

// Position footer widget header
add_action ( 'genesis_before_header', __NAMESPACE__ . '\position_header_widgets', 1 );
/**
 * Position widget area that appears above footer
 *
 * @since 1.0.0
 *
 * @return void
 */
function position_header_widgets ()  {

	genesis_widget_area( 'top-header-widgets', array(
		'before' => '<div class="top-header-widgets"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}