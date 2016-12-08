<?php
require("function.php");
seuser();
?>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("真的要删除该科目吗？"))
window.location = "userscore.php?op=del&id=" + params ;
}
//-->
</script>
</head>
<center>
<?php
if($_GET['op']=='del'){
	$stucj=connect_sql_total("select students from chengji where students='$_GET[id]'");
	if($stucj>0){msg('该用户有成绩存在，请先删除该用户的所有成绩，再进行些项操作','stu.php?action=userlist');exit();}
    $studel=sql_update("delete from students where id=$_GET[id]");
    if($studel){
    	msg('删除成功','stu.php?action=userlist');exit();
    }else {msg('操作失败','stu.php?action=userlist');exit();}
}
//用户编辑
if($_POST['subm']){
	$updatestu=sql_update("update students set stunum='$_POST[stunum]',realyname='$_POST[stuname]',stuclass='$_POST[stuclass]',proression='$_POST[stupro]' where id='$_GET[id]'");
	if($updatestu){
		msg('编辑成功！','stu.php?action=userlist');exit();
	}else {
		msg('操作失败！','stu.php?action=userlist');exit();
	}
}
if($_POST['submi']){
	if($_POST['passw']==""){msge('密码不能为空！请返回！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
	$passw=md5("$_POST[passw]");
	$updatestu=sql_update("update students set passw='$passw' where id='$_GET[id]'");
	if($updatestu){
		msg('修改成功！','stu.php?action=userlist');exit();
	}else {
		msg('操作失败！','stu.php?action=userlist');exit();
	}
}
if($_GET['op']=='edit'){
	$rowstu=sql_operate("select * from students where id='$_GET[id]'");
?>
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">用户编辑</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">学号</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><input type="text" name="stunum" size="25" maxlength="25" value="<?=$rowstu['stunum']?>" title="<?=$rowstu['stunum']?>"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EEEEEE">姓名</td>
		<td align="left" bgcolor="#EEEEEE"><input type="text" name="stuname" size="25" maxlength="20" value="<?=$rowstu['realyname']?>"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FFFFFF">班级</td>
		<td align="left" bgcolor="#FFFFFF"><input type="text" name="stuclass" size="25" maxlength="50" value="<?=$rowstu['stuclass']?>"></td>
	</tr>	
	<tr>
		<td align="center" bgcolor="#EEEEEE">专业</td>
		<td align="left" bgcolor="#EEEEEE"><input type="text" name="stupro" size="25" maxlength="50" value="<?=$rowstu['proression']?>"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input id="subm" name="subm" type="submit" value=" 编辑 "> <input type="reset" value=" 重填 "></td>
	</tr>
</table>
</form>
<br />
<form action="" method="post" name="form1">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">修改密码</font></b></nobr></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#FFFFFF">密码</td>
		<td align="left" bgcolor="#FFFFFF"><input type="text" name="passw" size="25" maxlength="25" value=""></td>
	</tr>	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input id="submi" name="submi" type="submit" value=" 修改 "></td>
	</tr>	
</table>	
</form>
<? } 
//用户成绩
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
		<td colspan="9" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">用户成绩</font></b></nobr></td>
	</tr>
	<tr>
		<td width="20%" align="center" bgcolor="#8BAEE5">科目</td>
		<td width="15%" align="center" bgcolor="#8BAEE5">学号</td>
		<td width="15%" align="center" bgcolor="#8BAEE5">考试时间</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">客观题成绩</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">主观题成绩</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">总成绩</td>
		<td width="5%" align="center" bgcolor="#8BAEE5">缺考</td>
		<td width="5%" align="center" bgcolor="#8BAEE5">缓考</td>
		<td width="10%" align="center" bgcolor="#8BAEE5">操作</td>
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
		    <? if($row['quekao']==1){echo '是';}
		       if($row['quekao']==0){echo '否';}  
		     ?>
		</td>
		<td width="5%" align="center" bgcolor="#FFFFFF">
		    <? if($row['huankao']==1){echo '是';}
		       if($row['huankao']==0){echo '否';}  
		     ?>		    
		</td>
		<td width="10%" align="center" bgcolor="#FFFFFF"><a href="userscore.php?op=edit&id=<?=$row['id']?>&kgcj=<?=$row['kscore']?>&zgcj=<?=$row['zscore']?>">编辑</a>｜<a href="javascript:DoEmpty('<?=$row['id']?>');">删除</a></td>
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