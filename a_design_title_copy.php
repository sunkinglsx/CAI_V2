<?php
	session_start();
	$Did=$_POST['copyto'];
	$dtid=$_POST['dtid'];
	require('db_connect.php');
	mysql_query("SET NAMES 'gb2312'");
	$sql_s_dt="select * from design_titles where DT_id=".$dtid;
	$rs=mysql_query($sql_s_dt,$conn);
	$rs_arr=mysql_fetch_array($rs);
	mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
	$sqls_copy="insert into design_titles(DT_title,D_id,DT_takers,DT_bonus,DT_demand)values(
	'".$rs_arr['DT_title']."',".$Did.",".$rs_arr['DT_takers'].",".$rs_arr['DT_bonus'].",'".$rs_arr['DT_demand']."')";
	$rs=mysql_query($sqls_copy,$conn);
	if($rs)
	{
				echo "<script language='javascript'>";
				echo "alert('һ���γ����ѡ�⸴��Ӧ�õ�ƽ�а�ɹ���');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	else
	{
				echo "<script language='javascript'>";
				echo "alert('����ԭ�����ѡ�⸴��Ӧ�õ�ƽ�а�ʧ�ܣ�');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
?>