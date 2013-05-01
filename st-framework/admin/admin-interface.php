<?php 
global $tabs_settings, $pagenow;

$st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE

if(isset($_REQUEST['to_default']) && $_REQUEST['to_default']==1){
    delete_option(ST_SETTINGS_OPTION);
}

if(isset($_POST['save']) && $_POST['save']=='Y'){
    
    if(st_is_wpml()){
        // ICL_LANGUAGE_CODE
       //  echo var_dump($st_default_lang_code,ICL_LANGUAGE_CODE);
          if($st_default_lang_code==ICL_LANGUAGE_CODE || ICL_LANGUAGE_CODE=='' || strpos($st_default_lang_code,ICL_LANGUAGE_CODE)!==false){
            // echo 'tjiss';
                update_option(ST_SETTINGS_OPTION,$_POST[ST_SETTINGS_OPTION]);
          }
          update_option(ST_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE,$_POST[ST_SETTINGS_OPTION]);
          do_action('st_save_options', $_POST[ST_SETTINGS_OPTION]);
        
    }else{
          update_option(ST_SETTINGS_OPTION,$_POST[ST_SETTINGS_OPTION]);
          do_action('st_save_options', $_POST[ST_SETTINGS_OPTION]);
    }
  
}

$values = get_option(ST_SETTINGS_OPTION,array()); 
?>

<?php
 if(st_is_wpml()){ // if WPML installed
     $langs = icl_get_languages('skip_missing=0');
    
     
   // echo var_dump($langs, ICL_LANGUAGE_CODE);
    if($_POST['st_save_lang']=='y'){
        $st_same_settings = $_POST['st_lang_same_settings'];
        if($st_same_settings==''){
            $st_same_settings = 'n';
        }
        
        update_option('st_same_lang_settings',$st_same_settings);
        // copy theme options for each language
        if($_POST['st_lang_copy_from']!='' && $_POST['st_lang_copy_to']!=''){
            $l_from=  $_POST['st_lang_copy_from'];
            $l_to = $_POST['st_lang_copy_to'];
            if($l_from='st_default'){ // copy from default settings
                $l_options  =  get_option(ST_SETTINGS_OPTION,array()) ;
            }else{
                $l_options  =  get_option(ST_SETTINGS_OPTION.'_'.$l_from,array()) ;
            }
            
            update_option(ST_SETTINGS_OPTION.'_'.$l_to,$l_options);
            
            
        }
        
      ?>
        <div class="updated" id="message" style="margin: 30px 0px 0px;width:886px;">
    	   <p><strong><?php echo ST_THEME_NAME; ?><?php echo ' Language settings saved.'; ?></strong></p>
    	</div>
        <?php
    
    }
    
     $st_same_settings = get_option('st_same_lang_settings','y');
    
     $country_flag_url ='';
     ?>
     <form action="" method="post">
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('input#st_lang_same_settings').change(function(){
                    if(jQuery(this).attr('checked')){
                         jQuery('#st_lang_settings_wrap').hide();
                    }else{
                       
                        jQuery('#st_lang_settings_wrap').show();
                    }
                });
            });
        </script>
            <h2><?php echo ST_THEME_NAME.' '; echo 'options languages settings'; ?></h2>
            <label><input type="checkbox" id="st_lang_same_settings" name="st_lang_same_settings" value="y" <?php echo $st_same_settings =='y' ? ' checked = "checked" ' : ''; ?> />  <?php echo 'Keep same settings for all languages'; ?></label>
     
            <div id="st_lang_settings_wrap" class="st_lang_w" <?php  echo $st_same_settings =='y' ? ' style="display: none;" ' : ''; ?>>
     
            <?php _e('Copy options from','magazon'); ?>
            <select name="st_lang_copy_from">
                <option value="">--<?php echo 'Select'; ?>--</option>
                <option value="st_default"><?php echo 'Default'; ?></option>
                <?php  foreach($langs as $l):  
                
                if($country_flag_url==''){
                    $country_flag_url  = ($l['language_code'] == ICL_LANGUAGE_CODE)  ? $l['country_flag_url'] : '';
                 
                }
                 
                ?>
                <option value="<?php echo $l['language_code'] ?>" >   <?php echo esc_html($l['native_name']); ?> </option>
                <?php endforeach; ?>
            </select>
            
            <?php _e('To','magazon'); ?>
            <select name="st_lang_copy_to">
                <option value="">--<?php echo 'Select'; ?>--</option>
                <?php  foreach($langs as $l):  ?>
                <option value="<?php echo $l['language_code'] ?>" >   <?php echo esc_html($l['native_name']); ?> </option>
                <?php endforeach; ?>
            </select>
            
            
            </div>
            <br />
            <input type="submit" class="button-primary" value="<?php _e('Save changes','magazon'); ?>" />
            <input type="hidden" name="st_save_lang" value="y" />
     </form>
     
     <!--  For options settings  -->
     <?php if(defined('ICL_LANGUAGE_NAME')){ ?>
     <br />
     <h2><?php echo ST_THEME_NAME.' '.__('Options for','magazon').' '.(ICL_LANGUAGE_NAME!='' ?  ( $country_flag_url!='' ? '<img src="'.$country_flag_url.'" /> ' : '').ICL_LANGUAGE_NAME  :  __('All languages','magazon')) ; ?></h2>
     <?php
     }
     
     // reload  options for current language
     if($st_same_settings=='y'){
        $values = get_option(ST_SETTINGS_OPTION,array()); 
     }else{
        // ICL_LANGUAGE_CODE
        $values = get_option(ST_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE,array()); 
        if(empty($values)){
             $values = get_option(ST_SETTINGS_OPTION,array());  // default value
        }
     }
     
     
     
 } // end if WPML installed
 

 ?>


