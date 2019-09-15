<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
#form1 #zcxx {
	font-size: 13px;
	color: #333;
	background-color: #9BCDFF;
}
#form1 #zcxx tr td #xh {
	margin-right: 15px;
	margin-left: 15px;
	width: 250px;
}
#form1 #zcxx tr td #xm {
	margin-right: 15px;
	margin-left: 15px;
	width: 250px;
}
#form1 #zcxx tr td #mm {
	margin-right: 15px;
	margin-left: 15px;
	width: 250px;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="500" height="236" border="0" align="center" cellpadding="0" cellspacing="1" id="zcxx">
    <tr>
      <td colspan="2" bgcolor="#6699FF">注册新用户</td>
    </tr>
    <tr>
      <td width="132" align="center" bgcolor="#FFFFFF">学号</td>
      <td width="365" bgcolor="#FFFFFF"><label for="xh"></label>
      <input type="text" name="xh" id="xh" /></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">姓名</td>
      <td bgcolor="#FFFFFF"><label for="xm"></label>
      <input type="text" name="xm" id="xm" /></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">密码</td>
      <td bgcolor="#FFFFFF"><label for="mm"></label>
      <input type="text" name="mm" id="mm" /></td>
    </tr>
    <tr>
      <td height="49" colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="ok" id="ok" value="提交注册" /></td>
    </tr>
  </table>
</form>
<?php
	//连接数据库
	$db_ip="192.168.4.252";
	$db_user="root";
	$db_pw="root";
	$db_name="lyb";
	$conn=mysql_connect($db_ip,$db_user,$db_pw);
	$db=mysql_select_db($db_name,$conn);	//打开lyb数据库
	if(isset($_POST['ok']))
	{
		$xh=$_POST['xh'];
		$xm=$_POST['xm'];
		$mm=md5($_POST['mm']);
		$sqls="insert into users(uxh,uname,upass)values('".$xh."','".$xm."','".$mm."')";
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
			echo "恭喜您 注册成功，请<a href='index.php'>返回首页</a>";
		}
		else
		{
			echo "抱歉，某种原因，注册失败。请重新填写信息，<a href='zc.php'>再次注册</a>";
		}
	}
?>
</body>
</html>