<?php
		session_start();
		if(!isset($_SESSION['a_name']))	//��½�Ƿ����
		{
			echo "<script>alert('���ȵ�½���޸�����');
			window.location.href='a_login.php';
			</script>";
		}
		else
		{
			$u_id=$_SESSION['a_name'];
		}
	if(isset($_POST['button']))
	{
		$oupass=md5(trim($_POST['oupass']));	//������
		$nupass=md5(trim($_POST['nupass']));	//������
		$nupass_2=md5(trim($_POST['nupass_2']));//������ȷ��
			require("db_connect.php");//�������ݿ������ļ�
			$sqls="select * from ad_user where a_name='".$u_id ."' and a_pw='".$oupass."'";
			$rs=mysql_query($sqls,$conn);
			if(mysql_num_rows($rs)==0)
			{
					echo "<script language='javascript'>";
					echo "alert('������������������������');";
					echo "window.history.back(-1);";
					echo "</script>";
			}
			else
			{
					mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
					$sqls="update ad_user set a_pw='".$nupass."' where a_name='".$u_id ."'";
					$rs=mysql_query($sqls,$conn);
				mysql_query("SET NAMES 'gb2312'");	//��ҳ�����һ��
					if($rs)
					{
						echo "<script language='javascript'>";
						echo "alert('�����޸ĳɹ���');";
						echo "window.location.href='a_index.php';";
						echo "</script>";
					}
					else
					{
						echo "<script language='javascript'>";
						echo "alert('�����޸�ʧ�ܣ�����������Ƿ���ȷ');";
						echo "window.history.back(-1);";
						echo "</script>";
					}
			}
			mysql_close($conn);
	}
?>