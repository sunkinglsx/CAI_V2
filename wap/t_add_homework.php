<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>三金作业管理系统</title>
<style type="text/css">
#banner {
	height: 135px;
	width: 100%;
	background:url(../pics/wap_banner.jpg) no-repeat ;
	background-size:100%;
	vertical-align:central;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.logout{
		width:24px;
		height:13px;
		top:15px;
		left:300px;
		position:absolute;
}	
.home{
		width:23px;
		height:21px;
		top:15px;
		left:260px;
		position:absolute;
}		
a:link {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
}
a:visited {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
}
a:hover {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
}
.user{
	text-align:center;
	color:#FF0;
	font-size:14px;
	width:70%;
	top:50px;
	left:40px;
	position:absolute;
}
.icon_list{
	width:100%;
	display:inline-block;
}
.icon{
	height:53px;
	width:32%;
	text-align:center;
	display:inline-block;
	margin:0;
}
.icon_text{
	font-size:14px;
	color:#36C;
	text-align:center;
	width:32%;
	display:inline-block;
	height:20px;
	line-height:20px;
}
.pray{
	width:95%;
	font-size:13px;
	color:#FFF;
	top:90px;
	left:8px;
	position:absolute;
	text-align:center;
}
.t_list{
	font-size: 14px;
	color: #999;
	padding: 1px;
}
#list1 a:link {
	font-size: 14px;
	color: #69C;
	text-decoration: none;
	padding-left:10px;
	padding-right:10px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px  solid #999;
	background-color:#FFC;
}
#list1 a:visited {
	font-size: 14px;
	color: #69C;
	text-decoration: none;
	padding-left: 10px;
	padding-right: 10px;
	padding-top: 2px;
	padding-bottom: 2px;
	border: 1px solid #999;
	background-color: #FFC;
}
.list{
	margin-top:3px;
	visibility:visible;
}
.bottom{
	width:100%;
	background-color:#9398F9;
	color:#FFF;
	font-size:13px;
	margin-top:5px;
}
.info{
	font-size:13px;
	color:#FFF;
	width:100%;
	background-color:#63C;
	height:20px;
	line-height:20px;
	display:block;
}
.txt_box {height: 20px;
	width: 95%;
}
#tmain {font-size: 12px;
	color: #333;
	text-decoration: none;
	background-color: #F1F1F1;
}
#list1 form #tmain tr td #button {
	font-size: 14px;
	color: #FFF;
	text-decoration: none;
	background-color: #0C0;
	height: 30px;
	width: 300px;
	border: 1px solid #0C3;
}
#error {
	background-color: #36C;
	width: 66%;
	height:150px;
	display:hidden;
	border-radius:5px;
	margin-left:-33%;
	margin-top:-75px;
	top:50%;
	left:50%;
	-webkit-box-shadow:2px 2px 6px #999;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=5);
	box-shadow: 2px 2px 10px #909090;	/*IE9或chrome*/
	font-size:14px;
	color:#36C;
	text-align:center;
	position:absolute;
}
#error .msg_bottom #button {
	font-size: 14px;
	color: #FFF;
	text-decoration: none;
	background-color: #36C;
	height: 30px;
	width: 50%;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.msg_title{
	background-color:#36C;
	font-size:16px;
	color:#FFF;
	height:30px;
	line-height:30px;
	text-align:center;
	width:96%;
}
.msg_content{
	background-color:#FFF;
	height:70px;
	text-align:left;
	width:100%;
}
.msg_bottom{
	background-color:#FFF;
	height:50px;
	text-align:center;
}
</style>
</head>

<body >
<?php require('../session.php');
			check_asession();
			require('../term.php');
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			require('../url_deal.php');
			$couid=url_deal($_GET['couid']);	//课程编号
			if(isset($_GET['couname']))
				$couname=url_deal($_GET['couname']);	//课程名称
			else
				$couname="|";
			$cid=url_deal($_GET['cid']);	//班级编号
			$term=term($cid);	//学期
?>
<div id="banner">
	<div  class="home"><a href="t_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['t_name']."老师";?></a></div>
  <div class="pray">
	<?php 
			$noon="惟将岁月酬书卷，长慰春风作育人";
		echo $noon;
	?></div>
</div>
<div class="icon_list">
    <div class="icon"><a href="t_list.php"><img src="../pics/course.jpg" width="51" height="53"  border="0"/></a></div>
    <dd class="icon"><a href="t_list.php"><img src="../pics/homeworks.jpg" width="51" height="53"   border="0"/></a></dd>
    <dd class="icon"><a href="t_list.php"><img src="../pics/students.jpg" width="57" height="53"   border="0"/></a></dd>
