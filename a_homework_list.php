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
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("url_deal.php");
	$cid=url_deal($_GET['cid']);	//��ȡ�༶��
	//���ݰ༶���Լ���ǰʱ���ж�ѧ��
	require("term.php");
	$term=term($cid);
	$h_sqls="select * from homeworks where w_term=".$term." and w_class='".$cid."' order by w_id desc";
	$w_rs=mysql_query($h_sqls,$conn);	//�����ѧ�ڱ����ȫ����ҵ����
	if(isset($w_rs))
		{
			$w_rows=mysql_num_rows($w_rs);	//��ѧ�ڲ��� ����ҵ����
			if($w_rows==0)
			{
				$w_note="<font color='#0033CC'>��̨����>>�༭��ҵ>>$cid>>û�пκ���ҵ</font>";
			}
			else
			{
				$w_note="<font color='#0033CC'>��̨����>>�༭��ҵ>>".$cid.">>�κ���ҵ�б�</font>";
			}
		}
	else
	{
		$w_note="<font color='#0033CC'>��̨����>>�༭��ҵ>>$cid>>û�пκ���ҵ</font>";
	}
echo $w_note."<br>";
 if($w_rows!=0)		//��Ϊ�գ���ʾ��ҵ�б�
		{
  ?>
<table width="100%" height="57" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td width="53" height="23" align="center" bgcolor="#DBECFE" id="l_num">���</td>
    <td width="300" align="center" bgcolor="#DBECFE">��ҵ����</td>
    <td width="256" align="center" bgcolor="#DBECFE">�Ͻ�ʱ��</td>
    <td width="120" align="center" bgcolor="#DBECFE">���ļ�</td>
    <td width="131" align="center" bgcolor="#DBECFE">�����ļ�</td>
    <td width="101" align="center" bgcolor="#DBECFE">����</td>
  </tr>
  <?php 
  		for($i=0;$i<$w_rows;$i++){
			$w_arr=mysql_fetch_array($w_rs);	//������ҵ��תΪ����
  ?>
  <tr bgcolor="#FFFFFF" id="w_list<?php echo $i;?>" onmousemove="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFC4','TR')" onmouseout="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFFF','TR')">
    <td height="31" align="center"><?php $j=$i+1;echo $j;?></td>
    <td align="center"><?php echo $w_arr['w_name'];?></td>
    <td align="center"><?php echo $w_arr['w_time'];?></td>
    <td align="center"><a href="<?php echo $w_arr['w_answer'];?>" target="_blank">�������</a></td>
    <td align="center"><a href="<?php echo $w_arr['w_handout'];?>" target="_blank">�������</a></td>
    <td align="center"><a href="a_deal_homework.php?wid=<?php echo $w_arr['w_id'];?>">�༭</a></td>
  </tr>
  <?php
		next($w_arr);}?>
</table>
<?php }?>
</body>
</html>