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
.list{
	margin-top:3px;
	visibility:visible;
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
.txt_box {
	height: 20px;
	width: 220px;
	border: 1px solid #999;
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
#tmain {font-size: 12px;
	color: #333;
	text-decoration: none;
	background-color: #F1F1F1;
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
	background-color: #FFF;
	height: 70px;
	text-align: left;
	width: 100%;
	text-height: auto;
	font-size: 12px;
	line-height: 22px;	
}
.msg_bottom{
	background-color:#FFF;
	height:50px;
	text-align:center;
}
#list1 form #tmain tr td #class {
	width: 220px;
	color: #39C;
	text-decoration: none;
	height: 24px;
}
#list1 form #tmain tr td #term {
	color: #39C;
	text-decoration: none;
	width: 220px;
	height: 24px;
}
.bottom{
	width:100%;
	background-color:#9398F9;
	color:#FFF;
	font-size:13px;
	margin-top:5px;
}
</style>
</head>
<body >
<?php require('../session.php');
			check_asession();
			require('../term.php');
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sql_class="select * from class where c_teacher='".$_SESSION['a_name']."' and  c_enable=1";
			$rs_class=mysql_query($sql_class,$conn);	//班级列表
			if(!$rs_class||mysql_num_rows($rs_class)==0)
			{
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					<table width="97%" align="center">
					<tr><td>
					 您尚未添加任何任课班级，请登陆系统电脑端添加任课班级，导入学生名单以后，再添加任课科目！ 
					 </td></tr></table>
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='t_list.php'"/>
					</div>
				</div>
err;
		exit;
			}
?>
<div id="banner">
	<div  class="home"><a href="t_list.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['t_name']."老师";?></a></div>
  <div class="pray">
	<?php 
			$noon="学高为师，身正为范";
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
  <table width="98%" height="197" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="3" bgcolor="#FFFFCC"> &nbsp;添加任课科目</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="98" height="33" align="center">任课班级：</td>
      <td width="728" colspan="2"><select name="class" id="class">
        <?php for($i=0;$i<mysql_num_rows($rs_class);$i++){	
			$tmp=mysql_fetch_array($rs_class);
		 	 echo "<option value=".$tmp['c_id'].">".$tmp['c_name']."</option>"; 
		  }
		  ?>
      </select></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center">科目名称：</td>
      <td colspan="2"><input name="couname" type="text" class="txt_box" id="couname" /></td>
    </tr>
    <tr>
      <td height="24" colspan="3" bgcolor="#F1F1F1">&nbsp;</td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">开设学期</td>
      <td colspan="2" bgcolor="#FFFFFF"><label for="couname"></label>
        <select name="term" id="term">
          <option value="1">第1学期</option>
          <option value="2">第2学期</option>
          <option value="3">第3学期</option>
          <option value="4">第4学期</option>
          <option value="5">第5学期</option>
          <option value="6">第6学期</option>
      </select></td>
    </tr>
    <tr>
      <td height="34" colspan="3" align="center"><input type="submit" name="button" id="button" value="保存任课科目"/></td>
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
		if(!isset($_POST['couname'])||$_POST['couname']=="")
		{
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					<table width="97%" align="center">
					<tr><td>
					 请输入您的任课科目名称！ 
					 </td></tr></table>
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='t_add_course.php'"/>
					</div>
				</div>
err;
		}
		else
		{
			$couname=$_POST['couname'];
			$term=$_POST['term'];
			$class=$_POST['class'];
			$sqls="insert into course (cou_name,class_id,cou_term,cou_teacher,cou_enable) values ('".$couname."','".$class."',".$term.",'".$_SESSION['a_name']."',1)";
			$rs=mysql_query($sqls,$conn);
			if($rs)
			{
echo <<<err
				<div id="error">
					<div class="msg_title" >提示</div>
					<div class="msg_content"> 
					<table width="97%" align="center">
					<tr><td>
					 		一条任课科目成功添加！
					 </td></tr></table>
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='t_add_course.php'"/>
					</div>
				</div>
err;
			}
		}
	}
?>
</body>
</html>