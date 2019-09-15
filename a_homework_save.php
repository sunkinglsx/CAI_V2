<?php
	session_start();
	if(!isset($_GET['eid']))		//如果是新作业，先清空答案文件与讲义文件
	{
		if(isset($_SESSION['answer']))
			$_SESSION['answer']="none";	
		if(isset($_SESSION['handout']))
			$_SESSION['handout']="none";	
	}
	$wtitle=$_POST['wtitle'];		//作业标题
	//$wtitle=mb_convert_encoding($wtitle,'UTF8','auto');//根据自己编码修改
	$wtime=$_POST['wtime'];	//截止时间
	$wterm=$_POST['wterm'];	//适用学期
	$ext="";	//上交后缀名
	if(isset($_POST['ext']))
	{
		foreach($_POST['ext'] as $e)
		{
			$ext.=$e."#";
		}
		$ext=substr($ext,0,strlen($ext)-1);
	}
	else
	{
				echo "<script language='javascript'>";
				echo "alert('请选择学生需要提交的作业文件类型！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	$needcheck=$_POST['needcheck'];	//是否查重
	$require=$_POST['content'];	//题目描述
	$wclass=$_POST['wclass'];	//适用班级
	if(!isset($_POST['wtitle'])||$_POST['wtitle']=="")
	{
				echo "<script language='javascript'>";
				echo "alert('请填写作业标题！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	if(!isset($_POST['wtime'])||$_POST['wtime']=="")
	{
				echo "<script language='javascript'>";
				echo "alert('请选择作业最后上交时间！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	$wcourse=$_POST['couid'];	//适用课程
	require("check_file.php");
	//根据是否选择新答案文件，决定答案文件路径
	if($_FILES['wanswer']['name']!="")
	{
		$apath=check_answerfile();	//答案文件
	}
	else
	{
		$apath=$_SESSION['answer'];	//答案文件
	}
	if($_FILES['whandout']['name']!="")
	{
		$hpath=check_handoutfile();	//讲义文件
	}
	else
	{
		$hpath=$_SESSION['handout'];	//讲义文件
	}
	require("db_connect.php");
	mysql_query("SET NAMES 'gbk'");	//与数据库一致
	echo $wtitle;
	//$rs=array();	//数据集结果
	if(!isset($_GET['eid'])){
		$sqls="insert into homeworks(w_name,w_require,w_time,w_class,w_term,w_answer,w_handout,w_cou_id,w_exten,needcheck) values(
		'{$wtitle}','{$require}','{$wtime}','{$wclass}',{$wterm},'{$apath}','{$hpath}',{$wcourse},'{$ext}',{$needcheck})";
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{		echo "<script language='javascript'>";
				echo "alert('一条作业发布成功！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
		}
		else
		{
			echo "一条作业发布失败";
		}
	}
	else
	{
		$wid=$_GET['wid'];		//作业id
		$sqls="update homeworks set w_name='".$wtitle."',w_require='".$require."',w_time='".$wtime."',w_term=".$wterm.",w_answer='".$apath."',w_handout='".$hpath."',w_exten='".$ext."' ,needcheck={$needcheck} where w_id=".$wid;
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{		echo "<script language='javascript'>";
				echo "alert('作业修改成功！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
		}
		else
		{
			echo "作业修改失败！";
		}
	}
?>
