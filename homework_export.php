<?php
session_start();
$cid=$_POST['cid'];
$couid=$_POST['couid'];

//��ҵ�ɼ���������
//function homework_export($cid,$couid){
	require('PHPExcel/PHPExcel.php');
	require("db_connect.php");
	mysql_query("SET NAMES 'utf8'");
	require("term.php");
	$term=term($cid);
	//����EXCEL����
	$excel = new PHPExcel();
	$letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U');		//Excel���ʽ
	$tableheader=array();
	$tableheader[0]= 'ѧ��';$tableheader[1]='����';	//��ͷ����
	$homework_id=array();	//��ҵid
	//��ѧ�ڸÿγ�ȫ����ҵ
	$sqls="select w_id,w_name from homeworks where w_cou_id=".$couid." order by w_id";
	$rs=mysql_query($sqls,$conn);
	if(isset($rs)&&mysql_num_rows($rs)>0)
	{
		for($i=0;$i<mysql_num_rows($rs);$i++)
		{
			$w=mysql_fetch_array($rs);
			$tableheader[$i+2]=$w[1];	//��ҵ���Ƽ����ͷ����
			$homework_id[$i]=$w[0];		//��ҵid
		//	echo $homework_id[$i];
		}
			$homework_num=mysql_num_rows($rs);		//��ҵ����
			$tableheader[$i+2]="ƽ����";		//�������һ��ƽ������
			$tableheader[0]=iconv("gb2312","utf-8",$tableheader[0]);		//������ת��Ϊutf����
			$tableheader[1]=iconv("gb2312","utf-8",$tableheader[1]);
			$tableheader[$i+2]=iconv("gb2312","utf-8",$tableheader[$i+2]);
		//����ͷ��Ϣ
		for($i = 0;$i <count($tableheader);$i++) {
		$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
		}
		//ѧ����ҵ����������Ϣ
		$students=array();//ѧ����ҵ������	,��ά
		$sqls="select s_id,s_name from students where s_class='".$cid."' order by s_id asc";		//ѧ������ѧ���б�
		$rs=mysql_query($sqls,$conn);
		if(!$rs||mysql_num_rows($rs)==0)
		{
			echo "<script language='javascript'>";
			echo "alert('�ð�û���ṩѧ������');";
			echo "window.history.back(-1);";
			echo "</script>";
//			return ;
		}
		else
		{
			$s_num=mysql_num_rows($rs);	//����
			for($i=0;$i<mysql_num_rows($rs);$i++)
			{
				$s=mysql_fetch_array($rs);
				$students[$i][0]=$s[0];		//ѧ��
				$students[$i][1]=$s[1];		//����
				$students[$i][$homework_num+2]=0;			//�ܷ�
				for($k=0;$k<count($homework_id);$k++)	//��ѯ��ѧ��ÿһ����ҵ���
				{
					//��ѧ��ÿһ����ҵ
					$sqls="select id,is_deal from stu_works where s_id='".$s[0]."' and w_id=".$homework_id[$k]." and s_term=".$term;		
					$s_finish=mysql_query($sqls,$conn);
					if($s_finish&&mysql_num_rows($s_finish)>0)
					{
						$is_deal=mysql_fetch_array($s_finish);
						$students[$i][2+$k]=$is_deal['is_deal'];	//��ҵ�ķ���
						$students[$i][$homework_num+2]+=$is_deal['is_deal'];	//���ܷ�
					}
					else
					{
						$students[$i][2+$k]=0;	//����ɼ�0
					}
				}
					$students[$i][$homework_num+2]=$students[$i][$homework_num+2]/$homework_num;	//ÿλѧ����ƽ����			
				}
		}
		//��д��excel��Ԫ��
		for ($i=0;$i<$s_num;$i++) {			//�ӵ�2�п�ʼ��д
		for($j=0;$j<count($tableheader);$j++) {
			$r=$i+2;
			$v=$students[$i][$j];
			$excel->getActiveSheet()->setCellValue("$letter[$j]$r",$v);
		}
		}
		//����Excel�������
		$write = new PHPExcel_Writer_Excel5($excel);
		ob_end_clean();	//�������������⵼��ʱ����
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
		echo "alert('����ѡ��û����ҵ���Ե���');";
		echo "window.history.back(-1);";
		echo "</script>";
//		return;
	}
//}
//homework_export($cid,$couid);
?>