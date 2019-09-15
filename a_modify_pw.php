<style type="text/css">
#login {
	background-color: #9CF;
	height: 200px;
	width: 500px;
	margin-top: -100px;	/*顶端是高度的负一半*/
	margin-left: -200px;	/*左端是宽度的负一半*/
	position: absolute;
	left: 50%;
	top: 50%;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=5);
	box-shadow: 2px 2px 10px #909090;	/*IE9或chrome*/
	z-index: 3;
}
#login #t_login {
	background-color: #99F;
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
<script language="javascript">
function check_myform()
{
	var opass=document.getElementById("oupass").value;
	var upass=document.getElementById("nupass").value;
	var nupass=document.getElementById("nupass_2").value
	if(opass==""||opass.length<6)
	{
		alert("旧密码长度错误");
		document.getElementById("oupass").focus();
		return false;
	}
	if(upass=="")
	{
		alert("请填入您的您密码");
		document.getElementById("nupass").focus();
		return false;
	}
	if(upass.length<6||upass.length>12)
	{
		alert("密码长度至少6位最多12位");
		document.getElementById("nupass").focus();
		return false;
	}
	if(nupass=="")
	{
		alert("请确认您的新密码");
		document.getElementById("nupass_2").focus();
		return false;
	}
	if(nupass!=upass)
	{
		alert("新密码确认错误！");
		document.getElementById("nupass_2").focus();
		return false;
	}
}
</script>
<div id="login">
  <form id="form1" name="form1" method="post" action="a_modify_pw_save.php">
    <table width="500" height="200" border="0" cellpadding="0" cellspacing="1" id="t_login">
      <tr>
        <td height="38" colspan="2" align="center" bgcolor="#C4D7FF">修改登陆密码</td>
      </tr>
      <tr>
        <td width="205" rowspan="3" align="center" bgcolor="#FFFFFF"><table width="209" height="112" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="115" rowspan="3" align="center"><img src="pics/login.jpg" width="105" height="105" /></td>
            <td width="94" height="31" align="center">旧密码：</td>
          </tr>
          <tr>
            <td height="34" align="center">新密码：</td>
          </tr>
          <tr>
            <td height="47" align="center">新密码确认：</td>
          </tr>
        </table></td>
        <td width="292" height="28" align="left" bgcolor="#FFFFFF"><label for="uname"></label>
          <input type="text" name="oupass" id="oupass"  /></td>
      </tr>
      <tr>
        <td height="35" align="left" bgcolor="#FFFFFF"><label for="upass"></label>
        <input type="text" name="nupass" id="nupass" /></td>
      </tr>
      <tr>
        <td height="47" align="left" bgcolor="#FFFFFF"><label for="check"></label>
          <input type="text" name="nupass_2" id="nupass_2" /></td>
      </tr>
      <tr height="32">
        <td height="32" colspan="2" align="center" bgcolor="#C4D7FF" ><input type="submit" name="button" id="button" value="提交修改" onclick="return check_myform();"/></td>
      </tr>
    </table>
  </form>
</div>
