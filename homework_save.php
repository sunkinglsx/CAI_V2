<?php
		require("session.php");
		require("term.php");
		require("check_exten.php");
	require("db_connect.php");	//数据库
		check_session();
	$endtime=$_POST['endtime'];
	if(strtotime($endtime)<time())	//超过了截止日期
	{
			echo "<script language='javascript'>";
			echo "alert('本次作业已截止提交，下次请按时提交作业！');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
	}
		//获取学生IP的孙子涵数
function GetIP(){ 		
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ips=explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
        if($ips){ array_unshift($ips, $ip); $ip=FALSE; }
        for ($i=0; $i < count($ips); $i++){
            if(!preg_match('^(10│172.16│192.168).', $ips[$i])){
                $ip=$ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip:$_SERVER['REMOTE_ADDR']);
}
//屏蔽留言敏感词的函数
function Shield($str)
{
	$key_arr=array("操你妈","操","他妈的","你妈","屎","屁","去死","'");
	for($i=0;$i<count($key_arr);$i++)
	{
		$keyword=$key_arr[$i];
		$index=stripos($str,$keyword);	//查找每个敏感词
		if(false!=$index)
		{
			$str=str_replace($keyword," ",$str,$num);	  //替换为敏感词
		}
	}
	return($str);
}
	$wid=$_GET['wid'];	//作业号
		//先查询本次作业是否需要查重
	$sqls_check="select needcheck from homeworks where w_id=".$wid;	
	$rs_check=mysql_query($sqls_check,$conn);
	$arr_needCheck=mysql_fetch_array($rs_check);
	$needCheck=$arr_needCheck['needcheck'];
	mysql_free_result($rs_check);
	unset($arr_needCheck);
	echo $needCheck;
	$file_ok=1;
	//作业文件操作
	if(isset($_FILES['w_files']['name'])&&$_FILES['w_files']['name']!="")
	{
		$wfile=$_FILES['w_files']['name'];		//作业文件名
		//检查文件是否合格
		$arr_file=explode(".",$wfile);	//文件名分解为数组
		$exten=$arr_file[count($arr_file)-1];	//文件的扩展名
		if(check_exten($exten,$wid,$wfile)===false)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('所提交的作业文件类型错误！');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		//单一html或php文 件命名只能是index
		if(check_exten($exten,$wid,$wfile)==="wrong")
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('文件命名不正确,单一的web文件名必须为index！');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		//检查文件名中是否含有中文字符
		if(check_file_name($wfile)===false)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('文件命名不合法，请重新命名！');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		//检查文件大小，最大2M
		$file_size=$_FILES['w_files']['size'];
		if($file_size>=1024*1024*2)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('作业文件大小超许可，请重新压缩！');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
	}
	else		//空文件上传
	{
		$file_ok-=1;
		echo "<script language='javascript'>";
		echo "alert('请选择你要上传的作业文件');";
		echo "window.history.back(-1);";
		echo "</script>";
		exit;
	}
	if($file_ok==1)
	{
		$path='w_files/'.$_SESSION['s_id'].time().".".$exten;		//文件名格式：学号+时间+后缀名
		if(!move_uploaded_file($_FILES['w_files']['tmp_name'],$path))
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('作业文件上传失败，需要重新上传');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
	}
	//留言操作
	if(isset($_POST['content']))
		{
			$wcontent=$_POST['content'];	//留言
			if(strlen($wcontent)==0)
				$wcontent="无留言";
			if (strlen($wcontent)>=1000)	//考虑留言格式中的html
			{
					echo "<script language='javascript'>";
					echo "alert('留言字数太多，请言简意赅！');";
					echo "window.history.back(-1);";
					echo "</script>";
					exit;
			}
			//严格屏蔽留 言中可能出现的敏感词汇
			$wcontent=Shield($wcontent);
		}
	else
	{
		$wcontent="无留言";
	}
	mysql_query("SET NAMES 'gbk'");
	$sid=$_SESSION['s_id'];	//学号
	$wtime=date("Y-m-d h:i:s",time());	//提交时间
	$sip=GetIP();		//IP地址
	$term=term($sid);		//学期
	$couid=$_POST['couid'];
	//防止重复提交作业
	$sqls_resumit="select * from stu_works where s_id='".$sid."' and w_id=".$wid;
	$rs_re=mysql_query($sqls_resumit,$conn);
	if(!$rs_re||mysql_num_rows($rs_re)==0)
	{
			mysql_query("SET NAMES 'gbk'");	//与数据库一致
		$sqls="insert into stu_works(s_id,w_id,cou_id,s_file,s_time,s_ip,s_note,s_term,is_deal)values('".$sid."',".$wid.",".$couid.",'".$path."','".$wtime."','".$sip."','".$wcontent."',".$term.",101)";	
		$rs=mysql_query($sqls,$conn);
			mysql_query("SET NAMES 'gb2312'");	//与数据库一致
		if(!$rs)
		{
			echo "<script language='javascript'>";
			echo "alert('不可识别的原因，作业提交失败，你可以重新尝试上交或联系老师');";
			echo "window.history.back(-1);";
			echo "</script>";
			exit;
		}
		else
		{
			//作业是直接文件,且本次作业查重
			if($needCheck==1)
			{
				header("location:duplicate_check.php?sid=".$_SESSION['s_id']."&wid=".$wid);	//跳到查重页
			}
			else	//否则直接提交
			{
				echo "<script language='javascript'>";
				echo "alert('一份作业提交成功，祝你学习进步！');";
				echo "location.href='".$_SESSION['url']."';";
				echo "</script>";
			} 
		}
	}
?>
