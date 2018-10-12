<?php
/**
 * Blog HTML markup structures
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

add_filter( 'genesis_post_info', __NAMESPACE__ . '\customize_post_meta' );
/**
 * Customize the post meta
 *
 * @since 1.0.0
 *
 * @param $post_info
 *
 * @return string
 */
function customize_post_meta($post_info) {

	if ( !is_page() && !is_category() ) {

		$author_description = ", " . get_the_author_meta('description');
		if ( $author_description == ", " ) {
			$author_description = "";
		}

		$post_info = '<div class="post-social-icons">[addtoany]</div>';
		$post_info .= '<div class="post-author">[post_author before="By "]<span class="author-title">' . $author_description . '</span></div>';
		$post_info .= '[post_categories before=""]';
	}

	return $post_info;
}

add_filter('excerpt_more', __NAMESPACE__ . '\edit_read_more_link');
add_filter( 'the_content_more_link', __NAMESPACE__ . '\edit_read_more_link' );
/**
 * Add and edit read more links
 *
 * @since 1.0.0
 *
 * @return string
 */
function edit_read_more_link() {
	return '<div class="read-more"><a href="' . get_permalink() . '" class="more-link">Read&nbsp;More</a></div>';
}

add_action( 'genesis_setup', __NAMESPACE__ . '\remove_post_meta', 15 );
/**
 * Remove the entry meta in the entry footer
 */
function remove_post_meta() {
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
}

add_action( 'pre_get_posts', __NAMESPACE__ . '\set_category_posts_per_page' );
/**
 * Set the number of posts to display per page for categories
 *
 * @since 1.0.0
 *
 * @param $query
 *
 * @return void
 */
function set_category_posts_per_page( $query ) {

	if ( !is_admin() && $query->is_main_query() && is_category() ){
		$query->set( 'posts_per_page', 10 );
	}

}

add_action( 'pre_get_posts', __NAMESPACE__ . '\exclude_exercises_from_blog' );
/**
 * Exclude exercises from blog page
 *
 * @since 1.0.0
 *
 * @param $query
 *
 * @return void
 */
function exclude_exercises_from_blog( $query ) {

	if( $query->is_main_query() && $query->is_home() ) {
		$query->set( 'cat', '-33' );
	}
}