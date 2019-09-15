<?php 
	require("url_deal.php");
	require("db_connect.php");
	$uid=url_deal($_GET['uid']);
	$sqls="delete from ad_user where a_name='".$uid."'";
	$rs=mysql_query($sqls,$conn);
	header("location:a_aduser_list.php");
?>