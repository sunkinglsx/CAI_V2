<style type="text/css">
#login {
	background-color: #9CF;
	height: 210px;
	width: 500px;
	margin-top: -105px;	/*�����Ǹ߶ȵĸ�һ��*/
	margin-left: -250px;	/*����ǿ�ȵĸ�һ��*/
	position: absolute;
	left: 50%;
	top: 50%;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=5);
	box-shadow: 2px 2px 10px #909090;	/*IE9��chrome*/
	z-index: 3;
}
#login #t_login {
	background-color: #99F;
	height: 200px;
	width: 500px;
	font-size: 12px;
}
#info {
	font-size: 12px;
	color: #F00;
	height: 16px;
	width: 100px;
	position: absolute;
	left: 372px;
	top: 47px;
}
#c_num {
	font-size: 18px;
	color: #930;
	text-decoration: none;
	background-color: #FFC;
	position: absolute;
	height: 23px;
	width: 100px;
	left: 375px;
	top: 126px;
}
</style>
</head>
<script type="text/javascript">
function check_myform()
{
	var upass=document.getElementById("answer").value;
	var con_num=document.getElementById("email").value
	var reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;			//��������
	var b=con_num.toUpperCase();	//����תΪ��д
	var arr=b.split(".");	//�Ե�Ϊ�ָ��
	var offset=arr.length-1;
	var e_ext=new Array('@QQ.COM','@163.COM','@126.COM','@163.NET','@HOTMAIL.COM','@YAHOO.COM','YEAH.NET','SINA.COM','21CN.COM','SOGOU.COM','EDU.CN','189.CN');
	if(upass=="")
	{
		alert("�������������������");
		document.getElementById("answer").focus();
		return false;
	}
	if(con_num=="")
	{
		alert("���������ĵ������䣬�Ա����������");
		document.getElementById("email").focus();
		return false;
	}
	if(!reg.exec(con_num))
	{
		alert("�������䲻�Ϸ�����������д");
		document.getElementById("email").focus();
		return false;
	}
	for(var i=0;i<e_ext.length;i++)
	{
		if(b.indexOf(e_ext[i])>0)		//����ҵ���ȷ�ĺ�׺,�˳�ѭ��
		{
			break;
		}
	} 
	if(i>=e_ext.length)
	{
			alert("�������䲻��ȷ����������д");
			document.getElementById("email").focus();
			return false;
	}
	if(arr[offset]!="COM"&&arr[offset]!="CN"&&arr[offset]!="NET")
	{
			alert("�������䲻�Ϸ�����������д");
			document.getElementById("email").focus();
			return false;
	}
}
</script>
<body>
<?php 
session_start();
require("db_connect.php");
mysql_query("SET NAMES 'gb2312'");	//����������ĵ�����һ��
function set_token() {		//��������
	$t_arr=array('s','u','n','k','i','n','g','l','s','x','1','2','3','4','5','6','7','8','9','0');
	$str='';
	for($i=0;$i<4;$i++)
	{
		$offset=rand(0,19);
		$str=$str.$t_arr[$offset];
	}
   $_SESSION['token'] = md5($str);
}
function valid_token() {
  $returnstr = $_REQUEST['token'] === $_SESSION['token'] ? true : false;
  set_token();
  return $returnstr;
}
//���tokenΪ��������һ��token
if(!isset($_SESSION['token']) || $_SESSION['token']=='') {
  set_token();
}
if(isset($_POST['button']))
{
	if(!valid_token()){
    echo "�������Ч������������ֹ��";
  }
  else{
	$uid=$_POST['uid'];
	$urole=$_POST['urole'];
	$question=$_POST['question'];
	$answer=$_POST['answer'];
	$email=$_POST['email'];
				mysql_query("SET NAMES 'gbk'");	//�����ݿ�һ��
	if($urole==1)	//��ʦ
		$sqls="update ad_user set question='".$question."',a_answer='".$answer."',email='".$email."' where a_name='".$uid."'";
	elseif($urole==2)
		$sqls="update students set question='".$question."',a_answer='".$answer."',email='".$email."' where s_id='".$uid."'";
	$rs=mysql_query($sqls,$conn);
	if($rs)
	{
					$_SESSION['question']=$question;
					$_SESSION['a_answer']=$answer;
					$_SESSION['email']=$email;
					echo "<script language='javascript'>";
					echo "alert('�û����ϱ�����ϣ�');";
					if($urole==2)
						{echo "window.location.href='course_list.php';</script>";}
					else
						{
							echo "</script>";
							exit;
						}
	}
	else
	{
					echo "<script language='javascript'>";
					echo "alert('�û����ϱ���ʧ�ܣ��������������Ƿ�����');";
					echo "</script>";
	}
}}
else
{
	require("url_deal.php");
	$uid=url_deal($_GET['sid']);
	$urole=url_deal($_GET['r']);
	$_SESSION['a_answer']="";
}
?>
<div id="login">
  <form id="form1" name="form1" method="post" action="finish_info.php?o=submit">
    <table width="500" height="210" border="0" cellpadding="0" cellspacing="1" id="t_login">
      <tr>
        <td height="38" colspan="2" align="center" bgcolor="#C4D7FF">
      <?php   if(isset($_GET['e']))
	  				echo "<font color='#FF0000'>�޸ĸ�������</font>";
        			else
					echo "<font color='#FF0000'>���ĸ�������δ���ƣ���������������Ϣ</font>";
		?>
        </td>
      </tr>
      <tr>
        <td width="149" align="center" bgcolor="#FFFFFF">�ú�����:</td>
        <td width="348" height="28" align="left" bgcolor="#FFFFFF"><?php echo "&nbsp;".$uid;?>
          <input type="hidden" name="uid" id="uid"  value="<?php echo $uid;?>"/>
            <input type="hidden" name="urole" id="urole"  value="<?php echo $urole;?>"/></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">�������⣺</td>
        <td height="33" align="left" bgcolor="#FFFFFF"><label for="question"></label>
          <select name="question" id="question">
        <?php 
			$arr_question=array("����ϲ�����˶�","�Ҹ��е�ĸУ����","����ϲ���ļ���","����Ե���ʳ","����ϲ������ɫ","����ϲ���ĵ�Ӱ");
			foreach($arr_question as $q)
			{
				if($q==$_SESSION['question'])
					echo "<option value=".$q." selected='selected'>".$q."</option>";
				else
					echo "<option value=".$q.">".$q."</option>";
			}
		?>
        </select></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">����𰸣�</td>
        <td height="36" align="left" bgcolor="#FFFFFF"><input name="answer" type="text" id="answer" value="<?php echo $_SESSION['a_answer'];?>" /></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">��������:</td>
        <td height="35" align="left" bgcolor="#FFFFFF"><input name="email" type="text" id="email" value="<?php echo $_SESSION['email'];?>" />
        *�һ�������</td>
      </tr>
      <tr height="32">
        <td height="32" colspan="2" align="center" bgcolor="#C4D7FF" ><input type="submit" name="button" id="button" value="�����ҵ�����"  onclick="return check_myform()"/>
        <input name="token" type="hidden" id="token" value="<?php echo $_SESSION['token']?>"></td>
      </tr>
    </table>
  </form>
</div>
