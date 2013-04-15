<?php 
/**
 * Reactor Columns
 * a function to set grid columns based on page layout
 * also accepts custom args for Foundation grid
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Get Page Layout
 * Checks the different page templates 
 * and assigns a layout value
 *
 * @since 1.0.0
 */
if ( !function_exists('reactor_get_layout') ) { 
	function reactor_get_layout() {
		wp_reset_query();
		$layout = '';

		if ( is_page_template('page-templates/front-page.php') ) {
			$layout = reactor_option('frontpage_page_layout', '0side-cm');
		} 
		elseif ( is_page_template('page-templates/news-page.php') ) {
			$layout = reactor_option('newspage_page_layout', $layout);
		} 
		elseif ( is_page_template('page-templates/contact.php') ) {
			$layout = reactor_option('contact_page_layout', $layout);
		} 
		elseif ( is_page_template('page-templates/portfolio.php') 
			|| is_tax('portfolio-category') || is_tax('portfolio-tag') ) {
			$layout = reactor_option('portfolio_page_layout', '0side-cm');
		} 
		elseif ( is_page_template('page-templates/left-sidebar.php') ) {
			$layout = '1side-cr';
		}
		elseif ( is_page_template('page-templates/side-menu.php') ) {
			$layout = 'side-menu';
		}
		elseif ( is_page_template('page-templates/full-width.php') || is_404() ) {
			$layout = '0side-cm';
		} 
		else {
			$layout = reactor_option('page_layout', '1side-cl');
		}
		
		do_action('reactor_get_layout', $layout);
		
		return apply_filters('reactor_page_layout', $layout);
	}
}

/**
 * Dynamic Content Columns
 * Checks if is a sidebar then uses layout
 * to determine columns for a page
 * Can also pass custom args
 *
 * @uses reactor_get_layout
 * @since 1.0.0
 */
