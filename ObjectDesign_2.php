<style type="text/css">
.biaoti {	font-size:16px;
	color:#03C;
}
.comment {	font-size:16px;
	background-color:#FF9;
	padding-bottom:5px;
	padding-left:5px;
	padding-right:5px;
	padding-top:5px;
	color:#000;
}
.info {	color:#F00;
	padding-left:10px;
	padding-right:10px;
}
.status {	font-size:16px;
	color:#C09;
	font-weight:bold;
}
#dinfo {	font-size: 12px;
	color: #066;
	text-decoration: none;
	background-color: #CCC;
	font-weight:bolder;
}
#finish {	width:100%;
	margin:5 auto;
	text-align:center;
}
#namelist{
	width:250px;
	display:inline-block;
		text-align:left;
}
dd{
		font-size:18px;
	line-height:18px;
	font-weight:normal;
}
.tj{
	width:150px;
	height:50px;
	font-size:18px;
}
#dinfo tr td #finish #form1 #ask {
	height: 120px;
	width: 700px;
	border: 1px solid #CCC;
	font-size: 16px;
	color: #333;
	text-decoration: none;
	box-shadow:2px 2px 2px #666;
	-webkit-box-shadow:2px 2px 2p #666;
	background-color:#FF9;
}
#cannot{
	width:700px;
	background-color:#FFC;
	border:1px solid #999;
	font-size:16px;
	color:#336;
	font-weight:normal;
	height:60px;
	line-height:60px;
	margin:0 auto;
}
</style>
<?php
	require('db_connect.php');
	mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
	require('session.php');
	check_session();
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//��ס url
	require('url_deal.php');
	$obj=url_deal($_GET['obj']);
	$dtid=url_deal($_GET['dtid']);	//ѡ����
	$cid=url_deal($_GET['cid']);	//�༶
	$couseid=$_SESSION['courseid'];
	$sqls="select * from course_design where C_id=".$couseid;
	$rs_design=mysql_query($sqls,$conn);
	$arr_design=mysql_fetch_array($rs_design);
	$current_time=time();	//��ǰʱ��
	$s_time=strtotime($arr_design['S_time']);	//��ʼʱ��
	$e_time=strtotime($arr_design['E_time']);	//����ʱ��
	$isleader=1;	//Ĭ��Ϊ�ӳ�
	mysql_free_result($rs_design);
	//ÿ��ѧ�������Լ���ѡ��֮ǰ���ȼ��� ���Ƿ���ѡ�⣬�Ƿ���������ѧ������������ѧ��ѡΪ����
	//����������˳�������������ѡ���Լ���ѡ��
	$sqls_s_d_t="select * from stu_design_titles where coperator_id='".$_SESSION['s_id']."'";
	$rs_s_d_t=mysql_query($sqls_s_d_t,$conn);
	$coperators=array();	//����������
	$s_d_title="";//��½ѧ����ѡ����Ŀ
	$s_d_id="";//��ѡ��Ŀ��ID
	$coperator_num=0;//�����߳�ʼ����Ϊ0
	$comment="";//��ʾ��Ϣ
	if($rs_s_d_t&&mysql_num_rows($rs_s_d_t)>0)
	{
			$isleader=1;
			$coperator_num=mysql_num_rows($rs_s_d_t);	//������������1Ϊ�Լ��������
			for($i=0;$i<$coperator_num;$i++)
			{
				$arr_s_d_t=mysql_fetch_array($rs_s_d_t);	//��½ѧ����ѡ����Ϣ
				$coperators[$i]=$arr_s_d_t['S_name'];
				$s_d_id=$arr_s_d_t['DT_id'];
			}
			$sqls_dt="select * from design_titles where DT_id=".$s_d_id;
			$rs_dt=mysql_query($sqls_dt,$conn);
			$arr_dt=mysql_fetch_array($rs_dt);	//��ѡ������Ϣ
			$s_d_title=$arr_dt['DT_title'];	//������Ŀ����
			mysql_free_result($rs_dt);
			//������ѡ���������������ʾ��Ϣ
			if($coperator_num==1)
				$comment= "���Ѿ�ѡ���ˡ�".$s_d_title."����Ϊ������ɵĿγ������Ŀ��";
			else
			{
				$comment="<p class='comment'>���Ѿ�ѡ���ˡ�".$s_d_title."��</span>��Ŀ�����ŶӺ�����ʽ������ͬѧ��ͬ��ɡ�";
				$comment.="<br>�����Ŷӳ�Ա�ֱ��ǣ�<span style='color:#f00'>";
				foreach($coperators as $k)
				{
					$comment.=$k;
					$comment.="&nbsp;";
				}
				$comment.="</span></p>";
			}
			mysql_free_result($rs_s_d_t);
	}
	else
	{	//���ԭ�����Ŷ�һԱ���Ҳ��Ƕӳ�����Ҫ����s_id����ѯ����ȷ��
		$sqls_s_d_t="select * from stu_design_titles where s_id='".$_SESSION['s_id'];
		$rs_s_d_t=mysql_query($sqls_s_d_t,$conn);
		if(!$rs_s_d_t||mysql_num_rows($rs_s_d_t)==0)
			$comment="����δ���й��κ�ѡ��������뾡�����ѡ�⣡";	
		else
		{
			$isleader=0;	//���Ƕӳ���
			$coperator_num=1;
			$arr_stu_design_titles=mysql_fetch_array($rs_s_d_t);
			$comment="�����ڡ�".$arr_stu_design_titles['coperator_name']."���Ŷӵĳ�Ա����ѡ��ĿΪ".$arr_stu_design_titles['DT_title'];
			mysql_free_result($rs_s_d_t);
		}
	}
