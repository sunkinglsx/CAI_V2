<?php
	$db_server="127.0.0.1";//sunkinglsx的数据库服务器IP
	$db_user="root";	//数据库用户
	$db_pass="root";	//数据库密码
	$db_name="shms";	 
	$conn=@mysql_connect($db_server,$db_user,$db_pass,true);
	if($conn)
		mysql_select_db($db_name);
	else
	{
		echo "数据库服务器无法连接";
		exit;
	}


/*	$db_server="sqld-gz.bcehost.com:3306";	//百度的数据库服务器IP
	$db_user="8ff5bbe77607472c87d58eb1f78cc900";	//数据库用户
	$db_pass="a33605fae3c3459f9db2063619636a6f";	//数据库密码
	$db_name="doNoxkSRIxRVqdqbfLlN";	 
	$conn=mysql_connect($db_server,$db_user,$db_pass);
	if($conn)
	
		mysql_select_db($db_name,$conn);
	else
	{
		echo "数据库服务器无法连接";
		exit;
	}
*/
?>

