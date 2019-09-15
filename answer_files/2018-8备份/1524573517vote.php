<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="373" height="174" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" bgcolor="#F0F0F0">2018年最受瞩目人物投票</td>
    </tr>
    <tr>
      <td><p>
        <label>
          <input type="radio" name="vo" value="1" id="vo_0" />
          马云</label>
        <br />
        <label>
          <input type="radio" name="vo" value="2" id="vo_1" />
          李嘉诚</label>
        <br />
        <label>
          <input type="radio" name="vo" value="3" id="vo_2" />
          王健林</label>
        <br />
      </p></td>
    </tr>
    <tr>
      <td height="48" align="center"><input type="submit" name="ok" id="ok" value="提交" /></td>
    </tr>
  </table>
</form>
<?php
	$f="tt.txt";
	if(file_exists($f))
	{
		$fleng=filesize($f);
		$fid=fopen($f,"r");
		$vstr=fread($fid,$fleng);
		fclose($fid);
	}
	else
	{
		$fleng=0;
		$vstr="0,0,0";
	}
	$votearray=explode(",",$vstr);
	if(isset($_POST['ok']))
	{
		$v=$_POST['vo'];
		if($v==1)
			$votearray[0]+=1;
		if($v==2)
			$votearray[1]+=1;
		if($v==3)
			$votearray[2]+=1;
		$fid=fopen($f,"w");
		$str=implode(",",$votearray);
		fwrite($fid,$str);
		fclose($fid);
	}
	echo "马云:".$votearray[0]."<br>";
	echo "李嘉诚：".$votearray[1]."<br>";
	echo "王健林:".$votearray[2];
?>
</body>
</html>