<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>管理上课班级</title>
<style type="text/css">
#form1 #tmain {
	background-color: #CCC;
	font-size: 12px;
	color: #333;
	text-decoration: none;
}
#form1 #tmain tr #cname {
	padding-left: 5px;
}
a:link {
	font-size: 12px;
	color: #333;
	text-decoration: none;
	height: 22px;
	width: 60px;
	border: 1px solid #666;
	padding-top: 3px;
	padding-right: 10px;
	padding-bottom: 3px;
	padding-left: 10px;
	background-color: #E3E3E3;
}
a:visited {
	font-size: 12px;
	color: #333;
	text-decoration: none;
	height: 22px;
	width: 60px;
	border: 1px solid #666;
	padding-top: 3px;
	padding-right: 10px;
	padding-bottom: 3px;
	padding-left: 10px;
	background-color: #E3E3E3;
}
a:hover {
	font-size: 12px;
	color: #333;
	text-decoration: none;
	height: 22px;
	width: 60px;
	border: 1px solid #666;
	padding-top: 3px;
	padding-right: 10px;
	padding-bottom: 3px;
	padding-left: 10px;
	background-color: #FFFFCC;
}
</style>
</head>
<body>
<?php
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	require("session.php");
	check_asession();	//必须要登陆
?>
<?php
	if(isset($_POST['active']))		//批量激活
	{
		if(isset($_POST['sele'])){
		foreach($_POST['sele'] as $id)
		{
			if ($id!="")
			{
				$sqls="update class set c_enable=1 where id=".$id;
				$rs=mysql_query($sqls,$conn);
				if(!$rs)
					echo "一条班级信息激活失败";
			}
		}
		echo "<script language='javascript'>alert('班级激活完成');
		</script>";
		}
		else
		{
			echo "<script language='javascript'>alert('请选择要操作的班级');</script>";
		}
	}
	//批量失效
	if(isset($_POST['disable']))		
	{
		if(isset($_POST['sele'])){
		foreach($_POST['sele'] as $id)
		{
			if ($id!="")
			{
				$sqls="update class set c_enable=0 where id=".$id;
				$rs=mysql_query($sqls,$conn);
				if(!$rs)
					echo "一条班级信息关闭失败";
			}
		}
		echo "<script language='javascript'>alert('班级关闭完成');
		</script>";
		}
		else
		{
			echo "<script language='javascript'>alert('请选择要操作的班级');</script>";
		}
	}
?>
<?php
	$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' order by c_enable desc";
	$crs=mysql_query($sqls,$conn);
	$rows=mysql_num_rows($crs);
	if($rows==0)
	{
		echo "你还没有添加任何任课班级";
		exit;
	}
?>
<form action="a_modify_class.php" method="post" name="form1" target="show" id="form1">
  <table width="800" height="120" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="32" colspan="4" bgcolor="#FFFFCC">管理首页》管理任课班级</td>
    </tr>
    <tr>
      <td width="194" height="25" align="center" bgcolor="#E1E1E1"> 班级编号</td>
      <td width="317" align="center" bgcolor="#E1E1E1">班级名称</td>
      <td width="146" align="center" bgcolor="#E1E1E1">状态</td>
      <td width="138" align="center" bgcolor="#E1E1E1">操作</td>
    </tr>
    <?php
		for($i=0;$i<$rows;$i++)
		{
			$arr_c=mysql_fetch_array($crs);
	?>
    <tr>
      <td height="29" align="center" bgcolor="#FFFFFF">
        <label ><input name="sele[]" type="checkbox"   id="sele[]"  value="<?php echo $arr_c['id'];?>"/>
      <?php echo $arr_c['c_id'];?></label>  </td>
      <td bgcolor="#FFFFFF" id="cname"><?php echo $arr_c['c_name'];?></td>
      <td align="center" bgcolor="#FFFFFF">
	  <?php 
	  		if($arr_c['c_enable']==1)
				echo "<font color='#009900'>任课中</font>";
			else
				echo "<font color='#CC3300'>已结束</font>";
	  ?>
	  </td>
      <td align="center" bgcolor="#FFFFFF">
      <?php  if ($arr_c['c_enable']==1)
	  				echo "<a href='a_add_course.php?cid=".$arr_c['c_id']."'>添加任课科目</a>";
	?>
      </td>
    </tr>
    <?php }?>
    <tr>
      <td height="29" colspan="2" align="center" bgcolor="#F0F0F0"></td>
      <td align="center" bgcolor="#F0F0F0"><input type="submit" name="active" id="active" value="批量激活" /></td>
      <td align="center" bgcolor="#F0F0F0"><input type="submit" name="disable" id="disable" value="批量失效" /></td>
    </tr>
  </table>
</form>

</body>
</html>