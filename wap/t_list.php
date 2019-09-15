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
	color: #C30;
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
#list3 a:link {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
	padding-bottom:4px;
	padding-top:4px;
	padding-left:20px;
	padding-right:20px;
	height:20px;
	line-height:20px;
	background-color:#39F;
	text-align:center;
	border:1px solid #069;
}
#list3 a:visited {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
	padding-bottom:4px;
	padding-top:4px;
	padding-left:20px;
	padding-right:20px;
	height:20px;
	line-height:20px;
	background-color:#39F;
	text-align:center;
	border:1px solid #069;
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
.info1{
	font-size: 13px;
	color: #FFF;
	width: 100%;
	background-color: #090;
	height: 20px;
	line-height: 20px;
	display: block;
}
.info2{
	font-size: 13px;
	color: #FFF;
	width: 100%;
	background-color: #C00;
	height: 20px;
	line-height: 20px;
	display: block;
}

</style>
</head>

<body >
<?php require('../session.php');
			check_asession();
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sql_cou="select * from course where cou_teacher='".$_SESSION['a_name']."'";
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
			$noon="进德修业，为人师表";
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
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="30" colspan="4" align="right" valign="bottom"  >
    <span style="font-size:13px; color:#C30; float:left">三金作业管理—>>教师移动端</span>
    <div id="list3" class="list"><a href="t_add_course.php">添加任课科目</a> </div>
</td>
    </tr>
  <tr>
    <td height="2" colspan="4" align="center" bgcolor="#E3E2F5"></td>
    </tr>
<?php if(!$rs_cou||mysql_num_rows($rs_cou)==0)
				echo "<td height='150' colspan='4' align='center' bgcolor='#fff'><br/><img src='../pics/ohno.jpg' width='159' height='94' /></br><p>暂未开设任何任课科目</p></td></tr></table>";
			else
			{
			   for($i=0;$i<mysql_num_rows($rs_cou);$i++)
			  {
					$arr_cou=mysql_fetch_array($rs_cou);  
					$arr_home[$i][1]=$arr_cou['cou_name'];	//课程名称作为作业情况数组的每行第1列
					$arr_home[$i][0]=$arr_cou['cou_id'];	//课程编号
					$arr_home[$i][3]=$arr_cou['class_id'];	//班级编号
  ?>
</table>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td width="5%" height="84" rowspan="2" align="center" bgcolor="#FFFFCC" style="border-bottom: solid 1px #999"><?php echo $i+1;?></td>
    <td width="28%" rowspan="2" align="center" style="border-bottom: solid 1px #999"><img src="../pics/book.png" width="54" height="34" /><br />      
     <?php if($arr_cou['cou_enable']==1){?>
      	<span class="info1"><?php echo $arr_cou['cou_name'];?></span>
      <?php } else{?>
      <span class="info2"><?php echo $arr_cou['cou_name'];?></span>
      <?php }?>
      </td>
    <td width="42%" align="center"  ><?php echo $arr_cou['class_id']."班";?></td>
    <td width="25%" align="center"  ><?php echo "第". $arr_cou['cou_term']."学期";?></td>
  </tr>
  <tr>  
    <?php if($arr_cou['cou_enable']==1){?>
    <td height="67" align="center" style="border-bottom: solid 1px #999; margin-top:3px;">
    <a href="t_del_course.php?couid=<?php echo $arr_home[$i][0];?>">关闭课程</a><p></p><a href="t_student.php?cid=<?php echo $arr_home[$i][3];?>">学生管理</a></td>
    <td align="center" style="border-bottom: solid 1px #999; margin-top:3px;"> <a href="t_add_homework.php?cid=<?php echo $arr_cou['class_id'];?>&couname=<?php echo  $arr_cou['cou_name'];?>&couid=<?php echo $arr_home[$i][0];?>">发布作业</a> <p></p>
    <a href="t_homeworks.php?couname=<?php echo $arr_cou['cou_name'];?>&cid=<?php echo $arr_cou['class_id'];?>&couid=<?php echo $arr_home[$i][0];?>">作业列表</a></td>
 	<?php } else{?>
    <td height="67" align="center" style="border-bottom: solid 1px #999; margin-top:3px;">
    <a href="t_start_course.php?couid=<?php echo $arr_home[$i][0];?>">开启课程</a></td>
    <td align="center" style="border-bottom: solid 1px #999; margin-top:3px;">
    <a href="t_student.php?cid=<?php echo $arr_home[$i][3];?>">学生管理</a></td><?php }?>
  </tr>
  <?php }?>
</table>
<?php }?>
</div>
<div id="bottom" class="bottom">
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