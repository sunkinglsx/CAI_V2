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
//ͳ��ÿ����ҵ�����ݣ�����ͳ��ͼ����ʽ��ʾ
session_start();
	require("db_connect.php");
	if(isset($_GET['wid'])&&isset($_GET['wname']))
	{
		$wid=$_GET['wid'];
		$wname=$_GET['wname'];
	}
	else
		{
			echo "����������룬������ֹ����";
			exit;
		}
	$sqls="select is_deal as score, count(id) as num from stu_works where w_id=".$wid." group by score  order by score asc";
	$rs=mysql_query($sqls,$conn);
	$arr_cjdj=array('��ͬ','��Ч','����','�ϸ�','�е�','����','����');	//�ɼ��ȼ�
	$arr_djrs=array(0,0,0,0,0,0,0);//���ȼ�����
	if($rs && mysql_num_rows($rs)>0)
	{
		$rows=mysql_num_rows($rs);
		for($i=0;$i<$rows;$i++)
		{
			$arr_tmp=mysql_fetch_array($rs,MYSQL_ASSOC);
			switch($arr_tmp['score'])
			{
				case 0:
					$arr_djrs[0]=$arr_tmp['num'];	//��ͬ����
					break;
				case 1:
					$arr_djrs[1]=$arr_tmp['num'];	//��Ч����
					break;
				case 50:
					$arr_djrs[2]=$arr_tmp['num'];	//��������
					break;
				case 60:
					$arr_djrs[3]=$arr_tmp['num'];	//�ϸ�����=ƽ
					break;
				case 70:
					$arr_djrs[4]=$arr_tmp['num'];	//�е�
					break;
				case 85:
					$arr_djrs[5]=$arr_tmp['num'];	//����
					break;
				case 95:
					$arr_djrs[6]=$arr_tmp['num'];	//����
					break;
				case 101:	//δ����
					$arr_djrs=array(0,0,0,0,0,0,0);
			}
		}
		//����jsonֻ֧��utf8���룬����Ƚ��ɼ��ȼ�ת��Ϊutf8
		$total_num=0;		//���ύ����
		for($i=0;$i<count($arr_cjdj);$i++)
		{
				$total_num+=$arr_djrs[$i];
				$fileType=mb_detect_encoding($arr_cjdj[$i],array('UTF-8','GBK','ASCII','BIG5'));
				if( $fileType != 'UTF-8')
					{ $arr_cjdj[$i]= mb_convert_encoding($arr_cjdj[$i] ,'UTF-8' , $fileType);}
			}
		//תΪjson��ʽ,��Ϊechartsʹ��
		$json_dj=json_encode($arr_cjdj);
		$json_rs=json_encode($arr_djrs);
		mysql_free_result($rs);
		unset($arr_cjdj);
	}
	else
	{
			echo "��δ�յ������ѧ����ҵ<br>";
			echo "<a href=".$_SESSION['url'].">����</a>";
			exit;
	}
?>
<div id="chart_main" ></div>
<div id="datas"> �ѽ���<label style=" font-size:18px; color:#003;"><?php echo $total_num;?></label>��&nbsp;&nbsp;δ����<label style=" font-size:18px; color:#003;"><?php echo ($_SESSION['zrs']-$total_num);?></label>��<br>
  <table width="100%" height="300" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" bgcolor="#FFCC99">�ȼ�</td>
      <td align="center" bgcolor="#FFCC99">����</td>
      <td align="center" bgcolor="#FFCC99">����</td>
    </tr>
    <tr>
      <td width="28%" align="center">��ͬ</td>
      <td width="40%" align="center"><?php echo $arr_djrs[0];?></td>
      <td width="32%" align="center"><?php $p=($arr_djrs[0]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">��Ч</td>
      <td align="center"><?php echo $arr_djrs[1];?></td>
      <td align="center"><?php $p=($arr_djrs[1]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">����</td>
      <td align="center"><?php echo $arr_djrs[2];?></td>
      <td align="center"><?php $p=($arr_djrs[2]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">�ϸ�</td>
      <td align="center"><?php echo $arr_djrs[3];?></td>
      <td align="center"><?php $p=($arr_djrs[3]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">�е�</td>
      <td align="center"><?php echo $arr_djrs[4];?></td>
      <td align="center"><?php $p=($arr_djrs[4]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">����</td>
      <td align="center"><?php echo $arr_djrs[5];?></td>
      <td align="center"><?php $p=($arr_djrs[5]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
    <tr>
      <td align="center">����</td>
      <td align="center"><?php echo $arr_djrs[6];?></td>
      <td align="center"><?php $p=($arr_djrs[6]/$total_num)*100;printf("%.2f%%",$p);?></td>
    </tr>
  </table>
</div>

<script type="text/javascript">
var mychart=echarts.init(document.getElementById('chart_main'));
option = {
    title : {
        text: '<?php echo "[".$wname.']����ͼ';?>',
        //subtext: '�����ύ'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['����']
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
            name:'����',
            type:'bar',
            data:<?php echo $json_rs;?>,
            markPoint : {
                data : [
                    {type : 'max', name: '���ֵ'},
                    {type : 'min', name: '��Сֵ'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: 'ƽ��ֵ'}
                ]
            }
        },
    ]
};
mychart.setOption(option);
</script>
<div id="reback"><a href="<?php echo $_SESSION['url'];?>">����</a></div>