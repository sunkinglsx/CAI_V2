<style type="text/css">
#form1 #dtable {
	width: 950px;
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
<link rel="stylesheet" href="themes/default/default.css" />
<script charset="utf-8" src="kindeditor-min.js"></script>
<script charset="utf-8" src="lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('textarea[name="content"]', 
{allowFileManager : true	
});
		});
</script>
<link type="text/css" rel="stylesheet" href="css/lanrenzhijia.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery-3.2.1.js"></script>
<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>
<script src="js/jquery-ui-timepicker-zh-CN.js"></script>
 <?php
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gbk'");
	check_asession();	//������Ա�Ƿ��¼
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	$did=$_GET['did'];
	$dname=$_GET['dname'];
	$classid=$_GET['classid'];
?>
<form id="form1" name="form1" method="post" action="a_design_title_save.php">
  <table width="933" height="470" border="0" align="center" cellpadding="0" cellspacing="0" id="dtable">
    <tr>
      <td height="35" colspan="2" bgcolor="#FFFFCC">&gt;&gt;�����γ���ơ��������ѡ�⡷<?php echo $dname;?></td>
    </tr>
    <tr>
      <td height="37" align="center">����γ���ƣ�</td>
      <td><?php echo $dname;?>
      <input name="did" type="hidden" id="did" value="<?php echo $did;?>">
      <input name="dname" type="hidden" id="dname" value="<?php echo $dname;?>" />
      <input name="classid" type="hidden" id="classid" value="<?php echo $classid;?>" /></td>
    </tr>
    <tr>
      <td width="118" height="33" align="center" bgcolor="#E7E7E7">���ѡ�����ƣ�</td>
      <td width="815" bgcolor="#E7E7E7"><label for="dt_name"></label>
      <input type="text" name="dt_name" id="dt_name" width="300" /></td>
    </tr>
    <tr>
      <td height="37" align="center">����ѡ������</td>
      <td><label for="takers"></label>
        <select name="takers" id="takers">
          <option value="1">1��</option>
          <option value="2">2��</option>
          <option value="3">3��</option>
          <option value="4">4��</option>
          <option value="5">5��</option>
          <option value="6">6��</option>
          <option value="7">7��</option>
          <option value="8">8��</option>
          <option value="9">9��</option>
          <option value="10">10��</option>
        </select>
         
      </td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#E7E7E7">ѡ�⽱����ֵ��</td>
      <td bgcolor="#E7E7E7"><label for="bonus"></label>
      <input name="bonus" type="text" id="bonus" value="0">
      ��</td>
    </tr>
    <tr>
      <td height="34" align="center">ѡ�����Ҫ��</td>
      <td>�������±༭���У��г���ѡ��ľ���Ҫ��</td>
    </tr>
    <tr>
      <td height="223" colspan="2" valign="top">
      <label for="content"></label>
      <textarea name="content" id="content" style="width:933px; height:223px;"></textarea>
      </td>
    </tr>
    <tr>
      <td height="36" colspan="2" align="center" bgcolor="#CCCCCC">
      <input type="submit" name="button" id="button" value="�ύ����"  />
      </td>
    </tr>
  </table>
</form>