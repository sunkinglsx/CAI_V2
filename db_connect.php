<?php
	$db_server="127.0.0.1";//sunkinglsx�����ݿ������IP
	$db_user="root";	//���ݿ��û�
	$db_pass="root";	//���ݿ�����
	$db_name="shms";	 
	$conn=@mysql_connect($db_server,$db_user,$db_pass,true);
	if($conn)
		mysql_select_db($db_name);
	else
	{
		echo "���ݿ�������޷�����";
		exit;
	}


/*	$db_server="sqld-gz.bcehost.com:3306";	//�ٶȵ����ݿ������IP
	$db_user="8ff5bbe77607472c87d58eb1f78cc900";	//���ݿ��û�
	$db_pass="a33605fae3c3459f9db2063619636a6f";	//���ݿ�����
	$db_name="doNoxkSRIxRVqdqbfLlN";	 
	$conn=mysql_connect($db_server,$db_user,$db_pass);
	if($conn)
	
		mysql_select_db($db_name,$conn);
	else
	{
		echo "���ݿ�������޷�����";
		exit;
	}
*/
?>

