<style type="text/css">
.txt_box {	height: 20px;
	width: 220px;
}
#tmain {	font-size: 12px;
	color: #333;
	text-decoration: none;
	background-color: #F1F1F1;
}
</style>
<script language="javascript">
	function check_form()
	{
		var cid=document.getElementById("cname").value;
		if(cid=="")
		{
			alert("�οο�ĿΪ�������ݣ�");
			document.getElementById("cname").focus();
			return false;
		}
	}
</script>
<?php
	require("session.php");
	check_asession();
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("term.php");
	require("url_deal.php");
	$cid=url_deal($_GET['cid']);		//�༶���
	$couid=url_deal($_GET['couid']);	//�γ̱��
	//���ԭ�пγ���Ϣ
	$sqls="select * from course where cou_id=".$couid;
	$rs_cou=mysql_query($sqls,$conn);
	if(!$rs_cou)
	{
		echo "��Ч�Ŀγ���Ϣ��ѯ";
		exit;
	}
	else
	{
		$arr_cou=mysql_fetch_array($rs_cou);
		$term=$arr_cou['cou_term'];
	}
	if(isset($_POST['button']))		//�����Ŀ�޸���Ϣ
	{
		$cname=$_POST['cname'];
		$term=$_POST['term'];
		$couid=$_POST['couid'];
		$class=$_POST['class'];
		$sql="select cou_id from course where cou_name='".$cname."' and cou_teacher='".$_SESSION['a_name']."' and class_id='".$class."' and cou_term=".$term;
		$rs=mysql_query($sql,$conn);
		if($rs&&mysql_num_rows($rs))
		{
			echo "<script language='javascript'>";
			echo "alert('�ÿγ̿�Ŀ�����Ѿ�����');";
			echo "</script>";
		}
		else
		{
			mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
			$sql="update course set cou_name='".$cname."',cou_term=".$term.",class_id='".$class."' where cou_id=".$couid;
			$rs=mysql_query($sql,$conn);
			mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
			if(!$rs)
			{
				echo "<script language='javascript'>";
				echo "alert('һ���οο�Ŀ����ʧ��');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
			}
			else
			{
				echo "<script language='javascript'>";
				echo "alert('һ���οο�Ŀ���³ɹ�');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
			}
		}
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="830" height="204" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="3" bgcolor="#FFFFCC">������ҳ���޸��οο�Ŀ��<?php echo $cid;?>�ࡷ<?php echo $arr_cou['cou_name'];?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="98" height="40" align="center">���ð༶</td>
      <td width="728" colspan="2">
      <?php
	  //����ʦ�����οΰ༶
	  $sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_enable=1";
	  $rs_class=mysql_query($sqls,$conn);
	  for($i=0;$i<mysql_num_rows($rs_class);$i++)
	  {
		  $arr_class=mysql_fetch_array($rs_class);	//�༶��¼תΪ����
		  if($arr_class['c_id']==$arr_cou['class_id'])
		  {
			 echo "<label><font color='#CC0000'><input name='class' type='radio' id='class_0' value='".$arr_class['c_id']."' checked='checked' />
          ".$arr_class['c_name']."(".$arr_class['c_id'].")</font></label>";
		  }
		  else
		  {
			 echo "<label><input name='class' type='radio' id='class_0' value='".$arr_class['c_id']."' />
          ".$arr_class['c_name']."(".$arr_class['c_id'].")</label>";
		  }
	  }
	  ?>
	</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center">�ο���ʦ</td>
      <td colspan="2"><?php echo $_SESSION['t_name'];?></td>
    </tr>
    <tr>
      <td height="24" colspan="3" bgcolor="#F1F1F1">�޸Ŀγ̿�Ŀ��Ϣ��
        <label for="term"></label>
        <select name="term" id="term">
        <?php for($i=1;$i<=6;$i++){	
         if($term!=$i)
		 	{echo "<option value=$i>��".$i."ѧ��</option>";}
         else
		 	{echo "<option value=$i  selected=selected>��".$i."ѧ��</option>";}
		  }
		  ?>
        </select>
        </td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">��Ŀ���ƣ�</td>
      <td colspan="2" bgcolor="#FFFFFF"><label for="cname"></label>
        <input name="cname" type="text" class="txt_box" id="cname" value="<?php echo $arr_cou['cou_name'];?>" />
        <input type="hidden" name="couid" id="couid" value="<?php echo $couid;?>"></td>
    </tr>
    <tr>
      <td height="34" colspan="3" align="center"><input type="submit" name="button" id="button" value="����γ̿�Ŀ�޸�" onclick="return check_form()"/></td>
    </tr>
  </table>
</form>
