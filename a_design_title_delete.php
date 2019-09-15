<?php 
		session_start();
		require('url_deal.php');
		require('db_connect.php');
		$dtid=url_deal($_GET['dtid']);
		$sqls="delete from design_titles where DT_id=".$dtid;
		$rs=mysql_query($sqls,$conn	);
		if($rs)
		{
				echo "<script language='javascript'>";
				echo "alert('选题信息删除成功！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
 		}
		else
		{
				echo "<script language='javascript'>";
				echo "alert('选题信息删除失败！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
 		}
?>