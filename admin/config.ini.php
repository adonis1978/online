<?php
$mysql_server='localhost';
$mysql_username='root';
$mysql_password='root';
$mysql_database='online';
@session_start();
//���ݿ����Ӻ���
function  connect_sql(){
	global $mysql_server,$mysql_username,$mysql_password,$mysql_database;
	$conn=mysql_connect($mysql_server,$mysql_username,$mysql_password) or die("<font color=red><b>���ݿ����Ӵ����������Ա��ϵ��</b></font>");	
	mysql_query("SET NAMES 'gb2312';",$conn);
	mysql_select_db($mysql_database) or die("<font color=red><b>���ݿ�ѡ��������й������ϵ��</b></font></b>");
}
define("each_pageview",50); //��ҳÿҳ��ʾ��Ŀ
?>