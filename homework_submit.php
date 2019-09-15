<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>三金作业系统&mdash;作业提交</title>
<style type="text/css">
#form1 #t_main {
	font-size: 12px;
	text-decoration: none;
	background-color: #FFF;
	width:1000px;
}
.txt_red {
	color: #C00;
}
#form1 #t_main tr #wt {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E5F1FF;
	border-left-color: #DDECFF;
}
#form1 #t_main tr #w_file {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-top-color: #E5F1FF;
	border-left-color: #E2EEFE;
	border-right-color: #E5F1FF;
}
#form1 #t_main tr #w_about {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E2EEFE;
	border-left-color: #E2EEFE;
}
#form1 #t_main tr #w_ly {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E2EEFE;
	border-left-color: #E2EEFE;
}
#form1 #t_main tr #lynr {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E2EEFE;
	border-left-color: #E2EEFE;
}
.txt_blue {
	font-size: 12px;
	color: #03F;
	text-decoration: none;
}
</style>
<link rel="stylesheet" href="themes/default/default.css" />
<style type="text/css">
body {
	background-color: #F4F4F4;
}
</style>
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
</head>

<body>
<?php
		require("session.php");
		require("url_deal.php");		//url检查文件
		check_session();//检查是否登录
		$couid=url_deal($_GET['couid']);
	if(isset($_GET['wid']))		//作业号
	{
		$wid=url_deal($_GET['wid']);
		if(intval($wid)!=$wid)
		{
			echo "发生不可继续的错误1，系统中断";
			exit;
		}
		else
		{			$_SESSION['wid']=$wid;		}//保存作业号	
	}
	else
		{
			if(!isset($_SESSION['wid']))	
				{
					echo "发生不可继续的错误2，系统中断";
					exit;
				}
		}
	if(isset($_GET['t']))		//学期
	{
		$t=url_deal($_GET['t']);
		if(intval($t)!=$t)
		{
			echo "发生不可继续的错误3，系统中断";
			exit;
		}
	}
		require("db_connect.php");	//数据库
		mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
		$wsqls="select * from homeworks where w_id=".$wid;
		$wrs=mysql_query($wsqls,$conn);	//查出要提交的作业内容
		if($wrs)
		{
			$w_arr=mysql_fetch_array($wrs);	//转换为数组
		}
		$cousqls="select * from course where cou_id=".$couid;
		$crs=mysql_query($cousqls,$conn);
		$cou_arr=mysql_fetch_array($crs);
?>
<form action="homework_save.php?wid=<?php echo $wid;?>&amp;t=<?php echo $term;?>"  method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="800" height="675" border="0" align="center" cellpadding="0" cellspacing="0" id="t_main">
    <tr>
      <td height="46" colspan="2" align="center" bgcolor="#CDE1F3"><span style="font-size:20px">作业提交</span></td>
    </tr>
    <tr>
      <td height="28" valign="middle" bgcolor="#FFFFE1" id="wt">【课程科目】<?php echo $cou_arr['cou_name'];?>
        <input name="couid" type="hidden" id="couid" value="<?php echo $couid;?>" /></td>
      <td align="center" valign="middle" bgcolor="#FFFFE1" id="wt"><a href="homework_list.php?couid=<?php echo $couid;?>">返回作业列表&gt;&gt;</a></td>
    </tr>
    <tr>
      <td height="122" colspan="2" valign="top" id="wt"><table width="100%" height="238" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="94" height="32" align="center">作业题目</td>
          <td colspan="3" class="txt_red"><?php echo $w_arr['w_name'];?></td>
          </tr>
        <tr>
          <td height="32" align="center">截止时间</td>
          <td width="420" class="txt_red"><?php echo $w_arr['w_time'];?>
            <input type="hidden" name="endtime" id="endtime"  value="<?php echo $w_arr['w_time'];?>"/></td>
          <td width="78" align="center">面向班级</td>
          <td width="406" class="txt_red"><?php echo $w_arr['w_class'];?></td>
        </tr>
        <tr>
          <td height="174" colspan="4" valign="top">【要求】<span class="txt_blue"><?php echo $w_arr['w_require'];?></span></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="41" colspan="2" align="left" id="w_file">【作业文件上传】
        <label for="w_files"></label>
      <input type="file" name="w_files" id="w_files" /></td>
    </tr>
    <tr>
      <td height="43" colspan="2" align="left" bgcolor="#FFFFE1" id="w_about">
      说明：本次作业文件只支持以下格式：
	 <span class="txt_red"> <?php
	  	$ext=explode("#",$w_arr['w_exten']);
		foreach($ext as $e)
		{
			echo $e."   ";
		}
	  ?></span>
      </td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="left" id="w_ly">【备注留言】（与作业有关的备注、问题，请给老师留言,500字以内）</td>
    </tr>
    <tr>
      <td height="139" colspan="2" valign="top" id="lynr">
      <textarea name="content" style="width:100%; height:200px;">
</textarea>

      </td>
    </tr>
    <tr>
      <td height="37" colspan="2" align="center" bgcolor="#E2EEFE"><input type="submit" name="button" id="button" value="确定上交" />
        <a href="homework_list.php"></a></td>
    </tr>
  </table>
</form><br />
<?php require("about.html");?>
</body>
</html>