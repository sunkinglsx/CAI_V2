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
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("term.php");
	require("session.php");
	check_asession();
	require("url_deal.php");
	$cid=url_deal($_GET['cid']);		//�༶���
	$term=term($cid);	//ѧ��
	if(isset($_POST['button']))		//����������Ŀ
	{
		$cname=$_POST['cname'];
		$term=$_POST['term'];
		$sql="select cou_id from course where cou_name='".$cname."' and cou_teacher='".$_SESSION['a_name']."' and class_id='".$cid."' and cou_term=".$term;
		$rs=mysql_query($sql,$conn);
		if($rs&&mysql_num_rows($rs))
		{
			echo "<script language='javascript'>";
			echo "alert('�ÿ�Ŀ�Ѿ�����');";
			echo "</script>";
		}
		else
		{
			mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
			$sql="insert into course(cou_name,class_id,cou_term,cou_teacher) values ('{$cname}','{$cid}',{$term},'{$_SESSION['a_name']}')";
			$rs=mysql_query($sql,$conn);
			if(!$rs)
			{
				echo "<script language='javascript'>";
				echo "alert('һ���οο�Ŀ���ʧ��');";
				echo "</script>";
			}
			else
			{
				echo "<script language='javascript'>";
				echo "alert('һ���οο�Ŀ��ӳɹ�');";
				echo "</script>";
			}
		}
	}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="830" height="204" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="3" bgcolor="#FFFFCC">������ҳ������οο�Ŀ��<?php echo $cid;?>��</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="98" height="40" align="center">��ǰ�οΰ༶��</td>
      <td width="728" colspan="2"><?php
	  		$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_id='".$cid."' order by c_name";
			$rs=mysql_query($sqls,$conn);
			if($rs)
			{
				$crows=mysql_num_rows($rs);
				if($crows==0)
				{
					echo "�����οΰ༶";
				}
				else
				{
					for($i=0;$i<$crows;$i++)
					{
						$arr_c=mysql_fetch_array($rs);
						echo "<font color='#006600'>��".$arr_c['c_name']." </font>&nbsp;&nbsp;";
					}
				}
			}
			else
			{
				echo "�����οΰ༶";
			}
	  ?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center">�����οο�Ŀ��</td>
      <td colspan="2"><?php
	  		$sqls="select * from course where cou_teacher='".$_SESSION['a_name']."' and class_id='".$cid."' order by cou_name";
			$rs=mysql_query($sqls,$conn);
			if($rs)
			{
				$crows=mysql_num_rows($rs);
				if($crows==0)
				{
					echo "�����οο�Ŀ";
				}
				else
				{
					for($i=0;$i<$crows;$i++)
					{
						$arr_c=mysql_fetch_array($rs);
						echo "��".$arr_c['cou_name']."<font color='#ff0000'>[��".$arr_c['cou_term']."ѧ��] </font>&nbsp;&nbsp;";
					}
				}
			}
			else
			{
				echo "�����οο�Ŀ";
			}
	  ?></td>
    </tr>
    <tr>
      <td height="24" colspan="3" bgcolor="#F1F1F1">�����οο�Ŀ��
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
        <input name="cname" type="text" class="txt_box" id="cname" /></td>
    </tr>
    <tr>
      <td height="34" colspan="3" align="center"><input type="submit" name="button" id="button" value="�����οο�Ŀ" onclick="return check_form()"/></td>
    </tr>
  </table>
</form>
