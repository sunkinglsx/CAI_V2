<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�γ������Ŀ����</title>
<style type="text/css">
#form1 #dtable {
	width: 700px;
	border: 1px solid #999;
	font-size: 12px;
	font-style: normal;
	box-shadow: 3px 3px 3px #999;
	-webkit-box-shadow: 3px 3px 3px #999;
	margin-top: 15px;
	line-height: 25px;
	color: #066;
	text-decoration: none;
}
</style>
</head>

<body>
<?php
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	check_asession();	//������Ա�Ƿ��¼
	$did=$_GET['did'];	//�γ����ID��
	$sqls="select * from course_design where D_ID=".$did;
	$rs=mysql_query($sqls,$conn);
	$rs1_arr=mysql_fetch_array($rs);
	$sqls2="select * from course where cou_teacher='".$_SESSION['a_name']."' and cou_enable=1";
	$rs2=mysql_query($sqls2,$conn);
	$rs2_rows=mysql_num_rows($rs2);
?>
<form id="form1" name="form1" method="post" action="a_design_save.php?did=<?php echo $did;?>">
  <table width="714" height="211" border="0" align="center" cellpadding="0" cellspacing="0" id="dtable">
    <tr>
      <td height="35" colspan="2" bgcolor="#FFFFCC">&gt;&gt;�����γ����</td>
    </tr>
    <tr>
      <td width="146" height="37" align="center" bgcolor="#E7E7E7">�γ��������</td>
      <td width="568" bgcolor="#E7E7E7"><label for="d_name"></label>
      <input type="text" name="d_name" id="d_name" width="300"  value="<?php echo $rs1_arr['D_name'];?>"/></td>
    </tr>
    <tr>
      <td height="33" align="center">���ÿγ����ƣ�</td>
      <td>
      <?php 
	  if($rs2_rows==0)
	  		echo "��ǰû���������Ŀγ̿�ѡ�����ȷ����γ̻򼤻�γ�!";
	  else
	  {
	  ?>
        <p>
        <?php 
			for($i=0;$i<$rs2_rows;$i++)
			{
				$rs_arr=mysql_fetch_array($rs2);
				if($rs_arr['cou_id']==$rs1_arr['C_id'])
				{
		?>
          <label>
            <input type="radio" name="cname"  id="cname"  checked="checked" value="<?php echo $rs_arr['cou_id']."#".$rs_arr['class_id'];?>"/>
            <?php echo $rs_arr['cou_name'].'---'.$rs_arr['class_id'].'---��'.$rs_arr['cou_term'].'ѧ��';?></label>
          <br />
          <?php 	}
		  	else
			{?>
          <label>
            <input type="radio" name="cname"  id="cname"    value="<?php echo $rs_arr['cou_id']."#".$rs_arr['class_id'];?>"/>
            <?php echo $rs_arr['cou_name'].'---'.$rs_arr['class_id'].'---��'.$rs_arr['cou_term'].'ѧ��';?></label>
          <br />
		  <?php }  }?>
      </p>
      <?php }?>
      </td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#E7E7E7">ѡ�⿪ʼʱ�䣺</td>
      <td bgcolor="#E7E7E7">
      <?php 
	  	$s=explode(" ",$rs1_arr['S_time']);
		$e=explode(" ",$rs1_arr['E_time']);
		$stime=$s[0]."T".$s[1];
		$etime=$e[0]."T".$e[1];		
	  ?>
      <input type="datetime-local" width="200"  id="stime" name="stime" value="<?php echo $stime;?>"/ >
      </td>
    </tr>
    <tr>
      <td height="35" align="center">ѡ�����ʱ�䣺</td>
      <td><input type="datetime-local" width="200" id="etime"  name="etime" value="<?php echo $etime;?>"/>
      </td>
    </tr>
    <tr>
      <td height="36" colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="button" id="button" value="�ύ" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<script type="text/javascript">
	function check_form()
	{
		var dname=document.getElementById("d_name").value;
		var cname=document.getElementById("cname[]").checked;
		var stime=document.getElementById("stime").value;
		var etime=document.getElementById("etime").value;
		if(dname=="")
		{
			alert("����д�γ�������ƣ�");
			return false;
		}
		if(cname==false)
		{
			alert("��ѡ��һ�����ÿγ̣�");
			return false;
		}
		if(stime=="")
		{
			alert("��ѡ��γ���ƿ�ʼѡ���ʱ�䣡");
			return false;
		}
		if(etime=="")
		{
			alert("��ѡ��γ���ƽ���ѡ���ʱ�䣡");
			return false;
		}
		if(stime>=etime)
		{
			alert("ѡ�����ʱ��������ڿ�ʼʱ�䣡");
			return false;
		}
	}
</script>