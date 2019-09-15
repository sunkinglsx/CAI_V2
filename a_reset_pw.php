<?php
	require("db_connect.php");
	require("sendMail.php");
	$uid=$_GET['uid'];
	$sqls="select * from ad_user where a_name='".$uid."'";
	$rs=mysql_query($sqls,$conn);
	$arr_user=mysql_fetch_array($rs);
	$npw=md5("123456");
	$is_ok=reset_pw_email($arr_user['email'],$arr_user['t_name'],"123456");
	
	//发送邮件成功就更新数据表
	if($is_ok)
	{
		$sqls="update ad_user set a_pw='".$npw."' where a_name='".$uid."'";
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
				echo "<script language='javascript'>";
				echo "alert('密码重置成功，已发到用户邮箱！');";
				echo "location.href='a_aduser_list.php';";
				echo "</script>";
		}
	}
?>