?>
<table width="1200" height="285" border="0" align="center" cellpadding="10" cellspacing="1" id="dinfo">
  <tr>
    <td height="43" bgcolor="#DBECFE"><span class="biaoti">�γ���ƻ�����Ϣ��<?php echo $arr_design['D_name'];?>��
    <?php if ($obj==1)echo "�������ѡ��";else echo "�������ѡ��";?>
    </span></td>
  </tr>
  <tr>
    <td height="41" bgcolor="#F7F7F7"><span id="hello">
      <?php show_welcome();?>
      </span> <span class="info">����༶��</span><?php echo $arr_design['Class_id'];?> <span class="info">��ʼѡ��ʱ�䣺</span><?php echo $arr_design['S_time'];?> <span class="info">��ֹѡ��ʱ�䣺</span><?php echo $arr_design['E_time'];?> <span class="info">״̬��</span>
      <marquee direction="up"  width="150" height="20" scrollamount="2" scrolldelay="2">
        <span class="status">
          <?php 
		if($current_time<$s_time)
			echo "ѡ��δ��ʼ";
		elseif($current_time>=$e_time)
			echo "�ѽ�ֹѡ��";
		else
			echo "ѡ�������&hellip;&hellip;";
		?>
      </span>
      </marquee></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">
<?php 
		if($current_time>=$s_time&&$current_time<$e_time)
		{
?>
       <?php echo $comment;?> <br>
      <div id="finish">
      		 <br>
             <?php //���Ƕӳ����ִ�������ѡ���Ŷӵ���Ŀ��������ѡ�����
						if($isleader==0&&$obj==2)
						{
							echo "�����Ǻ����ŶӵĶӳ������ܸ�ѡ�Ŷ���Ŀ<br>";
							echo "<a href='ObjectDesign_1.php?cid=<?php echo $cid;?>'><img src='pics/reselect.png'></a>";
						}
						else
						{?>
            <form action="ObjectDesign_selection_title.php" id="form1" name="form1" method="post">
			<?php if($obj==1&&$coperator_num==0)	//������ѡ��
						{
							echo "<input type='hidden' id='obj' name='obj' value='1'>";	//��ɷ�ʽΪ1������)
							echo "<input type='hidden' id='sobj' name='sobj' value='0'>";	//ѡ������Ϊ0����ѡ)
							echo "<input type='hidden' id='oteam' name='oteam' value='0'>";	//���Ŷ�Ϊ0��δ�Ӷ�)
						}
						if($obj==1&&$coperator_num>=1) //�����˳��Ŷӣ�����ѡ�ⵥ��,���ֶӳ����Ա
						{	
							if($isleader==0)
								echo "<span class='comment'>�����ȷ��ѡ�⣬������������µ�ѡ�⡣</span>";
							if($isleader==1)
								echo "<span class='comment'>�����ŶӸ����ˣ������ȷ����������µ�ѡ�⣬��ԭ�����Ŷӽ�����ɢ��ÿ�˶����������Լ�ԭ�����Ŷ�ѡ�⡣</span>";
							echo "<input type='hidden' id='obj' name='obj' value='1'>";	//��ɷ�ʽΪ1������)
							echo "<input type='hidden' id='sobj' name='sobj' value='1'>";	//ѡ�ⷽʽΪ1����ѡ)
							echo "<input type='hidden' id='oteam' name='oteam' value='1'>";	//���Ŷ�Ϊ1���ѼӶ�)
							echo "<input type='hidden' id='odtid' name='odtid' value='".$s_d_id."'>";	//��ѡ���
							echo "<input type='hidden' id='leader' name='leader' value='".$isleader."'>";	//��ѡ���
						}
						if($obj==2&&$coperator_num==0)	//�Ŷ���ѡ��
						{
							echo "<span class='comment'>����ѡ�����ĺ������ѣ�ע������������Ŀʣ��������ᵼ�����ǵ�ѡ��ʧ�ܣ�</span>";
							echo "<input type='hidden' id='obj' name='obj' value='2'>";	//��ɷ�ʽΪ2������)
							echo "<input type='hidden' id='sobj' name='sobj' value='0'>";	//ѡ�ⷽʽΪ0����ѡ)
							echo "<input type='hidden' id='oteam' name='oteam' value='0'>";	//���Ŷ�Ϊ0��δ�Ӷ�)
							echo "<br/>";
							//���ȫ�໹û��ѡ���ѧ���������ṩѡ��,��Ҫ�г���½������
							$classid=substr($_SESSION['s_id'],0,6);
							$sqls_names="select s_id,s_name from students where  s_id not in(select S_id from stu_design_titles where Class_id ='".$classid."') and s_class='".$classid."' order by s_id asc";
							$rs_names=mysql_query($sqls_names,$conn);
							if(mysql_num_rows($rs_names)>0)
							{
								$num_names=mysql_num_rows($rs_names);
								for($i=0;$i<$num_names;$i++)
								{
									$tmp=mysql_fetch_array($rs_names);
									if($tmp['s_id']!=$_SESSION['s_id']){
									echo "<dl id='namelist'><dd>";
									echo "<label><input type='checkbox' name='cop[]' id='cop[]' value='".$tmp['s_id']."-".$tmp['s_name']."'>";
									echo $tmp['s_id']."---".$tmp['s_name'];
									echo "</label></dd></dl>";}
								}
								mysql_free_result($rs_names);
							}
							else
							{
								echo "��û��ѧ����������ӣ�������ѡ�������ɿγ����<br>";
								echo "����";
							}
						}
						if($obj==2&&$coperator_num>1)	//�Ŷ��� ѡ��
						{
							echo "<span class='comment'>�����ȷ��ѡ�⣬�����ڵ��Ŷӳ�Ա����ͬ����Ϊ�µ�ѡ�⡣</span>";
							echo "<input type='hidden' id='obj' name='obj' value='2'>";	//��ɷ�ʽΪ2������)
							echo "<input type='hidden' id='sobj' name='sobj' value='1'>";	//ѡ�ⷽʽΪ1����ѡ)
							echo "<input type='hidden' id='oteam' name='oteam' value='1'>";	//���Ŷ�Ϊ1���ѼӶ�)
							echo "<input type='hidden' id='odtid' name='odtid' value='".$s_d_id."'>";	//��ѡ���
						}
						if($obj==2&&$coperator_num==1)	//���˼������Ŷӣ�������������
						{
							
							echo "<p id='cannot'>�����Զ�����ɵķ�ʽ���ѡ�⣬���������ŶӺ�����ʽ����ѡ�⣡</p>";
							echo "<a href='ObjectDesign_1.php?cid=".$cid."'><img src='pics/reselect.png'></a>";
						}
			if(!($obj==2&&$coperator_num==1)){
			?>
			<table border="0" align="center" cellpadding="0" cellspacing="1" id="ask">
            <tr>
            <td colspan="4" align="center">
            <?php //�����ѡ��Ŀ����Ϣ
			$sqls_design_title="select DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
			$rs_design_title=mysql_query($sqls_design_title,$conn);
			$arr_design_title=mysql_fetch_array($rs_design_title);
			$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
            echo "��".$arr_design_title['DT_title']."����ǰ����".$y."��ѡ����� ��ȷ��Ҫѡ�������Ϊ�γ������Ŀ��";
			mysql_free_result($rs_design_title);
			?>
            </td>
            </tr>
              <tr>
                <td width="33%" height="54"><input type="hidden" id="dtid" name="dtid" value="<?php echo $dtid;?>">
                <input type="hidden" id="courseid" name="courseid" value="<?php echo $couseid;?>">
                </td>
                <td width="25%"><input type='submit' name='start_now'  id='start_now' value='ȷ��ѡ��' class='tj'></td>
                <td width="16%"><a href="ObjectDesign_1.php?cid=<?php echo $cid;?>"><img src="pics/reselect.png"></a></td>
                <td width="26%">&nbsp;</td>
              </tr>
</table><?php }?>
           </form>
		  <?php }?>
       </div>
      <?php }	else
			header("location:ObjectDesign_1.php");
	?>
 </td>
  </tr>
</table>
<br />
<?php require("about.html");?>
