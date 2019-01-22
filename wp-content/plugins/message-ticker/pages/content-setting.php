<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php _e('message ticker', 'message-ticker'); ?></h2>	
    <?php
	$mt_title = get_option('mt_title');
	$mt_width = get_option('mt_width');
	$mt_height = get_option('mt_height');
	$mt_delay = get_option('mt_delay');
	$mt_speed = get_option('mt_speed');
	$mt_defaulttext = get_option('mt_defaulttext');
	
	if (isset($_POST['mt_submit'])) 
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('mt_form_setting');
			
		$mt_title = stripslashes($_POST['mt_title']);
		$mt_width = stripslashes($_POST['mt_width']);
		$mt_height = stripslashes($_POST['mt_height']);
		$mt_delay = stripslashes($_POST['mt_delay']);
		$mt_speed = stripslashes($_POST['mt_speed']);
		$mt_defaulttext = stripslashes($_POST['mt_defaulttext']);
		
		update_option('mt_title', $mt_title );
		update_option('mt_width', $mt_width );
		update_option('mt_height', $mt_height );
		update_option('mt_delay', $mt_delay );
		update_option('mt_speed', $mt_speed );
		update_option('mt_defaulttext', $mt_defaulttext );
		
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details successfully updated.', 'message-ticker'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo WP_mt_PLUGIN_URL; ?>/pages/setting.js"></script>
    <form name="mt_form" method="post" action="">
        <h3><?php _e('Widget setting', 'message-ticker'); ?></h3>
		<label for="tag-width"><?php _e('Widget title', 'message-ticker'); ?></label>
		<input name="mt_title" type="text" value="<?php echo $mt_title; ?>"  id="mt_title" size="70" maxlength="100">
		<p><?php _e('Please enter your widget title.', 'message-ticker'); ?></p>
		
		<label for="tag-width"><?php _e('Widget width', 'message-ticker'); ?></label>
		<input name="mt_width" type="text" value="<?php echo $mt_width; ?>"  id="mt_width" maxlength="5"> 
		<p><?php _e('Please enter widget width', 'message-ticker'); ?></p>
		
		<label for="tag-width"><?php _e('Widget height', 'message-ticker'); ?></label>
		<input name="mt_height" type="text" value="<?php echo $mt_height; ?>"  id="mt_height" maxlength="5">
		<p><?php _e('Please enter widget height', 'message-ticker'); ?></p>
		
		<h3><?php _e('Global setting', 'message-ticker'); ?></h3>
		<label for="tag-width"><?php _e('Delay (Global setting)', 'message-ticker'); ?></label>
		<input name="mt_delay" type="text" value="<?php echo $mt_delay; ?>"  id="mt_delay" maxlength="5">
		<p><?php _e('Please enter your ticker delay.', 'message-ticker'); ?> (Example: 3000)</p>
		
		<label for="tag-width"><?php _e('Speed (Global setting)', 'message-ticker'); ?></label>
		<input name="mt_speed" type="text" value="<?php echo $mt_speed; ?>"  id="mt_speed" maxlength="5">
		<p><?php _e('Please enter your ticker speed.', 'message-ticker'); ?> (Example: 5)</p>
		
		<label for="tag-width"><?php _e('No message text', 'message-ticker'); ?></label>
		<input name="mt_defaulttext" type="text" value="<?php echo $mt_defaulttext; ?>"  id="mt_defaulttext" size="70" maxlength="500">
		<p><?php _e('This text will be display, if no announcement available or all announcement expired.', 'message-ticker'); ?></p>
			
		<p class="submit">
		<input name="mt_submit" id="mt_submit" class="button" value="<?php _e('Submit', 'message-ticker'); ?>" type="submit" />
		<input name="publish" lang="publish" class="button" onclick="mt_redirect()" value="<?php _e('Cancel', 'message-ticker'); ?>" type="button" />
		<input name="Help" lang="publish" class="button" onclick="mt_help()" value="<?php _e('Help', 'message-ticker'); ?>" type="button" />
		</p>
		<?php wp_nonce_field('mt_form_setting'); ?>
    </form>
  </div>
<p class="description">
	<?php _e('Check official website for more information', 'message-ticker'); ?>
	<a target="_blank" href="<?php echo WP_mt_FAV; ?>"><?php _e('click here', 'message-ticker'); ?></a>
</p>
</div>