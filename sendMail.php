<?php
//==================�һ�������ʼ����ͺ���============================
function send_email($address,$uname,$newpass,$urole)
{
	require_once "email_class.php";
	//******************** ������Ϣ ********************************
	$smtpserver = "smtp.163.com";//SMTP������
	$smtpserverport =25;//SMTP�������˿�
	$smtpusermail = "sunkinglsx@163.com";//SMTP���������û�����
	$smtpemailto = $address;//���͸�˭
	$smtpuser = "sunkinglsx";//SMTP���������û��ʺ�(����дnew2008oh@126.com��������Щ������Ҫ������)
	$smtppass = "lsx323lsx";//SMTP���������û�����
	$mailtitle = "������ҵϵͳ���������һ�";//�ʼ�����
	if($urole==1)
	{
		$mailcontent = "�𾴵�".$uname."��ʦ���ã�������ҵϵͳΪ�����õ��������ǣ�<font color='#990000' size='+3'>".$newpass."</font>";//�ʼ�����
		$dl="<a href=http://www.mrlin-ke.com/a_login.php>www.sunkinglsx.com</a><br>���ʼ�����ظ�";
	}
	elseif($urole==2)
		{
			$mailcontent = "�װ���".$uname."ͬѧ���ã�������ҵϵͳΪ�����õ��������ǣ�<font color='#990000' size='+3'>".$newpass."</font>";//�ʼ�����
			$dl="<a href=http://www.sunkinglsx.com>www.sunkinglsx.com</a><br>���ʼ�����ظ�";
		}
	$mailcontent=$mailcontent."<br>������ͨ������ĵ�ַʹ���������½ϵͳ��������������<br>".$dl;
	$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�
	//************************ ������Ϣ ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
	$smtp->debug = false;//�Ƿ���ʾ���͵ĵ�����Ϣ
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	if($state==""){
		echo "<div style='width:800px; margin:16px auto;'>�Բ������뷢��ʧ�ܣ�����������д�Ƿ�����
		<a href='index.php'������ҳ'</a></div>";
		return false;
	}
	else
	{
		echo "<div style='width:800px; margin:16px auto;'>�������ѷ��͵��������䣬���½������ȡ��";
		if($urole==1)
			echo "<a href='a_login.php'> ���ص�½</a></div>";
		elseif($urole==2)
			echo "<a href='index.php'> ���ص�½</a></div>";
		return true;
	}
}
//------------------���ý�ʦ���뷢�͵��ʼ�����-------------------------------------------
function reset_pw_email($address,$uname,$newpass)
{
	require_once "email_class.php";
	//******************** ������Ϣ ********************************
	$smtpserver = "smtp.163.com";//SMTP������
	$smtpserverport =25;//SMTP�������˿�
	$smtpusermail = "sunkinglsx@163.com";//SMTP���������û�����
	$smtpemailto = $address;//���͸�˭
	$smtpuser = "sunkinglsx";//SMTP���������û��ʺ�(����дnew2008oh@126.com��������Щ������Ҫ������)
	$smtppass = "lsx323lsx";//SMTP���������û�����
	$mailtitle = "������ҵϵͳ������������";//�ʼ�����
		$mailcontent = "�𾴵�<font color='#990000' size='+3'>".$uname."</font>��ʦ���ã�������ҵϵͳΪ�����õ��������ǣ�<font color='#990000' size='+3'>".$newpass."</font>";//�ʼ�����
		$dl="<a href=http://www.sunkinglsx.com/a_login.php>www.sunkinglsx.com</a><br>���ʼ�����ظ�";
	$mailcontent=$mailcontent."<br>������ͨ������ĵ�ַʹ���������½ϵͳ��������������<br>".$dl;
	$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�
	//************************ ������Ϣ ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
	$smtp->debug = false;//�Ƿ���ʾ���͵ĵ�����Ϣ
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	if($state=="")
		return false;
	else
		return true;
}
?>