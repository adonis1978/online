<?php
require_once("function.php");
seuser();
?>
<html>
<head>
<title>在线考试系统－管理中心</title>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="../pic/style.css" type="text/css">
</head>
<script language="JavaScript">
<!--
function DoEmpty(params)
{
if (confirm("真的要删除该试题吗？"))
window.location = "small_toperate.php?op=delst&id=" + params ;
}

function alldel(params)
{
if (confirm("真的要删除全部试题吗？　删除后将无法还原！！"))
window.location = "small_toperate.php?op=delat&id=" + params ;
}
//-->
</script>
<body>
<center>
<?php
//表单处理－－编辑科目
if(!$_GET['id']){msg('参数传递错误！！','test.php?action=subject_list');}
if($_POST['subm']){
	if($_POST['subjectup']=="" || $_POST['test_time']==""){msg('科目名称和考试时间都不能为空！','test.php?action=subject_list'); exit();}
	$checksub=connect_sql_total("select test_sub from test_subject where test_sub='$_POST[subjectup]'");
	if($checksub>1){msg('您修改后的科目名称已存在，不能修改！','test.php?action=subject_list');exit();}
	if(!checksint($_POST['test_time'])){msg('考试时长只能为正整数！！','test.php?action=subject_list');exit();}
	$upsubject=sql_update("update test_subject set test_sub='$_POST[subjectup]',test_time='$_POST[test_time]' where id='$_GET[id]' ");
    if($upsubject){
    	msg('修改成功！','test.php?action=subject_list');exit();
    }else {
    	msg('修改失败！','test.php?action=subject_list');exit();
    }
}

