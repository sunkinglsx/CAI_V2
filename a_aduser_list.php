<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>����ϵͳ�û�</title>
<style type="text/css">
@import url("css.css");

#t_main {
	background-color: #CCCCCC;
}
</style>
</head>

<body>
<?php
	require("session.php");
	check_asession();
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
?>
<table width="100%" height="96" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="29" colspan="8" bgcolor="#FFFFCC">������ҳ �� �ον�ʦ����</td>
  </tr>
  <?php
	//����ð���ſγ̵�ȫ����ҵ
		if($_SESSION['a_name']=='sunkinglsx')
			$sqls="select * from ad_user";
		else
			$sqls="select * from ad_user where a_right=2";
		$rs=mysql_query($sqls,$conn);
  		if(!$rs||mysql_num_rows($rs)==0)
		{ echo "<tr><td colspan='6' height='26'>ϵͳû���ο���ʦ</td></tr>";
		}
		else
		{
  ?>
  <tr>
    <td width="46" height="33" align="center" bgcolor="#EBEBEB">���</td>
    <td width="128" align="center" bgcolor="#EBEBEB">��ʦ����</td>
    <td width="169" align="center" bgcolor="#EBEBEB">��½�˺�</td>
    <td width="206" align="center" bgcolor="#EBEBEB">��������</td>
    <td width="202" align="center" bgcolor="#EBEBEB">��Ч����</td>
    <td colspan="3" align="center" bgcolor="#EBEBEB">����</td>
  </tr>
  <?php
  		$w_rows=mysql_num_rows($rs);
		for($i=0;$i<$w_rows;$i++)
		{
			$arr_w=mysql_fetch_array($rs);
  ?>
  <tr>
    <td height="30" align="center" bgcolor="#FFFFFF"><?php echo $i+1;?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['t_name'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['a_name'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['email'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['end_time'];?></td>
    <td width="124" align="center" bgcolor="#FFFFFF"><a href="javascript:if(confirm('Ĭ����������Ϊ123456�����͵��Է���Ĭ������'))window.location.href='a_reset_pw.php?uid=<?php echo $arr_w['a_name'];?>'" >��������</a></td>
    <td width="115" align="center" bgcolor="#FFFFFF"><a href="a_user_putof.php?uid=<?php echo $arr_w['a_name'];?>">��������</a></td>
    <td width="116" align="center" bgcolor="#FFFFFF"><a href="javascript:if(confirm('��ȷ��Ҫɾ������ʦ�û���'))window.location.href='a_dele_user.php?uid=<?php echo $arr_w['a_name'];?>'" >ɾ���û�</a></td>
  </tr>
  <?php } } ?>
</table>
</body>
</html>