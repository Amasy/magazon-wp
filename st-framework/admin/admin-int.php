<?php

#-------------------------------------------------------------
# Smooth Theme Framework Version
#-------------------------------------------------------------
function st_framework_version_init(){
    $st_framework_version = '1.0';
    if(get_option('st_framework_version_init') != $st_framework_version){
        update_option('st_framework_version',$st_framework_version);
    }
}
add_action('init','st_framework_version_init',10);


#-------------------------------------------------------------
# Define Admin Path and URL
#-------------------------------------------------------------
define('ST_ADMIN_PATH',dirname(__FILE__));
define('ST_ADMIN_URL',ST_URL.'admin');


#-------------------------------------------------------------
# Load the required Framework Files 
#-------------------------------------------------------------

// kiểm tra tính hợp lệ của ajax
$current_user = wp_get_current_user(); 
$ajax_nonce = wp_create_nonce($current_user->ID);
//check_ajax_referer( $current_user->ID, 'ajax_nonce' );

if(is_admin()){
    
    // for media 
    function st_image_attachment_fields_to_edit($form_fields, $post){
            $form_fields["st_custom"]["label"] = __('','magazon');  
            $form_fields["st_custom"]["input"] = "html";  
            
            $image_attributes = wp_get_attachment_image_src( $post->ID ,'medium' ); // returns an array
            
            $form_fields["st_custom"]["html"] = '
            
            <a href="#"  class="st_attach_btn" data-src = "'.$image_attributes[0].'"   post_id ="'.$post->ID.'">'.__('User this image' ,'magazon').'</a>
            ';
            return $form_fields;  
    }
    
    add_filter("attachment_fields_to_edit", "st_image_attachment_fields_to_edit", null, 99);

     include(ST_ADMIN_PATH.'/editor/editor.php');
     
    include(ST_ADMIN_PATH.'/admin-users.php');
    include(ST_ADMIN_PATH.'/admin-functions.php');
    include(ST_ADMIN_PATH.'/admin-menu.php');
    include(ST_ADMIN_PATH.'/admin-scripts.php');
    include(ST_ADMIN_PATH.'/ajax-media.php');

    if(file_exists(ST_ADMIN_PATH.'/page-builder/page-builder.php')){
         include(ST_ADMIN_PATH.'/page-builder/page-builder.php');
    }
    
    if(file_exists(ST_ADMIN_PATH.'/review-control/review.php')){
         include(ST_ADMIN_PATH.'/review-control/review.php');
    }
  
    include(ST_ADMIN_PATH.'/admin-meta-box.php');
    include(ST_DIR.'/settings/meta-box-settings.php');
    include(ST_ADMIN_PATH.'/admin-post-type.php');
    
     include(ST_ADMIN_PATH.'/admin-nav-custom.php');
     include(ST_ADMIN_PATH.'/admin-tax.php');
   
}





