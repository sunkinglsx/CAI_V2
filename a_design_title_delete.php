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
				echo "alert('ѡ����Ϣɾ���ɹ���');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
 		}
		else
		{
				echo "<script language='javascript'>";
				echo "alert('ѡ����Ϣɾ��ʧ�ܣ�');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
 		}
?>