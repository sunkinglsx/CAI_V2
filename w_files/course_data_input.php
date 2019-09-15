<link href="../css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 #tinfo {
	font-size: 14px;
	color: #036;
	text-decoration: none;
	border: 1px solid #CCC;
}
</style>
<script language="javascript">
function addtolist()	//将本机房的课程安排添加到列表再提交
{
	var d_lab=document.getElementById("lab").value;//机房
	var d_week=document.getElementById("weeks").value;//星期
	var d_class=document.getElementById("cls").value;//班级
	var d_lesson=document.getElementById("lesson").value;//节次
	var d_course=document.getElementById("course").value;//课程名称
	var d_teacher_str=document.getElementById("teacher").value;//老师
	var d_teacher_arr=d_teacher_str.split("#");
	var d_teacher_id=d_teacher_arr[0];
	var d_teacher=d_teacher_arr[1];
	var arr_week=new Array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
	var list=document.getElementById("list");
	var rows=list.rows.length;
	var row=list.insertRow(rows);	//增加1行
	row.id=rows;
	row.bgColor="#FFF";
	td0=row.insertCell(0);
	td1=row.insertCell(1);
	td2=row.insertCell(2);
	td3=row.insertCell(3);
	td4=row.insertCell(4);
	td5=row.insertCell(5);
	td6=row.insertCell(6);
	td0.height="32px";
	td0.align="center";
	td1.align="center";
	td2.align="center";
	td3.align="center";
	td4.align="center";
	td5.align="center";
	td6.align="center";
	var v=d_lab+"#"+d_week+"#"+d_class+"#"+d_lesson+"#"+d_course+"#"+d_teacher_id;
	td0.innerHTML="<label>&nbsp;&nbsp;<input type='checkbox' name='r[]' id='r_'"+rows+" value='"+v+"' checked='checked'>&nbsp;&nbsp;</label>";
	td1.innerHTML=d_lab;
	td2.innerHTML=arr_week[d_week];
	td3.innerHTML=d_class;
	td4.innerHTML=d_lesson;
	td5.innerHTML=d_course;
	td6.innerHTML=d_teacher;
}
</script>
<?php
	session_start();
	//查出实训室管理员账号信息
	include("../db_connect.php");
	mysql_query("SET NAMES 'UTF8'");
	$sqls_u_id="select u_id from s_user where u_name='".$_SESSION['uname']."'";
	$rs_u_id=mysql_query($sqls_u_id,$conn);
	$arr_uid=mysql_fetch_array($rs_u_id);
	$uid=$arr_uid[0];	//管理员的ID号
	$mylabs=array();	//实训室编号
	$myclass=array();//班级编号
	$myteacher=array(array());//教师姓名与ID
	//数据准备查询类
	class Data_PreReady{
		private $db_table;//数据表
		private $get_field;//查询字段
		private $key_field;//查询字段
		private $key_value;//查询字段值
		private $key_type;//查询值类型,0为数值型，1为字符型,2为无条件查询
		private $db_connect;//数据连接
		public $result=array();
		function __construct($db,$tb,$gfield,$kfield,$kvalue,$ktype)	//构造函数
		{
			$this->db_connect=$db;
			$this->db_table=$tb;
			$this->get_field=$gfield;
			$this->key_field=$kfield;
			$this->key_value=$kvalue;
			$this->key_type=$ktype;
			$this->result=$this->Select_data();//返回查询结果
		}
		private function Select_data()//查询函数
		{
			$data_arr=array();
			if($this->key_type==0)
				$sqls_str="select distinct(".$this->get_field.") from ".$this->db_table." where ".$this->key_field."=".$this->key_value;
			elseif($this->key_type==1)
				$sqls_str="select distinct(".$this->get_field.") from ".$this->db_table." where ".$this->key_field."='".$this->key_value."'";
			elseif($this->key_type==2)
				$sqls_str="select distinct(".$this->get_field.") from ".$this->db_table;
			$rs=mysql_query($sqls_str,$this->db_connect);
			if($rs&&mysql_num_rows($rs)>0)
			{
				for($i=0;$i<mysql_num_rows($rs);$i++)
				{
					$tmp_arr=mysql_fetch_array($rs);
					$data_arr[$i]=$tmp_arr[0];
				}
				mysql_free_result($rs);
			}
			return $data_arr;// 返回数据结果数组
		}
	}
	//查出该管理员所负责的全部机房
	$lab=new Data_PreReady($conn,"s_shixunshi","s_shi_index","s_shi_admin",$uid,0);
	$mylabs=$lab->result;
	//查出所有的教师姓名与用户id
	$sqls_tacher="select u_id,u_true_name from s_user where u_right=3";
	$rs_teacher=mysql_query($sqls_tacher,$conn);
	if($rs_teacher&&mysql_num_rows($rs_teacher)>0)
	{
		for($i=0;$i<mysql_num_rows($rs_teacher);$i++)
		{
			$arr_temp=mysql_fetch_array($rs_teacher);
			$myteacher[$i][0]=$arr_temp['u_id'];
			$myteacher[$i][1]=$arr_temp['u_true_name'];
		}
		mysql_free_result($rs_teacher);
	}
	//查出所有的班级编号
	$bj=new Data_PreReady($conn,"s_class","c_id",NULL,NULL,2);
	$myclass=$bj->result;
