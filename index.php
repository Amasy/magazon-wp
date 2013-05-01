<?php 
do_action('st_theme_init');
get_header(); ?>
<div class="main-outer-wrapper mt30">
    <div class="main-wrapper container">
        <div class="row row-wrapper">
            <div class="page-wrapper twelve columns b0">
                <div class="row">
                    <?php
                       $default_layout  =  intval(st_get_setting("layout",3));  
                       if(is_singular()):
                            global $post;
                            $st_page_builder = get_post_meta($post->ID,'st_page_builder',true);
                            $layout = intval($st_page_builder['layout']);
                            if(in_array($layout,array(1,2,3,4))){
                               $default_layout = $layout  ;
                            }    
                        endif;
                        do_action('st_before_layout');
                       // $file  = ST_TEMPLATE_DIR.'/layout/'.st_get_layout($default_layout).'.php';
                      //  include($file);
                       get_template_part('st-framework/templates/layout/'.st_get_layout($default_layout),'');
                        do_action('st_after_layout');
                     ?>

                     <?php $args = array(
                      'before'           => '<p>' . __('Pages:','magazon'),
                      'after'            => '</p>',
                      'link_before'      => '',
                      'link_after'       => '',
                      'next_or_number'   => 'number',
                      'nextpagelink'     => __('Next page','magazon'),
                      'previouspagelink' => __('Previous page','magazon'),
                      'pagelink'         => '%',
                      'echo'             => 1
                    ); ?>
                    <?php wp_link_pages( $args ); ?> 
                 </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div> <!-- END .main-outer-wrapper -->
<?php 
get_footer();