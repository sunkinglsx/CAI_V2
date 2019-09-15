<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes" />
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
	color: #C60;
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
#error {
	background-color: #36C;
	width: 66%;
	height:150px;
	visibility:hidden;
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
	background-color: #FC0;
	font-size: 16px;
	color: #FFF;
	height: 30px;
	line-height: 30px;
	text-align: center;
	width: 100%;
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
#info a:link{
	font-size: 14px;
	color: #FF0;
	background-color: #093;
	padding-bottom: 5px;
	padding-top: 5px;
	padding-left: 20px;
	padding-right: 20px;
}
</style>
</head>
<script language="javascript">
function show_msgbox()
{
	document.getElementById("error").style.visibility="visible";
}
function hidden_msg()
{
	document.getElementById("error").style.visibility="hidden";
}
</script>
<body >
<?php require('../session.php');
			check_asession();
			require('../url_deal.php');
			$couid=url_deal($_GET['couid']);
			$cid=url_deal($_GET['cid']);
			$couname=url_deal($_GET['couname']);
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			$sqls_total="select * from homeworks where w_cou_id=".$couid;
			$rs_home=mysql_query($sqls_total,$conn);
?>
<div id="banner">
	<div  class="home"><a href="t_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['t_name']."老师";?></a></div>
  <div class="pray">
	<?php 
			$noon="捧着一颗心来，不带半棵草去";
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
    <span style="font-size:13px; color:#C30; float:left">作业列表->><?php echo $cid;?>->><?php echo $couname;?></span>
       <div id="list3" class="list"><a href="t_add_homework.php?cid=<?php echo $cid;?>&couid=<?php echo $couid;?>&couname=<?php echo $couname;?>">发布作业</a> </div>
    </td>
    </tr>
  <tr>
    <td height="2" colspan="4" align="center" bgcolor="#E3E2F5"></td>
    </tr>
<?php if(!$rs_home||mysql_num_rows($rs_home)==0)
				echo "<td height='150' colspan='4' align='center' bgcolor='#fff'><p>该课程暂未发布任何作业</p>
				<span id='info'><a href='t_add_homework.php?couname=".$couname."&cid=".$cid."&couid=".$couid."'>立即发布作业</a></span></td></tr></table>";
			else
			{
			   for($i=0;$i<mysql_num_rows($rs_home);$i++)
			  {
					$arr_home=mysql_fetch_array($rs_home);  
					$sql_send="select count(id) as total from stu_works where w_id=".$arr_home['w_id'];
					$rs_send=mysql_query($sql_send,$conn);		//已上交作业的学生人数
					if(!$rs_send||mysql_num_rows($rs_send)==0)
						$send=0;
					else
						$s=mysql_fetch_array($rs_send);
						$send=$s['total'];		//提交人数
  ?>
</table>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="t_list">
  <?php if($i%2==1){	?>
  <tr>
    <td width="42%" height="25" align="left" valign="middle" ><?php echo $arr_home['w_name'];?><span style="color:#C00">[<?php echo $send;?>]</span></td>
    <td width="40%" align="center"  ><?php echo $arr_home['w_time'];?></td>
    <td width="6%" align="center" ><a href="t_deal_homework.php?wname=<?php echo $arr_home['w_name'];?>&wid=<?php echo $arr_home['w_id'];?>"><img src="../pics/script_edit.png" width="16" height="16" border="0"/></a></td>
    <td width="6%" height="25" align="center" bgcolor="#FFFFFF" ><img src="../pics/cross.png" width="16" height="16" border="0" onclick="show_msgbox()"/> </td>
  </tr>
  <?php }
  else{
  ?>
  <tr>
    <td width="42%" height="25" align="left" valign="middle" bgcolor="#E3E2F5"><?php echo $arr_home['w_name'];?><span style="color:#C00">[<?php echo $send;?>]</span></td>
    <td width="40%" align="center" bgcolor="#E3E2F5"><?php echo $arr_home['w_time'];?></td>
    <td width="6%" align="center" bgcolor="#E3E2F5"><a href="t_deal_homework.php?wname=<?php echo $arr_home['w_name'];?>&wid=<?php echo $arr_home['w_id'];?>"><img src="../pics/script_edit.png" width="16" height="16" border="0"/></a></td>
    <td width="6%" height="25" align="center" bgcolor="#E3E2F5"> <img src="../pics/cross.png" width="16" height="16" border="0"  onclick="show_msgbox()"/> </td>
  </tr>
  <?php }}?>
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
<!--对话框-->
				<div id="error">
					<div class="msg_title" >提示</div>
					<div class="msg_content"> 
					<table width="97%" align="center">
					<tr><td>
					 作业删除以后无法恢复，您确定要继续删除操作？
					 </td></tr></table>
				</div>
					<div class="msg_bottom">
					<table width="97%" align="center">
					<tr>
                    <td align="center">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='t_del_homework.php?couid=<?php echo $couid; ?>&cid=<?php echo $cid;?>&couname=<?php echo $couname;?>&wid=<?php echo $arr_home['w_id'];?>'"/>
					 </td>
                    <td align="center">
					<input type="reset" name="button" id="button" value="取消"  onclick="hidden_msg()"/>
					 </td>
                     </tr>
                    </table>
					</div>
				</div>
</body>
</html>