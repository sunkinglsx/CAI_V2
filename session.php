<?php
	session_start();
	if(isset($_GET['oid']))
	{
		if($_GET['oid']==1)
		{
			session_destroy();	//注销退出
			header("location:index.php");
		}
	}
	function check_session()	//普通用户session检查
	{
		if(!isset($_SESSION['s_id'])||$_SESSION['s_id']=="")
		{
			echo "<script language='javascript'>
			window.location.href='login.php';
			</script>";
		}
	}
	function check_asession()	//管理用户session检查
	{
		if(!isset($_SESSION['a_name'])||$_SESSION['a_name']=="")
		{
			echo "<script language='javascript'>
			window.location.href='a_login.php';
			</script>";
		}
	}
	function show_welcome()	//普通用户欢迎信息
	{
		if(date("H",time())>=0&&date("H")<12)
			$noon="上午好！";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="中午好！";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="下午好！";
		else
			$noon="晚上好！";
		echo $noon."<font color='#CC0000'>".$_SESSION['s_name']."</font>同学,今天是".date("Y")."年".date("m")."月".date("d")."日&nbsp;&nbsp;&nbsp;";
		//echo "&nbsp;&nbsp;<a href='message.php?sid=".$_SESSION['s_id']."'><img src='pics/mssage.gif' width='14' height='12'>我的消息</a>";
	}
	function show_operate()	//显示操作列表
	{	
		echo "&nbsp;&nbsp;<a href='finish_info.php?e=1&r=2&sid=".$_SESSION['s_id']."' target='_blank'>‖&nbsp;修改资料</a>";
		echo "&nbsp;&nbsp;<a href='modify_pw.php'>‖&nbsp;修改密码</a>";
		echo "&nbsp;&nbsp;<a href='session.php?oid=1'>‖&nbsp;注销退出</a>&nbsp;";
	}
	function show_awelcome()	//管理员用户欢迎信息
	{
		if(date("H",time())>=0&&date("H")<12)
			$noon="上午好！";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="中午好！";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="下午好！";
		else
			$noon="晚上好！";
		echo $noon."<font color='#CC0000'>".$_SESSION['t_name']."</font>老师,今天是".date("Y")."年".date("m")."月".date("d")."日&nbsp;&nbsp;&nbsp;";
		//echo "&nbsp;&nbsp;<a href='message.php?sid=".$_SESSION['a_name']."'><img src='pics/mssage.gif' width='14' height='12'>我的消息</a>";
		echo "&nbsp;&nbsp;<a href='finish_info.php?e=1&r=1&sid=".$_SESSION['a_name']."' target='show'>‖&nbsp;修改资料</a>";
		echo "&nbsp;&nbsp;<a href='a_modify_pw.php'>‖&nbsp;修改密码</a>";
		echo "&nbsp;&nbsp;<a href='session.php?oid=1'>‖&nbsp;注销退出</a>&nbsp;";
	}
?>