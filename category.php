<?php
/**
 * Category page template
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_before_content_sidebar_wrap', __NAMESPACE__ . '\build_category_hero_html', 5 );
/**
 * Outputs site banner HTML
 *
 * @since 1.0.0
 *
 * @return void
 */
function build_category_hero_html() {

	$image_url = get_theme_mod(SETTINGS_PREFIX . 'category_hero_image');
	$text  = get_theme_mod(SETTINGS_PREFIX . 'category_hero_text');

	if ( !$image_url ) {
		return;
	}

	$content = '<div class="category-hero">';
	$content .= '<img src="' . $image_url . '" alt="' . $text . '" />';
	$content .= '<div class="category-hero-text">';
	$content .= '<h3>' . $text . '</h3>';
	$content .= '</div></div>';

	echo $content;

}

add_action( 'genesis_before_content_sidebar_wrap', __NAMESPACE__ . '\add_category_hero', 6);
function add_category_hero() {

	$heading_text = get_theme_mod(SETTINGS_PREFIX . 'category_subheading_text');

	$content = '<div class="category-list">';
	$content .= '<h4>' . $heading_text . '</h4>';
	$content .= build_category_list();
	$content .= '</div><div id="articles"></div>';

	echo $content;
}

function build_category_list() {

	$categories = get_terms( 'category' );
	$html = '';

	foreach ( $categories as $category ) {
		if ( get_field( 'show_on_category_pages', $category ) ) {
			$html .= create_category( $category );
		}
	}

	return $html;
}

function create_category( $category ) {

	$name = $category->name;
	$category_id = get_cat_ID( $name );
	$link = get_category_link( $category_id ) . "/#genesis-content";
	$image_url = get_field( 'cat_image', $category );
	$button_color = get_field( 'cat_button_color', $category );
	$button_text_color = get_field( 'cat_button_text_color', $category );

	$html = '<div class="category">';
	$html .= '<a href="' . $link . '"><img src="' . $image_url . '" alt="' . $name . '" />';
	$html .= '<a href="' . $link . '" class="button" style="color: ' . $button_text_color . '; background-color: ' . $button_color . ';" >' . $name . '</a>';
	$html .= '</div>';

	return $html;
}

//* Move featured image above entry title in archives.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_before_entry', 'genesis_do_post_image', 8 );

add_filter( 'genesis_post_info', __NAMESPACE__ . '\customize_category_post_meta' );
/**
 * Customize the post meta
 *
 * @since 1.0.0
 *
 * @param $post_info
 *
 * @return string
 */
function customize_category_post_meta($post_info) {

	$post_info = '<div class="post-author">[post_author before="By "]</div>';
	$post_info .= '[post_date before=" | " after=" | "]';
	$post_info .= '[post_categories before=""]';

	return $post_info;

}

genesis();