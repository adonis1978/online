<?php
require("function.php");
seuser();
?>
<head>
<title>���߿���ϵͳ����������</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
</head>
<center>
<?php
if($_GET['op']=='del'){
	$delscore=sql_update("delete from chengji where id=$_GET[id]");
	     if($delscore){
		    msge('ɾ���ɹ��� <input   type="button"   name="back"   value="����"   onclick="history.back()">'); exit();
	      } else {msge('����ʧ�ܣ�   <input   type="button"   name="back"   value="����"   onclick="history.back()">');exit();}
}
if($_POST['subm']){
	$editcj=sql_update("update chengji set kscore='$_POST[kgcj]',zscore='$_POST[zgcj]',huankao='$_POST[huankao]',quekao='$_POST[quekao]' where id='$_GET[id]'");
    	     if($editcj){
		    msge('�༭�ɹ��� <input   type="button"   name="back"   value="����"   onclick="history.back()">'); exit();
	      } else {msge('����ʧ�ܣ�   <input   type="button"   name="back"   value="����"   onclick="history.back()">');exit();}
}
if($_GET['op']=='edit'){
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�ɼ��༭</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">�͹���ɼ�</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="kgcj" id="kgcj" size="25" maxlength="10" value="<?=$_GET['kgcj']?>"></td>
	</tr>
		<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">������ɼ�</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="zgcj" id="zgcj" size="25" maxlength="10" value="<?=$_GET['zgcj']?>"></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">ȱ��</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="radio" id="quekao" name="quekao" value="1">��<input type="radio" id="quekao" name="quekao" value="0" checked>��</td>
	</tr>	
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">����</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="radio" id="huankao" name="huankao" value="1">��<input type="radio" id="huankao" name="huankao" value="0" checked>��</td>
	</tr>		
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><input type="submit"  id="subm" name="subm" value=" �༭ "> </td>
	</tr>
</table>
</form>
<? } ?>
</center>