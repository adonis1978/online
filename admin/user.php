<?php
//�û����޸Ĵ���
require("function.php");
seuser();
//�û����޸Ĵ���
if(isset($_POST['subm'])){
   $nameupd=sql_update("update to_admin set test_admin='$_POST[adminname]'");
   if ($nameupd){
   	msg('�޸ĳɹ���',"user.php?action=changename");
   }else {
   	msg('�޸�ʧ�ܣ�',"user.php?action=changename");
   }
}
//�û������޸Ĵ���
if(isset($_POST['submi'])){
	if($_POST['newpass']!=$_POST['newpass2']){
		msg('�������ȷ�����벻һ�£�','user.php?action=changepass');
		exit();
	}
   $oldpass=md5("$_POST[oldpass]");
   $result=sql_operate("select password from to_admin");
   if($result['password']==$oldpass){
   	   $newpass=md5("$_POST[newpass]");
       $nameupd=sql_update("update to_admin set password='$newpass'");
       if ($nameupd){
   	      msg('�޸ĳɹ���',"user.php?action=changepass");
       }else {
   	      msg('�޸�ʧ�ܣ�',"user.php?action=changepass");
       }
    }else{msg('ԭ������󣡣�','user.php?action=changepass');}
}
//���洦��
if(isset($_POST['subnotice'])){
	$psnotice=htmlspecialchars($_POST['notice']);
	$notice=sql_update("update to_admin set test_notice='$psnotice'");
    if ($notice){
   	    msg('�༭�ɹ���',"user.php?action=notice");
    }else {
   	    msg('�༭ʧ�ܣ�',"user.php?action=notice");
    }
}
?>
<html>
<head>
<title>���߿���ϵͳ����������</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<script   language="JavaScrip"  type="text/javascript">
function checkname(){
	if (!document.iform.adminname.value){
		alert("û�������µ��û�����");return false;
	}
}
function checkpass(){
	if (!document.iform.oldpass.value){
		alert("û������ԭ���룡");return false;
	}
	if (!document.iform.newpass.value){
		alert("û�����������룡");return false;
	}	
	if (!document.iform.newpass2.value){
		alert("û������ȷ�����룡");return false;
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
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">����Ա�û�������</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">���û���</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="adminname" size="25" maxlength="20" value=""></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input  id="subm" name="subm" type="submit" value=" ���� "> </td>
	</tr>
</table>
</form>

<?php }
if(isset($_GET["action"]) && $_GET["action"]=='changepass'){?>
<form action="" method="post" name="iform" onsubmit="return checkpass()">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">����Ա�����޸�</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">ԭ����</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="password" name="oldpass" size="25" maxlength="20" value=""></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">������</td>
		<td align="left" bgcolor="#EEEEEE"><input type="password" name="newpass" size="25" maxlength="20"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">ȷ������</td>
		<td align="left" bgcolor="#EEEEEE"><input type="password" name="newpass2" size="25" maxlength="20"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input id="submi" name="submi" type="submit" value=" ���� "> <input type="reset" value=" ���� "></td>
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
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�༭����</font></b></nobr></td>
	</tr>
	<tr>
		<td width="260px" align="left" bgcolor="#FFFFFF"><textarea  id="notice" name="notice" cols="50" rows="10"><?=$notic['test_notice']?></textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input type="submit" ��id="subnotice" name="subnotice" value=" �趨 "> </td>
	</tr>
</table>
</form>
<?php }?>
</center>
</body>
</html>