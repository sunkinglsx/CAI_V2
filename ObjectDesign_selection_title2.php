<?php
require('db_connect.php');
	mysql_query("SET NAMES 'gbk'");
require('session.php');
check_session();
$courseid=$_POST['courseid'];
$obj=$_POST['obj'];	//ѡ����ɷ�ʽ
$sobj=$_POST['sobj'];	//ѡ�����ͣ�0Ϊ��ѡ��1Ϊ��ѡ
$oteam=$_POST['oteam'];	//�Ŷ������0Ϊδ���Ӷӣ�1Ϊ�ѼӶ�
$dtid=$_POST['dtid'];	//ѡ��ID
$teamlist="";	//Ĭ���Լ�������� ������Ϊ��
$teamcout=1;	//Ĭ�϶�����Ϊ1�����Լ�
if(isset($_POST['odtid'])) 
{
	$odtid=$_POST['odtid'];	//��ѡ���
	$sqls_o_design_titles="select DT_taked from design_titles where DT_id=".$odtid;
	$rs_o_design_titles=mysql_query($sqls_o_design_titles,$conn);
	$arr_o_design_titles=mysql_fetch_array($rs_o_design_titles);	//�����ѡ�����ѡ����
}
else	$odtid="";
//��1�����Ŷӣ���ѡ��
if($obj==2&&$sobj==0&&$oteam==0)	
{
	if(!isset($_POST['cop']))	//δѡ���κκ����Ŷӳ�Ա
	{
				echo "<script language='javascript'>";
				echo "alert('������ѡ��һλ���ĺ�����飡');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
				exit;
	}
	else
	{
		$teamlist=$_POST['cop'];	//�����Ŷӳ�Ա����
		$teamcout=count($teamlist)+1;
	}
	//����Ŷӳ�Ա�Ƿ��ѱ������Ŷ�ѡ��
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
					echo "alert('��Ķ����Ѿ��μ�����������Ŀ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	//���ʣ�������Ƿ��㹻
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//�ͷ���Դ
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('����Ŀ��ѡ�����Ѳ��㣬������ѡ��������Ŀ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//д�����ݿ⣬�����¹�����
	{
		foreach($teamlist as $v)	//��������ߵ�ѡ���¼,
		{
			$t=explode("-",$v);
			$sid=$t[0];
			$sname=$t[1];
			//��������ߣ�ÿ���������Ƕ�Ա
			$sqls_in_stu_design_titles="insert into stu_design_titles(DT_id,coperator_id,coperator_name,S_id,S_name,Class_id)values(
			".$dtid.",'".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$sid."','".$sname."','".$_SESSION['s_class']."')";
			$rs_in_stu_design_titles=mysql_query($sqls_in_stu_design_titles,$conn);
		}
			//����ѡ�����Լ���ÿ��ѡ���߾��Ƕӳ���
			$sqls_in_stu_design_titles="insert into stu_design_titles(DT_id,coperator_id,coperator_name,S_id,S_name,Class_id)values(
			".$dtid.",'".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_class']."')";
			$rs_in_stu_design_titles=mysql_query($sqls_in_stu_design_titles,$conn);
			//����ѡ����ѡ����
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
			if($rs_in_stu_design_titles)
			{
					echo "<script language='javascript'>";
					echo "alert('��ϲ�����γ����ѡ��ɹ�����ץ����ɰɣ�');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
			else
			{
					echo "<script language='javascript'>";
					echo "alert('�γ����ѡ��ʧ�ܣ�ԭ��δ����������ѡ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
	}
}
//��2���Ŷ�����ѡ��
if($obj==2&&$sobj==1&&$oteam==1)
{
		
		//���ݶӳ�ѧ�ţ������Ŷӵ���Ա����
		$sqls_team_count="select count(SD_id) from stu_design_titles where coperator_id='".$_SESSION['s_id']."'";
		$rs_team_count=mysql_query($sqls_team_count,$conn);
		$arr_team_count=mysql_fetch_array($rs_team_count);
		$teamcout=count($arr_team_count[0]);	//�Ŷ�����
		mysql_free_result($rs_team_count);
	//���ʣ�������Ƿ��㹻
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//�ͷ���Դ
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('����Ŀ��ѡ�����Ѳ��㣬������ѡ��������Ŀ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//�������ݿ�
	{
			$sqls_update_stu_design_titles="update stu_design_titles set DT_id=".$dtid." where coperator_id='".$_SESSION['s_id']."'";
			$rs_update_stu_design_titles=mysql_query($sqls_update_stu_design_titles,$conn);
//			//����ѡ������ѡ����
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			//����ѡ��������ѡ����
//			$e=$arr_o_design_titles['DT_taked']-$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$odtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			mysql_free_result($rs_update_design_titles);
					echo "<script language='javascript'>";
					echo "alert('�����Ŷӿγ��������ѡ��ɹ�����ץ����ɰɣ�');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
}
//��3����������ѡ��
if($obj==1&&$sobj==1&&$oteam==0)
{
		
	$teamcout=1;
	//�����ѡ��ʣ�������Ƿ��㹻
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//�ͷ���Դ
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('����Ŀ��ѡ�����Ѳ��㣬������ѡ��������Ŀ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//�������ݿ�
	{
			$sqls_update_stu_design_titles="update stu_design_titles set DT_id=".$dtid." where S_id='".$_SESSION['s_id']."'";
			$rs_update_stu_design_titles=mysql_query($sqls_update_stu_design_titles,$conn);
//			//����ѡ�������ѡ����ѡ����
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			//����ѡ����о�ѡ����ѡ����
//			$e=$arr_o_design_titles['DT_taked']-$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$odtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			mysql_free_result($rs_update_design_titles);
					echo "<script language='javascript'>";
					echo "alert('��ϲ�����γ������ѡ�ɹ�����ץ����ɰɣ�');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
}

//��4�������˳��Ŷӣ�����ѡ�ⵥ��
if($obj==1&&$sobj==1&&$oteam==1)
{
		
	$teamcout=1;
	$isleader=$_POST['leader'];	//�Ƿ�ӳ�
	//�����ѡ��ʣ�������Ƿ��㹻
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//�ͷ���Դ
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('����Ŀ��ѡ�����Ѳ��㣬������ѡ��������Ŀ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//�������ݿ�
	{
			$sqls_update_stu_design_titles="update stu_design_titles set DT_id=".$dtid.",coperator_id='".$_SESSION['s_id']."',coperator_name='".$_SESSION['s_name']."' where S_id='".$_SESSION['s_id']."'";
			$rs_update_stu_design_titles=mysql_query($sqls_update_stu_design_titles,$conn);
//			//����ѡ�������ѡ����ѡ����
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
//			//����ѡ����о�ѡ����ѡ����
//			$e=$arr_o_design_titles['DT_taked']-$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$odtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
			//���ԭ���Ƕӳ�����ɢԭ�����Ŷӣ�ÿ����Ա��������Լ�����Ʒ
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
					echo "alert('���Ѷ���ѡ��ɹ��������ԭ���Ѽ���һ�������Ŷӣ����Ѳ������ڸ��Ŷӡ�');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
}
//��5��������ѡ��
if($obj==1&&$sobj==0&&$oteam==0)
{
		
		$teamcout=1;
	//�����ѡ��ʣ�������Ƿ��㹻
	$sqls_design_title="select DT_id,DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
	$rs_design_title=mysql_query($sqls_design_title,$conn);
	$arr_design_title=mysql_fetch_array($rs_design_title);
	$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
	mysql_free_result($rs_design_title);	//�ͷ���Դ
	if($y<$teamcout)
	{
					echo "<script language='javascript'>";
					echo "alert('����Ŀ��ѡ�����Ѳ��㣬������ѡ��������Ŀ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
	}
	else		//д�����ݿ�
	{
			$sqls_in_stu_design_titles="insert into stu_design_titles(DT_id,coperator_id,coperator_name,S_id,S_name,Class_id)values(
			".$dtid.",'".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_id']."','".$_SESSION['s_name']."','".$_SESSION['s_class']."')";
			$rs_in_stu_design_titles=mysql_query($sqls_in_stu_design_titles,$conn);
			//����ѡ�������ѡ����ѡ����
//			$e=$arr_design_title['DT_taked']+$teamcout;
//			$sqls_update_design_titles="update design_titles set DT_taked=".$e." where DT_id=".$dtid;
//			$rs_update_design_titles=mysql_query($sqls_update_design_titles,$conn);
			if($rs_in_stu_design_titles)
			{
					echo "<script language='javascript'>";
					echo "alert('��ϲ�����γ����ѡ��ɹ�����ץ����ɰɣ�');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
			else
			{
					echo "<script language='javascript'>";
					echo "alert('�γ����ѡ��ʧ�ܣ�ԭ��δ����������ѡ��');";
					echo "location.href='ObjectDesign_1.php?cid=".$courseid."';";
					echo "</script>";
					exit;
			}
	}
}
?>