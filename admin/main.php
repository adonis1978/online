<?php
include("function.php");
include("../language.php");
seuser();
connect_sql();
$row=sql_operate("select test_admin from to_admin where id=1");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<title>在线考试系统－管理中心</title>
</head>
<body bgcolor="#9EB6D8">
<center>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="4" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">服务器信息</font></b></nobr></td>
	</tr>
	<tr>
		<td width="15%" align="center" bgcolor="#FFFFFF">WWW服务器</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><?=$_SERVER['SERVER_SOFTWARE']?></td>
		<td width="15%" align="center" bgcolor="#FFFFFF">服务器主机名称</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><?=$_SERVER['SERVER_NAME']?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">PHP版本</td>
		<td align="left" bgcolor="#EEEEEE"><?=phpversion()?></td>
		<td align="center" bgcolor="#EEEEEE">Zend版本</td>
		<td align="left" bgcolor="#EEEEEE"><?=zend_version()?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FFFFFF">MySQL服务器版本</td>
		<td align="left" bgcolor="#FFFFFF"><?=mysql_get_server_info()?></td>
		<td align="center" bgcolor="#FFFFFF">MySQL客户端版本</td>
		<td align="left" bgcolor="#FFFFFF"><?=mysql_get_client_info()?></td>
	</tr>
</table>
<img src="images/rowspace.gif" border="0"><br>
<br>
<br>
<?=$copyright?>
<center>
</body>
</html>

