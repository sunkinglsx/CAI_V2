<?php
//===========学生作业文件扩展名检查函数===================
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
	//只有一个HTML或PHP文件的话，文件名只能是index
	if(array_search("html",$arr_exten)||array_search("php",$arr_exten))
	{
		if($filename!="index")
			return "wrong";
	}
}
//===============学生作业文件名检查函数================
function check_file_name($filename)
{
	$length=strlen($filename);	//文件名长度
	for($i=0;$i<$length;$i++)
	{
		$c=substr($filename,$i,1);
		$asc=ord($c);
		if($asc>127)	//中文 名
		{
			return false;
		}
	}
	return true;
}
?>