<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<script language="javascript">
function se()
{
	if(this.checked==true)
	{var obj=this.value;
	document.getElementById("id").value=obj+"#";}
}
</script>
<body>
<table width="826" height="104" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="37" colspan="5" bgcolor="#FFFFCC">管理首页 》平行班作业管理 》</td>
  </tr>
  <tr>
    <td width="41" height="33" align="center" bgcolor="#EBEBEB">选择</td>
    <td width="226" align="center" bgcolor="#EBEBEB">标题</td>
    <td width="160" align="center" bgcolor="#EBEBEB">截止时间</td>
    <td width="125" align="center" bgcolor="#EBEBEB">讲义&mdash;&mdash;答案</td>
    <td width="268" align="center" bgcolor="#EBEBEB">目标班级与操作</td>
  </tr>
  <?php for($i=1;$i<=10;$i++)
  {
	  ?>
  <tr>
    <td height="30" align="center" bgcolor="#FFFFFF"><input type="checkbox" name="s[]" id="s<?php echo $i;?>" value="<?php echo $i;?>" onclick="se()"/>
    <label for="s[]"></label></td>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><form id="form1" name="form1" method="post" action="">
      <label for="class_list"></label>
      <select name="class_list" id="class_list">
        <?php for($j=0;$j<6;$j++)
	  {
				echo "<option value=".$j.">第".$j."选择</option>";
	  }
	  ?>
      </select>
      &nbsp;
      <input type="submit" name="button" id="button" value="复制本条作业" />
    </form></td>
  </tr>
  <?php }?>
</table>
<form  name="form2" action="" method="post">
<table width="826" height="43" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="481" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="164" bgcolor="#F0F0F0"><input type="hidden" name="id" id="id" />
      <input type="submit" name="button2" id="button2" value="提交" /></td>
    <td width="181" bgcolor="#F0F0F0">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>