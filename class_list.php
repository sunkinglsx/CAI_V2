<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title></title>
<style type="text/css">
#tlist {
	border: 1px solid #E7E7E7;
	text-align: justify;
}
#banner {
	font-size: 12px;
	text-decoration: none;
}
a:link {
	font-size: 14px;
	line-height: 25px;
	color: #333;
	text-decoration: none;
	background-color: #F0F0F0;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	border: 1px solid #333;
	text-align: justify;
}
a:visited {
	font-size: 14px;
	line-height: 25px;
	color: #333;
	text-decoration: none;
	background-color: #F0F0F0;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	text-align: justify;
}
a:hover {
	font-size: 14px;
	line-height: 25px;
	color: #C63;
	text-decoration: none;
	background-color: #FFFFC1;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	border: 1px solid #C60;
	text-align: justify;
}
a.red:link {
	font-size: 14px;
	line-height: 25px;
	color: #333;
	text-decoration: none;
	background-color: #FF0000;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	border: 1px solid #333;
	text-align: justify;
}
a.red:visited {
	font-size: 14px;
	line-height: 25px;
	color: #333;
	text-decoration: none;
	background-color: #FF0000;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	text-align: justify;
}
a.red:hover {
	font-size: 14px;
	line-height: 25px;
	color: #C63;
	text-decoration: none;
	background-color: #FFFFC1;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	border: 1px solid #C60;
	text-align: justify;
}
a.green:link {
	font-size: 14px;
	line-height: 25px;
	color: #333;
	text-decoration: none;
	background-color: #33CC00;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	border: 1px solid #333;
	text-align: justify;
}
a.green:visited {
	font-size: 14px;
	line-height: 25px;
	color: #333;
	text-decoration: none;
	background-color: #33CC00;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	text-align: justify;
}
a.green:hover {
	font-size: 14px;
	line-height: 25px;
	color: #C63;
	text-decoration: none;
	background-color: #FFFFC1;
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	border: 1px solid #C60;
	text-align: justify;
}
</style>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
</head>

<body>
<?php
		require("db_connect.php");
		mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
		require("session.php");
		check_asession();
		require("url_deal.php");
		$furl=url_deal($_GET['furl']);		//处理url
		$title="";
		switch($furl)		//根据furl的值，决定链接的目标
		{
			case 1:
				$url="a_add_course.php";	//添加科目课程
				$title="添加课程科目";
				break;
			case 2:
				$url="a_modify_course.php";	//编辑科目课程
				$title="管理课程科目";
				break;
			case 3:
				$url="a_new_homework.php";	//添加新作业
				$title="发布学生作业";
				break;
			case 4:
				$url="a_manager_homework.php";	//管理学生作业
				$title="管理学生作业";
				break;
			case 5:
				$url="a_stu_homework.php";	//批阅学生作业
				$title="批阅学生作业";
				break;
			case 6:
				$url="a_student_list.php";	//导出学生成绩
				$title="管理学生名单";
			case 7:
				$url="a_student_titles.php";	//学生选题列表
				$title="学生选题列表";
		}

?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="banner">
  <tr>
    <td height="26" valign="middle" bgcolor="#FFFFCC">后台管理》<?php echo $title;?></td>
  </tr>
</table>
<table width="100%" height="259" border="0" align="center" cellpadding="0" cellspacing="0" id="tlist2">
  <tr>
    <td width="608" height="36" align="center" bgcolor="#DEFEB4">请选择要操作的班级或课程</td>
  </tr>
  <tr>
    <td height="3" align="center" bgcolor="#A3A3A3"></td>
  </tr>
  <tr>
    <td height="220" align="center" valign="top" bgcolor="#FAFAFA">
    <?php
		//查出全部班级
		$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_enable=1 order by c_name";
		$rs_class=mysql_query($sqls,$conn);
		if($furl!=6)
		{
	?>
    <div id="Accordion1" class="Accordion" tabindex="0">
    <?php
		if(!$rs_class)
			echo "<font color='#CC0000'>你还没有添加任何任课班级</font>";
		else
		{
			$class_rows=mysql_num_rows($rs_class);
			for($i=0;$i<$class_rows;$i++)
			{
				$arr_class=mysql_fetch_array($rs_class);
				//下面生成班级列表
	?>
      <div class="AccordionPanel">
        <div class="AccordionPanelTab">	<?php echo" [ ".$arr_class['c_name']." ] ";	?> </div>
       <div class="AccordionPanelContent">
        <?php 
					//查出并生成每个班级该 老师的课程列表
					$sqls="select * from course where cou_teacher='".$_SESSION['a_name']."' and class_id='".$arr_class['c_id']."'";
					$rs_course=mysql_query($sqls,$conn);
					if(!$rs_course||mysql_num_rows($rs_course)==0)
					{
							echo "<p><font color='#CC0000'>该班还没有添加课程科目</font></p>"; 
							echo "<p><a href=a_add_course.php?cid=".$arr_class['c_id'].">立即添加课程科目</a></p>";
					}
					else
					{
						$course_rows=mysql_num_rows($rs_course);
							for($j=0;$j<$course_rows;$j++)
							{
								$arr_course=mysql_fetch_array($rs_course);
								echo "<pre><p><a href=".$url."?cid=".$arr_class['c_id']."&couid=".$arr_course['cou_id']."&cname=".$arr_course['cou_name'].">‖";
								printf("%30s",$arr_course['cou_name']);
								echo "</a>";
								if($furl==2){
								if($arr_course['cou_enable']==1)
									echo "<a href='course_enable.php?o=0&couid=".$arr_course['cou_id']."' class='green'>关闭课程</a></p>";
								else
									echo "<a href='course_enable.php?o=1&couid=".$arr_course['cou_id']."' class='red'>开启课程</a></p>";
                             }}
							 echo "<p><a href=a_add_course.php?cid=".$arr_class['c_id'].">继续添加课程科目</a></p></pre>";
					}
			?>
				 </div>	
      </div>
      <?php  }}?>
    </div>
    <?php 
	}
	else	//如果是6，为学生管理列表，只需列出班级名称
	{
		if(!$rs_class)
			echo "<font color='#CC0000'>你还没有添加任何任课班级</font>";
		else
		{
			$class_rows=mysql_num_rows($rs_class);
			for($i=0;$i<$class_rows;$i++)
			{
				$arr_class=mysql_fetch_array($rs_class);
				//下面生成班级列表
				echo "<pre><p><a href='a_student_list.php?cid=".$arr_class['c_id']."'>‖";
				printf("%30s",$arr_class['c_name']);
				echo "</a></p></pre>";
			}
		}
	}
	?>
    </td>
  </tr>
</table>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
</html>