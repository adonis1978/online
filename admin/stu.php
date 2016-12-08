<?php
require_once("function.php");
require_once("../language.php");
seuser();
?>
<html>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet"  href="../pic/style.css" type="text/css">
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("真的要删除该科目吗？"))
window.location = "operateuser.php?op=del&id=" + params ;
}
//-->
</script>
</head>
<body>
<center>
<?php
//用户添加处理
if(isset($_POST['subm'])){
	if($_POST[stunum]=="" || $_POST[stuname]=="" || $_POST[stupass]=="" || $_POST[stuclass]=="" || $_POST[stupro]==""){msg('所有的项目都不能为空！','stu.php?action=adduser');exit();}
	if(!checknum($_POST['stunum'])){msg('学号只能为数字！','stu.php?action=adduser');exit();}
	if(!checksint($_POST['stupass'])){msg('密码不能少于六位，且只能是字母和数字组合！','stu.php?action=adduser');exit();}
	$row=connect_sql_total("select stunum from students where stunum='$_POST[stunum]'");
	if($row>0){msg('本学号用户已存在！不能添加','stu.php?action=adduser');exit();}
	$passw=md5("$_POST[userpass]");
	$addstu=sql_insert("insert into students(stunum,realyname,passw,stuclass,proression) value ('$_POST[stunum]','$_POST[stuname]','$passw','$_POST[stuclass]','$_POST[stupro]')");
    if($addstu){
    	msg('添加成功！','stu.php?action=adduser');
    }else {msg('添加失败！','stu.php?action=adduser');}
}
//设定用户默认密码处理
if(isset($_POST['submpass'])){
	$postpass=md5($_POST[typass]);
	$typass=sql_update("update students set passw='$postpass'");
	if($typass){ msg('默认密码设定成功！','stu.php?action=typass');}
	else {msg('默认密码设定失败！','stu.php?action=typass');}
}
//开放　关闭考试
if(isset($_GET["action"]) && $_GET["action"]=="oct"){
	$openr=sql_operate("select locked from to_admin");
	if($openr['locked']==1){
	   $opent=sql_update("update to_admin set locked=0");
	   echo "<script language=\"javascript\">alert('开放考试成功！！')</script>";
	   echo '<font color="red" size="20">开放</font>考试成功！！  请继续其它操作';
	}elseif ($openr['locked']==0){
	   $opent=sql_update("update to_admin set locked=1");
	   echo "<script language=\"javascript\">alert('关闭考试成功！！')</script>";
	   echo '<font color="red" size="20">关闭</font>考试成功！！  请继续其它操作';
	}
}
//添加用户
if(isset($_GET["action"]) && $_GET["action"]=="adduser"){
?>
<form action="" id="iform"  method="POST" >
<table  width="250" border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
  <tr>
    <td colspan="3" bgcolor="#698CC3" align="center"><nobr><b><font color="#FFFFFF" size="3">用户信息</font></b></nobr></td>
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
    <td bgcolor="#FFFFFF">密码：</td>
    <td colspan="2" bgcolor="#FFFFFF"><input type="text" 　maxlength="16" id="stupass" name="stupass"></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF" align="center"><input type="submit" id="subm" name="subm" value="添加"></td>
  </tr>
</table>
</form>
<?php }
//用户列表
if(isset($_GET["action"]) && $_GET["action"]=="userlist"){ 
?>
	<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="5" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">用户列表</font></b></nobr></td>
	</tr>
	<tr>
		<td width="20%" align="center" bgcolor="#8BAEE5">学号</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">姓名</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">单位</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">专业</td>
		<td width="20%" align="center" bgcolor="#8BAEE5">操作</td>
	</tr>
	<?php
	if(isset($_POST['tag'])&&$_POST['tag']==num){
	if(isset($_POST['searchnum'])&&$_POST['searchnum']==""){msg('您没有输入任何要查找的内容！','search.php');exit();}
	$suser=sql_select("select * from students where stunum like '%$_POST[searchnum]%'");
	$result=$suser;
	}
	if(isset($_POST['tag'])&&$_POST['tag']==name){
	if(isset($_POST['searchname'])&&$_POST['searchname']==""){msg('您没有输入任何要查找的内容！','stu.php?action=searchuser');exit();}
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
		<td width="20%" align="center" bgcolor="#FFFFFF"><a href="operateuser.php?op=edit&id=<?=$row['id']?>">编辑</a>｜<a href="javascript:DoEmpty('<?=$row['id']?>');">删除</a></td>
	    </tr>   		
	 <?php } ?>
	<tr>
		<td colspan="5" align="center" bgcolor="#8BAEE5"> <b><a href="stu.php?action=adduser">添加用户</a></b> </td>
	</tr>
</table>
<?php
}
//设定用户默认密码
if(isset($_GET["action"]) && $_GET["action"]=="typass"){
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">设定用户默认密码</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">默认密码</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="typass" size="25" maxlength="20" value=""></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input  id="submpass" name="submpass" type="submit" value=" 设定 "> </td>
	</tr>
</table>
<br /><font color="Red">注意：此项操作将更改所有用户的密码，<br />所有用户的密码都将成为添入的默认密码！</font>
</form>
<?php }?>
</center>
</body>
</html>