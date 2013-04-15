<?php
/**
 * Register Menus
 * register menus in WordPress
 * creates menu functions for use in theme
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author Eddie Machado (@eddiemachado / themeble.com/bones)
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( !function_exists('reactor_register_menus') ) { 
	function reactor_register_menus() {
		
		/**
		 * Top bar left menu
		 *
		 * @since 1.0.0
		 * @see wp_nav_menu
		 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
		 */
		if ( !function_exists('reactor_top_bar_l') ) { 
			function reactor_top_bar_l() {
				$defaults = array( 
					'theme_location'  => 'top-bar-l',
					'menu'            => '',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'top-bar-menu left',
					'menu_id'         => '',
					'echo'            => 0,
					'fallback_cb'     => false,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => new Top_Bar_Walker()
				 );
				return wp_nav_menu( $defaults );
			}
		}
					
		/**
		 * Top bar right menu
		 *
		 * @since 1.0.0
		 * @see wp_nav_menu
		 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
		 */
		if ( !function_exists('reactor_top_bar_r') ) {
			function reactor_top_bar_r() {
				$defaults = array( 
					'theme_location'  => 'top-bar-r',
					'menu'            => '',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'top-bar-menu right',
					'menu_id'         => '',
					'echo'            => 0,
					'fallback_cb'     => false,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => new Top_Bar_Walker()
				 );
				return wp_nav_menu( $defaults );
			}
		}
			
		/**
		 * Main menu
		 *
		 * @since 1.0.0
		 * @see wp_nav_menu
		 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
		 */
		if ( !function_exists('reactor_main_menu') ) {
			function reactor_main_menu() {
				$defaults = array( 
					'theme_location'  => 'main-menu',
					'menu'            => '',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'nav-bar',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => false,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '%3$s',
					'depth'           => 2,
					'walker'          => new Nav_Bar_Walker()
				 );		
				wp_nav_menu( $defaults );
			}
		}
			
		/**
		 * Side menu
		 *
		 * @since 1.0.0
		 * @see wp_nav_menu
		 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
		 */
		if ( !function_exists('reactor_side_menu') ) {
			function reactor_side_menu() {
				$side_nav_type = reactor_option('side_nav_type', 'accordion');
				$side_nav_walker = new Vertical_Nav_Walker();
				$items_wrap = ( 'side_nav' == $side_nav_type ) ? '<ul id="%1$s" class="%2$s">%3$s</ul>' : '%3$s';
				$walker = ( 'side_nav' == $side_nav_type ) ? '' : $side_nav_walker;
				$depth = ( 'side_nav' == $side_nav_type ) ? 1 : 2;
				
				$defaults = array( 
					'theme_location'  => 'side-menu',
					'menu'            => '',
					'container'       => 'ul',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'side-nav',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => false,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => $items_wrap,
					'depth'           => $depth,
					'walker'          => $walker
				);		
				wp_nav_menu( $defaults );
			}
		}

		/**
		 * Footer menu
		 *
		 * @since 1.0.0
		 * @see wp_nav_menu
		 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
		 */
		if ( !function_exists('reactor_footer_links') ) {
			function reactor_footer_links() { 
				$defaults = array( 
					'theme_location'  => 'footer-links',
					'menu'            => '',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'inline-list',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => false,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 1,
					'walker'          => ''
				 );
				wp_nav_menu( $defaults );
			}
		}
	}

    /**
	 * Register navigation menus for a theme.
	 *
	 * @since 1.0.0
	 * @param array $locations Associative array of menu location identifiers (like a slug) and descriptive text.
	 */
	register_nav_menus(                      
		array( 
			'top-bar-l'    => __('Top Bar Left', 'reactor'),
			'top-bar-r'    => __('Top Bar Right', 'reactor'),
			'main-menu'    => __('Main Menu', 'reactor'),
			'side-menu'    => __('Side Menu', 'reactor'),
			'footer-links' => __('Footer Links', 'reactor')
		)
	);

	add_action('after_setup_theme', 'reactor_register_menus', 12);
}