<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码</title>
</head>

<body>
<?php
	session_start();
	if(!isset($_SESSION['zm'])||$_SESSION['zm']=="")
	{
		header("location:login.php");
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="531" height="139" border="0" align="center" cellpadding="0" cellspacing="1">
    <tr>
      <td colspan="2" bgcolor="#CCCCCC">修改用户密码</td>
    </tr>
    <tr>
      <td width="140" align="center">旧密码</td>
      <td width="388"><label for="jmm"></label>
      <input type="text" name="jmm" id="jmm" /></td>
    </tr>
    <tr>
      <td align="center">新密码</td>
      <td><label for="xmm"></label>
      <input type="text" name="xmm" id="xmm" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="ok" id="ok" value="确定修改" /></td>
    </tr>
  </table>
</form>
<?php
	//修改密码
	if(isset($_POST['ok']))
	{
		$db_server="192.168.4.252";
		$db_user="root";
		$db_pw="root";
		$db_name="lyb";
		$conn=mysql_connect($db_server,$db_user,$db_pw);
		$mydb=mysql_select_db($db_name,$conn);
		$jmm=md5($_POST['jmm']);
		$xmm=md5($_POST['xmm']);
		$xh=$_SESSION['xh'];
		$sqls_j="select * from users where uxh='".$xh."' and upass='".$jmm."'";
		$rs_j=mysql_query($sqls_j,$conn);
		if($rs_j&&mysql_num_rows($rs_j)>0)
		{
			$sqls_x="update users set upass='".$xmm."' where uxh='".$xh."'";
			$rs_x=mysql_query($sqls_x,$conn);
			if($rs_x)
			{
				echo "<script>
				alert('密码修改成功');
				location.href='index.php';
				</script>";
			}
			else
			{
				echo "<script>
				alert('密码修改失败，请重新修改');
				history.back();
				</script>";
			}
		}
		else
		{
			echo "<script>
			alert('旧密码错误');
			history.back();
			</script>";
		}
	}

?>
</body>
</html>