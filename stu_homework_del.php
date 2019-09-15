<?php
		session_start();
		require("url_deal.php");
		$wid=intval(url_deal($_GET['id']));
		require("db_connect.php");
		//删除重复的学生作业
		$sqls="delete  from stu_works where  id=".$wid;
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
			echo "<script language='javascript'>";
			echo "alert('一条学生作业删除成功！');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
		}
		else
		{
			echo "<script language='javascript'>";
			echo "alert('未知原因，作业删除失败！');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
		}
?>