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
	mysql_query("SET NAMES 'gb2312'");	//数据输出与文档编码一致
	require('session.php');
	check_session();
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$_SESSION['url']=$url;	//记住 url
	require('url_deal.php');
	$obj=url_deal($_GET['obj']);
	$dtid=url_deal($_GET['dtid']);	//选题编号
	$cid=url_deal($_GET['cid']);	//班级
	$couseid=$_SESSION['courseid'];
	$sqls="select * from course_design where C_id=".$couseid;
	$rs_design=mysql_query($sqls,$conn);
	$arr_design=mysql_fetch_array($rs_design);
	$current_time=time();	//当前时间
	$s_time=strtotime($arr_design['S_time']);	//开始时间
	$e_time=strtotime($arr_design['E_time']);	//结束时间
	$isleader=1;	//默认为队长
	mysql_free_result($rs_design);
	//每个学生决定自己的选题之前，先检查该 生是否已选题，是否已与其它学生合作或被其它学生选为合作
	//并允许该生退出合作或者重新选择自己的选题
	$sqls_s_d_t="select * from stu_design_titles where coperator_id='".$_SESSION['s_id']."'";
	$rs_s_d_t=mysql_query($sqls_s_d_t,$conn);
	$coperators=array();	//合作者名单
	$s_d_title="";//登陆学生已选的题目
	$s_d_id="";//已选题目的ID
	$coperator_num=0;//合作者初始数量为0
	$comment="";//提示信息
	if($rs_s_d_t&&mysql_num_rows($rs_s_d_t)>0)
	{
			$isleader=1;
			$coperator_num=mysql_num_rows($rs_s_d_t);	//合作者数量，1为自己独立完成
			for($i=0;$i<$coperator_num;$i++)
			{
				$arr_s_d_t=mysql_fetch_array($rs_s_d_t);	//登陆学生的选题信息
				$coperators[$i]=$arr_s_d_t['S_name'];
				$s_d_id=$arr_s_d_t['DT_id'];
			}
			$sqls_dt="select * from design_titles where DT_id=".$s_d_id;
			$rs_dt=mysql_query($sqls_dt,$conn);
			$arr_dt=mysql_fetch_array($rs_dt);	//已选课题信息
			$s_d_title=$arr_dt['DT_title'];	//保存题目名称
			mysql_free_result($rs_dt);
			//根据已选课题情况，保存提示信息
			if($coperator_num==1)
				$comment= "您已经选择了《".$s_d_title."》作为独立完成的课程设计题目。";
			else
			{
				$comment="<p class='comment'>您已经选择了《".$s_d_title."》</span>题目，以团队合作方式与其它同学共同完成。";
				$comment.="<br>您的团队成员分别是：<span style='color:#f00'>";
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
	{	//如果原来是团队一员，且不是队长，就要根据s_id来查询才能确定
		$sqls_s_d_t="select * from stu_design_titles where s_id='".$_SESSION['s_id'];
		$rs_s_d_t=mysql_query($sqls_s_d_t,$conn);
		if(!$rs_s_d_t||mysql_num_rows($rs_s_d_t)==0)
			$comment="您从未进行过任何选题操作，请尽快完成选题！";	
		else
		{
			$isleader=0;	//不是队长，
			$coperator_num=1;
			$arr_stu_design_titles=mysql_fetch_array($rs_s_d_t);
			$comment="您属于【".$arr_stu_design_titles['coperator_name']."】团队的成员，所选题目为".$arr_stu_design_titles['DT_title'];
			mysql_free_result($rs_s_d_t);
		}
	}
?>
<table width="1200" height="285" border="0" align="center" cellpadding="10" cellspacing="1" id="dinfo">
  <tr>
    <td height="43" bgcolor="#DBECFE"><span class="biaoti">课程设计基本信息》<?php echo $arr_design['D_name'];?>》
    <?php if ($obj==1)echo "独立完成选题";else echo "合作完成选题";?>
    </span></td>
  </tr>
  <tr>
    <td height="41" bgcolor="#F7F7F7"><span id="hello">
      <?php show_welcome();?>
      </span> <span class="info">面向班级：</span><?php echo $arr_design['Class_id'];?> <span class="info">开始选题时间：</span><?php echo $arr_design['S_time'];?> <span class="info">截止选题时间：</span><?php echo $arr_design['E_time'];?> <span class="info">状态：</span>
      <marquee direction="up"  width="150" height="20" scrollamount="2" scrolldelay="2">
        <span class="status">
          <?php 
		if($current_time<$s_time)
			echo "选题未开始";
		elseif($current_time>=$e_time)
			echo "已截止选题";
		else
			echo "选题进行中&hellip;&hellip;";
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
             <?php //不是队长，又打算重新选择团队的题目，不允许选题操作
						if($isleader==0&&$obj==2)
						{
							echo "您不是合作团队的队长，不能改选团队题目<br>";
							echo "<a href='ObjectDesign_1.php?cid=<?php echo $cid;?>'><img src='pics/reselect.png'></a>";
						}
						else
						{?>
            <form action="ObjectDesign_selection_title.php" id="form1" name="form1" method="post">
			<?php if($obj==1&&$coperator_num==0)	//个人新选题
						{
							echo "<input type='hidden' id='obj' name='obj' value='1'>";	//完成方式为1（独立)
							echo "<input type='hidden' id='sobj' name='sobj' value='0'>";	//选题类型为0（新选)
							echo "<input type='hidden' id='oteam' name='oteam' value='0'>";	//旧团队为0（未加队)
						}
						if($obj==1&&$coperator_num>=1) //个人退出团队，重新选题单干,区分队长与队员
						{	
							if($isleader==0)
								echo "<span class='comment'>如果您确定选题，您将独立完成新的选题。</span>";
							if($isleader==1)
								echo "<span class='comment'>您是团队负责人，如果您确定独立完成新的选题，您原来的团队将被解散，每人都需独立完成自己原来的团队选题。</span>";
							echo "<input type='hidden' id='obj' name='obj' value='1'>";	//完成方式为1（独立)
							echo "<input type='hidden' id='sobj' name='sobj' value='1'>";	//选题方式为1（重选)
							echo "<input type='hidden' id='oteam' name='oteam' value='1'>";	//旧团队为1（已加队)
							echo "<input type='hidden' id='odtid' name='odtid' value='".$s_d_id."'>";	//旧选题号
							echo "<input type='hidden' id='leader' name='leader' value='".$isleader."'>";	//旧选题号
						}
						if($obj==2&&$coperator_num==0)	//团队新选题
						{
							echo "<span class='comment'>请先选择您的合作队友（注：人数超过题目剩余名额，将会导致你们的选题失败）</span>";
							echo "<input type='hidden' id='obj' name='obj' value='2'>";	//完成方式为2（合作)
							echo "<input type='hidden' id='sobj' name='sobj' value='0'>";	//选题方式为0（新选)
							echo "<input type='hidden' id='oteam' name='oteam' value='0'>";	//旧团队为0（未加队)
							echo "<br/>";
							//输出全班还没有选题的学生名单，提供选择,不要列出登陆者自已
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
								echo "已没有学生可与你组队，请重新选择独立完成课程设计<br>";
								echo "返回";
							}
						}
						if($obj==2&&$coperator_num>1)	//团队重 选题
						{
							echo "<span class='comment'>如果你确定选题，你所在的团队成员都将同步变为新的选题。</span>";
							echo "<input type='hidden' id='obj' name='obj' value='2'>";	//完成方式为2（合作)
							echo "<input type='hidden' id='sobj' name='sobj' value='1'>";	//选题方式为1（重选)
							echo "<input type='hidden' id='oteam' name='oteam' value='1'>";	//旧团队为1（已加队)
							echo "<input type='hidden' id='odtid' name='odtid' value='".$s_d_id."'>";	//旧选题号
						}
						if($obj==2&&$coperator_num==1)	//个人加入新团队，不允许该项操作
						{
							
							echo "<p id='cannot'>您已以独立完成的方式完成选题，不能再以团队合作方式重新选题！</p>";
							echo "<a href='ObjectDesign_1.php?cid=".$cid."'><img src='pics/reselect.png'></a>";
						}
			if(!($obj==2&&$coperator_num==1)){
			?>
			<table border="0" align="center" cellpadding="0" cellspacing="1" id="ask">
            <tr>
            <td colspan="4" align="center">
            <?php //查出所选题目的信息
			$sqls_design_title="select DT_title,DT_takers,DT_taked from design_titles where DT_id=".$dtid;
			$rs_design_title=mysql_query($sqls_design_title,$conn);
			$arr_design_title=mysql_fetch_array($rs_design_title);
			$y=$arr_design_title['DT_takers']-$arr_design_title['DT_taked'];
            echo "《".$arr_design_title['DT_title']."》当前还有".$y."个选题名额， 您确定要选择该题作为课程设计题目吗？";
			mysql_free_result($rs_design_title);
			?>
            </td>
            </tr>
              <tr>
                <td width="33%" height="54"><input type="hidden" id="dtid" name="dtid" value="<?php echo $dtid;?>">
                <input type="hidden" id="courseid" name="courseid" value="<?php echo $couseid;?>">
                </td>
                <td width="25%"><input type='submit' name='start_now'  id='start_now' value='确定选题' class='tj'></td>
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
