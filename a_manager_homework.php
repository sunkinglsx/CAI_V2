<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<link href="css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#t_main {
	font-size: 12px;
	color: #333;
	background-color: #FFF;
	text-decoration: none;
	border: solid 1px #999;
}
.changbg:hover{
	background-color:#EBEEF3;
}
</style>
</head>
<body>
<?php 
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	//check_asession();
	require("url_deal.php");
	require("term.php");
	//记住当前完整 的url
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url
	$cid=url_deal($_GET['cid']);	//获取班级编号
	$couid=url_deal($_GET['couid']);	//课程编号
		//根据学生的班级以及当前时间判断学期
	$term=term($cid);
	$sqls="select cou_name from course where cou_id=".$couid;
	$rs=mysql_query($sqls,$conn);
	$arr_course=mysql_fetch_array($rs);
?>
<table width="100%" height="104" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="37" colspan="4" bgcolor="#FFFFCC">管理首页 》 作业管理 》<font color="#ff0000" ><?php echo $cid;?></font>》<?php echo $arr_course['cou_name'];?></td>
    <td height="37" colspan="2" align="center" bgcolor="#FFFFCC"><a href="a_homework_copy.php?cid=<?php echo $cid;?>&couid=<?php echo $couid;?>">本科目作业适用其它平行班</a></td>
  </tr>
  <?php
	//查出该班该门课程的全部作业
		$sqls="select * from homeworks where w_cou_id=".$couid;
		$rs=mysql_query($sqls,$conn);
  		if(!$rs||mysql_num_rows($rs)==0)
		{ echo "<tr><td colspan='6' height='26'>该门课程还没有布置任何作业
		<a href='a_new_homework.php?cid=".$cid."&couid=".$couid."&cname=".$arr_course['cou_name']."'>立即发布作业</a>
		</td></tr>";
		}
		else
		{
  ?>
  <tr>
    <td width="41" height="33" align="center" bgcolor="#EBEBEB">序号</td>
    <td width="216" align="center" bgcolor="#EBEBEB">标题</td>
    <td width="150" align="center" bgcolor="#EBEBEB">截止时间</td>
    <td width="154" align="center" bgcolor="#EBEBEB">讲义文件</td>
    <td width="114" align="center" bgcolor="#EBEBEB">答案文件</td>
    <td width="144" align="center" bgcolor="#EBEBEB">操作</td>
  </tr>
  <?php
  		$w_rows=mysql_num_rows($rs);
		for($i=0;$i<$w_rows;$i++)
		{
			$arr_w=mysql_fetch_array($rs);
  ?>
  <tr class="changbg">
    <td height="30" align="center"><?php echo $i+1;?></td>
    <td align="center"><?php echo $arr_w['w_name'];?></td>
    <td align="center"><?php echo $arr_w['w_time'];?></td>
    <td align="center"><?php echo strstr($arr_w['w_handout'],"/");?></td>
    <td align="center"><?php echo strstr($arr_w['w_answer'],"/");?></td>
    <td align="center"><a href="a_deal_homework.php?cid=<?php echo $cid;?>&amp;wid=<?php echo $arr_w['w_id'];?>">修改</a>| <a href="javascript:if(confirm('你确定要删除该条作业？'))window.location.href='a_dele_homework.php?wid=<?php echo $arr_w['w_id'];?>'" >删除</a></td>
  </tr>
  <?php } } ?>
</table>
</body>
</html>