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
	font-size: 13px;
	color: #666;
	padding: 1px;
}
#list1 a:link {
	font-size: 12px;
	color: #69C;
	text-decoration: none;
	padding-left:10px;
	padding-right:10px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px  solid #999;
	background-color:#FFC;
}
#list1 a:visited {
	font-size: 12px;
	color: #69C;
	text-decoration: none;
	padding-left: 10px;
	padding-right: 10px;
	padding-top: 2px;
	padding-bottom: 2px;
	border: 1px solid #999;
	background-color: #FFC;
}
.list{
	margin-top:3px;
	visibility:visible;
	text-align:center;
}
.bottom{
	width:100%;
	background-color:#9398F9;
	color:#FFF;
	font-size:13px;
	margin-top:5px;
}
.info{
	font-size:13px;
	color:#FFF;
	width:100%;
	background-color:#63C;
	height:20px;
	line-height:20px;
	display:block;
}
.txt_box {height: 20px;
	width: 95%;
}
#tmain {font-size: 12px;
	color: #333;
	text-decoration: none;
	background-color: #F1F1F1;
}
#button {
	font-size: 14px;
	color: #FFF;
	text-decoration: none;
	background-color: #0C0;
	height: 30px;
	width: 300px;
	border: 1px solid #0C3;
}
.t_list1 {	font-size: 13px;
	color: #666;
	padding: 1px;
}
</style>
</head>

<body >
<?php require('../session.php');
			check_asession();
			require('../db_connect.php');
			mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
			require('../url_deal.php');
			$wid=url_deal($_GET['wid']);	//��ҵ���
			$wname=url_deal($_GET['wname']);	//��ҵ����
			$id=url_deal($_GET['id']);	//ѧ����ҵ���
			$sqls="select * from stu_works where id=".$id;
			$rs=mysql_query($sqls,$conn);
			$stu_home=mysql_fetch_array($rs);
?>
<div id="banner">
	<div  class="home"><a href="t_index.php"><img src="../pics/home.png" width="23" height="21" border="0"/></a></div>
	<div  class="logout"><a href="login_out.php"><img src="../pics/loginout.png" width="31" height="23" border="0"/></a></div>
  <div class="user"><a href="modify_info.php"><?php echo $_SESSION['t_name']."��ʦ";?></a></div>
  <div class="pray">
	<?php 
			$noon="������־��������Զ";
		echo $noon;
	?></div>
</div>
<div class="icon_list">
    <div class="icon"><a href="t_list.php"><img src="../pics/course.jpg" width="51" height="53"  border="0"/></a></div>
    <dd class="icon"><a href="t_list.php"><img src="../pics/homeworks.jpg" width="51" height="53"   border="0"/></a></dd>
    <dd class="icon"><a href="t_list.php"><img src="../pics/students.jpg" width="57" height="53"   border="0"/></a></dd>
</div>
<div class="icon_list">
    <div class="icon_text">�γ̹���</div>
    <div class="icon_text">��ҵ����</div>
    <div class="icon_text">ѧ������</div>
</div>
<div id="list1" class="list">	<!--�����б�-->
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="t_list">
  <tr>
    <td height="30"   align="right" valign="middle"  >
    <span style="font-size:13px; color:#C30; float:left">������ҵ->><?php echo $wname;?>-->><?php echo $stu_home['s_id'];?></span>
    </td>
    </tr>
 </table>
 <form action="t_stu_work_jude.php" method="post" name="form1" id="form1">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="t_list">
  <tr >
    <td width="30%" height="25" align="center" valign="middle" bgcolor="#E3E2F5" >�ύʱ�䣺</td>
    <td width="70%" align="left" bgcolor="#E3E2F5"  ><?php echo $stu_home['s_time'];?>
      <input name="id" type="hidden" id="id" value="<?php echo $id;?>" />
      <input name="wid" type="hidden" id="wid" value="<?php echo $wid;?>" />
      <input name="wname" type="hidden" id="wname" value="<?php echo $wname;?>" /></td>
  </tr>
  <tr >
    <td width="30%" height="25" align="center" valign="middle" bgcolor="#FFFFFF">�ύ��ַ��</td>
    <td width="70%" align="left" bgcolor="#FFFFFF"><?php echo $stu_home['s_ip'];?></td>
  </tr>
  <tr >
    <td width="30%" height="25" align="center" bgcolor="#E3E2F5">��ҵ�ļ���</td>
    <td width="70%" align="left" bgcolor="#E3E2F5" >
      <?php 
		$arr=explode(".",$stu_home['s_file']);	//������ҵ �ļ��ĺ�׺��
		$ext=$arr[1];
		echo "�ļ����ͣ�".$ext."&nbsp;";
	?>
    <a href="<?php echo "../".$stu_home['s_file'];?>">���ز鿴</a>
</td>
  </tr>
  <tr >
    <td width="30%" height="25" align="center" bgcolor="#FFFFFF" >��ҵ���ԣ�</td>
    <td width="70%" height="25" align="left" bgcolor="#FFFFFF"  >&nbsp; </td>
  </tr>
  <tr >
    <td height="25" colspan="2" align="left" bgcolor="#FFFFCC">
      <?php echo $stu_home['s_note'];?>
    </td>
    </tr>
  <tr >
    <td height="25" align="center" >��ҵ���֣�</td>
    <td height="25" align="left" > 
      <label>
        <input type="radio" name="score" value="95" id="score_0" />
        ��</label>
      <label>
        <input type="radio" name="score" value="85" id="score_1" />
        ��</label>
      <label>
        <input name="score" type="radio" id="score_2" value="70" checked="checked" />
        ��</label>
      <label>
        <input type="radio" name="score" value="50" id="score_3" />
        ��</label>
     </td>
    </tr>
  <tr >
    <td height="40" colspan="2" align="center" bgcolor="#E3E2F5" ><input type="submit" name="button" id="button" value="�ύ��������" /></td>
    </tr>
 </table>
 </form>
</div>
<div class="bottom">
<table border="0" width="100%">
<tr>
  <td height="27" align="right" > Sunking's CAI System-2017<br />
    ��ƿ�����Sunkinglsx<br />
    ��ӭ������������ɨ���ұ�΢�Ŷ�ά��</td> 
    <td width="94" align="right"><img src="../pics/wx.jpg" width="90" height="75" /></td>
  </tr>
</table>
</body>
</html>