<?php
/////////////作业批阅========================
	//获取学生作业id号
	session_start();
	$arr_id=array();	//ID号数组
	$arr_score=array(); //分数数组 
	$deal_false=0;	//批阅失败的数量
	$deal_sucess=0;	//批阅成功的数量
	if(isset($_POST['button']))		//如果是提交批阅，即是批量处理
	{
		$fen=$_POST['fen'];	//评价等级
		foreach($_POST['deal'] as $id)
		{
			if($id!="")
			{
				array_push($arr_id,$id);	//入栈
				array_push($arr_score,$fen);
			}
		}
	}
	else		//否则，单条处理
	{
		$id=$_GET['wid'];		//获取URL中的作业ID
		$fen=$_GET['fen'];	//获取URL中的分数值
		array_push($arr_id,$id);		//入栈
		array_push($arr_score,$fen);
	}
	if(count($arr_id)==0)
	{
			echo "<script language='javascript'>";
			echo "alert('你没有选择任何学生作业！');";
			echo "window.history.back(-1);";
			echo "</script>";
	}
	else
	{
		require("db_connect.php");
		foreach($arr_id as $key=>$id)		//更新数据表中is_deal字段
		{
			$sqls="update stu_works set is_deal=".$arr_score[$key]." where id=".$id;
			$rs=mysql_query($sqls,$conn);
			if(!$rs)
			{
				$deal_false+=1;
			}
			else
			{
				$deal_sucess+=1;
			}
		}
		//返回处理结果
			echo "<script language='javascript'>";
			echo "alert('批阅完毕！一共成功".$deal_sucess."条，失败".$deal_false."条');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
	}
?>