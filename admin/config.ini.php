<?php
$mysql_server='localhost';
$mysql_username='root';
$mysql_password='root';
$mysql_database='online';
@session_start();
//数据库连接函数
function  connect_sql(){
	global $mysql_server,$mysql_username,$mysql_password,$mysql_database;
	$conn=mysql_connect($mysql_server,$mysql_username,$mysql_password) or die("<font color=red><b>数据库连接错误，请与管理员联系！</b></font>");	
	mysql_query("SET NAMES 'gb2312';",$conn);
	mysql_select_db($mysql_database) or die("<font color=red><b>数据库选择出错，请有管理管联系！</b></font></b>");
}
define("each_pageview",50); //分页每页显示数目
?>