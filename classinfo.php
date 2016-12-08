<?php
if(!$_GET['uid'] || !$_GET['sid'] || !$_GET['ms']){
	header("location: index.php");
	exit();
}
require("language.php");
require("admin/function.php");
stu();
/*生成试卷*/
$result=sql_select("select * from big_test where test_subject_id=$_GET[sid] order by bigtitle asc");
while ($brows=mysql_fetch_array($result)){
	if($brows['bigtitle']>=1 and $brows['bigtitle']<=4){
		for($i=1;$i<=4;$i++){
			if($brows['bigtitle']==$i){ //判断题型
				$num=$brows['test_num']; //随机数判断
				$smtitle=sql_select("select * from small_test  WHERE bigtitle_id=$i and subject_id=$_GET[sid] order by rand() LIMIT $num");
	        	 while($sresult=mysql_fetch_array($smtitle)){ 
	        	 	$a[$sresult['id']]=array("$xx[xx]");
			     }
		     }
	     } 
    }
	if($brows['bigtitle']==5){
		$smtitleb=sql_select("select * from brief_answer WHERE subject_id=$_GET[sid] order by rand() LIMIT $brows[test_num]");
	    while($sresult=mysql_fetch_array($smtitleb)){
           $b[$sresult['id']]=array("$sresult[brief_ans]");	   
	     }	         	
	}     
}
$kgid = @implode(",",array_keys($a));
$zgid = @implode(",",array_keys($b));
$id = $_GET['uid'];
$savetest=sql_update("update students set kgtestid = '$kgid', zgtestid = '$zgid' where id = '$id'");
if($_GET['ms']==ks){
   $rownum=connect_sql_total("select subject from chengji where subject=$_GET[sid] and students=$_GET[uid]");
   if($rownum>0){
   	header("location: classlist.php?ms=$_GET[ms]&sid=$_GET[sid]&uid=$_GET[uid]");
   	exit();
   }
   $addcj=sql_insert("insert into chengji(students,subject) values ('$_GET[uid]','$_GET[sid]')");
   if($savetest && $addcj){
		header("location: classlist.php?ms=$_GET[ms]&sid=$_GET[sid]&uid=$_GET[uid]");
    }
}
if($savetest){
		header("location: classlist.php?ms=$_GET[ms]&sid=$_GET[sid]&uid=$_GET[uid]");
}
?>
