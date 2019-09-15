<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>三金作业管理系统</title>
<style type="text/css">
#error {
	background-color: #36C;
	width: 66%;
	height:150px;
	display:hidden;
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
	background-color:#36C;
	font-size:16px;
	color:#FFF;
	height:30px;
	line-height:30px;
	text-align:center;
	width:96%;
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
</style>
</head>
<body>
<?php
	session_start();
	if(isset($_POST['button']))
	{
		$role=$_POST['role'];
		$u_id=strtoupper(trim($_POST['tname']));	//管理用户名
		$u_pass=md5(trim($_POST['tpass']));//密码
		$vcode=strtoupper($_POST['ver_code']);	//验证码
		if($vcode!=$_SESSION['code'])
		{
					$err=0;
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					 <br>验证码错误！请重新登陆！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='index.php'"/>
					</div>
				</div>
err;
		exit;
		}
			require('../db_connect.php');//包含数据库连接文件
			mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
			if($role==1)
				$sqls="select * from ad_user where a_name='".$u_id ."' and a_pw='".$u_pass."'";
			else
				$sqls="select * from students where s_id='".$u_id ."' and s_pass='".$u_pass."'";
			$rs=mysql_query($sqls,$conn);
			if(mysql_num_rows($rs)==0)
			{
					$err=1;
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					 <br/>用户名或密码错误！请重新登陆！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='index.php'"/>
					</div>
				</div>
err;
			exit;
			}
			else
			{
					$arr=mysql_fetch_array($rs);	//转换为数组
					//检查用户有效期是否过期
					if($role==1&&strtotime($arr['end_time'])<time())
					{
							$err=2;
echo <<<err
				<div id="error">
					<div class="msg_title" >错误提示</div>
					<div class="msg_content"> 
					<br/>您的用户账号已过期，请联系管理员续费延期！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='index.php'"/>
					</div>
				</div>
err;
					}
					else
					{
						if($role==1){
							$_SESSION['a_name']=$arr['a_name'];
							$_SESSION['t_name']=$arr['t_name'];
							$_SESSION['a_right']=$arr['a_right'];
							$_SESSION['email']=$arr['email'];
							$_SESSION['a_answer']=$arr['a_answer'];
							$_SESSION['question']=$arr['question'];
							}
						else{
							$_SESSION['s_id']=$arr['s_id'];
							$_SESSION['s_name']=$arr['s_name'];
							$_SESSION['s_class']=$arr['s_class'];
							$_SESSION['email']=$arr['email'];
							$_SESSION['s_answer']=$arr['s_answer'];
							$_SESSION['question']=$arr['question'];
							}
						if($arr['email']==""||$arr['question']==""||$arr['a_answer']=="")
						{
							if($role==1)
								{
echo <<<err
				<div id="error">
					<div class="msg_title" >提示</div>
					<div class="msg_content"> 
					<br/>您的用户资料不完整，建议您登录电脑端完善自己的个人资料，以便更好使用系统功能！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='t_index.php'"/>
					</div>
				</div>
err;
								}
							else
								{
echo <<<err
				<div id="error">
					<div class="msg_title" >提示</div>
					<div class="msg_content"> 
					<br/>您的用户资料不完整，建议您登录电脑端完善自己的个人资料，以便更好使用系统功能！ 
				</div>
					<div class="msg_bottom">
					<input type="submit" name="button" id="button" value="确定"  onclick="location.href='s_index.php'"/>
					</div>
				</div>
err;
								}
						}
						else
						{
							if($role==1)
								header('location:t_index.php');
							else
								header('location:s_index.php');
						}
					}
			}
			mysql_close($conn);
		}
?>
</body>
</html>