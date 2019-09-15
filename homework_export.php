<?php
session_start();
$cid=$_POST['cid'];
$couid=$_POST['couid'];

//作业成绩导出函数
//function homework_export($cid,$couid){
	require('PHPExcel/PHPExcel.php');
	require("db_connect.php");
	mysql_query("SET NAMES 'utf8'");
	require("term.php");
	$term=term($cid);
	//创建EXCEL对象
	$excel = new PHPExcel();
	$letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U');		//Excel表格式
	$tableheader=array();
	$tableheader[0]= '学号';$tableheader[1]='姓名';	//表头数组
	$homework_id=array();	//作业id
	//本学期该课程全部作业
	$sqls="select w_id,w_name from homeworks where w_cou_id=".$couid." order by w_id";
	$rs=mysql_query($sqls,$conn);
	if(isset($rs)&&mysql_num_rows($rs)>0)
	{
		for($i=0;$i<mysql_num_rows($rs);$i++)
		{
			$w=mysql_fetch_array($rs);
			$tableheader[$i+2]=$w[1];	//作业名称加入表头数组
			$homework_id[$i]=$w[0];		//作业id
		//	echo $homework_id[$i];
		}
			$homework_num=mysql_num_rows($rs);		//作业次数
			$tableheader[$i+2]="平均分";		//最后增加一个平均分列
			$tableheader[0]=iconv("gb2312","utf-8",$tableheader[0]);		//国标码转换为utf编码
			$tableheader[1]=iconv("gb2312","utf-8",$tableheader[1]);
			$tableheader[$i+2]=iconv("gb2312","utf-8",$tableheader[$i+2]);
		//填充表头信息
		for($i = 0;$i <count($tableheader);$i++) {
		$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
		}
		//学生作业情况填充表格信息
		$students=array();//学生作业完成情况	,二维
		$sqls="select s_id,s_name from students where s_class='".$cid."' order by s_id asc";		//学生姓名学号列表
		$rs=mysql_query($sqls,$conn);
		if(!$rs||mysql_num_rows($rs)==0)
		{
			echo "<script language='javascript'>";
			echo "alert('该班没有提供学生名单');";
			echo "window.history.back(-1);";
			echo "</script>";
//			return ;
		}
		else
		{
			$s_num=mysql_num_rows($rs);	//人数
			for($i=0;$i<mysql_num_rows($rs);$i++)
			{
				$s=mysql_fetch_array($rs);
				$students[$i][0]=$s[0];		//学号
				$students[$i][1]=$s[1];		//姓名
				$students[$i][$homework_num+2]=0;			//总分
				for($k=0;$k<count($homework_id);$k++)	//查询该学生每一次作业情况
				{
					//该学号每一次作业
					$sqls="select id,is_deal from stu_works where s_id='".$s[0]."' and w_id=".$homework_id[$k]." and s_term=".$term;		
					$s_finish=mysql_query($sqls,$conn);
					if($s_finish&&mysql_num_rows($s_finish)>0)
					{
						$is_deal=mysql_fetch_array($s_finish);
						$students[$i][2+$k]=$is_deal['is_deal'];	//作业的分数
						$students[$i][$homework_num+2]+=$is_deal['is_deal'];	//求总分
					}
					else
					{
						$students[$i][2+$k]=0;	//不完成记0
					}
				}
					$students[$i][$homework_num+2]=$students[$i][$homework_num+2]/$homework_num;	//每位学生的平均分			
				}
		}
		//填写入excel单元格
		for ($i=0;$i<$s_num;$i++) {			//从第2行开始填写
		for($j=0;$j<count($tableheader);$j++) {
			$r=$i+2;
			$v=$students[$i][$j];
			$excel->getActiveSheet()->setCellValue("$letter[$j]$r",$v);
		}
		}
		//创建Excel输入对象
		$write = new PHPExcel_Writer_Excel5($excel);
		ob_end_clean();	//清理缓冲区，避免导出时乱码
		header("Pragma: public");
		header("Expires: 0");
		header("Content-Type:application/vnd.ms-excel:charset=UTF-8");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Type:application/vnd.ms-execl");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");;
		header('Content-Disposition:attachment;filename="'.$cid.'.xls"');
		header("Content-Transfer-Encoding:binary");
		$write->save('php://output');
		}
	else
	{
		echo "<script language='javascript'>";
		echo "alert('本次选择没有作业可以导出');";
		echo "window.history.back(-1);";
		echo "</script>";
//		return;
	}
//}
//homework_export($cid,$couid);
?>