<?php
	session_start();
	if(isset($_GET['oid']))
	{
		if($_GET['oid']==1)
		{
			session_destroy();	//ע���˳�
			header("location:index.php");
		}
	}
	function check_session()	//��ͨ�û�session���
	{
		if(!isset($_SESSION['s_id'])||$_SESSION['s_id']=="")
		{
			echo "<script language='javascript'>
			window.location.href='login.php';
			</script>";
		}
	}
	function check_asession()	//�����û�session���
	{
		if(!isset($_SESSION['a_name'])||$_SESSION['a_name']=="")
		{
			echo "<script language='javascript'>
			window.location.href='a_login.php';
			</script>";
		}
	}
	function show_welcome()	//��ͨ�û���ӭ��Ϣ
	{
		if(date("H",time())>=0&&date("H")<12)
			$noon="����ã�";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="����ã�";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="����ã�";
		else
			$noon="���Ϻã�";
		echo $noon."<font color='#CC0000'>".$_SESSION['s_name']."</font>ͬѧ,������".date("Y")."��".date("m")."��".date("d")."��&nbsp;&nbsp;&nbsp;";
		//echo "&nbsp;&nbsp;<a href='message.php?sid=".$_SESSION['s_id']."'><img src='pics/mssage.gif' width='14' height='12'>�ҵ���Ϣ</a>";
	}
	function show_operate()	//��ʾ�����б�
	{	
		echo "&nbsp;&nbsp;<a href='finish_info.php?e=1&r=2&sid=".$_SESSION['s_id']."' target='_blank'>��&nbsp;�޸�����</a>";
		echo "&nbsp;&nbsp;<a href='modify_pw.php'>��&nbsp;�޸�����</a>";
		echo "&nbsp;&nbsp;<a href='session.php?oid=1'>��&nbsp;ע���˳�</a>&nbsp;";
	}
	function show_awelcome()	//����Ա�û���ӭ��Ϣ
	{
		if(date("H",time())>=0&&date("H")<12)
			$noon="����ã�";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="����ã�";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="����ã�";
		else
			$noon="���Ϻã�";
		echo $noon."<font color='#CC0000'>".$_SESSION['t_name']."</font>��ʦ,������".date("Y")."��".date("m")."��".date("d")."��&nbsp;&nbsp;&nbsp;";
		//echo "&nbsp;&nbsp;<a href='message.php?sid=".$_SESSION['a_name']."'><img src='pics/mssage.gif' width='14' height='12'>�ҵ���Ϣ</a>";
		echo "&nbsp;&nbsp;<a href='finish_info.php?e=1&r=1&sid=".$_SESSION['a_name']."' target='show'>��&nbsp;�޸�����</a>";
		echo "&nbsp;&nbsp;<a href='a_modify_pw.php'>��&nbsp;�޸�����</a>";
		echo "&nbsp;&nbsp;<a href='session.php?oid=1'>��&nbsp;ע���˳�</a>&nbsp;";
	}
?>