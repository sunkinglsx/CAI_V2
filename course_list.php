<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ҵ����ϵͳ&mdash;�γ��б�</title>
<style type="text/css">
info {
	background-color: #FCFDD0;
	border-right-width: 1px;
	border-right-style: ridge;
	border-right-color: #F0F0F0;
	border-top-width: 1px;
	border-top-style: ridge;
	border-top-color: #F0F0F0;
	border-left-width: 1px;
	border-left-style: ridge;
	border-left-color: #F0F0F0;
	font-size: 12px;
	text-decoration: none;
}
a:link {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #E3E3E3;
	border: 1px groove #999;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
a:visited {
	font-size: 13px;
	color: #009;
	text-decoration: none;
}
a:hover {
	font-size: 13px;
	color: #F60;
	text-decoration: none;
	background-color: #FFC;
	border: 1px solid #F90;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
#info5 {
	font-size: 12px;
	font-weight: bold;
}
#t_main {
	background-color: #D8D8D8;
	font-size: 12px;
	height: 350px;
}
#t_main td
{
	padding-left:10px;
}
#cou {
	-webkit-box-shadow:#81B1F9 0px 0px 6px;
}
a.imgs:link {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #FFF;
	padding: 0px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
a.imgs:visited {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #FFF;
	padding: 0px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.txt_cou_name {
	background-color: #81B1F9;
	text-align: center;
	vertical-align: middle;
	width: 178px;
	padding-top: 8px;
	padding-bottom: 8px;
}
a.imgs:hover {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #FFF;
	padding: 0px;
	height: auto;
	width: auto;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.list{
	width:100%;
	height:auto;
}
.cou_dl{
	width:168px;
	height:242px;
	display:inline-block;
	background-color:#FFF;
	border:solid 1px #CCC;
	text-align:center;
	margin-left:20px;
	box-shadow:2px 2px 7px #909090;
}
.cou_dd{
	margin-left:auto;
	margin-right:auto;
	margin-top:20px;
	margin-bottom:auto;
}
.cou_dt{
	background-color:#369;
	color:#FFF;
	height:30px;
	margin-top:15px;
	margin-bottom:auto;
	font-size:20px;
	line-height:30px;
}
.cou_dt2{
	background-color:#369;
	color:#FFF;
	height:60px;
	margin-top:15px;
	margin-bottom:auto;
	font-size:18px;
	line-height:30px;
	position:relative;
	top:-10px;
}
</style>
</head>

<body>
<?php
	require("session.php");	//�Ự״̬�ļ�
	check_session();
	require("db_connect.php");	
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("term.php");
	//����ѧ�����꼶�Լ���ǰʱ���ж�ѧ��
	$term=term($_SESSION['s_id']);
?>
<P></P>
<div  style="width:90%; border-top-left-radius:10px; border-top-right-radius:10px;  background-color:#F3F3F3; height:33px; margin:auto;"></div>
<table width="90%" height="406" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="31" align="right" bgcolor="#FFFFCC"><span><?php show_welcome();?></span><?php show_operate();?></td>
  </tr>
  <tr>
    <td height="29" bgcolor="#C7DCFC">��ѡ��γ̿�Ŀ��</td>
  </tr>
  <tr>
    <td height="310" bgcolor="#FFFFFF">
    <div class="list">
    <?php
	//$cid=substr($_SESSION['s_id'],0,strlen($_SESSION['s_id'])-2);	
	//ѧ�����ڰ༶��������������ԭ�򣬿���һ��ѧ�Ż�����ڶ���༶��
	$sqls_class="select  c_id from class where c_enable=1 and c_id in(select cid from class_student where sid='{$_SESSION['s_id']}')";
	$rs_class=mysql_query($sqls_class,$conn);
	$rows=mysql_num_rows($rs_class);	//���ڰ༶����������һ����
	$cou_id=array();	//�γ�ID����
	$cou_name=array();//�γ���������
	for($k=0;$k<$rows;$k++)
	{
		$arr_class=mysql_fetch_array($rs_class);
		$cid=$arr_class['c_id'];
		$sqls="select * from course where class_id='".$cid."' and cou_enable=1 and cou_term=".$term;
		$rs_cou=mysql_query($sqls,$conn);
		if(!$rs_cou||mysql_num_rows($rs_cou)==0)
				continue;
				//echo "û����Ҫ����ҵ�Ŀγ�";
		else
		{
			for($i=0;$i<mysql_num_rows($rs_cou);$i++)
			{
				$arr_course=mysql_fetch_array($rs_cou);
				array_push($cou_id,$arr_course['cou_id']);	//�γ̺���ջ
				array_push($cou_name,$arr_course['cou_name']);	//�γ�������ջ
			}
		}
	}
	$kcs=sizeof($cou_id);	//�γ���
	for($k=0;$k<$kcs;$k++)
	{
	?>
    <dl class="cou_dl">
    <dd class="cou_dd" >
     <a class="imgs" href="homework_list.php?couid=<?php echo $cou_id[$k];?>"><img src="pics/book<?php echo $k%3;?>.jpg" name="img" width="135" height="157" class="imgs"/></a>
    </dd>
    <?php 
		if (strlen($cou_name[$k])<=15){
	?>
    <dt class="cou_dt">
    <?php 
		}else{
	?>
    <dt class="cou_dt2">
    <?php  }
	echo $cou_name[$k];?>
    </dt>
    </dl>
    <?php }?>
    </div>
    </td>
  </tr>
</table>
<br />
<?php require("about.html");?>
</body>
</html>