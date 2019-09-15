<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>三金作业系统—找回密码</title>
<style type="text/css">
#login {
	background-color: #9CF;
	height: 210px;
	width: 500px;
	margin-top: -105px;	/*顶端是高度的负一半*/
	margin-left: -250px;	/*左端是宽度的负一半*/
	position: absolute;
	left: 50%;
	top: 50%;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=5);
	box-shadow: 2px 2px 10px #909090;	/*IE9或chrome*/
	z-index: 3;
}
a:link {
	font-size: 12px;
	color: #000;
	text-decoration: none;
	padding-top: 3px;
	padding-right: 8px;
	padding-bottom: 3px;
	padding-left: 8px;
	background-color: #D2D2D2;
	border: 1px solid #666;
}
a:visited {
	font-size: 12px;
	color: #000;
	text-decoration: none;
	padding-top: 3px;
	padding-right: 8px;
	padding-bottom: 3px;
	padding-left: 8px;
	background-color: #D2D2D2;
	border: 1px solid #666;
}
a:hover {
	font-size: 12px;
	color: #333;
	text-decoration: none;
	padding-top: 3px;
	padding-right: 8px;
	padding-bottom: 3px;
	padding-left: 8px;
	background-color: #E0E0E0;
	border: 1px solid #333;
}
#login #t_login {
	background-color: #99F;
	height: 200px;
	width: 500px;
	font-size: 12px;
}
#info {
	font-size: 12px;
	color: #F00;
	height: 16px;
	width: 100px;
	position: absolute;
	left: 372px;
	top: 47px;
}
#c_num {
	font-size: 18px;
	color: #930;
	text-decoration: none;
	background-color: #FFC;
	position: absolute;
	height: 23px;
	width: 100px;
	left: 375px;
	top: 126px;
}
</style>
</head>
<script type="text/javascript">
function show_info()
{
	document.getElementById("info").innerHTML="请输入账号名称";
}
function hide_info()
{
	document.getElementById("info").innerHTML="";
}
function check_myform()
{
	var uname=document.getElementById("uname").value;
	var upass=document.getElementById("answer").value;
	var con_num=document.getElementById("email").value
	var reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;				//邮箱正则
	if(uname==""||uname.length<8)
	{
		alert("请填入你的管理账号");
		document.getElementById("uname").focus();
		return false;
	}
	if(upass=="")
	{
		alert("请填入您的密码问题答案");
		document.getElementById("answer").focus();
		return false;
	}
	if(con_num=="")
	{
		alert("请填入您的电子邮箱，以便用于找回密码");
		document.getElementById("email").focus();
		return false;
	}
			if(!reg.exec(con_num))
		{
			alert("电子邮箱不合法，请重新填写");
			document.getElementById("email").focus();
			return false;
		}
}
</script>
<body>
<?php
	require("url_deal.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	require("sendMail.php");		//发送电子邮件函数
	$oid=url_deal($_GET['r']);
	if(isset($_POST['button']))
	{
		$uname=$_POST['uname'];	//用户名
		$question=$_POST['question'];	//问题
		$answer=$_POST['answer'];		//答案
		$email=$_POST['email'];	//邮箱
		$c_ok=0;
		if($oid==1)		//教师用户
			$sqls="select * from ad_user where a_name='".$uname."'";
		else
		{
			$uname=strtolower($uname);
			$sqls="select * from students where s_id='".$uname."'";
		}
		$rs=mysql_query($sqls,$conn);
		if(!$rs||mysql_num_rows($rs)==0)
		{
			echo "<script language='javascript'>";
			echo "alert('用户账号不存在！');";
			echo "</script>";
		}
		else
		{
			$arr_user=mysql_fetch_array($rs);
			if($arr_user['question']==$question&&$arr_user['a_answer']!=$answer)
			{
				echo "<script language='javascript'>";
				echo "alert('密码问题的答案错误！');";
				echo "</script>";
				$c_ok+=1;
			}
			if($arr_user['email']!=$email&&$c_ok==0)	//$c_ok==0为避免两次跳出对话框
			{
				echo "<script language='javascript'>";
				echo "alert('电子邮箱错误！');";
				echo "</script>";
				$c_ok+=1;
			}
			if($arr_user['question']==$question&&$arr_user['a_answer']==$answer&&$c_ok==0)	//问题与答案同时相符，邮箱正确
			{
				$str_pw="123456789abcdefghijklmnpqrstuvwxyz";
				//产生6位新密码
				$npw=$str_pw[rand(0,33)].$str_pw[rand(0,33)].$str_pw[rand(0,33)].$str_pw[rand(0,33)].$str_pw[rand(0,33)].$str_pw[rand(0,33)];
				//更新数据表
				if($oid==1)		//教师用户
					$up_sqls="update ad_user  set a_pw='".md5($npw)."' where a_name='".$uname."'";
				else
					$up_sqls="update students set s_pass='".md5($npw)."' where s_id='".$uname."'";
				
				if($oid==1)	//发邮件给教师
				{
					$send_static=send_email($email,$arr_user['t_name'],$npw,1);
					if($send_static)		//发送成功才更新新密码
						$up_rs=mysql_query($up_sqls,$conn);
					exit;
				}
				else		//发邮件给学生
				{
					$send_static=send_email($email,$arr_user['s_name'],$npw,2);
					if($send_static)
						$up_rs=mysql_query($up_sqls,$conn);
					exit;
				}
			}
		}
	}
?>
<div id="login">
  <form id="form1" name="form1" method="post" action="">
    <table width="500" height="210" border="0" cellpadding="0" cellspacing="1" id="t_login">
      <tr>
        <td height="38" colspan="2" align="center" bgcolor="#C4D7FF">找回我的密码</td>
      </tr>
      <tr>
        <td width="149" align="center" bgcolor="#FFFFFF"><?php if($oid==1) echo "用号名称:"; else  echo "完整学号：";?></td>
        <td width="348" height="28" align="left" bgcolor="#FFFFFF"><label for="uname"></label>
          <input type="text" name="uname" id="uname"  onfocus="show_info()" onblur="hide_info()"/></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">密码问题：</td>
        <td height="33" align="left" bgcolor="#FFFFFF"><label for="question"></label>
          <select name="question" id="question">
            <option value="我最喜欢的运动">我最喜欢的运动</option>
            <option value="我高中的母校名称">我高中的母校名称</option>
            <option value="我最喜欢的季节">我最喜欢的季节</option>
            <option value="我最爱吃的美食">我最爱吃的美食</option>
            <option value="我最喜欢的颜色">我最喜欢的颜色</option>
            <option value="我最喜欢的电影">我最喜欢的电影</option>
        </select></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">密码答案：</td>
        <td height="36" align="left" bgcolor="#FFFFFF"><input type="text" name="answer" id="answer" /></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">电子邮箱:</td>
        <td height="35" align="left" bgcolor="#FFFFFF"><input name="email" type="text" id="email" size="40" /></td>
      </tr>
      <tr height="32">
        <td height="32" colspan="2" align="center" bgcolor="#C4D7FF" ><input type="submit" name="button" id="button" value="申请找回密码"  onclick="return check_myform()"/>
         &nbsp;&nbsp;<a href="index.php">返回首页</a></td>
      </tr>
    </table>
  </form>
</div>

</body>
</html>