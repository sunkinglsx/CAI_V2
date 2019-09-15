<?php
	//学期处理函数
	//根据班级号以及当前时间判断学期
	function term($cid){
	$c_month=intval(date("m"));	//当前月份
	$c_year=substr(date("Y"),2,2);	//当前年份
	if(substr($cid,1,1)=="-")
		$s_grate=substr($cid,3,2);	//班级的年级	R-C1601
	else
		$s_grate=substr($cid,1,2);	//班级的年级	//C16F01
	if($c_month==1 ||( $c_month<=12&&$c_month>=9))	//1，3，5学期
	{
		if($c_year-$s_grate==1&&$c_month==1)
		{			$term=1;	}//第1学期
		if($c_year==$s_grate)
		{	$term=1;	}//第1学期
		if($c_year-$s_grate==2&&$c_month==1)
		{			$term=3;	}//第3学期
		if($c_year-$s_grate==1&&$c_month!=1)
		{			$term=3;	}//第3学期
		if($c_year-$s_grate==3&&$c_month==1)
		{			$term=5;	}//第5学期		
		if($c_year-$s_grate==2&&$c_month!=1)
		{			$term=5;	}//第5学期		
	}
	if( $c_month<=8&&$c_month>=2)	//2，4，6学期
	{
		if($c_year-$s_grate==1)
		{			$term=2;	}//第2学期		
		if($c_year-$s_grate==2)
		{			$term=4;		}
		if($c_year-$s_grate==3)
		{	$term=6;}
	}
	return $term;
	}
?>