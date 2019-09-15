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
/*作业查重函数
	1、先将每个学生提交的作业文件打开，去掉空行，再检查文件的行数，
	2、统计文件的行数N，将文件分为5段，起始行数分别是s=1+int(N/5)*(i-1)，i为分段号
	3、如果int(N/5)>=3每一段读取 s-s+3行，否则，读取s-s+int(N/5)
	3、去除各段代码中多余的空格（replace)
	4、各段代码存入数据库中相应的字段
	5、使用模糊查询，分别对各段代码进行数据库查询（匹配相同作业号查询）
	6、如果查得到结果，记下结果中的学号，以空格为标识，将查询与被查询结果都分割为数组
	7、对两个数组中的元素，逐个匹配，计算雷同率。
	8、如果雷同率>90%，所有雷同者都定为不合格，自动在批阅数据表中添加数据
*/
session_start();
require("db_connect.php");
	//$wfile=$path;
	if(isset($_GET['sid']))
		$sid=$_GET['sid'];
	else
		{echo "参数缺失，处理中止……";
		exit;}
	if(isset($_GET['wid']))
		$wid=$_GET['wid'];
	else
		{echo "参数缺失，处理中止……";
		exit;}
	$sqls="select s_file from stu_works where s_id='{$sid}' and w_id='{$wid}'";
	$rs=mysql_query($sqls,$conn);
	$arr=mysql_fetch_array($rs);
	$wfile=$arr['s_file'];		//文件路径
	mysql_free_result($rs);
	unset($arr);
	duplicate_check($sid,$wid,$wfile,$conn,10);		//根据刚交作业者的信息，查重
	function duplicate_check($sid,$wid,$wfile,$conn,$depart)
	{
		//先将文件中空白行都去掉
				$fid=fopen($wfile,"r");
		$tmp="";
		$rows=0;
		while(!feof($fid))
		{
			$str=fgets($fid);
			if($str=="\r\n"||$str=="\r"||$str=="\n")	//去掉空行
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
		file_put_contents($wfile,$tmp);//重新写回原文件
		unset($tmp);//释放内存
		$f_toBeCheck=fopen($wfile,"r");	//只读模式打开
		if($rows<10)
			$depart=$rows;	//小于10行，按行分段		
		$block=(int)($rows/$depart);	//分为depart段,每段的大小为block
		$f_str=array("","","","","","","","","","");	//每段文件的内容字符串
		$current_row=0;//当前行号
		for($i=0;$i<$depart;$i++)		//分别读取每段文件的代码内容
		{
			if($block<=3)		//每一段小于3行，读取全段
			{
				for($j=0;$j<$block;$j++)
					$f_str[$i].=fgets($f_toBeCheck);
			}
			else		//大于3行，只读3行
			{
				$j=1;	//已读行数
				while(!feof($f_toBeCheck))		//每段大于5行，只能逐行读取5 行，跳过不需要的行
				{
					if($j<=5)
					{
						$f_str[$i].=fgets($f_toBeCheck);
						$j+=1;     //2
						$current_row+=1;   //1
					}
					else{
					if($current_row==$block*($i+1))			//每一段的第一行
						break;
					else
					{
						$tmp=fgets($f_toBeCheck);
						$current_row+=1;
					}}
				}
			}
		}//$i循环结束
		fclose($f_toBeCheck);	//关闭文件
		unset($tmp);
		//去除各段中的空格，
		//将每一段的编码改为GBK
		//保存到数据库中
		for($i=0;$i<$depart;$i++)
		{
			$f_str[$i]=trim($f_str[$i]);	//去掉两边空格
			$f_str[$i]=str_replace(" ","",$f_str[$i]);	//去除中间空格
			$f_str[$i]=str_replace("'","",$f_str[$i]);	//去除单引号
			$f_str[$i]=str_replace("\"","",$f_str[$i]);	//去除双引号
			//改变文件内容的编码格式为gbk
			$fileType = mb_detect_encoding($f_str[$i],array('UTF-8','GBK','ASCII','BIG5'));
			if( $fileType != 'GBK')
				{ $f_str[$i]= mb_convert_encoding($f_str[$i] ,'GBK' , $fileType);}
		}
		//各段代码写入数据库
		$cdate=date("Y-m-d h:i:s",time());
		$sqls="insert into duplicate_check(sid,wid,cdate,code1,code2,code3,code4,code5,code6,code7,code8,code9,code10)
					values
					('{$sid}',{$wid},'{$cdate}','{$f_str[0]}','{$f_str[1]}','{$f_str[2]}','{$f_str[3]}','{$f_str[4]}','{$f_str[5]}','{$f_str[6]}','{$f_str[7]}','{$f_str[8]}','{$f_str[9]}')";
		$rs=mysql_query($sqls,$conn);
		//写入成功后查重，写入失败，提示失败
		if($rs)
		{
			//逐段查重
			$same_percent=0;	//雷同率
			//雷同者的二维数组$samer_sid，$samer[sid]格式，值为整数，
			//每有1段与交作业者的雷同，该sid者的cont值+1
			$samer_sid=array();	
			for($i=0;$i<$depart;$i++)
			{
				$sqls_cc="select sid,wid from duplicate_check where code".($i+1)."='{$f_str[$i]}' and wid=$wid and sid<>'{$sid}'";
				$rs_cc=mysql_query($sqls_cc);
				if($rs_cc && mysql_num_rows($rs_cc)>0)	//存在有雷同的代码
				{
					$same_percent+=10;		//每雷同一段，雷同率增加10%
					$update_self="update duplicate_check set repeation={$same_percent} ,cdate='{$cdate}' where sid='{$sid}' and wid=$wid";
					$rs_update=mysql_query($update_self,$conn);	//先更新被查重者的重复率
					$same_rows=mysql_num_rows($rs_cc);		//雷同的人数
					for($r=0;$r<$same_rows;$r++)		//更新全部有雷同情况的学生的雷同率
					{
							$arr_same=mysql_fetch_array($rs_cc);	
							if(array_key_exists($arr_same['sid'],$samer_sid))	//能在雷同者数组中找到对应的键名，说明之前已经有雷同代码段
							{
								$samer_sid[$arr_same['sid']]+=1;
							}
							else
								$samer_sid[$arr_same['sid']]=1;
					}//for结束
					mysql_free_result($rs_cc);	//释放记录集
				}//雷同if判断结束
			}//分段循环查重结束
			if($same_percent>=90)	//90%以上雷同，判为0分,原因是2“查重率>90%"
			{
					$update_deal="update stu_works set is_deal=0,reason=2 where s_id='{$sid}' and w_id=$wid";
					$rs_update=mysql_query($update_deal,$conn);	//更新交作业者的评分
			}
			echo "<script type='text/javascript'>
			document.getElementById('checks').innerHTML='';
			document.getElementById('checks').style.display='none';
			</script>";
			if($same_percent>=90) echo "<div class='check'>
					<label style=' font-size:20px;color=#00FFFF;'>查重结果</label><br><br>
			作业雷同率<label style='color:#FF0000;font-size:16px;'>".$same_percent."%</label>，严重雷同！本次作业<label style='color:#FF0000;font-size:16px;'>0</label>分。
			<div class='anniu'><a href=".$_SESSION['url'].">返回</a></div>
			</div>";
			else	echo "<div class='check'>
			<label style=' font-size:20px;color=#00FFFF;'>查重结果</label><br><br>
			作业雷同率<label style='color:#FF0000;font-size:16px;'>".$same_percent."%</label>，符合本次作业要求。
			<div class='anniu'><a href=".$_SESSION['url'].">返回</a></div>
			</div>";
			//其同雷同者，90%以上的,也判为0分，原因为2（“查重率>90%")
			foreach($samer_sid as $key=>$v)
			{
				if($v>=9)		//9段以上雷同者，才更新
				{
					$update_deal="update stu_works set is_deal=0,reason=2 where s_id='{$key}' and w_id=$wid";
					$rs_update=mysql_query($update_deal,$conn);	//更新其它雷同者的评分
					$repeation=$v*10;
					$update_deal="update duplicate_check set repeation={$repeation},cdate='{$cdate}' where sid='{$key}' and wid=$wid";
					$rs_update=mysql_query($update_deal,$conn);	//更新其它雷同者的重复率
				}
			}
		}
		else
		{
			echo "分段内容保存失败，查重中止……";
		}
		echo "";
	}//函数结束
?>
<br />
<?php require("about.html");?>
