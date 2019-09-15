<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>提示</title>
<style type="text/css">
#prompt {
	font-size: 12px;
	background-color: #FEFDE2;
	height: 200px;
	width: 600px;
	left: 50%;
	top: 50%;
	margin-top: -100px;
	margin-left: -300px;
	position: absolute;
	-webkit-box-shadow: #666 0px 0px 10px;
}
#prompt #t {
	height: 200px;
	width: 600px;
}
.red_txt {
	font-size: 14px;
	color: #F00;
	font-weight: bold;
}
</style>
</head>

<body>
<div id="prompt">
  <table width="600" border="0" cellpadding="0" cellspacing="0" id="t">
    <tr>
      <td width="7" height="34" bgcolor="#D5EBFB"></td>
      <td width="588" bgcolor="#D5EBFB"><img src="pics/warn.gif" width="17" height="15" /> 不温馨提示</td>
      <td width="5" bgcolor="#D5EBFB"></td>
    </tr>
    <tr>
      <td height="133" bgcolor="#E1E1E1"></td>
      <td><p>欢迎进入&ldquo;三金作业系统&rdquo;教学辅助系统。</p>
        <p>1、本系统只面向特定班级的同学开放，所以请您先登陆验证以后再使用本系纺。</p>
      <p id="a1">2、使用本系统提交作业时，<span class="red_txt">每次作业只有1次提交机会</span>，<span class="red_txt">不提供修改与补交</span>。</p>
      <p>3、为了更好使用系统功能，请登陆以后正确填写完整您的各项资料。</p></td>
      <td bgcolor="#E1E1E1"></td>
    </tr>
    <tr>
      <td bgcolor="#EBEBEB"></td>
      <td align="right" bgcolor="#EBEBEB"><input type="submit" name="button" id="button" value="好的，我知道了！" onclick="location.href='login.php'"/></td>
      <td bgcolor="#EBEBEB"></td>
    </tr>
  </table>
</div>
</body>
</html>