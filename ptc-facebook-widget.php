<?php
/*
Plugin Name: PTC Facebook Widget
Plugin URI: https://wordpress.org/plugins/ptc-facebook-widget/
Description: The PTC Facebook Widget is a great addition to your website to display Facebook Feeds on your website. It allows visitors to your page access your Facebook news feed, photos, videos, posts and more, all without ever leaving your website. The PTC Facebook Widget is available on the Wordpress platform and works with all versions.
Version: 1.0

Author: vivan jakes 

Author URI: https://wordpress.org/support/profile/personaltrainercertification
*/
class ptcfbwgt_pageSlider{
    
    public $options;
    
    public function __construct() {
        $this->options = get_option('ptcfbwgt_page_plugin_slider_option');
        $this->ptcfbwgt_page_slider_register_settings_all_fields();
    }
		
		public static function add_fb_page_slider_tools_options_pages(){
			add_options_page('PTC Facebook Widget', 'PTC Facebook Widget ', 'administrator', __FILE__, array('ptcfbwgt_pageSlider','ptcfbwgt_page_slider_tools_option'));
		}
		
   		 public static function ptcfbwgt_page_slider_tools_option(){
?>
        <div class="wrap">
            <h2>PTC Facebook Widget Settings</h2>
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php settings_fields('ptcfbwgt_page_plugin_slider_option'); ?>
                <?php do_settings_sections(__FILE__); ?>
                <p class="submit">
                    <input name="submit" type="submit" class="button-primary" value="Save Changes"/>
                </p>
            </form>
        </div>
	<?php
        }
        public function ptcfbwgt_page_slider_register_settings_all_fields(){
            register_setting('ptcfbwgt_page_plugin_slider_option', 'ptcfbwgt_page_plugin_slider_option',array($this,'ptcfbwgt_page_validation_settings'));
            add_settings_section('ptcfbwgt_page_full_section', 'Settings', array($this,'ptcfbwgt_page_full_section'), __FILE__);
            //Start Creating Fields and Options
            //pageURL
            add_settings_field('pageURL', 'Facebook Page URL', array($this,'pageURL_option'), __FILE__,'ptcfbwgt_page_full_section');
            //marginTop
            add_settings_field('marginTop', 'Margin Top', array($this,'marginTop_option'), __FILE__,'ptcfbwgt_page_full_section');
            
            //width
            add_settings_field('width', 'Slider Width', array($this,'width_option'), __FILE__,'ptcfbwgt_page_full_section');
            //height
            add_settings_field('height', 'Slider Height', array($this,'height_option'), __FILE__,'ptcfbwgt_page_full_section');
            
            //posts_option
            add_settings_field('posts', 'Display Posts', array($this,'posts_option'),__FILE__,'ptcfbwgt_page_full_section');
            //hide_cover_option options
            add_settings_field('hide_cover', 'Hide cover Image', array($this,'hide_cover_option'),__FILE__,'ptcfbwgt_page_full_section');
         
             //show_faces options
            add_settings_field('show_faces', 'Show Faces', array($this,'show_faces_option'),__FILE__,'ptcfbwgt_page_full_section');
            //alignment option
             add_settings_field('alignment', 'Slider Position', array($this,'position_option'),__FILE__,'ptcfbwgt_page_full_section');
            //jQuery options
            
        }
        public function ptcfbwgt_page_validation_settings($plugin_options){
            return($plugin_options);
        }
        public function ptcfbwgt_page_full_section(){
            //optional
        }
       
