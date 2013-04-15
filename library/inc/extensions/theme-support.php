<?php
/**
 * WP Theme Support
 * adds stuff WordPress can do
 * header and background not needed
 * Reactor handles those in the customizer
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support
 * @link http://codex.wordpress.org/Function_Reference/add_image_size
 * @link http://codex.wordpress.org/Function_Reference/add_editor_style
 * @see add_theme_support
 * @see add_image_size
 * @see add_editor_style
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( !function_exists('reactor_theme_support') ) {
	function reactor_theme_support() {
		if ( !isset( $content_width ) ) $content_width = 940;
		
		add_theme_support('menus');
		add_theme_support('post-thumbnails');
		// thumbnail sizes - you can add more
		add_image_size('thumb-300', 300, 250, true);
		add_image_size('thumb-200', 200, 150, true);
		
		// these are not needed
		// add_theme_support('custom-background');
		// add_theme_support('custom-header');
		
		// RSS feed links to <head> for posts and comments.
		add_theme_support('automatic-feed-links');
		
		// different post formats for tumblog style posting
		$formats = array('aside', 'gallery','link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
		add_theme_support('post-formats', $formats);
		
		// editor stylesheet for TinyMCE
		add_editor_style('/library/css/editor.css');
		
		// allows shortcodes in text widgets
		add_filter('widget_text', 'do_shortcode');       
	}
	
	add_action('after_setup_theme', 'reactor_theme_support', 11);
}