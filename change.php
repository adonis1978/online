<html>
<head>
<title>修改密码</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="pic/style.css" type="text/css">
</head><body>
<?php
require_once("admin/function.php");
stu();
require_once("language.php");
//用户密码修改处理
if($_POST['submi']){
		if($_POST['newpass']=="" || $_POST['newpass2']=="" || $_POST['newpass']=="" ){
		msg('任何一项都不能为空！',"change.php?uid=$_GET[uid]");
		exit();
	}
	if($_POST['newpass']!=$_POST['newpass2']){
		msg('新密码和确认密码不一致！',"change.php?uid=$_GET[uid]");
		exit();
	}
	if(!checkpass($_POST['newpass'])){
		msg('密码只是能是6位以上的字母和数字的组合！',"change.php?uid=$_GET[uid]");
		exit();		
	}
   $oldpass=md5("$_POST[oldpass]");
   $result=sql_operate("select passw from students where id='$_GET[uid]'");
   if($result['passw']==$oldpass){
   	   $newpass=md5("$_POST[newpass]");
       $nameupd=sql_update("update students set passw='$newpass' where id='$_GET[uid]'");
       if ($nameupd){
   	      msge("修改成功！<a href=\"/\"onClick=\"javascript:window.close();return false;\">关闭窗口</a>");exit();
       }else {
   	      msge("修改失败！<a href=\"/\"onClick=\"javascript:window.close();return false;\">关闭窗口</a>");exit();
       }
    }else{msg('原密码错误！！',"change.php?uid=$_GET[uid]");exit();}
}
?>
<div id="usermiddle">
<form action="" method="POST" id="iform" onsubmit="return checkpass()">
<table  width="250" border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
  <tr>
    <td colspan="3" bgcolor="#698CC3" align="center"><nobr><b><font color="#FFFFFF" size="3">修改密码</font></b></nobr></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">原密码</td>
    <td colspan="2" bgcolor="#FFFFFF"><input  id="oldpass" name="oldpass" type="text"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">新密码</td>
    <td colspan="2" bgcolor="#FFFFFF"><input id="newpass" name="newpass" type="text"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">确认密码</td>
    <td colspan="2" bgcolor="#FFFFFF"><input id="newpass2" name="newpass2" type="text"></td>
  </tr>
  <tr>
  <td colspan="3" bgcolor="#8BAEE5" height="20" align="center"><input type="submit" id="submi" name="submi" value="修改"></td>
  </tr>
</table>
</form>
</div>
</body></html>