</div>
<div class="icon_list">
    <div class="icon_text">课程管理</div>
    <div class="icon_text">作业管理</div>
    <div class="icon_text">学生管理</div>
</div>
<div id="list1" class="list">	<!--管理列表-->
<form action="" method="post" name="form1" id="form1">
  <table width="100%" height="233" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="2" bgcolor="#FFFFCC">发布作业-&gt;&gt;<?php echo $cid;?>-&gt;&gt;<?php echo $couname;?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="20%" height="33" align="center" bgcolor="#F1F1F1">作业标题：</td>
      <td width="80%" bgcolor="#F1F1F1"><label for="h_title"></label>
      <input name="h_title" type="text" class="txt_box" id="h_title" /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center">提交类型：</td>
      <td>        <label>
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
          docx</label><br/>
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
</td>
    </tr>
    <tr>
      <td height="24" align="center" bgcolor="#F1F1F1">作业要求：</td>
      <td height="24" bgcolor="#F1F1F1"><label for="h_content"></label>
        <textarea name="h_content" id="h_content" cols="45" rows="5" style="width:95%; height:80px;"></textarea></td>
      </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">截止时间：</td>
      <td bgcolor="#FFFFFF"><label for="cname"><input name="wtime" type="datetime-local" class="txt_box" id="wtime" /></label></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#F1F1F1">提示说明：</td>
      <td bgcolor="#F1F1F1"><span style="color:#C00; font-size:13px;">手机端作业作布为简约版，完整的作业发布功能，请登录PC端。</span></td>
    </tr>
    <tr>
      <td height="34" colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="保存作业" onclick="return check_form()"/></td>
    </tr>
  </table>
  </form>
</div>
<div class="bottom">
<table border="0" width="100%">
<tr>
  <td height="27" align="right" > Sunking's CAI System-2017<br />
    设计开发：Sunkinglsx<br />
    欢迎反馈交流，请扫描右边微信二维码</td> 
    <td width="94" align="right"><img src="../pics/wx.jpg" width="90" height="75" /></td>
  </tr>
</table></div>
<?php
	if(isset($_POST['button']))
	{
	$ext="";	//上交后缀名
	if(isset($_POST['ext']))
	{
		foreach($_POST['ext'] as $e)
		{
			$ext.=$e."#";
		}
		$ext=substr($ext,0,strlen($ext)-1);
	}
	else
	{
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					 <br>请选择学生作业的文件类型！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定" onclick="document.getElementById('error').style.visibility='hidden'"/>
					</div>
				</div>
err;
exit;
	}
	
	if(!isset($_POST['h_content'])||$_POST['h_content']=="")
	{
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					 <br>请填写作业内容与要求！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定" onclick="document.getElementById('error').style.visibility='hidden'"/>
					</div>
				</div>
err;
exit;
	}
	else
	{
			$require=$_POST['h_content'];	//作业内容
	}
	if(!isset($_POST['h_title'])||$_POST['h_title']=="")
	{
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					 <br>请填写作业标题！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定" onclick="document.getElementById('error').style.visibility='hidden'"/>
					</div>
				</div>
err;
exit;
	}
	else
	{
			$wtitle=$_POST['h_title'];		//作业标题
	}
	if(!isset($_POST['wtime'])||$_POST['wtime']=="")
	{
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					 <br>请选择作业的最后截止上交时间！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定" onclick="document.getElementById('error').style.visibility='hidden'"/>
					</div>
				</div>
err;
exit;
	}
	else
	{
			$wtime=$_POST['wtime'];	//截止时间
	}
	mysql_query("SET NAMES 'gbk'");
		$sqls="insert into homeworks(w_name,w_require,w_time,w_class,w_term,w_cou_id,w_exten) values(
		'".$wtitle."','".$require."','".$wtime."','".$cid."',".$term.",".$couid.",'".$ext."')";
		$rs=mysql_query($sqls,$conn);
		if($rs)
		{		
echo <<<err
				<div id="error">
					<div class="msg_title" >提示</div>
					<div class="msg_content"> 
					 <br>一条作业发布成功！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='t_list.php'"/>
					</div>
				</div>
err;
		}
		else
		{
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					 <br>作业发布失败，请检查内容是否完整或重新发布！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定" onclick="document.getElementById('error').style.visibility='hidden'"/>
					</div>
				</div>
err;
		}
	}
?>
</body>
</html>