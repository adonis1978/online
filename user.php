<?php
require("admin/function.php");
$stunum= $_POST['usernum'];
$passw=md5("$_POST[password]");
if($stunum=="" || $_POST['password']==""){
    msg('错误操作！！','index.php');
    exit();
}
require("language.php");
$rows=connect_sql_total("select stunum,passw from students where stunum='$stunum' and passw='$passw'");
if($rows==1){
   $row=sql_operate("select * from students where stunum='$stunum'");
   $rowlock=sql_operate("select locked from to_admin");
   $_SESSION['stu']=$row['id'];
   require("templates/header.html");
   require("msg.php");	
   require("templates/footer.html");
}
else{
	echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
    msg('用户名或密码错误！','index.php');
}
?>