//表单处理－－编辑题型分数
if($_POST['submscore']){
	if($_POST['score']=="" || $_POST['tnum']==""){msg('分数　和　题的数目　都不能为空！！',"testpt.php?action=add_smtest&s=$_GET[sid]");exit();}
	if(!checksint($_POST['score']) || !checknum($_POST['tnum'])){msg('分数 应为正整数，题的数目　都应为整数！！',"testpt.php?action=add_smtest&s=$_GET[sid]");exit();}
	$updatescore=sql_update("update big_test set sscore='$_POST[score]',test_num='$_POST[tnum]' where id='$_GET[id]'");
	if($updatescore){
		msg('编辑成功！',"testpt.php?action=add_smtest&s=$_GET[sid]");exit();
	} else {
		msg('操作失败！',"testpt.php?action=add_smtest&s=$_GET[sid]");exit();
	}
}
?>
<?php
//编辑科目操作
if($_GET['op']=='edit'){
	$row=sql_operate("select * from test_subject where id='$_GET[id]'");
	?>
<form action="" method="post" name="iform">
<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">科目编辑</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">科目名称</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text"  name="subjectup" id="subjectup" size="25" maxlength="40"　 title="<?php echo "$row[test_sub]";?>" value="<?php echo "$row[test_sub]";?>"></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">考试时长</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text"  id="test_time" name="test_time" size="25" maxlength="20" value="<?=$row['test_time'];?>"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><font color="#CC3333">考试时长为分钟整数型式，否则出错！</font><br><input type="submit"  id="subm" name="subm" value=" 修改 "> </td>
	</tr>
</table>
</form>
<?php
}
//删除科目操作
if($_GET['op']=='del'){
	$rows=connect_sql_total("select * from big_test where test_subject_id='$_GET[id]'");
	if($rows>0){msg('本科目下有题型未被删除！请先删除其下题型','test.php?action=subject_list');exit();}
	$del=sql_update("delete from test_subject where id='$_GET[id]'");
	if($del){msg('删除成功！','test.php?action=subject_list');} else {msg('删除失败！','test.php?action=subject_list');}
}
//删除题型操作
if($_GET['op']=='deltx'){
	if($_GET['tid']<=4){
	for($i=1;$i<=4;$i++){
		if($_GET['tid']==$i){
			$row=connect_sql_total("select * from small_test where bigtitle_id='$_GET[tid]' and subject_id='$_GET[sid]'");
			if($row>0){msg('本题型下有试题未被删除！请先删除其下试题！',"testpt.php?action=add_smtest&s=$_GET[sid]");exit();
			}else {
					$delb=sql_update("delete from big_test where id='$_GET[id]'");
	                if($delb){
		               msg('删除成功！',"testpt.php?action=add_smtest&s=$_GET[sid]");	
	                   exit();		
	                } else {
		               msg('操作失败！',"testpt.php?action=add_smtest&s=$_GET[sid]");	
		               exit();		
	                   } 	
			} 
		break;
		}
	}
	}
	if($_GET['tid']==5){
			$rowb=connect_sql_total("select * from brief_answer where subject_id='$_GET[sid]'");
			if($rowb>0){
				msg('本题型下有试题未被删除！请先删除其下试题！',"testpt.php?action=add_smtest&s=$_GET[sid]");	
			    exit();
			}	
	        else {
	     $delbe=sql_update("delete from big_test where id='$_GET[id]'");
	     if($delbe){
		      msg('删除成功！',"testpt.php?action=add_smtest&s=$_GET[sid]");	
	          exit();		
	     } else {
		      msg('操作失败！',"testpt.php?action=add_smtest&s=$_GET[sid]");	
		     exit();		
	      } 
	 }
} 
}
//编辑题型分数操作
if($_GET['op']=='editscore'){
	$row=sql_operate("select sscore,test_num from big_test where id='$_GET[id]'");
?>
	<form action="" method="post" name="form1">
　　<table border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="2" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">修改分数</font></b></nobr></td>
	</tr>
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">分数</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text"  name="score" id="score" size="25" maxlength="40"　 value="<?php echo "$row[sscore]";?>"></td>
	</tr>	
	<tr>
		<td width="30%" align="center" bgcolor="#FFFFFF">题数</td>
		<td width="35%" align="left" bgcolor="#FFFFFF"><input type="text"  name="tnum" id="tnum" size="25" maxlength="40"　title="<?php echo "$row[test_num]";?>"  value="<?php echo "$row[test_num]";?>"></td>
	</tr>	
	<tr>
		<td colspan="2" align="center"  bgcolor="#8BAEE5"><font color="#CC3333"></font><br><input type="submit"  id="submscore" name="submscore" value=" 修改 "> </td>
	</tr>
　　</table>
　　</form>
<?php
}
//试题操作
if($_GET['op']=='txsearch'){
	$row=sql_operate("select test_sub from test_subject where id='$_GET[sid]'");	
?> 
		<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF" align="center">
	    <tr>
		   <td colspan="3" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF"><?=$row['test_sub']?>--《<?php btest($_GET['id']);?>》</font></b></nobr></td>
	    </tr>
	    <tr>
		  <td width="70%" align="center" bgcolor="#8BAEE5">试题</td>
		  <td width="15%" align="center" bgcolor="#8BAEE5">正确答案</td>
		  <td width="15%" align="center" bgcolor="#8BAEE5">操作</td>
	   </tr>
<?php 
if($_GET['id']>=1 and $_GET['id']<=4){
    $sqlstr="select * from small_test where bigtitle_id='$_GET[id]' and subject_id='$_GET[sid]' order by id desc";
    $row=connect_sql_total($sqlstr);
    if($row<=0){echo "<tr><td>本题型还没有添加任何试题！！</td></tr><tr><td colspan=3 align=center bgcolor=#8BAEE5> <b><a href=\"small_toperate.php?action=test_add&id=$_GET[id]&sid=$_GET[sid]\">添加试题</a></b> </td></tr></table>";exit();}
    $result=sql_select($sqlstr);
    while ($row=mysql_fetch_array($result)){
?>
    	<tr>
		  <td width="70%" align="left" bgcolor="#FFFFFF" style="word-break:break-all">
		      <?php if($_GET['id']==1 || $_GET['id']==2) { ?>
		         <a href="small_toperate.php?op=add_xx&id=<?=$row['id']?>"><?=htmlspecialchars($row['smalltitle'])?></a>
		      <?php }else {echo htmlspecialchars($row['smalltitle']);}?>   
		  </td>
		  <td width="15%" align="center" bgcolor="#FFFFFF" style="word-break:break-all">
		      <? if($_GET['id']==4){
		      	    if($row['bt_answer']==1){echo '正确';}
		      	    if($row['bt_answer']==0){echo '错误';}
		          }else { echo $row['bt_answer']; }?>
		  </td>
		  <td width="15%" align="center" bgcolor="#FFFFFF"><a href="small_toperate.php?op=edit&id=<?=$row['id']?>&tid=<?=$_GET['id']?>&sid=<?=$_GET['sid']?>">编辑</a>｜<a href="javascript:DoEmpty('<?=$row['id'].'&tid='.$_GET['id']?>');">删除</a></td>
	    </tr>
<?php}?>
	    <tr>
		  <td colspan="3" align="center" bgcolor="#8BAEE5"> <b><a href="small_toperate.php?action=test_add&id=<?=$_GET['id']?>&sid=<?=$_GET['sid']?>">添加试题</a>｜<a href="javascript:alldel('<?=$_GET['id'].'&sid='.$_GET['sid']?>');">全部删除</a></b> </td>
	   </tr>
       </table>
<?php }
if($_GET['id']==5){
    $sqlstr="select * from brief_answer where  subject_id='$_GET[sid]' order by id desc";
    $row=connect_sql_total($sqlstr);
    if($row<=0){echo "<tr><td>本题型还没有添加任何试题！！</td></tr><tr><td colspan=3 align=center bgcolor=#8BAEE5> <b><a href=\"small_toperate.php?action=test_add&id=$_GET[id]&sid=$_GET[sid]\">添加试题</a></b> </td></tr></table>";exit();}
    $result=sql_select($sqlstr);
    while ($row=mysql_fetch_array($result)){
?>
    	<tr>
		  <td width="70%" align="left" bgcolor="#FFFFFF"  valign="top" ><textarea cols="50" rows="3" readonly="ture"><?=$row['brief_topic']?></textarea></a></td>
		  <td width="15%" align="center" bgcolor="#FFFFFF" ><textarea cols="30" rows="3" readonly="ture"><?=$row['brief_ans']?></textarea></td>
		  <td width="15%" align="center" bgcolor="#FFFFFF"><a href="small_toperate.php?op=edit&id=<?=$row['id']?>&tid=<?=$_GET['id']?>&sid=<?=$_GET['sid']?>">编辑</a><br /><br /><a href="javascript:DoEmpty('<?=$row['id'].'&tid='.$_GET['id']?>');">删除</a></td>
	    </tr>
<?php }?>
	    <tr>
		  <td colspan="3" align="center" bgcolor="#8BAEE5"> <b><a href="small_toperate.php?action=test_add&id=<?=$_GET['id']?>&sid=<?=$_GET['sid']?>">添加试题</a>｜<a href="javascript:alldel('<?=$_GET['id'].'&sid='.$_GET['sid']?>');">全部删除</a></b> </td>
	   </tr>
       </table>
<?php }
} 
//科目成绩查看
if($_GET['op']=='subscore'){
	$pcount="select count(*) as count from chengji where subject=$_GET[id]";
	$arr=pageup($pcount,'chengji','order by students desc');
    pagedown($arr[1],"op=subscore&id=$_GET[id]");
    $result=$arr[0];
?>
<table border="0" cellspacing="1" cellpadding="4" width="85%" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
	<tr>
		<td colspan="4" height="24" align="center" bgcolor="#698CC3"><nobr><b><font color="#FFFFFF">科目成绩列表</font></b></nobr></td>
	</tr>
	<tr>
		<td width="25%" align="center" bgcolor="#8BAEE5">学号</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">分数</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">缓考</td>
		<td width="25%" align="center" bgcolor="#8BAEE5">缺考</td>
	</tr>
	<?php
	   while ($row=@mysql_fetch_array($result)){
	   ?>
	    <tr>
		<td width="25%" align="center" bgcolor="#FFFFFF">
		    <?php
		    $stu=sql_operate("select stunum,id from students where id=$row[students]");
		    echo $stu['stunum'];
		   ?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF"><?=$row['kscore']+$row['zscore']?></td>
		<td width="25%" align="center" bgcolor="#FFFFFF">
		    <?php if($row['huankao']==1){echo '是';}
		       if($row['huankao']==0){echo '否';}  
		     ?>			
		</td>
		<td width="25%" align="center" bgcolor="#FFFFFF">
		    <?php if($row['quekao']==1){echo '是';}
		       if($row['quekao']==0){echo '否';}  
		     ?>
		</td>
	    </tr>   		
	 <?php} ?>
	<tr>
		<td colspan="4" align="center" bgcolor="#8BAEE5"></td>
	</tr>
</table>
<?php } ?>
</center>
</body>
</html>