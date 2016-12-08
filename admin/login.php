<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<link rel="icon" href="../pic/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../pic/favicon.ico" type="image/x-icon" />
<title>管理中心登录</title>
<script language="javascript">
function check(){
	if (!document.iform.adminname.value||!document.iform.password.value){
		alert("管理员和密码均不能为空！");return false;
	}
}
</script>
</head>
<body bgcolor="#9EB6D8">
<center>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<form action="index.php" method="post" name="iform" onsubmit="return check()">
<input type="hidden" name="action" value="login">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">登录入口</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">管理员</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" id="adminname" name="adminname" size="25" maxlength="20" value=""></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">密　码</td>
		<td align="left" bgcolor="#EEEEEE"><input type="password" id="password" name="password" size="25" maxlength="20"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input type="submit" value=" 登录 "> <input type="reset" value=" 重填 "></td>
	</tr>
</table>
</form>
</body>
</html>