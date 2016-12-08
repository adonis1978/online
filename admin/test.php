<?php
include_once("function.php");
seuser();//屏蔽非法访问
?>
<html>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("真的要删除该科目吗？"))
window.location = "operate.php?op=del&id=" + params ;
}
//-->
</script>
</head>
<body>
<center>
<?php
echo "123"."456";
if (isset($_GET["action"]) && $_GET["action"]=='subject_list'){
?>
<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="4" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">科目列表</font></b></nobr></td>
	</tr>
	<tr>
		<td width="25%" align="center" bgcolor="#8BAEE5">考试科目</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">创建时间</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">考试时长(分钟)</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">操作</td>
	</tr>
	<?php $result=sql_select("select * from test_subject");
	   
	    while ($row=mysql_fetch_array($result)){ ?>
	    <tr>
		<td width="25%" align="center" bgcolor="#FFFFFF"><a href="testpt.php?action=add_smtest&s=<?=$row['id']?>"><?=$row['test_sub']?></a></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><?=$row['addtime']?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><?=$row['test_time']?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF">
		    <a href="operate.php?op=edit&id=<?=$row['id']?>">编辑</a>｜
		    <a href="javascript:DoEmpty('<?=$row['id']?>');">删除</a>｜
		    <a href="operate.php?op=subscore&id=<?=$row['id']?>">成绩</a>
		</td>
	    </tr>   		
	 <?php} ?>
	<tr>
		<td colspan="4" align="center" bgcolor="#8BAEE5"> <b><a href="test.php?action=subject_add">添加科目</a></b> </td>
	</tr>
</table>


<?php } 
if(isset($_GET["action"]) && $_GET["action"]=='subject_add'){
	echo "123"."4512";
?>
<form action="testpt.php?action=subject_add" method="post" name="iform" onsubmit="return subjectadd()">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">添加科目</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">添加科目</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="subjectadd" id="subjectadd" size="25" maxlength="40"></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">考试时长</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text"  id="test_time" name="test_time" size="25" maxlength="20"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><font color="#CC3333">考试时长为分钟整数型式，否则出错！</font><br><input type="submit"  id="subm" name="subm" value=" 添加 "> </td>
	</tr>
</table>
</form>
<?php }
if(isset($_GET["action"]) && $_GET["action"]=='add_bigtest'){
?>
	<form action="testpt.php?action=add_bigtest" method="POST" id="addbtform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">添加题型</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">选择科目</td>
		<td width="35%" align="left" bgcolor="#FFFFFF">
	<select id="subjec" size=1 name="subjec" style="width:176px" onchange="this.options[this.selectedIndex].value">
	<?php
		$result=sql_select("SELECT id,test_sub FROM test_subject");
		while($row = mysql_fetch_array($result))
		{
             $check=$row['id'];
			  echo "\n";
			echo '<option value="'.$check.'">'.$row['test_sub'].'</option>';
		}

	?>
	</select>
	</td>
	</tr>
	
	<tr>
	<td align="center">添加题型</td>
	<td>
	</select>
	<select id="bigtest" size=1 name="bigtest" style="width:176px" onchange="this.options[this.selectedIndex].value">
     <option value="1">单选</option>
     <option value="2">多选</option>
     <option value="3">填空</option>
     <option value="4">判断</option>
     <option value="5">简答</option>
	</select>
	</td>
	</tr>
	
	<tr><td bgcolor="#ffffff" align="center">设定分数</td>
	    <td bgcolor="#ffffff"><input id="socre" name="score" type="text"></td> 
	</tr>
	
	<tr><td bgcolor="#ffffff" align="center">设定题数(用于随机生成试卷)</td>
	    <td bgcolor="#ffffff"><input id="test_num" name="test_num" type="text"></td> 
	</tr>
	
	<tr>
		<td colspan="2" align="center" bgcolor="#8BAEE5"><input type="submit" value=" 添加 "> </td>
	</tr>
</table>
</form>

<?php } }?>
</center>
</body>
</html>