<style type="text/css">
.check {
	height: 120px;
	width: 550px;
	margin-right: auto;
	margin-left: auto;
	font-size: 16px;
	margin-top:100px;
	color: #03C;
	text-decoration: none;
	-webkit-box-shadow: 0px 0px 5px #999;
	box-shadow: 0px 0px 5px #999;
	padding-top: 5px;
	padding-right: 15px;
	padding-bottom: 5px;
	padding-left: 15px;
}
.anniu{
	margin-top:20px;
	margin-left:450px;
}
a:link {
	font-size: 16px;
	line-height: 25px;
	color: #FFF;
	background-color: #33C;
	padding-top: 5px;
	padding-right: 30px;
	padding-bottom: 5px;
	padding-left: 30px;
	border: 1px solid #33C;
	text-decoration: none;
}
a:visited {
	font-size: 16px;
	line-height: 25px;
	color: #FFF;
	background-color: #33C;
	padding-top: 5px;
	padding-right: 30px;
	padding-bottom: 5px;
	padding-left: 30px;
	border: 1px solid #33C;
	text-decoration: none;
}
a:hover {
	font-size: 16px;
	line-height: 25px;
	color: #FFF;
	background-color: #33F;
	padding-top: 5px;
	padding-right: 30px;
	padding-bottom: 5px;
	padding-left: 30px;
	border: 1px solid #33C;
	text-decoration: none;
}
</style>
<div id="checks" class="check"><img src="images/checking.gif" width="500" height="61" /></div>
<?php
/*��ҵ���غ���
	1���Ƚ�ÿ��ѧ���ύ����ҵ�ļ��򿪣�ȥ�����У��ټ���ļ���������
	2��ͳ���ļ�������N�����ļ���Ϊ5�Σ���ʼ�����ֱ���s=1+int(N/5)*(i-1)��iΪ�ֶκ�
	3�����int(N/5)>=3ÿһ�ζ�ȡ s-s+3�У����򣬶�ȡs-s+int(N/5)
	3��ȥ�����δ����ж���Ŀո�replace)
	4�����δ���������ݿ�����Ӧ���ֶ�
	5��ʹ��ģ����ѯ���ֱ�Ը��δ���������ݿ��ѯ��ƥ����ͬ��ҵ�Ų�ѯ��
	6�������õ���������½���е�ѧ�ţ��Կո�Ϊ��ʶ������ѯ�뱻��ѯ������ָ�Ϊ����
	7�������������е�Ԫ�أ����ƥ�䣬������ͬ�ʡ�
	8�������ͬ��>90%��������ͬ�߶���Ϊ���ϸ��Զ����������ݱ����������
*/
session_start();
require("db_connect.php");
	//$wfile=$path;
	if(isset($_GET['sid']))
		$sid=$_GET['sid'];
	else
		{echo "����ȱʧ��������ֹ����";
		exit;}
	if(isset($_GET['wid']))
		$wid=$_GET['wid'];
	else
		{echo "����ȱʧ��������ֹ����";
		exit;}
	$sqls="select s_file from stu_works where s_id='{$sid}' and w_id='{$wid}'";
	$rs=mysql_query($sqls,$conn);
	$arr=mysql_fetch_array($rs);
	$wfile=$arr['s_file'];		//�ļ�·��
	mysql_free_result($rs);
	unset($arr);
	duplicate_check($sid,$wid,$wfile,$conn,10);		//���ݸս���ҵ�ߵ���Ϣ������
	function duplicate_check($sid,$wid,$wfile,$conn,$depart)
	{
		//�Ƚ��ļ��пհ��ж�ȥ��
				$fid=fopen($wfile,"r");
		$tmp="";
		$rows=0;
		while(!feof($fid))
		{
			$str=fgets($fid);
			if($str=="\r\n"||$str=="\r"||$str=="\n")	//ȥ������
			{
				$str="";
			}
			else
			{
				$rows+=1;
				$tmp.=$str;	
			}
		}
		fclose($fid);
		file_put_contents($wfile,$tmp);//����д��ԭ�ļ�
		unset($tmp);//�ͷ��ڴ�
		$f_toBeCheck=fopen($wfile,"r");	//ֻ��ģʽ��
		if($rows<10)
			$depart=$rows;	//С��10�У����зֶ�		
		$block=(int)($rows/$depart);	//��Ϊdepart��,ÿ�εĴ�СΪblock
		$f_str=array("","","","","","","","","","");	//ÿ���ļ��������ַ���
		$current_row=0;//��ǰ�к�
		for($i=0;$i<$depart;$i++)		//�ֱ��ȡÿ���ļ��Ĵ�������
		{
			if($block<=3)		//ÿһ��С��3�У���ȡȫ��
			{
				for($j=0;$j<$block;$j++)
					$f_str[$i].=fgets($f_toBeCheck);
			}
			else		//����3�У�ֻ��3��
			{
				$j=1;	//�Ѷ�����
				while(!feof($f_toBeCheck))		//ÿ�δ���5�У�ֻ�����ж�ȡ5 �У���������Ҫ����
				{
					if($j<=5)
					{
						$f_str[$i].=fgets($f_toBeCheck);
						$j+=1;     //2
						$current_row+=1;   //1
					}
					else{
					if($current_row==$block*($i+1))			//ÿһ�εĵ�һ��
						break;
					else
					{
						$tmp=fgets($f_toBeCheck);
						$current_row+=1;
					}}
				}
			}
		}//$iѭ������
		fclose($f_toBeCheck);	//�ر��ļ�
		unset($tmp);
		//ȥ�������еĿո�
		//��ÿһ�εı����ΪGBK
		//���浽���ݿ���
		for($i=0;$i<$depart;$i++)
		{
			$f_str[$i]=trim($f_str[$i]);	//ȥ�����߿ո�
			$f_str[$i]=str_replace(" ","",$f_str[$i]);	//ȥ���м�ո�
			$f_str[$i]=str_replace("'","",$f_str[$i]);	//ȥ��������
			$f_str[$i]=str_replace("\"","",$f_str[$i]);	//ȥ��˫����
			//�ı��ļ����ݵı����ʽΪgbk
			$fileType = mb_detect_encoding($f_str[$i],array('UTF-8','GBK','ASCII','BIG5'));
			if( $fileType != 'GBK')
				{ $f_str[$i]= mb_convert_encoding($f_str[$i] ,'GBK' , $fileType);}
		}
		//���δ���д�����ݿ�
		$cdate=date("Y-m-d h:i:s",time());
		$sqls="insert into duplicate_check(sid,wid,cdate,code1,code2,code3,code4,code5,code6,code7,code8,code9,code10)
					values
					('{$sid}',{$wid},'{$cdate}','{$f_str[0]}','{$f_str[1]}','{$f_str[2]}','{$f_str[3]}','{$f_str[4]}','{$f_str[5]}','{$f_str[6]}','{$f_str[7]}','{$f_str[8]}','{$f_str[9]}')";
		$rs=mysql_query($sqls,$conn);
		//д��ɹ�����أ�д��ʧ�ܣ���ʾʧ��
		if($rs)
		{
			//��β���
			$same_percent=0;	//��ͬ��
			//��ͬ�ߵĶ�ά����$samer_sid��$samer[sid]��ʽ��ֵΪ������
			//ÿ��1���뽻��ҵ�ߵ���ͬ����sid�ߵ�contֵ+1
			$samer_sid=array();	
			for($i=0;$i<$depart;$i++)
			{
				$sqls_cc="select sid,wid from duplicate_check where code".($i+1)."='{$f_str[$i]}' and wid=$wid and sid<>'{$sid}'";
				$rs_cc=mysql_query($sqls_cc);
				if($rs_cc && mysql_num_rows($rs_cc)>0)	//��������ͬ�Ĵ���
				{
					$same_percent+=10;		//ÿ��ͬһ�Σ���ͬ������10%
					$update_self="update duplicate_check set repeation={$same_percent} ,cdate='{$cdate}' where sid='{$sid}' and wid=$wid";
					$rs_update=mysql_query($update_self,$conn);	//�ȸ��±������ߵ��ظ���
					$same_rows=mysql_num_rows($rs_cc);		//��ͬ������
					for($r=0;$r<$same_rows;$r++)		//����ȫ������ͬ�����ѧ������ͬ��
					{
							$arr_same=mysql_fetch_array($rs_cc);	
							if(array_key_exists($arr_same['sid'],$samer_sid))	//������ͬ���������ҵ���Ӧ�ļ�����˵��֮ǰ�Ѿ�����ͬ�����
							{
								$samer_sid[$arr_same['sid']]+=1;
							}
							else
								$samer_sid[$arr_same['sid']]=1;
					}//for����
					mysql_free_result($rs_cc);	//�ͷż�¼��
				}//��ͬif�жϽ���
			}//�ֶ�ѭ�����ؽ���
			if($same_percent>=90)	//90%������ͬ����Ϊ0��,ԭ����2��������>90%"
			{
					$update_deal="update stu_works set is_deal=0,reason=2 where s_id='{$sid}' and w_id=$wid";
					$rs_update=mysql_query($update_deal,$conn);	//���½���ҵ�ߵ�����
			}
			echo "<script type='text/javascript'>
			document.getElementById('checks').innerHTML='';
			document.getElementById('checks').style.display='none';
			</script>";
			if($same_percent>=90) echo "<div class='check'>
					<label style=' font-size:20px;color=#00FFFF;'>���ؽ��</label><br><br>
			��ҵ��ͬ��<label style='color:#FF0000;font-size:16px;'>".$same_percent."%</label>��������ͬ��������ҵ<label style='color:#FF0000;font-size:16px;'>0</label>�֡�
			<div class='anniu'><a href=".$_SESSION['url'].">����</a></div>
			</div>";
			else	echo "<div class='check'>
			<label style=' font-size:20px;color=#00FFFF;'>���ؽ��</label><br><br>
			��ҵ��ͬ��<label style='color:#FF0000;font-size:16px;'>".$same_percent."%</label>�����ϱ�����ҵҪ��
			<div class='anniu'><a href=".$_SESSION['url'].">����</a></div>
			</div>";
			//��ͬ��ͬ�ߣ�90%���ϵ�,Ҳ��Ϊ0�֣�ԭ��Ϊ2����������>90%")
			foreach($samer_sid as $key=>$v)
			{
				if($v>=9)		//9��������ͬ�ߣ��Ÿ���
				{
					$update_deal="update stu_works set is_deal=0,reason=2 where s_id='{$key}' and w_id=$wid";
					$rs_update=mysql_query($update_deal,$conn);	//����������ͬ�ߵ�����
					$repeation=$v*10;
					$update_deal="update duplicate_check set repeation={$repeation},cdate='{$cdate}' where sid='{$key}' and wid=$wid";
					$rs_update=mysql_query($update_deal,$conn);	//����������ͬ�ߵ��ظ���
				}
			}
		}
		else
		{
			echo "�ֶ����ݱ���ʧ�ܣ�������ֹ����";
		}
		echo "";
	}//��������
?>
<br />
<?php require("about.html");?>
