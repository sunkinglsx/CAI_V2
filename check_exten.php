<?php
//===========ѧ����ҵ�ļ���չ����麯��===================
function check_exten($ext_str,$w_id,$filename)
{
	require("db_connect.php");
	$sqls="select w_exten from homeworks where w_id=".$w_id;
	$rs_w=mysql_query($sqls,$conn);
	$arr_w=mysql_fetch_array($rs_w);
	$arr_exten=explode("#",$arr_w['w_exten']);
	if(false!==array_search($ext_str,$arr_exten))
		return true;
	else
		return false;
	//ֻ��һ��HTML��PHP�ļ��Ļ����ļ���ֻ����index
	if(array_search("html",$arr_exten)||array_search("php",$arr_exten))
	{
		if($filename!="index")
			return "wrong";
	}
}
//===============ѧ����ҵ�ļ�����麯��================
function check_file_name($filename)
{
	$length=strlen($filename);	//�ļ�������
	for($i=0;$i<$length;$i++)
	{
		$c=substr($filename,$i,1);
		$asc=ord($c);
		if($asc>127)	//���� ��
		{
			return false;
		}
	}
	return true;
}
?>