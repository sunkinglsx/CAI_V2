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
			alert("�û����Ʊ������ݣ�");
			document.getElementById("cname").focus();
			return false;
		}
	}
</script>
<link type="text/css" rel="stylesheet" href="css/lanrenzhijia.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery-3.2.1.js"></script>
<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>
<script src="js/jquery-ui-timepicker-zh-CN.js"></script>
<?php
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("term.php");
	require("session.php");
	check_asession();
	require("url_deal.php");
	if(isset($_POST['button']))		//����������Ŀ
	{
		$aname=$_POST['cname'];
		$right=$_POST['term'];
		$tname=$_POST['tname'];
		$pw=md5("123456");
		$endtime=$_POST['endtime'];
		$sql="select * from ad_user where a_name='".$aname."' and t_name='".$tname."'";
		$rs=mysql_query($sql,$conn);
		if($rs&&mysql_num_rows($rs))
		{
			echo "<script language='javascript'>";
			echo "alert('���û��Ѿ�����');";
			echo "</script>";
		}
		else
		{
			mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
			$sql="insert into ad_user(a_name,t_name,a_pw,a_right,end_time) values ('".$aname."','".$tname."','".$pw."',".$right.",'".$endtime."')";
			$rs=mysql_query($sql,$conn);
			if(!$rs)
			{
				echo "<script language='javascript'>";
				echo "alert('ϵͳ�û����ʧ��');";
				echo "</script>";
			}
			else
			{
				echo "<script language='javascript'>";
				echo "alert('ϵͳ�û���ӳɹ�');";
				echo "</script>";
			}
		}
	}
?>
<title>���ϵͳ�û�</title>
<form id="form1" name="form1" method="post" action="">
  <table width="830" height="235" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="3" bgcolor="#FFFFCC">������ҳ�����ϵͳ�û�</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="98" height="40" align="center">�û����ƣ�</td>
      <td width="728" colspan="2"><input name="cname" type="text" class="txt_box" id="cname" /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center" bgcolor="#F1F1F1">����˵����</td>
      <td colspan="2" bgcolor="#F1F1F1">Ĭ������Ϊ123456</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center">��ʵ������</td>
      <td colspan="2"><input name="tname" type="text" class="txt_box" id="tname" /></td>
    </tr>
    <tr>
      <td height="28" colspan="3" valign="middle" bgcolor="#F1F1F1">�û�Ȩ�ޣ�<label>
            <input type="radio" name="term" value="1" id="term_0">
            �����û�</label>
        <label>
          <input name="term" type="radio" id="term_1" value="2" checked="CHECKED">
        �ο���ʦ</label>
        <label for="term"></label></td>
    </tr>
    <tr>
      <td height="25" align="center" bgcolor="#FFFFFF">��Ч������</td>
      <td colspan="2" bgcolor="#FFFFFF">
<div class="doc-dd">
   <input name="endtime" type="text" class="text-box" value="" placeholder="��ѡ��ʱ��" title="��ֹ�Ͻ�ʱ��" readonly="readonly" style="cursor:pointer;"/>
        ��ѡ���û��˺���Чʱ��</div>
<script >
	$( "input[name='endtime']" ).datetimepicker();
</script>      
      </td>
    </tr>
    <tr>
      <td height="34" colspan="3" align="center"><input type="submit" name="button" id="button" value="�����û�" onclick="return check_form()"/></td>
    </tr>
  </table>
</form>
