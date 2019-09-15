<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>课程设计项目发布</title>
<style type="text/css">
#form1 #dtable {
	width: 700px;
	border: 1px solid #999;
	font-size: 12px;
	font-style: normal;
	box-shadow: 3px 3px 3px #999;
	-webkit-box-shadow: 3px 3px 3px #999;
	margin-top: 15px;
	line-height: 25px;
	color: #066;
	text-decoration: none;
}
</style>
</head>

<body>
<?php
	require("session.php");
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	check_asession();	//检查管理员是否登录
	$sqls="select * from course where cou_teacher='".$_SESSION['a_name']."' and cou_enable=1";
	$rs=mysql_query($sqls,$conn);
	$rs_rows=mysql_num_rows($rs);
?>
<form id="form1" name="form1" method="post" action="a_design_save.php">
  <table width="714" height="211" border="0" align="center" cellpadding="0" cellspacing="0" id="dtable">
    <tr>
      <td height="35" colspan="2" bgcolor="#FFFFCC">&gt;&gt;发布课程设计</td>
    </tr>
    <tr>
      <td width="146" height="37" align="center" bgcolor="#E7E7E7">课程设计名称</td>
      <td width="568" bgcolor="#E7E7E7"><label for="d_name"></label>
      <input type="text" name="d_name" id="d_name" width="300" /></td>
    </tr>
    <tr>
      <td height="33" align="center">适用课程名称：</td>
      <td>
      <?php 
	  if($rs_rows==0)
	  		echo "当前没有属于您的课程可选择，请先发布课程或激活课程!";
	  else
	  {
	  ?>
      <label for="c_name"></label>
        <p>
        <?php 
			for($i=0;$i<$rs_rows;$i++)
			{
				$rs_arr=mysql_fetch_array($rs);
		?>
          <label>
            <input type="checkbox" name="cname[]" value="<?php echo $rs_arr['cou_id']."#".$rs_arr['class_id'];?>" id="cname[]" />
            <?php echo $rs_arr['cou_name'].'---'.$rs_arr['class_id'].'---第'.$rs_arr['cou_term'].'学期';?></label>
          <br />
          <?php 	  }?>
      </p>
      <?php }?>
      </td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#E7E7E7">选题开始时间：</td>
      <td bgcolor="#E7E7E7"><input type="datetime-local" width="200"  id="stime" name="stime"/></td>
    </tr>
    <tr>
      <td height="35" align="center">选题结束时间：</td>
      <td><input type="datetime-local" width="200" id="etime"  name="etime"/></td>
    </tr>
    <tr>
      <td height="36" colspan="2" align="center" bgcolor="#CCCCCC">
      <input type="submit" name="button" id="button" value="提交发布"  onclick="return check_form()"/>
      </td>
    </tr>
  </table>
</form>
</body>
</html>
<script type="text/javascript">
	function check_form()
	{
		var dname=document.getElementById("d_name").value;
		var cname=document.getElementById("cname[]").value;
		var stime=document.getElementById("stime").value;
		var etime=document.getElementById("etime").value;
		if(dname=="")
		{
			alert("请填写课程设计名称！");
			return false;
		}
		if(cname=="")
		{
			alert("请选择一门适用课程！");
			return false;
		}
		if(stime=="")
		{
			alert("请选择课程设计开始选题的时间！");
			return false;
		}
		if(etime=="")
		{
			alert("请选择课程设计结束选题的时间！");
			return false;
		}
		if(stime>=etime)
		{
			alert("选题结束时间必须晚于开始时间！");
			return false;
		}
	}
</script>