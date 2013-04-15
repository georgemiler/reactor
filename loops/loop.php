<?php
/**
 * The main loop for displaying posts
 *
 * @package Reactor
 * @subpackage loops
 * @since 1.0.0
 */
?>

<?php /* get the options
excludes the frontpage category from the blog */
$exclude = ( reactor_option('frontpage_exclude_cat', 1) ) ? -reactor_option('frontpage_post_category', '') : ''; ?>

	<?php // start the loop
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array( 
		'post_type' => 'post',
		'cat'       => $exclude,
		'paged'     => $paged ); 
	
	global $wp_query;
	$wp_query = new WP_Query( $args ); ?>

	<?php if ( $wp_query->have_posts() ) : ?>
                        
        <?php reactor_loop_before(); ?>
                        
        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); global $more; $more = 0; ?>
    
            <?php reactor_post_before(); ?>
                            
            <?php // get post format and display template for that format
            if ( !get_post_format() ) : get_template_part('post-formats/format', 'standard');
            else : get_template_part('post-formats/format', get_post_format()); endif; ?>
                            
            <?php reactor_post_after(); ?>
                            
        <?php endwhile; // end of the loop ?>
                        
        <?php reactor_loop_after(); ?>
                        
        <?php // if no posts are found
        else : reactor_loop_else(); ?>
    
    <?php endif; // end have_posts() check ?> 