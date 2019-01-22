<?php
/*
Plugin Name: Post title marquee scroll
Description: Post title marquee scroll is a simple wordpress plugin to create the marquee scroll in the website with post title. In the admin we have option to choose the category and display order. We can add this plugin directly in the theme files. Also we have widget and short code option.
Author: Gopi Ramasamy
Version: 8.5
Plugin URI: http://www.gopiplus.com/work/2011/08/08/post-title-marquee-scroll-wordpress-plugin/
Author URI: http://www.gopiplus.com/work/2011/08/08/post-title-marquee-scroll-wordpress-plugin/
Donate link: http://www.gopiplus.com/work/2011/08/08/post-title-marquee-scroll-wordpress-plugin/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function ptmsshow()
{
	global $wpdb;
	$ptms_marquee = "";
	
	$ptms_scrollamount = get_option('ptms_scrollamount');
	$ptms_scrolldelay = get_option('ptms_scrolldelay');
	$ptms_direction = get_option('ptms_direction');
	$ptms_style = get_option('ptms_style');
	
	$ptms_noofpost = get_option('ptms_noofpost');
	$ptms_categories = get_option('ptms_categories');
	$ptms_orderbys = get_option('ptms_orderbys');
	$ptms_order = get_option('ptms_order');
	$ptms_spliter = get_option('ptms_spliter');
	
	if(!is_numeric($ptms_scrollamount)){ $ptms_scrollamount = 2; } 
	if(!is_numeric($ptms_scrolldelay)){ $ptms_scrolldelay = 5; } 
	if(!is_numeric($ptms_noofpost)){ $ptms_noofpost = 10; }
	
	$sSql = query_posts('cat='.$ptms_categories.'&orderby='.$ptms_orderbys.'&order='.$ptms_order.'&showposts='.$ptms_noofpost);
	
	$spliter = "";
	$ptms = "";
	if ( ! empty($sSql) ) 
	{
		$count = 0;
		foreach ( $sSql as $sSql ) 
		{
			$title = stripslashes($sSql->post_title);
			$link = get_permalink($sSql->ID);
			if($count > 0)
			{
				$spliter = "<img style='margin-left:10px; margin-right:10px;margin-top:2px;' src='http://localhost/news/wp-content/uploads/2015/08/announcement.png' height='10px' width='25px'>";
			}
			$ptms = $ptms .$spliter. $title ;
			
			$count = $count + 1;
		}
	}
	wp_reset_query();
	$ptms_marquee = $ptms_marquee . "<div class='ptms_marquee'>";
	$ptms_marquee = $ptms_marquee . "<marquee style='$ptms_style height: 20px;' scrollamount='$ptms_scrollamount' scrolldelay='$ptms_scrolldelay' direction='$ptms_direction' onmouseover='this.stop()' onmouseout='this.start()'>";
	$ptms_marquee = $ptms_marquee . $ptms;
	$ptms_marquee = $ptms_marquee . "</marquee>";
	$ptms_marquee = $ptms_marquee . "</div>";
	echo $ptms_marquee;	
}

add_shortcode( 'post-marguee', 'ptms_shortcode' );

function ptms_shortcode( $atts ) 
{
	
	global $wpdb;
	$ptms_marquee = "";
	
	// [post-marguee]
	$ptms_scrollamount = get_option('ptms_scrollamount');
	$ptms_scrolldelay = get_option('ptms_scrolldelay');
	$ptms_direction = get_option('ptms_direction');
	$ptms_style = get_option('ptms_style');
	
	$ptms_noofpost = get_option('ptms_noofpost');
	$ptms_categories = get_option('ptms_categories');
	$ptms_orderbys = get_option('ptms_orderbys');
	$ptms_order = get_option('ptms_order');
	$ptms_spliter = get_option('ptms_spliter');
	
	if(!is_numeric($ptms_scrollamount)){ $ptms_scrollamount = 2; } 
	if(!is_numeric($ptms_scrolldelay)){ $ptms_scrolldelay = 5; } 
	if(!is_numeric($ptms_noofpost)){ $ptms_noofpost = 10; }
	
	//$sSql = query_posts('cat='.$ptms_categories.'&orderby='.$ptms_orderbys.'&order='.$ptms_order.'&showposts='.$ptms_noofpost);
	 
	$sSqlMin = "select p.ID, p.post_title, wpr.object_id, ". $wpdb->prefix . "terms.name , ". $wpdb->prefix . "terms.term_id ";
	$sSqlMin = $sSqlMin . "from ". $wpdb->prefix . "terms ";
	$sSqlMin = $sSqlMin . "inner join ". $wpdb->prefix . "term_taxonomy on ". $wpdb->prefix . "terms.term_id = ". $wpdb->prefix . "term_taxonomy.term_id ";
	$sSqlMin = $sSqlMin . "inner join ". $wpdb->prefix . "term_relationships wpr on wpr.term_taxonomy_id = ". $wpdb->prefix . "term_taxonomy.term_taxonomy_id ";
	$sSqlMin = $sSqlMin . "inner join ". $wpdb->prefix . "posts p on p.ID = wpr.object_id ";
	$sSqlMin = $sSqlMin . "where taxonomy= 'category' and p.post_type = 'post' and p.post_status = 'publish'";
	//$sSqlMin = $sSqlMin . "order by object_id; ";
	
	if( ! empty($ptms_categories) )
	{
		$sSqlMin = $sSqlMin . " and ". $wpdb->prefix . "terms.term_id in($ptms_categories)";
	}
	
	if( ! empty($ptms_orderbys) )
	{
		
		if($ptms_orderbys <> "rand" )
		{
			$sSqlMin = $sSqlMin . " order by p.$ptms_orderbys";
			
			if( ! empty($ptms_order) )
			{
				$sSqlMin = $sSqlMin . " $ptms_order";
			}
		}
		else
		{
			$sSqlMin = $sSqlMin . " order by rand()";
		}
		
	}
	
	if( ! empty($ptms_noofpost) )
	{
		$sSqlMin = $sSqlMin . " limit 0, $ptms_noofpost";
	}
	
	//echo $sSqlMin;
	
	$sSql = $wpdb->get_results($sSqlMin);
	$spliter = "";
	$ptms = "";
	if ( ! empty($sSql) ) 
	{
		$count = 0;
		foreach ( $sSql as $sSql ) 
		{
			$title = stripslashes($sSql->post_title);
			$link = get_permalink($sSql->ID);
			if($count > 0)
			{
				$spliter = $ptms_spliter;
			}
			$ptms = $ptms . $spliter . "<a href='".$link."'>" . $title . "</a>";
			
			$count = $count + 1;
		}
	}
	$ptms_marquee = $ptms_marquee . "<div class='ptms_marquee'>";
	$ptms_marquee = $ptms_marquee . "<marquee style='$ptms_style height: 20px;' scrollamount='$ptms_scrollamount' scrolldelay='$ptms_scrolldelay' direction='$ptms_direction' onmouseover='this.stop()' onmouseout='this.start()'>";
	$ptms_marquee = $ptms_marquee . $ptms;
	$ptms_marquee = $ptms_marquee . "</marquee>";
	$ptms_marquee = $ptms_marquee . "</div>";
	return $ptms_marquee;	
}

function ptms_install() 
{
	add_option('ptms_title', "Post title marquee scroll");
	add_option('ptms_scrollamount', "2");
	add_option('ptms_scrolldelay', "5");
	add_option('ptms_direction', "left");
	add_option('ptms_style', "color:#FF0000;font:Arial;");
	add_option('ptms_noofpost', "10");
	add_option('ptms_categories', "");
	add_option('ptms_orderbys', "ID");
	add_option('ptms_order', "DESC");
	add_option('ptms_spliter', " - ");
}

function ptms_widget($args) 
{
	extract($args);
	if(get_option('ptms_title') <> "")
	{
		echo $before_widget;
		echo $before_title;
		echo get_option('ptms_title');
		echo $after_title;
	}
	ptmsshow();
	if(get_option('ptms_title') <> "")
	{
		echo $after_widget;
	}
}
	
function ptms_control() 
{
	echo '<p><b>';
	_e('Post title marquee scroll', 'post-title-marquee');
	echo '.</b> ';
	_e('Check official website for more information', 'post-title-marquee');
	?> <a target="_blank" href="http://www.gopiplus.com/work/2011/08/08/post-title-marquee-scroll-wordpress-plugin/"><?php _e('click here', 'post-title-marquee'); ?></a></p><?php
}

function ptms_widget_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget('post-title-marquee-scroll', __('Post title marquee scroll', 'post-title-marquee'), 'ptms_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control('post-title-marquee-scroll', array(__('Post title marquee scroll', 'post-title-marquee'), 'widgets'), 'ptms_control');
	} 
}

function ptms_deactivation() 
{
	// No action required.
}

function ptms_option() 
{
	global $wpdb;
	?>
	<div class="wrap">
	  <div class="form-wrap">
		<div id="icon-edit" class="icon32 icon32-posts-post"><br>
		</div>
		<h2><?php _e('Post title marquee scroll', 'post-title-marquee'); ?></h2>
		<h3><?php _e('Plugin setting', 'post-title-marquee'); ?></h3>
	<?php

	$ptms_title = get_option('ptms_title');
	$ptms_scrollamount = get_option('ptms_scrollamount');
	$ptms_scrolldelay = get_option('ptms_scrolldelay');
	$ptms_direction = get_option('ptms_direction');
	$ptms_style = get_option('ptms_style');
	
	$ptms_noofpost = get_option('ptms_noofpost');
	$ptms_categories = get_option('ptms_categories');
	$ptms_orderbys = get_option('ptms_orderbys');
	$ptms_order = get_option('ptms_order');
	$ptms_spliter = get_option('ptms_spliter');
	
	if (isset($_POST['ptms_submit']))
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('ptms_form_setting');
		
		$ptms_title = stripslashes($_POST['ptms_title']);
		
		$ptms_scrollamount = stripslashes($_POST['ptms_scrollamount']);
		$ptms_scrolldelay = stripslashes($_POST['ptms_scrolldelay']);
		$ptms_direction = stripslashes($_POST['ptms_direction']);
		$ptms_style = stripslashes($_POST['ptms_style']);
		
		$ptms_noofpost = stripslashes($_POST['ptms_noofpost']);
		$ptms_categories = stripslashes($_POST['ptms_categories']);
		$ptms_orderbys = stripslashes($_POST['ptms_orderbys']);
		$ptms_order = stripslashes($_POST['ptms_order']);
		$ptms_spliter = stripslashes($_POST['ptms_spliter']);
		
		update_option('ptms_title', $ptms_title );
		
		update_option('ptms_scrollamount', $ptms_scrollamount );
		update_option('ptms_scrolldelay', $ptms_scrolldelay );
		update_option('ptms_direction', $ptms_direction );
		update_option('ptms_style', $ptms_style );
		
		update_option('ptms_noofpost', $ptms_noofpost );
		update_option('ptms_categories', $ptms_categories );
		update_option('ptms_orderbys', $ptms_orderbys );
		update_option('ptms_order', $ptms_order );
		update_option('ptms_spliter', $ptms_spliter );
		
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details successfully updated.', 'post-title-marquee'); ?></strong></p>
		</div>
		<?php
	}
	
	echo '<form name="ptms_form" method="post" action="">';
	
	echo '<label for="tag-title">'.__('Title :', 'post-title-marquee').'</label><input  style="width: 250px;" type="text" value="';
	echo $ptms_title . '" name="ptms_title" id="ptms_title" /><p></p>';
	
	echo '<label for="tag-title">'.__('Scroll amount :', 'post-title-marquee').'</label><input  style="width: 100px;" type="text" value="';
	echo $ptms_scrollamount . '" name="ptms_scrollamount" id="ptms_scrollamount" /><p></p>';
	
	echo '<label for="tag-title">'.__('Scroll delay :', 'post-title-marquee').'</label><input  style="width: 100px;" type="text" value="';
	echo $ptms_scrolldelay . '" name="ptms_scrolldelay" id="ptms_scrolldelay" /><p></p>';
	
	echo '<label for="tag-title">'.__('Scroll direction :', 'post-title-marquee').'</label><input  style="width: 100px;" type="text" value="';
	echo $ptms_direction . '" name="ptms_direction" id="ptms_direction" /><p>Enter: Left (or) Right</p>';
	
	echo '<label for="tag-title">'.__('Scroll style :', 'post-title-marquee').'</label><input  style="width: 250px;" type="text" value="';
	echo $ptms_style . '" name="ptms_style" id="ptms_style" /><p></p>';
	
	echo '<label for="tag-title">'.__('Spliter :', 'post-title-marquee').'</label><input  style="width: 100px;" type="text" value="';
	echo $ptms_spliter . '" name="ptms_spliter" id="ptms_spliter" /><p></p>';
	
	echo '<label for="tag-title">'.__('Number of post :', 'post-title-marquee').'</label><input  style="width: 100px;" type="text" value="';
	echo $ptms_noofpost . '" name="ptms_noofpost" id="ptms_noofpost" /><p></p>';
	
	echo '<label for="tag-title">'.__('Post categories :', 'post-title-marquee').'</label><input  style="width: 200px;" type="text" value="';
	echo $ptms_categories . '" name="ptms_categories" id="ptms_categories" /><p>Category IDs, separated by commas. (Example: 1, 3, 4) </p>';
	
	echo '<label for="tag-title">'.__('Post orderbys :', 'post-title-marquee').'</label><input  style="width: 200px;" type="text" value="';
	echo $ptms_orderbys . '" name="ptms_orderbys" id="ptms_orderbys" /><p>Any 1 from this list: ID (or) author (or) title (or) rand (or) date (or) category (or) modified</p>';
	
	echo '<label for="tag-title">'.__('Post order :', 'post-title-marquee').'</label><input  style="width: 100px;" type="text" value="';
	echo $ptms_order . '" name="ptms_order" id="ptms_order" /><p>Enter: ASC (or) DESC</p>';
	
	echo '<br/><input name="ptms_submit" id="ptms_submit" lang="publish" class="button-primary" value="'.__('Update Setting', 'post-title-marquee').'" type="Submit" />';
	wp_nonce_field('ptms_form_setting');
	echo '</form>';
	?>
    <h3><?php _e('Plugin configuration help', 'post-title-marquee'); ?></h3>
    <ol>
		<li><?php _e('Drag and drop the widget.', 'post-title-marquee'); ?></li>
		<li><?php _e('Add the plugin in the posts or pages using short code.', 'post-title-marquee'); ?></li>
		<li><?php _e('Add directly in to the theme using PHP code.', 'post-title-marquee'); ?></li>
    </ol>
    <p class="description"><?php _e('Check official website for more info', 'post-title-marquee'); ?> 
	<a href="http://www.gopiplus.com/work/2011/08/08/post-title-marquee-scroll-wordpress-plugin/" target="_blank"><?php _e('Click here', 'post-title-marquee'); ?></a></p>
    </div>
</div>
    <?php
}

function ptms_add_to_menu() 
{
	add_options_page(__('Post title marquee scroll', 'post-title-marquee'), 
						__('Post title marquee scroll', 'post-title-marquee'), 'manage_options', __FILE__, 'ptms_option' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'ptms_add_to_menu');
}

function ptms_textdomain()
{
	  load_plugin_textdomain( 'post-title-marquee', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action('plugins_loaded', 'ptms_textdomain');
add_action("plugins_loaded", "ptms_widget_init");
register_activation_hook(__FILE__, 'ptms_install');
register_deactivation_hook(__FILE__, 'ptms_deactivation');
add_action('init', 'ptms_widget_init');
?>