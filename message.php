<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ҵ��ʼ�</title>
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a.list:link {
	font-size: 13px;
	color: #C60;
	text-decoration: none;
}
a.list:visited {
	font-size: 13px;
	color: #C60;
	text-decoration: none;
}
a.list:hover {
	font-size: 13px;
	color: #090;
	text-decoration: none;
}
a.page:link {
	font-size: 13px;
	font-weight: bold;
	color: #30C;
	text-decoration: none;
	background-color: #CEE7FF;
	padding: 9px;
	border: 1px solid #06C;
}
a.page:visited {
	font-size: 13px;
	font-weight: bold;
	color: #30C;
	text-decoration: none;
	background-color: #CEE7FF;
	padding: 9px;
	border: 1px solid #06C;
}
a.page:hover {
	font-size: 13px;
	font-weight: bold;
	color: #360;
	text-decoration: none;
	background-color: #FFFFCC;
	padding: 9px;
	border: 1px solid #F60;
}
</style>
</head>

<body>
<?php
	require("session.php");
	check_session();
	require("url_deal.php");
	//��ȡҳ��
	if(isset($_GET['p']))	
	{
		$p=intval(url_deal($_GET['p']));
	}
	else
	{
		$p=1;
	}
	//�ж��ǹ���Ա����ѧ������Ϣ
	if(isset($_GET['f_id']))	//ѧ��û��p_id���ݣ�����Ա��
	{
		$recive=$_SESSION['a_name'];
	}
	else
	{
		$recive=$_SESSION['s_id'];
	}
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	$sqls="select * from message where receive='".$recive."'";	//��ʱ�併��
	$mrs=mysql_query($sqls,$conn);
	if(!$mrs)
	{
		echo "<script language='javascript'>";
		echo "alert('��û���κζ���Ϣ');";
		echo "window.history.back(-1);";
		echo "</script>";
	}
	else
	{
		$m_num=mysql_num_rows($mrs);
		$page_count=ceil($m_num/20);		//ҳ��
		$offset=($p-1)*20;
		$sqls="select * from message where receive='".$recive."' order by sen_time desc limit ".$offset.",20";
		$mrs=mysql_query($sqls,$conn);
		$m_num=mysql_num_rows($mrs);		//ת��Ϊ����
	}
?>
<table width="650" height="111" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td colspan="6" align="center"><img src="pics/mymessage.jpg" width="204" height="36" /></td>
  </tr>
  <tr>
    <td width="59" height="28" align="center" bgcolor="#FFFFC1">&nbsp;</td>
    <td width="345" align="center" bgcolor="#FFFFC1">���ű���</td>
    <td width="110" align="center" bgcolor="#FFFFC1">������</td>
    <td width="131" align="center" bgcolor="#FFFFC1">�ռ�ʱ��</td>
    
  </tr>
  <?php
  	for($i=0;$i<$m_num;$i++)
	{	$arr_m=mysql_fetch_array($mrs);
  ?>
  <tr>
    <td height="30" align="center" bgcolor="#FFFFFF">
    <?php 
		if ($arr_m['is_read']==0)
			{echo "<img src='pics/new.gif' width='23' height='11' />";}
		else
			{echo "<font color='#000000'>Readed</font>";}
	?>
        </td>
  <td align="center" bgcolor="#FFFFFF"><a href="showmessage.php?mid=<?php echo $arr_m['m_id'];?>"  class="list" target="_blank">  <?php echo $arr_m['m_title'];?></a>
  <?php
  	if(isset($_GET['f_id']))	//����Ա���Իظ�
	{
		echo "&nbsp;>><a href='answer_message.php?mid=".$arr_m['m_id']."' target='_blank'>�ظ�����</a>";
	}
  ?>
  </td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_m['sender'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_m['sen_time'];?></td>
  </tr>
  <?php
	}?>
</table>
<table width="650" height="44" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="44" align="center">
<?php
		for($i=1;$i<=$page_count;$i++)
		{
			if($i!=$p)
				{echo "<a href='message.php?p=".$i."' class='page'>$i</a>&nbsp;";}
			else
				{echo "<a href='message.php?p=".$i."' class='page'><font color='#990000'>$i</font></a>&nbsp;";}
		}
		if(!isset($_GET['f_id']))
		{	echo "<a href='homework_list.php' class='page'>������ҵ�б�</a>";}
?>
    </td>
  </tr>
</table>
<?php require("about.html");?>
</body>
</html>