        //pageURL_option
        public function pageURL_option() {
            if(empty($this->options['pageURL'])) $this->options['pageURL'] = "https://www.facebook.com/facebook";
            echo "<input name='ptcfbwgt_page_plugin_slider_option[pageURL]' type='text' value='{$this->options['pageURL']}' />";
        }
         //marginTop_option
        public function marginTop_option() {
            if(empty($this->options['marginTop'])) $this->options['marginTop'] = "110";
            echo "<input name='ptcfbwgt_page_plugin_slider_option[marginTop]' type='text' value='{$this->options['marginTop']}' />";
        }
            //alignment_settings
        public function position_option(){
            if(empty($this->options['alignment'])) $this->options['alignment'] = "left";
            $items = array('left','right');
            echo "<select name='ptcfbwgt_page_plugin_slider_option[alignment]'>";
            foreach($items as $item){
                $selected = ($this->options['alignment'] === $item) ? 'selected = "selected"' : '';
                echo "<option value='$item' $selected>$item</option>";
            }
            echo "</select>";
        }
      
        //width_option
        public function width_option() {
            if(empty($this->options['width'])) $this->options['width'] = "290";
            echo "<input name='ptcfbwgt_page_plugin_slider_option[width]' type='text' value='{$this->options['width']}' />";
        }
        //height_option
        public function height_option() {
            if(empty($this->options['height'])) $this->options['height'] = "390";
            echo "<input name='ptcfbwgt_page_plugin_slider_option[height]' type='text' value='{$this->options['height']}' />";
        }
        //show_faces_option
        public function show_faces_option(){
            if(empty($this->options['show_faces'])) $this->options['show_faces'] = "true";
            $items = array('true','false');
            echo "<select name='ptcfbwgt_page_plugin_slider_option[show_faces]'>";
            foreach($items as $item){
                $selected = ($this->options['show_faces'] === $item) ? 'selected = "selected"' : '';
                echo "<option value='$item' $selected>$item</option>";
            }
            echo "</select>";
        }
        //posts_option
        public function posts_option(){
            if(empty($this->options['posts'])) $this->options['posts'] = "true";
            $items = array('true','false');
            echo "<select name='ptcfbwgt_page_plugin_slider_option[posts]'>";
            foreach($items as $item){
                $selected = ($this->options['posts'] === $item) ? 'selected = "selected"' : '';
                echo "<option value='$item' $selected>$item</option>";
            }
            echo "</select>";
        }
       
