<?php
require_once("function.php");
require_once("../language.php");
seuser();
?>
<html>
<head>
<title>���߿���ϵͳ����������</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet"  href="../pic/style.css" type="text/css">
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("���Ҫɾ���ÿ�Ŀ��"))
window.location = "operateuser.php?op=del&id=" + params ;
}
//-->
</script>
</head>
<body>
<center>
<?php
//�û���Ӵ���
if(isset($_POST['subm'])){
	if($_POST[stunum]=="" || $_POST[stuname]=="" || $_POST[stupass]=="" || $_POST[stuclass]=="" || $_POST[stupro]==""){msg('���е���Ŀ������Ϊ�գ�','stu.php?action=adduser');exit();}
	if(!checknum($_POST['stunum'])){msg('ѧ��ֻ��Ϊ���֣�','stu.php?action=adduser');exit();}
	if(!checksint($_POST['stupass'])){msg('���벻��������λ����ֻ������ĸ��������ϣ�','stu.php?action=adduser');exit();}
	$row=connect_sql_total("select stunum from students where stunum='$_POST[stunum]'");
	if($row>0){msg('��ѧ���û��Ѵ��ڣ��������','stu.php?action=adduser');exit();}
	$passw=md5("$_POST[userpass]");
	$addstu=sql_insert("insert into students(stunum,realyname,passw,stuclass,proression) value ('$_POST[stunum]','$_POST[stuname]','$passw','$_POST[stuclass]','$_POST[stupro]')");
    if($addstu){
    	msg('��ӳɹ���','stu.php?action=adduser');
    }else {msg('���ʧ�ܣ�','stu.php?action=adduser');}
}
//�趨�û�Ĭ�����봦��
if(isset($_POST['submpass'])){
	$postpass=md5($_POST[typass]);
	$typass=sql_update("update students set passw='$postpass'");
	if($typass){ msg('Ĭ�������趨�ɹ���','stu.php?action=typass');}
	else {msg('Ĭ�������趨ʧ�ܣ�','stu.php?action=typass');}
}
//���š��رտ���
if(isset($_GET["action"]) && $_GET["action"]=="oct"){
	$openr=sql_operate("select locked from to_admin");
	if($openr['locked']==1){
	   $opent=sql_update("update to_admin set locked=0");
	   echo "<script language=\"javascript\">alert('���ſ��Գɹ�����')</script>";
	   echo '<font color="red" size="20">����</font>���Գɹ�����  �������������';
	}elseif ($openr['locked']==0){
	   $opent=sql_update("update to_admin set locked=1");
	   echo "<script language=\"javascript\">alert('�رտ��Գɹ�����')</script>";
	   echo '<font color="red" size="20">�ر�</font>���Գɹ�����  �������������';
	}
}
//����û�
if(isset($_GET["action"]) && $_GET["action"]=="adduser"){
?>
<form action="" id="iform"  method="POST" >
<table  width="250" border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
  <tr>
    <td colspan="3" bgcolor="#698CC3" align="center"><nobr><b><font color="#FFFFFF" size="3">�û���Ϣ</font></b></nobr></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$stunumber?></td>
    <td colspan="2" bgcolor="#FFFFFF"><input type="text" id="stunum" name="stunum"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$realyname?></td>
    <td colspan="2" bgcolor="#FFFFFF"><input type="text" id="stuname" name="stuname"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$stuclass?></td>
    <td colspan="2" bgcolor="#FFFFFF"><input type="text" id="stuclass" name="stuclass"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$profession?></td>
    <td colspan="2" bgcolor="#FFFFFF"><input type="text" id="stupro" name="stupro"></td>
  </tr>
    <tr>
    <td bgcolor="#FFFFFF">���룺</td>
    <td colspan="2" bgcolor="#FFFFFF"><input type="text" ��maxlength="16" id="stupass" name="stupass"></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF" align="center"><input type="submit" id="subm" name="subm" value="���"></td>
  </tr>
</table>
</form>
<?php }
//�û��б�
if(isset($_GET["action"]) && $_GET["action"]=="userlist"){ 
?>
	<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="5" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�û��б�</font></b></nobr></td>
	</tr>
	<tr>
		<td width="20%" align="center" bgcolor="#8BAEE5">ѧ��</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">����</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">��λ</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">רҵ</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">����</td>
	</tr>
	<?php
	if(isset($_POST['tag'])&&$_POST['tag']==num){
	if(isset($_POST['searchnum'])&&$_POST['searchnum']==""){msg('��û�������κ�Ҫ���ҵ����ݣ�','search.php');exit();}
	$suser=sql_select("select * from students where stunum like '%$_POST[searchnum]%'");
	$result=$suser;
	}
	if(isset($_POST['tag'])&&$_POST['tag']==name){
	if(isset($_POST['searchname'])&&$_POST['searchname']==""){msg('��û�������κ�Ҫ���ҵ����ݣ�','stu.php?action=searchuser');exit();}
	$reasch=sql_select("select * from students where realyname like '%$_POST[searchname]%'");
	$result=$reasch;
	}
	if(!isset($_POST['tag'])){
	$pcount="select count(*) as count from students";
	$arr=pageup($pcount,'students','order by stunum desc');
    pagedown($arr[1],'action=userlist');
    $result=$arr[0];
	}
	   while ($row=mysql_fetch_array($result)){ ?>
	    <tr>
	    <td width="20%" align="center" bgcolor="#ffffff"><a href="operateuser.php?op=score&id=<?=$row['id']?>"><?=$row['stunum']?></a></td>
		<td width="20%" align="center" bgcolor="#FFFFFF"><?=$row['realyname']?></td>
		<td width="20%" align="center" bgcolor="#FFFFFF"><?=$row['stuclass']?></td>
		<td width="20%" align="center" bgcolor="#FFFFFF"><?=$row['proression']?></td>
		<td width="20%" align="center" bgcolor="#FFFFFF"><a href="operateuser.php?op=edit&id=<?=$row['id']?>">�༭</a>��<a href="javascript:DoEmpty('<?=$row['id']?>');">ɾ��</a></td>
	    </tr>   		
	 <?php } ?>
	<tr>
		<td colspan="5" align="center" bgcolor="#8BAEE5"> <b><a href="stu.php?action=adduser">����û�</a></b> </td>
	</tr>
</table>
<?php
}
//�趨�û�Ĭ������
if(isset($_GET["action"]) && $_GET["action"]=="typass"){
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">�趨�û�Ĭ������</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">Ĭ������</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="typass" size="25" maxlength="20" value=""></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input  id="submpass" name="submpass" type="submit" value=" �趨 "> </td>
	</tr>
</table>
<br /><font color="Red">ע�⣺������������������û������룬<br />�����û������붼����Ϊ�����Ĭ�����룡</font>
</form>
<?php }?>
</center>
</body>
</html>