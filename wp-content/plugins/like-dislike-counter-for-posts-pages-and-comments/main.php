<?php
/*
Plugin Name: Like Dislike counter
Plugin URI: http://www.wpfruits.com
Description: Like dislike counter for posts and comments
Author: WPFruits
Version: 1.3.0
Author URI: http://www.wpfruits.com
*/

require_once('ldclite-appearance.php');
require_once('ldclite-function.php');

// Runs when plugin is activated and creates new database field
register_activation_hook(__FILE__,'like_dislike_counter_install');
add_action('admin_init', 'ldclite_plugin_redirect');
function ldclite_plugin_activate() {
    add_option('ldclite_plugin_do_activation_redirect', true);
}

function ldclite_plugin_redirect() {
    if (get_option('ldclite_plugin_do_activation_redirect', false)) {
        delete_option('ldclite_plugin_do_activation_redirect');
        wp_redirect('admin.php?page=ldc-main');
    }
}
function like_dislike_counter_install() 
{
	add_option('ldclite_options', ldc_lite_defaultOptions());
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$table_name = $wpdb->prefix."like_dislike_counters";     
	if($wpdb->get_var("show tables like '$table_name'") != $table_name){
		$sql= "CREATE TABLE ".$table_name."(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,post_id VARCHAR( 200 ) NOT NULL,ul_key VARCHAR( 30 ) NOT NULL,ul_value VARCHAR( 30 ) NOT NULL);"; 
		dbDelta($sql);
	}	
	ldclite_plugin_activate();
}

function ldc_lite_defaultOptions(){
	$default = array(
		'ldc_deactivate'  => 0,
		'ldc_like_text' => 'Likes',
		'ldc_dislike_text' => 'Dislikes'
    );
	return $default;
}

function ldclite_get_version(){
	if ( ! function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}

function like_dislike_couter_init_method() {
    wp_enqueue_script( 'jquery' );
	if(is_admin()){
		wp_enqueue_script('like-dislike',plugins_url( 'js/ldc-lite-admin.js' , __FILE__ ),array('jquery'),'1.0' );
	}
	if(is_admin()){
		wp_register_style($handle = 'like-dislike-admin', plugins_url( 'css/ldc-lite-admin.css' , __FILE__ ), $deps = array(), $ver = '1.0.0', $media = 'all');
		wp_enqueue_style('like-dislike-admin');
	}
}    
add_action('init', 'like_dislike_couter_init_method');

function ldc_lite_enqueue_css(){
	if(!is_admin()){
		wp_register_style($handle = 'like-dislike', plugins_url( 'css/ldc-lite.css' , __FILE__ ), $deps = array(), $ver = '1.0.0', $media = 'all');
		wp_enqueue_style('like-dislike');
	}
}
add_action('wp_print_styles', 'ldc_lite_enqueue_css');


function wp_dislike_like_footer_script() {
	if(!is_admin()){
	?>
    <script type="text/javascript">
	var isProcessing = false; 
    function alter_ul_post_values(obj,post_id,ul_type){
	
		if (isProcessing)    
		return;  
		isProcessing = true;   
		
		jQuery(obj).find("span").html("..");
    	jQuery.ajax({
   		type: "POST",
   		url: "<?php echo plugins_url( 'ajax_counter.php' , __FILE__ );?>",
   		data: "post_id="+post_id+"&up_type="+ul_type,
   		success: function(msg){
     		jQuery(obj).find("span").html(msg);
			isProcessing = false; 
   			}
 		});
	}
	</script>
    <?php
    }
}

add_action('wp_footer', 'wp_dislike_like_footer_script');