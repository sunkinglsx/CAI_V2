<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ҵϵͳ&mdash;��ҵ����б�</title>
<style type="text/css">
#info {
	background-color: #FCFDD0;
	border-right-width: 1px;
	border-right-style: ridge;
	border-right-color: #F0F0F0;
	border-top-width: 1px;
	border-top-style: ridge;
	border-top-color: #F0F0F0;
	border-left-width: 1px;
	border-left-style: ridge;
	border-left-color: #F0F0F0;
	font-size: 12px;
	text-decoration: none;
}
a:link {
	font-size: 13px;
	color: #339;
	text-decoration: none;
	background-color: #E3E3E3;
	border: 1px solid #999;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
a:visited {
	font-size: 13px;
	color: #009;
	text-decoration: none;
}
a:hover {
	font-size: 13px;
	color: #F60;
	text-decoration: none;
	background-color: #FFC;
	border: 1px solid #F90;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
#OD a.design:link{
	border:0px solid #FFF;
	padding:0 0 0 0;
}
#info5 {
	font-size: 12px;
	font-weight: bold;
}
#t_main {
	background-color: #D8D8D8;
	font-size: 12px;
	margin-top:20px;
}
.txt_header {
	font-size: 14px;
	color: #009;
	text-decoration: none;
	font-weight: bold;
}
.txt_red_noraml {
	font-size: 12px;
	color: #900;
	text-decoration: none;
	background-color: #FFC;
	border: 1px solid #C30;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
}
body {
	background-color: #F4F4F4;
}
#OD {
	height: 160px;
	line-height:160px;
	width:1200px;
	margin:0 auto;
}
</style>
<script type="text/javascript">
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}
function show_alert()
{
	alert("��ҵ��ֹ�ύ�Ժ���ܲ鿴��");
}
</script>
</head>

<body>
<?php
	require("session.php");	//�Ự״̬�ļ�
	check_session();
	require("db_connect.php");	
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require("term.php");
	require("url_deal.php");
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	//����ѧ�����꼶�Լ���ǰʱ���ж�ѧ��
	$term=term($_SESSION['s_id']);
	$couid=url_deal($_GET['couid']);
	$c_sqls="select * from course where cou_id=".$couid;
	$cou_rs=mysql_query($c_sqls,$conn);
	$arr_course=mysql_fetch_array($cou_rs);
	$h_sqls="select * from homeworks where w_cou_id=".$couid." order by w_time desc";
	$w_rs=mysql_query($h_sqls,$conn);	//����ÿγ̵�ȫ����ҵ����
	$s_sqls="select s_id,w_id,s_term,is_deal,reason from stu_works where cou_id=".$couid." and s_id='".$_SESSION['s_id']."'";
	$s_rs=mysql_query($s_sqls,$conn);	//�����ѧ�����ύ��ȫ����ҵ
	if(isset($s_rs))
	{
		$s_rows=mysql_num_rows($s_rs);	//ѧ������ɵ���ҵ����
	}
	if(isset($w_rs))
		{
			$w_rows=mysql_num_rows($w_rs);	//��ѧ�ڲ��� ����ҵ����
			if($w_rows==0)
			{
				$w_note="<font color='#0033CC'>".$arr_course['cou_name']."��û�в����κοκ���ҵ��</font>";
				$w_pic='pics/not_submit.jpg';		//�����ѧ��û�в�����ҵ�������轻��ҵͼƬ
			}
		}
	else
	{
		$w_note="<font color='#0033CC'>".$arr_course['cou_name']."��û�в����κοκ���ҵ��</font>";
		$w_pic='pics/not_submit.jpg';		//�����ѧ��û�в�����ҵ�������轻��ҵͼƬ
	}
	if($w_rows>$s_rows)
	{
		$d=$w_rows-$s_rows;
		$w_note="<font color='#FF6655'>��һ����</font><font color='#FF0000'>��".$d."��</font><font color='#FF6655'>����ҵû����</font>";
		$w_pic='pics/need_submit.jpg';		//�����ѧ��û�в�����ҵ�������轻��ҵͼƬ
	}
	elseif($w_rows>0)
	{
		$w_note="<font color='#00CC00'>ֵ�õ��ޣ��������ȫ���Ŀκ���ҵ��</font>";
		$w_pic='pics/not_submit.jpg';		//�����ѧ��û�в�����ҵ�������轻��ҵͼƬ
	}
