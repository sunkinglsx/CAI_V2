<?php 
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	require("term.php");
	//$couid=$_GET['couid'];	//课程号
	if(isset($_POST['button']))		//复制到平行班级同门课程
	{
		$work_id=array();
		if(isset($_POST['se']))
		{
			foreach($_POST['se'] as $k)
			{
				if($k!="")
				{
					array_push($work_id,$k);	//作业号入栈
				}
			}
		}
		else
		{
				echo "<script language='javascript'>";
				echo "alert('请选择需要复制的作业！');";
				echo "window.history.back(-1);";
				echo "</script>";
		}
		$cid=$_POST['class_list'];	//班级号
		$couname=$_POST['couname'];	//课程名
		$term=term($cid);	//求出该班的学期
		//查出目标班级中，该门课程的id号
		$sqls="select cou_id from course where cou_name='".$couname."' and class_id='".$cid."' and cou_teacher='".$_SESSION['a_name']."'";
		$rs=mysql_query($sqls,$conn);
		$tmp=mysql_fetch_array($rs);
		$couid=$tmp['cou_id'];
		//开始复制
		$i=1;
		foreach($work_id as $w)
		{
			$sqls="select * from homeworks where w_id=".$w;
			$rs=mysql_query($sqls,$conn);
			$arr=mysql_fetch_array($rs);
			print_r($arr);
			mysql_query("SET NAMES 'gbk'");	//与数据库一致
			$copy_sqls="insert into homeworks(w_name,w_cou_id,w_require,w_time,w_class,w_term,w_answer,w_handout,w_exten)
			values('".$arr['w_name']."',".$couid.",'".$arr['w_require']."','".$arr['w_time']."','".$cid."',".$term.",'".$arr['w_answer']."',
			'".$arr['w_handout']."','".$arr['w_exten']."')";
			$rs=mysql_query($copy_sqls,$conn);
			if(!$rs)
			{	echo "第".$i."条作业复制失败";
				exit;
			}$i++;
		}
				echo "<script language='javascript'>";
				echo "alert('".$i."条作业需要到目标班级成功！');";
				echo "window.history.back(-1);";
				echo "</script>";
	}
?>
