<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ҵϵͳ&mdash;��ҵ�ύ</title>
<style type="text/css">
#form1 #t_main {
	font-size: 12px;
	text-decoration: none;
	background-color: #FFF;
	width:1000px;
}
.txt_red {
	color: #C00;
}
#form1 #t_main tr #wt {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E5F1FF;
	border-left-color: #DDECFF;
}
#form1 #t_main tr #w_file {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-top-color: #E5F1FF;
	border-left-color: #E2EEFE;
	border-right-color: #E5F1FF;
}
#form1 #t_main tr #w_about {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E2EEFE;
	border-left-color: #E2EEFE;
}
#form1 #t_main tr #w_ly {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E2EEFE;
	border-left-color: #E2EEFE;
}
#form1 #t_main tr #lynr {
	border-right-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-left-style: solid;
	border-right-color: #E2EEFE;
	border-left-color: #E2EEFE;
}
.txt_blue {
	font-size: 12px;
	color: #03F;
	text-decoration: none;
}
</style>
<link rel="stylesheet" href="themes/default/default.css" />
<style type="text/css">
body {
	background-color: #F4F4F4;
}
</style>
<script charset="utf-8" src="kindeditor-min.js"></script>
<script charset="utf-8" src="lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('textarea[name="content"]', 
{allowFileManager : true	
});
		});
</script>
</head>

<body>
<?php
		require("session.php");
		require("url_deal.php");		//url����ļ�
		check_session();//����Ƿ��¼
		$couid=url_deal($_GET['couid']);
	if(isset($_GET['wid']))		//��ҵ��
	{
		$wid=url_deal($_GET['wid']);
		if(intval($wid)!=$wid)
		{
			echo "�������ɼ����Ĵ���1��ϵͳ�ж�";
			exit;
		}
		else
		{			$_SESSION['wid']=$wid;		}//������ҵ��	
	}
	else
		{
			if(!isset($_SESSION['wid']))	
				{
					echo "�������ɼ����Ĵ���2��ϵͳ�ж�";
					exit;
				}
		}
	if(isset($_GET['t']))		//ѧ��
	{
		$t=url_deal($_GET['t']);
		if(intval($t)!=$t)
		{
			echo "�������ɼ����Ĵ���3��ϵͳ�ж�";
			exit;
		}
	}
		require("db_connect.php");	//���ݿ�
		mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
		$wsqls="select * from homeworks where w_id=".$wid;
		$wrs=mysql_query($wsqls,$conn);	//���Ҫ�ύ����ҵ����
		if($wrs)
		{
			$w_arr=mysql_fetch_array($wrs);	//ת��Ϊ����
		}
		$cousqls="select * from course where cou_id=".$couid;
		$crs=mysql_query($cousqls,$conn);
		$cou_arr=mysql_fetch_array($crs);
?>
<form action="homework_save.php?wid=<?php echo $wid;?>&amp;t=<?php echo $term;?>"  method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="800" height="675" border="0" align="center" cellpadding="0" cellspacing="0" id="t_main">
    <tr>
      <td height="46" colspan="2" align="center" bgcolor="#CDE1F3"><span style="font-size:20px">��ҵ�ύ</span></td>
    </tr>
    <tr>
      <td height="28" valign="middle" bgcolor="#FFFFE1" id="wt">���γ̿�Ŀ��<?php echo $cou_arr['cou_name'];?>
        <input name="couid" type="hidden" id="couid" value="<?php echo $couid;?>" /></td>
      <td align="center" valign="middle" bgcolor="#FFFFE1" id="wt"><a href="homework_list.php?couid=<?php echo $couid;?>">������ҵ�б�&gt;&gt;</a></td>
    </tr>
    <tr>
      <td height="122" colspan="2" valign="top" id="wt"><table width="100%" height="238" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="94" height="32" align="center">��ҵ��Ŀ</td>
          <td colspan="3" class="txt_red"><?php echo $w_arr['w_name'];?></td>
          </tr>
        <tr>
          <td height="32" align="center">��ֹʱ��</td>
          <td width="420" class="txt_red"><?php echo $w_arr['w_time'];?>
            <input type="hidden" name="endtime" id="endtime"  value="<?php echo $w_arr['w_time'];?>"/></td>
          <td width="78" align="center">����༶</td>
          <td width="406" class="txt_red"><?php echo $w_arr['w_class'];?></td>
        </tr>
        <tr>
          <td height="174" colspan="4" valign="top">��Ҫ��<span class="txt_blue"><?php echo $w_arr['w_require'];?></span></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="41" colspan="2" align="left" id="w_file">����ҵ�ļ��ϴ���
        <label for="w_files"></label>
      <input type="file" name="w_files" id="w_files" /></td>
    </tr>
    <tr>
      <td height="43" colspan="2" align="left" bgcolor="#FFFFE1" id="w_about">
      ˵����������ҵ�ļ�ֻ֧�����¸�ʽ��
	 <span class="txt_red"> <?php
	  	$ext=explode("#",$w_arr['w_exten']);
		foreach($ext as $e)
		{
			echo $e."   ";
		}
	  ?></span>
      </td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="left" id="w_ly">����ע���ԡ�������ҵ�йصı�ע�����⣬�����ʦ����,500�����ڣ�</td>
    </tr>
    <tr>
      <td height="139" colspan="2" valign="top" id="lynr">
      <textarea name="content" style="width:100%; height:200px;">
</textarea>

      </td>
    </tr>
    <tr>
      <td height="37" colspan="2" align="center" bgcolor="#E2EEFE"><input type="submit" name="button" id="button" value="ȷ���Ͻ�" />
        <a href="homework_list.php"></a></td>
    </tr>
  </table>
</form><br />
<?php require("about.html");?>
</body>
</html>