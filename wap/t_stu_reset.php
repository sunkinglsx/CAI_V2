<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>������ҵ����ϵͳ</title>
<style type="text/css">
#error {
	background-color: #36C;
	width: 66%;
	height:150px;
	display:hidden;
	border-radius:5px;
	margin-left:-33%;
	margin-top:-75px;
	top:50%;
	left:50%;
	-webkit-box-shadow:2px 2px 6px #999;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=5);
	box-shadow: 2px 2px 10px #909090;	/*IE9��chrome*/
	font-size:14px;
	color:#36C;
	text-align:center;
	position:absolute;
}
#error .msg_bottom #button {
	font-size: 14px;
	color: #FFF;
	text-decoration: none;
	background-color: #36C;
	height: 30px;
	width: 50%;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.msg_title{
	background-color:#36C;
	font-size:16px;
	color:#FFF;
	height:30px;
	line-height:30px;
	text-align:center;
	width:96%;
}
.msg_content{
	background-color:#FFF;
	height:70px;
	text-align:left;
	width:100%;
}
.msg_bottom{
	background-color:#FFF;
	height:50px;
	text-align:center;
}
</style>
</head>
<body>
<?php
	require('../db_connect.php');
	require('../url_deal.php');
	$sid=url_deal($_GET['sid']);	//ѧ��
	$cid=substr($sid,0,6);	//�༶���
	$sqls="update students set s_pass='".md5("123456")."' where s_id='".$sid."'";
	$rs=mysql_query($sqls,$conn);
	if($rs)
	{
?>
				<div id="error">
					<div class="msg_title" >��ʾ</div>
					<div class="msg_content"> 
					<table width="97%" align="center">
					<tr><td>
					 ѧ������ɹ�����Ϊ123456�� 
					 </td></tr></table>
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="ȷ��"  onclick="location.href='t_student.php?cid=<?php echo $cid;?>'"/>
					</div>
				</div>
<?php } 
else 
{
	echo "��������ʧ��";
}
?>
</body>
</html>