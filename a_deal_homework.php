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
	require("url_deal.php");
	$wid=intval(url_deal($_GET['wid']));
	$cid=url_deal($_GET['cid']);
	require("db_connect.php");	//�������ݿ�����
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	//���������ҵ
	$wsqls="select * from homeworks where w_id=".$wid;
	$wrs	=mysql_query($wsqls,$conn);
	if($wrs)
	{
		$arr_w=mysql_fetch_array($wrs);
	}
	else
	{
		echo "δ�ҵ�������ҵ��Ϣ��������ֹ";
		exit;
	}
	//����ð�ȫ���γ�
	$sqls="select * from course where class_id='".$cid."'";
	$crs=mysql_query($sqls,$conn);
	if($crs)
	{
		$course_count=mysql_num_rows($crs);
	}
?>
<form action="a_homework_save.php?eid=edit&wid=<?php echo $wid;?>" method="post" enctype="multipart/form-data" name="form1">
  <table width="820" height="367" border="0" align="center" cellpadding="0" cellspacing="0" id="tmain">
    <tr>
      <td height="27" colspan="2">����̨��ҳ ������ѧ����ҵ��<?php echo $arr_w['w_name'];?></td>
    </tr>
    <tr>
      <td width="130" height="35" align="center" bgcolor="#DADFED">��ҵ����</td>
      <td width="690" bgcolor="#EBEBEB"><label for="wtitle"></label>
      <input name="wtitle" type="text" class="text-box" id="wtitle" value="<?php echo $arr_w['w_name'];?>">
      <input type="hidden" name="wclass" id="wclass"  value="<?php echo $cid;?>"/></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#D5F4F4">���ÿγ�</td>
      <td>
      <?php
	  for($i=0;$i<$course_count;$i++)
	  {
		  $arr_course=mysql_fetch_array($crs);	//�༶ת����
	  ?>
        <label>
          <input name="couid" type="radio" id="wclass_<?php echo $i;?>" value="<?php echo  $arr_course['cou_id'];?>" 
          <?php if($arr_course['cou_id']==$arr_w['w_cou_id']) echo "checked='checked'"?>>
        <?php echo  $arr_course['cou_name'];?>&nbsp;&nbsp;</label>
        <?php }?></td>
    </tr>
    <tr>
      <td height="37" align="center" bgcolor="#DADFED">�ؽ�ʱ��</td>
      <td bgcolor="#EBEBEB"><input name="wtime" type="text" class="text-box" value="<?php echo $arr_w['w_time'];?>"  title="��ֹ�Ͻ�ʱ��" readonly="readonly" style="cursor:pointer;"/>
<script >
	$( "input[name='wtime']" ).datetimepicker();
</script> ���趨�Ľؽ�ʱ��Ϊ�� <font color="#FF0000"><?php echo $arr_w['w_time'];?></font></td>
    </tr>
    <tr>
      <td height="32" align="center" bgcolor="#D5F4F4">ʹ��ѧ��</td>
      <td><label for="wterm"></label>
        <select name="wterm" id="wterm">		
        <?php for($i=1;$i<=6;$i++){?>
          <option value="<?php echo $i;?>" <?php if($i==$arr_w['w_term']) echo "selected='selected'";?>>��<?php echo $i;?>ѧ��</option>
          <?php }?>
      </select></td>
    </tr>
    <tr>
      <td height="32" align="center" bgcolor="#D5F4F4">�����ύ��׺��</td>
      <td>  
      <?php 	//��׺��ת������
	  	$ext_list=array('php','txt','html','doc','docx','zip','rar','pdf','jpg','png','gif');
	  	$ext=explode("#",$arr_w['w_exten']);
		foreach($ext_list as $key=>$e)
		{
			if (false!==array_search($e,$ext))
			{
	  ?>
       <label>
          <input name="ext[]" type="checkbox" id="ext_<?php echo $key;?>" value="<?php echo $e;?>" checked="checked" />
          <?php echo $e;?></label>
        <?php	}	else	{?>
          <label> <input name="ext[]" type="checkbox" id="ext_<?php echo $key;?>" value="<?php echo $e;?>" />
          <?php echo $e;?></label>
       <?php		} }?>
</td>
    </tr>
    <tr>
      <td height="32" align="center" bgcolor="#D5F4F4">�Ƿ����</td>
      <td>
      <?php if($arr_w['needcheck']==1){?>
         <label> <input type="radio" name="needcheck" value="1" id="needcheck_0"  checked="checked"/>
          ��</label>
        <label>
          <input name="needcheck" type="radio" id="needcheck_1" value="0"   />
          ��</label> 
          <?php } else {?>
          <label> <input type="radio" name="needcheck" value="1" id="needcheck_0"  />
          ��</label>
        <label>
          <input name="needcheck" type="radio" id="needcheck_1" value="0"  checked="checked" />
          ��</label><?php }?>
          </td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#DADFED">�ο���</td>
      <td bgcolor="#EBEBEB"><label for="wanswer"></label>
      <input type="file" name="wanswer" id="wanswer">
      ���ϴ��Ĵ��ļ���<font color="#CC0000"><?php echo $arr_w['w_answer']; $_SESSION['answer']=$arr_w['w_answer'];?></font></td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#D5F4F4">�ο�����</td>
      <td><label for="whandout"></label>
      <input type="file" name="whandout" id="whandout" >
      ���ϴ��Ľ����ļ���<font color="#CC0000"><?php echo $arr_w['w_handout']; $_SESSION['handout']=$arr_w['w_handout'];?></font></td>
    </tr>
    <tr>
      <td height="24" colspan="2" bgcolor="#EBEBEB">��Ŀ����</td>
    </tr>
    <tr>
      <td colspan="2"><label for="content"></label>
      <textarea name="content" id="content" style="width:810px; height:200px;"><?php echo $arr_w['w_require'];?></textarea></td>
    </tr>
    <tr>
      <td height="38" colspan="2" align="center" bgcolor="#EBEBEB"><input type="submit" name="button" id="button" value="�����޸�"></td>
    </tr>
  </table>
</form>
