<?php

/*******************************************/
class STSocialsConnect extends WP_Widget {


    /** constructor -- name this the same as the class above */
   
    
    public function __construct() {
		// widget actual processes
         $this->cacheFileName = dirname(__FILE__)."/STSocialsConnect_cache.txt";
        parent::__construct('STSocialsConnect',__('ST Socials Connect'),  array('description' => __('Social Counter Widget','magazon')));
       
	}

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $facebook_id	= $instance['facebook_id'];
        $twitter_id	= $instance['twitter_id'];
        $feedburner_id = $instance['feedburner_id'];
       // $cacheFileName = $this->cacheFileName;
        $rss = esc_attr($instance['rss']);
       
        if(trim($title)==''){
            $title = sprintf(__('Keep Update With %s',get_bloginfo('name')),'magazon');
        }
        
        echo $before_widget;
         ?>
        <div class="connect-widget-wrapper">
                <h3 class="connect-widget-title"><?php echo  esc_html($title); ?></h3>
                <div class="connect-widget-form">
                    <p><?php  echo esc_html($instance['text']); ?></p>
                    <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="_blank" >
                     <?php
                      $email_txt = __('Your Email Address...','magazon');
                      $email_holder = json_encode($email_txt); 
                      ?>
                    <input type="text" class="subs_input" name="email" value="<?php echo $email_txt; ?>" onfocus="if (this.value == '<?php echo $email_txt; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $email_txt; ?>';}">
                    <input type="hidden" value="<?php echo esc_attr($feedburner_id); ?>" name="uri"/>
                    <input type="hidden" name="loc" value="en_US"/>
                    <input type="submit" value="<?php _e('Subscribe','magazon'); ?>" class="subs_submit">
                  
                   </form>
                    
                </div>
                <div class="connect-widget-social">
                    <a class="connect-rss" href="<?php  echo $rss; ?>"><strong><?php _e('RSS','magazon'); ?></strong><?php _e('Subscribe','magazon'); ?></a>
                     <?php if($twitter_id) { ?>
                    <a class="connect-twitter" twitter-id="<?php echo $twitter_id; ?>" one-text="<?php _e('Follower','magazon'); ?>" plural-text="<?php _e('Followers','magazon'); ?>" href="<?php echo 'https://twitter.com/'.$twitter_id; ?>">
                        <strong class="num"></strong>
                        <span class="txt"></span>
                    </a>
                    <?php } ?>
                    <?php if($facebook_id) { ?>
                    <a class="connect-facebook last" facebook-id="<?php echo $facebook_id; ?>" one-text="<?php _e('Like','magazon'); ?>" plural-text="<?php _e('Likes','magazon'); ?>" href="<?php echo 'https://www.facebook.com/'.$facebook_id; ?>">
                        <strong class="num"></strong>
                        <span class="txt"></span>
                    </a>
                    <?php } ?>
                    
                </div>
            </div>
        <?php
        echo $after_widget; 
        
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
        @unlink($this->cacheFileName);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
        $instance['facebook_id'] = strip_tags($new_instance['facebook_id']);
        $instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);
        $instance['text'] = $new_instance['text'];
        $instance['rss'] = $new_instance['rss'];
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {

        $title 		 = esc_attr($instance['title']);
        $twitter_id  = esc_attr($instance['twitter_id']);
        $facebook_id = esc_attr($instance['facebook_id']);
        $feedburner_id = esc_attr($instance['feedburner_id']);
        $custom_txt = esc_attr($instance['text']);
        $rss = esc_attr($instance['rss']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','magazon'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID:','magazon'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>" />
          <br /><span class="description"><?php _e('Example: <strong>smooththemes</strong>','magazon'); ?></span>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Facebook page URL:','magazon'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" type="text" value="<?php echo $facebook_id; ?>" />
          <br /><span class="description"><?php _e('Example: <strong>smooththemes</strong>','magazon'); ?></span>
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Feedburner URLI:' ,'magazon'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" />
            <br /><span class="description"><?php _e('Example: <strong>smooththemes</strong>','magazon'); ?></span>
        </p>
        
        <p>
          <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS URL:' ,'magazon'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" />
           
        </p>
        
         <p>
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:' ,'magazon'); ?></label><br />
          <textarea rows="7" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" ><?php echo $custom_txt; ?></textarea>
            <br /><span class="description"><?php _e('Example: <strong>smooththemes</strong>','magazon'); ?></span>
        </p>
        
        
        
        <?php
    }


} // end class example_widget


register_widget( 'STSocialsConnect' );
