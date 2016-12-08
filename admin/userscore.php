<?php
require("function.php");
seuser();
?>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
</head>
<center>
<?php
if($_GET['op']=='del'){
	$delscore=sql_update("delete from chengji where id=$_GET[id]");
	     if($delscore){
		    msge('删除成功！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">'); exit();
	      } else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
}
if($_POST['subm']){
	$editcj=sql_update("update chengji set kscore='$_POST[kgcj]',zscore='$_POST[zgcj]',huankao='$_POST[huankao]',quekao='$_POST[quekao]' where id='$_GET[id]'");
    	     if($editcj){
		    msge('编辑成功！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">'); exit();
	      } else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
}
if($_GET['op']=='edit'){
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">成绩编辑</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">客观题成绩</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="kgcj" id="kgcj" size="25" maxlength="10" value="<?=$_GET['kgcj']?>"></td>
	</tr>
		<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">主观题成绩</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="zgcj" id="zgcj" size="25" maxlength="10" value="<?=$_GET['zgcj']?>"></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">缺考</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="radio" id="quekao" name="quekao" value="1">是<input type="radio" id="quekao" name="quekao" value="0" checked>否</td>
	</tr>	
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">缓考</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="radio" id="huankao" name="huankao" value="1">是<input type="radio" id="huankao" name="huankao" value="0" checked>否</td>
	</tr>		
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><input type="submit"  id="subm" name="subm" value=" 编辑 "> </td>
	</tr>
</table>
</form>
<? } ?>
</center>