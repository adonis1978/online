<?php
include("function.php");
seuser();
$row=sql_operate("select test_admin from to_admin");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<title>管理中心</title>
</head>
<body bgcolor="#9EB6D8">

<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">管理员</font></b></nobr></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FFFFFF"><font class="empha"><?=$row['test_admin']?></font></td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">用户更改</font></b></nobr></td>
	</tr>
	<tr>
		<td  bgcolor="#FFFFFF">
		<font class="menu">
		<a href="user.php?action=changename" target="main">管理员名更改</a><br>
		<a href="user.php?action=changepass" target="main">密码更改</a><br>
		</font>	
		</td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">试题管理</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		<font class="menu">
		<a href="test.php?action=subject_list" target="main">科目列表</a><br>
		<a href="test.php?action=subject_add" target="main">添加科目</a><br>
		<a href="test.php?action=add_bigtest" target="main">添加题型</a><br>
		</td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">用户管理</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		<font class="menu">
		<a href="stu.php?action=adduser" target="main">添加用户</a><br>
		<a href="stu.php?action=userlist" target="main">用户列表</a><br>
		<a href="search.php" target="main">查找用户</a><br>
       <a href="stu.php?action=typass" target="main">设定默认密码</a><br>
       <a href="stu.php?action=oct" target="main">开放/关闭考试</a>
		</font></td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">发布公告</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		<font class="menu">
		<a href="user.php?action=notice" target="main">公告编辑</a>
       </font></td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">退出</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF"><font class="menu"><a href="index.php?action=logout" target="_top">退出</a></font><br></td>
	</tr>
</table>
<br>
</body>
</html>
