<?php
//用户名修改处理
require("function.php");
seuser();
//用户名修改处理
if(isset($_POST['subm'])){
   $nameupd=sql_update("update to_admin set test_admin='$_POST[adminname]'");
   if ($nameupd){
   	msg('修改成功！',"user.php?action=changename");
   }else {
   	msg('修改失败！',"user.php?action=changename");
   }
}
//用户密码修改处理
if(isset($_POST['submi'])){
	if($_POST['newpass']!=$_POST['newpass2']){
		msg('新密码和确认密码不一致！','user.php?action=changepass');
		exit();
	}
   $oldpass=md5("$_POST[oldpass]");
   $result=sql_operate("select password from to_admin");
   if($result['password']==$oldpass){
   	   $newpass=md5("$_POST[newpass]");
       $nameupd=sql_update("update to_admin set password='$newpass'");
       if ($nameupd){
   	      msg('修改成功！',"user.php?action=changepass");
       }else {
   	      msg('修改失败！',"user.php?action=changepass");
       }
    }else{msg('原密码错误！！','user.php?action=changepass');}
}
//公告处理
if(isset($_POST['subnotice'])){
	$psnotice=htmlspecialchars($_POST['notice']);
	$notice=sql_update("update to_admin set test_notice='$psnotice'");
    if ($notice){
   	    msg('编辑成功！',"user.php?action=notice");
    }else {
   	    msg('编辑失败！',"user.php?action=notice");
    }
}
?>
<html>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<script   language="JavaScrip"  type="text/javascript">
function checkname(){
	if (!document.iform.adminname.value){
		alert("没有添入新的用户名！");return false;
	}
}
function checkpass(){
	if (!document.iform.oldpass.value){
		alert("没有添入原密码！");return false;
	}
	if (!document.iform.newpass.value){
		alert("没有添入新密码！");return false;
	}	
	if (!document.iform.newpass2.value){
		alert("没有添入确认密码！");return false;
	}
}
</script>
</head>
<body>
<center>
<?php
if (isset($_GET["action"]) && $_GET["action"]=='changename'){
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="iform" onsubmit="return checkname()">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">管理员用户名更改</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">新用户名</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="adminname" size="25" maxlength="20" value=""></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input  id="subm" name="subm" type="submit" value=" 更改 "> </td>
	</tr>
</table>
</form>

<?php }
if(isset($_GET["action"]) && $_GET["action"]=='changepass'){?>
<form action="" method="post" name="iform" onsubmit="return checkpass()">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">管理员密码修改</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">原密码</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="password" name="oldpass" size="25" maxlength="20" value=""></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">新密码</td>
		<td align="left" bgcolor="#EEEEEE"><input type="password" name="newpass" size="25" maxlength="20"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">确认密码</td>
		<td align="left" bgcolor="#EEEEEE"><input type="password" name="newpass2" size="25" maxlength="20"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input id="submi" name="submi" type="submit" value=" 更改 "> <input type="reset" value=" 重填 "></td>
	</tr>
</table>
</form>
<?php }
if(isset($_GET["action"]) && $_GET["action"]=="notice"){
	$notic=sql_operate("select test_notice from to_admin");
	?>
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">编辑公告</font></b></nobr></td>
	</tr>
	<tr>
		<td width="260px" align="left" bgcolor="#FFFFFF"><textarea  id="notice" name="notice" cols="50" rows="10"><?=$notic['test_notice']?></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input type="submit" 　id="subnotice" name="subnotice" value=" 设定 "> </td>
	</tr>
</table>
</form>
<?php }?>
</center>
</body>
</html>