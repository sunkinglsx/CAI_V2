<?php
	session_start();
	$dt_title=$_POST['dt_name'];	//����
	if(isset($_GET['dtid']))	//�����·�ѡ��
		$dtid=$_GET['dtid'];
	$classid=$_POST['classid'];
	$did=$_POST['did'];	//��ĿID
	$dname=$_POST['dname'];
	$dt_takers=$_POST['takers'];//��ѡ����
	$dt_bonus=$_POST['bonus'];	//�ӷ�
	$dt_demand=$_POST['content'];	//Ҫ��
	if($dt_title==""||$dt_bonus==""||$dt_takers==""||$dt_demand=="")
	{
				echo "<script language='javascript'>";
				echo "alert('�γ�ѡ����Ϣ��������');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	if(!isset($dt_bonus)||!isset($dt_demand)||!isset($dt_takers)||!isset($dt_title))
	{
				echo "<script language='javascript'>";
				echo "alert('�γ�ѡ����Ϣ��������');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	require('db_connect.php');
			mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
	if(isset($_GET['dtid']))
	{
		$sqls="update design_titles set DT_title='".$dt_title."',DT_takers=".$dt_takers.",DT_bonus=".$dt_bonus.",DT_demand='".$dt_demand."' where DT_id=".$dtid;
		$alert_s="һ���γ�ѡ����Ϣ�޸���ɣ�";
		$alert_f="�γ�ѡ����Ϣ�޸�ʧ�ܣ�����ԭ��";
	}
	else
	{
		$sqls="insert into design_titles(DT_title,D_id,DT_takers,DT_bonus,DT_demand)values('".$dt_title."',
		".$did.",".$dt_takers.",".$dt_bonus.",'".$dt_demand."')";
		$alert_s="һ���γ�ѡ����Ϣ�����ɣ�";
		$alert_f="�γ�ѡ����Ϣ���ʧ�ܣ�����ԭ��";
	}
	$rs=mysql_query($sqls,$conn);
	if($rs)
	{
				echo "<script language='javascript'>";
				echo "alert('".$alert_s."');";
				echo "location.href='a_design_title_list.php?did=".$did."&classid=".$classid."&dname=".$dname."';";
				echo "</script>";
	}
	else
	{
				echo "<script language='javascript'>";
				echo "alert('".$alert_f."');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
?>