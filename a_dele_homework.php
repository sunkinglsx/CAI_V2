<?php
		session_start();
		require("url_deal.php");
		$wid=intval(url_deal($_GET['wid']));
		require("db_connect.php");
		//ɾ�����ݵ�ͬʱ�������ļ�����ļ�Ҳɾ��
		$sqls="select w_answer,w_handout from homeworks where w_id=".$wid;
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
			$arr_w=mysql_fetch_array($rs);
			$a_tmp=explode("/",$arr_w['w_answer']);	//�����ļ�
			$h_tmp=explode("/",$arr_w['w_handout']);	//������ļ�
			$a_dir=$a_tmp[0];	//��Ŀ¼	answer_files/
			$a_file=$a_tmp[1];	//���ļ�
			$h_dir=$h_tmp[0];	//����Ŀ¼	handouts/
			$h_file=$h_tmp[1];	//�����ļ�
			if(is_dir($a_dir))
			{
				chdir($a_dir);
				if(file_exists($a_file))
				{
					unlink($a_file);
				}
			}
			chdir("../");
			if(is_dir($h_dir))
			{
				chdir($h_dir);
				if(file_exists($h_file))
				{
					unlink($h_file);
				}
			}
		}
		$sqls="delete  from homeworks where w_id=".$wid;
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
			echo "<script language='javascript'>";
			echo "alert('һ����ҵɾ���ɹ���');";
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