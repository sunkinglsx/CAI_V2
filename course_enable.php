<?php
	require("session.php");
	check_asession();
	require("db_connect.php");
	require("url_deal.php");
	$couid=url_deal($_GET['couid']);
	$oid=url_deal($_GET['o']);
	if($oid==0)	//关闭课程操作
		$sqls="update course set cou_enable=0 where cou_id=".$couid;
	elseif($oid==1)	//开启
		$sqls="update course set cou_enable=1 where cou_id=".$couid;
	$rs=mysql_query($sqls,$conn);
	if($rs)
	{
		echo "<script language='javascript'>";
		echo "location.href='class_list.php?furl=2';";
		echo "</script>";
	}
	else
	{
				echo "<script language='javascript'>";
				echo "alert('课程科目的开关操作失败');";
				echo "location.href='class_list.php?furl=2';";
				echo "</script>";
	}
?>