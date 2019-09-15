<style type="text/css">
a:link{
	font-size:12px;
	color:#066;
	background-color:#E7F5EC;
	border:1px solid #366;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	padding-top:5px;
	text-decoration:none;
}
a:hover{
		font-size:12px;
	color:#930;
	background-color:#CC6;
	border:1px solid #366;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	padding-top:5px;

}
a:visited{
		font-size:12px;
	color:#066;
	background-color:#E7F5EC;
	border:1px solid #366;
	padding-bottom:2px;
	padding-left:5px;
	padding-right:5px;
	padding-top:2px;

}
</style>
<?php
/////////////课程设计保存========================
	//获取学生作业id号
	session_start();
	$arr_cid=array();	//课程ID号数组
	$dname=$_POST['d_name'];//课程设计名称
	$stime=$_POST['stime'];	//开始选题时间
	$etime=$_POST['etime'];//结束选题时间
	$deal_false=0;	//保存失败的数量
	$deal_sucess=0;	//保存成功的数量
	require("db_connect.php");
	mysql_query("SET NAMES 'gbk'");	//与数据库一致
	require('term.php');
	if(isset($_GET['did']))	//如果是修改页面过来，则更新
	{
		$DID=$_GET['did'];
		$id=$_POST['cname'];
		$tmp=explode("#",$id);
		$sqls="update course_design set D_name='".$dname."',C_id=".$tmp[0].",S_time='".$stime."',E_time='".$etime."',Class_id='".$tmp[1]."',D_teacher='".$_SESSION['a_name']."' where D_ID=".$DID;
		$rs=mysql_query($sqls,$conn);
	}
	else
	{
		foreach($_POST['cname'] as $id)
		{
			if($id!="")
			{
				array_push($arr_cid,$id);	//入栈
			}
		}

		foreach($arr_cid as $key=>$id)		//更新数据表中is_deal字段
		{
			$tmp=explode("#",$id);
			$term=term($tmp[1]);
			$sqls="insert into course_design(D_name,C_id,S_time,E_time,Class_id,D_teacher,term)values('".$dname."',".$tmp[0].",'".$stime."','".$etime."','".$tmp[1]."','".$_SESSION['a_name']."',".$term.")";
			$rs=mysql_query($sqls,$conn);
			if(!$rs)
			{
				$deal_false+=1;
			}
			else
			{
				$deal_sucess+=1;
			}
		}
	}
		//返回处理结果
?>
<style type="text/css">
#tis {
	font-size: 12px;
	color: #066;
	text-decoration: none;
	border: 1px solid #CCC;
}
</style>

<table width="600" height="214" border="0" align="center" cellpadding="0" cellspacing="0" id="tis">
  <tr>
    <td height="35" align="center" bgcolor="#FFFFCC">操作提示</td>
  </tr>
  <tr>
    <td height="142">
    <?php if(!isset($DID)){?>
    一条课程设计项目发布完成，共应用于<span style="font-weight:bold; color:#900";><?php echo count($arr_cid);?>个</span>班级，成功<span style="font-weight:bold; color:#900";><?php echo $deal_sucess;?>个</span>，失败<span style="font-weight:bold; color:#900";><?php echo $deal_false;?>个</span>。
    <?php } else {?>
    <span style="font-weight:bold; color:#900";><?php if($rs) echo "一条课程设计项目修改完成。";else echo "课程项目修改失败";?></span>
    <?php }?>
    </td>
  </tr>
  <tr>
    <td height="37" align="center" bgcolor="#CCCCCC"><a href="a_design_list.php">返回</a></td>
  </tr>
</table>
