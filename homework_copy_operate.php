<?php 
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("term.php");
	//$couid=$_GET['couid'];	//�γ̺�
	if(isset($_POST['button']))		//���Ƶ�ƽ�а༶ͬ�ſγ�
	{
		$work_id=array();
		if(isset($_POST['se']))
		{
			foreach($_POST['se'] as $k)
			{
				if($k!="")
				{
					array_push($work_id,$k);	//��ҵ����ջ
				}
			}
		}
		else
		{
				echo "<script language='javascript'>";
				echo "alert('��ѡ����Ҫ���Ƶ���ҵ��');";
				echo "window.history.back(-1);";
				echo "</script>";
		}
		$cid=$_POST['class_list'];	//�༶��
		$couname=$_POST['couname'];	//�γ���
		$term=term($cid);	//����ð��ѧ��
		//���Ŀ��༶�У����ſγ̵�id��
		$sqls="select cou_id from course where cou_name='".$couname."' and class_id='".$cid."' and cou_teacher='".$_SESSION['a_name']."'";
		$rs=mysql_query($sqls,$conn);
		$tmp=mysql_fetch_array($rs);
		$couid=$tmp['cou_id'];
		//��ʼ����
		$i=1;
		foreach($work_id as $w)
		{
			$sqls="select * from homeworks where w_id=".$w;
			$rs=mysql_query($sqls,$conn);
			$arr=mysql_fetch_array($rs);
			print_r($arr);
			mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
			$copy_sqls="insert into homeworks(w_name,w_cou_id,w_require,w_time,w_class,w_term,w_answer,w_handout,w_exten)
			values('".$arr['w_name']."',".$couid.",'".$arr['w_require']."','".$arr['w_time']."','".$cid."',".$term.",'".$arr['w_answer']."',
			'".$arr['w_handout']."','".$arr['w_exten']."')";
			$rs=mysql_query($copy_sqls,$conn);
			if(!$rs)
			{	echo "��".$i."����ҵ����ʧ��";
				exit;
			}$i++;
		}
				echo "<script language='javascript'>";
				echo "alert('".$i."����ҵ��Ҫ��Ŀ��༶�ɹ���');";
				echo "window.history.back(-1);";
				echo "</script>";
	}
?>
