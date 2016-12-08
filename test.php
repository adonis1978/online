<?php
if(!$_GET['uid'] || !$_GET['ms']){
	header("location: index.php");
	exit();
}
require("language.php");
require("admin/function.php");
stu();
require("templates/header.html");
?>

<div id="testmiddle">
<div id="testBg">
<div id="testInfo">
<center><br /><font color="#FFFFFF" size="3">选择科目</font></center>
<ul id="articleList">
<?php
$sub=sql_select("select * from test_subject");
if($sub){
while ($row=mysql_fetch_array($sub)){
	echo "<li><a href=\"classinfo.php?ms=$_GET[ms]&uid=$_GET[uid]&sid=$row[id]\">$row[test_sub]</a></li>"; }}
else {	
	echo "<center>";
    msg('数据读取错误！','index.php');
    echo "</ center>";
} ?>
</ul>
</div>
</div>
</div>
<?php
require("templates/footer.html");
?>