?>
<form id="form1" name="form1" method="post" action="../labadmin/course_data_save.php">
  <table width="100%" height="203" border="0" align="center" cellpadding="0" cellspacing="1" id="tlist">
    <tr>
      <td height="36" colspan="13" bgcolor="#CCCCCC"> 实训室管理》机房课程安排录入</td>
    </tr>
    <tr>
      <td width="58" height="39" align="center" bgcolor="#FFFFFF">实训室</td>
      <td width="84" align="center" bgcolor="#FFFFFF"><label for="lab"></label>
      <?php if(count($mylabs)==0)
	  		echo "请联系实训中心给您安排实训室";
			else{?>
        <select name="lab" class="list" id="lab">
        <?php foreach($mylabs as $v){?>
        <option value="<?php echo $v;?>"><?php echo $v;?></option>
        <?php }?>
      </select>
      <?php }?>
      </td>
      <td width="47" align="center" bgcolor="#FFFFFF">星期</td>
      <td width="103" align="center" bgcolor="#FFFFFF"><select name="weeks" class="list" id="weeks">
        <option value="0">星期天</option>
        <option value="1">星期一</option>
        <option value="2">星期二</option>
        <option value="3">星期三</option>
        <option value="4">星期四</option>
        <option value="5">星期五</option>
        <option value="6">星期六</option>
      </select></td>
      <td width="52" align="center" bgcolor="#FFFFFF">班级</td>
      <td width="104" align="center" bgcolor="#FFFFFF"><?php if(count($myclass)==0)
	  		echo "请等待实训中心分配班级数据";
			else{?>
        <select name="cls" class="list" id="cls">
          <?php foreach($myclass as $v){?>
          <option value="<?php echo $v;?>"><?php echo $v;?></option>
          <?php }?>
        </select>
      <?php }?></td>
      <td width="45" align="center" bgcolor="#FFFFFF">节次</td>
      <td width="113" align="center" bgcolor="#FFFFFF"><select name="lesson" class="list" id="lesson">
        <option value="12">第1、2节</option>
        <option value="34">第3、4节</option>
        <option value="56">第5、6节</option>
        <option value="78">第7、8节</option>
</select></td>
      <td width="47" align="center" bgcolor="#FFFFFF">课程</td>
      <td width="201" align="center" bgcolor="#FFFFFF"><input name="course" type="text" class="list" id="course" /></td>
      <td width="77" align="center" bgcolor="#FFFFFF">上课老师</td>
      <td width="85" align="center" bgcolor="#FFFFFF"><?php if(count($myteacher)==0)
	  		echo "请等待实训中心分配教师信息";
			else{?>
        <select name="teacher" class="list" id="teacher">
          <?php foreach($myteacher as $v){?>
          <option value="<?php echo $v[0]."#".$v[1];?>"><?php echo $v[1];?></option>
          <?php }?>
        </select>
      <?php }?></td>
      <td width="81" align="center" bgcolor="#FFFFFF"><input type="button" name="button2" id="button2" value="添加"  onClick="addtolist();"/></td>
    </tr>
    <tr>
      <td height="83" colspan="13" align="center" valign="top" bgcolor="#FFFFFF">
      <table width="100%" height="29" border="0" cellpadding="0" cellspacing="1" id="list">
        <tr>
          <td width="6%" height="24" align="center" bgcolor="#CFCFEF">选择</td>
          <td width="10%" align="center" bgcolor="#CFCFEF">实训室</td>
          <td width="11%" align="center" bgcolor="#CFCFEF">星期</td>
          <td width="13%" align="center" bgcolor="#CFCFEF">班级</td>
          <td width="15%" align="center" bgcolor="#CFCFEF">节次</td>
          <td width="32%" align="center" bgcolor="#CFCFEF">课程</td>
          <td width="13%" align="center" bgcolor="#CFCFEF">上课老师</td>
       </tr>
      </table> 
      </td>
    </tr>
    <tr>
      <td height="40" colspan="13" align="center" bgcolor="#CCCCCC"><input name="button" type="submit" class="button_style" id="button" value="保存课程安排" />
        　　          </td>
    </tr>
  </table>
</form>
