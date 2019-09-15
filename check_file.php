<?php
function check_answerfile(){		//作业答案文件检验操作
	$file_ok=1;
	if(isset($_FILES['wanswer']['name'])&&$_FILES['wanswer']['name']!="")
	{
		$wfile=$_FILES['wanswer']['name'];		//作业文件名
		//检查文件是否合格
		$arr_file=explode(".",$wfile);	//文件名分解为数组
		$exten=$arr_file[count($arr_file)-1];	//文件的扩展名	支持 txt,rar,zip,doc,docx,pdf,jpg
		if($exten!='txt'&&$exten!='html'&&$exten!='rar'&&$exten!='zip'&&$exten!='doc'&&$exten!='docx'&&$exten!='pdf'&&$exten!='jpg'&&$exten!='php')
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('答案文件类型错误！');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		//检查文件大小，最大2M
		$file_size=$_FILES['wanswer']['size'];
		if($file_size>=1024*1024*2)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('答案文件大小超许可，请重新压缩！');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		$is_exisit=1;		//存在文件
	}
	else		//空答案文件上传
	{
		$file_ok=1;
		$apath="#";
		$is_exisit=0;		//不存在文件
		echo "<script language='javascript'>
		if(confirm('你是否需要提供参考答案？'))
		{window.history.back(-1);}
		</script>";
		
	}
	if($file_ok==1&&$is_exisit==1)
	{
		$apath='answer_files/'.time().$_FILES['wanswer']['name'];		//文件名格式：时间+原文件名
		$apath = iconv("gb2312", "UTF-8", $apath);		//防止上传以后中文名乱码
		if(!move_uploaded_file($_FILES['wanswer']['tmp_name'],$apath))
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('参考答案文件上传失败，需要重新上传');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
	}
	$apath = iconv("UTF-8", "gbk", $apath);		//防止存入数据库乱码
	return $apath;
}
///////////////////////////////////////////////////////////////////////////////////////////////////
function check_handoutfile()			//讲义文件检验操作
{
	$file_ok=1;
	if(isset($_FILES['whandout']['name'])&&$_FILES['whandout']['name']!="")
	{
		$wfile=$_FILES['whandout']['name'];		//作业文件名
		//检查文件是否合格
		$arr_file=explode(".",$wfile);	//文件名分解为数组
		$exten=$arr_file[count($arr_file)-1];	//文件的扩展名,支持rar,zip,doc,docx,pdf,ppt,pptx
		if($exten!='pptx'&&$exten!='rar'&&$exten!='zip'&&$exten!='doc'&&$exten!='docx'&&$exten!='pdf'&&$exten!='ppt')
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('讲义文件类型错误！');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		//检查文件大小，最大2M
		$file_size=$_FILES['whandout']['size'];
		if($file_size>=1024*1024*2)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('讲义文件大小超许可，请重新压缩！');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		$is_exisit=1;		//存在文件
	}
	else		//空讲义文件上传
	{
		$file_ok=1;
		$hpath="#";
		$is_exisit=0;		//不存在文件
		echo "<script language='javascript'>
		if(confirm('你是否需要提供讲义下载？'))
		{window.history.back(-1);}
		</script>";
	}
	if($file_ok==1&&$is_exisit==1)
	{
		$hpath='handouts/'.time().$_FILES['whandout']['name'];		//时间+原文件名保存入库
		$hpath = iconv("gb2312", "UTF-8", $hpath);		//防止上传以后中文名乱码
		if(!move_uploaded_file($_FILES['whandout']['tmp_name'],$hpath))
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('讲义文件上传失败，需要重新上传');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
	}
		$hpath = iconv("UTF-8", "gbk", $hpath);		//防止存入数据库乱码
return $hpath;		//返回讲义路径
}
?>