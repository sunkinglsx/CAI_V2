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
	check_asession();	//检查管理员是否登录
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url
	$did=$_GET['did'];
	$dname=$_GET['dname'];
	$dtid=$_GET['dtid'];
	$classid=$_GET['classid'];
	$sqls="select * from design_titles where DT_id=".$dtid;	//查出相应的设计选题
	$rs=mysql_query($sqls);
	$rs_arr=mysql_fetch_array($rs);
?>
<form id="form1" name="form1" method="post" action="a_design_title_save.php?dtid=<?php echo $dtid;?>">
  <table width="933" height="431" border="0" align="center" cellpadding="0" cellspacing="0" id="dtable">
    <tr>
      <td height="35" colspan="2" bgcolor="#FFFFCC">&gt;&gt;管理课程设计》<?php echo $dname;?>》修改设计选题</td>
    </tr>
    <tr>
      <td width="118" height="33" align="center" bgcolor="#E7E7E7">设计选题名称：</td>
      <td width="815" bgcolor="#E7E7E7"><label for="dt_name"></label>
      <input type="text" name="dt_name" id="dt_name" width="300"  value="<?php echo $rs_arr['DT_title'];?>"/>
      <input name="did" type="hidden" id="did" value="<?php echo $did;?>">
      <input name="dname" type="hidden" id="dname" value="<?php echo $dname;?>" />
      <input name="classid" type="hidden" id="classid" value="<?php echo $classid;?>"></td>
    </tr>
    <tr>
      <td height="37" align="center">最多可选人数：</td>
      <td><label for="takers"></label>
        <select name="takers" id="takers">
        <?php for($i=1;$i<=10;$i++)
		{
			if($i==$rs_arr['DT_takers'])
			{?>
          <option value="<?php echo $i;?>" selected="selected"><?php echo $i;?>人</option>
         <?php }else{?>
		  <option value="<?php echo $i;?>"><?php echo $i;?>人</option>
         <?php }}?>
        </select>
         
      </td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#E7E7E7">选题奖励分值：</td>
      <td bgcolor="#E7E7E7"><label for="bonus"></label>
      <input name="bonus" type="text" id="bonus" value="<?php echo $rs_arr['DT_bonus'];?>">
      分</td>
    </tr>
    <tr>
      <td height="34" align="center">选题具体要求：</td>
      <td>请在以下编辑器中，列出本选题的具体要求。</td>
    </tr>
    <tr>
      <td height="223" colspan="2" valign="top">
      <label for="content"></label>
      <textarea name="content" id="content" style="width:933px; height:223px;"><?php echo $rs_arr['DT_demand'];?></textarea>
      </td>
    </tr>
    <tr>
      <td height="36" colspan="2" align="center" bgcolor="#CCCCCC">
      <input type="submit" name="button" id="button" value="保存修改"  />
      </td>
    </tr>
  </table>
</form>
