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
#list1 a:link {
	font-size: 13px;
	color: #393;
	text-decoration: none;
	background-color: #FFFFDF;
	padding-top: 1px;
	padding-right: 20px;
	padding-bottom: 1px;
	padding-left: 20px;
	border: 1px solid #6C6;
}
#list1 a:visited {
	font-size: 13px;
	color: #393;
	text-decoration: none;
	background-color: #FFFFDF;
	padding-top: 1px;
	padding-right: 20px;
	padding-bottom: 1px;
	padding-left: 20px;
	border: 1px solid #6C6;
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
	margin-top:10px;
}
.home{
		width:23px;
		height:21px;
		top:15px;
		left:260px;
		position:absolute;
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
?>
<div id="banner">
	<div  class="home"><a href="s_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['s_name']."��".$_SESSION['s_id'];?></a></div>
  <div class="pray">
	<?php 
		if(date("H",time())>=0&&date("H")<12)
			$noon="ʢ�겻����,һ�����ٳ�.��ʱ������,���²�����";
		elseif(date("H",time())>=12&&date("H")<=14)
			$noon="Ī�ж�ͯ������,����������ͬ��";
		elseif(date("H",time())>14&&date("H")<=18)
			$noon="��ѧ���Թ�ţ���־���Գ�ѧ";
		else
			$noon="־ʿϧ�ն̣�����Թҹ��";
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
    <td height="2" colspan="3" align="center" bgcolor="#E3E2F5"></td>
    </tr>
  <?php for($i=0;$i<mysql_num_rows($rs_cou);$i++)
  {
	  	$arr_cou=mysql_fetch_array($rs_cou);  
		$sql_teacher="select  t_name  from ad_user where a_name='".$arr_cou['cou_teacher']."'";	//���ÿ�ſγ̵��ο���ʦ
		$rs_teacher=mysql_query($sql_teacher,$conn);	//��ʦ�б�
		if($rs_teacher)	
		{
				$teacher=mysql_fetch_array($rs_teacher);
		}
  ?>
  <tr>
    <td width="24%" rowspan="3" align="center"><img src="../pics/book.png" width="64" height="53" /></td>
    <td height="25" colspan="2" align="left">�γ����ƣ�<?php echo $arr_cou['cou_name'];?></td>
    </tr>
  <tr>
    <td width="40%" height="25" align="left">��ϰʱ�䣺<?php echo "��".$term."ѧ��";?></td>
    <td width="36%" align="center">������ʦ��<?php echo $teacher['t_name'];?></td>
  </tr>
  <tr>
    <td height="30" align="center"><a href="homework_list.php?cid=<?php echo $arr_cou['cou_id'];?>&cname=<?php echo $arr_cou['cou_name'];?>">�鿴��ҵ</a></td>
    <td align="center"><a href="source_list.php?cid=<?php echo $arr_cou['cou_id'];?>&cname=<?php echo $arr_cou['cou_name'];?>">�γ���Դ</a></td>
  </tr>
  <tr>
    <td height="1" colspan="3" align="center" bgcolor="#E3E2F5"></td>
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