<style type="text/css">
#tlist {
	font-size: 12px;
	line-height: 23px;
	color: #066;
	text-decoration: none;
	border: 1px dotted #CCC;
}
#tlist td {
	border: 1px dotted #CCC;
	padding-left:5px;
	padding-right:5px;
}
a.b:link{
	color: #066;
	padding-bottom:3px;
	padding-left:9px;
	padding-right:9px;
	padding-top:3px;
	border:1px solid #CCC;
	text-decoration:none;
	background-color:#D1E9DB;
	margin-left:3px;
	margin-right:3px;
}
a.b:hover{
	color: #900;
	padding-bottom: 3px;
	padding-left: 9px;
	padding-right: 9px;
	padding-top: 3px;
	border: 1px solid #CCC;
	background-color: #DAD2F4;
		margin-left:3px;
	margin-right:3px;

}
a.b:visited{
	color: #066;
	padding-bottom:3px;
	padding-left:9px;
	padding-right:9px;
	padding-top:3px;
	border:1px solid #CCC;
		margin-left:3px;
	margin-right:3px;

}
body{
	margin-top:20px;
	font-size:12px;
	color:#066;
}
#deman {
	color: #006666;
	background-color: #FFC;
	height: 450px;
	width: 700px;
	border: 1px dashed #D6D6D6;
	position: absolute;
	left: 39px;
	top: 63px;
	font-size: 12px;
	visibility:visible;
}
.close{
	background-color:#CCC;
	padding-bottom:5px;
	padding-left:5px;
	padding-right:5px;
	padding-top:5px;
	border:1px solid #999;
	text-decoration:none;
	font-size:12;
	color:#063;
}
</style>
<?php 
	require('db_connect.php');
	mysql_query("SET NAMES 'gbk'");
	require('session.php');
	check_asession();
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url
	$aname=$_SESSION['a_name'];
	$did=$_GET['did'];	//课程设计ID
	$dname=$_GET['dname'];//课程设计标题
	$classid=$_GET['classid'];//适用班级
	$sqls_d="select * from course_design where D_teacher='".$aname."'";
	$rs_d=mysql_query($sqls_d,$conn);
	for($i=0;$i<mysql_num_rows($rs_d);$i++)
	{
		$tmp=mysql_fetch_array($rs_d);
		if($tmp['D_ID']!=$did)
		{
			$arr_d[$i][0]=$tmp['D_ID'];
			$arr_d[$i][1]=$tmp['D_name'];
			$arr_d[$i][2]=$tmp['Class_id'];
		}
	}
	$sqls="select * from design_titles where  D_id=".$did;	//该课程设计全部选题查询
	$rs=mysql_query($sqls,$conn);
	$rs_rows=mysql_num_rows($rs);
	echo $rs_rows;
	if($rs_rows==0)
	{
		echo "《".$dname."》未添加任何可供学生选择的设计题目。 ";
		echo "<a href='a_design_title_add.php?did=".$did."&classid=".$classid."&dname=".$dname."' class='b'>现在添加</a><br>";
	}
	else
	{
?>
<table width="100%" height="107" border="0" cellpadding="0" cellspacing="0" id="tlist">
  <tr>
    <td height="39" colspan="8" bgcolor="#FFFFCC">课程设计项目管理》选题列表》<?php echo $dname."---".$classid;?></td>
  </tr>
  <tr>
    <td width="38" height="38" align="center" bgcolor="#F2F2F2">序号</td>
    <td width="223" align="center" bgcolor="#F2F2F2">选题名称</td>
    <td width="40" align="center" bgcolor="#F2F2F2">可选</td>
    <td width="43" align="center" bgcolor="#F2F2F2">已选</td>
    <td width="213" align="center" bgcolor="#F2F2F2">已选名单</td>
    <td width="54" align="center" bgcolor="#F2F2F2">加分值</td>
    <td width="127" align="center" bgcolor="#F2F2F2">&nbsp;</td>
    <td width="274" align="center" bgcolor="#F2F2F2">复制应用</td>
  </tr>
  <?php 
  for($i=0;$i<$rs_rows;$i++)
  {
	  $rs_arr=mysql_fetch_array($rs);
	  if($i%2==1)
	  		echo "<tr style='background-color:#F8FCFC;'>";
		else
			echo "<tr>";
  ?>
        <td height="30" align="center"><?php $j=$i+1;echo $j;?></td>
    <td><?php echo $rs_arr['DT_title'];?></td>
    <td align="center"><?php echo $rs_arr['DT_takers'];?></td>
    <td align="center"><?php echo $rs_arr['DT_taked'];?></td>
    <td align="center">
    <?php 
		$sname_selected="";
		$sid_selected="";
		$sql_selected="select * from stu_design_titles where DT_id=".$rs_arr['DT_id'];
		$rs_selected=mysql_query($sql_selected,$conn);
		if($rs_selected&&mysql_num_rows($rs_selected)>0)
		{
			$takers=mysql_num_rows($rs_selected);	//已选人数
			for($m=0;$m<$takers;$m++)
			{
				$tmp=mysql_fetch_array($rs_selected);
				$sname_selected.=$tmp['S_name']."&nbsp;";
				$sid_selected.=$tmp['S_id']."&nbsp;";
			}
			mysql_free_result($rs_selected);	//释放记录集
		}
		else
		{
			$sid_selected="无";
			$sname_selected="无";
		}
		echo $sname_selected;
	?>
    </td>
    <td align="center"><?php echo $rs_arr['DT_bonus'];?></td>
    <td align="center"><a href="a_design_title_edit.php?did=<?php echo $did;?>&dname=<?php echo $dname;?>&dtid=<?php echo $rs_arr['DT_id'];?>&classid=<?php echo $classid;?>" class="b"> 修改</a>
    <a href="a_design_title_delete.php?dtid=<?php echo $rs_arr['DT_id'];?>" class="b">删除</a>
     </td>
    <td align="center"><form id="form1" name="form1" method="post" action="a_design_title_copy.php">
      <label for="copyto"></label>
      <select name="copyto" id="copyto">
      <?PHP 
	  		foreach($arr_d as $k)
			{?>
        	<option value="<?php echo $k[0];?>"><?php echo $k[1]."---".$k[2];?></option>
           <?php }?>
      </select>
      <input type="submit" name="button" id="button" value="复制" />
      <input type="hidden" name="dtid" id="dtid"  value="<?php echo $rs_arr['DT_id'];?>"/>
    </form></td>
  </tr>  <?php   }?>
</table>
<?php }?>
<br  />
<a href='a_design_title_add.php?did=<?php echo $did;?>&dname=<?php echo $dname;?>&classid=<?php echo $classid;?>' class='b'>继续添加选题</a>