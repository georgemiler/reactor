<?php
/**
 * Reactor Init
 * Include all the necessary files for Reactor Theme
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @copyright Copyright (c) 2013, Anthony Wilhelm
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( !function_exists('reactor_init') ) {
	function reactor_init() {
		
		// function to get options
		require_once locate_template('/library/inc/functions/get-options.php');
		
		// extensions of WordPress
		require_once locate_template('/library/inc/extensions/theme-support.php');
		require_once locate_template('/library/inc/extensions/scripts-styles.php');
		require_once locate_template('/library/inc/extensions/walkers.php');
		require_once locate_template('/library/inc/extensions/menus.php');
		require_once locate_template('/library/inc/extensions/post-types.php');
		require_once locate_template('/library/inc/extensions/sidebars.php');
		require_once locate_template('/library/inc/extensions/comments.php');
		require_once locate_template('/library/inc/extensions/hooks.php');
		
		// hooked content
		require_once locate_template('/library/inc/extensions/content/content-header.php');
		require_once locate_template('/library/inc/extensions/content/content-footer.php');
		require_once locate_template('/library/inc/extensions/content/content-posts.php');
		require_once locate_template('/library/inc/extensions/content/content-pages.php');
		
		// additional functions
		require_once locate_template('/library/inc/customizer/customizer-init.php');
		require_once locate_template('/library/inc/metaboxes/meta-init.php');
		require_once locate_template('/library/inc/shortcodes/reactor-shortcodes.php');
		require_once locate_template('/library/inc/translation/language.php');
		
		// functions for Reactor
		require_once locate_template('/library/inc/functions/breadcrumbs.php');
		require_once locate_template('/library/inc/functions/columns.php');
		require_once locate_template('/library/inc/functions/custom-login.php');
		require_once locate_template('/library/inc/functions/helpers.php');
		require_once locate_template('/library/inc/functions/page-links.php');
		require_once locate_template('/library/inc/functions/post-meta.php');
		require_once locate_template('/library/inc/functions/slider.php');
		require_once locate_template('/library/inc/functions/taxonomy-subnav.php');
		require_once locate_template('/library/inc/functions/top-bar.php');
		require_once locate_template('/library/inc/functions/tumblog-icons.php');
		
	}
}
/* do this at default prioriiy 10
after_setup_theme priority 10-12 are used for Reactor
all additional actions should be after priority 15 */
add_action('after_setup_theme', 'reactor_init', 10);