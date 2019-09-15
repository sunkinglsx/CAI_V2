<style type="text/css">
#t_main {
	background-color: #EBEBEB;
	font-size: 12px;
}
a:link {
	font-size: 12px;
	color: #C00;
	text-decoration: none;
	background-color: #FFF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #900;
}
a:visited {
	font-size: 12px;
	color: #C00;
	text-decoration: none;
	background-color: #FFF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #900;
}
a:hover {
	font-size: 12px;
	color: #060;
	text-decoration: none;
	background-color: #CCF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #390;
}
</style>
<script language="javascript">
function check_form()
{
	if(document.getElementById("deal[]").checked==false)
	{
		alert("请选择要批阅的学生作业");
		return false;
	}
}
</script>
<?php
	session_start();
	$couid=$_GET['couid'];
	$cid=$_GET['cid'];
	$wname=$_GET['wname'];
	//记住当前完整 的url
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
		$sqls="select * from  stu_works where cou_id=".$couid." and s_id like '".$cid."%'";
		$wrs=mysql_query($sqls,$conn);
		if(!$wrs)
		{
			echo "还没有学生交作业";
			exit;
		}
		else
		{
			$wrows=mysql_num_rows($wrs);
			if($wrows==0)
			{
				echo "还没有学生交作业";
				exit;
			}
		}
?>
<form id="form1" name="form1" method="post" action="a_homework_deal.php">
  <table width="100%" height="122" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
    <tr>
      <td height="29" colspan="6" bgcolor="#FFFFFF">管理首页 》 批阅作业 》作业选择》<?php echo $cid;?>》【<?php echo $wname;?>】</td>
    </tr>
    <tr>
      <td width="60" align="center" bgcolor="#EBEBEB">选择</td>
      <td width="83" height="24" align="center" bgcolor="#EBEBEB">序号</td>
      <td width="261" align="center" bgcolor="#EBEBEB">作业题</td>
      <td width="156" align="center" bgcolor="#EBEBEB">上交时间</td>
      <td width="107" align="center" bgcolor="#EBEBEB">作业文件</td>
      <td width="80" align="center" bgcolor="#EBEBEB">操作</td>
    </tr>
    <?php 
  	for($i=0;$i<$wrows;$i++)
	{	$arr_w=mysql_fetch_array($wrs);	//转换为数组
  ?>
    <tr>
      <td align="center" bgcolor="#FFFFFF">
      <?php if ($arr_w['is_deal']==0) {?>
      <input type="checkbox" name="deal[]" id="deal[]"  value="<?php echo $arr_w['id'];?>"/>
      <?php }   else { echo "◎";}?>
      </td>
      <td height="32" align="center" bgcolor="#FFFFFF"><?php echo $arr_w['s_id'];?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $wname;?></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $arr_w['s_time'];?></td>
      <td align="center" bgcolor="#FFFFFF"><a href="<?php echo $arr_w['s_file'];?>">下载查看</a></td>
      <?php if ($arr_w['is_deal']==0) {?>
      <td align="center" bgcolor="#FFFFFF">
      <label for="deal[]"><a href="a_homework_deal.php?wid=<?php echo $arr_w['id'];?>">批阅</a></label>      
      </td>
	  <?php }  else { ?>
      <td width="356" align="center" bgcolor="#FFFF80">
      <label for="deal[]">已批阅</label>      
      </td>
      <?php }?>
    </tr>
    <tr>    <?php }?>
      <td height="32" colspan="6" align="center" bgcolor="#EBEBEB"><input type="submit" name="button" id="button" value="提交批阅" onclick="return check_form()" /></td>
    </tr>
  </table>
</form>