        //hide_cover_option
        public function hide_cover_option(){
            if(empty($this->options['hide_cover'])) $this->options['hide_cover'] = "false";
            $items = array('false','true');
            echo "<select name='ptcfbwgt_page_plugin_slider_option[hide_cover]'>";
            foreach($items as $item){
                $selected = ($this->options['hide_cover'] === $item) ? 'selected = "selected"' : '';
                echo "<option value='$item' $selected>$item</option>";
            }
            echo "</select>";
        }
        
       
    
        
        // put jQuery settings before here
    }
    add_action('admin_menu', 'ptcfbwgt_page_slider_trigger_options_function');
    
    function ptcfbwgt_page_slider_trigger_options_function(){
        ptcfbwgt_pageSlider::add_fb_page_slider_tools_options_pages();
    }
    
    add_action('admin_init','ptcfbwgt_page_slider_trigger_create_object');
    function ptcfbwgt_page_slider_trigger_create_object(){
        new ptcfbwgt_pageSlider();
    }
    add_action('wp_footer','ptcfbwgt_page_slider_add_content_in_footer');
    function ptcfbwgt_page_slider_add_content_in_footer(){
        
        $o = get_option('ptcfbwgt_page_plugin_slider_option');
        extract($o);
    
    $print_facebook_page = '';
    $print_facebook_page .= 
    '<div class="fb-page" data-href="'.$pageURL.'" 
    data-width="'.$width.'" data-height="'.$height.'" 
    data-hide-cover="'.$hide_cover.'" 
    data-show-facepile="'.$show_faces.'" 
    data-show-posts="'.$posts.'">
    </div>';
    $imgURL = plugins_url('assets/fb-img_new.png', __FILE__);
    
    ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=262562957268319";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        
        <?php if($alignment=='left'){?>
        <div id="real_facebook_display">
            <div id="fsbbox1" class="fb_area_left"><a class="open" id="fblink" href="javascript:;"><img class="outer" style="right: -30px;top: 0; transform: rotate(180deg);" src="<?php echo $imgURL;?>" alt=""></a>
                <div id="fsbbox2" class="fb_inner_area_left">
                <?php echo $print_facebook_page; ?>
                </div>
                <div style="font-size: 9px; color: #808080; font-weight: normal; font-family: tahoma,verdana,arial,sans-serif; line-height: 1.28; text-align: left; direction: ltr;padding:3px 3px 0px; position:absolute;bottom:0px;left:0px;"><a href="https://www.nationalcprassociation.com/" target="_blank" style="color: #808080;">nationalcprassociation.com</a></div>
            </div>
        </div>
        

		<style type="text/css">
        
        div.fb_area_left{
        
            left: -<?php echo trim($width+10);?>px;         
            top: <?php echo $marginTop;?>px;         
            z-index: 10000;         
            height:<?php echo trim($height+30);?>px;        
            -webkit-transition: all .5s ease-in-out;        
            -moz-transition: all .5s ease-in-out;        
            -o-transition: all .5s ease-in-out;        
            transition: all .5s ease-in-out;        
            }
        
        div.fb_area_left.showdiv{        
            left:0;}	
        
        div.fb_inner_area_left{        
            text-align: left;        
            width:<?php echo trim($width);?>px;        
            height:<?php echo trim($height);?>px;        
            }
        
        
        </style>
        
        
        <?php } else { ?>
        <div id="real_facebook_display">
            <div id="fsbbox1" class="fb_area_right">
                        <a class="open" id="fblink" href="javascript:;"><img class="outer" style="top: 0px;left:-30px;" src="<?php echo $imgURL;?>" alt=""></a>
            <div id="fsbbox2" class="fb_inner_area_right">
                    <?php echo $print_facebook_page; ?>
                    
                </div>
                <div style="font-size: 9px; color: #808080; font-weight: normal; font-family: tahoma,verdana,arial,sans-serif; line-height: 1.28; text-align: right; direction: ltr;padding:3px 3px 0px; position:absolute;bottom:0px;right:0px;"><a href="https://www.nationalcprassociation.com/" target="_blank" style="color: #808080;">nationalcprassociation.com</a></div>
            </div>
        </div>
        
        
        <style type="text/css">
        
        div.fb_area_right{        
            right: -<?php echo trim($width+10);?>px;        
            top: <?php echo $marginTop;?>px;        
            z-index: 10000;         
            height:<?php echo trim($height+30);?>px;        
            -webkit-transition: all .5s ease-in-out;        
            -moz-transition: all .5s ease-in-out;        
            -o-transition: all .5s ease-in-out;        
            transition: all .5s ease-in-out;        
            }
        
        div.fb_area_right.showdiv{        
            right:0;        
            }	
        
        div.fb_inner_area_right{        
            text-align: left;        
            width:<?php echo trim($width);?>px;        
            height:<?php echo trim($height);?>px;        
            }
        
        div.fb_area_right .contacticonlink {        
            left: -32px;        
            text-align: left;        
        }		
        
        </style>
		<?php } ?>
        <script type="text/javascript">
        
        jQuery(document).ready(function() {
            jQuery('#fblink').click(function(){
                jQuery(this).parent().toggleClass('showdiv');
        
        });});
        </script>
        
        <?php
        }
        add_action( 'wp_enqueue_scripts', 'register_fb_facebook_page_slider_style' );
         function register_fb_facebook_page_slider_style() {
            wp_register_style( 'register_fb_facebook_page_slider_style', plugins_url( 'assets/ptcfbwgt_style.css' , __FILE__ ) );
            wp_enqueue_style( 'register_fb_facebook_page_slider_style' );
                wp_enqueue_script('jquery');
         }       