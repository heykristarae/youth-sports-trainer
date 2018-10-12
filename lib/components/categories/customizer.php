<?php
/**
 * Handles the Customizer settings for the category hero section
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */

namespace KristaRae\YouthSportsTrainer;

use WP_Customize_Control;
use WP_Customize_Color_Control;

add_action( 'customize_register', __NAMESPACE__ . '\add_category_hero_settings' );
/**
 * Creates the category hero settings and controls
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function add_category_hero_settings( $wp_customize ) {

//	global $wp_customize;

	$section = SETTINGS_PREFIX . '_category_hero_section';
	$wp_customize->add_section(
		$section,
		array(
			'title'       => 'Category Page',
			'description' => 'Hero image and text shown at the top of all category pages',
			'priority'    => 35,
		)
	);

	// Image
	$wp_customize->add_setting( SETTINGS_PREFIX . 'category_hero_image' );
	$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'category_hero_image', array(
		'label'   => 'Hero Image',
		'section' => $section,
		'settings' => SETTINGS_PREFIX . 'category_hero_image',
		'priority' => 1
	) ) );


	// Text
	$wp_customize->add_setting( SETTINGS_PREFIX . 'category_hero_text' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, SETTINGS_PREFIX . 'category_hero_text', array(
		'label'    => 'Hero Section Text',
		'section'  => $section,
		'settings' => SETTINGS_PREFIX . 'category_hero_text',
		'priority' => 2
	) ) );


	// Subheading
	$wp_customize->add_setting( SETTINGS_PREFIX . 'category_subheading_text' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, SETTINGS_PREFIX . 'category_subheading_text', array(
		'label'    => 'Subheading Text',
		'section'  => $section,
		'settings' => SETTINGS_PREFIX . 'category_subheading_text',
		'priority' => 2
	) ) );

}