<?php
	setcookie(session_id(),session_name(),NULL,NULL,NULL,NULL,TRUE);
	session_start();
	if(isset($_POST['button']))
	{
		$ucode=strtoupper(trim($_POST['check']));	//验证码
		$u_id=strtoupper(trim($_POST['uname']));	//学号
		$u_pass=md5(trim($_POST['upass']));//密码
		$err=0;
		if(!isset($_SESSION['code']))	//验证码是否过期
		{
			echo "<script>alert('验证码已失效');
			location.href='index.php';
			</script>";
			$err=1;
		}
		else
		{
			if($ucode!=$_SESSION['code'])
			{
				echo "<script>alert('验证码错误');
				location.href='index.php';
				</script>";
				$err=1;
			}
		}
		if($err!=1){
			require("db_connect.php");//包含数据库连接文件
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sqls="select * from students where s_id='".$u_id ."' and s_pass='".$u_pass."'";
			$rs=mysql_query($sqls,$conn);
			if(mysql_num_rows($rs)==0)
			{
					echo "<script language='javascript'>";
					echo "alert('用户名或密码错误！请重新登陆');";
					echo "location.href='index.php';";
					echo "</script>";
			}
			else
			{
					$arr=mysql_fetch_array($rs);	//转换为数组
					$_SESSION['s_id']=$arr['s_id'];
					$_SESSION['s_name']=$arr['s_name'];
					$_SESSION['s_class']=$arr['s_class'];
					$_SESSION['email']=$arr['email'];
					$_SESSION['s_answer']=$arr['s_answer'];
					$_SESSION['question']=$arr['question'];
					if($arr['email']==""||$arr['question']==""||$arr['a_answer']=="")
					{
						echo "<script language='javascript'>";
						echo "window.location.href='finish_info.php?sid=".$arr['s_id']."&r=2';";
						echo "</script>";
					}
					else
					{
						header("location:course_list.php");
					}
			}
			mysql_close($conn);
		}
	}

?>