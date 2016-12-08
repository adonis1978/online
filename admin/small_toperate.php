<?php
require_once("function.php");
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
if (confirm("真的要删除该选项吗？"))
window.location = "xx_operate.php?op=del&id=" + params ;
}
//-->
</script>
</head>
<center>
<?php
//删除试题
if($_GET['op']=='delst'){
   if($_GET['tid']>=1 and $_GET['tid']<=4){
	  $delsr=sql_update("delete from small_result where smalltitle_id=$_GET[id]");
	  if($delsr){
	     $delst=sql_update("delete from small_test where id=$_GET[id]");
	     if($delst){
		    msge('删除成功！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">'); exit();
	      } else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
	  } else {msge('删除选项时出现错误！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
   }
   if($_GET['tid']==5){
	  $delsr=sql_update("delete from brief_answer where id=$_GET[id]");
	  if($delsr){msge('删除成功！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
	  else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
   }
}
//删除题型下全部试题
if($_GET['op']=='delat'){
	if($_GET['id']>=1 and $_GET['id']<=4){
		$result=sql_select("select id from small_test where bigtitle_id=$_GET[id] and subject_id=$_GET[sid]");
		while ($row=mysql_fetch_array($result)){
			$delxx=sql_update("delete from small_result where smalltitle_id=$row[id]");
		}
		if($delxx){
		    $delall=sql_update("delete from small_test where bigtitle_id=$_GET[id] and subject_id=$_GET[sid]");
		    if($delall){
		    	msge('删除成功！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();
		    }else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
		}else {msge('删除选项时出现错误！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
	}
	if($_GET['id']==5){
		$delall=sql_update("delete from brief_answer where subject_id=$_GET[sid]");
		if($delall){
		    msge('删除成功！ <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();
		}else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}		
	}
}
//添加试题
if($_POST['subm']){	    
	if($_POST['bt']=="" || $_POST['ans']==""){msge('标题和正确选项都不能为空！请返回 <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
	$ans=trim($_POST['ans']);
	if($_GET['id']>=1 and $_GET['id']<=4){
	    $insertsm=sql_insert("insert into small_test(smalltitle,bigtitle_id,bt_answer,subject_id) values ('$_POST[bt]','$_GET[id]','$ans','$_GET[sid]')");
	    if($insertsm){
		    msg('添加成功！　请返回可"添加该题选项"或继续"添加试题"',"operate.php?op=txsearch&id=$_GET[id]&sid=$_GET[sid]");exit();
	    }else {msg('添加失败！',"operate.php?op=txsearch&id=$_GET[id]&sid=$_GET[sid]");exit();}
	}
	if($_GET['id']==5){
	    $insertsm=sql_insert("insert into brief_answer(brief_topic,brief_ans,subject_id,testkey) values ('$_POST[bt]','$ans','$_GET[sid]','$_POST[testkey]')");
	    if($insertsm){
		    msg('添加成功！　请返回可"添加该题选项"或继续"添加试题"',"operate.php?op=txsearch&id=$_GET[id]&sid=$_GET[sid]");exit();
	    }else {msg('添加失败！',"operate.php?op=txsearch&id=$_GET[id]&sid=$_GET[sid]");exit();}
	}
}
if($_GET['action']=='test_add'){
	if($_GET['id']>=1 and $_GET['id']<=3){
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">添加试题</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">标题</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="bt" id="bt" size="25" maxlength="200"></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">正确答案</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text"  id="ans" name="ans" size="25" maxlength="50"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><font color="#CC3333">单选，多选的正确答案的大小写必须和对应选项的大小写一致，否则会出错！<br />多选以abc的形式设定。<br />填空添入答案即可（多个空用<font color="Red">"英文的逗号"</font>隔开即可）。</font><br><input type="submit"  id="subm" name="subm" value=" 添加 "> </td>
	</tr>
</table>
</form>
<? } if($_GET['id']==4){
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">添加试题</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">标题</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="bt" id="bt" size="25" maxlength="200"></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">正确答案</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="radio" id="ans" name="ans" value="1">正确<input type="radio" id="ans" name="ans" value="0">错误</td>
	</tr>	
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><input type="submit"  id="subm" name="subm" value=" 添加 "> </td>
	</tr>
</table>
</form>
<?}
if($_GET['id']==5){
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="410" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">添加试题</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">标题</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><textarea cols="50" rows="5" name="bt" id="bt"></textarea></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">正确答案</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><textarea cols="50" rows="5" name="ans" id="ans"></textarea></td>
	</tr>	
	<tr>
		<td width="30%" align="left" bgcolor="#FFFFFF">评分关键字</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><input id="testkey" name="testkey" type="text" size="50" maxlength="150"><br>多个用<font color="Red">英文的逗号</font>分开</td>
	</tr>	
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><input type="submit"  id="subm" name="subm" value=" 添加 "> </td>
	</tr>
</table>
</form>
<?php
  }
} //添加试题结束
//编辑试题
if($_POST['submi']){
	if($_POST['bt']=="" || $_POST['ans']==""){msge('标题和正确选项都不能为空！请返回 <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
	$ans=trim($_POST['ans']);
	if($_GET['tid']>=1 and $_GET['tid']<=4){
	    $insertsm=sql_update("update small_test set smalltitle='$_POST[bt]',bt_answer='$_POST[ans]' where id='$_GET[id]'");
	    if($insertsm){
		    msg('编辑成功！　请返回可"添加该题选项"或继续"添加试题"',"operate.php?op=txsearch&id=$_GET[tid]&sid=$_GET[sid]");exit();
	    }else {msg('编辑失败！',"operate.php?op=txsearch&id=$_GET[tid]&sid=$_GET[sid]");exit();}
	}
	if($_GET['tid']==5){
	    $insertsm=sql_update("update brief_answer set brief_topic='$_POST[bt]',brief_ans='$_POST[ans]',testkey='$_POST[testkey]' where id='$_GET[id]'");
	    if($insertsm){
		    msg('编辑成功！　请返回可"添加该题选项"或继续"添加试题"',"operate.php?op=txsearch&id=$_GET[tid]&sid=$_GET[sid]");exit();
	    }else {msg('编辑失败！',"operate.php?op=txsearch&id=$_GET[tid]&sid=$_GET[sid]");exit();}
	}
}
if($_GET['op']=='edit'){
	if($_GET['tid']>=1 and $_GET['tid']<=4){
		$rows=sql_operate("select smalltitle,bt_answer from small_test where id=$_GET[id]");
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="300" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">添加试题</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">标题</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text" name="bt" id="bt" size="35" maxlength="200" value="<?=$rows['smalltitle']?>"></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">正确答案</td>
		<td width="35%" align="left" bgcolor="#FFFFFF">
		     <?php
		     if($_GET['tid']==4){
		     ?>
		     <input type="text"  id="ans" name="ans" size="3" maxlength="1" value="<?=$rows['bt_answer']?>">
		     正确为<font color="Red">1</font>，错误为<font color="Red">0</font>
             <?} else {?>		
		     <input type="text"  id="ans" name="ans" size="25" maxlength="50" value="<?=$rows['bt_answer']?>">             
             <?}?>
		</td>
	</tr>	
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><input type="submit"  id="submi" name="submi" value="编辑"> </td>
	</tr>
</table>
</form>

<?} 
if($_GET['tid']==5){
	$rows=sql_operate("select brief_topic,brief_ans,testkey from brief_answer where id=$_GET[id]");
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="410" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">添加试题</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">标题</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><textarea cols="50" rows="5" name="bt" id="bt"><?=$rows['brief_topic']?></textarea></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">正确答案</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><textarea cols="50" rows="5" name="ans" id="ans"><?=$rows['brief_ans']?></textarea></td>
	</tr>	
	<tr>
		<td width="30%" align="left" bgcolor="#FFFFFF">评分关键字</td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><input id="testkey" name="testkey" type="text" size="50" maxlength="150" title="<?=$rows['testkey']?>" value="<?=$rows['testkey']?>"><br>多个用<font color="Red">英文的逗号</font>分开</td>
	</tr>
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><input type="submit"  id="submi" name="submi" value=" 编辑 "> </td>
	</tr>
</table>
</form>
<? }
} //编辑操作结束
//添加选项
if($_POST['subxx']){
	$addxx=sql_insert("insert into small_result(smalltitle_c,smalltitle_id,xx) values ('$_POST[xxnr]','$_GET[id]','$_POST[xx]')");
	if($addxx){
		 msge('添加成功！返回可继续添加 <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();
    }else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
}
if($_POST['edit']){
	$editxx=sql_update("update small_result set smalltitle_c='$_POST[exxnr]',xx='$_POST[exx]' where id='$_POST[eid]'");
	if($editxx){
		 msge('编辑成功！返回可继续添加 <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();
    }else {msge('操作失败！   <input   type="button"   name="back"   value="返回"   onclick="history.back()">');exit();}
}
if($_GET['op']=='add_xx'){
	$bigr=sql_operate("select smalltitle,id from small_test where id=$_GET[id]");
?>	
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" width="260px" align="left" bgcolor="#698CC3" style="word-break:break-all"><b><font color="#FFFFFF"><?=$bigr['smalltitle']?></font></b></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">选项</td>
		<td width="70%" align="left" bgcolor="#FFFFFF">选项内容</td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF"><input id="xx" name="xx" value="" size="5"></td>
		<td width="70%" align="left" bgcolor="#FFFFFF"><input id="xxnr" name="xxnr" value="" size="25" maxlength="150"></td>
	</tr>	
	<tr>
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><input type="submit"  id="subxx" name="subxx" value=" 确定 "> </td>
	</tr>
</table>
</form>
</br>
<table border="0" cellspacing="1" cellpadding="4" width="550" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="3" align="left" bgcolor="#698CC3"><b><font color="#FFFFFF">现有选项</font></b></td>
	</tr>
	<?php
	$xxshow=sql_select("select * from small_result where smalltitle_id='$_GET[id]'");
	while ($show=mysql_fetch_array($xxshow)){
	?>
	<form id="iform" method="POST" action="">
	<tr>
		<td width="5%" align="center" bgcolor="#FFFFFF"><input type="text" size="3"  id="exx" name="exx" value="<?=$show['xx']?>"></td>
		<td width="75%" align="left" bgcolor="#FFFFFF"><input type="text" size="58"  id="exxnr" name="exxnr" value="<?=$show['smalltitle_c']?>"></td>
        <td width="20%" align="center" bgcolor="#FFFFFF">
           <a href="javascript:DoEmpty('<?=$show['id']?>');">删除</a>｜
           <input type="hidden" size="2"  id="eid" name="eid" value="<?=$show['id']?>">
           <input id="edit" name="edit" type="submit" value="编辑">
        </td>	
    </tr>
    </form>
	<? } ?>
</table>
<?
}
?>
</center>