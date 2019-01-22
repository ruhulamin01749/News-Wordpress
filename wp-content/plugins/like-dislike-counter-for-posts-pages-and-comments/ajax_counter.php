<?php
error_reporting(0);
$changedDir='';
if (!$changedDir)$changedDir = preg_replace('|wp-content.*$|','',__FILE__);
include_once($changedDir.'/wp-config.php');
if(isset($_COOKIE['ul_post_cnt']))
{
$posts_present=$_COOKIE['ul_post_cnt'];
}
else
{
$posts_present=array();
}
$post_id=$_POST['post_id'];
$up_type=$_POST['up_type'];
if($up_type=='c_like'||$up_type=='c_dislike')
{
$for_com='c_';
}
else
{
$for_com='';
}
if(!in_array($for_com.$post_id,$posts_present))
{
update_post_ul_meta($post_id,$up_type);
}
echo get_post_ul_meta($post_id,$up_type);