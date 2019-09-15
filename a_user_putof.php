<style type="text/css">
.txt_box {	height: 20px;
	width: 220px;
}
#tmain {	font-size: 12px;
	color: #333;
	text-decoration: none;
	background-color: #F1F1F1;
}
</style>
<link type="text/css" rel="stylesheet" href="css/lanrenzhijia.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src="js/jquery-3.2.1.js"></script>
<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>
<script src="js/jquery-ui-timepicker-zh-CN.js"></script>
<script language="javascript">
	function show_time()		//显示时间选 择
	{
		document.getElementById("time").style.visibility="visible";
	}
	function hide_time()		//隐藏时间选 择
	{
		document.getElementById("time").style.visibility="hidden";
	}
	function check_form()
	{
		var time=document.getElementsByName("endtime").item(0).value;
		var term=document.getElementById("term_3").value;
		if(term==0&&time=="")
		{
			alert("请选择账号有效时间");
			return false;
		} 
	}
</script>
<?php
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	require("session.php");
	check_asession();
	require("url_deal.php");
	if(!isset($_POST['button']))
	{
		$uid=url_deal($_GET['uid']);
		$sql="select * from ad_user where a_name='".$uid."'";
		$rs=mysql_query($sql,$conn);
		$arr=mysql_fetch_array($rs);
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" height="206" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="3" bgcolor="#FFFFCC">管理首页》管理任课老师》续费延期</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="98" height="37" align="center">用户名称：</td>
      <td width="728" colspan="2"><?php echo $arr['a_name'];?>
      <input name="uid" type="hidden" id="uid" value="<?php echo $arr['a_name'];?>"></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
      <td height="33" align="center">真实姓名：</td>
      <td colspan="2"><?php echo $arr['t_name'];?></td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#FFFFFF">延长时间：</td>
      <td height="28" colspan="2" valign="middle" bgcolor="#FFFFFF">
        <label>
            <input name="term" type="radio" id="term_0" value="1" checked="CHECKED" onclick="hide_time()">
            半年</label>
        <label>
          <input name="term" type="radio" id="term_1" value="2" onclick="hide_time()">
        一年</label>
        <label>
          <input name="term" type="radio" id="term_2" value="4" onclick="hide_time()">
        两年</label>
        <label>
          <input name="term" type="radio" id="term_3" value="0" onclick="show_time()">
        其它</label>
        </td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="28" colspan="2" valign="middle" bgcolor="#FFFFFF">
    <div class="doc-dd" style="visibility:hidden" id="time" >
       <input name="endtime" type="text" class="text-box" value="" placeholder="请选择时间" title="截止有效时间" readonly="readonly" style="cursor:pointer;"/>
        请选择用户账号有效时间
     </div>
<script >
	$( "input[name='endtime']" ).datetimepicker();
</script>      
      </td>
    </tr>
    <tr>
      <td height="35" colspan="3" align="center"><input type="submit" name="button" id="button" value="保存延期" onclick="return check_form()"/></td>
    </tr>
  </table>
</form>
<?php 	
}
	if(isset($_POST['button']))		//保存新有效期
	{
		if($_POST['term']==0)
		{
			$endtime=$_POST['endtime'];
		}
		else
		{
			$to_time=$_POST['term']*6;
			$endtime=date("Y-m-d h:i:s",strtotime("+".$to_time." months",time()));
		}
		$uid=$_POST['uid'];
		$sqls="update ad_user set end_time='".$endtime."' where a_name='".$uid."'";
		$rs=mysql_query($sqls,$conn);
		if($rs)
			{echo "<script language='javascript'>
			alert('续费延期成功，有效期自今天至".$endtime."止');
			location.href='a_aduser_list.php';
			</script>";
			}
		else
		{
			echo "<script language='javascript'>
			alert('续费延期失败,请检查原因或重新进行延期操作');
			location.href='a_aduser_list.php';
			</script>";	
		}
	}
?>