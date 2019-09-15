<?php
/*------------------重置学生密码与资料------------------
@2017-6-30 21:00
sunkinglsx
------------------------------------------------------------------*/
session_start();
require("db_connect.php");
require("url_deal.php");
require("session.php");
check_asession();
$fle=url_deal($_GET['fle']);		//操作符
$sid=url_deal($_GET['sid']);		//学号
if($fle==1)		//重置密码
{
	reset_pw($sid,$conn);
}
if($fle==2)		//重置资料
{
	reset_info($sid,$conn);
}
//================定义重置密码函数=================
function reset_pw($sid,$connect)
{
	$sqls="update students set s_pass='".md5("123456")."' where s_id='".$sid."'";
	$rs=mysql_query($sqls,$connect);
	if($rs)
	{
			echo "<script language='javascript'>";
			echo "alert('密码重置成功!');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
	}
}
//=================定义重置资料函数================
function reset_info($sid,$connect)
{
	$sqls="update students set s_pass='".md5("123456")."',question='',a_answer='',email='' where s_id='".$sid."'";
	$rs=mysql_query($sqls,$connect);
	if($rs)
	{
			echo "<script language='javascript'>";
			echo "alert('资料重置成功!');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
	}
}
?>