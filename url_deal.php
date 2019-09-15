<?php
	//url参数预处理
	function url_deal($str)
	{
		$str=str_replace("'","",$str);	//单引号
		$str=str_replace(";","",$str);	//分号
		$str=str_replace(" ","",$str);//空格
		$str=str_replace("and","",$str);	//and
		$str=str_replace("or","",$str);	//or
		$str=str_replace("where","",$str);	//破坏sql语句结构
		$str=str_replace("|","",$str);	//|分隔符
		$str=str_replace("exe","",$str);		//过滤可执行
		$str=str_replace("count","",$str);	//过滤统计
		$str=str_replace("select","",$str);
		$str=str_replace("insert","",$str);
		$str=str_replace("update","",$str);
		$str=str_replace("(","",$str);
		$str=str_replace(")","",$str);
		if($str=="")
		{ echo "参数错误，系统处理中止";
			exit;
		}else 
			return $str; 
	}
?>