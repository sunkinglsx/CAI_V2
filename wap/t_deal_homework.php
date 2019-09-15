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
	font-size: 13px;
	color: #666;
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
	text-align:center;
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
.t_list1 {	font-size: 13px;
	color: #666;
	padding: 1px;
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
			if(isset($_GET['page']))
			{
				$page=url_deal($_GET['page']);	//页码
			}
			else
			{
				$page=1;
			}
			$offset=($page-1)*20;	//当前开始记录指针
			$wid=url_deal($_GET['wid']);	//作业编号
			$wname=url_deal($_GET['wname']);	//作业名称
			$sqls_total="select * from stu_works where w_id=".$wid;
			$rs_total=mysql_query($sqls_total,$conn);
			$stu_total=mysql_num_rows($rs_total);	//总人数
			$page_count=ceil($stu_total/20);	//总页数
			$sql="select * from stu_works where w_id=".$wid." order by s_time desc limit ".$offset.",15";
			$rs_home=mysql_query($sql,$conn);
?>
<div id="banner">
	<div  class="home"><a href="t_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['t_name']."老师";?></a></div>
  <div class="pray">
	<?php 
			$noon="黑发积霜织日月，粉笔无言写春秋";
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
    <td height="30" colspan="4" align="right" valign="middle"  >
    <span style="font-size:13px; color:#C30; float:left">批阅作业->><?php echo $wname;?></span>
    </td>
    </tr>
  <tr>
    <td height="2" colspan="3" align="center" bgcolor="#E3E2F5"></td>
    </tr>
<?php if(!$rs_home||mysql_num_rows($rs_home)==0)
				echo "<td height='150' colspan='4' align='center' bgcolor='#fff'><p>本次作业暂未任何学生提交</p></td></tr></table>";
			else
			{
			   for($i=0;$i<mysql_num_rows($rs_home);$i++)
			  {
					$arr_home=mysql_fetch_array($rs_home);  
  ?>
</table>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="t_list">
  <?php if($i%2==1){	?>
  <tr onclick="location.href='t_stu_work.php?wid=<?php echo $wid;?>&wname=<?php echo $wname;?>&id=<?php echo $arr_home['id'];?>'">
    <td width="40%" height="25" align="center" valign="middle" ><?php echo $arr_home['s_id'];?></td>
    <td width="40%" align="center"  ><?php echo $arr_home['s_time'];?></td>
    <td width="20%" align="center" >
    <?php if($arr_home['is_deal']==0)
					echo "<span style='color:#FF0000;'>未批阅</span>";
				else
					echo "<span style='color:#00AA00;'>".$arr_home['is_deal']."分</span>";
	?>
    </td>
  </tr>
  <?php }
  else{
  ?>
  <tr onclick="location.href='t_stu_work.php?wid=<?php echo $wid;?>&wname=<?php echo $wname;?>&id=<?php echo $arr_home['id'];?>'">
    <td width="40%" height="25" align="center" valign="middle" bgcolor="#E3E2F5"><?php echo $arr_home['s_id'];?></td>
    <td width="40%" align="center" bgcolor="#E3E2F5"><?php echo $arr_home['s_time'];?></td>
    <td width="20%" align="center" bgcolor="#E3E2F5">
    <?php if($arr_home['is_deal']==0)
					echo "<span style='color:#FF0000;'>未批阅</span>";
				else
					echo "<span style='color:#00AA00;'>".$arr_home['is_deal']."分</span>";
	?>
    </td>
  </tr>
  <?php }}?>
</table>
<?php }?>
<div class="list">
<?php
if($page_count>1){
 for($i=1;$i<=$page_count;$i++)
{	echo "<a href='t_deal_homework.php?wname=".$wname."&wid=".$wid."&page=".$i."'>".$i."</a>"; echo "&nbsp;";}}
?>
</div></div>
<div class="bottom">
<table border="0" width="100%">
<tr>
  <td height="27" align="right" > Sunking's CAI System-2017<br />
    设计开发：Sunkinglsx<br />
    欢迎反馈交流，请扫描右边微信二维码</td> 
    <td width="94" align="right"><img src="../pics/wx.jpg" width="90" height="75" /></td>
  </tr>
</table>
</body>
</html>