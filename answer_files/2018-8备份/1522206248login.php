<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登陆</title>
</head>

<body>
<?php
	session_start();	//打开服务器会话
	if(isset($_SESSION['yhm'])&&$_SESSION['yhm']!="")
	{
		echo "欢迎您！".$_SESSION['yhm']."回来本系统";
		exit;
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="492" height="163" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="center" bgcolor="#FFCCCC">用户登陆</td>
    </tr>
    <tr>
      <td width="153" align="center">账号</td>
      <td width="333"><label for="uname"></label>
      <input type="text" name="uname" id="uname" /></td>
    </tr>
    <tr>
      <td align="center">密码</td>
      <td><label for="pw"></label>
      <input type="text" name="pw" id="pw" /></td>
    </tr>
    <tr>
      <td align="center">确认密码</td>
      <td><label for="pw_2"></label>
      <input type="text" name="pw_2" id="pw_2" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="ok" id="ok" value="登陆" /></td>
    </tr>
  </table>
</form>
<?php
	if(isset($_POST['ok']))
	{
		$uid=$_POST['uname'];	//用户名
		$upw=$_POST['pw'];	//密码
		$upw2=$_POST['pw_2'];//	确认密码
		if($upw===$upw2)
		{
			if($uid=='admin'&&$upw=='admin888')
			{
				$_SESSION['yhm']=$uid;	//长久保存用户名
				echo "<script>";
				echo "alert('恭喜您，登陆成功，欢迎回来');";
				echo "</script>";
				header("location:login.php");	//跳转一下
			}
			else
			{
				echo "<script>";
				echo "alert('用户名或密码错误，请重新登陆！');";
				echo "</script>";
			}
		}
		else
		{
			echo "<script>";
			echo "alert('密码确认不正确，请重新确认密码！');";
			echo "</script>";
			
		}
	}
?>
</body>
</html>