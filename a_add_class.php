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
			alert("�༶���Ϊ�������ݣ�");
			document.getElementById("cid").focus();
			return false;
		}
		if(!reg.exec(cid))
		{
			alert("�༶��Ų��Ϸ�����������д");
			document.getElementById("cid").focus();
			return false;
		}
		if(cname=="")
		{
			alert("����д�༶����");
			document.getElementById("cname").focus();
			return false;
		}
	}
</script>
<body>
<?php 
	require("session.php");
	check_asession();
	include("db_connect.php");	//���ݿ�
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	//define('ROOT',$_SERVER['DOCUMENT_ROOT']);
	require('PHPExcel/PHPExcel.php');
	require_once('PHPExcel/PHPExcel/IOFactory.php');
	require_once('PHPExcel/PHPExcel/Reader/Excel2007.php');
?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="830" height="272" border="0" align="center" cellpadding="0" cellspacing="1" id="tmain">
    <tr>
      <td height="28" colspan="3" bgcolor="#FFFFCC">������ҳ������οΰ༶</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="98" height="40" align="center">��ǰ�οΰ༶��</td>
      <td colspan="2">
      <?php
	  		$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_enable=1 order by c_name";
			$rs=mysql_query($sqls,$conn);
			if($rs)
			{
				$crows=mysql_num_rows($rs);
				if($crows==0)
				{
					echo "�����οΰ༶";
				}
				else
				{
					for($i=0;$i<$crows;$i++)
					{
						$arr_c=mysql_fetch_array($rs);
						echo "<font color='#006600'>��".$arr_c['c_name']."(".$arr_c['c_id'].")</font>&nbsp;&nbsp;";
					}
				}
			}
			else
			{
				echo "�����οΰ༶";
			}
	  ?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="36" align="center">�����οΰ༶��</td>
      <td colspan="2">
      <?php
	  		$sqls="select * from class where c_teacher='".$_SESSION['a_name']."' and c_enable=0 order by c_name";
			$rs=mysql_query($sqls,$conn);
			if($rs)
			{
				$crows=mysql_num_rows($rs);
				if($crows==0)
				{
					echo "�����οΰ༶";
				}
				else
				{
					for($i=0;$i<$crows;$i++)
					{
						$arr_c=mysql_fetch_array($rs);
						echo "<font color='#ff0000'>��".$arr_c['c_name']."(".$arr_c['c_id'].")</font>&nbsp;&nbsp;";
					}
				}
			}
			else
			{
				echo "�����οΰ༶";
			}
	  ?>
      </td>
    </tr>
    <tr>
      <td height="24" colspan="3" bgcolor="#F1F1F1">�����οΰ༶��
      <label for="cname"></label></td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">�����༶��ţ�</td>
      <td colspan="2" bgcolor="#FFFFFF"><label for="cid"></label>
      <input name="cid" type="text" class="txt_box" id="cid" /> 
      *���ް༶�ı������R-C1601��R-Z1601��ʽ</td>
    </tr>
    <tr>
      <td height="35" align="center" bgcolor="#FFFFFF">�����༶���ƣ�</td>
      <td colspan="2" bgcolor="#FFFFFF"><input name="cname" type="text" class="txt_box" id="cname" /> </td>
    </tr>
    <tr>
      <td height="31" align="center" bgcolor="#FFFFFF">����༶������</td>
      <td width="353" bgcolor="#FFFFFF"><label for="cstu"></label>
      <input name="cstu" type="file" class="txt_box" id="cstu"></td>
      <td width="375" bgcolor="#FFFFFF"><font color="#990000">ֻ֧��.xlsx��ʽ����<a href="students/students.xlsx">���ؿձ�</a>����������ϴ���������Ϣ��Ҫ���ģ�</font></td>
    </tr>
    <tr>
      <td height="34" colspan="3" align="center"><input type="submit" name="button" id="button" value="����༶" onClick="check_form()"></td>
    </tr>
  </table>
</form>
<?php
	if(isset($_POST['button']))		//�ύ�¼�
	{
		$tmp_file=$_FILES['cstu']['name'];
		$is_ok=4;
		if($tmp_file=="")
		{
			echo "<script language='javascript'>;
			alert('���ϴ��ð��ѧ������');
			</script>";
			$is_ok-=1;
			exit;
		}
		else
		{
			//��������
				$sid="";	//ѧ��
				$sname="";	//����
				$spass=md5("123456");	//��ʼ����
				$sclass=strtoupper($_POST['cid']);	//�༶���
				$cname=$_POST['cname'];//�༶����
				
				//������ʦ���µİ༶���Ƿ��Ѵ���
			$sql="select * from class where c_teacher='".$_SESSION['a_name']."' and c_id='".$sclass."'";
			$rs=mysql_query($sql,$conn);
			if(mysql_num_rows($rs)>0)
			{
					$is_ok-=1;
					echo "<script language='javascript'>;
					alert('�ð༶���Ѿ�����');
					</script>";
					exit;
			}
	//ֻҪѧ�������б��У����ڸð༶���Ͳ��ٵ����µ�ѧ�������ļ�
	$sql="select * from students where s_class='".$sclass."'";
	$rs=mysql_query($sql,$conn);
	if(!$rs||mysql_num_rows($rs)<=0)
	{
				$excelpath="students/".$_POST['cid'].".xlsx";		//�ð༶������
				if(move_uploaded_file($_FILES['cstu']['tmp_name'],$excelpath))	//�ϴ��ļ�
				{
					$objReader = PHPExcel_IOFactory::createReader('excel2007'); //use Excel5 for 2003 format 
					$objPHPExcel = $objReader->load($excelpath); 
					$sheet = $objPHPExcel->getSheet(0); 
					$highestRow = $sheet->getHighestRow();           //ȡ�������� 
					$highestColumn = $sheet->getHighestColumn(); //ȡ��������
					for($j=2;$j<=$highestRow;$j++)                        //�ӵڶ��п�ʼ��ȡ����
					{ 
						$sid=$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();//��ȡѧ�ŵ�Ԫ��
						$sname=$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue();//��ȡ������Ԫ��
						$sid=mb_convert_encoding($sid,'UTF8','auto');//�����Լ������޸�
						$sname=mb_convert_encoding($sname,'utf8','auto');//�����Լ������޸�
						if(substr($sclass,0,2)!="R-")	//���ް༶�������ѧ����������Ϣ��
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
						   echo 'excel�������';
						   $is_ok-=1;
						}
					}
				}
				else
				{
					echo "<script language='javascript'>;
					alert('�༶�����ļ��ϴ�ʧ�ܣ�');
					location.href='a_add_class.php';
					</script>";
				}
		}
				//����ȫ���������ݿ�󣬽��༶������ӵ��༶��
				mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
				$sql="insert into class (c_id,c_name,c_teacher,c_enable) values ('{$sclass}','{$cname}','{$_SESSION['a_name']}',1)";
				if(!mysql_query($sql,$conn))
				{
				   echo '�༶���ʧ�ܣ�';
				  $is_ok-=1;
				  	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
				}
	
			if($is_ok==4)
			{
				echo "<script language='javascript'>;
				alert('һ���༶��ӳɹ���');
				location.href='a_add_class.php';
				</script>";
			}
			else
			{
				echo "<script language='javascript'>;
				alert('�༶��Ϣ���ʧ�ܣ�');
				location.href='a_add_class.php';
				</script>";
			}
		}
	}
?>
</body>