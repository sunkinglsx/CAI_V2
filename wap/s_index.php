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
</style>
</head>

<body >
<?php require('../session.php');
			check_session();
			require('../term.php');
			$term=term($_SESSION['s_id']);
			$class=substr($_SESSION['s_id'],0,6);
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sql_cou="select * from course where class_id='".$class."' and cou_term=".$term." and cou_enable=1";
			$rs_cou=mysql_query($sql_cou,$conn);	//课程列表
			$arr_sourse=array();		//课程资源数组
			$arr_stu_home=array();	//学生作业情况数组
?>
<div id="banner">
	<div  class="home"><a href="s_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['s_name']."—".$_SESSION['s_id'];?></a></div>
  <div class="pray">
	<?php 
		if(date("H",time())>=0&&date("H")<12)
			$noon="一年之计在于春，一日之计在于晨";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="一寸光阴一寸金，寸金难买寸光阴";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="书山有路勤为径，学海无涯苦作舟";
		else
			$noon="读书当惜三余：冬者岁之余，夜者日之余，阴雨者时之余也";
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
<?php if(!$rs_cou)
				echo "本学期暂无修习课程";
			else
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="3" align="center" bgcolor="#E3E2F5">修习课程</td>
    </tr>
  <?php for($i=0;$i<mysql_num_rows($rs_cou);$i++)
  {
	  	$arr_cou=mysql_fetch_array($rs_cou);  
		$arr_stu_home[$i][1]=$arr_cou['cou_name'];	//课程名称作为学生作业情况数组的每行第1列
		$arr_stu_home[$i][0]=$arr_cou['cou_id'];
		$sql_source="select *  from homeworks where w_cou_id=".$arr_cou['cou_id']." order by w_id desc";	//查出每门课程的资源
		$rs_source=mysql_query($sql_source,$conn);	//资源列表
		if($rs_source)	//资源不为空，压入资源数组（二维）
		{
			$arr_stu_home[$i][2]=mysql_num_rows($rs_source);	//学生作业情况数组第2列为该门课程的已布置作业次数
			$arr_stu_home[$i][3]=0;	////学生作业情况数组第2列为该门课程的已提交作业次数
			$arr_stu_home[$i][4]=0;	////学生作业情况数组第2列为该门课程的未提交作业次数
			for($j=0;$j<mysql_num_rows($rs_source);$j++)
			{
				$tmp=mysql_fetch_array($rs_source);
				array_push($arr_sourse,$tmp);
				$sqls="select * from stu_works where w_id=".$tmp['w_id']." and s_id='".$_SESSION['s_id']."'";	//检查学生是否已交作业
				$rs=mysql_query($sqls,$conn);
				if($rs)
					$arr_stu_home[$i][3]+=1;
				else
					$arr_stu_home[$i][4]+=1;
			}
		}
  ?>
  <tr>
    <td width="16%" height="25" align="center"><?php echo $i+1;?></td>
    <td width="51%" align="center"><?php echo $arr_cou['cou_name'];?></td>
    <td width="33%" align="center"><?php echo "第".$term."学期";?></td>
  </tr>
 <?php }?>
</table>
</div>
<div id="list2" class="list">	<!--作业明细-->
<?php 
//查出该生本学期全部科目的全部作业
	$homework_total=0;	//全部作业次数
	$homework_handin=0;	//已交作业次数
	$homework_nohandin=0;	//未交作业次数
	for($i=0;$i<mysql_num_rows($rs_cou);$i++)
	{
		$sqls_hom="select * from homeworks where w_term=".$term." and w_cou_id='".$class."'";
		$rs_home=mysql_query($sqls_hom,$conn);
	}
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="center" bgcolor="#E3E2F5">作业总况</td>
    </tr>
   <?php 
   	for($i=0;$i<count($arr_stu_home);$i++){
   ?>
  <tr>
    <td width="40%" height="25" align="center"><a href="homework_list.php?cid=<?php echo $arr_stu_home[$i][0];?>&cname=<?php echo $arr_stu_home[$i][1];?>"><?php echo $arr_stu_home[$i][1];?></a></td>
    <td width="20%" align="left"><?php echo $arr_stu_home[$i][2];?> 次作业</td>
    <td width="20%" align="left"><font color="#33CC33">[已交]<?php echo $arr_stu_home[$i][3];?>次</font></td>
    <td width="20%" align="left"><font color="#CC3300">[未交]<?php echo $arr_stu_home[$i][4];?>次</font></td>
  </tr>
  <?php }?>
</table>

</div>
<div id="list3" class="list">	<!--讲义资源-->
<?php 
	if(count($arr_sourse)==0)
		echo "暂无老师发布任何课程资源";
	else
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="center" bgcolor="#E3E2F5">课程资源</td>
    </tr>
    <?php 
	for($i=0;$i<count($arr_sourse);$i++)
	{
	?>
  <tr>
    <td width="8%" height="25" align="center"><?php  echo $i+1;?></td>
    <td width="56%"><?php  echo $arr_sourse[$i]['w_name'];?></td>
    <td width="18%">
	  <span class="table">
	  <?php  
	echo "<a href='../".$arr_sourse[$i]['w_handout']."'>讲义</a>";
	?>
	  </span>    </td>
    <td width="18%">
	  <span class="table">
	  <?php  
	if(strtotime($arr_sourse[$i]['w_time'])<time())	//如果已经截止提交作业
		echo "<a href='../".$arr_sourse[$i]['w_answer']."'>答案</a>";
	else
		echo "答案";
	?>
	  </span>    </td>
  </tr>
  <?php }?>
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