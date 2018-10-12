<?php
/**
 * Template Name: Narrow Width
 *
 * Narrow width page template
 *
 * @package KristaRae\Starter
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\Starter;

add_filter( 'body_class', __NAMESPACE__ . '\add_body_class' );
/**
 * Adds a css class to the body element
 *
 * @since 1.0.0
 *
 * @param $classes
 *
 * @return array
 */
function add_body_class( $classes ) {

	$classes[] = 'narrow-width';
	return $classes;

}

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

genesis();