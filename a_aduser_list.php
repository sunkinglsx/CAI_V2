<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>管理系统用户</title>
<style type="text/css">
@import url("css.css");

#t_main {
	background-color: #CCCCCC;
}
</style>
</head>

<body>
<?php
	require("session.php");
	check_asession();
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
?>
<table width="100%" height="96" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="29" colspan="8" bgcolor="#FFFFCC">管理首页 》 任课教师管理</td>
  </tr>
  <?php
	//查出该班该门课程的全部作业
		if($_SESSION['a_name']=='sunkinglsx')
			$sqls="select * from ad_user";
		else
			$sqls="select * from ad_user where a_right=2";
		$rs=mysql_query($sqls,$conn);
  		if(!$rs||mysql_num_rows($rs)==0)
		{ echo "<tr><td colspan='6' height='26'>系统没有任课老师</td></tr>";
		}
		else
		{
  ?>
  <tr>
    <td width="46" height="33" align="center" bgcolor="#EBEBEB">序号</td>
    <td width="128" align="center" bgcolor="#EBEBEB">教师姓名</td>
    <td width="169" align="center" bgcolor="#EBEBEB">登陆账号</td>
    <td width="206" align="center" bgcolor="#EBEBEB">电子邮箱</td>
    <td width="202" align="center" bgcolor="#EBEBEB">有效期至</td>
    <td colspan="3" align="center" bgcolor="#EBEBEB">操作</td>
  </tr>
  <?php
  		$w_rows=mysql_num_rows($rs);
		for($i=0;$i<$w_rows;$i++)
		{
			$arr_w=mysql_fetch_array($rs);
  ?>
  <tr>
    <td height="30" align="center" bgcolor="#FFFFFF"><?php echo $i+1;?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['t_name'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['a_name'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['email'];?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['end_time'];?></td>
    <td width="124" align="center" bgcolor="#FFFFFF"><a href="javascript:if(confirm('默认重置密码为123456并发送到对方的默认邮箱'))window.location.href='a_reset_pw.php?uid=<?php echo $arr_w['a_name'];?>'" >重置密码</a></td>
    <td width="115" align="center" bgcolor="#FFFFFF"><a href="a_user_putof.php?uid=<?php echo $arr_w['a_name'];?>">续费延期</a></td>
    <td width="116" align="center" bgcolor="#FFFFFF"><a href="javascript:if(confirm('你确定要删除该老师用户？'))window.location.href='a_dele_user.php?uid=<?php echo $arr_w['a_name'];?>'" >删除用户</a></td>
  </tr>
  <?php } } ?>
</table>
</body>
</html>