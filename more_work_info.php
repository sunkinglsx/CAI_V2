<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ҵ����ϵͳ&mdash;��ҵ����</title>
<style type="text/css">
#t_main {
	background-color: #CCC;
	font-size: 12px;
	width:100%;
	margin-top:20px;
}
.red_txt {
	font-size: 13px;
	font-weight: bold;
	color: #C00;
	text-decoration: none;
}
a:link {
	font-size: 13px;
	background-color: #E3E3E3;
	padding-top: 5px;
	padding-right: 15px;
	padding-bottom: 5px;
	padding-left: 15px;
	border: 1px solid #999;
	text-decoration: none;
}
a:visited {
	font-size: 13px;
	color: #666;
	text-decoration: none;
	background-color: #D9D9D9;
	padding-top: 5px;
	padding-right: 15px;
	padding-bottom: 5px;
	padding-left: 15px;
	border: 1px solid #999;
}
a:hover {
	font-size: 13px;
	font-weight: bold;
	color: #339;
	text-decoration: none;
	background-color: #FFC;
	padding-top: 5px;
	padding-right: 15px;
	padding-bottom: 5px;
	padding-left: 15px;
	border: 1px solid #C60;
}
</style>
</head>

<body>
<?php
	require("session.php");
	check_session();
	require("url_deal.php");
	if(isset($_GET['couid']))		//�γ̺�
	{
		$couid=url_deal($_GET['couid']);
		if(intval($couid)!=$couid)
		{
			echo "url�������󣬴�����ֹ";
			exit;
		}
	}
	if(isset($_GET['wid']))		//��ҵ��
	{
		$wid=url_deal($_GET['wid']);
		if(intval($wid)!=$wid)
		{
			echo "url�������󣬴�����ֹ";
			exit;
		}
	}
	if(isset($_GET['t']))		//ѧ��
	{
		$t=url_deal($_GET['t']);
		if(intval($t)!=$t)
		{
			echo "url�������󣬴�����ֹ";
			exit;
		}
	}
	if(isset($_GET['oid']))		//�Ƿ����ύ��
	{
		$oid=url_deal($_GET['oid']);
		if(intval($oid)!=$oid)
		{
			echo "url�������󣬴�����ֹ";
			exit;
		}
	}
	require("db_connect.php");		//���ݿ�
	mysql_query("SET NAMES 'gb2312'");
	$sqls="select * from homeworks where w_id=".$wid;
	$wrs=mysql_query($sqls,$conn);
	if(!$wrs)
	{
		echo "δ�ҵ�������ҵ��ϸ����";
		exit;
	}
	else
	{
			$w_arr=mysql_fetch_array($wrs);	//ת��Ϊ����
	}
?>
<table width="100%" height="278" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="45" colspan="5" align="center" bgcolor="#CCCCFF"><img src="pics/winfo.jpg" width="184" height="45" /></td>
  </tr>
  <tr>
    <td width="318" height="28" align="center" bgcolor="#FFFFFF">��ҵ���ƣ�<span class="red_txt"><?php echo $w_arr['w_name'];?></span></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF">��ֹʱ��: <span class="red_txt"><?php echo $w_arr['w_time'];?></span></td>
    <td width="257" colspan="2" align="center" bgcolor="#FFFFFF">���ð༶��<span class="red_txt"><?php echo $w_arr['w_class'];?></span></td>
  </tr>
  <tr>
    <td height="158" colspan="5" valign="top" bgcolor="#EBF4F5"><p>������Ҫ��</p>
    <p><?php echo $w_arr['w_require'];?></p></td>
  </tr>
  <tr>
    <td height="42" colspan="5" align="center" bgcolor="#CCCCFF">
    <?php 
		$wtime=strtotime($w_arr['w_time']);
		if($oid==0&&$wtime>time())
			{echo "<a href='homework_submit.php?couid=".$couid."&wid=".$wid."&t=".$t."'>�����ύ</a>";}
		else
		{
			echo "<a href='#'>������ɱ�����ҵ</a>";
		}
	?>
    </td>
  </tr>
</table><br />
<?php 
	require("about.html");
	?>
</body>
</html>