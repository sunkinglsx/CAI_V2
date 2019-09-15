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
	color: #666;
	padding: 1px;
}
#list1 a:link {
	font-size: 14px;
	color: #36F;
	text-decoration: none;
}
#list1 a:visited{
	font-size: 14px;
	color: #36F;
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
.note{
		height:60px;
		line-height:60px;
		background-color:#FFC;
		display:block;
		padding-left:10px;
}
.home{
		width:23px;
		height:21px;
		top:15px;
		left:260px;
		position:absolute;
}		

</style>
</head>

<body >
<?php require('../session.php');
			check_session();
			require('../url_deal.php');
			$cid=url_deal($_GET['cid']);	//课程ID
			$cname=url_deal($_GET['cname']);	//课程名称
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sql_home="select w_id,w_time,w_name,w_handout,w_answer from homeworks where w_cou_id=".$cid." order by w_id desc";
			$rs_home=mysql_query($sql_home,$conn);	//资源列表
?>
<div id="banner">
	<div  class="home"><a href="s_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['s_name']."—".$_SESSION['s_id'];?></a></div>
  <div class="pray">
	<?php 
		if(date("H",time())>=0&&date("H")<12)
			$noon="不是一番寒彻骨，怎得梅花扑鼻香";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="博观而约取,厚积而薄发.";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="不操千曲而后晓声,观千剑而后识器";
		else
			$noon="不登高山,不知天之高也；不临深溪,不知地之厚也";
		echo $noon;
	?></div>
</div>
<div class="icon_list">
    <div class="icon"><a href="course_list.php"><img src="../pics/icon_r1_c1.jpg" width="61" height="53"  border="0"/></a></div>
    <dd class="icon"><a href="course_list.php"><img src="../pics/icon_r1_c5.jpg" width="63" height="53"   border="0"/></a></dd>
    <dd class="icon"><a href="course_list.php"><img src="../pics/icon_r1_c3.jpg" width="66" height="53"   border="0"/></a></dd>
</div>
<div class="icon_list">
    <div class="icon_text">修习课程</div>
    <div class="icon_text">作业明细</div>
    <div class="icon_text">课程资源</div>
</div>
<div id="list1" class="list">	<!--课程列表-->
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="left" bgcolor="#FFFFFF"><font color="#CC0000">课程资源</font><font color="#CC0000"> =&gt; <?php echo $cname;?></font></td>
    </tr>
<?php  if(!$rs_home||mysql_num_rows($rs_home)==0)
			{	
?>
  <tr>
    <td height="40" colspan="4" align="left" bgcolor="#FFFFCC">&nbsp;<font color="#666666"><?php echo  $cname."暂未发布任何课程资源";?></font></td>
    </tr>
<?php }
		else{
?>
   <tr>
    <td width="7%" height="25" align="center" bgcolor="#D1D1D1">&nbsp;</td>
    <td width="53%" align="center" bgcolor="#D1D1D1">章节目录</td>
    <td width="23%" align="center" bgcolor="#D1D1D1">讲义</td>
    <td width="17%" align="center" bgcolor="#D1D1D1">作业答案</td>
  </tr>
 <?php
			 for($i=0;$i<mysql_num_rows($rs_home);$i++)
				  {
						$arr_home=mysql_fetch_array($rs_home);  
?>
  <tr>
    <td height="25" align="center"><?php echo $i+1;?></td>
    <td height="25" align="left"><?php echo $arr_home['w_name'];?></td>
    <td align="center"><a href="<?php echo "../".$arr_home['w_handout'];?>">下载</a></td>
    <td align="center">	  <?php  
	if(strtotime($arr_home['w_time'])<time())	//如果已经截止提交作业
		echo "<a href='../".$arr_home['w_answer']."'>答案</a>";
	else
		echo "答案";
	?>
</td>
  </tr>
 <?php }}?>
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