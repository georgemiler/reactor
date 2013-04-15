<?php
/**
 * The sidebar template containing the front page widget area
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

	<?php // get the front page layout
    $layout = reactor_get_layout(); ?>
    
    <?php // if front page has one sidebar and the sidebar is active
    if ( is_active_sidebar('sidebar-frontpage') && '0side-cm' != $layout ) : ?>
    
    <?php reactor_sidebar_before(); ?>
    
        <div id="sidebar-frontpage" class="sidebar <?php reactor_columns( '', array( 'is_sidebar' => true, 'sidebar_id' => 1 ) ); ?>" role="complementary">
            <?php dynamic_sidebar('sidebar-frontpage'); ?>
        </div><!-- #sidebar-frontpage -->
        
    <?php // else show an alert
    else : if ( '0side-cm' != $layout ) : ?>
    
        <div id="sidebar-frontpage" class="sidebar <?php reactor_columns( '', array( 'is_sidebar' => true, 'sidebar_id' => 1 ) ); ?>" role="complementary">
            <div class="alert-box secondary"><p>Add some widgets to this area!</p></div>
        </div><!-- #sidebar --> 
    
    <?php reactor_sidebar_after(); ?>
    
    <?php endif; endif; ?>
    
    <?php // if front page has two sidebars and second sidear is active
    if ( is_active_sidebar('sidebar-frontpage-2') && ( '2side-cl' == $layout || '2side-cr' == $layout || '2side-cm' == $layout ) ) : ?>
    
    <?php reactor_sidebar_before(); ?>
    
        <div id="sidebar-frontpage-2" class="sidebar <?php reactor_columns( '', array( 'is_sidebar' => true, 'sidebar_id' => 2 ) ); ?>" role="complementary">
            <?php dynamic_sidebar('sidebar-frontpage-2'); ?>
        </div><!-- #sidebar-frontpage-2 -->
        
    <?php // else show an alert
    else : if ( '2side-cl' == $layout || '2side-cr' == $layout || '2side-cm' == $layout ) : ?>
    
        <div id="sidebar-frontpage-2" class="sidebar <?php reactor_columns( '', array( 'is_sidebar' => true, 'sidebar_id' => 2 ) ); ?>" role="complementary">
            <div class="alert-box secondary"><p>Add some widgets to this area!</p></div>
        </div><!-- #sidebar-2 -->
    
    <?php reactor_sidebar_after(); ?>
    
    <?php endif; endif; ?>