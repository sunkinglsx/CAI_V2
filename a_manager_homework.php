<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#t_main {
	font-size: 12px;
	color: #333;
	background-color: #FFF;
	text-decoration: none;
	border: solid 1px #999;
}
.changbg:hover{
	background-color:#EBEEF3;
}
</style>
</head>
<body>
<?php 
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	//check_asession();
	require("url_deal.php");
	require("term.php");
	//��ס��ǰ���� ��url
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	$cid=url_deal($_GET['cid']);	//��ȡ�༶���
	$couid=url_deal($_GET['couid']);	//�γ̱��
		//����ѧ���İ༶�Լ���ǰʱ���ж�ѧ��
	$term=term($cid);
	$sqls="select cou_name from course where cou_id=".$couid;
	$rs=mysql_query($sqls,$conn);
	$arr_course=mysql_fetch_array($rs);
?>
<table width="100%" height="104" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="37" colspan="4" bgcolor="#FFFFCC">������ҳ �� ��ҵ���� ��<font color="#ff0000" ><?php echo $cid;?></font>��<?php echo $arr_course['cou_name'];?></td>
    <td height="37" colspan="2" align="center" bgcolor="#FFFFCC"><a href="a_homework_copy.php?cid=<?php echo $cid;?>&couid=<?php echo $couid;?>">����Ŀ��ҵ��������ƽ�а�</a></td>
  </tr>
  <?php
	//����ð���ſγ̵�ȫ����ҵ
		$sqls="select * from homeworks where w_cou_id=".$couid;
		$rs=mysql_query($sqls,$conn);
  		if(!$rs||mysql_num_rows($rs)==0)
		{ echo "<tr><td colspan='6' height='26'>���ſγ̻�û�в����κ���ҵ
		<a href='a_new_homework.php?cid=".$cid."&couid=".$couid."&cname=".$arr_course['cou_name']."'>����������ҵ</a>
		</td></tr>";
		}
		else
		{
  ?>
  <tr>
    <td width="41" height="33" align="center" bgcolor="#EBEBEB">���</td>
    <td width="216" align="center" bgcolor="#EBEBEB">����</td>
    <td width="150" align="center" bgcolor="#EBEBEB">��ֹʱ��</td>
    <td width="154" align="center" bgcolor="#EBEBEB">�����ļ�</td>
    <td width="114" align="center" bgcolor="#EBEBEB">���ļ�</td>
    <td width="144" align="center" bgcolor="#EBEBEB">����</td>
  </tr>
  <?php
  		$w_rows=mysql_num_rows($rs);
		for($i=0;$i<$w_rows;$i++)
		{
			$arr_w=mysql_fetch_array($rs);
  ?>
  <tr class="changbg">
    <td height="30" align="center"><?php echo $i+1;?></td>
    <td align="center"><?php echo $arr_w['w_name'];?></td>
    <td align="center"><?php echo $arr_w['w_time'];?></td>
    <td align="center"><?php echo strstr($arr_w['w_handout'],"/");?></td>
    <td align="center"><?php echo strstr($arr_w['w_answer'],"/");?></td>
    <td align="center"><a href="a_deal_homework.php?cid=<?php echo $cid;?>&amp;wid=<?php echo $arr_w['w_id'];?>">�޸�</a>| <a href="javascript:if(confirm('��ȷ��Ҫɾ��������ҵ��'))window.location.href='a_dele_homework.php?wid=<?php echo $arr_w['w_id'];?>'" >ɾ��</a></td>
  </tr>
  <?php } } ?>
</table>
</body>
</html>