<div class="footer-outer-wrapper">
            <?php if(st_get_setting("show_footer_widget",'y')=='y'): ?>
                <div class="footer-wrapper container">
                    <div class="row">
                    	<div class="three columns">
                        	<?php dynamic_sidebar('footer_1'); ?>
                        </div>
                        <div class="three columns">
                          	<?php dynamic_sidebar('footer_2'); ?>
                        </div>
                        <div class="three columns">
                            <?php dynamic_sidebar('footer_3'); ?>
                        </div>
                        <div class="three columns">
                         <?php dynamic_sidebar('footer_4'); ?>
                        </div>
                        <div class="clear"></div>    
                    </div>
                    <div class="clear"></div>
                </div>
               <?php endif; ?> 
                
                <div class="copyright-outer-wrapper">
                    <div class="copyright-wrapper container">
                        <div class="row clearfix">
                            <div class="copyright-left left b20">
                                <?php if(st_get_setting("show_footer_nav",'y')=='y'): ?>
                            	<nav class="footer-nav">
                            		<?php
                                        $defaults = array(
                                            	'theme_location'  => 'Footer_Menu',
                                            	'container'       => false,
                                            	'menu_class'      => 'menu',
                                            	'echo'            => true
                                             );
                                        wp_nav_menu( $defaults );
                                        ?>
                            	</nav>
                                <?php endif; ?>
                            </div>
                            <?php if(st_get_setting("footer_copyright")!=''): ?>
                            <div class="copyright-right right b20 text-right">
                            	<?php   echo stripslashes(st_get_setting("footer_copyright"));  ?>
                            </div>
                            <?php endif; ?>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

        </div> <!-- END .body-wrapper -->
    </div> <!-- END .body-outer-wrapper -->
    <?php wp_footer(); ?>
</body>
</html>