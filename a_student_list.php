<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
<style type="text/css">
#t_main {	background-color: #D8D8D8;
	font-size: 12px;
}
a:link {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #E3E3E3;
	border: 1px solid #999;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
a:visited {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #E3E3E3;
	border: 1px solid #999;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
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
}
</style>
<script type="text/javascript">
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}
</script>
</head>

<body>
<?php
	session_start();
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("url_deal.php");
	$cid=url_deal($_GET['cid']);	//��ȡ�༶��
	$w_note="<table width='820' height='30' border='0' align='left' ><tr><td bgcolor='#FFFFCC'>��̨����>>����ѧ������>>$cid</td></tr></table>";
	echo $w_note;
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
		//���ݰ༶�Ų��ȫ��ѧ��
	$s_sqls="select * from students where s_class='".$cid."' order by s_id asc";
	$w_rs=mysql_query($s_sqls,$conn);	//�����ѧ�ڱ����ȫ����ҵ����
	if($w_rs&&mysql_num_rows($w_rs)!=0)
	{
		$w_rows=mysql_num_rows($w_rs);
	}
	 if($w_rows!=0)		//��Ϊ�գ���ʾ�����б�
			{
	  ?>
<table width="100%" height="63" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td width="45" height="23" align="center" bgcolor="#DBECFE" id="l_num">���</td>
    <td width="114" align="center" bgcolor="#DBECFE">ѧ��</td>
    <td width="134" align="center" bgcolor="#DBECFE">����</td>
    <td width="244" align="center" bgcolor="#DBECFE">��������</td>
    <td width="133" align="center" bgcolor="#DBECFE">��������</td>
    <td width="123" align="center" bgcolor="#DBECFE">����ȫ������</td>
  </tr>
  <?php 
  		for($i=0;$i<$w_rows;$i++){
			$w_arr=mysql_fetch_array($w_rs);	//תΪ����
  ?>
  <tr bgcolor="#FFFFFF" id="w_list<?php echo $i;?>" onmousemove="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFC4','TR')" onmouseout="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFFF','TR')">
    <td height="31" align="center"><?php $j=$i+1;echo $j;?></td>
    <td align="center"><?php echo $w_arr['s_id'];?></td>
    <td align="center"><?php echo $w_arr['s_name'];?></td>
    <td align="center"><?php echo $w_arr['email'];?></td>
    <td align="center"><a href="a_reset_student.php?fle=1&sid=<?php echo $w_arr['s_id'];?>">��������</a></td>
    <td align="center"><a href="a_reset_student.php?fle=2&sid=<?php echo $w_arr['s_id'];?>">��������</a></td>
  </tr>
  <?php
		}?>
</table>
<?php }?>
</body>
</html>