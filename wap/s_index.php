<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<title>������ҵ����ϵͳ</title>
<style type="text/css">
#banner {
	height: 135px;
	width: 100%;
	background:url(../pics/wap_banner.jpg) no-repeat ;
	background-size:100%;
	vertical-align:central;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.logout{
		width:24px;
		height:13px;
		top:15px;
		left:300px;
		position:absolute;
}	
.home{
		width:23px;
		height:21px;
		top:15px;
		left:260px;
		position:absolute;
}		
a:link {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
}
a:visited {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
}
a:hover {
	font-size: 14px;
	color: #FF0;
	text-decoration: none;
}
.user{
	text-align:center;
	color:#FF0;
	font-size:14px;
	width:70%;
	top:50px;
	left:40px;
	position:absolute;
}
.icon_list{
	width:100%;
	display:inline-block;
}
.icon{
	height:53px;
	width:32%;
	text-align:center;
	display:inline-block;
	margin:0;
}
.icon_text{
	font-size:14px;
	color:#36C;
	text-align:center;
	width:32%;
	display:inline-block;
	height:20px;
	line-height:20px;
}
.pray{
	width:95%;
	font-size:13px;
	color:#FFF;
	top:90px;
	left:8px;
	position:absolute;
	text-align:center;
}
.t_list{
	font-size: 14px;
	color: #999;
	padding: 1px;
}
#list2 a:link {
	font-size: 14px;
	color: #999;
	text-decoration: none;
}
#list2 a:visited {
	font-size: 14px;
	color: #999;
	text-decoration: none;
}
#list3 a:link {
	font-size: 14px;
	color: #69F;
	text-decoration: none;
}
#list3 a:visited {
	font-size: 14px;
	color: #69F;
	text-decoration: none;
}
.list{
	margin-top:3px;
	visibility:visible;
}
.bottom{
	width:100%;
	background-color:#9398F9;
	color:#FFF;
	font-size:13px;
}
</style>
</head>

<body >
<?php require('../session.php');
			check_session();
			require('../term.php');
			$term=term($_SESSION['s_id']);
			$class=substr($_SESSION['s_id'],0,6);
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
			$sql_cou="select * from course where class_id='".$class."' and cou_term=".$term." and cou_enable=1";
			$rs_cou=mysql_query($sql_cou,$conn);	//�γ��б�
			$arr_sourse=array();		//�γ���Դ����
			$arr_stu_home=array();	//ѧ����ҵ�������
?>
<div id="banner">
	<div  class="home"><a href="s_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['s_name']."��".$_SESSION['s_id'];?></a></div>
  <div class="pray">
	<?php 
		if(date("H",time())>=0&&date("H")<12)
			$noon="һ��֮�����ڴ���һ��֮�����ڳ�";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="һ�����һ��𣬴����������";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="��ɽ��·��Ϊ����ѧ�����Ŀ�����";
		else
			$noon="���鵱ϧ���ࣺ������֮�࣬ҹ����֮�࣬������ʱ֮��Ҳ";
		echo $noon;
	?></div>
</div>
<div class="icon_list">
    <div class="icon"><a href="course_list.php"><img src="../pics/icon_r1_c1.jpg" width="61" height="53"  border="0"/></a></div>
    <dd class="icon"><a href="course_list.php"><img src="../pics/icon_r1_c5.jpg" width="63" height="53"   border="0"/></a></dd>
    <dd class="icon"><a href="course_list.php"><img src="../pics/icon_r1_c3.jpg" width="66" height="53"   border="0"/></a></dd>
 </div>
<div class="icon_list">
    <div class="icon_text">��ϰ�γ�</div>
    <div class="icon_text">��ҵ��ϸ</div>
    <div class="icon_text">�γ���Դ</div>
