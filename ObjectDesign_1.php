<title>三金作业管理系统&mdash;&mdash;课程设计</title>
<style type="text/css">
#dinfo {
	font-size: 12px;
	color: #066;
	text-decoration: none;
	background-color: #CCC;
	font-weight:bolder;
	line-height:20px;
}
.biaoti{
	font-size:16px;
	color:#03C;
}
.info{
	color:#F00;
	padding-left:10px;
	padding-right:10px;
}
.status{
	font-size:16px;
	color:#C09;
	font-weight:bold;
}
.comment{
	font-size:14px;
	background-color:#FF9;
	padding-bottom:5px;
	padding-left:5px;
	padding-right:5px;
	padding-top:5px;
	color:#F00;
	font-weight:normal;
}
dt{
	display:inline-block;
	margin-top:30px;
	margin-bottom:20px;
	padding-left:50px;
	padding-right:50px;
}
#finish{
	width:100%;
	margin:5 auto;
	text-align:center;
}
#dinfo tr td #finish #design_titles {
	font-size: 13px;
	line-height: normal;
	color: #609;
	text-decoration: none;
	background-color: #DBECFE;
}
</style>
<?php
	require('session.php');
	require('url_deal.php');
	require('db_connect.php');
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	check_session();
	$couseid=url_deal($_GET['cid']);	//课程ID
	$_SESSION['courseid']=$couseid;
	$sqls="select * from course_design where C_id=".$couseid;
	$rs_design=mysql_query($sqls,$conn);
	$arr_design=mysql_fetch_array($rs_design);
	$current_time=time();	//当前时间
	$s_time=strtotime($arr_design['S_time']);	//开始时间
	$e_time=strtotime($arr_design['E_time']);	//结束时间
	mysql_free_result($rs_design);