<form action="admin.php?page=<?php echo $_REQUEST['page']; ?>" method="post"  enctype="multipart/form-data" >
    
    <?php if(defined('ICL_LANGUAGE_CODE')): ?>
    
    <?php endif; ?>
    
    
    <input type="hidden" name="save" value="Y"/>

    <?php if(isset($_POST['save']) && $_POST['save'] == 'Y'): ?>
    <div class="updated" id="message" style="margin: 30px 0px 0px;width:886px;">
	   <p><strong><?php echo 'magazon'; ?> theme options updated.</strong></p>
	</div>
    <?php endif; ?>
    
    
    <?php if(isset($_REQUEST['to_default']) && $_REQUEST['to_default'] == 1): ?>
        <div class="updated" id="message" style="margin: 30px 0px 0px;width:886px;">
	   <p><strong><?php echo 'magazon'; ?> <?php _e('theme options has been RESET.','magazon'); ?></strong></p>
	</div>
    <?php endif; ?>
    
    <div class="STpanel-wrap">
        <div class="STpanel-header">
            <div class="STpanel-h-info">
                <div id="st_logo">
                    <img src="<?php echo ST_URL.'/admin/images/logo.png' ?>" alt="" title="SmoothThemes Framework" />
                </div>
                <div id="st_version">
                    <p class="theme_version"><?php echo ST_THEME_NAME.' '; echo ST_VERSION;  ?></p>
                    <p class="framework_version"><?php echo __('ST Framework','magazon').' '; echo get_option('st_framework_version'); ?></p>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="STpanel-h-action">
                <a href="#">Changelog</a>
                <a href="#">Documents</a>
                <a href="#">Support Forum</a>
            </div>
        </div><!-- STpanel-header -->
        
        
        <div class="STpanel-main">
            <div class="STpanel-tabs">
                <div id="adminmenushadow"></div>
                <ul class="STpanel-click-tabs">
                    <?php foreach($tabs_settings->tabs as $tab): 
                    
                    if($tab['had_parent']==1){
                        continue;
                    }
                    
                    if(count($tab['child'])){
                        $class ='parent';
                    }else{
                        $class ='no-child';
                    }
                    
                    ?>
                    <li class="<?php echo $class; ?> tab-<?php echo esc_attr($tab['tab_id']); ?>">
                   
                       <a href="#<?php echo esc_attr($tab['tab_id']); ?>">
                       <?php if($tab['icon']!=''): ?>
                       <i class="<?php echo $tab['icon']; ?>"></i>
                        <?php endif; ?>
                        <?php echo htmlspecialchars($tab['tab_name']); ?></a>
                        
                        <?php if(count($tab['child'])): ?>
                            <ul class="child">
                          <?php foreach($tab['child'] as $ct): ?>
                          
                                <li class="tab-<?php echo esc_attr($ct['tab_id']); ?>">
                                    <a href="#<?php echo esc_attr($ct['tab_id']); ?>" parent="<?php  echo esc_attr($tab['tab_id']); ?>">
                                    <?php if($ct['icon']!=''): ?>
                                    <i class="<?php echo $ct['icon']; ?>"></i>
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($ct['tab_name']); ?></a>
                                </li>
                          
                          <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div id="save_sidebar">
                    <input type="submit" class="button-primary" value="<?php _e('Save All Changes','magazon'); ?>" />
                </div>
            </div><!-- STpanel-tabs -->
            <div class="STpanel-content">
            
            <?php
            $tab_display = new admin_tabs_display($values);
            foreach($tabs_settings->tabs as $tab):
            ?>
            <div id="<?php echo $tab['tab_id']; ?>" class="STpanel-tab">
                <?php  $tab_display->display_tab_contents($tab['fields']); ?>
            </div>
            <?php endforeach; // end foreach tab ?>
            </div><!-- STpanel-content-->
            <div class="clear"></div>
        </div><!-- STpanel-main -->
        
        <div id="STpanel-footer">
            <a href="admin.php?page=<?php echo $_REQUEST['page']; ?>&to_default=1" class="button-secondary">Reset To Defaut</a>
            <input type="submit" class="button-primary" value="<?php _e('Save Changes','magazon'); ?>" />
        </div><!-- STpanel-footer -->
    </div><!-- STpanel-wrap -->
</form>