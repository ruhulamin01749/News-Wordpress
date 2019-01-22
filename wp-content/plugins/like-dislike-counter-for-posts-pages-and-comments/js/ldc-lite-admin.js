jQuery(document).ready(function() {
	jQuery('#ldc_settPage .handlediv,#ldc_settPage .hndle').click(function(){ jQuery(this).parent().find('.inside').slideToggle("slow");});
	jQuery("#ldc_use_tempcode").click(function(){
		if(jQuery("#ldc_use_tempcode").is(':checked')){ jQuery('#ldc_settPage .ldc_use_tempcode').slideDown(); jQuery('#ldc_settPage .postbox').not('.ldc_use_tempcode').parent('.ldc-meta-box').slideUp(); } 		
		else{jQuery('.ldc_use_tempcode').slideUp(); 	jQuery('#ldc_settPage .postbox').not('.ldc_use_tempcode').parent('.ldc-meta-box').slideDown(); 	} 	
	});
	if(jQuery("#ldc_use_tempcode").is(':checked')){jQuery('#ldc_settPage .postbox').not('.ldc_use_tempcode').parent('.ldc-meta-box').hide();}
	
	jQuery('.ldclite-wrapper #mce-EMAIL').focus(function(){
		jQuery(this).css({'border-color':'#777','color':'#000','background':'transparent'});
	});
	
});

function ldc_Valid(){
	var reg= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var a  = document.getElementById('mce-EMAIL').value;
	if( a == "Enter email address"){
		jQuery('#mce-EMAIL').css({'border-color':'red','color':'red'});
		return false;
	}else{
		if(reg.test(a)==false){
			jQuery('#mce-EMAIL').css({'border-color':'red','color':'red','background':'#F7DAD9'});
			return false;
		}	
	}		
	return true;
}