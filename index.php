<html>
<head>
<title>三金学生作业管理系统</title>
 <link rel="shortcut icon" href="pics/sunking.ico" />
 <script src="device.js"></script>
<style type="text/css">
html{
height:100%;
}
body{
height:100%;
margin:0px;
background-image:url(images/bg.jpg);
background-repeat:no-repeat;
background-size:100%;
}
#ding,#di
{
	width:100%;
	height:28%;
	/*background-color:#66C;*/
}
#nr
{
	width:100%;
	height:40%;
	background-color:#FFFFFF;
}
#line
{
	width:100%;
	height:3px;
	background-image:url(images/hr.gif);
	background-repeat:repeat-x;
}	
#userinfo
{
	font-size:13px;
	color:#69C;
}
#userinfo input
{
	width:150px;
	height:20px;
	border:1px solid #39C;
	font-size:14px;
	color:#639;
}
#userinfo #button
{
	width:100px;
	height:24px;
	border:1px solid #39C;
	background-color:#FFF;
	font-size:13px;
	color#666;
	border-radius:4px;
}
#userinfo #button:hover
{
	width:100px;
	height:24px;
	border:1px solid #39C;
	background-color:#FFF;
	font-size:13px;
	color#666;
	border-radius:4px;
	box-shadow:0 -1px 6px -1px rgba(81, 81,81,0.2) inset,
						0 0 0px -1px rgba(81, 81,81,0.2) inset,  
						 1px 0 1px -1px  rgba(81, 81,81,0.2) inset,  
						 1px 0 6px -1px  rgba(81, 81,81,0.2) inset;  
}
#di table {
	font-size: 14px;
	color: #FFF;
	text-decoration: none;
}
#di table tr td a {
	color: #FFF;
	text-decoration: none;
}
</style>
</head>
<script type="text/javascript">
function show_info()
{
	document.getElementById("info").innerHTML="请输入完整学号";
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
	if(uname==""||uname.length<8)
	{
		alert("请填入你的完整学号");
		document.getElementById("uname").focus();
		return false;
	}
	if(upass=="")
	{
		alert("请填入您的登陆密码");
		document.getElementById("upass").focus();
		return false;
	}
	if(con_num=="")
	{
		alert("请填入验证码");
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
        window.open("wap/index.php","_self");	//自动检测设备，并响应网页
    }
</script>
<body>
<div id="ding"></div>
<div id="line"></div>
<div id="nr">
<table width="1105" border=0 align="center">
<tr>
	<td width="391" ><img  src="images/index_01.jpg"></td>
	<td width="293"><img src="images/index_02.gif" border="0"></td>
	<td width="407">
	 <form action="login_ver.php" method="post" >
		<table width=362 height=207 border=0 cellpadding=0 cellspacing=0 id="userinfo">
		<tr><td colspan=4 height="46"><img src="images\index_05.gif"></td></tr>
		<tr><td width=24 height="41" align="center">&nbsp;</td>
		  <td width=49 align="center">用户名</td>
		  <td width=164><label for="uname"></label>
		    <input type="text" name="uname" id="uname"></td>
		  <td width=125>请输入学号</td>
		</tr>
		<tr><td width=24 height="41" align="center">&nbsp;</td>
		  <td width=49 height="41" align="center">密 码</td>
		  <td width=164><label for="upass"></label>
		    <input type="password" name="upass" id="upass"></td>
		  <td width=125><a href="find_pw.php?r=2">忘记密码</a></td>
		</tr>
		<tr><td width=24 height="45" align="center">&nbsp;</td>
		  <td width=49 height="45" align="center">验证码</td>
		  <td width=164  height="45"><label for="check"></label>
		    <input type="text" name="check" id="check"></td>
		  <td width=125  height="45">
            <img id="captcha_img" border='1' src='vernum_code.php?r=echo rand();' onClick="document.getElementById('captcha_img').src='vernum_code.php?r='+Math.random()"/> 
          </td>
		</tr>
		<tr><td height="34" colspan="4" align="center" >
	<input type="submit" name="button" id="button" value="提交登陆"  onclick="return check_myform()"/>        </td></tr>
		</table>
	</form>
	</td>
</tr>
</table>
</div>
<div id="line"></div>
<div id="di">
  <table width="426" height="100" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="136" rowspan="4" align="center"><img src="pics/wx.jpg" width="100" height="99"></td>
      <td width="290" height="25">Sunking CAI manager system 2018.12.20</td>
    </tr>
    <tr>
      <td height="25">Reback&amp;Communication:sunkinglsx@163.com</td>
    </tr>
    <tr>
      <td height="25">Copyright&copy;sunking 2017</td>
    </tr>
    <tr>
      <td height="25"><a href="http://www.miitbeian.gov.cn">粤ICP备18073445</a></td>
    </tr>
  </table>
</div>
</body>
</html>