<?php
	session_start();
	if(!isset($_GET['eid']))		//���������ҵ������մ��ļ��뽲���ļ�
	{
		if(isset($_SESSION['answer']))
			$_SESSION['answer']="none";	
		if(isset($_SESSION['handout']))
			$_SESSION['handout']="none";	
	}
	$wtitle=$_POST['wtitle'];		//��ҵ����
	//$wtitle=mb_convert_encoding($wtitle,'UTF8','auto');//�����Լ������޸�
	$wtime=$_POST['wtime'];	//��ֹʱ��
	$wterm=$_POST['wterm'];	//����ѧ��
	$ext="";	//�Ͻ���׺��
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
				echo "alert('��ѡ��ѧ����Ҫ�ύ����ҵ�ļ����ͣ�');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	$needcheck=$_POST['needcheck'];	//�Ƿ����
	$require=$_POST['content'];	//��Ŀ����
	$wclass=$_POST['wclass'];	//���ð༶
	if(!isset($_POST['wtitle'])||$_POST['wtitle']=="")
	{
				echo "<script language='javascript'>";
				echo "alert('����д��ҵ���⣡');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	if(!isset($_POST['wtime'])||$_POST['wtime']=="")
	{
				echo "<script language='javascript'>";
				echo "alert('��ѡ����ҵ����Ͻ�ʱ�䣡');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	$wcourse=$_POST['couid'];	//���ÿγ�
	require("check_file.php");
	//�����Ƿ�ѡ���´��ļ����������ļ�·��
	if($_FILES['wanswer']['name']!="")
	{
		$apath=check_answerfile();	//���ļ�
	}
	else
	{
		$apath=$_SESSION['answer'];	//���ļ�
	}
	if($_FILES['whandout']['name']!="")
	{
		$hpath=check_handoutfile();	//�����ļ�
	}
	else
	{
		$hpath=$_SESSION['handout'];	//�����ļ�
	}
	require("db_connect.php");
	mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
	echo $wtitle;
	//$rs=array();	//���ݼ����
	if(!isset($_GET['eid'])){
		$sqls="insert into homeworks(w_name,w_require,w_time,w_class,w_term,w_answer,w_handout,w_cou_id,w_exten,needcheck) values(
		'{$wtitle}','{$require}','{$wtime}','{$wclass}',{$wterm},'{$apath}','{$hpath}',{$wcourse},'{$ext}',{$needcheck})";
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{		echo "<script language='javascript'>";
				echo "alert('һ����ҵ�����ɹ���');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
		}
		else
		{
			echo "һ����ҵ����ʧ��";
		}
	}
	else
	{
		$wid=$_GET['wid'];		//��ҵid
		$sqls="update homeworks set w_name='".$wtitle."',w_require='".$require."',w_time='".$wtime."',w_term=".$wterm.",w_answer='".$apath."',w_handout='".$hpath."',w_exten='".$ext."' ,needcheck={$needcheck} where w_id=".$wid;
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{		echo "<script language='javascript'>";
				echo "alert('��ҵ�޸ĳɹ���');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
		}
		else
		{
			echo "��ҵ�޸�ʧ�ܣ�";
		}
	}
?>
