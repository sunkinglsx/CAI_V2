<style type="text/css">
#tlist {
	font-size: 12px;
	line-height: 23px;
	color: #066;
	text-decoration: none;
	border: 1px dotted #CCC;
}
#tlist td {
	border: 1px dotted #CCC;
	padding-left:5px;
	padding-right:5px;
}
a.b:link{
	color: #066;
	padding-bottom:3px;
	padding-left:9px;
	padding-right:9px;
	padding-top:3px;
	border:1px solid #CCC;
	text-decoration:none;
	background-color:#D1E9DB;
	margin-left:3px;
	margin-right:3px;
}
a.b:hover{
	color: #900;
	padding-bottom: 3px;
	padding-left: 9px;
	padding-right: 9px;
	padding-top: 3px;
	border: 1px solid #CCC;
	background-color: #DAD2F4;
		margin-left:3px;
	margin-right:3px;

}
a.b:visited{
	color: #066;
	padding-bottom:3px;
	padding-left:9px;
	padding-right:9px;
	padding-top:3px;
	border:1px solid #CCC;
		margin-left:3px;
	margin-right:3px;

}
</style>
<?php 
	require('db_connect.php');
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require('session.php');
	check_asession();
	$aname=$_SESSION['a_name'];
	$sqls="select * from course_design where  D_teacher='".$aname."'";
	$rs=mysql_query($sqls,$conn);
	$rs_rows=mysql_num_rows($rs);
	if($rs_rows==0)
		echo "����δ�����κογ������Ŀ";
	else
	{
?>
<table width="100%" height="117" border="0" cellpadding="0" cellspacing="0" id="tlist">
  <tr>
    <td height="39" colspan="7" bgcolor="#FFFFCC">�γ������Ŀ����</td>
  </tr>
  <tr>
    <td width="49" height="38" align="center" bgcolor="#F2F2F2">���</td>
    <td width="196" align="center" bgcolor="#F2F2F2">��Ŀ����</td>
    <td width="78" align="center" bgcolor="#F2F2F2">���ð༶</td>
    <td width="78" align="center" bgcolor="#F2F2F2">����ѧ��</td>
    <td width="133" align="center" bgcolor="#F2F2F2">��ʼѡ��ʱ��</td>
    <td width="131" align="center" bgcolor="#F2F2F2">����ѡ��ʱ��</td>
    <td width="310" align="center" bgcolor="#F2F2F2">&nbsp;</td>
  </tr>
  <?php 
  for($i=0;$i<$rs_rows;$i++)
  {
	  $rs_arr=mysql_fetch_array($rs);
	  if($i%2==1)
	  		echo "<tr style='background-color:#F8FCFC;'>";
		else
			echo "<tr>";
  ?>
      <td height="38" align="center"><?php $j=$i+1;echo $j;?></td>
    <td><?php echo $rs_arr['D_name'];?></td>
    <td align="center"><?php echo $rs_arr['Class_id'];?></td>
    <td align="center"><?php echo $rs_arr['term'];?></td>
    <td align="center"><?php echo $rs_arr['S_time'];?></td>
    <td align="center"><?php echo $rs_arr['E_time'];?></td>
    <td align="center">
    <a href="a_design_title_list.php?did=<?php echo $rs_arr['D_ID'];?>&amp;dname=<?php echo $rs_arr['D_name'];?>&amp;classid=<?php echo $rs_arr['Class_id'];?>" class="b">ѡ���б�</a>
    <a href="a_design_edit.php?did=<?php echo $rs_arr['D_ID'];?>" class="b"> �޸�</a> 
    <a href="a_design_delete.php?did=<?php echo $rs_arr['D_ID'];?>" class="b"> ɾ��</a><a href="a_student_titles.php?did=<?php echo $rs_arr['D_ID'];?>&dname=<?php echo $rs_arr['D_name'];?>&classid=<?php echo $rs_arr['Class_id'];?> " class="b">ѧ��ѡ�����</a></td>
  </tr>
  <?php 
  }?>
</table>
<?php }?>