<?php
	//注销，退出登陆
	session_start();
	session_destroy();
	header("location:login_info.html");
?>