<?php
include("function.php");
seuser();
$row=sql_operate("select test_admin from to_admin");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<title>��������</title>
</head>
<body bgcolor="#9EB6D8">

<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">����Ա</font></b></nobr></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FFFFFF"><font class="empha"><?=$row['test_admin']?></font></td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�û�����</font></b></nobr></td>
	</tr>
	<tr>
		<td  bgcolor="#FFFFFF">
		<font class="menu">
		<a href="user.php?action=changename" target="main">����Ա������</a><br>
		<a href="user.php?action=changepass" target="main">�������</a><br>
		</font>	
		</td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�������</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		<font class="menu">
		<a href="test.php?action=subject_list" target="main">��Ŀ�б�</a><br>
		<a href="test.php?action=subject_add" target="main">��ӿ�Ŀ</a><br>
		<a href="test.php?action=add_bigtest" target="main">�������</a><br>
		</td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�û�����</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		<font class="menu">
		<a href="stu.php?action=adduser" target="main">����û�</a><br>
		<a href="stu.php?action=userlist" target="main">�û��б�</a><br>
		<a href="search.php" target="main">�����û�</a><br>
       <a href="stu.php?action=typass" target="main">�趨Ĭ������</a><br>
       <a href="stu.php?action=oct" target="main">����/�رտ���</a>
		</font></td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">��������</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		<font class="menu">
		<a href="user.php?action=notice" target="main">����༭</a>
       </font></td>
	</tr>
</table>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="100%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="1" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�˳�</font></b></nobr></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF"><font class="menu"><a href="index.php?action=logout" target="_top">�˳�</a></font><br></td>
	</tr>
</table>
<br>
</body>
</html>
