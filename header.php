<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if(st_get_setting('page_rtl') == 'y'){ echo 'dir="rtl"'; } ?> <?php if($_REQUEST['rtl'] == 'true') { echo 'dir="rtl"'; } ?>>
<head>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <!-- Mobile Specific ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />

    <!-- Title Tag ======================================================== -->
    <title><?php st_title(); ?></title>

    <!-- Browser Specical Files =========================================== -->
    <!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->  
    <!--[if lt IE 9]> <link rel='stylesheet' id=''  href='<?php echo ST_THEME_URL; ?>ie8.css' type='text/css' media='all' /><![endif]--> 

    <!-- Site Favicon ===================================================== -->
    <?php echo st_favicon(); ?>
    <?php
     $defaults = array('theme_location'  => 'Primary_Navigation','container'=> false,'menu_class'=> 'menu','menu_id'=> '','echo' => false);
     if(class_exists('ST_Walker_Nav_Menu')){$defaults['walker'] =  new  ST_Walker_Nav_Menu();}
     $primary_nav =  wp_nav_menu( $defaults );
    ?>

    <!-- WP HEAD ========================================================== -->
    <?php wp_head(); ?>
</head>
<?php // <!-- Begin Body ======================================================= --> ?>
<body <?php body_class(); ?>>
    <div class="body-outer-wrapper">
        <div class="body-wrapper <?php echo st_boxed_full(); ?>">
            <div class="header-outer-wrapper b30">
                <div class="top-nav-outer-wrapper">
                    <div class="top-nav-wrapper container">
                        <div class="row">
                            <a href="#" id="top-nav-mobile" class="top-nav-close">
                                <span></span>
                            </a>
                            <div class="top-nav-left">
                                <nav id="top-nav-id" class="top-nav slideMenu">
                                    <?php
                                        $defaults = array(
                                            	'theme_location'  => 'Top_Menu',
                                            	'container'       => false,
                                            	'menu_class'      => 'menu',
                                            	'echo'            => true
                                             );
                                        wp_nav_menu( $defaults );
                                        ?>
                                </nav>
                            </div>                            
                            <div class="top-nav-right text-right right">
                               

                                <div class="search-block right">
                                    <form action="<?php echo home_url(); ?>" method="get" id="searchform">
                                        <input id="s" onblur="if (this.value == '') {this.value = '<?php  echo esc_attr(__('SEARCH...','magazon')); ?>';}" onfocus="if (this.value == '<?php  echo esc_attr(__('SEARCH...','magazon')); ?>') {this.value = '';}" value="<?php  echo esc_attr(__('SEARCH...','magazon')); ?>" name="s" type="text">
                                        <input class="search-submit" value="<?php echo esc_html(__('Search','magazon')) ?>" type="submit">
                                    </form>
                                </div>
                                 <div class="social-block right">
                                    <ul>
                                        <?php if(st_get_setting("facebook")): ?>
                                        <li><a class="icon-facebook" href="<?php echo esc_attr(st_get_setting("facebook")); ?>" title="<?php _e('Facebook','magazon'); ?>"></a></li>
                                        <?php endif; ?>
                                        <?php if(st_get_setting("google_plus")): ?>
                                        <li><a class="icon-google-plus" href="<?php echo esc_attr(st_get_setting("google_plus")); ?>" title="<?php _e('Google Plus','magazon'); ?>"></a></li>
                                         <?php endif; ?>
                                         <?php if(st_get_setting("twitter")): ?>
                                        <li><a class="icon-twitter" href="<?php echo esc_attr(st_get_setting("twitter")); ?>" title="<?php _e('Twitter','magazon'); ?>"></a></li>
                                        <?php endif; ?>
                                         <?php if(st_get_setting("linkedin")): ?>
                                        <li><a class="icon-linkedin" href="<?php echo esc_attr(st_get_setting("linkedin")); ?>" title="<?php _e('Linkedin','magazon'); ?>"></a></li>
                                          <?php endif; ?>
                                          <?php if(st_get_setting("pinterest")): ?>
                                        <li><a class="icon-pinterest" href="<?php echo esc_attr(st_get_setting("pinterest")); ?>" title="<?php _e('Pinterest','magazon'); ?>"></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="clear"></div>
                            
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div> <!-- END .top-nav-outer-wrapper -->
                <div class="logo-outer-wrapper">
                    <div class="logo-wrapper container">
                        <div class="row">
                            <div class="twelve columns">
                                <?php
                                  global $st_options;
                                    $logo_padding_top = $st_options['logo_padding_top'];// st_get_setting('logo_padding_top');
                                    $logo_padding_bottom = $st_options['logo_padding_bottom']; //st_get_setting('logo_padding_bottom');
                                   
                                    $logo_padding_top =($logo_padding_top=='') ? 20 : intval($logo_padding_top);
                                    $logo_padding_bottom =($logo_padding_bottom=='') ? 20 : intval($logo_padding_bottom);
                                   

                                ?>
                                <div class="logo-left" style="padding:<?php echo $logo_padding_top; ?>px 0px <?php echo $logo_padding_bottom; ?>px 0px">
                                    <h1>
                                      <a href="<?php echo home_url(); ?>">
                                      <?php if(st_get_setting("site_logo")): ?>
                                      <img src="<?php echo st_get_setting("site_logo"); ?>" alt="<?php _e('Logo','magazon'); ?>"></a>
                                      <?php else: ?>
                                       <?php bloginfo('name'); ?>
                                      <?php endif; ?>
                                      </a>
                                    </h1>
                                </div>
                                <div class="logo-right-widget right">
                                    <div class="logo-right-ads">
                                        <?php dynamic_sidebar('header_ads'); ?>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div> <!-- END .logo-outer-wrapper -->

                <div class="primary-nav-outer-wrapper">
                    <div class="primary-nav-wrapper container">
                        <div class="row">
                            <div class="twelve columns">
                                <a href="#" id="primary-nav-mobile-a" class="primary-nav-close">
                                    <span></span>
                                    <?php _e('Navigation','magazon'); ?>
                                </a>
                                <nav id="primary-nav-mobile"></nav>

                                <nav id="primary-nav-id" class="primary-nav slideMenu">
                                    <?php
                                       echo  $primary_nav;
                                        ?>
                                    <div class="clear"></div>
                                </nav>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- END .primary-nav-outer-wrapper -->
            </div> <!-- END .header-outer-wrapper-->
