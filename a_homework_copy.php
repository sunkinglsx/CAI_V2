<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	//check_asession();
	require("url_deal.php");
	require("term.php");
	$cid=url_deal($_GET['cid']);	//��ȡ�༶���
	$couid=url_deal($_GET['couid']);	//�γ̱��
		//���ݰ༶�Լ���ǰʱ���ж�ѧ��
	$term=term($cid);
	//����γ�����
	$sqls="select cou_name from course where cou_id=".$couid;
	$rs=mysql_query($sqls,$conn);
	$arr_course=mysql_fetch_array($rs);
	//�����ѧ�ڸ���ʦ������ſγ̵�ȫ���༶
	$sqls_class="select class_id from course where cou_name='".$arr_course['cou_name']."' and cou_teacher='".$_SESSION['a_name']."' and cou_enable=1";
	$rs_class=mysql_query($sqls_class,$conn);
	$arr_class=array();
	if($rs_class&&mysql_num_rows($rs_class)<=1)	//û��ƽ�а༶
	{
		echo "��ֻ����һ����ġ�".$arr_course['cou_name']."����";
		exit;
	}
	else
	{
		for($i=0;$i<mysql_num_rows($rs_class);$i++)
		{
			$arr_tmp=mysql_fetch_array($rs_class);
			array_push($arr_class,$arr_tmp['class_id']);	//�༶�����ջ
		}
	}
?>
<form id="form1" name="form1" method="post" action="homework_copy_operate.php?couid=<?php echo $couid;?>">
<table width="100%" height="104" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="37" colspan="5" bgcolor="#FFFFCC">������ҳ ��ƽ�а���ҵ���� ��<?php echo $arr_course['cou_name'];?></td>
  </tr>
  <?php
	//����ð���ſγ̵�ȫ����ҵ
		$sqls="select * from homeworks where w_cou_id=".$couid." order by w_id asc";
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
    <td width="41" height="33" align="center" bgcolor="#EBEBEB">ѡ��</td>
    <td width="226" align="center" bgcolor="#EBEBEB">����</td>
    <td width="196" align="center" bgcolor="#EBEBEB">��ֹʱ��</td>
    <td width="187" align="center" bgcolor="#EBEBEB">����</td>
    <td width="170" align="center" bgcolor="#EBEBEB">��</td>
  </tr>
  <?php
  		$w_rows=mysql_num_rows($rs);
		for($i=0;$i<$w_rows;$i++)
		{
			$arr_w=mysql_fetch_array($rs);
  ?>
  <tr>
    <td height="30" align="center" bgcolor="#FFFFFF"><input type="checkbox" name="se[]" id="se[]"  value="<?php echo $arr_w['w_id'];?>"/>
      <label for="se[]"></label></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['w_name'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['w_time'];?></td>
    <td align="center" bgcolor="#FFFFFF">	<?php echo strstr($arr_w['w_handout'],"/"); ?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo strstr($arr_w['w_answer'],"/");?> </td>
  </tr>
  <?php } } ?>
</table>
<table width="100%" height="38" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="493" height="38" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="163" align="center" bgcolor="#F0F0F0"><select name="class_list" id="class_list">
      <?php foreach($arr_class as $k)
	  {
			if($k!=$cid)
				echo "<option value=".$k.">".$k."</option>";
	  }
	  ?>
    </select>
      <input name="couname" type="hidden" id="couname" value="<?php echo $arr_course['cou_name'];?>" /></td>
    <td width="170" align="center" bgcolor="#F0F0F0"><input type="submit" name="button" id="button" value="���Ƶ�Ŀ��༶" /></td>
  </tr>
</table> </form>
</body>
</html>