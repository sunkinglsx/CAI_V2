<?php
/*------------------����ѧ������������------------------
@2017-6-30 21:00
sunkinglsx
------------------------------------------------------------------*/
session_start();
require("db_connect.php");
require("url_deal.php");
require("session.php");
check_asession();
$fle=url_deal($_GET['fle']);		//������
$sid=url_deal($_GET['sid']);		//ѧ��
if($fle==1)		//��������
{
	reset_pw($sid,$conn);
}
if($fle==2)		//��������
{
	reset_info($sid,$conn);
}
//================�����������뺯��=================
function reset_pw($sid,$connect)
{
	$sqls="update students set s_pass='".md5("123456")."' where s_id='".$sid."'";
	$rs=mysql_query($sqls,$connect);
	if($rs)
	{
			echo "<script language='javascript'>";
			echo "alert('�������óɹ�!');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
	}
}
//=================�����������Ϻ���================
function reset_info($sid,$connect)
{
	$sqls="update students set s_pass='".md5("123456")."',question='',a_answer='',email='' where s_id='".$sid."'";
	$rs=mysql_query($sqls,$connect);
	if($rs)
	{
			echo "<script language='javascript'>";
			echo "alert('�������óɹ�!');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
	}
}
?>