<?php
function check_answerfile(){		//��ҵ���ļ��������
	$file_ok=1;
	if(isset($_FILES['wanswer']['name'])&&$_FILES['wanswer']['name']!="")
	{
		$wfile=$_FILES['wanswer']['name'];		//��ҵ�ļ���
		//����ļ��Ƿ�ϸ�
		$arr_file=explode(".",$wfile);	//�ļ����ֽ�Ϊ����
		$exten=$arr_file[count($arr_file)-1];	//�ļ�����չ��	֧�� txt,rar,zip,doc,docx,pdf,jpg
		if($exten!='txt'&&$exten!='html'&&$exten!='rar'&&$exten!='zip'&&$exten!='doc'&&$exten!='docx'&&$exten!='pdf'&&$exten!='jpg'&&$exten!='php')
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('���ļ����ʹ���');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		//����ļ���С�����2M
		$file_size=$_FILES['wanswer']['size'];
		if($file_size>=1024*1024*2)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('���ļ���С����ɣ�������ѹ����');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		$is_exisit=1;		//�����ļ�
	}
	else		//�մ��ļ��ϴ�
	{
		$file_ok=1;
		$apath="#";
		$is_exisit=0;		//�������ļ�
		echo "<script language='javascript'>
		if(confirm('���Ƿ���Ҫ�ṩ�ο��𰸣�'))
		{window.history.back(-1);}
		</script>";
		
	}
	if($file_ok==1&&$is_exisit==1)
	{
		$apath='answer_files/'.time().$_FILES['wanswer']['name'];		//�ļ�����ʽ��ʱ��+ԭ�ļ���
		$apath = iconv("gb2312", "UTF-8", $apath);		//��ֹ�ϴ��Ժ�����������
		if(!move_uploaded_file($_FILES['wanswer']['tmp_name'],$apath))
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('�ο����ļ��ϴ�ʧ�ܣ���Ҫ�����ϴ�');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
	}
	$apath = iconv("UTF-8", "gbk", $apath);		//��ֹ�������ݿ�����
	return $apath;
}
///////////////////////////////////////////////////////////////////////////////////////////////////
function check_handoutfile()			//�����ļ��������
{
	$file_ok=1;
	if(isset($_FILES['whandout']['name'])&&$_FILES['whandout']['name']!="")
	{
		$wfile=$_FILES['whandout']['name'];		//��ҵ�ļ���
		//����ļ��Ƿ�ϸ�
		$arr_file=explode(".",$wfile);	//�ļ����ֽ�Ϊ����
		$exten=$arr_file[count($arr_file)-1];	//�ļ�����չ��,֧��rar,zip,doc,docx,pdf,ppt,pptx
		if($exten!='pptx'&&$exten!='rar'&&$exten!='zip'&&$exten!='doc'&&$exten!='docx'&&$exten!='pdf'&&$exten!='ppt')
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('�����ļ����ʹ���');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		//����ļ���С�����2M
		$file_size=$_FILES['whandout']['size'];
		if($file_size>=1024*1024*2)
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('�����ļ���С����ɣ�������ѹ����');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
		$is_exisit=1;		//�����ļ�
	}
	else		//�ս����ļ��ϴ�
	{
		$file_ok=1;
		$hpath="#";
		$is_exisit=0;		//�������ļ�
		echo "<script language='javascript'>
		if(confirm('���Ƿ���Ҫ�ṩ�������أ�'))
		{window.history.back(-1);}
		</script>";
	}
	if($file_ok==1&&$is_exisit==1)
	{
		$hpath='handouts/'.time().$_FILES['whandout']['name'];		//ʱ��+ԭ�ļ����������
		$hpath = iconv("gb2312", "UTF-8", $hpath);		//��ֹ�ϴ��Ժ�����������
		if(!move_uploaded_file($_FILES['whandout']['tmp_name'],$hpath))
		{
			$file_ok-=1;
			echo "<script language='javascript'>";
			echo "alert('�����ļ��ϴ�ʧ�ܣ���Ҫ�����ϴ�');";
			echo "window.history.back(-1);";
			echo "</script>";
		}
	}
		$hpath = iconv("UTF-8", "gbk", $hpath);		//��ֹ�������ݿ�����
return $hpath;		//���ؽ���·��
}
?>