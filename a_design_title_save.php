<?php
	session_start();
	$dt_title=$_POST['dt_name'];	//标题
	if(isset($_GET['dtid']))	//来自新发选题
		$dtid=$_GET['dtid'];
	$classid=$_POST['classid'];
	$did=$_POST['did'];	//项目ID
	$dname=$_POST['dname'];
	$dt_takers=$_POST['takers'];//可选人数
	$dt_bonus=$_POST['bonus'];	//加分
	$dt_demand=$_POST['content'];	//要求
	if($dt_title==""||$dt_bonus==""||$dt_takers==""||$dt_demand=="")
	{
				echo "<script language='javascript'>";
				echo "alert('课程选题信息不完整！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	if(!isset($dt_bonus)||!isset($dt_demand)||!isset($dt_takers)||!isset($dt_title))
	{
				echo "<script language='javascript'>";
				echo "alert('课程选题信息不完整！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	require('db_connect.php');
			mysql_query("SET NAMES 'gbk'");	//与数据库一致
	if(isset($_GET['dtid']))
	{
		$sqls="update design_titles set DT_title='".$dt_title."',DT_takers=".$dt_takers.",DT_bonus=".$dt_bonus.",DT_demand='".$dt_demand."' where DT_id=".$dtid;
		$alert_s="一条课程选题信息修改完成！";
		$alert_f="课程选题信息修改失败，请检查原因！";
	}
	else
	{
		$sqls="insert into design_titles(DT_title,D_id,DT_takers,DT_bonus,DT_demand)values('".$dt_title."',
		".$did.",".$dt_takers.",".$dt_bonus.",'".$dt_demand."')";
		$alert_s="一条课程选题信息添加完成！";
		$alert_f="课程选题信息添加失败，请检查原因！";
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