?>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="41" colspan="7" align="left" bgcolor="#DBECFE" class="txt_header">��ҵ����б�<?php echo $arr_course['cou_name'];?></td>
    <td height="41" align="center" bgcolor="#DBECFE" class="txt_header"><a href="course_list.php">�л��γ�</a></td>
  </tr>
  <tr>
    <td height="30" colspan="8" align="right" bgcolor="#FDFDD9" id="info"><?php show_welcome();?></td>
  </tr>
  <tr>
    <td height="25" colspan="8" bgcolor="#FFFFFF" id="info5">
	<marquee direction="left" scrollamount="3" scrolldelay="3" width="700">
     &nbsp;<img src="<?php echo $w_pic;?>" width="17" height="17" alt="" />&nbsp;
	 <?php echo $w_note;?></marquee>
    </td>
  </tr>
  <tr>
    <td height="32" colspan="8" align="right" bgcolor="#FFFFFF" id="info2"><?php show_operate();?></td>
  </tr>
  <?php 
  		if($w_rows>0)
		{
  ?>
  <tr>
    <td width="48" height="32" align="center" bgcolor="#DBECFE" id="l_num">���</td>
    <td width="267" align="center" bgcolor="#DBECFE">��ҵ����</td>
    <td width="158" align="center" bgcolor="#DBECFE">��ֹʱ��</td>
    <td width="82" align="center" bgcolor="#DBECFE">������</td>
    <td width="82" align="center" bgcolor="#DBECFE">����˵��</td>
    <td width="134" align="center" bgcolor="#DBECFE">��ҵ״̬</td>
    <td width="256" align="center" bgcolor="#DBECFE">����</td>
    <td width="124" align="center" bgcolor="#DBECFE">��������</td>
  </tr>
  <?php 
  		for($i=0;$i<$w_rows;$i++){
			$w_arr=mysql_fetch_array($w_rs);	//������ҵ��תΪ����
  ?>
  <tr bgcolor="#FFFFFF" id="w_list<?php echo $i;?>" onmousemove="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFC4','TR')" onmouseout="MM_changeProp('w_list<?php echo $i;?>','','backgroundColor','#FFFFFF','TR')">
    <td height="41" align="center"><?php $j=$i+1;echo $j;?></td>
    <td align="center"><?php echo $w_arr['w_name'];?></td>
    <td align="center"><?php echo $w_arr['w_time']; ?></td>
    <td align="center">
    <?php 
			//��ҵ״̬�ж����
			if($s_rows>0)		//ѧ���н���ҵ
			{
				mysql_data_seek($s_rs,0);	//����¼��ָ�븴λ
				for($k=0;$k<$s_rows;$k++)
				{
					$is_finish=0;
					$s_arr=mysql_fetch_array($s_rs);
					if($w_arr['w_id']==$s_arr['w_id'])
					{
						$is_finish=1;
						if($s_arr['is_deal']==101)
							echo "<img src='pics/finish.jpg' width='10' height='13' /><font color='#006600'>���ύ</font>";
						else
							echo "<font color='#006600'>".$s_arr['is_deal']." ��</font>";
						break;
					}
				}
				if($is_finish==0)
					{
						echo "<img src='pics/no_finish.jpg' width='10' height='13' /><font color='#FF0000'>δ���</font>";
					}
			}
			else
			{
						$is_finish=0;
						echo "<img src='pics/no_finish.jpg' width='10' height='13' /><font color='#FF0000'>δ���</font>";
			}
	?>
        </td>
    <td align="center">
    <?php
	if($s_rows>0){
				mysql_data_seek($s_rs,0);	//�ٽ���ҵ��ɼ�¼��ָ�븴λ
				for($k=0;$k<$s_rows;$k++)
				{
					$is_finish=0;
					$s_arr=mysql_fetch_array($s_rs);
					if($w_arr['w_id']==$s_arr['w_id'])
					{
						if($s_arr['reason']==0) echo "δ����";
						if($s_arr['reason']==1) echo "��������";
						if($s_arr['reason']==2) echo "������ͬ";
					}
				}
	}
	?>
    </td>
    <td align="center">
    <?php 
		if(strtotime($w_arr['w_time'])<time())		//����
		{
			echo "�ѽ�ֹ�ύ";
		}
		else
		{
			echo "������ȡ��";
		}
	?>
    </td>
    <td align="center"><?php 
		if($is_finish==0&&strtotime($w_arr['w_time'])>time())//δ�ύ��δ����
		{
			echo "<a href='more_work_info.php?couid=".$couid."&oid=0&wid=".$w_arr['w_id']."&t=".$term."' target='_blank'>�鿴����</a> �� ";
			echo "<a href='homework_submit.php?couid=".$couid."&t=".$term."&wid=".$w_arr['w_id']."'> �����ύ</a>";
		}
		elseif(strtotime($w_arr['w_time'])<time())
		{
			echo "<a href='more_work_info.php?oid=2&wid=".$w_arr['w_id']."' target='_blank'>�鿴����</a> ��  ";
			if($w_arr['w_answer']!="")
				echo "<a href=".$w_arr['w_answer']." title='���Ҽ�ѡ������'>�ο���</a>";	//��ʾ�ο���
			else
				echo "���޴�";
		}
		else
		{
			echo "<a href='more_work_info.php?oid=2&wid=".$w_arr['w_id']."' target='_blank'>�鿴����</a> ��  ";
			echo "<a href='#' title='��ֹ�ύ�������' onclick='show_alert()'>�ο���</a>";	//��ʾ�ο���
		}
	?>
    </td>
    <td align="center">
    <?php if($w_arr['w_handout']=="")
					echo "<font class='txt_red_noraml'>���޽���</font>";
				else
   					echo "<a href='".$w_arr['w_handout']."' target='_blank'>�����ȡ</a>";
	?>
	</td>
  </tr>
  <?php
		next($w_arr);}}?>
</table>
<br />
<?php 
	mysql_free_result($w_rs);
	mysql_free_result($s_rs);
	$sqls_c_design="select * from course_design where C_id=".$arr_course['cou_id'];
	$rs_design=mysql_query($sqls_c_design);
	if($rs_design&&mysql_num_rows($rs_design)>0)
	{
		$arr_design=mysql_fetch_array($rs_design);
		echo "<div id='OD'>";
		echo "<a href='ObjectDesign_1.php?cid=".$arr_course['cou_id']."' class='design' target='_blank'>";
		echo "<img src='pics/design.jpg' ></a></div>";
		mysql_free_result($rs_design);
	}
	mysql_free_result($cou_rs);
?>
<br />
<?php require("about.html");?>
</body>
</html>