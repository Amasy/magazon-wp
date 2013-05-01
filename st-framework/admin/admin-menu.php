<?php

add_action('admin_menu','st_add_admin_menu');

function st_add_admin_menu(){
    $icon = ST_ADMIN_URL . '/images/st_icon.png';
     add_theme_page(ST_PAGE_TITLE,ST_MENU_TITLE,'manage_options',ST_PAGE_SLUG,'st_admin_display','',61);
}

  // Function callback for add_menu_page
  function st_admin_display(){
   
    include(ST_ADMIN_PATH.'/admin-interface.php');
    
  }
  
  function st_sidebar_display(){
   
  }
  
  function st_install(){
   
  }