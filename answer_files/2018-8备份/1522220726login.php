<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登陆</title>
</head>

<body>
<?php
	session_start();
	if(isset($_SESSION['yhm'])&&$_SESSION['yhm']!="")
	{
		echo "欢迎您，".$_SESSION['yhm']."，今天是：".date("Y-m-d",time());
		exit;	//结束
	}
?>
<form action="" method="post">
<table border="1" cellpadding="0" cellspacing="0" align="center" width="400px" height="120px">
    <tr> <td colspan="2">    用户登陆</td> </tr>
    <tr> <td>用户名：</td> <td><input type="text" name="yhm" /></td> </tr>
    <tr> <td>密码:</td> <td> <input type="password" name="mm" /></td></tr>
    <tr> <td colspan="2" align="center">  <input type="submit" name="ok" value="登陆" /></td></tr>
</table>
</form>
<?php
	if(isset($_POST['ok']))	//判断是否点击登陆按钮
	{
		$uname=$_POST['yhm'];	//用户名
		$upw=$_POST['mm'];		//密码
		if($uname==='admin'&&$upw==='admin888')
		{
			$_SESSION['yhm']=$uname;
			echo "<script>";
			echo "alert('恭喜您，登陆成功，欢迎您回来!');";
			echo "</script>";
			header("location:login.php");	//跳转到当前文件，写你自己的当前文件名
		}
		else
		{
			echo "<script>";
			echo "alert('用户名或密码不正确，请重新输入登陆!');";
			echo "</script>";
		}
	}

?>
</body>
</html>