?>
<table width="1200" height="869" border="0" align="center" cellpadding="10" cellspacing="1" id="dinfo">
  <tr>
    <td height="43" bgcolor="#DBECFE"><span class="biaoti">课程设计基本信息》<?php echo $arr_design['D_name'];?></span></td>
  </tr>
  <tr>
    <td height="41" bgcolor="#F3F3F3">
   <span id="hello"> <?php show_welcome();?></span>
    <span class="info">面向班级：</span><?php echo $arr_design['Class_id'];?> 
    <span class="info">开始选题时间：</span><?php echo $arr_design['S_time'];?>
    <span class="info">截止选题时间：</span><?php echo $arr_design['E_time'];?>
    <span class="info">状态：</span>
    <marquee direction="up"  width="150" height="20" scrollamount="2" scrolldelay="2">
        <span class="status">
        <?php 
		if($current_time<$s_time)
			echo "选题未开始";
		elseif($current_time>=$e_time)
			echo "已截止选题";
		else
			echo "选题进行中……";
		?>
        </span>
    </marquee>
    </td>
  </tr>
  <tr>
    <td height="781" valign="top" bgcolor="#FFFFFF">
    <?php 
	 if($current_time<$s_time){?>
         <div id="finish">
    	<dt> <img src="pics/earlier.jpg" border="0"> </dt></div>
<?php
	 }
		if(($current_time>=$s_time&&$current_time<$e_time)||$current_time<$s_time)
		{
			?>
            <span class="comment">
    说明:选择【选题方式】为&ldquo;合作完成&rdquo;同学，如果合作人数超过选题的&ldquo;剩余名额&rdquo;，将导致选题失败。
    下表中的数据，仅代表您浏览时的数据状态。 </span><p><?php }?>
    <div id="finish">
    <?php 	//列出全部选题情况
		$sqls_design_title="select * from design_titles where D_id=".$arr_design['D_ID'];
		$rs_design_titles=mysql_query($sqls_design_title,$conn);
		if(mysql_num_rows($rs_design_titles)==0)
				echo "教师暂未发布任何选题列表，请稍后操作……";
		else
			{
				$num_design_titles=mysql_num_rows($rs_design_titles);?>
				<table width="100%" height="88" border="0" align="center" cellpadding="0" cellspacing="1" id="design_titles">
                  <tr>
                    <td width="3%" height="39" align="center" bgcolor="#C0E0D9">序号</td>
                    <td width="30%" align="center" bgcolor="#C0E0D9">题目</td>
                    <td width="4%" align="center" bgcolor="#C0E0D9">加分值</td>
                    <td width="3%" align="center" bgcolor="#C0E0D9">可选人数</td>
                    <td width="3%" align="center" bgcolor="#C0E0D9">已选人数</td>
                    <td width="3%" align="center" bgcolor="#C0E0D9">剩余名额</td>
                    <td width="23%" align="center" bgcolor="#C0E0D9">已选名单</td>
                    <td width="8%" align="center" bgcolor="#C0E0D9">选题详情</td>
                    <td width="23%" align="center" bgcolor="#C0E0D9">选题方式</td>
                  </tr>
             <?php for($i=0;$i<$num_design_titles;$i++){
				 			$arr_design_titles=mysql_fetch_array($rs_design_titles);
							if($i%2==0)
								echo "<tr bgcolor='#EFF8F4'>";
							else
								echo "<tr>";
				?>
                    <tr>
                      <td align="center" bgcolor="#F3EDED"><?php $j=$i+1;echo $j;?></td>
                    <td align="left" bgcolor="#FFFFFF"><?php echo $arr_design_titles['DT_title'];?></td>
                    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_design_titles['DT_bonus'];?></td>
                    <td align="center" bgcolor="#F3EDED"><?php echo $arr_design_titles['DT_takers'];?></td>
                    <td align="center" bgcolor="#FFFFFF"><?php echo $arr_design_titles['DT_taked'];?></td>
                    <td align="center" bgcolor="#F3EDED"><?php $j=$arr_design_titles['DT_takers']-$arr_design_titles['DT_taked'];echo $j;?></td>
                    <td align="center" bgcolor="#FFFFFF">
					<?php //已选名单
                    $sqls_stu_design_title="select  distinct S_name from stu_design_titles where DT_id=".$arr_design_titles['DT_id'];
					$rs_stu_design_title=mysql_query($sqls_stu_design_title,$conn);
					if(mysql_num_rows($rs_stu_design_title)!=0){
							$num_stu_design_title=mysql_num_rows($rs_stu_design_title);
							for($n=0;$n<$num_stu_design_title;$n++)
							{
								$arr_stu_design_title=mysql_fetch_array($rs_stu_design_title);
								echo $arr_stu_design_title['S_name']."&nbsp;";
							}
							mysql_free_result($rs_stu_design_title);
					}
					else
						echo "无";
					?>
                    </td>
                    <td align="center" bgcolor="#FFFFFF"><a href="ObjectDesign_info.php?did=<?php echo $arr_design['D_ID'];?>&dtid=<?php echo $arr_design_titles['DT_id'];?>" target="_blank"><img src="pics/more.jpg" width="71" height="26" /></a></td>
                    <td align="center" bgcolor="#FFFFFF">
                   <?php  if($current_time>=$s_time&&$current_time<$e_time)
				   {?>
                    <a href="ObjectDesign_2.php?obj=1&dtid=<?php echo $arr_design_titles['DT_id'];?>&cid=<?php echo $couseid;?>"> <img src="pics/sign.png" width="118" height="28" /></a>
                   &nbsp;
                    <a href="ObjectDesign_2.php?obj=2&dtid=<?php echo $arr_design_titles['DT_id'];?>&cid=<?php echo $couseid;?>"><img src="pics/coper.png" width="118" height="28" /></a>
                  <?php }?>
                    </td>
                  </tr>
               <?php }?>
                </table>

		<?php 	mysql_free_result($rs_design_titles);
			}
		if($current_time>=$e_time){
	?>
    <div id="finish">
    	<dt> <img src="pics/late.jpg" border="0"> </dt></div>
     <?php }
	?>
    </td>
  </tr>
</table>
<br />
<?php require("about.html");?>
