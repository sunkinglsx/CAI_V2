<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>������ҵϵͳ&mdash;��̨����</title>
<style type="text/css">
@import url("css.css");
</style>
</head>

<body>
<?php
	require("session.php");
	check_asession();	//������Ա�Ƿ��¼
?>
<table width="100%" height="641" border="0" align="center" cellpadding="0" cellspacing="1" id="t_main">
  <tr>
    <td height="47" colspan="3" bgcolor="#3399FF"><img src="pics/aindex.jpg" width="448" height="53" /></td>
  </tr>
  <tr>
    <td height="35" colspan="3" align="right" bgcolor="#FFFFFF"><?php show_awelcome();?></td>
  </tr>
  <tr>
    <td height="6" colspan="3" align="right" bgcolor="#999999"></td>
  </tr>
  <tr>
    <td width="12%" height="545" align="center" valign="top" bgcolor="#DAE8F3"><br />
        <p ><a href="a_add_class.php" target="show"><img src="images/group_add.png" width="16" height="16" style="margin:0px 5px;"/> ����οΰ༶</a></p>
        <p><a href="a_modify_class.php" target="show"><img src="images/group_edit.png" width="16" height="16" style="margin:0px 5px;"/>�����οΰ༶</a></p>
        
        <p><a href="class_list.php?furl=1" target="show"><img src="images/cog_add.png" width="16" height="16"style="margin:0px 5px;" />����οο�Ŀ</a></p>
        <p><a href="class_list.php?furl=2" target="show"><img src="images/cog_edit.png" width="16" height="16" style="margin:0px 5px;"/>�����οο�Ŀ</a></p>
        
        <p><a href="class_list.php?furl=3" target="show"><img src="images/book_add.png" width="16" height="16" style="margin:0px 5px;"/>����ѧ����ҵ</a></p>
        <p><a href="class_list.php?furl=4" target="show"><img src="images/book_edit.png" width="16" height="16" style="margin:0px 5px;"/>����ѧ����ҵ</a></p>
        <p><a href="class_list.php?furl=5" target="show"><img src="images/book.png" width="16" height="16" style="margin:0px 5px;"/>����ѧ����ҵ</a></p>
        
        <p><a href="a_design_add.php" target="show"><img src="images/transmit_add.png" width="16" height="16" style="margin:0px 5px;"/>�����γ����</a></p>
        <p><a href="a_design_list.php" target="show"><img src="images/transmit_edit.png" width="16" height="16"style="margin:0px 5px;" />����γ����</a></p>
        
        <p><a href="a_explor_score.php" target="show"><img src="images/server_go.png" width="16" height="16" style="margin:0px 5px;"/>����ѧ���ɼ�</a></p>
        <p><a href="class_list.php?furl=6" target="show"><img src="images/script_go.png" width="16" height="16" style="margin:0px 5px;"/>����ѧ������</a></p>
        <?php if($_SESSION['a_right']==1){?>
      <p><a href="a_aduser_list.php" target="show"><img src="images/user_edit.png" width="16" height="16" style="margin:0px 5px;"/>�����ο���ʦ</a></p>
        <p><a href="a_add_manager.php" target="show"><img src="images/user_add.png" width="16" height="16" style="margin:0px 5px;"/>����ο���ʦ</a></p>
        <?php }?>
    </td>
    <td width="88%" colspan="2" valign="top" bgcolor="#FFFFFF"><iframe  name="show" id="show" width="100%" height="540" scrolling="auto" frameborder="0"></iframe></td>
  </tr>
</table>
<?php require("about.html");?>
</body>
</html>