<?php
/**
 * Simple Social Icon plugin setup
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

add_filter( 'simple_social_default_profiles', __NAMESPACE__ . '\reorder_simple_icons' );
/**
 * Reorders the icons for the Simple Social Icons plugin
 *
 * @since 1.0.0
 *
 * @param $icons
 *
 * @return array
 */
function reorder_simple_icons( $icons ) {

	// Set your new order here
	$new_icon_order = array(
		'twitter'     => '',
		'youtube'     => '',
		'instagram'   => '',
		'facebook'    => '',
		'pinterest'   => '',
		'behance'     => '',
		'bloglovin'   => '',
		'dribbble'    => '',
		'email'       => '',
		'flickr'      => '',
		'github'      => '',
		'gplus'       => '',
		'linkedin'    => '',
		'medium'      => '',
		'periscope'   => '',
		'phone'       => '',
		'rss'         => '',
		'snapchat'    => '',
		'stumbleupon' => '',
		'tumblr'      => '',
		'vimeo'       => '',
		'xing'        => '',
	);

	foreach( $new_icon_order as $icon => $icon_info ) {
		$new_icon_order[ $icon ] = $icons[ $icon ];
	}

	return $new_icon_order;
}