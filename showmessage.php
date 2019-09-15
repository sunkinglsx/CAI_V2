<style type="text/css">
body {
	margin-top: 0px;
}
#t_main {
	background-color: #F7EFBB;
	font-size: 12px;
	color: #C30;
	text-decoration: none;
}
</style>
<?php
	require("url_deal.php");
	$mid=intval(url_deal($_GET['mid']));
	if(!isset($mid)||$mid<=0)
	{
		echo "参数错误，系统处理中止";
		exit;
	}
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	$sql="select * from message where m_id=".$mid;
	$rs=mysql_query($sql,$conn);
	$m_arr=mysql_fetch_array($rs);
?>
<table width="611" height="360" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td width="71" height="40" align="center" bgcolor="#FFFFFF">发件人：</td>
    <td width="106" align="center" bgcolor="#FFFFFF"><?php echo $m_arr['sender'];?></td>
    <td width="83" align="center" bgcolor="#FFFFFF">发件时间：</td>
    <td width="145" align="center" bgcolor="#FFFFFF"><?php echo $m_arr['sen_time'];?></td>
    <td width="206" align="left" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="318" colspan="5" align="left" valign="top" bgcolor="#FFFF9D"><br /><?php echo $m_arr['message'];?></td>
  </tr>
</table>
<?php
	//将短信设为已读
	$sqls="update message set is_read=1 where m_id=".$mid;
	$rs=mysql_query($sqls,$conn);
?>