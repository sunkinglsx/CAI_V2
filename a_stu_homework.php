<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#t_mains
{
	border:solid 1px #999;
	font-size:12px;
}
.changbg:hover
{
	background-color:#EFF4F8;
}
</style>
</head>

<body>
<?php
//���ݰ༶�ţ��γ̺Ų���ð��ѧ�ڲ��õ�ȫ����ҵ��������
	$cid=$_GET['cid'];		//R-c1601  
	$couid=$_GET['couid'];
	$cname=$_GET['cname'];		//�γ�����
	require("term.php");
	require("session.php");
	check_asession();	//����Ƿ��½
	$term=term($cid);	//����ѧ�����꼶�Լ���ǰʱ���ж�ѧ��
	//��ס��ǰ���� ��url
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	require("db_connect.php");
	//����ð��������
	$sqls_man="select count(s_id) as zrs from students where s_class='{$cid}'";
	$rs_man=mysql_query($sqls_man,$conn);
	$arr_zrs=mysql_fetch_array($rs_man);
	$_SESSION['zrs']=$arr_zrs['zrs'];
	mysql_free_result($rs_man);
	
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	$wsqls="select w_id,w_name,w_time from homeworks where w_cou_id=".$couid." and w_class='".$cid."' and w_term=".$term;
	$wrs=mysql_query($wsqls,$conn);
	if(!$wrs||mysql_num_rows($wrs)==0)
	{
		echo "�ÿγ̻�û�в�����ҵ";
		exit;
	}
	else
	{
		$wrows=mysql_num_rows($wrs);	//����
	}
	
?>
<table width="100%" height="89" border="0" align="center" cellpadding="0" cellspacing="1" id="t_mains">
  <tr>
    <td height="29" colspan="6" bgcolor="#FDFDCC">������ҳ �� ������ҵ ��<?php echo $cid;?>���<?php echo $term;?>ѧ����ҵ�б���<?php echo $cname;?>��</td>
  </tr>
  <tr>
    <td width="80" height="22" align="center" bgcolor="#EBEBEB">���</td>
    <td width="367" align="center" bgcolor="#EBEBEB">��ҵ��</td>
    <td width="264" align="center" bgcolor="#EBEBEB">��ֹʱ��</td>
    <td width="130" align="center" bgcolor="#EBEBEB">�Ͻ������ģ�</td>
    <td width="129" align="center" bgcolor="#EBEBEB">����</td>
    <td width="100" align="center" bgcolor="#EBEBEB">����ͳ��</td>
  </tr>
  <?php 
	if(substr($cid,0,1)=="R")	//��������ް༶���༶��Ҫ����һ��
		$cid=substr($cid,2,3);
  	for($i=0;$i<$wrows;$i++)
	{	$arr_w=mysql_fetch_array($wrs);	//ת��Ϊ����
  ?>
  <tr class="changbg">
    <td height="34" align="center"><?php echo $i+1;?></td>
    <td align="center"><?php echo $arr_w['w_name'];?></td>
    <td align="center"><?php echo $arr_w['w_time'];?></td>
    <td align="center">
    <?php
		//��ҵ���Ͻ�����
		
		$sqls_up="select count(id) from stu_works where w_id=".$arr_w['w_id']." and s_id like '%".$cid."%'";
		$count=mysql_fetch_array(mysql_query($sqls_up,$conn));
		echo $count[0]."��";
		//��������
		$sqls_up="select count(id) from stu_works where w_id=".$arr_w['w_id']." and s_id like '%".$cid."%' and is_deal<101";
		$count=mysql_fetch_array(mysql_query($sqls_up,$conn));
		echo "<font  color='#FF0000'>".$count[0]."</font>��";
	?>
    </td>
    <td align="center"><a href="a_bat_homeworks.php?cid=<?php echo $cid;?>&amp;wid=<?php echo $arr_w['w_id'];?>&amp;wname=<?php echo $arr_w['w_name'];?>">����</a></td>
    <td align="center"><a href="data_charts.php?wname=<?php echo $arr_w['w_name'];?>&wid=<?php echo $arr_w['w_id'];?>"><img src="images/chart_bar.png" width="16" height="16" /></a></td>
  </tr>
  <?php }?>
</table>
</body>
</html>