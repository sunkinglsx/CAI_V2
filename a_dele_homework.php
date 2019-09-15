<?php
		session_start();
		require("url_deal.php");
		$wid=intval(url_deal($_GET['wid']));
		require("db_connect.php");
		//删除数据的同时，讲义文件与答案文件也删除
		$sqls="select w_answer,w_handout from homeworks where w_id=".$wid;
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{
			$arr_w=mysql_fetch_array($rs);
			$a_tmp=explode("/",$arr_w['w_answer']);	//求获答案文件
			$h_tmp=explode("/",$arr_w['w_handout']);	//求获讲义文件
			$a_dir=$a_tmp[0];	//答案目录	answer_files/
			$a_file=$a_tmp[1];	//答案文件
			$h_dir=$h_tmp[0];	//讲义目录	handouts/
			$h_file=$h_tmp[1];	//讲义文件
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
			echo "alert('一条作业删除成功！');";
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