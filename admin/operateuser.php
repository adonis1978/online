<?php
require("function.php");
seuser();
?>
<head>
<title>���߿���ϵͳ����������</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("���Ҫɾ���ÿ�Ŀ��"))
window.location = "userscore.php?op=del&id=" + params ;
}
//-->
</script>
</head>
<center>
<?php
if($_GET['op']=='del'){
	$stucj=connect_sql_total("select students from chengji where students='$_GET[id]'");
	if($stucj>0){msg('���û��гɼ����ڣ�����ɾ�����û������гɼ����ٽ���Щ�����','stu.php?action=userlist');exit();}
    $studel=sql_update("delete from students where id=$_GET[id]");
    if($studel){
    	msg('ɾ���ɹ�','stu.php?action=userlist');exit();
    }else {msg('����ʧ��','stu.php?action=userlist');exit();}
}
//�û��༭
if($_POST['subm']){
	$updatestu=sql_update("update students set stunum='$_POST[stunum]',realyname='$_POST[stuname]',stuclass='$_POST[stuclass]',proression='$_POST[stupro]' where id='$_GET[id]'");
	if($updatestu){
		msg('�༭�ɹ���','stu.php?action=userlist');exit();
	}else {
		msg('����ʧ�ܣ�','stu.php?action=userlist');exit();
	}
}
if($_POST['submi']){
	if($_POST['passw']==""){msge('���벻��Ϊ�գ��뷵�أ�   <input   type="button"   name="back"   value="����"   onclick="history.back()">');exit();}
	$passw=md5("$_POST[passw]");
	$updatestu=sql_update("update students set passw='$passw' where id='$_GET[id]'");
	if($updatestu){
		msg('�޸ĳɹ���','stu.php?action=userlist');exit();
	}else {
		msg('����ʧ�ܣ�','stu.php?action=userlist');exit();
	}
}
if($_GET['op']=='edit'){
	$rowstu=sql_operate("select * from students where id='$_GET[id]'");
?>
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�û��༭</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">ѧ��</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><input type="text" name="stunum" size="25" maxlength="25" value="<?=$rowstu['stunum']?>" title="<?=$rowstu['stunum']?>"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">����</td>
		<td align="left" bgcolor="#EEEEEE"><input type="text" name="stuname" size="25" maxlength="20" value="<?=$rowstu['realyname']?>"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FFFFFF">�༶</td>
		<td align="left" bgcolor="#FFFFFF"><input type="text" name="stuclass" size="25" maxlength="50" value="<?=$rowstu['stuclass']?>"></td>
	</tr>	
	<tr>
		<td align="center" bgcolor="#EEEEEE">רҵ</td>
		<td align="left" bgcolor="#EEEEEE"><input type="text" name="stupro" size="25" maxlength="50" value="<?=$rowstu['proression']?>"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input id="subm" name="subm" type="submit" value=" �༭ "> <input type="reset" value=" ���� "></td>
	</tr>
</table>
</form>
<br />
<form action="" method="post" name="form1">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�޸�����</font></b></nobr></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FFFFFF">����</td>
		<td align="left" bgcolor="#FFFFFF"><input type="text" name="passw" size="25" maxlength="25" value=""></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input id="submi" name="submi" type="submit" value=" �޸� "></td>
	</tr>	
</table>	
</form>
<? } 
//�û��ɼ�
if($_GET['op']=='score'){
$score=sql_select("
select a.test_sub,
       b.*,
       c.stunum
from  (chengji as b  left  join test_subject as a on a.id=b.subject  )
left join students as c on c.id=b.students and students='$_GET[id]' order by stunum desc
");
?>	
	<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="9" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�û��ɼ�</font></b></nobr></td>
	</tr>
	<tr>
		<td width="20%" align="center" bgcolor="#8BAEE5">��Ŀ</td>
		<td width="15%" align="center" bgcolor="#8BAEE5">ѧ��</td>
		<td width="15%" align="center" bgcolor="#8BAEE5">����ʱ��</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">�͹���ɼ�</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">������ɼ�</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">�ܳɼ�</td>
		<td width="5%" align="center" bgcolor="#8BAEE5">ȱ��</td>
		<td width="5%" align="center" bgcolor="#8BAEE5">����</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">����</td>
	</tr>
	<?php 
	
	while ($row=mysql_fetch_array($score)){
		if($row['stunum']==""){ exit();}
	?>
	    <tr>
	    <td width="20%" align="center" bgcolor="#ffffff"><?=$row['test_sub']?></td>
		<td width="15%" align="center" bgcolor="#FFFFFF"><?=$row['stunum']?></td>
		<td width="15%" align="center" bgcolor="#FFFFFF"><?=$row['testdate']?></td>
		<td width="10%" align="center" bgcolor="#FFFFFF"><?=$row['kscore']?></td>
		<td width="10%" align="center" bgcolor="#FFFFFF"><?=$row['zscore']?></td>
		<td width="10%" align="center" bgcolor="#FFFFFF"><?=$row['kscore']+$row['zscore']?></td>
		<td width="5%" align="center" bgcolor="#FFFFFF">
		    <? if($row['quekao']==1){echo '��';}
		       if($row['quekao']==0){echo '��';}  
		     ?>
		</td>
		<td width="5%" align="center" bgcolor="#FFFFFF">
		    <? if($row['huankao']==1){echo '��';}
		       if($row['huankao']==0){echo '��';}  
		     ?>		    
		</td>
		<td width="10%" align="center" bgcolor="#FFFFFF"><a href="userscore.php?op=edit&id=<?=$row['id']?>&kgcj=<?=$row['kscore']?>&zgcj=<?=$row['zscore']?>">�༭</a>��<a href="javascript:DoEmpty('<?=$row['id']?>');">ɾ��</a></td>
	    </tr>   		
     <? } ?>
	<tr>
		<td colspan="6" align="center" bgcolor="#8BAEE5"></td>
	</tr>
</table>
<? 
}
?>
</center>