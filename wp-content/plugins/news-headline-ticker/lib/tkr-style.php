<?php function nht_dynamicCSS()
{ ?>
<style type="text/css">
.slideBody {
  background: <?php $nht_bg_color = get_option('nht_bg_color'); if(!empty($nht_bg_color)) {echo $nht_bg_color;} else {echo "#2d81c8";}?>;
  border-radius:<?php $nht_border_radius = get_option('nht_border_radius'); if(!empty($nht_border_radius)) {echo $nht_border_radius;} else {echo "15";}?>px;
}
.slideBody ul{margin:0; padding:0;}
.fade,.slide {
    background: <?php $nht_bg_color = get_option('nht_bg_color'); if(!empty($nht_bg_color)) {echo $nht_bg_color;} else {echo "#2d81c8";}?>;
}
.nhtColor {
	display:none !important;
}
.typing{
	padding-left:18px;
}
.fade > li,.slide > li,.typing > li {
    list-style: none inside none;
}
.label{color:<?php $nht_label_color = get_option('nht_label_color'); if(!empty($nht_label_color)) {echo $nht_label_color;} else {echo "#FFF";}?>;
font-weight:bold; font-size:15px;}
.slideBody ul li a{color:<?php $nht_hover_color = get_option('nht_hover_color'); if(!empty($nht_hover_color)) {echo $nht_hover_color;} else {echo "#FFF";}?>;
border:0 none !important;}

</style>
<?php 
}
add_action('wp_footer','nht_dynamicCSS', 100);

?>