<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>员工注册</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="577" height="237" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="40" colspan="2" align="center">员工注册</td>
    </tr>
    <tr>
      <td width="117" align="center">员工号</td>
      <td width="454"><label for="y_id"></label>
      <input type="text" name="y_id" id="y_id" /></td>
    </tr>
    <tr>
      <td align="center">姓名：</td>
      <td><label for="y_name"></label>
      <input type="text" name="y_name" id="y_name" /></td>
    </tr>
    <tr>
      <td align="center">性别</td>
      <td><p>
        <label>
          <input type="radio" name="y_xb" value="1" id="y_xb_0" />
          男</label>
        <label>
          <input type="radio" name="y_xb" value="2" id="y_xb_1" />
          女</label>
        <br />
      </p></td>
    </tr>
    <tr>
      <td align="center">部门</td>
      <td><label for="y_bm"></label>
        <select name="y_bm" id="y_bm">
          <option value="人事部">人事部</option>
          <option value="后勤部">后勤部</option>
          <option value="广告部">广告部</option>
          <option value="销售部">销售部</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="ok" id="ok" value="提交注册" /></td>
    </tr>
  </table>
</form>
<?php
if(isset($_POST['ok']))
{
	$gh=$_POST['y_id'];
	$xm=$_POST['y_name'];
	$xb=$_POST['y_xb'];
	$bm=$_POST['y_bm'];
	if($xb==1)
		$xb="男";
	if($xb==2)
		$xb="女";	
	echo "注册成功<br>";
	echo "你的账户信息如下：<br>";
	echo "工号：".$gh."<br>";
	echo "姓名：".$xm."<br>";
	echo "性别：".$xb."<br>";
	echo "部门：".$bm;
}
?>
</body>
</html>