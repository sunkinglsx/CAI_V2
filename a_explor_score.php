<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>����ѧ���ɼ�</title>
<style type="text/css">
#tmain {
	background-color: #CCC;
	font-size: 12px;
	color: #333;
	text-decoration: none;
}
#tmain tr #cname {
	padding-left: 5px;
}
#tmain tr td #form1 #exp {
	background-color: #EFEFEF;
	height: 20px;
	font-size: 12px;
	color: #000;
	text-decoration: none;
	width: 80px;
	border: 1px solid #333;
}
</style>
</head>
<body>
<?php
	require("session.php");
	check_asession();
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("term.php");
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$_SESSION['url']=$url;	//��ס url
	//���ȫ�����ð༶
	$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_enable=1 order by c_id asc";
	$crs=mysql_query($sqls,$conn);
	$rows=mysql_num_rows($crs);
	if($rows==0)
	{
		echo "��ѧ����û���οΰ༶";
		exit;
	}
	echo "<table width='820' height='30' border='0' align='left' ><tr><td bgcolor='#FFFFCC'>��̨����>>�ɼ�����</td></tr></table>";
?>
<table width="677" height="64" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
  <tr>
    <td width="82" height="26" align="center" bgcolor="#E1E1E1"> �༶���</td>
    <td width="180" align="center" bgcolor="#E1E1E1">�༶����</td>
    <td width="179" align="center" bgcolor="#E1E1E1">�γ�����</td>
    <td width="107" align="center" bgcolor="#E1E1E1">ѧ��</td>
    <td width="123" align="center" bgcolor="#E1E1E1">����</td>
  </tr>
  <?php
		for($i=0;$i<$rows;$i++)
		{
			$arr_c=mysql_fetch_array($crs);
			//�������ʦÿ�����ȫ���γ�
			$sqls="select * from course where cou_teacher='".$_SESSION['a_name']."' and class_id='".$arr_c['c_id']."'";
			$rs_course=mysql_query($sqls,$conn);
			if($rs_course&&mysql_num_rows($rs_course)>0)
				for($k=0;$k<mysql_num_rows($rs_course);$k++)
				{
					$arr_course=mysql_fetch_array($rs_course);
	?>
  <tr>
    <td height="35" align="center" bgcolor="#FFFFFF"><label ><?php echo $arr_c['c_id'];?></label></td>
    <td align="center" bgcolor="#FFFFFF" id="cname"><?php echo $arr_c['c_name'];?></td>
    <td align="center" bgcolor="#FFFFFF" id="cname"><?php echo $arr_course['cou_name'];?></td>
    <td align="center" bgcolor="#FFFFFF" id="cname">
        <select name="term" id="term">
        <?php 
		$term=$arr_course['cou_term'];
		for($j=1;$j<=6;$j++){	
         if($term!=$j)
		 	{echo "<option value=$j>��".$j."ѧ��</option>";}
         else
		 	{echo "<option value=$j  selected=selected>��".$j."ѧ��</option>";}
		  }
		  ?>
        </select>
    </td>
    <td align="center" bgcolor="#FFFFFF">
       <form action="homework_export.php" method="post" name="form1" target="_parent" id="form1">
      <input type="hidden" name="cid" id="cid"  value="<?php echo $arr_c['c_id'];?>"/>
      <input type="submit" name="exp" id="exp" value="�����ɼ�" />
      <input name="couid" type="hidden" id="couid" value="<?php echo $arr_course['cou_id'];?>" />
    </form></td>
  </tr>
  <?php }}?>
</table>
</body>
</html>