<?php
require_once("function.php");
if(@$action=="logout"){
	$_SESSION=array();
	@session_unset();
	@session_destroy();
	header("location: login.php");
}
if($_POST['adminname']=="" || $_POST['password']==""){
	header("location: login.php");
	exit();
}
$passw=md5("$_POST[password]");
$adminname=$_POST['adminname'];
$result=connect_sql_total("select * from to_admin where test_admin='$adminname' and password='$passw'");
if($result==1){
	$_SESSION['username']=$adminname;
?>
<html>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<link rel="icon" href="../pic/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../pic/favicon.ico" type="image/x-icon" />
</head>
<frameset rows="22,*" framespacing="1">
	<frame src="header.html" name="head" noresize scrolling="no" frameborder="0">
	<frameset cols="140,*" framespacing="0">
		<frame src="menu.php" name="menu" scrolling="yes" frameborder="0">
		<frame src="main.php" name="main" scrolling="yes" frameborder="0">
	</frameset>
</frameset></noframes></noframes>
</html>
<?php }
else{msg('用户名或密码错误！！！','login.php');} 