<?php
/////////////��ҵ����========================
	//��ȡѧ����ҵid��
	session_start();
	$arr_id=array();	//ID������
	$arr_score=array(); //�������� 
	$deal_false=0;	//����ʧ�ܵ�����
	$deal_sucess=0;	//���ĳɹ�������
	if(isset($_POST['button']))		//������ύ���ģ�������������
	{
		$fen=$_POST['fen'];	//���۵ȼ�
		foreach($_POST['deal'] as $id)
		{
			if($id!="")
			{
				array_push($arr_id,$id);	//��ջ
				array_push($arr_score,$fen);
			}
		}
	}
	else		//���򣬵�������
	{
		$id=$_GET['wid'];		//��ȡURL�е���ҵID
		$fen=$_GET['fen'];	//��ȡURL�еķ���ֵ
		array_push($arr_id,$id);		//��ջ
		array_push($arr_score,$fen);
	}
	if(count($arr_id)==0)
	{
			echo "<script language='javascript'>";
			echo "alert('��û��ѡ���κ�ѧ����ҵ��');";
			echo "window.history.back(-1);";
			echo "</script>";
	}
	else
	{
		require("db_connect.php");
		foreach($arr_id as $key=>$id)		//�������ݱ���is_deal�ֶ�
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
		//���ش�����
			echo "<script language='javascript'>";
			echo "alert('������ϣ�һ���ɹ�".$deal_sucess."����ʧ��".$deal_false."��');";
			echo "location.href='".$_SESSION['url']."';";
			echo "</script>";
	}
?>