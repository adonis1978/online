<?php
require_once("function.php");
seuser();
?>
<html>
<head>
<title>���߿���ϵͳ����������</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet"  href="../pic/style.css" type="text/css">
</head>
<body>
<center>
<table border="0" cellspacing="1" cellpadding="4" width="400" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�û�����</font></b></nobr></td>
	</tr>
	<tr><form action="stu.php?action=userlist" method="post" name="iform">
	������<input type="hidden" name="tag" value="num" >
		<td width="15%" align="center" bgcolor="#FFFFFF">���û�ѧ��</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="searchnum" size="25" maxlength="20" value=""> <input  id="unum" name="unum" type="submit" value=" ���� "></td>
	   </form>
   </tr>	
	<tr><form action="stu.php?action=userlist" method="post" name="iform">
	    ��<input type="hidden" name="tag" value="name" >
		<td width="15%" align="center" bgcolor="#FFFFFF">���û���</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="searchname" size="25" maxlength="20" value=""> <input  id="uname" name="uname" type="submit" value=" ���� "></td>
	    </form>
	</tr>	
</table>
</center>
</body>
</html>