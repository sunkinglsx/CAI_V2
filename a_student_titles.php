<style type="text/css">
#tlist {
	font-size: 12px;
	color: #066;
	text-decoration: none;
	background-color: #F3F3F3;
}
</style>
<?php 
	require('db_connect.php');
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require('session.php');
	check_asession();
	require('url_deal.php');
	$did=url_deal($_GET['did']);
	$classid=url_deal($_GET['classid']);
	$dname=url_deal($_GET['dname']);
	//������ſγ���Ƶ�ȫ��ѡ��
	$sqls_design_titles="select DT_id,DT_title from design_titles where D_id=".$did;
	$rs_design_titles=mysql_query($sqls_design_titles);
	if(!$rs_design_titles||mysql_num_rows($rs_design_titles)==0)
		echo "���ſγ����δ�ṩ�κ�ѡ��";
	else
	{
		$num_design_titles=mysql_num_rows($rs_design_titles);
?>
<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" id="tlist">
  <tr>
    <td colspan="7" bgcolor="#FFFFD2"  height="35">ѧ���γ����ѡ�����顪��<?php echo $dname."---".$classid;?></td>
  </tr>
  <tr>
    <td width="50" align="center" bgcolor="#F7F7F7" height="25px"> </td>
    <td width="93" align="center" bgcolor="#F7F7F7">ѧ��</td>
    <td width="102" align="center" bgcolor="#F7F7F7">����</td>
    <td width="247" align="center" bgcolor="#F7F7F7">ѡ��</td>
    <td width="114" align="center" bgcolor="#F7F7F7">�Ŷӳ�</td>
    <td width="112" align="center" bgcolor="#F7F7F7">�����ʽ</td>
    <td width="234" align="center" bgcolor="#F7F7F7">&nbsp;</td>
  </tr>
  <?php for($i=0;$i<$num_design_titles;$i++)
	{
  		$arr_design_titles=mysql_fetch_array($rs_design_titles);
		$dtid=$arr_design_titles['DT_id'];
		//����ѧ���Ը� ���ѡ�����
		$sqls_stu_design_title="select * from stu_design_titles where DT_id=".$dtid;
		$rs_stu_design_titles=mysql_query($sqls_stu_design_title,$conn);
		if($rs_stu_design_titles&&mysql_num_rows($rs_stu_design_titles)>0)
 		{
			$num_stu_design_titles=mysql_num_rows($rs_stu_design_titles);
			for($j=0;$j<$num_stu_design_titles;$j++)
			{
				$arr_stu_design_titles=mysql_fetch_array($rs_stu_design_titles);
				if($j%2==0)
					echo "<tr bgcolor='#E1F4E3'>";
				else
					echo "<tr>";
	 ?>
                <td align="center" height="30px"></td>
                <td align="center"><?php echo $arr_stu_design_titles['S_id'];?></td>
                <td align="center"><?php echo $arr_stu_design_titles['S_name'];?></td>
                <td><?php echo $arr_design_titles['DT_title'];?></td>
                <td align="center"><?php echo $arr_stu_design_titles['coperator_name'];?></td>
                <td align="center">
                <?php 
					if($arr_stu_design_titles['S_id']==$arr_stu_design_titles['coperator_id'])
						echo "�������";
					else
						echo "�Ŷ����";
				?>
                </td>
                <td align="center" >&nbsp;</td>
              </tr>
  <?php }}
  else	//û��ѡ��
   {	echo "<tr bgcolor='#F0CEEB'>";
   ?>
                <td align="center" height="30px"></td>
                <td align="center">/</td>
                <td align="center">/</td>
                <td><?php echo $arr_design_titles['DT_title'];?></td>
                <td align="center">/</td>
                <td align="center">/</td>
                <td width="234" align="center">&nbsp;</td>
  				<tr>
 <?php  	
  }
  }
  	mysql_free_result($rs_design_titles);
	mysql_free_result($rs_stu_design_titles);
  ?>
</table>
<?php }?>