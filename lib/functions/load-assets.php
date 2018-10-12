<?php
/**
 * Loads all theme assets
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue Scripts and Styles.
 *
 * @since 1.0.2
 *
 * @return void
 */
function enqueue_assets() {

	wp_enqueue_style(
		CHILD_TEXT_DOMAIN . '-fonts',
		'//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700',
		array(),
		CHILD_THEME_VERSION );

	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		CHILD_TEXT_DOMAIN . '-responsive-menus',
		CHILD_URL . "/assets/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'youth-sports-trainer',
		CHILD_URL . "/assets/js/youth-sports-trainer.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_enqueue_style( 'dashicons' );

	wp_localize_script( CHILD_TEXT_DOMAIN . '-responsive-menus', 'genesis_responsive_menu', define_responsive_menu_settings() );

}