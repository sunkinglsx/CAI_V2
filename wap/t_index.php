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
#list2 a:link {
	font-size: 14px;
	color: #999;
	text-decoration: none;
}
#list2 a:visited {
	font-size: 14px;
	color: #999;
	text-decoration: none;
}
#list3 a:link {
	font-size: 14px;
	color: #69F;
	text-decoration: none;
}
#list3 a:visited {
	font-size: 14px;
	color: #69F;
	text-decoration: none;
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
}
.info{
	font-size:13px;
	color:#F60;
}
</style>
</head>

<body >
<?php require('../session.php');
			check_asession();
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sql_cou="select * from course where cou_teacher='".$_SESSION['a_name']."' and  cou_enable=1";
			$rs_cou=mysql_query($sql_cou,$conn);	//讲授课程列表
			$arr_class=array();		//任课班级数组
			$arr_home=array();	//作业情况数组
?>
<div id="banner">
	<div  class="home"><a href="t_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['t_name']."老师";?></a></div>
  <div class="pray">
	<?php 
			$noon="师者，所以传道授业解惑也";
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
<div id="list1" class="list">	<!--课程列表-->
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="center" bgcolor="#E3E2F5">我的讲授课程</td>
    </tr>
<?php if(!$rs_cou)
				echo "<td height='40' colspan='4' align='center' bgcolor='#ffc'><span class='info'>暂未开设任何讲授课程</span></td>";
			else
			{
?>
  <?php for($i=0;$i<mysql_num_rows($rs_cou);$i++)
  {
	  	$arr_cou=mysql_fetch_array($rs_cou);  
		$arr_home[$i][1]=$arr_cou['cou_name'];	//课程名称作为作业情况数组的每行第1列
		$arr_home[$i][0]=$arr_cou['cou_id'];	//课程编号
		$arr_home[$i][3]=$arr_cou['class_id'];	//班级编号
  ?>
  <tr>
    <td width="5%" height="25" align="center"><?php echo $i+1;?></td>
    <td width="50%" align="center"><?php echo $arr_cou['cou_name'];?></td>
    <td width="20%" align="center"><?php echo "第". $arr_cou['cou_term']."学期";?></td>
    <td width="25%" align="center"><?php echo $arr_cou['class_id']."班";?></td>
  </tr>
 <?php }?>
</table>
<?php }?>
</div>
<div id="list2" class="list">	<!--发布的作业-->
<?php 
//查出该 老师布置的全部科目的全部作业
	for($i=0;$i<count($arr_home);$i++)
	{
		$sqls_hom="select count(w_id) from homeworks where  w_cou_id='".$arr_home[$i][0]."'";
		$rs_home=mysql_query($sqls_hom,$conn);
		$tmp=mysql_fetch_array($rs_home);
		$arr_home[$i][2]=$tmp[0];	//每门课程已布置的作业的次数
	}
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="center" bgcolor="#E3E2F5">我发布的作业</td>
    </tr>
   <?php 
   	for($i=0;$i<count($arr_home);$i++){
   ?>
  <tr>
    <td width="5%" height="25" align="center"><?php echo $i+1;?></td>
    <td width="50%" height="25" align="center"><?php echo $arr_home[$i][1];?> </td>
    <td width="25%" height="25" align="center"><?php echo $arr_home[$i][3];?> </td>
    <td width="20%" align="left"><?php echo $arr_home[$i][2];?> 次作业</td>
  </tr>
  <?php }?>
</table>

</div>
<div id="list3" class="list">	<!--班级概况-->
<?php 
	if(count($rs_cou)==0)
		echo "暂无任何任课班级";
	else
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="center" bgcolor="#E3E2F5">我的授课班级</td>
    </tr>
    <?php 
			$sql_class="select  c_id,c_name from class where c_teacher='".$_SESSION['a_name']."'";
			$rs_class=mysql_query($sql_class,$conn);
			if(!$rs_class||mysql_num_rows($rs_class)==0)
			{?>
  <tr>
    <td height="25" colspan="4" align="left" bgcolor="#FFFFCC">暂无授课班级</td>
    </tr>
<?php			}
			else
			{for($i=0;$i<mysql_num_rows($rs_class);$i++){
			$class=mysql_fetch_array($rs_class);
			$class_name=$class['c_name'];	//班级名称
			$sql_students="select count(s_id) from students where s_class='".$class['c_id']."'";
			$rs_students=mysql_query($sql_students,$conn);
			$students=mysql_fetch_array($rs_students);
			$students_count=$students[0];	//班级人数
	?>
  <tr>
    <td width="5%" height="25" align="center"><?php echo $i+1;?></td>
    <td width="50%" align="center"><?php  echo $class_name;?></td>
    <td width="25%" height="25" align="center"><?php echo $arr_home[$i][3];?></td>
    <td width="20%" align="center"><?php  echo $students_count."人";?></td>
  </tr>
  <?php } } ?>
</table>
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
</body>
</html>