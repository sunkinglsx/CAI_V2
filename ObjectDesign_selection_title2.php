<?php
require('db_connect.php');
	mysql_query("SET NAMES 'gbk'");
require('session.php');
check_session();
$courseid=$_POST['courseid'];
$obj=$_POST['obj'];	//选题完成方式
$sobj=$_POST['sobj'];	//选题类型，0为新选，1为重选
$oteam=$_POST['oteam'];	//团队情况，0为未曾加队，1为已加队
$dtid=$_POST['dtid'];	//选题ID
$teamlist="";	//默认自己独立完成 ，队友为空
$teamcout=1;	//默认队友数为1，则自己
if(isset($_POST['odtid'])) 
{
	$odtid=$_POST['odtid'];	//旧选题号
	$sqls_o_design_titles="select DT_taked from design_titles where DT_id=".$odtid;
	$rs_o_design_titles=mysql_query($sqls_o_design_titles,$conn);
	$arr_o_design_titles=mysql_fetch_array($rs_o_design_titles);	//检出旧选题的已选人数
}
else	$odtid="";
//【1】新团队，新选题
if($obj==2&&$sobj==0&&$oteam==0)	
{
	if(!isset($_POST['cop']))	//未选择任何合作团队成员
	{
				echo "<script language='javascript'>";
				echo "alert('请至少选择一位您的合作伙伴！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	else
	{
		$teamlist=$_POST['cop'];	//合作团队成员名单
		$teamcout=count($teamlist)+1;
	}
	//检查团队成员是否已被其它团队选走
	$all_is_noselect=1;
	foreach($teamlist as $v)
	{
			$t=explode("-",$v);
			$sid=$t[0];
			$sqls_selected="select DT_id from stu_design_titles where S_id='".$sid."'";
			$rs_selected=mysql_query($sqls_selected,$conn);
			if($rs_selected&&mysql_num_rows($rs_selected)>0)
				 $all_is_noselect=0;
	}
	if($all_is_noselect==0)
	{
					echo "<script language='javascript'>";
					echo "alert('你的队友已经参加了其它的题目！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	//检查剩余名额是否足够
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//释放资源
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('该题目可选名额已不足，请重新选择其它题目！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//写入数据库，并更新关联表
	{
		foreach($teamlist as $v)	//插入合作者的选题记录,
		{
			$t=explode("-",$v);
			$sid=$t[0];
			$sname=$t[1];
			//插入合作者，每个合作者是队员
			$sqls_in_stu_design_titles="insert into stu_design_titles(DT_id,coperator_id,coperator_name,S_id,S_name,Class_id)values(
			".$dtid.",'".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$sid."','".$sname."','".$_SESSION['s_class']."')";
			$rs_in_stu_design_titles=mysql_query($sqls_in_stu_design_titles,$conn);
		}
			//插入选题者自己，每个选题者就是队长，
			$sqls_in_stu_design_titles="insert into stu_design_titles(DT_id,coperator_id,coperator_name,S_id,S_name,Class_id)values(
			".$dtid.",'".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_class']."')";
			$rs_in_stu_design_titles=mysql_query($sqls_in_stu_design_titles,$conn);
			//更新选题已选人数
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
			if($rs_in_stu_design_titles)
			{
					echo "<script language='javascript'>";
					echo "alert('恭喜您！课程设计选题成功，请抓紧完成吧！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
			else
			{
					echo "<script language='javascript'>";
					echo "alert('课程设计选题失败，原因未明，请重新选择！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
	}
}
//【2】团队重新选题
if($obj==2&&$sobj==1&&$oteam==1)
{
		
		//根据队长学号，检索团队的人员数量
		$sqls_team_count="select count(SD_id) from stu_design_titles where coperator_id='".$_SESSION['s_id']."'";
		$rs_team_count=mysql_query($sqls_team_count,$conn);
		$arr_team_count=mysql_fetch_array($rs_team_count);
		$teamcout=count($arr_team_count[0]);	//团队人数
		mysql_free_result($rs_team_count);
	//检查剩余名额是否足够
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//释放资源
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('该题目可选名额已不足，请重新选择其它题目！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//更新数据库
	{
			$sqls_update_stu_design_titles="update stu_design_titles set DT_id=".$dtid." where coperator_id='".$_SESSION['s_id']."'";
			$rs_update_stu_design_titles=mysql_query($sqls_update_stu_design_titles,$conn);
//			//更新选题表的已选人数
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			//更新选题表旧题已选人数
//			$e=$arr_o_design_titles['DT_taked']-$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$odtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			mysql_free_result($rs_update_design_titles);
					echo "<script language='javascript'>";
					echo "alert('您的团队课程设计重新选题成功，请抓紧完成吧！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
}
//【3】个人重新选题
if($obj==1&&$sobj==1&&$oteam==0)
{
		
	$teamcout=1;
	//检查新选题剩余名额是否足够
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//释放资源
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('该题目可选名额已不足，请重新选择其它题目！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//更新数据库
	{
			$sqls_update_stu_design_titles="update stu_design_titles set DT_id=".$dtid." where S_id='".$_SESSION['s_id']."'";
			$rs_update_stu_design_titles=mysql_query($sqls_update_stu_design_titles,$conn);
//			//更新选题表中新选题已选人数
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			//更新选题表中旧选题已选人数
//			$e=$arr_o_design_titles['DT_taked']-$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$odtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			mysql_free_result($rs_update_design_titles);
					echo "<script language='javascript'>";
					echo "alert('恭喜您！课程设计重选成功，请抓紧完成吧！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
}

//【4】个人退出团队，重新选题单干
if($obj==1&&$sobj==1&&$oteam==1)
{
		
	$teamcout=1;
	$isleader=$_POST['leader'];	//是否队长
	//检查新选题剩余名额是否足够
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//释放资源
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('该题目可选名额已不足，请重新选择其它题目！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//更新数据库
	{
			$sqls_update_stu_design_titles="update stu_design_titles set DT_id=".$dtid.",coperator_id='".$_SESSION['s_id']."',coperator_name='".$_SESSION['s_name']."' where S_id='".$_SESSION['s_id']."'";
			$rs_update_stu_design_titles=mysql_query($sqls_update_stu_design_titles,$conn);
//			//更新选题表中新选题已选人数
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			//更新选题表中旧选题已选人数
//			$e=$arr_o_design_titles['DT_taked']-$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$odtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
			//如果原本是队长，解散原来的团队，每个队员独立完成自己的作品
			if($isleader==1)
			{
				$sqls_explode_stu_design_titles="select * from stu_design_titles where coperator_id='".$_SESSION['s_id']."'";
				$rs_explode_stu_design_titles=mysql_query($sqls_explode_stu_design_titles,$conn);
				for($i=0;$i<mysql_num_rows($rs_explode_stu_design_titles);$i++)
				{
					$arr_explode_stu_design_titles=mysql_fetch_array($rs_explode_stu_design_titles);
					if($arr_explode_stu_design_titles['S_id']!=$arr_explode_stu_design_titles['coperator_id'])
					{
						$s="update stu_design_titles set coperator_id='".$arr_explode_stu_design_titles['S_id']."',coperator_name='".$arr_explode_stu_design_titles['S_name']."' where SD_id=".$arr_explode_stu_design_titles['SD_id'];
						$rs_explode=mysql_query($s,$conn);
					}
				}
				mysql_free_result($rs_explode_stu_design_titles);
			}
					echo "<script language='javascript'>";
					echo "alert('您已独立选题成功！如果您原来已加入一个合作团队，您已不再属于该团队。');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
}
//【5】个人新选题
if($obj==1&&$sobj==0&&$oteam==0)
{
		
		$teamcout=1;
	//检查新选题剩余名额是否足够
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//释放资源
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('该题目可选名额已不足，请重新选择其它题目！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//写入数据库
	{
			$sqls_in_stu_design_titles="insert into stu_design_titles(DT_id,coperator_id,coperator_name,S_id,S_name,Class_id)values(
			".$dtid.",'".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_class']."')";
			$rs_in_stu_design_titles=mysql_query($sqls_in_stu_design_titles,$conn);
			//更新选题表中新选题已选人数
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
			if($rs_in_stu_design_titles)
			{
					echo "<script language='javascript'>";
					echo "alert('恭喜您！课程设计选题成功，请抓紧完成吧！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
			else
			{
					echo "<script language='javascript'>";
					echo "alert('课程设计选题失败，原因未明，请重新选择！');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
	}
}
?>