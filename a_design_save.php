<style type="text/css">
a:link{
	font-size:12px;
	color:#066;
	background-color:#E7F5EC;
	border:1px solid #366;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	padding-top:5px;
	text-decoration:none;
}
a:hover{
		font-size:12px;
	color:#930;
	background-color:#CC6;
	border:1px solid #366;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	padding-top:5px;

}
a:visited{
		font-size:12px;
	color:#066;
	background-color:#E7F5EC;
	border:1px solid #366;
	padding-bottom:2px;
	padding-left:5px;
	padding-right:5px;
	padding-top:2px;

}
</style>
<?php
/////////////�γ���Ʊ���========================
	//��ȡѧ����ҵid��
	session_start();
	$arr_cid=array();	//�γ�ID������
	$dname=$_POST['d_name'];//�γ��������
	$stime=$_POST['stime'];	//��ʼѡ��ʱ��
	$etime=$_POST['etime'];//����ѡ��ʱ��
	$deal_false=0;	//����ʧ�ܵ�����
	$deal_sucess=0;	//����ɹ�������
	require("db_connect.php");
	mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
	require('term.php');
	if(isset($_GET['did']))	//������޸�ҳ������������
	{
		$DID=$_GET['did'];
		$id=$_POST['cname'];
		$tmp=explode("#",$id);
		$sqls="update course_design set D_name='".$dname."',C_id=".$tmp[0].",S_time='".$stime."',E_time='".$etime."',Class_id='".$tmp[1]."',D_teacher='".$_SESSION['a_name']."' where D_ID=".$DID;
		$rs=mysql_query($sqls,$conn);
	}
	else
	{
		foreach($_POST['cname'] as $id)
		{
			if($id!="")
			{
				array_push($arr_cid,$id);	//��ջ
			}
		}

		foreach($arr_cid as $key=>$id)		//�������ݱ���is_deal�ֶ�
		{
			$tmp=explode("#",$id);
			$term=term($tmp[1]);
			$sqls="insert into course_design(D_name,C_id,S_time,E_time,Class_id,D_teacher,term)values('".$dname."',".$tmp[0].",'".$stime."','".$etime."','".$tmp[1]."','".$_SESSION['a_name']."',".$term.")";
			$rs=mysql_query($sqls,$conn);
			if(!$rs)
			{
				$deal_false+=1;
			}
			else
			{
				$deal_sucess+=1;
			}
		}
	}
		//���ش�����
?>
<style type="text/css">
#tis {
	font-size: 12px;
	color: #066;
	text-decoration: none;
	border: 1px solid #CCC;
}
</style>

<table width="600" height="214" border="0" align="center" cellpadding="0" cellspacing="0" id="tis">
  <tr>
    <td height="35" align="center" bgcolor="#FFFFCC">������ʾ</td>
  </tr>
  <tr>
    <td height="142">
    <?php if(!isset($DID)){?>
    һ���γ������Ŀ������ɣ���Ӧ����<span style="font-weight:bold; color:#900";><?php echo count($arr_cid);?>��</span>�༶���ɹ�<span style="font-weight:bold; color:#900";><?php echo $deal_sucess;?>��</span>��ʧ��<span style="font-weight:bold; color:#900";><?php echo $deal_false;?>��</span>��
    <?php } else {?>
    <span style="font-weight:bold; color:#900";><?php if($rs) echo "һ���γ������Ŀ�޸���ɡ�";else echo "�γ���Ŀ�޸�ʧ��";?></span>
    <?php }?>
    </td>
  </tr>
  <tr>
    <td height="37" align="center" bgcolor="#CCCCCC"><a href="a_design_list.php">����</a></td>
  </tr>
</table>
