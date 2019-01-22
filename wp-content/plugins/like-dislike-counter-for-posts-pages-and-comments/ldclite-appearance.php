<?php
add_action('admin_menu', 'ldclite_add_menu');
function ldclite_add_menu() {
	add_menu_page('Like Dislike Counter Main Page', 'Like Dislike Lite', 'administrator','ldc-main', 'ldclite_appereance', plugins_url( 'images/icn-ldc.png' , __FILE__ ));
}

add_action('admin_init', 'ldclite_main_init' );
function ldclite_main_init(){
	register_setting( 'ldclite_plugin_options', 'ldclite_options', 'ldclite_options_validate' );
}

function ldclite_options_validate($input) {
	if(!isset($input['ldc_deactivate'])){$input['ldc_deactivate']=0;}
	return $input;
}

function ldclite_appereance(){
?>
	<div id="ldc_settPage" class="wrap" style="width:704px;">
	
		<div id="icon-options-general" class="icon32"><br></div>
		<h2><?php _e('Like Dislike Lite '.ldclite_get_version().' Settings','ldclite') ?></h2>
		
		<div class="ldclite-wrapper">
			<!-- WP-Banner Starts Here -->
			<div id="wp_banner">
				<!-- Top Section Starts Here -->
				<div class="top_section">
					<!-- Begin MailChimp Signup Form -->
					<link type="text/css" rel="stylesheet" href="http://cdn-images.mailchimp.com/embedcode/classic-081711.css">
					<style type="text/css">
						#mc_embed_signup{ clear:left; font:14px Helvetica,Arial,sans-serif; }
					</style>
					<div id="mc_embed_signup">
						<form novalidate="" target="_blank" class="validate" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post" action="http://wpfruits.us6.list-manage.com/subscribe/post?u=166c9fed36fb93e9202b68dc3&amp;id=bea82345ae">
							<div class="mc-field-group">
								<input type="email" id="mce-EMAIL" class="required email" name="EMAIL" value="" placeholder="Our Newsletter Just Enter Your Email Here" />
								<input type="submit" class="button" id="mc-embedded-subscribe" name="subscribe" value="" onclick="return ldc_Valid();">
								<div style="clear:both;"></div>
							</div>
							<div class="clear" id="mce-responses">
								<div style="display:none" id="mce-error-response" class="response"></div>
								<div style="display:none" id="mce-success-response" class="response"></div>
							</div>	
							
						</form>
					</div>
					<script type="text/javascript">
						var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';
						try {
							var jqueryLoaded=jQuery;
							jqueryLoaded=true;
						} catch(err) {
							var jqueryLoaded=false;
						}
						var head= document.getElementsByTagName('head')[0];
						if (!jqueryLoaded) {
							var script = document.createElement('script');
							script.type = 'text/javascript';
							script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
							head.appendChild(script);
							if (script.readyState &amp;&amp; script.onload!==null){
								script.onreadystatechange= function () {
									  if (this.readyState == 'complete') mce_preload_check();
								}    
							}
						}
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
						head.appendChild(script);
						var err_style = '';
						try{
							err_style = mc_custom_error_style;
						} catch(e){
							err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
						}
						var head= document.getElementsByTagName('head')[0];
						var style= document.createElement('style');
						style.type= 'text/css';
						if (style.styleSheet) {
							style.styleSheet.cssText = err_style;
						} else {
							style.appendChild(document.createTextNode(err_style));
						}
						head.appendChild(style);
						setTimeout('mce_preload_check();', 250);

						var mce_preload_checks = 0;
						function mce_preload_check(){
							if (mce_preload_checks&gt;40) return;
							mce_preload_checks++;
							try {
								var jqueryLoaded=jQuery;
							} catch(err) {
								setTimeout('mce_preload_check();', 250);
								return;
							}
							try {
								var validatorLoaded=jQuery("#fake-form").validate({});
							} catch(err) {
								setTimeout('mce_preload_check();', 250);
								return;
							}
							mce_init_form();
						}
						function mce_init_form()
						{
							jQuery(document).ready( function($) 
							{
							  var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
							  var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
							  $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
							  options = { url: 'http://wpfruits.us6.list-manage.com/subscribe/post-json?u=166c9fed36fb93e9202b68dc3&amp;id=bea82345ae&amp;c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
											beforeSubmit: function(){
												$('#mce_tmp_error_msg').remove();
												$('.datefield','#mc_embed_signup').each(
													function(){
														var txt = 'filled';
														var fields = new Array();
														var i = 0;
														$(':text', this).each(
															function(){
																fields[i] = this;
																i++;
															});
														$(':hidden', this).each(
															function(){
																var bday = false;
																if (fields.length == 2){
																	bday = true;
																	fields[2] = {'value':1970};//trick birthdays into having years
																}
																if ( fields[0].value=='MM' &amp;&amp; fields[1].value=='DD' &amp;&amp; (fields[2].value=='YYYY' || (bday &amp;&amp; fields[2].value==1970) ) ){
																	this.value = '';
																} else if ( fields[0].value=='' &amp;&amp; fields[1].value=='' &amp;&amp; (fields[2].value=='' || (bday &amp;&amp; fields[2].value==1970) ) ){
																	this.value = '';
																} else {
																	if (/\[day\]/.test(fields[0].name)){
																		this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
																	} else {
																		this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
																	}
																}
															});
													});
												return mce_validator.form();
											}, 
											success: mce_success_cb
										};
							  $('#mc-embedded-subscribe-form').ajaxForm(options);

							});
						}
						function mce_success_cb(resp){
							$('#mce-success-response').hide();
							$('#mce-error-response').hide();
							if (resp.result=="success"){
								$('#mce-'+resp.result+'-response').show();
								$('#mce-'+resp.result+'-response').html(resp.msg);
								$('#mc-embedded-subscribe-form').each(function(){
									this.reset();
								});
							} else {
								var index = -1;
								var msg;
								try {
									var parts = resp.msg.split(' - ',2);
									if (parts[1]==undefined){
										msg = resp.msg;
									} else {
										i = parseInt(parts[0]);
										if (i.toString() == parts[0]){
											index = parts[0];
											msg = parts[1];
										} else {
											index = -1;
											msg = resp.msg;
										}
									}
								} catch(e){
									index = -1;
									msg = resp.msg;
								}
								try{
									if (index== -1){
										$('#mce-'+resp.result+'-response').show();
										$('#mce-'+resp.result+'-response').html(msg);            
									} else {
										err_id = 'mce_tmp_error_msg';
										html = '&lt;div id="'+err_id+'" style="'+err_style+'"&gt; '+msg+'&lt;/div&gt;';
										
										var input_id = '#mc_embed_signup';
										var f = $(input_id);
										if (ftypes[index]=='address'){
											input_id = '#mce-'+fnames[index]+'-addr1';
											f = $(input_id).parent().parent().get(0);
										} else if (ftypes[index]=='date'){
											input_id = '#mce-'+fnames[index]+'-month';
											f = $(input_id).parent().parent().get(0);
										} else {
											input_id = '#mce-'+fnames[index];
											f = $().parent(input_id).get(0);
										}
										if (f){
											$(f).append(html);
											$(input_id).focus();
										} else {
											$('#mce-'+resp.result+'-response').show();
											$('#mce-'+resp.result+'-response').html(msg);
										}
									}
								} catch(e){
									$('#mce-'+resp.result+'-response').show();
									$('#mce-'+resp.result+'-response').html(msg);
								}
							}
						}

					</script>
					<!--End mc_embed_signup-->
				</div>
				<!-- Top Section Ends Here -->
				
				<!-- Bottom Section Starts Here -->
				<div class="bot_section">
					<a href="http://www.wpfruits.com/" class="wplogo" target="_blank" title="WFruits.com"></a>
					<a href="https://www.facebook.com/pages/WPFruitscom/443589065662507" class="fbicon" target="_blank" title="Facebook"></a>
					<a href="http://www.twitter.com/wpfruits" class="twicon" target="_blank" title="Twitter"></a>
					<div style="clear:both;"></div>
				</div>
				<!-- Bottom Section Ends Here -->
			</div>
			<!-- WP-Banner Ends Here -->
		</div>
		
		
		<form method="post" action="options.php" class="ldclite-form">
			<?php settings_fields('ldclite_plugin_options'); ?>
			<?php $options = get_option('ldclite_options'); ?>
		
			<div id="poststuff" class="ldc-meta-box">
				<label for="ldc_use_tempcode"> 
					<input id="ldc_use_tempcode" title="ldc_use_tempcode" name="ldclite_options[ldc_deactivate]" type="checkbox" value="1" <?php if(isset($options['ldc_deactivate'])){ if($options['ldc_deactivate']=="1"){echo "checked";} }?> /> <b style=" font-size: 15px;margin-left: 2px;color:#C91F1C;"><?php _e('Check it, if you want to use template code instead of Auto add functionality.','ldclite'); ?></b></label>
					<div class="postbox ldc_use_tempcode" id="post_settings_box" style="margin-top:10px;<?php if(isset($options['ldc_deactivate']) && $options['ldc_deactivate'] ===0){ ?> display:none;<?php } ?>" >
					<div class="handlediv" title="Click to toggle"><br/></div>
					<h3 class="hndle"><span><?php _e('Template code for Post,Page and Comment.', 'ldclite'); ?></span></h3>
					
					<div class="inside">
						<br/>
						<b><big><?php _e('For Posts & Pages use the code in loop:','ldclite'); ?></big></b><br/><br/>
						<b><?php _e('For like(with in php tags):-','ldclite'); ?></b><br/>
						<div class="ldc-code"><code>&lt;&#63;<?php echo"php"; ?><br/><?php _e("if(function_exists('like_counter_p')) { like_counter_p('text for like'); }",'ldclite'); ?><br/>&#63;&gt;</code></div>
						<br/><br/>
						<b><?php _e('For Dislike(with in php tags):-','ldclite'); ?></b><br/>
						<div class="ldc-code"><code>&lt;&#63;<?php echo"php"; ?><br/><?php _e("if(function_exists('dislike_counter_p')) { dislike_counter_p('text for un-like'); }",'ldclite'); ?><br/>&#63;&gt;</code></div>
						<br/><br/>
						<i><?php _e('Parameter provide is optional. HTML can also be used as parameter.','ldclite'); ?></i>
						<br/><br/>
						<b><big><?php _e('For Comments use the code in loop:','ldclite'); ?></big></b><br/><br/>
						<b><?php _e('For like(with in php tags):-','ldclite'); ?></b><br/>
						
						<div class="ldc-code"><code>&lt;&#63;<?php echo"php"; ?><br/><?php _e("if(function_exists('like_counter_c')) { like_counter_c('text for like'); }",'ldclite'); ?><br/>&#63;&gt;</code></div>
						<br/><br/>
						<b><?php _e('For Dislike(with in php tags):-','ldclite'); ?></b><br/>
						<div class="ldc-code"><code>&lt;&#63;<?php echo"php"; ?><br/><?php _e("if(function_exists('dislike_counter_c')) { dislike_counter_c('text for dislike'); }",'ldclite'); ?><br/>&#63;&gt;</code></div>
						
					</div>
				</div>
			</div>
		
	
			<div id="poststuff" class="ldc-meta-box">
				<div class="postbox" id="post_settings_box">
				<div class="handlediv" title="Click to toggle"><br/></div>
					<h3 class="hndle"><span><?php _e('General Settings', 'ldclite'); ?></span></h3>
					<div class="inside">
						<table class="form-table">
							<tr valign="top"><th scope="row"><label for="ldclite_options[ldc_like_text]"><?php _e('Like Button Text:','ldclite') ?></label></th>
								<td><input name="ldclite_options[ldc_like_text]" id="ldclite_options[ldc_like_text]" type="text" value="<?php echo $options['ldc_like_text']; ?>" /></td>
							</tr>
							<tr valign="top"><th scope="row"><label for="ldclite_options[ldc_dislike_text]"><?php _e('Disike Button Text:','ldclite') ?></label></th>
								<td><input name="ldclite_options[ldc_dislike_text]" id="ldclite_options[ldc_dislike_text]" type="text" value="<?php echo $options['ldc_dislike_text'];?>" /></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			
			<p class="submit-btn">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
			
			<div class="clear"></div>
			
		</form>	
		<br/>
		<iframe frameborder="1" class="ldclite_iframe" src="http://www.sketchthemes.com/sketch-updates/plugin-updates/ldc-lite/ldc-lite.php" width="694px" height="220px" scrolling="no" ></iframe> 		
		
	</div>

<?php
}
?>