<?php
//==================找回密码的邮件发送函数============================
function send_email($address,$uname,$newpass,$urole)
{
	require_once "email_class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "sunkinglsx@163.com";//SMTP服务器的用户邮箱
	$smtpemailto = $address;//发送给谁
	$smtpuser = "sunkinglsx";//SMTP服务器的用户帐号(或填写new2008oh@126.com，这项有些邮箱需要完整的)
	$smtppass = "lsx323lsx";//SMTP服务器的用户密码
	$mailtitle = "三金作业系统——密码找回";//邮件主题
	if($urole==1)
	{
		$mailcontent = "尊敬的".$uname."老师您好，三金作业系统为您设置的新密码是：<font color='#990000' size='+3'>".$newpass."</font>";//邮件内容
		$dl="<a href=http://www.mrlin-ke.com/a_login.php>www.sunkinglsx.com</a><br>本邮件请勿回复";
	}
	elseif($urole==2)
		{
			$mailcontent = "亲爱的".$uname."同学您好，三金作业系统为您设置的新密码是：<font color='#990000' size='+3'>".$newpass."</font>";//邮件内容
			$dl="<a href=http://www.sunkinglsx.com>www.sunkinglsx.com</a><br>本邮件请勿回复";
		}
	$mailcontent=$mailcontent."<br>您可以通过下面的地址使用新密码登陆系统后，重新设置密码<br>".$dl;
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	if($state==""){
		echo "<div style='width:800px; margin:16px auto;'>对不起，密码发送失败！请检查邮箱填写是否有误。
		<a href='index.php'返回首页'</a></div>";
		return false;
	}
	else
	{
		echo "<div style='width:800px; margin:16px auto;'>新密码已发送到您的邮箱，请登陆邮箱收取！";
		if($urole==1)
			echo "<a href='a_login.php'> 返回登陆</a></div>";
		elseif($urole==2)
			echo "<a href='index.php'> 返回登陆</a></div>";
		return true;
	}
}
//------------------重置教师密码发送的邮件函数-------------------------------------------
function reset_pw_email($address,$uname,$newpass)
{
	require_once "email_class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "sunkinglsx@163.com";//SMTP服务器的用户邮箱
	$smtpemailto = $address;//发送给谁
	$smtpuser = "sunkinglsx";//SMTP服务器的用户帐号(或填写new2008oh@126.com，这项有些邮箱需要完整的)
	$smtppass = "lsx323lsx";//SMTP服务器的用户密码
	$mailtitle = "三金作业系统——密码重置";//邮件主题
		$mailcontent = "尊敬的<font color='#990000' size='+3'>".$uname."</font>老师您好，三金作业系统为您设置的新密码是：<font color='#990000' size='+3'>".$newpass."</font>";//邮件内容
		$dl="<a href=http://www.sunkinglsx.com/a_login.php>www.sunkinglsx.com</a><br>本邮件请勿回复";
	$mailcontent=$mailcontent."<br>您可以通过下面的地址使用新密码登陆系统后，重新设置密码<br>".$dl;
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	if($state=="")
		return false;
	else
		return true;
}
?>