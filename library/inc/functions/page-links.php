<?php
/**
 * Reactor Pageinate Links
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @param $args Optional. Override defaults.
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( !function_exists('reactor_page_links') ) {
	function reactor_page_links( $args = '' ) {
		do_action('reactor_page_links', $args);
		
		$defaults = array( 
			'query' => 'wp_query',
			'type'  => 'numbered',
		 );
		$args = wp_parse_args( $args, $defaults );

		global ${$args['query']}; $output = '';
		$the_query = ( isset( $args['query'] ) ) ? ${$args['query']} : $wp_query;
		
		/**
		 * Previous Next Links
		 *
		 * @since 1.0.0
		 */
		if ( 'prev_next' == $args['type'] ) {
				
			if ( $the_query->max_num_pages > 1 ) {
				$output .= '<nav class="content-nav" role="navigation">' . "\n";
				$output .= "\t".'<div class="content-nav-prev alignleft">' . get_next_posts_link('<span class="meta-nav meta-nav-next">&larr; ' . __('Older posts', 'reactor') . '</span>', $the_query->max_num_pages) . '</div>';
				$output .= "\t".'<div class="content-nav-next alignright">' . get_previous_posts_link('<span class="meta-nav meta-nav-prev">'. __('Newer posts', 'reactor') . ' &rarr;</span>', $the_query->max_num_pages) . '</div>';
				$output .= "\n" . '</nav><!-- .content-nav -->';
			}
			
		} else {
			
		/**
		 * Numbered Pagination
		 *
		 * @link http://codex.wordpress.org/Function_Reference/paginate_links
		 * @see paginate_links
		 * @since 1.0.0
		 */			
			$big = 999999999; // need an unlikely integer
			$count = 0;
			$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
			$total = $the_query->max_num_pages;
			$current = max( 1, get_query_var('paged') );
			
			$args = array(
				'base'         => $base,
				'format'       => '?page=%#%',
				'total'        => $total,
				'current'      => $current,
				'show_all'     => false,
				'end_size'     => 1,
				'mid_size'     => 2,
				'prev_next'    => true,
				'prev_text'    => __('&laquo; Prev', 'reactor'),
				'next_text'    => __('Next &raquo;', 'reactor'),
				'type'         => 'array',
				'add_args'     => false,
				'add_fragment' => ''
			);
			$links = paginate_links( $args );
			
			if ( $links ) {
				$output .= '<ul class="pagination">';
				if ( $current > 1 ) { $current = $current + 1; } // + 1 for previous link in count
				foreach ( $links as $link ) {
					$count++;
					$link = str_replace('<span', '<a', $link); // Foundation doesn't use span
					$link = str_replace('</span>', '</a>', $link); // Foundation doesn't use span
					$output .= ( $count == $current ) ?	'<li class="current">' : '<li>';
					$output .= $link . '</li>';
				}
				$output .= '</ul>';
			}
		}
	
	echo apply_filters( 'reactor_paginate_links', $output );	
	} 	
}