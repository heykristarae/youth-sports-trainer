<?php
/**
 * Takes care of formatting
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

add_filter( 'gettext_with_context', __NAMESPACE__ . '\change_name_placeholder', 10, 4 );
/**
 * Customize the Name placeholder text for the subscribe Beaver Builder module
 *
 * @since 1.0.0
 *
 * @param $translated
 * @param $text
 * @param $context
 * @param $domain
 *
 * @return string
 */
function change_name_placeholder( $translated, $text, $context, $domain ) {

	if ( 'fl-builder' == $domain  && 'Name' == $text && 'First and last name.' == $context ) {
			$translated = 'First Name';
	}

	return $translated;

}