<?php
require("function.php");
seuser();
?>
<head>
<title>���߿���ϵͳ����������</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
</head>
<?php
if($_GET['op']=='del'){
	$delall=sql_update("delete from small_result where id=$_GET[id]");
	if($delall){
	    msge('ɾ���ɹ��� <input   type="button"   name="back"   value="����"   onclick="history.back()">');exit();
	}else {msge('����ʧ�ܣ�   <input   type="button"   name="back"   value="����"   onclick="history.back()">');exit();}
}
?>