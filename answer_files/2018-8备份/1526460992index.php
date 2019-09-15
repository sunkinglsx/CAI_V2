<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言板</title>
<style type="text/css">
#yhxx {
	font-size: 13px;
	color: #333;
	background-color: #A0AEFC;
}
#yhxx tr td a {
	font-size: 13px;
	color: #333;
	text-decoration: none;
	background-color:#FFF;
	border:0px;
}
#yhxx tr td a:hover {
	font-size: 13px;
	color: #C00;
	text-decoration: none;
}
#ly {
	font-size: 13px;
	color: #336;
	text-decoration: none;
	background-color: #99C;
}

a:link {
	font-size: 13px;
	color: #FFF;
	text-decoration: none;
	background-color: #06C;
	padding-top: 3px;
	padding-right: 10px;
	padding-bottom: 3px;
	padding-left: 10px;
	border: 1px solid #06C;
}
a:visited {
	font-size: 13px;
	color: #FFF;
	text-decoration: none;
	background-color: #06C;
	padding-top: 3px;
	padding-right: 10px;
	padding-bottom: 3px;
	padding-left: 10px;
	border: 1px solid #06C;
}
a:hover {
	font-size: 13px;
	color: #FF0;
	text-decoration: none;
	background-color: #36F;
}
body {
	background-color: #C8C8C8;
}
</style>
</head>

<body>
<table width="1000" height="34" border="0" align="center" cellpadding="0" cellspacing="1" id="yhxx">
  <tr>
    <td width="293" height="32" align="center" bgcolor="#FFFFFF">
    <?php
		session_start();
		if(isset($_SESSION['xh'])&&$_SESSION['xh']!="")
		{
			echo "欢迎您回来！".$_SESSION['zm'];
		}
		else
		{
			echo "您未登录，请先<a href='login.php'>点击登录</a>";
		}
	
	?>
    </td>
    <td width="202" align="center" bgcolor="#FFFFFF"><a href="zc.php">我要注册</a></td>
    <td width="155" align="center" bgcolor="#FFFFFF">
    <?php
		if(isset($_SESSION['xh'])&&$_SESSION['xh']!="")
		{
			echo "<a href='loginout.php'>注销登录</a>";
		}
	?>
    </td>
    <td width="162" align="center" bgcolor="#FFFFFF"><a href="lyb.php">我要留言</a></td>
    <td width="182" align="center" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
<?php
	//连接数据库
	$db_server="192.168.4.252";
	$db_user="root";
	$db_pw="root";
	$db_name="lyb";
	$conn=mysql_connect($db_server,$db_user,$db_pw);
	$mydb=mysql_select_db($db_name,$conn);
	mysql_query("SET NAMES 'gbk'");
	$sqls="select * from board order by boardtime desc";		//查出全部留言内容，按时间降序排序
	$rs=mysql_query($sqls,$conn);
	if(!isset($rs)||mysql_num_rows($rs)==0)
	{
		echo "暂无任何留言，欢迎您留言";
		exit;
	}
	else
	{
		$lyzs=mysql_num_rows($rs);		//计算留言的总数有多少条
		if(isset($_GET['p']))
		{
			$p=$_GET['p'];	//获取指定的页码
		}
		else
		{
			$p=1;	//默认显示第一页
		}
		$ys=ceil($lyzs/5);	//计算页数
		$sqls="select * from board order by boardtime desc limit ".(($p-1)*5).",5";
		$rs=mysql_query($sqls,$conn);
		$dqlys=mysql_num_rows($rs);
		for($i=0;$i<$dqlys;$i++)
		{
			$lyxx=mysql_fetch_array($rs);
?>
<br />
<table width="1000" height="190" border="0" align="center" cellspacing="1" id="ly">
  <tr>
    <td width="65" height="35" align="center" bgcolor="#D8DDEB">【<?php echo $lyxx['boardid'];?>】</td>
    <td width="173" bgcolor="#D8DDEB">学号：<?php echo $lyxx['boardxh'];?></td>
    <td width="214" bgcolor="#D8DDEB">真名：<?php echo $lyxx['boardzm'];?></td>
    <td width="543" bgcolor="#D8DDEB">标题：<?php echo $lyxx['boardbt'];?></td>
  </tr>
  <tr>
    <td height="115" colspan="4" bgcolor="#FFFFFF"><?php echo $lyxx['boardnr'];?></td>
  </tr>
  <tr>
    <td height="35" colspan="2" align="left" bgcolor="#FFFFFF">留言时间：<?php echo $lyxx['boardtime'];?></td>
    <td height="35" align="left" bgcolor="#FFFFFF">作者邮箱：<?php echo $lyxx['boardmail'];?></td>
    <td height="35" align="left" bgcolor="#FFFFFF">作者主页：<?php echo $lyxx['boardweb'];?></td>
  </tr>
</table>
<?php
		}
		echo "<p align='center'>";
		for($j=1;$j<=$ys;$j++)
		{
			echo "<a href='index.php?p=".$j."'>第".$j."页</a>&nbsp;";
		}
		echo "</p>";
	}
?>
</body>
</html>