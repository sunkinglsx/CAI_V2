<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�����½</title>
<style type="text/css">
#login {
	background-color: #9CF;
	height: 200px;
	width: 500px;
	margin-top: -100px;	/*�����Ǹ߶ȵĸ�һ��*/
	margin-left: -200px;	/*����ǿ�ȵĸ�һ��*/
	position: absolute;
	left: 50%;
	top: 50%;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=5);
	box-shadow: 2px 2px 10px #909090;	/*IE9��chrome*/
	z-index: 3;
}
#login #t_login {
	background-color: #99F;
	height: 200px;
	width: 500px;
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
	document.getElementById("info").innerHTML="����������˺�";
}
function hide_info()
{
	document.getElementById("info").innerHTML="";
}
function check_myform()
{
	var uname=document.getElementById("uname").value;
	var upass=document.getElementById("upass").value;
	var con_num=document.getElementById("check").value
	if(uname==""||uname.length<4)
	{
		alert("��������Ĺ����˺�");
		document.getElementById("uname").focus();
		return false;
	}
	if(upass=="")
	{
		alert("���������Ĺ���Ա����");
		document.getElementById("upass").focus();
		return false;
	}
	if(con_num=="")
	{
		alert("��������֤��");
		document.getElementById("check").focus();
		return false;
	}
}
</script>
<script>
	var isIPhone = device.iphone(),
			isandroidPhone=device.androidPhone();
    var isIOS = isIPhone  || isandroidPhone;
    if(isIOS){
        window.open("wap/index.php","_self");	//�Զ�����豸������Ӧ��ҳ
    }
</script>
<body>
<div id="login">
  <form id="form1" name="form1" method="post" action="a_login_ver.php">
    <table width="500" height="200" border="0" cellpadding="0" cellspacing="1" id="t_login">
      <tr>
        <td height="38" colspan="2" align="center" bgcolor="#C4D7FF">�����½</td>
      </tr>
      <tr>
        <td rowspan="3" align="center" bgcolor="#FFFFFF"><table width="190" height="112" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="115" rowspan="3" align="center"><img src="pics/login_t1.jpg" width="85" height="105" /></td>
            <td width="75" height="31" align="center">����ţ�</td>
          </tr>
          <tr>
            <td height="34" align="center">�ܡ��룺</td>
          </tr>
          <tr>
            <td height="47" align="center">��֤�룺</td>
          </tr>
        </table></td>
        <td width="300" height="28" align="left" bgcolor="#FFFFFF"><label for="uname"></label>
          <input type="text" name="uname" id="uname"  onfocus="show_info()" onblur="hide_info()"/>
        <div id="info"></div></td>
      </tr>
      <tr>
        <td height="35" align="left" bgcolor="#FFFFFF"><label for="upass"></label>
        <input type="password" name="upass" id="upass" />
        <a href="find_pw.php?r=1">��������</a></td>
      </tr>
      <tr>
        <td height="47" align="left" bgcolor="#FFFFFF"><label for="check"></label>
          <input type="text" name="check" id="check" />
          <div id="c_num">
                        <img id="captcha_img" border='1' src='vernum_code.php?r=echo rand();' onclick="document.getElementById('captcha_img').src='vernum_code.php?r='+Math.random()"/> 

        </div></td>
      </tr>
      <tr height="32">
        <td height="32" colspan="2" align="center" bgcolor="#C4D7FF" ><input type="submit" name="button" id="button" value="�ύ��½"  onclick="return check_myform()"/></td>
      </tr>
    </table>
  </form>
</div>

</body>
</html>