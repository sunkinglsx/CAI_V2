<style type="text/css">
#t_main {
	font-size: 12px;
	border: solid 1px #CCC;
}
a:link {
	font-size: 12px;
	color: #C00;
	text-decoration: none;
	background-color: #FFF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #900;
}
a:visited {
	font-size: 12px;
	color: #C00;
	text-decoration: none;
	background-color: #FFF;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #900;
}
a:hover {
	font-size: 12px;
	color: #060;
	text-decoration: none;
	background-color: #CFC;
	padding-top: 3px;
	padding-right: 5px;
	padding-bottom: 3px;
	padding-left: 5px;
	border: 1px solid #390;
}
.changbg:hover{
	background-color:#D6E6E9;
}
.fx_box {
	padding-top: 5px;
	padding-bottom: 5px;
	margin-top: 5px;
	margin-right: 30px;
	margin-bottom: 4px;
	margin-left: 30px;
}
</style>
<script language="javascript">
function check_form()
{
	if(document.getElementById("deal[]").checked==false)
	{
		alert("��ѡ��Ҫ���ĵ�ѧ����ҵ");
		return false;
	}
}
</script>
<?php
	session_start();
	$wid=$_GET['wid'];
	$cid=$_GET['cid'];
	$wname=$_GET['wname'];
	//��ס��ǰ���� ��url
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	require("db_connect.php");
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
		$sqls="select * from  stu_works where w_id=".$wid." and s_id like '".$cid."%'";
		$wrs=mysql_query($sqls,$conn);
		if(!$wrs)
		{
			echo "��û��ѧ������ҵ";
			exit;
		}
		else
		{
			$wrows=mysql_num_rows($wrs);
			if($wrows==0)
			{
				echo "��û��ѧ������ҵ";
				exit;
			}
		}
?>
<form id="form1" name="form1" method="post" action="a_homework_deal.php">
  <table width="100%" height="152" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
    <tr>
      <td height="29" colspan="8" bgcolor="#FFFFFF">������ҳ �� ������ҵ ����ҵ�б�<?php echo $cid;?>����<?php echo $wname;?>��</td>
    </tr>
    <tr>
      <td height="29" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="29" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="29" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="29" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="29" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="29" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="29" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="29" bgcolor="#FFFFFF"><a href="data_charts.php?wid=<?php echo $wid;?>&wname=<?php echo $wname;?>"><img src="images/chart_bar.png" width="16" height="16" /> �ɼ�����ͼ</a></td>
    </tr>
    <tr>
      <td width="95" align="center" bgcolor="#EBEBEB">ѡ��</td>
      <td width="97" height="24" align="center" bgcolor="#EBEBEB">ѧ��</td>
      <td width="220" align="center" bgcolor="#EBEBEB">��ҵ��</td>
      <td width="153" align="center" bgcolor="#EBEBEB">�Ͻ�ʱ��</td>
      <td width="110" align="center" bgcolor="#EBEBEB">�Ͻ�λ��</td>
      <td width="58" align="center" bgcolor="#EBEBEB">��ҵ</td>
      <td width="52" align="center" bgcolor="#EBEBEB">����</td>
      <td width="215" align="center" bgcolor="#EBEBEB">���۲���</td>
    </tr>
    <?php 
  	for($i=0;$i<$wrows;$i++)
	{	$arr_w=mysql_fetch_array($wrs);	//ת��Ϊ����
  ?>
    <tr class="changbg">
      <td align="center">
      <?php if ($arr_w['is_deal']==101) {?>
      <label><input type="checkbox" name="deal[]" id="deal[]"  class="fx_box" value="<?php echo $arr_w['id'];?>"/> </label>
      <?php }   else { echo "<img src='pics/r.jpg'>";}?>
      </td>
      <td height="32" align="center"><?php echo $arr_w['s_id'];?></td>
      <td align="center"><?php echo $wname;?></td>
      <td align="center"><?php echo $arr_w['s_time'];?></td>
      <td align="center"><?php echo $arr_w['s_ip'];?></td>
      <td align="center"><a href="<?php echo $arr_w['s_file'];?>">����</a></td>
      <td align="center"><a href="stu_homework_del.php?id=<?php echo $arr_w['id'];?>">ɾ��</a></td>
      <?php if ($arr_w['is_deal']==101) {?>
      <td align="center">
      <label for="deal[]"><a href="a_homework_deal.php?fen=95&wid=<?php echo $arr_w['id'];?>">��</a></label> 
      <label for="deal[]"><a href="a_homework_deal.php?fen=85&wid=<?php echo $arr_w['id'];?>">��</a></label>
      <label for="deal[]"><a href="a_homework_deal.php?fen=70&wid=<?php echo $arr_w['id'];?>">��</a></label>
      <label for="deal[]"><a href="a_homework_deal.php?fen=60&wid=<?php echo $arr_w['id'];?>">ƽ</a></label>
      <label for="deal[]"><a href="a_homework_deal.php?fen=50&wid=<?php echo $arr_w['id'];?>">��</a></label> 
      <label for="deal[]"><a href="a_homework_deal.php?fen=1&wid=<?php echo $arr_w['id'];?>">��Ч</a></label>     
      </td>
	  <?php }  else { ?>
      <td width="61" align="center" bgcolor="#FFFF80">
      <label for="deal[]">
      <?php switch($arr_w['is_deal'])	//������۳ɼ�
	  				{
						case 0:
								echo "��ͬ";
								break;
						case 1:
								echo "��";
							break;
						case 50:
							echo "��";
							break;
						case 60:
							echo "ƽ";
							break;
						case 70:
							echo "��";
							break;
						case 85:
							echo "��";
							break;
						case 95:
							echo "��";
							break;
					}
		?>
      </label> 
      <label for="deal[]"><a href="a_homework_deal.php?fen=95&wid=<?php echo $arr_w['id'];?>">��</a></label> 
      <label for="deal[]"><a href="a_homework_deal.php?fen=85&wid=<?php echo $arr_w['id'];?>">��</a></label>
      <label for="deal[]"><a href="a_homework_deal.php?fen=70&wid=<?php echo $arr_w['id'];?>">��</a></label>
      <label for="deal[]"><a href="a_homework_deal.php?fen=60&wid=<?php echo $arr_w['id'];?>">ƽ</a></label>
      <label for="deal[]"><a href="a_homework_deal.php?fen=50&wid=<?php echo $arr_w['id'];?>">��</a></label> 
      <label for="deal[]"><a href="a_homework_deal.php?fen=1&wid=<?php echo $arr_w['id'];?>">��</a></label>     
      </td>
      <?php }?>
    </tr>
    <tr>    <?php }?>
      <td height="32" colspan="8" align="center" bgcolor="#EBEBEB"><p>
        <label>
          <input type="radio" name="fen" value="95" id="fen_0" />
          ��</label>
        <label>
          <input name="fen" type="radio" id="fen_1" value="85" checked="checked" />
          ��</label>
        <label>
          <input type="radio" name="fen" value="70" id="fen_2" />
          ��</label>
        <label>
          <input type="radio" name="fen" value="50" id="fen_3" />
          ��</label>
        <label>
          <input type="radio" name="fen" value="0" id="fen_4" />
          ��Ч</label>
        <input type="submit" name="button" id="button" value="��������" onclick="return check_form()" />
      </p></td>
    </tr>
  </table>
</form>
