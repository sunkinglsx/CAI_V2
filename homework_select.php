<style type="text/css">
#t_main {
	background-color: #EBEBEB;
	font-size: 12px;
}
a:link {
	font-size: 12px;
	color: #C00;
	text-decoration: none;
	background-color: #FFF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #900;
}
a:visited {
	font-size: 12px;
	color: #C00;
	text-decoration: none;
	background-color: #FFF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #900;
}
a:hover {
	font-size: 12px;
	color: #060;
	text-decoration: none;
	background-color: #CCF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #390;
}
</style>
<script language="javascript">
function check_form()
{
	if(document.getElementById("deal[]").checked==false)
	{
		alert("��ѡ��Ҫ���ĵ�ѧ����ҵ");
		return false;
	}
}
</script>
<?php
	session_start();
	$couid=$_GET['couid'];
	$cid=$_GET['cid'];
	$wname=$_GET['wname'];
	//��ס��ǰ���� ��url
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
		$sqls="select * from  stu_works where cou_id=".$couid." and s_id like '".$cid."%'";
		$wrs=mysql_query($sqls,$conn);
		if(!$wrs)
		{
			echo "��û��ѧ������ҵ";
			exit;
		}
		else
		{
			$wrows=mysql_num_rows($wrs);
			if($wrows==0)
			{
				echo "��û��ѧ������ҵ";
				exit;
			}
		}
?>
<form id="form1" name="form1" method="post" action="a_homework_deal.php">
  <table width="100%" height="122" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
    <tr>
      <td height="29" colspan="6" bgcolor="#FFFFFF">������ҳ �� ������ҵ ����ҵѡ��<?php echo $cid;?>����<?php echo $wname;?>��</td>
    </tr>
    <tr>
      <td width="60" align="center" bgcolor="#EBEBEB">ѡ��</td>
      <td width="83" height="24" align="center" bgcolor="#EBEBEB">���</td>
      <td width="261" align="center" bgcolor="#EBEBEB">��ҵ��</td>
      <td width="156" align="center" bgcolor="#EBEBEB">�Ͻ�ʱ��</td>
      <td width="107" align="center" bgcolor="#EBEBEB">��ҵ�ļ�</td>
      <td width="80" align="center" bgcolor="#EBEBEB">����</td>
    </tr>
    <?php 
  	for($i=0;$i<$wrows;$i++)
	{	$arr_w=mysql_fetch_array($wrs);	//ת��Ϊ����
  ?>
    <tr>
      <td align="center" bgcolor="#FFFFFF">
      <?php if ($arr_w['is_deal']==0) {?>
      <input type="checkbox" name="deal[]" id="deal[]"  value="<?php echo $arr_w['id'];?>"/>
      <?php }   else { echo "��";}?>
      </td>
      <td height="32" align="center" bgcolor="#FFFFFF"><?php echo $arr_w['s_id'];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $wname;?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['s_time'];?></td>
      <td align="center" bgcolor="#FFFFFF"><a href="<?php echo $arr_w['s_file'];?>">���ز鿴</a></td>
      <?php if ($arr_w['is_deal']==0) {?>
      <td align="center" bgcolor="#FFFFFF">
      <label for="deal[]"><a href="a_homework_deal.php?wid=<?php echo $arr_w['id'];?>">����</a></label>      
      </td>
	  <?php }  else { ?>
      <td width="356" align="center" bgcolor="#FFFF80">
      <label for="deal[]">������</label>      
      </td>
      <?php }?>
    </tr>
    <tr>    <?php }?>
      <td height="32" colspan="6" align="center" bgcolor="#EBEBEB"><input type="submit" name="button" id="button" value="�ύ����" onclick="return check_form()" /></td>
    </tr>
  </table>
</form>
