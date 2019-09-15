<style type="text/css">
#chart_main {
	height:450px;
	width: 700px;
	background-color:#FFFFD2;
	border: 1px solid #CCC;
	margin-right:0px;
	float:left;
}
#datas
{
	width:250px;
	height:450px;
	background-color:#FFFFD9;
	display:inline-block;
	margin-left:0px;
	padding-top:10px;
	padding-left:15px;
	padding-right:15px;
	font-size:16px;
	color:#606;
	line-height:30px;
}
#reback
{
	text-align:right;
	padding-right:50px;
	background-color:#66F;
	height:22px;
	margin-top:10px;
}
</style>
<link href="css.css" rel="stylesheet" type="text/css">
<script src="echarts.js"></script>

<?php
//统计每次作业的数据，并以统计图的形式显示
session_start();
	require("db_connect.php");
	if(isset($_GET['wid'])&&isset($_GET['wname']))
	{
		$wid=$_GET['wid'];
		$wname=$_GET['wname'];
	}
	else
		{
			echo "错误参数传入，处理中止……";
			exit;
		}
	$sqls="select is_deal as score, count(id) as num from stu_works where w_id=".$wid." group by score  order by score asc";
	$rs=mysql_query($sqls,$conn);
	$arr_cjdj=array('雷同','无效','差评','合格','中等','良好','优秀');	//成绩等级
	$arr_djrs=array(0,0,0,0,0,0,0);//各等级人数
	if($rs && mysql_num_rows($rs)>0)
	{
		$rows=mysql_num_rows($rs);
		for($i=0;$i<$rows;$i++)
		{
			$arr_tmp=mysql_fetch_array($rs,MYSQL_ASSOC);
			switch($arr_tmp['score'])
			{
				case 0:
					$arr_djrs[0]=$arr_tmp['num'];	//雷同人数
					break;
				case 1:
					$arr_djrs[1]=$arr_tmp['num'];	//无效人数
					break;
				case 50:
					$arr_djrs[2]=$arr_tmp['num'];	//差评人数
					break;
				case 60:
					$arr_djrs[3]=$arr_tmp['num'];	//合格人数=平
					break;
				case 70:
					$arr_djrs[4]=$arr_tmp['num'];	//中等
					break;
				case 85:
					$arr_djrs[5]=$arr_tmp['num'];	//良好
					break;
				case 95:
					$arr_djrs[6]=$arr_tmp['num'];	//优秀
					break;
				case 101:	//未评分
					$arr_djrs=array(0,0,0,0,0,0,0);
			}
		}
		//由于json只支持utf8编码，因此先将成绩等级转换为utf8
		$total_num=0;		//总提交人数
		for($i=0;$i<count($arr_cjdj);$i++)
		{
				$total_num+=$arr_djrs[$i];
				$fileType=mb_detect_encoding($arr_cjdj[$i],array('UTF-8','GBK','ASCII','BIG5'));
				if( $fileType != 'UTF-8')
					{ $arr_cjdj[$i]= mb_convert_encoding($arr_cjdj[$i] ,'UTF-8' , $fileType);}
			}
		//转为json格式,以为echarts使用
		$json_dj=json_encode($arr_cjdj);
		$json_rs=json_encode($arr_djrs);
		mysql_free_result($rs);
		unset($arr_cjdj);
	}
	else
	{
			echo "暂未收到本题的学生作业<br>";
			echo "<a href=".$_SESSION['url'].">返回</a>";
			exit;
	}
?>
<div id="chart_main" ></div>
<div id="datas"> 已交：<label style=" font-size:18px; color:#003;"><?php echo $total_num;?></label>人&nbsp;&nbsp;未交：<label style=" font-size:18px; color:#003;"><?php echo ($_SESSION['zrs']-$total_num);?></label>人<br>
  <table width="100%" height="300" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" bgcolor="#FFCC99">等级</td>
      <td align="center" bgcolor="#FFCC99">人数</td>
      <td align="center" bgcolor="#FFCC99">比例</td>
    </tr>
    <tr>
      <td width="28%" align="center">雷同</td>
      <td width="40%" align="center"><?php echo $arr_djrs[0];?></td>
      <td width="32%" align="center"><?php $p=($arr_djrs[0]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">无效</td>
      <td align="center"><?php echo $arr_djrs[1];?></td>
      <td align="center"><?php $p=($arr_djrs[1]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">差评</td>
      <td align="center"><?php echo $arr_djrs[2];?></td>
      <td align="center"><?php $p=($arr_djrs[2]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">合格</td>
      <td align="center"><?php echo $arr_djrs[3];?></td>
      <td align="center"><?php $p=($arr_djrs[3]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">中等</td>
      <td align="center"><?php echo $arr_djrs[4];?></td>
      <td align="center"><?php $p=($arr_djrs[4]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">良好</td>
      <td align="center"><?php echo $arr_djrs[5];?></td>
      <td align="center"><?php $p=($arr_djrs[5]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">优秀</td>
      <td align="center"><?php echo $arr_djrs[6];?></td>
      <td align="center"><?php $p=($arr_djrs[6]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
  </table>
</div>

<script type="text/javascript">
var mychart=echarts.init(document.getElementById('chart_main'));
option = {
    title : {
        text: '<?php echo "[".$wname.']数据图';?>',
        //subtext: '共人提交'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['人数']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: false, readOnly: false},
            magicType : {show: false, type: ['line', 'bar']},
            restore : {show: false},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : <?php echo $json_dj;?>
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'人数',
            type:'bar',
            data:<?php echo $json_rs;?>,
            markPoint : {
                data : [
                    {type : 'max', name: '最大值'},
                    {type : 'min', name: '最小值'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: '平均值'}
                ]
            }
        },
    ]
};
mychart.setOption(option);
</script>
<div id="reback"><a href="<?php echo $_SESSION['url'];?>">返回</a></div>