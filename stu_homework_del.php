<?php
		session_start();
		require("url_deal.php");
		$wid=intval(url_deal($_GET['id']));
		require("db_connect.php");
		//ɾ���ظ���ѧ����ҵ
		$sqls="delete  from stu_works where  id=".$wid;
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
			echo "<script language='javascript'>";
			echo "alert('һ��ѧ����ҵɾ���ɹ���');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
		}
		else
		{
			echo "<script language='javascript'>";
			echo "alert('δ֪ԭ����ҵɾ��ʧ�ܣ�');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
		}
?>