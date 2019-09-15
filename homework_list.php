<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>三金作业系统&mdash;作业情况列表</title>
<style type="text/css">
#info {
	background-color: #FCFDD0;
	border-right-width: 1px;
	border-right-style: ridge;
	border-right-color: #F0F0F0;
	border-top-width: 1px;
	border-top-style: ridge;
	border-top-color: #F0F0F0;
	border-left-width: 1px;
	border-left-style: ridge;
	border-left-color: #F0F0F0;
	font-size: 12px;
	text-decoration: none;
}
a:link {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #E3E3E3;
	border: 1px solid #999;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
a:visited {
	font-size: 13px;
	color: #009;
	text-decoration: none;
}
a:hover {
	font-size: 13px;
	color: #F60;
	text-decoration: none;
	background-color: #FFC;
	border: 1px solid #F90;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
#OD a.design:link{
	border:0px solid #FFF;
	padding:0 0 0 0;
}
#info5 {
	font-size: 12px;
	font-weight: bold;
}
#t_main {
	background-color: #D8D8D8;
	font-size: 12px;
	margin-top:20px;
}
.txt_header {
	font-size: 14px;
	color: #009;
	text-decoration: none;
	font-weight: bold;
}
.txt_red_noraml {
	font-size: 12px;
	color: #900;
	text-decoration: none;
	background-color: #FFC;
	border: 1px solid #C30;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
body {
	background-color: #F4F4F4;
}
#OD {
	height: 160px;
	line-height:160px;
	width:1200px;
	margin:0 auto;
}
</style>
<script type="text/javascript">
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}
function show_alert()
{
	alert("作业截止提交以后才能查看答案");
}
</script>
</head>

<body>
<?php
	require("session.php");	//会话状态文件
	check_session();
	require("db_connect.php");	
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	require("term.php");
	require("url_deal.php");
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url
	//根据学生的年级以及当前时间判断学期
	$term=term($_SESSION['s_id']);
	$couid=url_deal($_GET['couid']);
	$c_sqls="select * from course where cou_id=".$couid;
	$cou_rs=mysql_query($c_sqls,$conn);
	$arr_course=mysql_fetch_array($cou_rs);
	$h_sqls="select * from homeworks where w_cou_id=".$couid." order by w_time desc";
	$w_rs=mysql_query($h_sqls,$conn);	//查出该课程的全部作业任务
	$s_sqls="select s_id,w_id,s_term,is_deal,reason from stu_works where cou_id=".$couid." and s_id='".$_SESSION['s_id']."'";
	$s_rs=mysql_query($s_sqls,$conn);	//查出该学生已提交的全部作业
	if(isset($s_rs))
	{
		$s_rows=mysql_num_rows($s_rs);	//学生已完成的作业次数
	}
	if(isset($w_rs))
		{
			$w_rows=mysql_num_rows($w_rs);	//本学期布置 的作业次数
			if($w_rows==0)
			{
				$w_note="<font color='#0033CC'>".$arr_course['cou_name']."还没有布置任何课后作业。</font>";
				$w_pic='pics/not_submit.jpg';		//如果本学期没有布置作业，即不需交作业图片
			}
		}
	else
	{
		$w_note="<font color='#0033CC'>".$arr_course['cou_name']."还没有布置任何课后作业。</font>";
		$w_pic='pics/not_submit.jpg';		//如果本学期没有布置作业，即不需交作业图片
	}
	if($w_rows>$s_rows)
	{
		$d=$w_rows-$s_rows;
		$w_note="<font color='#FF6655'>您一共有</font><font color='#FF0000'>【".$d."】</font><font color='#FF6655'>次作业没交！</font>";
		$w_pic='pics/need_submit.jpg';		//如果本学期没有布置作业，即不需交作业图片
	}
	elseif($w_rows>0)
	{
		$w_note="<font color='#00CC00'>值得点赞，您已完成全部的课后作业。</font>";
		$w_pic='pics/not_submit.jpg';		//如果本学期没有布置作业，即不需交作业图片
	}
