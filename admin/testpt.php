<?php
require_once("function.php");
seuser(); ?>
<html>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("真的要删除该题型吗？"))
window.location = "operate.php?op=deltx&id=" + params ;
}
//-->
</script>
</head>
<body>
<?php
//添加科目
if (isset($_GET["action"]) && $_GET["action"]=='subject_add'){
	if($_POST['subjectadd']=="" || $_POST['test_time']==""){msg('添加科目和考试时间都不能为空！','test.php?action=subject_add'); exit();}
	$checksub=connect_sql_total("select test_sub from test_subject where test_sub='$_POST[subjectadd]'");
	if($checksub>0){msg('该科目已存在，不能重复添加！','test.php?action=subject_add');exit();}
	if(!checksint($_POST['test_time'])){msg('考试时长只能为正整数！！','test.php?action=subject_add');exit();}
	$addsubject=sql_insert("insert into test_subject(test_sub,test_time,addtime) value ('$_POST[subjectadd]','$_POST[test_time]',now())");
    if($addsubject){
    	msg('添加成功','test.php?action=subject_add');
    }else {
    	msg('操作失败','test.php?action=subject_add');
    };
}
//添加题型
if (isset($_GET["action"]) && $_GET["action"]=='add_bigtest'){
	if(!checksint($_POST['score']) || !checknum($_POST['test_num'])){msg('分数应为正整数，题数应为整数！！','test.php?action=add_bigtest');exit();}
    $row=connect_sql_total("select test_subject_id,bigtitle from big_test where test_subject_id='$_POST[subjec]' and bigtitle='$_POST[bigtest]'");
	if($row>0){msg('本科目该题型已被添加，不能重复添加同一题型','test.php?action=add_bigtest');exit();}
    $result=sql_insert("insert into big_test(test_subject_id,bigtitle,sscore,test_num) value ('$_POST[subjec]','$_POST[bigtest]','$_POST[score]','$_POST[test_num]')");
    $result?msg('添加成功！','test.php?action=add_bigtest'):msg('操作失败','test.php?action=add_bigtest');
}
// 添加小题
if (isset($_GET["action"]) && $_GET["action"]=='add_smtest'){
    $row=sql_operate("select test_sub from test_subject where id='$_GET[s]'");	
?>
<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF" align="center">
	<tr>
		<td colspan="4" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF"><?=$row['test_sub']?></font></b></nobr></td>
	</tr>
	<tr>
		<td width="25%" align="center" bgcolor="#8BAEE5">题型</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">分数(分/每小题)</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">题数</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">操作</td>
	</tr>
<?php 
    $subj=$_GET['s'];
    $sqlstr="select * from big_test where test_subject_id='$subj'";
    $row=connect_sql_total($sqlstr);
    if($row<=0){echo '<tr><td>本科目还没有添加任何题型！！</td></tr><tr><td colspan=3 align=center bgcolor=#8BAEE5> <b><a href=test.php?action=subject_add>添加题型</a></b> </td></tr></table>';exit();}
    $result=sql_select($sqlstr);
    while ($row=mysql_fetch_array($result)){
?>
    	<tr>
		<td width="25%" align="center" bgcolor="#FFFFFF"><a href="operate.php?op=txsearch&id=<?=$row['bigtitle']?>&sid=<?=$subj?>"><?php btest($row['bigtitle']);?></a></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><?=$row['sscore']?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><?=$row['test_num']?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><a href="operate.php?op=editscore&id=<?=$row['id']?>&sid=<?=$subj?>">编辑</a>｜<a href="javascript:DoEmpty('<?echo $row['id'].'&tid='.$row['bigtitle'].'&sid='.$_GET['s']?>');">删除</a></td>
	    </tr>
<?php }?>
	<tr>
		<td colspan="4" align="center" bgcolor="#8BAEE5"> <b><a href="test.php?action=add_bigtest">添加题型</a></b> </td>
	</tr>
</table>
<?php } ?>
</body>
</html>