<?php
/**
 * Comments HTML markup structures
 *
 * @package KristaRae\YouthSportsTrainer
 * @since   1.0.0
 * @author  Krista Rae LLC
 * @link    https://kristarae.co
 * @license GPL
 */
namespace KristaRae\YouthSportsTrainer;

add_filter( 'genesis_comment_list_args', __NAMESPACE__ . '\setup_comments_gravatar' );
/**
 * Modify size of the Gravatar in the entry comments
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function setup_comments_gravatar( array $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

add_filter( 'genesis_title_comments', __NAMESPACE__ . '\change_comments_heading' );
/**
 * Modify comments title text
 *
 * @since 1.0.0
 *
 * @return string
 */
function change_comments_heading() {

	$title = '<h3><span class="comments-black-background">Comments</span> <span class="comments-line">|</span> <span class="leave-comment">Leave a comment >></span></h3>';
	return $title;

}

/** Move Genesis Comments */
add_action( 'genesis_before_comments' , __NAMESPACE__ . '\move_comments_below_form' );
function move_comments_below_form() {

	if ( is_single() && have_comments() ) {
		remove_action( 'genesis_comment_form', 'genesis_do_comment_form' );
		add_action( 'genesis_comments', 'genesis_do_comment_form', 5 );
	}

}

add_filter('comment_form_defaults', __NAMESPACE__ . '\change_reply_heading');
function change_reply_heading ($arg) {
	$arg['title_reply'] = __('<span class="comments-black-background">Comments</span> <span class="comments-line">|</span> <span class="leave-comment">Leave a comment >></span>'); // replace 'Leave a Comment' to your own text
	return $arg;
}

add_filter('comment_form_defaults', __NAMESPACE__ . '\change_comment_button_text');
/**
 * Change comment button text
 *
 * @since 1.0.0
 *
 * @param $arg
 *
 * @return mixed
 */
function change_comment_button_text($arg) {

	$arg['label_submit'] = 'Submit';
	return $arg;

}

add_filter( 'comment_form_fields', __NAMESPACE__ . '\move_comment_field_to_bottom' );
/**
 * Move comment field to bottom of form
 *
 * @since 1.0.0
 *
 * @param $fields
 *
 * @return mixed
 */
function move_comment_field_to_bottom( $fields ) {

	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;

}

add_filter( 'genesis_show_comment_date', __NAMESPACE__ . '\show_comment_date_with_link' );
/**
 * Show Comment Date with link but without the time
 *
 * @since 1.0.0
 *
 * @param $comment_date
 *
 * @return bool
 */
function show_comment_date_with_link( $comment_date ) {

	printf('<p %s><time %s>%s</time></p>',
		genesis_attr( 'comment-meta' ),
		genesis_attr( 'comment-time' ),
		esc_html( get_comment_date() )
	);

	// Return false so that the parent function doesn't output the comment date, time and link
	return false;

}

add_filter( 'comment_form_default_fields', __NAMESPACE__ . '\add_comment_placeholders' );
/**
 * Add Placehoder in comment Form Fields (Name, Email, Website)
 *
 * @since 1.0.0
 *
 * @param $fields
 *
 * @return mixed
 */
function add_comment_placeholders( $fields )
{

	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="Name"',
		$fields['author']
	);

	$fields['email'] = str_replace(
		'<input',
		'<input placeholder="Email"',
		$fields['email']
	);

	$fields['url'] = str_replace(
		'<input',
		'<input placeholder="Website"',
		$fields['url']
	);

	return $fields;

}