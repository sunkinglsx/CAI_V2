<?php
	//ѧ�ڴ�����
	//���ݰ༶���Լ���ǰʱ���ж�ѧ��
	function term($cid){
	$c_month=intval(date("m"));	//��ǰ�·�
	$c_year=substr(date("Y"),2,2);	//��ǰ���
	if(substr($cid,1,1)=="-")
		$s_grate=substr($cid,3,2);	//�༶���꼶	R-C1601
	else
		$s_grate=substr($cid,1,2);	//�༶���꼶	//C16F01
	if($c_month==1 ||( $c_month<=12&&$c_month>=9))	//1��3��5ѧ��
	{
		if($c_year-$s_grate==1&&$c_month==1)
		{			$term=1;	}//��1ѧ��
		if($c_year==$s_grate)
		{	$term=1;	}//��1ѧ��
		if($c_year-$s_grate==2&&$c_month==1)
		{			$term=3;	}//��3ѧ��
		if($c_year-$s_grate==1&&$c_month!=1)
		{			$term=3;	}//��3ѧ��
		if($c_year-$s_grate==3&&$c_month==1)
		{			$term=5;	}//��5ѧ��		
		if($c_year-$s_grate==2&&$c_month!=1)
		{			$term=5;	}//��5ѧ��		
	}
	if( $c_month<=8&&$c_month>=2)	//2��4��6ѧ��
	{
		if($c_year-$s_grate==1)
		{			$term=2;	}//��2ѧ��		
		if($c_year-$s_grate==2)
		{			$term=4;		}
		if($c_year-$s_grate==3)
		{	$term=6;}
	}
	return $term;
	}
?>