<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ҵ����ϵͳ�����γ����</title>
<style type="text/css">
#tinfo {
	background-color: #F6F6F6;
	color:#099;
	font-size:14px;
}
.info_title{
	color:#066;
	font-size:24px;
}
.lab{
	font-size:13px;
	color:#C00;
	padding-left:12px;
	font-weight:bold;
}
</style>
</head>
<body>

<?php
	require('url_deal.php');
	$flag=0;
	if(isset($_GET['dtid']))
	{
		$dtid=url_deal($_GET['dtid']);
		$flag=1;
	}
	if(isset($_GET['did']))
	{
		$did=url_deal($_GET['did']);
		$fiag=2;
	}
	require('db_connect.php');
	mysql_query("SET NAMES gb2312");
	if($flag!=0)
		$sqls_info="select * from design_titles where DT_id=".$dtid." and D_id=".$did;
	else
		$sqls_info="select * from design_titles where D_id=".$did." order by DT_id asc limit 0,1";
	$rs_info=mysql_query($sqls_info,$conn);
	if(!$rs_info||mysql_num_rows($rs_info)==0)	//û��ѡ����Ϣ
	{?>
<table width="1200" height="427" border="0" align="center" cellpadding="0" cellspacing="1" id="tinfo">
  <tr>
    <td height="64" colspan="3" bgcolor="#E1F1F7">ѡ������<br />
    
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFFF"><img src="pics/nothing.jpg" width="465" height="254" /></td>
  </tr>
  <tr>
    <td width="362" height="31" align="right" bgcolor="#F6F6F6">&nbsp;</td>
    <td width="408" bgcolor="#F6F6F6">&nbsp;</td>
    <td width="426" bgcolor="#F6F6F6">&nbsp;</td>
  </tr>
</table>
    <?
	}
	else
	{
		$arr_info=mysql_fetch_array($rs_info);
?>
<table width="1200" height="427" border="0" align="center" cellpadding="0" cellspacing="1" id="tinfo">
  <tr>
    <td height="64" colspan="3" bgcolor="#E1F1F7">ѡ������<br />
    <span class="info_title">����<?php echo $arr_info['DT_title'];?></span>
    </td>
  </tr>
  <tr>
    <td width="362" height="34" align="center" bgcolor="#FFFFCC">[�ӷ�ֵ]<span class="lab"><?php echo $arr_info['DT_bonus'];?></span></td>
    <td width="408" align="center" bgcolor="#FFFFCC">[��ѡ����]<span class="lab"><?php echo $arr_info['DT_taked'];?></span></td>
    <td width="426" align="center" bgcolor="#FFFFCC">[��ѡ����]<span class="lab"><?php echo $arr_info['DT_takers'];?></span></td>
  </tr>
  <tr>
    <td height="293" colspan="3" valign="top" bgcolor="#FFFFFF"><br />
   ������Ҫ��<br /><?php echo $arr_info['DT_demand'];?>
    </td>
  </tr>
  <tr>
    <td height="31" align="right" bgcolor="#F6F6F6">&nbsp;</td>
    <td bgcolor="#F6F6F6">&nbsp;</td>
    <td bgcolor="#F6F6F6">&nbsp;</td>
  </tr>
</table>
<?php mysql_free_result($rs_info);
	}?>
</body>
</html>