if ( !function_exists('reactor_columns') ) {
	function reactor_columns( $columns = '', $args = '', $layout = null ) {

		// if array of 2 numbers is passed to the function
		if ( $columns && is_array( $columns ) ) {
			echo 'large-' . $columns[0] . ' small-' . $columns[1] . ' columns';
			return;
		}
		// if just a number is passed to the function
		elseif ( $columns ) {
			echo 'large-' . $columns . ' small-12 columns';
			return;
		}
		
		// if args or nothing is passed to the function	
		$defaults = array(
			'large'          => '',
			'small'          => '',
			'push'           => '',
			'pull'           => '',
			'large_offset'   => '',
			'small_offset'   => '',
			'large_centered' => false,
			'small_centered' => false,
			'is_sidebar'     => false,
			'sidebar_id'     => '',
			'class'          => '',
			'echo'           => true,
		 );
		$args = wp_parse_args( $args, $defaults );
		
		// get the page layout if it is not passed to the function
		$layout = ( !isset( $layout ) ) ? reactor_get_layout() : $layout;
		
		// 12 is the default number of columns in the Foundation grid
		$t_columns = apply_filters( 'reactor_columns', 12 );
		
		// check if tumblog icons are used in blog
		$tumblog = reactor_option('tumblog_icons', false);
		
		// create an array of classes from args
		$classes = array();
		$classes[] = ( $args['small'] ) ? 'small-' . $args['small'] : 'small-12';
		$classes[] = ( $args['push'] ) ? 'push-' . $args['push'] : '';
		$classes[] = ( $args['pull'] ) ? 'pull-' . $args['pull'] : '';
		$classes[] = ( $args['large_offset'] ) ? 'large-offset-' . $args['large_offset'] : '';
		$classes[] = ( $args['small_offset'] ) ? 'small-offset-' . $args['small_offset'] : '';
		$classes[] = ( $args['large_centered'] ) ? 'large-centered' : '';
		$classes[] = ( $args['small_centered'] ) ? 'small-centered' : '';
		$classes[] = ( $args['class'] ) ? $args['class'] : '';
		
		// some simple math to break up the grid
		$one_sixth_cols = $t_columns / 6; // two
		$one_fourth_cols = $t_columns / 4; // three
		$one_third_cols = $t_columns / 3; // four
		$one_half_cols = $t_columns / 2; // six
		$two_thirds_cols = ( $t_columns / 3 ) * 2; // eight
		$three_fourths_cols = ( $t_columns / 4 ) * 3; // nine
		$five_sixths_cols = ( $t_columns / 6 ) * 5; // ten
		
		// if specific number of columns are set for large
		if ( $args['large'] ) {
			$classes[] = 'large-' . $args['large'];
		}
		
		// else check if columns are for a sidebar
		elseif ( $args['is_sidebar'] ) {

			// sidebar columns based on layout
			switch ( $layout ) {
				case '0side-cm': 
					$classes[] = '';
					break;
				case 'side-menu':
					if ( 'accordion' == reactor_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-' . $one_fourth_cols;
					} elseif ( 'side_nav' == reactor_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-' . $one_sixth_cols;
					}
					break;
				case '2side-cl':
				case '2side-cr':
				case '2side-cm':
					$classes[] = 'large-' . $one_fourth_cols;
					break;
				default:
					// 4 is the default number of columns for 1 sidebar
					$classes[] = 'large-' . $one_third_cols;
			}
			
			// pull the content above left sidebar on small screens
			if ( '2side-cr' == $layout ) {
				$classes[] = 'pull-' . $one_half_cols;
			}
			elseif ( '2side-cm' == $layout && 1 == $args['sidebar_id'] ) {
				$classes[] = 'pull-' . $one_half_cols;
			}
			elseif ( '1side-cr' == $layout ) {
				$classes[] = 'pull-' . $two_thirds_cols;
			}

		// else apply columns based on page template layout
		} else {

			// number of columns for main content based on layout		
			switch ( $layout ) {
				case '0side-cm':
					// subtract 1 and offset by 1 if using tumblog icons
					if ( $tumblog && is_home() ) {
						$tumblog_cols = $t_columns - 1;
						$classes[] = 'large-' . $tumblog_cols;
						$classes[] = 'large-offset-1';
					} else {
						$classes[] = 'large-' . $t_columns;
					}
					break;
				case 'side-menu':
					if ( 'accordion' == reactor_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-' . $three_fourths_cols;
					} elseif ( 'side_nav' == reactor_option('side_nav_type', 'accordion') ) {
						$classes[] = 'large-' . $five_sixths_cols;
					}
					break;
				case '2side-cl':
				case '2side-cr':
				case '2side-cm':
					// subtract 1 and offset by 1 if using tumblog icons
					if ( $tumblog && is_home() ) {
						$tumblog_cols = $one_half_cols - 1;
						$classes[] = 'large-' . $tumblog_cols;
						$classes[] = 'large-offset-1';
					} else {
						$classes[] = 'large-' . $one_half_cols;
					}
					break;
				default:
					/* 8 is the default number of columns for a page with 1 sidebar
					subtract 1 and offset by 1 if using tumblog icons */
					if ( $tumblog && is_home() ) {
						$tumblog_cols = $two_thirds_cols - 1;
						$classes[] = 'large-' . $tumblog_cols;
						$classes[] = 'large-offset-1';
					} else {
						$classes[] = 'large-' . $two_thirds_cols;
					}
			}
			
			// push columns for left sidebars	
			switch ( $layout ) {
				case '2side-cr':
					$classes[] = 'push-' . $one_half_cols;
					break;
				case '2side-cm':
					$classes[] = 'push-' . $one_fourth_cols;
					break;
				case '1side-cr':
					$classes[] = 'push-' . $one_third_cols;
					break;
			}
		}
		
		$classes[] = 'columns';
		
		// remove empty values
		$classes = array_filter( $classes );
		
		// add spaces
		$columns = implode( ' ', array_map( 'esc_attr', $classes ) );
		
		do_action('reactor_columns', $columns, $args, $layout);
		
		// echo classes unless args false
		if ( false == $args['echo'] ) {
			return apply_filters('reactor_content_cols', $columns, $args, $layout);
		} else {
			echo apply_filters('reactor_content_cols', $columns, $args, $layout);
		}
	}
}