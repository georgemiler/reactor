<?php
/**
 * Scripts and Styles
 * WordPress will add these to the theme header
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/wp_register_style
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see wp_register_style
 * @see wp_enqueue_style
 * @see wp_register_script
 * @see wp_enqueue_script
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Reactor Scripts
 *
 * @since 1.0.0
 */
function reactor_scripts() {
	if ( !is_admin() ) { 
		
		// register scripts
		wp_register_script('jquery-js', get_template_directory_uri() . '/library/js/vendor/jquery.js', array(), false, false);
		//wp_register_script('zepto-js', get_template_directory_uri() . '/library/js/vendor/zepto.js', array(), false, false);
		wp_register_script('modernizr-js', get_template_directory_uri() . '/library/js/vendor/custom.modernizr.js', array(), false, false);
		wp_register_script('foundation-js', get_template_directory_uri() . '/library/js/foundation.min.js', array(), false, true);
		wp_register_script('reactor-js', get_template_directory_uri() . '/library/js/reactor.js', array(), false, true);
		wp_register_script('quicksand-js', get_template_directory_uri() . '/library/js/quicksand.min.js', array(), false, true);
	
		// enqueue scripts
		wp_enqueue_script('jquery-js');
		//wp_enqueue_script('zepto-js');
		wp_enqueue_script('modernizr-js');
		wp_enqueue_script('foundation-js');
		wp_enqueue_script('reactor-js');
		
		// enqueue quicksand on portfolio page template
		if ( is_page_template('page-templates/portfolio.php') ) {
			wp_enqueue_script('quicksand-js');
		}
		
		// comment reply script for threaded comments
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply'); 
		}
		
	} // end if not admin
}
add_action('wp_enqueue_scripts', 'reactor_scripts');

/**
 * Reactor Styles
 *
 * @since 1.0.0
 */
function reactor_styles() {
	if ( !is_admin() ) { 
			
		// register styles
		wp_register_style('normalize', get_template_directory_uri() . '/library/css/normalize.css', array(), false, 'all');
		wp_register_style('foundation', get_template_directory_uri() . '/library/css/foundation.min.css', array(), false, 'all');
		wp_register_style('foundicons', get_template_directory_uri() . '/library/css/foundicons.css', array(), false, 'all');
		wp_register_style('reactor', get_template_directory_uri() . '/library/css/reactor.css', array(), false, 'all');
		wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array(), false, 'all');
	
		// enqueue styles
		wp_enqueue_style('normalize');
		wp_enqueue_style('foundation');
		wp_enqueue_style('foundicons');
		wp_enqueue_style('reactor'); 
		
		// add style.css with child themes
		if ( is_child_theme() ) {
			wp_enqueue_style('style');
		}
		
	} // end if not admin
}
add_action('wp_enqueue_scripts', 'reactor_styles');


/**
 * IE Styles
 * IE8 doesn't work well with Foundation 4
 * So we need to patch it up a bit
 * 
 * @since 1.0.0
 */
function reactor_ie_styles() {
	
	// load css for IE8
	wp_enqueue_style('ie8-style', get_template_directory_uri() . '/library/css/ie8.css');
	global $wp_styles;
	$wp_styles->add_data('ie8-style', 'conditional', 'lte IE 8');
	
}
add_action('wp_enqueue_scripts', 'reactor_ie_styles', 999);