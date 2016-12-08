<?php
require("language.php");
require("admin/function.php");
stu();
$row=sql_operate("select * from test_subject where id='$_GET[sid]'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" href="pic/style.css" />
<link rel="icon" href="pic/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="pic/favicon.ico" type="image/x-icon" />
<title><?=$test_title?></title>
<div id="header">
   <div id="orderBg">
      <div id="orderInfo">
<?php 
echo '≡'.$test_title.'≡　[<font color=blue>'.$row['test_sub'].'</font>]－－简答';
if($_GET['ms']==lx){echo '&nbsp;&nbsp;<font color=red>练习模式</font>';}
if($_GET['ms']==ks){echo '&nbsp;&nbsp;<font color=red>考试模式</font>';}
?> 
</div></div></div>
<div id="test">      
<form action="" method="POST" id="iform">
<?php
$test=sql_operate("select * from students where id=$_GET[uid]");
$arrzg=explode(",",$test['zgtestid']);
    echo '<br /><font color="red">简答</font><br />';
	foreach ($arrzg as $val ){
       $title=sql_select("select * from brief_answer where id=$val and  subject_id = $_GET[sid]");
       while ($titles=@mysql_fetch_array($title)){
           echo '<font color="#3366ff">'.$titles['brief_topic'].'</font>'.'<br>';   //题干
           echo '<textarea name="t_'.$titles['id'].'[]" id="t_'.$titles['id'].'[]" cols="30" rows="5"></textarea><br>';
           $a[$titles['id']]=array("$titles[brief_ans]");
       }
	}   
?>
<br><input id="tg" name="tg" type="submit" value="提交" >
</form><br>
<div style="background:#eeeeee;margin:10px;padding:5px;work-break:break-all">
<?php
if($_POST['tg']){  
         
   while(list($k,$v) = each($a)){
      $regs=$_REQUEST['t_'.$k];
      $value=@implode(array_values($regs));
	  $ansbrief=sql_operate("select * from brief_answer where id = $k"); 
	  if($_GET['ms']==lx){ echo '参考答案<br><li>'.$ansbrief['brief_ans'].'<br>';}
      $pf=sql_operate("select * from big_test where test_subject_id = $ansbrief[subject_id] and bigtitle=5");
      if(strspn($value,"$ansbrief[testkey]")){
          $num = 0; 
          $arr=explode(",",$ansbrief['testkey']);
          $leng=count($arr);
          while (list($ke,$va)=each($arr)){
               if(substr_count($value,$va)>0){
                   $num++; 
                   $scor[$k]=($num/$leng)*$pf['sscore'];
               }
          }
      }
   } 
   if($_GET['ms']==ks){	
    $sums = @implode("+",array_values($scor));
   	if($sums){
   		$upscore=sql_update("update chengji set zscore=$sums where subject=$_GET[sid] and students=$_GET[uid]");
   	    if($upscore){echo "<script language=\"javascript\">alert('提交成功！')</script>";}
   	}else{
   		$upscore=sql_update("update chengji set zscore=0 where subject=$_GET[sid] and students=$_GET[uid]");
   	    if($upscore){echo "<script language=\"javascript\">alert('提交成功！')</script>";}   			
   	}
   }
}
?>
</div>
<br><br><br><hr width="78%"><center><?=$copyright?></center>
</div>
</body></html>