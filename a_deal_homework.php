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
	check_asession()	;       //管理用户session检查
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url
	require("url_deal.php");
	$wid=intval(url_deal($_GET['wid']));
	$cid=url_deal($_GET['cid']);
	require("db_connect.php");	//包括数据库连接
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	//查出该条作业
	$wsqls="select * from homeworks where w_id=".$wid;
	$wrs	=mysql_query($wsqls,$conn);
	if($wrs)
	{
		$arr_w=mysql_fetch_array($wrs);
	}
	else
	{
		echo "未找到该条作业信息，处理中止";
		exit;
	}
	//查出该班全部课程
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
      <td height="27" colspan="2">》后台首页 》管理学生作业》<?php echo $arr_w['w_name'];?></td>
    </tr>
    <tr>
      <td width="130" height="35" align="center" bgcolor="#DADFED">作业标题</td>
      <td width="690" bgcolor="#EBEBEB"><label for="wtitle"></label>
      <input name="wtitle" type="text" class="text-box" id="wtitle" value="<?php echo $arr_w['w_name'];?>">
      <input type="hidden" name="wclass" id="wclass"  value="<?php echo $cid;?>"/></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#D5F4F4">适用课程</td>
      <td>
      <?php
	  for($i=0;$i<$course_count;$i++)
	  {
		  $arr_course=mysql_fetch_array($crs);	//班级转数组
	  ?>
        <label>
          <input name="couid" type="radio" id="wclass_<?php echo $i;?>" value="<?php echo  $arr_course['cou_id'];?>" 
          <?php if($arr_course['cou_id']==$arr_w['w_cou_id']) echo "checked='checked'"?>>
        <?php echo  $arr_course['cou_name'];?>&nbsp;&nbsp;</label>
        <?php }?></td>
    </tr>
    <tr>
      <td height="37" align="center" bgcolor="#DADFED">截交时间</td>
      <td bgcolor="#EBEBEB"><input name="wtime" type="text" class="text-box" value="<?php echo $arr_w['w_time'];?>"  title="截止上交时间" readonly="readonly" style="cursor:pointer;"/>
<script >
	$( "input[name='wtime']" ).datetimepicker();
</script> 已设定的截交时间为： <font color="#FF0000"><?php echo $arr_w['w_time'];?></font></td>
    </tr>
    <tr>
      <td height="32" align="center" bgcolor="#D5F4F4">使用学期</td>
      <td><label for="wterm"></label>
        <select name="wterm" id="wterm">		
        <?php for($i=1;$i<=6;$i++){?>
          <option value="<?php echo $i;?>" <?php if($i==$arr_w['w_term']) echo "selected='selected'";?>>第<?php echo $i;?>学期</option>
          <?php }?>
      </select></td>
    </tr>
    <tr>
      <td height="32" align="center" bgcolor="#D5F4F4">允许提交后缀名</td>
      <td>  
      <?php 	//后缀名转化处理
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
      <td height="32" align="center" bgcolor="#D5F4F4">是否查重</td>
      <td>
      <?php if($arr_w['needcheck']==1){?>
         <label> <input type="radio" name="needcheck" value="1" id="needcheck_0"  checked="checked"/>
          是</label>
        <label>
          <input name="needcheck" type="radio" id="needcheck_1" value="0"   />
          否</label> 
          <?php } else {?>
          <label> <input type="radio" name="needcheck" value="1" id="needcheck_0"  />
          是</label>
        <label>
          <input name="needcheck" type="radio" id="needcheck_1" value="0"  checked="checked" />
          否</label><?php }?>
          </td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#DADFED">参考答案</td>
      <td bgcolor="#EBEBEB"><label for="wanswer"></label>
      <input type="file" name="wanswer" id="wanswer">
      已上传的答案文件：<font color="#CC0000"><?php echo $arr_w['w_answer']; $_SESSION['answer']=$arr_w['w_answer'];?></font></td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#D5F4F4">参考讲义</td>
      <td><label for="whandout"></label>
      <input type="file" name="whandout" id="whandout" >
      已上传的讲义文件：<font color="#CC0000"><?php echo $arr_w['w_handout']; $_SESSION['handout']=$arr_w['w_handout'];?></font></td>
    </tr>
    <tr>
      <td height="24" colspan="2" bgcolor="#EBEBEB">题目描述</td>
    </tr>
    <tr>
      <td colspan="2"><label for="content"></label>
      <textarea name="content" id="content" style="width:810px; height:200px;"><?php echo $arr_w['w_require'];?></textarea></td>
    </tr>
    <tr>
      <td height="38" colspan="2" align="center" bgcolor="#EBEBEB"><input type="submit" name="button" id="button" value="保存修改"></td>
    </tr>
  </table>
</form>
