<?php
	session_start();
	if(isset($_POST['button']))
	{
		$ucode=strtoupper(trim($_POST['check']));	//��֤��
		$u_id=strtoupper(trim($_POST['uname']));	//�����û���
		$u_pass=md5(trim($_POST['upass']));//����
		$err=0;
		if(!isset($_SESSION['code']))	//��֤���Ƿ����
		{
			echo "<script>alert('��֤����ʧЧ');
			location.href='a_login.php';
			</script>";
			$err=1;
		}
		else
		{
			if($ucode!=$_SESSION['code'])
			{
				echo "<script>alert('��֤�����');
						location.href='a_login.php';
				</script>";
				$err=1;
			}
		}
		if($err!=1){
			require("db_connect.php");//�������ݿ������ļ�
			mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
			$sqls="select * from ad_user where a_name='".$u_id ."' and a_pw='".$u_pass."'";
			$rs=mysql_query($sqls,$conn);
			if(mysql_num_rows($rs)==0)
			{
					echo "<script language='javascript'>";
					echo "alert('�û�����������������µ�½');";
					echo "location.href='a_login.php';";
					echo "</script>";
			}
			else
			{
					$arr=mysql_fetch_array($rs);	//ת��Ϊ����
					//����û���Ч���Ƿ����
					if(strtotime($arr['end_time'])<time())
					{
							echo "<script language='javascript'>";
							echo "alert('�Բ��������˻��ѹ��ڣ�����ϵ����Ա���ڣ�');";
							echo "location.href='index.php';";
							echo "</script>";
							exit;
					}
					else
					{
						$_SESSION['a_name']=$arr['a_name'];
						$_SESSION['a_right']=$arr['a_right'];
						$_SESSION['t_name']=$arr['t_name'];
						$_SESSION['email']=$arr['email'];
						$_SESSION['a_answer']=$arr['a_answer'];
						$_SESSION['question']=$arr['question'];
						if($arr['email']==""||$arr['question']==""||$arr['a_answer']=="")
						{
							header("location:finish_info.php?sid=".$arr['a_name']."&r=1");
						}
						else
						{
							header("location:a_index.php");
						}
					}
			}
			mysql_close($conn);
		}
	}
?>
