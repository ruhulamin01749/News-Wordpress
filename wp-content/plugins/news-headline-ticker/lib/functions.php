<?php
function registernhtPage() {
	add_submenu_page( 'edit.php?post_type=headline', 'News Headline Settings', 'Ticker Settings', 'manage_options', 'news-headline', 'newsHeadLineFunction' ); 
}
add_action('admin_menu', 'registernhtPage');

function newsHeadLineFunction() {
	
	echo '<div class="newsWrap">';
		echo '<h1>Headline Newsticker Configurations</h1>';
?>
   <div id="nhtLeft">  
    <form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
		        
		<div class="inside">
        <h3>Insert your text & background color</h3>
			<table class="form-table">
                <tr>
					<th><label for="nht_effect">Effect Type</label></th>
					<td><select name="nht_effect" id="nht_effect">
            <option value="typing" <?php if( get_option('nht_effect') == 'typing'){ echo 'selected="selected"'; } ?>>Typing</option>
            <option value="fade" <?php if( get_option('nht_effect') == 'fade'){ echo 'selected="selected"'; } ?>>Fade</option>
            <option value="slide" <?php if( get_option('nht_effect') == 'slide'){ echo 'selected="selected"'; } ?>>Slide</option>
        </select></td>
				</tr>
                <tr>
					<th><label for="nht_border_radius">Border Radius</label></th>
					<td><input type="text" name="nht_border_radius" value="<?php $nht_border_radius = get_option('nht_border_radius'); if(!empty($nht_border_radius)) {echo $nht_border_radius;} else {echo "15";}?>">px;</td>
				</tr>
                <tr>
					<th><label for="nht_label">Label Text</label></th>
					<td><input type="text" name="nht_label" value="<?php $nht_label = get_option('nht_label'); if(!empty($nht_label)) {echo $nht_label;} else {echo "Breaking News:";}?>"></td>
				</tr>
                <tr>
					<th><label for="nht_label_color">Label Text Color</label></th>
					<td><input type="text" name="nht_label_color" id="scrollbar_color" value="<?php $nht_label_color = get_option('nht_label_color'); if(!empty($nht_label_color)) {echo $nht_label_color;} else {echo "#FFF";}?>" class="color-picker nht_label_color" /></td>
				</tr>
                
				<tr>
					<th><label for="nht_bg_color">Background Color <span>*</span></label></th>
					<td><input type="text" name="nht_bg_color" id="scrollbar_color" value="<?php $nht_bg_color = get_option('nht_bg_color'); if(!empty($nht_bg_color)) {echo $nht_bg_color;} else {echo "#2d81c8";}?>" class="color-picker nht_bg_color" /></td>
				</tr>
				<tr>
					<th><label for="nht_text_color">Text Color <span>*</span></label></th>
					<td><input type="text" name="nht_text_color" id="scrollbar_color" value="<?php $nht_text_color = get_option('nht_text_color'); if(!empty($nht_text_color)) {echo $nht_text_color;} else {echo "#FFF";}?>" class="color-picker nht_text_color" /></td>
				</tr>
				<tr>
					<th><label for="nht_hover_color">Text Hover Color</label></th>
					<td><input type="text" name="nht_hover_color" id="scrollbar_color" value="<?php $nht_hover_color = get_option('nht_hover_color'); if(!empty($nht_hover_color)) {echo $nht_hover_color;} else {echo "#FFF";}?>" class="color-picker nht_hover_color" /></td>
				</tr>
		</table>
	
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="nht_effect, nht_border_radius, nht_label,  nht_label_color, nht_bg_color, nht_text_color, nht_hover_color" />
		<p class="submit"><input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" class="button button-primary" /></p>
	</form>      
  </div>
  </div>
 
  
  <div id="nhtRight">
  
  <div class="nhtWidget">
  		<h3>Need Responsive Web Design?</h3>
  		<a href="http://www.e2soft.com" title="Web Design Company" target="_blank"><img src="<?php bloginfo('url' ); echo"/wp-content/plugins/news-headline-ticker/img/responsive-web-design.png"; ?>" alt="Web Design Company" /></a>
  </div>
  <div class="clrFix"></div>
  
<div class="nhtWidget">
    
<p><h3>Donate and support the development.</h3> With your help I can make Simple Fields even better! $5, $10, $100 – any amount is fine! :)</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="82C6LTLMFLUFW">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
<div class="clrFix"></div>
</div>

<div class="nhtWidget">
<h3>Help & Support</h3>
<p style="text-align:left; padding:10px 7px;">
<strong>1. </strong>Upload ‘news-headline-ticker‘ to the ‘/wp-content/plugins/‘ directory<br />
<strong>2. </strong>Activate the plugin through the ‘Plugins’ menu in WordPress<br />
<strong>3. </strong>Click on the new menu item “News Headline” and create your head line news.<br />
<strong>4. </strong>Just copy and paste <strong>[News-Ticker]</strong> in the post/page" where you want to display news head line..
</p>
<h4><a href="http://www.e2soft.com/">More Help & Support</a></h4>
<div class="clrFix"></div>
</div>

</div>
<div class="clrFix"></div>
<?php		
	echo '</div>';
}