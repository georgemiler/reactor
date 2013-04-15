<?php
/**
 * Template Name: Side Menu
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div id="primary" class="site-content">
    
    	<?php reactor_content_before(); ?>
    
        <div id="content" role="main">
        	<div class="row">
            	
                <div id="side-menu" class="<?php reactor_columns( '', array( 'is_sidebar'=>true ) ); ?>">
                	<?php if ( has_nav_menu('side-menu') ) : ?>
                    
						<?php // if accordion style then wrap with data-section div
						if ( 'accordion' == reactor_option('side_nav_type', 'accordion') ) : ?>
                        <div class="section-container accordion" data-section="accordion">
                        
                            <?php reactor_side_menu(); ?>
                        
                        </div><!-- .section-container -->
                        <?php // else just output the side nav menu
						else : reactor_side_menu(); ?>
                        
                    	<?php endif; ?>
                    <?php endif; ?> 
				</div><!-- #side-menu -->      
            
                <div class="<?php reactor_columns(); ?>">
                
                <?php reactor_inner_content_before(); ?>
                
					<?php // get the page loop
                    get_template_part('loops/loop', 'page'); ?>
                    
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
               
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>