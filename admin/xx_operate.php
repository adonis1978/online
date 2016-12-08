<?php
require("function.php");
seuser();
?>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
</head>
<?php
if($_GET['op']=='del'){
	$delall=sql_update("delete from small_result where id=$_GET[id]");
	if($delall){
	    msge('删除成功！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();
	}else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
}
?>