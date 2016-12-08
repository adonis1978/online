<?php
require("admin/function.php");
if(@$action=="logout"){
	$_SESSION=array();
	@session_unset();
	@session_destroy();
	header("location: index.php");
}
require("language.php");
$row=sql_operate("select test_notice from to_admin");
require("templates/header.html");
require("templates/middle.html");
require("templates/footer.html");
?>