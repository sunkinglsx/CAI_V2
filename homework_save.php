<?php
		require("session.php");
		require("term.php");
		require("check_exten.php");
	require("db_connect.php");	//���ݿ�
		check_session();
	$endtime=$_POST['endtime'];
	if(strtotime($endtime)<time())	//�����˽�ֹ����
	{
			echo "<script language='javascript'>";
			echo "alert('������ҵ�ѽ�ֹ�ύ���´��밴ʱ�ύ��ҵ��');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
	}
		//��ȡѧ��IP�����Ӻ���
function GetIP(){ 		
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ips=explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
        if($ips){ array_unshift($ips, $ip); $ip=FALSE; }
        for ($i=0; $i < count($ips); $i++){
            if(!preg_match('^(10��172.16��192.168).', $ips[$i])){
                $ip=$ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip:$_SERVER['REMOTE_ADDR']);
}
//�����������дʵĺ���
function Shield($str)
{
	$key_arr=array("������","��","�����","����","ʺ","ƨ","ȥ��","'");
	for($i=0;$i<count($key_arr);$i++)
	{
		$keyword=$key_arr[$i];
		$index=stripos($str,$keyword);	//����ÿ�����д�
		if(false!=$index)
		{
			$str=str_replace($keyword," ",$str,$num);	  //�滻Ϊ���д�
		}
	}
	return($str);
}
	$wid=$_GET['wid'];	//��ҵ��
		//�Ȳ�ѯ������ҵ�Ƿ���Ҫ����
	$sqls_check="select needcheck from homeworks where w_id=".$wid;	
	$rs_check=mysql_query($sqls_check,$conn);
	$arr_needCheck=mysql_fetch_array($rs_check);
	$needCheck=$arr_needCheck['needcheck'];
	mysql_free_result($rs_check);
	unset($arr_needCheck);
	echo $needCheck;
	$file_ok=1;
	//��ҵ�ļ�����
	if(isset($_FILES['w_files']['name'])&&$_FILES['w_files']['name']!="")
	{
		$wfile=$_FILES['w_files']['name'];		//��ҵ�ļ���
		//����ļ��Ƿ�ϸ�
		$arr_file=explode(".",$wfile);	//�ļ����ֽ�Ϊ����
		$exten=$arr_file[count($arr_file)-1];	//�ļ�����չ��
		if(check_exten($exten,$wid,$wfile)===false)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('���ύ����ҵ�ļ����ʹ���');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		//��һhtml��php�� ������ֻ����index
		if(check_exten($exten,$wid,$wfile)==="wrong")
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('�ļ���������ȷ,��һ��web�ļ�������Ϊindex��');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		//����ļ������Ƿ��������ַ�
		if(check_file_name($wfile)===false)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('�ļ��������Ϸ���������������');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		//����ļ���С�����2M
		$file_size=$_FILES['w_files']['size'];
		if($file_size>=1024*1024*2)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('��ҵ�ļ���С����ɣ�������ѹ����');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
	}
	else		//���ļ��ϴ�
	{
		$file_ok-=1;
		echo "<script language='javascript'>";
		echo "alert('��ѡ����Ҫ�ϴ�����ҵ�ļ�');";
		echo "window.history.back(-1);";
		echo "</script>";
		exit;
	}
	if($file_ok==1)
	{
		$path='w_files/'.$_SESSION['s_id'].time().".".$exten;		//�ļ�����ʽ��ѧ��+ʱ��+��׺��
		if(!move_uploaded_file($_FILES['w_files']['tmp_name'],$path))
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('��ҵ�ļ��ϴ�ʧ�ܣ���Ҫ�����ϴ�');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
	}
	//���Բ���
	if(isset($_POST['content']))
		{
			$wcontent=$_POST['content'];	//����
			if(strlen($wcontent)==0)
				$wcontent="������";
			if (strlen($wcontent)>=1000)	//�������Ը�ʽ�е�html
			{
					echo "<script language='javascript'>";
					echo "alert('��������̫�࣬���Լ����࣡');";
					echo "window.history.back(-1);";
					echo "</script>";
					exit;
			}
			//�ϸ������� ���п��ܳ��ֵ����дʻ�
			$wcontent=Shield($wcontent);
		}
	else
	{
		$wcontent="������";
	}
	mysql_query("SET NAMES 'gbk'");
	$sid=$_SESSION['s_id'];	//ѧ��
	$wtime=date("Y-m-d h:i:s",time());	//�ύʱ��
	$sip=GetIP();		//IP��ַ
	$term=term($sid);		//ѧ��
	$couid=$_POST['couid'];
	//��ֹ�ظ��ύ��ҵ
	$sqls_resumit="select * from stu_works where s_id='".$sid."' and w_id=".$wid;
	$rs_re=mysql_query($sqls_resumit,$conn);
	if(!$rs_re||mysql_num_rows($rs_re)==0)
	{
			mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
		$sqls="insert into stu_works(s_id,w_id,cou_id,s_file,s_time,s_ip,s_note,s_term,is_deal)values('".$sid."',".$wid.",".$couid.",'".$path."','".$wtime."','".$sip."','".$wcontent."',".$term.",101)";	
		$rs=mysql_query($sqls,$conn);
			mysql_query("SET NAMES 'gb2312'");	//�����ݿ�һ��
		if(!$rs)
		{
			echo "<script language='javascript'>";
			echo "alert('����ʶ���ԭ����ҵ�ύʧ�ܣ���������³����Ͻ�����ϵ��ʦ');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		else
		{
			//��ҵ��ֱ���ļ�,�ұ�����ҵ����
			if($needCheck==1)
			{
				header("location:duplicate_check.php?sid=".$_SESSION['s_id']."&wid=".$wid);	//��������ҳ
			}
			else	//����ֱ���ύ
			{
				echo "<script language='javascript'>";
				echo "alert('һ����ҵ�ύ�ɹ���ף��ѧϰ������');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
			} 
		}
	}
?>
