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
				echo "alert('�γ������Ŀ��Ϣɾ���ɹ���');";
				echo "location.href='a_design_list.php';";
				echo "</script>";
				exit;
 		}
		else
		{
				echo "<script language='javascript'>";
				echo "alert('�γ������Ŀ��Ϣɾ��ʧ�ܣ�');";
				echo "location.href='a_design_list.php';";
				echo "</script>";
				exit;
 		}
?>