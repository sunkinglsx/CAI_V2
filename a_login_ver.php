<?php
	session_start();
	if(isset($_POST['button']))
	{
		$ucode=strtoupper(trim($_POST['check']));	//验证码
		$u_id=strtoupper(trim($_POST['uname']));	//管理用户名
		$u_pass=md5(trim($_POST['upass']));//密码
		$err=0;
		if(!isset($_SESSION['code']))	//验证码是否过期
		{
			echo "<script>alert('验证码已失效');
			location.href='a_login.php';
			</script>";
			$err=1;
		}
		else
		{
			if($ucode!=$_SESSION['code'])
			{
				echo "<script>alert('验证码错误');
						location.href='a_login.php';
				</script>";
				$err=1;
			}
		}
		if($err!=1){
			require("db_connect.php");//包含数据库连接文件
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sqls="select * from ad_user where a_name='".$u_id ."' and a_pw='".$u_pass."'";
			$rs=mysql_query($sqls,$conn);
			if(mysql_num_rows($rs)==0)
			{
					echo "<script language='javascript'>";
					echo "alert('用户名或密码错误！请重新登陆');";
					echo "location.href='a_login.php';";
					echo "</script>";
			}
			else
			{
					$arr=mysql_fetch_array($rs);	//转换为数组
					//检查用户有效期是否过期
					if(strtotime($arr['end_time'])<time())
					{
							echo "<script language='javascript'>";
							echo "alert('对不起，您的账户已过期，请联系管理员续期！');";
							echo "location.href='index.php';";
							echo "</script>";
							exit;
					}
					else
					{
						$_SESSION['a_name']=$arr['a_name'];
						$_SESSION['a_right']=$arr['a_right'];
						$_SESSION['t_name']=$arr['t_name'];
						$_SESSION['email']=$arr['email'];
						$_SESSION['a_answer']=$arr['a_answer'];
						$_SESSION['question']=$arr['question'];
						if($arr['email']==""||$arr['question']==""||$arr['a_answer']=="")
						{
							header("location:finish_info.php?sid=".$arr['a_name']."&r=1");
						}
						else
						{
							header("location:a_index.php");
						}
					}
			}
			mysql_close($conn);
		}
	}
?>
