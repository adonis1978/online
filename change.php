<html>
<head>
<title>�޸�����</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="pic/style.css" type="text/css">
</head><body>
<?php
require_once("admin/function.php");
stu();
require_once("language.php");
//�û������޸Ĵ���
if($_POST['submi']){
		if($_POST['newpass']=="" || $_POST['newpass2']=="" || $_POST['newpass']=="" ){
		msg('�κ�һ�����Ϊ�գ�',"change.php?uid=$_GET[uid]");
		exit();
	}
	if($_POST['newpass']!=$_POST['newpass2']){
		msg('�������ȷ�����벻һ�£�',"change.php?uid=$_GET[uid]");
		exit();
	}
	if(!checkpass($_POST['newpass'])){
		msg('����ֻ������6λ���ϵ���ĸ�����ֵ���ϣ�',"change.php?uid=$_GET[uid]");
		exit();		
	}
   $oldpass=md5("$_POST[oldpass]");
   $result=sql_operate("select passw from students where id='$_GET[uid]'");
   if($result['passw']==$oldpass){
   	   $newpass=md5("$_POST[newpass]");
       $nameupd=sql_update("update students set passw='$newpass' where id='$_GET[uid]'");
       if ($nameupd){
   	      msge("�޸ĳɹ���<a href=\"/\"onClick=\"javascript:window.close();return false;\">�رմ���</a>");exit();
       }else {
   	      msge("�޸�ʧ�ܣ�<a href=\"/\"onClick=\"javascript:window.close();return false;\">�رմ���</a>");exit();
       }
    }else{msg('ԭ������󣡣�',"change.php?uid=$_GET[uid]");exit();}
}
?>
<div id="usermiddle">
<form action="" method="POST" id="iform" onsubmit="return checkpass()">
<table  width="250" border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
  <tr>
    <td colspan="3" bgcolor="#698CC3" align="center"><nobr><b><font color="#FFFFFF" size="3">�޸�����</font></b></nobr></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">ԭ����</td>
    <td colspan="2" bgcolor="#FFFFFF"><input  id="oldpass" name="oldpass" type="text"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">������</td>
    <td colspan="2" bgcolor="#FFFFFF"><input id="newpass" name="newpass" type="text"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">ȷ������</td>
    <td colspan="2" bgcolor="#FFFFFF"><input id="newpass2" name="newpass2" type="text"></td>
  </tr>
  <tr>
  <td colspan="3" bgcolor="#8BAEE5" height="20" align="center"><input type="submit" id="submi" name="submi" value="�޸�"></td>
  </tr>
</table>
</form>
</div>
</body></html>