</div>
<div id="list1" class="list">	<!--�γ��б�-->
<?php if(!$rs_cou)
				echo "��ѧ��������ϰ�γ�";
			else
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="3" align="center" bgcolor="#E3E2F5">��ϰ�γ�</td>
    </tr>
  <?php for($i=0;$i<mysql_num_rows($rs_cou);$i++)
  {
	  	$arr_cou=mysql_fetch_array($rs_cou);  
		$arr_stu_home[$i][1]=$arr_cou['cou_name'];	//�γ�������Ϊѧ����ҵ��������ÿ�е�1��
		$arr_stu_home[$i][0]=$arr_cou['cou_id'];
		$sql_source="select *  from homeworks where w_cou_id=".$arr_cou['cou_id']." order by w_id desc";	//���ÿ�ſγ̵���Դ
		$rs_source=mysql_query($sql_source,$conn);	//��Դ�б�
		if($rs_source)	//��Դ��Ϊ�գ�ѹ����Դ���飨��ά��
		{
			$arr_stu_home[$i][2]=mysql_num_rows($rs_source);	//ѧ����ҵ��������2��Ϊ���ſγ̵��Ѳ�����ҵ����
			$arr_stu_home[$i][3]=0;	////ѧ����ҵ��������2��Ϊ���ſγ̵����ύ��ҵ����
			$arr_stu_home[$i][4]=0;	////ѧ����ҵ��������2��Ϊ���ſγ̵�δ�ύ��ҵ����
			for($j=0;$j<mysql_num_rows($rs_source);$j++)
			{
				$tmp=mysql_fetch_array($rs_source);
				array_push($arr_sourse,$tmp);
				$sqls="select * from stu_works where w_id=".$tmp['w_id']." and s_id='".$_SESSION['s_id']."'";	//���ѧ���Ƿ��ѽ���ҵ
				$rs=mysql_query($sqls,$conn);
				if($rs)
					$arr_stu_home[$i][3]+=1;
				else
					$arr_stu_home[$i][4]+=1;
			}
		}
  ?>
  <tr>
    <td width="16%" height="25" align="center"><?php echo $i+1;?></td>
    <td width="51%" align="center"><?php echo $arr_cou['cou_name'];?></td>
    <td width="33%" align="center"><?php echo "��".$term."ѧ��";?></td>
  </tr>
 <?php }?>
</table>
</div>
<div id="list2" class="list">	<!--��ҵ��ϸ-->
<?php 
//���������ѧ��ȫ����Ŀ��ȫ����ҵ
	$homework_total=0;	//ȫ����ҵ����
	$homework_handin=0;	//�ѽ���ҵ����
	$homework_nohandin=0;	//δ����ҵ����
	for($i=0;$i<mysql_num_rows($rs_cou);$i++)
	{
		$sqls_hom="select * from homeworks where w_term=".$term." and w_cou_id='".$class."'";
		$rs_home=mysql_query($sqls_hom,$conn);
	}
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="center" bgcolor="#E3E2F5">��ҵ�ܿ�</td>
    </tr>
   <?php 
   	for($i=0;$i<count($arr_stu_home);$i++){
   ?>
  <tr>
    <td width="40%" height="25" align="center"><a href="homework_list.php?cid=<?php echo $arr_stu_home[$i][0];?>&cname=<?php echo $arr_stu_home[$i][1];?>"><?php echo $arr_stu_home[$i][1];?></a></td>
    <td width="20%" align="left"><?php echo $arr_stu_home[$i][2];?> ����ҵ</td>
    <td width="20%" align="left"><font color="#33CC33">[�ѽ�]<?php echo $arr_stu_home[$i][3];?>��</font></td>
    <td width="20%" align="left"><font color="#CC3300">[δ��]<?php echo $arr_stu_home[$i][4];?>��</font></td>
  </tr>
  <?php }?>
</table>

</div>
<div id="list3" class="list">	<!--������Դ-->
<?php 
	if(count($arr_sourse)==0)
		echo "������ʦ�����κογ���Դ";
	else
?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="22" colspan="4" align="center" bgcolor="#E3E2F5">�γ���Դ</td>
    </tr>
    <?php 
	for($i=0;$i<count($arr_sourse);$i++)
	{
	?>
  <tr>
    <td width="8%" height="25" align="center"><?php  echo $i+1;?></td>
    <td width="56%"><?php  echo $arr_sourse[$i]['w_name'];?></td>
    <td width="18%">
	  <span class="table">
	  <?php  
	echo "<a href='../".$arr_sourse[$i]['w_handout']."'>����</a>";
	?>
	  </span>    </td>
    <td width="18%">
	  <span class="table">
	  <?php  
	if(strtotime($arr_sourse[$i]['w_time'])<time())	//����Ѿ���ֹ�ύ��ҵ
		echo "<a href='../".$arr_sourse[$i]['w_answer']."'>��</a>";
	else
		echo "��";
	?>
	  </span>    </td>
  </tr>
  <?php }?>
</table>
</div>
<div class="bottom">
<table border="0" width="100%">
<tr>
  <td height="27" align="right" > Sunking's CAI System-2017<br />
    ��ƿ�����Sunkinglsx<br />
    ��ӭ������������ɨ���ұ�΢�Ŷ�ά��</td> 
    <td width="94" align="right"><img src="../pics/wx.jpg" width="90" height="75" /></td>
  </tr>
</table></div>
</body>
</html>