?>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="41" colspan="7" align="left" bgcolor="#DBECFE" class="txt_header">作业情况列表》<?php echo $arr_course['cou_name'];?></td>
    <td height="41" align="center" bgcolor="#DBECFE" class="txt_header"><a href="course_list.php">切换课程</a></td>
  </tr>
  <tr>
    <td height="30" colspan="8" align="right" bgcolor="#FDFDD9" id="info"><?php show_welcome();?></td>
  </tr>
  <tr>
    <td height="25" colspan="8" bgcolor="#FFFFFF" id="info5">
	<marquee direction="left" scrollamount="3" scrolldelay="3" width="700">
     &nbsp;<img src="<?php echo $w_pic;?>" width="17" height="17" alt="" />&nbsp;
	 <?php echo $w_note;?></marquee>
    </td>
  </tr>
  <tr>
    <td height="32" colspan="8" align="right" bgcolor="#FFFFFF" id="info2"><?php show_operate();?></td>
  </tr>
  <?php 
  		if($w_rows>0)
		{
  ?>
  <tr>
    <td width="48" height="32" align="center" bgcolor="#DBECFE" id="l_num">序号</td>
    <td width="267" align="center" bgcolor="#DBECFE">作业名称</td>
    <td width="158" align="center" bgcolor="#DBECFE">截止时间</td>
    <td width="82" align="center" bgcolor="#DBECFE">完成情况</td>
    <td width="82" align="center" bgcolor="#DBECFE">评分说明</td>
    <td width="134" align="center" bgcolor="#DBECFE">作业状态</td>
    <td width="256" align="center" bgcolor="#DBECFE">操作</td>
    <td width="124" align="center" bgcolor="#DBECFE">讲义下载</td>
  </tr>
  <?php 
  		for($i=0;$i<$w_rows;$i++){
			$w_arr=mysql_fetch_array($w_rs);	//布置作业集转为数组
  ?>
  <tr bgcolor="#FFFFFF" id="w_list<?php echo $i;?>" onmousemove="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFC4','TR')" onmouseout="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFFF','TR')">
    <td height="41" align="center"><?php $j=$i+1;echo $j;?></td>
    <td align="center"><?php echo $w_arr['w_name'];?></td>
    <td align="center"><?php echo $w_arr['w_time']; ?></td>
    <td align="center">
    <?php 
			//作业状态判断输出
			if($s_rows>0)		//学生有交作业
			{
				mysql_data_seek($s_rs,0);	//将记录集指针复位
				for($k=0;$k<$s_rows;$k++)
				{
					$is_finish=0;
					$s_arr=mysql_fetch_array($s_rs);
					if($w_arr['w_id']==$s_arr['w_id'])
					{
						$is_finish=1;
						if($s_arr['is_deal']==101)
							echo "<img src='pics/finish.jpg' width='10' height='13' /><font color='#006600'>已提交</font>";
						else
							echo "<font color='#006600'>".$s_arr['is_deal']." 分</font>";
						break;
					}
				}
				if($is_finish==0)
					{
						echo "<img src='pics/no_finish.jpg' width='10' height='13' /><font color='#FF0000'>未完成</font>";
					}
			}
			else
			{
						$is_finish=0;
						echo "<img src='pics/no_finish.jpg' width='10' height='13' /><font color='#FF0000'>未完成</font>";
			}
	?>
        </td>
    <td align="center">
    <?php
	if($s_rows>0){
				mysql_data_seek($s_rs,0);	//再将作业完成记录集指针复位
				for($k=0;$k<$s_rows;$k++)
				{
					$is_finish=0;
					$s_arr=mysql_fetch_array($s_rs);
					if($w_arr['w_id']==$s_arr['w_id'])
					{
						if($s_arr['reason']==0) echo "未批阅";
						if($s_arr['reason']==1) echo "正常批阅";
						if($s_arr['reason']==2) echo "严重雷同";
					}
				}
	}
	?>
    </td>
    <td align="center">
    <?php 
		if(strtotime($w_arr['w_time'])<time())		//超期
		{
			echo "已截止提交";
		}
		else
		{
			echo "正在收取中";
		}
	?>
    </td>
    <td align="center"><?php 
		if($is_finish==0&&strtotime($w_arr['w_time'])>time())//未提交又未超期
		{
			echo "<a href='more_work_info.php?couid=".$couid."&oid=0&wid=".$w_arr['w_id']."&t=".$term."' target='_blank'>查看详情</a> ‖ ";
			echo "<a href='homework_submit.php?couid=".$couid."&t=".$term."&wid=".$w_arr['w_id']."'> 立刻提交</a>";
		}
		elseif(strtotime($w_arr['w_time'])<time())
		{
			echo "<a href='more_work_info.php?oid=2&wid=".$w_arr['w_id']."' target='_blank'>查看详情</a> ‖  ";
			if($w_arr['w_answer']!="")
				echo "<a href=".$w_arr['w_answer']." title='请右键选择下载'>参考答案</a>";	//显示参考答案
			else
				echo "暂无答案";
		}
		else
		{
			echo "<a href='more_work_info.php?oid=2&wid=".$w_arr['w_id']."' target='_blank'>查看详情</a> ‖  ";
			echo "<a href='#' title='截止提交后可下载' onclick='show_alert()'>参考答案</a>";	//显示参考答案
		}
	?>
    </td>
    <td align="center">
    <?php if($w_arr['w_handout']=="")
					echo "<font class='txt_red_noraml'>暂无讲义</font>";
				else
   					echo "<a href='".$w_arr['w_handout']."' target='_blank'>点击获取</a>";
	?>
	</td>
  </tr>
  <?php
		next($w_arr);}}?>
</table>
<br />
<?php 
	mysql_free_result($w_rs);
	mysql_free_result($s_rs);
	$sqls_c_design="select * from course_design where C_id=".$arr_course['cou_id'];
	$rs_design=mysql_query($sqls_c_design);
	if($rs_design&&mysql_num_rows($rs_design)>0)
	{
		$arr_design=mysql_fetch_array($rs_design);
		echo "<div id='OD'>";
		echo "<a href='ObjectDesign_1.php?cid=".$arr_course['cou_id']."' class='design' target='_blank'>";
		echo "<img src='pics/design.jpg' ></a></div>";
		mysql_free_result($rs_design);
	}
	mysql_free_result($cou_rs);
?>
<br />
<?php require("about.html");?>
</body>
</html>