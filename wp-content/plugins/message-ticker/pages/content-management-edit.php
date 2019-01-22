<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$did = isset($_GET['did']) ? $_GET['did'] : '0';

// First check if ID exist with requested ID
$sSql = $wpdb->prepare(
	"SELECT COUNT(*) AS `count` FROM ".WP_mt_TABLE."
	WHERE `mt_id` = %d",
	array($did)
);
$result = '0';
$result = $wpdb->get_var($sSql);

if ($result != '1')
{
	?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'message-ticker'); ?></strong></p></div><?php
}
else
{
	$mt_errors = array();
	$mt_success = '';
	$mt_error_found = FALSE;
	
	$sSql = $wpdb->prepare("
		SELECT *
		FROM `".WP_mt_TABLE."`
		WHERE `mt_id` = %d
		LIMIT 1
		",
		array($did)
	);
	$data = array();
	$data = $wpdb->get_row($sSql, ARRAY_A);
	
	// Preset the form fields
	$form = array(
		'mt_id' => $data['mt_id'],
		'mt_text' => $data['mt_text'],
		'mt_order' => $data['mt_order'],
		'mt_status' => $data['mt_status'],
		'mt_group' => $data['mt_group'],
		'mt_date' => $data['mt_date']
	);
}
// Form submitted, check the data
if (isset($_POST['mt_form_submit']) && $_POST['mt_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('mt_form_edit');
	
	$form['mt_text'] = isset($_POST['mt_text']) ? $_POST['mt_text'] : '';
	if ($form['mt_text'] == '')
	{
		$mt_errors[] = __('Please enter the text.', 'message-ticker');
		$mt_error_found = TRUE;
	}

	$form['mt_order'] = isset($_POST['mt_order']) ? $_POST['mt_order'] : '';
	if ($form['mt_order'] == '')
	{
		$mt_errors[] = __('Please enter the display order, only number.', 'message-ticker');
		$mt_error_found = TRUE;
	}

	$form['mt_status'] = isset($_POST['mt_status']) ? $_POST['mt_status'] : '';
	if ($form['mt_status'] == '')
	{
		$mt_errors[] = __('Please select the display status.', 'message-ticker');
		$mt_error_found = TRUE;
	}
	
	$form['mt_link'] = isset($_POST['mt_link']) ? $_POST['mt_link'] : '';
	$form['mt_group'] = isset($_POST['mt_group']) ? $_POST['mt_group'] : '';
	$form['mt_date'] = isset($_POST['mt_date']) ? $_POST['mt_date'] : '9999-12-31';

	//	No errors found, we can add this Group to the table
	if ($mt_error_found == FALSE)
	{	
		$sSql = $wpdb->prepare(
				"UPDATE `".WP_mt_TABLE."`
				SET `mt_text` = %s,
				`mt_order` = %s,
				`mt_status` = %s,
				`mt_group` = %s,
				`mt_date` = %s
				WHERE mt_id = %d
				LIMIT 1",
				array($form['mt_text'], $form['mt_order'], $form['mt_status'], $form['mt_group'], $form['mt_date'], $did)
			);
		$wpdb->query($sSql);
		
		$mt_success = __('Details was successfully updated.', 'message-ticker');
	}
}

if ($mt_error_found == TRUE && isset($mt_errors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $mt_errors[0]; ?></strong></p>
	</div>
	<?php
}
if ($mt_error_found == FALSE && strlen($mt_success) > 0)
{
	?>
	<div class="updated fade">
		<p><strong><?php echo $mt_success; ?> <a href="<?php echo WP_mt_ADMIN_URL; ?>"><?php _e('Click here to view the details', 'message-ticker'); ?></a></strong></p>
	</div>
	<?php
}
?>
<script language="JavaScript" src="<?php echo WP_mt_PLUGIN_URL; ?>/pages/setting.js"></script>
<script language="JavaScript" src="<?php echo WP_mt_PLUGIN_URL; ?>/pages/noenter.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php _e('message ticker', 'message-ticker'); ?></h2>
	<form name="form_mt" method="post" action="#" onsubmit="return mt_submit()"  >
      <h3><?php _e('Update details', 'message-ticker'); ?></h3>
      
	<label for="tag-title"><?php _e('Enter the message/announcement', 'message-ticker'); ?></label>
	<textarea name="mt_text" cols="110" rows="6" id="mt_text"><?php echo esc_html(stripslashes($form['mt_text'])); ?></textarea>
	<p><?php _e('Please enter your message. Enter &lt;br&gt; to line break.', 'message-ticker'); ?></p>
	
	<label for="tag-title"><?php _e('Display status', 'message-ticker'); ?></label>
	<select name="mt_status" id="mt_status">
		<option value='YES' <?php if($form['mt_status'] == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
		<option value='NO' <?php if($form['mt_status'] == 'NO') { echo "selected='selected'" ; } ?>>No</option>
	</select>
	<p><?php _e('Do you want to show this announcement in your scroll?', 'message-ticker'); ?></p>
	
	<label for="tag-title"><?php _e('Display order', 'message-ticker'); ?></label>
	<input name="mt_order" type="text" id="mt_order" value="<?php echo $form['mt_order']; ?>" maxlength="3" />
	<p><?php _e('What order should this announcement be played in. should it come 1st, 2nd, 3rd, etc..', 'message-ticker'); ?></p>
	
	<label for="tag-title"><?php _e('Message group', 'message-ticker'); ?></label>
	<select name="mt_group" id="mt_group">
	<option value='Select'>Select</option>
	<?php
	$sSql = "SELECT distinct(mt_group) as mt_group FROM `".WP_mt_TABLE."` order by mt_group";
	$thisselected = "";
	$myDistinctData = array();
	$arrDistinctDatas = array();
	$myDistinctData = $wpdb->get_results($sSql, ARRAY_A);
	$i = 0;
	foreach ($myDistinctData as $DistinctData)
	{
		$arrDistinctData[$i]["mt_group"] = strtoupper($DistinctData['mt_group']);
		$i = $i+1;
	}
	for($j=$i; $j<$i+5; $j++)
	{
		$arrDistinctData[$j]["mt_group"] = "GROUP" . $j;
	}
	$arrDistinctDatas = array_unique($arrDistinctData, SORT_REGULAR);
	foreach ($arrDistinctDatas as $arrDistinct)
	{
		if(strtoupper($form['mt_group']) == strtoupper($arrDistinct["mt_group"])) 
		{ 
			$thisselected = "selected='selected'" ; 
		}
		?><option value='<?php echo strtoupper($arrDistinct["mt_group"]); ?>' <?php echo $thisselected; ?>><?php echo strtoupper($arrDistinct["mt_group"]); ?></option><?php
		$thisselected = "";
	}
	?>
	</select>
	<p><?php _e('Please select your announcement group.', 'message-ticker'); ?></p>
	
		<label for="tag-title"><?php _e('Expiration date', 'message-ticker'); ?></label>
		<input name="mt_date" type="text" id="mt_date" value="<?php echo substr($form['mt_date'],0,10); ?>" maxlength="10" />
		<p><?php _e('Please enter the expiration date in this format YYYY-MM-DD <br /> 9999-12-31 : Is equal to no expire.', 'message-ticker'); ?></p>
	  
      <input name="mt_id" id="mt_id" type="hidden" value="<?php echo $form['mt_id']; ?>">
      <input type="hidden" name="mt_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Submit', 'message-ticker'); ?>" type="submit" />
        <input name="publish" lang="publish" class="button add-new-h2" onclick="mt_redirect()" value="<?php _e('Cancel', 'message-ticker'); ?>" type="button" />
        <input name="Help" lang="publish" class="button add-new-h2" onclick="mt_help()" value="<?php _e('Help', 'message-ticker'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('mt_form_edit'); ?>
    </form>
</div>
<p class="description">
	<?php _e('Check official website for more information', 'message-ticker'); ?>
	<a target="_blank" href="<?php echo WP_mt_FAV; ?>"><?php _e('click here', 'message-ticker'); ?></a>
</p>
</div>