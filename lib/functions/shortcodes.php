<?php
/**
 * Setup the theme shortcodes
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

//* Allow the use of shortcodes in widget areas
add_filter('widget_text', 'do_shortcode');

add_shortcode( 'year', __NAMESPACE__ . '\get_year');
/**
 * A shortcode to display the current year
 *
 * @since 1.0.0
 *
 * @param $atts
 *
 * @return false|string
 */
function get_year( $atts ) {
	return date('Y');
}