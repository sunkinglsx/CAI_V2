<?php
		session_start();
		if(!isset($_SESSION['a_name']))	//登陆是否过期
		{
			echo "<script>alert('请先登陆再修改密码');
			window.location.href='a_login.php';
			</script>";
		}
		else
		{
			$u_id=$_SESSION['a_name'];
		}
	if(isset($_POST['button']))
	{
		$oupass=md5(trim($_POST['oupass']));	//旧密码
		$nupass=md5(trim($_POST['nupass']));	//新密码
		$nupass_2=md5(trim($_POST['nupass_2']));//新密码确认
			require("db_connect.php");//包含数据库连接文件
			$sqls="select * from ad_user where a_name='".$u_id ."' and a_pw='".$oupass."'";
			$rs=mysql_query($sqls,$conn);
			if(mysql_num_rows($rs)==0)
			{
					echo "<script language='javascript'>";
					echo "alert('旧密码错误！请重新输入旧密码');";
					echo "window.history.back(-1);";
					echo "</script>";
			}
			else
			{
					mysql_query("SET NAMES 'gbk'");	//与数据库一致
					$sqls="update ad_user set a_pw='".$nupass."' where a_name='".$u_id ."'";
					$rs=mysql_query($sqls,$conn);
				mysql_query("SET NAMES 'gb2312'");	//与页面编码一致
					if($rs)
					{
						echo "<script language='javascript'>";
						echo "alert('密码修改成功！');";
						echo "window.location.href='a_index.php';";
						echo "</script>";
					}
					else
					{
						echo "<script language='javascript'>";
						echo "alert('密码修改失败，请检查旧密码是否正确');";
						echo "window.history.back(-1);";
						echo "</script>";
					}
			}
			mysql_close($conn);
	}
?>