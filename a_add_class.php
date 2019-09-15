<style type="text/css">
#tmain {
	font-size: 12px;
	color: #333;
	text-decoration: none;
	background-color: #F1F1F1;
}
.txt_box {
	height: 20px;
	width: 220px;
}
</style>
<script language="javascript">
	function check_form()
	{
		var cid=document.getElementById("cid").value;
		var cname=document.getElementById("cname").value;
		var reg=/[a-zA-Z][1-2]\d[cC]\d\d/;
		if(cid.value=="")
		{
			alert("班级编号为必填内容！");
			document.getElementById("cid").focus();
			return false;
		}
		if(!reg.exec(cid))
		{
			alert("班级编号不合法，请重新填写");
			document.getElementById("cid").focus();
			return false;
		}
		if(cname=="")
		{
			alert("请填写班级名称");
			document.getElementById("cname").focus();
			return false;
		}
	}
</script>
<body>
<?php 
	require("session.php");
	check_asession();
	include("db_connect.php");	//数据库
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	//define('ROOT',$_SERVER['DOCUMENT_ROOT']);
	require('PHPExcel/PHPExcel.php');
	require_once('PHPExcel/PHPExcel/IOFactory.php');
	require_once('PHPExcel/PHPExcel/Reader/Excel2007.php');
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="830" height="272" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="3" bgcolor="#FFFFCC">管理首页》添加任课班级</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="98" height="40" align="center">当前任课班级：</td>
      <td colspan="2">
      <?php
	  		$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_enable=1 order by c_name";
			$rs=mysql_query($sqls,$conn);
			if($rs)
			{
				$crows=mysql_num_rows($rs);
				if($crows==0)
				{
					echo "暂无任课班级";
				}
				else
				{
					for($i=0;$i<$crows;$i++)
					{
						$arr_c=mysql_fetch_array($rs);
						echo "<font color='#006600'>■".$arr_c['c_name']."(".$arr_c['c_id'].")</font>&nbsp;&nbsp;";
					}
				}
			}
			else
			{
				echo "暂无任课班级";
			}
	  ?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center">曾经任课班级：</td>
      <td colspan="2">
      <?php
	  		$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_enable=0 order by c_name";
			$rs=mysql_query($sqls,$conn);
			if($rs)
			{
				$crows=mysql_num_rows($rs);
				if($crows==0)
				{
					echo "暂无任课班级";
				}
				else
				{
					for($i=0;$i<$crows;$i++)
					{
						$arr_c=mysql_fetch_array($rs);
						echo "<font color='#ff0000'>◆".$arr_c['c_name']."(".$arr_c['c_id'].")</font>&nbsp;&nbsp;";
					}
				}
			}
			else
			{
				echo "暂无任课班级";
			}
	  ?>
      </td>
    </tr>
    <tr>
      <td height="24" colspan="3" bgcolor="#F1F1F1">新增任课班级：
      <label for="cname"></label></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">新增班级编号：</td>
      <td colspan="2" bgcolor="#FFFFFF"><label for="cid"></label>
      <input name="cid" type="text" class="txt_box" id="cid" /> 
      *重修班级的编号请用R-C1601或R-Z1601格式</td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">新增班级名称：</td>
      <td colspan="2" bgcolor="#FFFFFF"><input name="cname" type="text" class="txt_box" id="cname" /> </td>
    </tr>
    <tr>
      <td height="31" align="center" bgcolor="#FFFFFF">导入班级名单：</td>
      <td width="353" bgcolor="#FFFFFF"><label for="cstu"></label>
      <input name="cstu" type="file" class="txt_box" id="cstu"></td>
      <td width="375" bgcolor="#FFFFFF"><font color="#990000">只支持.xlsx格式，请<a href="students/students.xlsx">下载空表</a>添加名单后上传（首行信息不要更改）</font></td>
    </tr>
    <tr>
      <td height="34" colspan="3" align="center"><input type="submit" name="button" id="button" value="保存班级" onClick="check_form()"></td>
    </tr>
  </table>
</form>
<?php
	if(isset($_POST['button']))		//提交事件
	{
		$tmp_file=$_FILES['cstu']['name'];
		$is_ok=4;
		if($tmp_file=="")
		{
			echo "<script language='javascript'>;
			alert('请上传该班的学生名单');
			</script>";
			$is_ok-=1;
			exit;
		}
		else
		{
			//导入名单
				$sid="";	//学号
				$sname="";	//姓名
				$spass=md5("123456");	//初始密码
				$sclass=strtoupper($_POST['cid']);	//班级编号
				$cname=$_POST['cname'];//班级名称
				
				//检查该老师名下的班级号是否已存在
			$sql="select * from class where c_teacher='".$_SESSION['a_name']."' and c_id='".$sclass."'";
			$rs=mysql_query($sql,$conn);
			if(mysql_num_rows($rs)>0)
			{
					$is_ok-=1;
					echo "<script language='javascript'>;
					alert('该班级号已经存在');
					</script>";
					exit;
			}
	//只要学生名单列表中，存在该班级，就不再导入新的学生名单文件
	$sql="select * from students where s_class='".$sclass."'";
	$rs=mysql_query($sql,$conn);
	if(!$rs||mysql_num_rows($rs)<=0)
	{
				$excelpath="students/".$_POST['cid'].".xlsx";		//用班级名命名
				if(move_uploaded_file($_FILES['cstu']['tmp_name'],$excelpath))	//上传文件
				{
					$objReader = PHPExcel_IOFactory::createReader('excel2007'); //use Excel5 for 2003 format 
					$objPHPExcel = $objReader->load($excelpath); 
					$sheet = $objPHPExcel->getSheet(0); 
					$highestRow = $sheet->getHighestRow();           //取得总行数 
					$highestColumn = $sheet->getHighestColumn(); //取得总列数
					for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据
					{ 
						$sid=$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();//读取学号单元格
						$sname=$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue();//读取姓名单元格
						$sid=mb_convert_encoding($sid,'UTF8','auto');//根据自己编码修改
						$sname=mb_convert_encoding($sname,'utf8','auto');//根据自己编码修改
						if(substr($sclass,0,2)!="R-")	//重修班级不须添加学生到基本信息表
						{
							$sql = "insert into students (s_id,s_name,s_pass,s_class) values ('{$sid}','{$sname}','{$spass}','{$sclass}')";
							$status1=mysql_query($sql,$conn);
						}
						else
							$status1=true;
						$sql2="insert into class_student(sid,cid) values('{$sid}','{$sclass}')";
						$status2=mysql_query($sql2,$conn);
						if(!$status1 || !$status2)
						{
						   echo 'excel导入出错！';
						   $is_ok-=1;
						}
					}
				}
				else
				{
					echo "<script language='javascript'>;
					alert('班级名单文件上传失败！');
					location.href='a_add_class.php';
					</script>";
				}
		}
				//名单全部导入数据库后，将班级名称添加到班级库
				mysql_query("SET NAMES 'gbk'");	//与数据库一致
				$sql="insert into class (c_id,c_name,c_teacher,c_enable) values ('{$sclass}','{$cname}','{$_SESSION['a_name']}',1)";
				if(!mysql_query($sql,$conn))
				{
				   echo '班级添加失败！';
				  $is_ok-=1;
				  	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
				}
	
			if($is_ok==4)
			{
				echo "<script language='javascript'>;
				alert('一条班级添加成功！');
				location.href='a_add_class.php';
				</script>";
			}
			else
			{
				echo "<script language='javascript'>;
				alert('班级信息添加失败！');
				location.href='a_add_class.php';
				</script>";
			}
		}
	}
?>
</body>