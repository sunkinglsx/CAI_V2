<?php
	require("db_connect.php");
	function homeworks($conn)		// ��ʼ����ҵ��
	{
	for($i=1;$i<=50;$i++)
	{
		$sqls="insert into homeworks(w_name,w_require,w_time,w_class,w_term,w_answer,w_handout)values('��ҵ����".$i."','��ҵҪ������','2017-07-15 12:00:00','C16F37',2,'���ļ�','�����ļ�')";
		$rs=mysql_query($sqls,$conn);
	}
	}
	function stu_works($conn)	//��ʼ��ѧ����ҵ
	{
		for($i=1;$i<=36;$i++)
		{
			$xh=$i<10?'C16F380'.$i:'C16F38'.$i;	//ѧ��
			for($j=8;$j<=23;$j++)		//16����ҵ
			{
				$sqls="insert into stu_works(s_id,w_id,s_file,s_time,s_ip,s_note,s_term)values('".$xh."',$j,'file_rout_test','2017-06-06 21:12:13','192.168.0.102','s_note_content_test',2)";
				$rs=mysql_query($sqls,$conn);
			}
		}
	}
	//homeworks($conn);
	stu_works($conn);
?>