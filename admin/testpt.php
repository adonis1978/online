<?php
require_once("function.php");
seuser(); ?>
<html>
<head>
<title>���߿���ϵͳ����������</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("���Ҫɾ����������"))
window.location = "operate.php?op=deltx&id=" + params ;
}
//-->
</script>
</head>
<body>
<?php
//��ӿ�Ŀ
if (isset($_GET["action"]) && $_GET["action"]=='subject_add'){
	if($_POST['subjectadd']=="" || $_POST['test_time']==""){msg('��ӿ�Ŀ�Ϳ���ʱ�䶼����Ϊ�գ�','test.php?action=subject_add'); exit();}
	$checksub=connect_sql_total("select test_sub from test_subject where test_sub='$_POST[subjectadd]'");
	if($checksub>0){msg('�ÿ�Ŀ�Ѵ��ڣ������ظ���ӣ�','test.php?action=subject_add');exit();}
	if(!checksint($_POST['test_time'])){msg('����ʱ��ֻ��Ϊ����������','test.php?action=subject_add');exit();}
	$addsubject=sql_insert("insert into test_subject(test_sub,test_time,addtime) value ('$_POST[subjectadd]','$_POST[test_time]',now())");
    if($addsubject){
    	msg('��ӳɹ�','test.php?action=subject_add');
    }else {
    	msg('����ʧ��','test.php?action=subject_add');
    };
}
//�������
if (isset($_GET["action"]) && $_GET["action"]=='add_bigtest'){
	if(!checksint($_POST['score']) || !checknum($_POST['test_num'])){msg('����ӦΪ������������ӦΪ��������','test.php?action=add_bigtest');exit();}
    $row=connect_sql_total("select test_subject_id,bigtitle from big_test where test_subject_id='$_POST[subjec]' and bigtitle='$_POST[bigtest]'");
	if($row>0){msg('����Ŀ�������ѱ���ӣ������ظ����ͬһ����','test.php?action=add_bigtest');exit();}
    $result=sql_insert("insert into big_test(test_subject_id,bigtitle,sscore,test_num) value ('$_POST[subjec]','$_POST[bigtest]','$_POST[score]','$_POST[test_num]')");
    $result?msg('��ӳɹ���','test.php?action=add_bigtest'):msg('����ʧ��','test.php?action=add_bigtest');
}
// ���С��
if (isset($_GET["action"]) && $_GET["action"]=='add_smtest'){
    $row=sql_operate("select test_sub from test_subject where id='$_GET[s]'");	
?>
<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF" align="center">
	<tr>
		<td colspan="4" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF"><?=$row['test_sub']?></font></b></nobr></td>
	</tr>
	<tr>
		<td width="25%" align="center" bgcolor="#8BAEE5">����</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">����(��/ÿС��)</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">����</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">����</td>
	</tr>
<?php 
    $subj=$_GET['s'];
    $sqlstr="select * from big_test where test_subject_id='$subj'";
    $row=connect_sql_total($sqlstr);
    if($row<=0){echo '<tr><td>����Ŀ��û������κ����ͣ���</td></tr><tr><td colspan=3 align=center bgcolor=#8BAEE5> <b><a href=test.php?action=subject_add>�������</a></b> </td></tr></table>';exit();}
    $result=sql_select($sqlstr);
    while ($row=mysql_fetch_array($result)){
?>
    	<tr>
		<td width="25%" align="center" bgcolor="#FFFFFF"><a href="operate.php?op=txsearch&id=<?=$row['bigtitle']?>&sid=<?=$subj?>"><?php btest($row['bigtitle']);?></a></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><?=$row['sscore']?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><?=$row['test_num']?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><a href="operate.php?op=editscore&id=<?=$row['id']?>&sid=<?=$subj?>">�༭</a>��<a href="javascript:DoEmpty('<?echo $row['id'].'&tid='.$row['bigtitle'].'&sid='.$_GET['s']?>');">ɾ��</a></td>
	    </tr>
<?php }?>
	<tr>
		<td colspan="4" align="center" bgcolor="#8BAEE5"> <b><a href="test.php?action=add_bigtest">�������</a></b> </td>
	</tr>
</table>
<?php } ?>
</body>
</html>