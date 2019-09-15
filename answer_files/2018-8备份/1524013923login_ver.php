<?php
	session_start();
	if(isset($_POST['ok']))
	{
		$uid=$_POST['uname'];	//用户名
		$upw=$_POST['pw'];	//密码
		$yzm=$_POST['yzm'];//	验证码
		if($yzm===$_SESSION['yzm'])
		{
			if($uid=='admin'&&$upw=='admin888')
			{
				$_SESSION['yhm']=$uid;	//长久保存用户名
				echo "<script>";
				echo "alert('恭喜您，登陆成功，欢迎回来');";
				echo "location.href='index.php';";
				echo "</script>";
			}
			else
			{
				echo "<script>";
				echo "alert('用户名或密码错误，请重新登陆！');";
				echo "location.href='login.php';";
				echo "</script>";
			}
		}
		else
		{
			echo "<script>";
			echo "alert('验证码不正确！');";
			echo "location.href='login.php';";
			echo "</script>";
		}
	}
?>
