<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>������ҵ����ϵͳ</title>
<script src="../device.js"></script>
<script language="javascript">
	var isIPhone = device.iphone(),
			isandroidPhone=device.androidPhone();
			isAndroid=device.android();
    var isIOS = isIPhone||isandroidPhone||isAndroid;
    if(!isIOS){
       window.open ("../index.php","_self");	//�Զ�����豸������Ӧ��ҳ
    }
	function obj_select(event)		//�û�ѡ ��
	{
		event = event ? event : window.event; 
		var obj = event.srcElement ? event.srcElement : event.target; 
		if(obj.id=="user_1")	//��ʾ��ʦ�û�������ѧ���û�
		{
			document.getElementById("user_1").className="user";
			document.getElementById("user_2").className="user2";
			document.getElementById("role").value="1";
			document.getElementById("tname").setAttribute("placeholder","Teacher_ID");
		}
		if(obj.id=="user_2")	//��ʾѧ���û������ؽ�ʦ�û�
		{
			document.getElementById("user_1").className="user2";
			document.getElementById("user_2").className="user";
			document.getElementById("role").value="2";
			document.getElementById("tname").setAttribute("placeholder","Student_ID");
		}
	}

</script>
<style type="text/css">
@import url("msgbox.css");
#main_title {
	font-size: 24px;
	color: #FFF;
	text-decoration: none;
	background-color: #36C;
	height: 135px;
	width: 100%;
}
.users{
	width:100%;
	background-color:#FFF;
	float:left;
	height:auto;
	margin-top:3px;
	text-align:center;
	color:#36C;
	font-size:12px;
	text-align:left;
}
.user{
	font-weight:bolder;
	width:50%;
	margin-left:0;
	background-color:#4EC2FF;
	text-align:center;
	float:left;
	height:40px;
	color:#FFF;
	line-height:40px;
	display:inline-block;
}
.user2{
	font-weight:bolder;
	width:50%;
	margin-left:0;
	background-color:#9CC;
	text-align:center;
	float:left;
	height:40px;
	color:#FFF;
	line-height:40px;
	display:inline-block;
}
.login{
	width:100%;
	background-color:#EFEFEF;
	float:left;
	height:190px;
	margin-top:3px;
	text-align:center;
}
.txtbox{
	width:60%;
	height:30px;
	font-size:16px;
	color:#63C;
	border:solid 1px #66C;
	padding-left:15px;
	margin-top:5px;
	vertical-align:middle;
	float:left;
	margin-left:25px;
}
.button{
	width:89%;
	height:40px;
	background-color:#3C6;
	font-size:18px;
	color:#FFF;
	border:1px #3C6;
	margin-top:10px;
	margin-left:5px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<script language="javascript">
function check_myform()		//����
{
	var uname=document.getElementById("tname").value;
	var upass=document.getElementById("tpass").value;
	var con_num=document.getElementById("ver_code").value
	var role=document.getElementById("role").value;
	if(uname=="" && role==1)
	{
		document.getElementById("msg_content").innerHTML="<br>�����������û��˺�";
		document.getElementById("error_id").value="1";
		document.getElementById("error").style.visibility="visible";
		return false;
	}
	if((uname==""||uname.length<8) && role==2)
	{
		document.getElementById("msg_content").innerHTML="<br>��������������ѧ��";
		document.getElementById("error_id").value="1";
		document.getElementById("error").style.visibility="visible";
		return false;
	}
	if(upass=="")
	{
		document.getElementById("msg_content").innerHTML="<br>���������ĵ�½����";
		document.getElementById("error_id").value="2";
		document.getElementById("error").style.visibility="visible";
		return false;
	}
	if(con_num=="")
	{
		document.getElementById("msg_content").innerHTML="<br>��������ȷ����֤��";
		document.getElementById("error_id").value="3";
		document.getElementById("error").style.visibility="visible";
		return false;
	}
}
function hide_msg()		//������ʾ��
{
	var error_id=document.getElementById("error_id").value;
	document.getElementById("error").style.visibility="hidden";
	if(error_id==1)
		{document.getElementById("tname").focus();}
	if(error_id==2)
		{document.getElementById("tpass").focus();}
	if(error_id==3)
		{document.getElementById("ver_code").focus();}
}
</script>
</head>

<body>
<div id="main_title"><img src="../pics/wap_index.jpg" width="100%" height="135" /></div>
<div id="users"  class="users">
	<div id="user_1" class="user" onclick="obj_select(event)"><img src="../pics/u1.gif" width="16" height="18" />&nbsp;��ʦ�û�</div>
    <div id="user_2" class="user2" onclick="obj_select(event)"><img src="../pics/u2.gif" width="21" height="18" />&nbsp;ѧ���û�</div>
  <div class="login"> 
   <form id="form1" name="form1" method="post" action="login_ver.php">
    <label for="tname"></label>
    <input type="text" name="tname" id="tname"  class="txtbox" placeholder="Teacher_ID"/>
    <br />
    <label for="tpass"></label>
    <input type="password" name="tpass" id="tpass"  class="txtbox" placeholder="Password"/>
    <input name="role" type="hidden" id="role" value="1" />
    <br /><div style="vertical-align:middle;">
    <input type="text" name="ver_code" id="ver_code"  class="txtbox" placeholder="Verification Code"/>
     <img id="captcha_img" border='1' src='vernum_code.php?r=echo rand();' onclick="document.getElementById('captcha_img').src='vernum_code.php?r='+Math.random()" style="vertical-align:middle; float:left; margin-left:10px; margin-top:8px;"/> 
      </div><br />
    <input type="submit" name="button" id="button" value="�ύ��¼" class="button" onclick="return check_myform()"/>
</form>
</div>
</div>
<div class="users">
<table border="0" width="100%">
<tr>
<td width="948" >
��ʾ����ϵͳ�ֻ��˲��߱�ϵͳȫ�����ܡ�ʹ���������ܣ����½PC�ˡ�ʹ�ù����У����κ�������飬��ӭɨ��
�ұ߶�ά�룬΢�ŷ���������
</td>
<td width="107" rowspan="2"><img src="../pics/wx.jpg" width="107" height="93" /></td>
</tr>
<tr>
  <td height="27" >
Sunking's CAI System<br />
Design & Develope by sunking
</td> </tr>
</table></div>
<div class="error"  id="error"> 
    <div class="msg_title" >������ʾ</div>
    <div class="msg_content" id="msg_content"> </div>
    <div class="msg_bottom">
    <input type="hidden" id="error_id" name="error_id" value="" />
    <input type="submit" name="button" id="button" value="ȷ��" onclick="hide_msg()"/>
    </div>
</div>
</body>
</html>