<style type="text/css">
body {
	margin-top: 0px;
}
#tmain {
	border: 1px solid #EBEBEB;
	font-size: 12px;
	color: #069;
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
	check_asession()	;       //�����û�session���
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	require("db_connect.php");	//�������ݿ�����
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("url_deal.php");
	$cid=url_deal($_GET['cid']);		//�༶���
	$couid=url_deal($_GET['couid']);		//�γ̱��
	//����ð���ſγ���Ϣ
	$sqls="select * from course where cou_id=".$couid." and class_id='".$cid."'";
	$rs_cou=mysql_query($sqls,$conn);
	if($rs_cou&&mysql_num_rows($rs_cou)>0)
	{
		$arr_cou=mysql_fetch_array($rs_cou);
	}
?>
<form action="a_homework_save.php" method="post" enctype="multipart/form-data" name="form1">
  <table width="820" height="567" border="0" align="center" cellpadding="0" cellspacing="0" id="tmain">
    <tr>
      <td height="27" colspan="2" bgcolor="#FDFAC1">   ��̨��ҳ ������ѧ����ҵ��<?php echo $cid;?>��<?php echo $arr_cou['cou_name'];?></td>
    </tr>
    <tr>
      <td width="130" height="35" align="center" bgcolor="#DADFED">��ҵ����</td>
      <td width="690" bgcolor="#EBEBEB"><label for="wtitle"></label>
      <input name="wtitle" type="text" class="text-box" id="wtitle"></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#D5F4F4">���ð༶�γ�</td>
      <td>
      <?php
	  echo $cid."�ࡶ".$arr_cou['cou_name']."��"?>
        <input type="hidden" name="wclass" id="wclass"  value="<?php echo $cid;?>"/>
        <input type="hidden" name="couid" id="couid"  value="<?php echo $couid;?>"/></td>
    </tr>
    <tr>
      <td height="37" align="center" bgcolor="#DADFED">�ؽ�ʱ��</td>
      <td bgcolor="#EBEBEB"><input name="wtime" type="text" class="text-box" value="" placeholder="��ѡ��ʱ��" title="��ֹ�Ͻ�ʱ��" readonly="readonly" style="cursor:pointer;"/>
<script >
	$( "input[name='wtime']" ).datetimepicker();
</script>      </td>
    </tr>
    <tr>
      <td height="32" align="center" bgcolor="#D5F4F4">ʹ��ѧ��</td>
      <td><label for="wterm"></label>
        <select name="wterm" id="wterm">
        <?php for($t=1;$t<=6;$t++)
		{
			if($t==$arr_cou['cou_term'])		//���ǿ���ѧ��
				echo "<option value=".$t." selected='selected'>��".$t."ѧ��</option>";
			else
				echo "<option value=".$t.">��".$t."ѧ��</option>";
			
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td height="32" align="center" bgcolor="#DADFED">�����ύ��׺��</td>
      <td bgcolor="#DADFED"><p>
        <label>
          <input type="checkbox" name="ext[]" value="php" id="ext_0" />
          php</label>
        <label>
          <input type="checkbox" name="ext[]" value="txt" id="ext_1" />
          txt</label>
        <label>
          <input type="checkbox" name="ext[]" value="doc" id="ext_2" />
          doc</label>
        <label>
          <input type="checkbox" name="ext[]" value="docx" id="ext_3" />
          docx</label>
        <label>
          <input type="checkbox" name="ext[]" value="zip" id="ext_4" />
          zip</label>
        <label>
          <input type="checkbox" name="ext[]" value="rar" id="ext_5" />
          rar</label>
        <label>
          <input type="checkbox" name="ext[]" value="pdf" id="ext_6" />
          pdf</label>
        <label>
          <input type="checkbox" name="ext[]" value="html" id="ext_7" />
          html</label>
        <label>
          <input type="checkbox" name="ext[]" value="jpg" id="ext_8" />
          jpg</label>
        <label>
          <input type="checkbox" name="ext[]" value="png" id="ext_9" />
          png</label>
        <label>
          <input type="checkbox" name="ext[]" value="gif" id="ext_10" />
          gif</label>
        <br />
      </p></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#D5F4F4">�Ƿ���Ҫ����</td>
      <td bgcolor="#FFFFFF"><p>
        <label>
          <input type="radio" name="needcheck" value="1" id="needcheck_0" />
          ��</label>
        <label>
          <input name="needcheck" type="radio" id="needcheck_1" value="0" checked="checked" />
          ��</label>
      </p></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#DADFED">�ο���</td>
      <td bgcolor="#DADFED"><label for="wanswer"></label>
      <input type="file" name="wanswer" id="wanswer"></td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#D5F4F4">�ο�����</td>
      <td bgcolor="#FFFFFF"><label for="whandout"></label>
      <input type="file" name="whandout" id="whandout"></td>
    </tr>
    <tr>
      <td height="24" colspan="2" bgcolor="#DADFED">��Ŀ����</td>
    </tr>
    <tr>
      <td colspan="2"><label for="content"></label>
      <textarea name="content" id="content" style="width:815px; height:200px;"></textarea></td>
    </tr>
    <tr>
      <td height="38" colspan="2" align="center" bgcolor="#EBEBEB"><input type="submit" name="button" id="button" value="�ύ����" onclick="return check()"></td>
    </tr>
  </table>
</form>
