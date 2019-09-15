<?php 
		session_start();
		require('url_deal.php');
		require('db_connect.php');
		$did=url_deal($_GET['did']);
		$sqls="delete from course_design where D_ID=".$did;
		$rs=mysql_query($sqls,$conn	);
		if($rs)
		{
				echo "<script language='javascript'>";
				echo "alert('课程设计项目信息删除成功！');";
				echo "location.href='a_design_list.php';";
				echo "</script>";
				exit;
 		}
		else
		{
				echo "<script language='javascript'>";
				echo "alert('课程设计项目信息删除失败！');";
				echo "location.href='a_design_list.php';";
				echo "</script>";
				exit;
 		}
?>