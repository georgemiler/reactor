<?php 
/**
 * Reactor Get Options
 * based on get_theme_mod in wp-includes/theme.php
 * retrieves an option from the database or cache
 * can also get a value from post meta
 *
 * @package Reactor
 * @since 1.0.0
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @param $name option name in database
 * @param $default a default value if option is avialble
 * @param $meta_id post meta id to retrieve meta from database
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
if ( !function_exists('reactor_option') ) { 
	function reactor_option( $name, $default = false, $meta_id = null ) {
		// if meta_id isset get post meta
		if ( isset( $meta_id ) ) {
			global $post;
			$meta = ( get_post_meta( $post->ID, $meta_id, true ) ) ? get_post_meta( $post->ID, $meta_id, true ) : null;
			// if meta is an array check for the name in the array
			if ( is_array( $meta ) ) {
				$meta = $meta[ $name ];
			}
			// if meta isset return the value
			if ( isset( $meta ) ) {
				return apply_filters( 'reactor_option_$name', $meta );
			} 
		} else {
			// get array of options
			$options = ( get_option( 'reactor_options' ) ) ? get_option( 'reactor_options' ) : null;
		}
		// return the option if it exists
		if ( isset( $options[ $name ] ) ) {
			return apply_filters( 'reactor_option_$name', $options[ $name ] );
		}
		// return default if nothing else isset
		return apply_filters( 'reactor_option_$name', $default );
	}
}