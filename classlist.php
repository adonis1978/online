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
<?php 
//�Ƿ�Ϊ���ԣ����Լ�ʱ��ʾ
if($_GET['ms']==ks){
$time=$row['test_time'];
?>
<SCRIPT LANGUAGE="JavaScript"> 
<!-- 
var maxtime; 
if(window.name==''){ 
maxtime = <?=$time?>*60; 
}else{ 
maxtime = window.name; 
} 
function CountDown(){ 
if(maxtime>=0){ 
minutes = Math.floor(maxtime/60); 
seconds = Math.floor(maxtime%60); 
msg = "�����������"+minutes+"��"+seconds+"��"; 
document.all["timer"].innerHTML = msg; 
if(maxtime == 5*60) alert('ע�⣬����5���ӣ�ϵͳ���Զ��վ��뼰ʱ���ύ��'); 
--maxtime; 
window.name = maxtime; 
} 
else{ 
clearInterval(timer); 
alert("ʱ�䵽������! ϵͳ���ر�!");
window.location.href="index.php?action=logout"
} 
} 
timer = setInterval("CountDown()",1000); 
//--> 
</SCRIPT> 
<?php 
}
if($_GET['ms']==lx){
	$msg="��ϰģʽ��";
}
?>
</head>
<body>
<div id="header">
   <div id="orderBg">
      <div id="orderInfo"><?php echo '��'.$test_title.'�ԡ�[<font color=blue>'.$row['test_sub'].'</font>]����';?>  
<?php
//���͵���
$sub=sql_select("select * from big_test where test_subject_id=$_GET[sid] order by bigtitle asc");
if($sub){
  while ($row=mysql_fetch_array($sub)){
    mj($row['bigtitle']);
  }
}else {	
	echo "<center>";
    msg('���ݶ�ȡ����','index.php');
    echo "</ center>";
} ?>
     <span id="timer" style="color:red"><?=$msg?></span></div>
   </div>
</div>
<div id="test">
<form id="iform" action="" method="POST">
<?php   
if($_GET['ms']==ks){echo $zy;}
/*�����б���Ϣ*/	
$test=sql_operate("select * from students where id=$_GET[uid]");
$arr=explode(",",$test['kgtestid']);
$arrzg=explode(",",$test['zgtestid']);
$subtx=sql_select("select * from big_test where test_subject_id=$_GET[sid] order by bigtitle asc");
	while($tx=mysql_fetch_array($subtx)){
    if($tx['bigtitle']>=1 and $tx['bigtitle']<=4){
		for($i=1;$i<=4;$i++){
            if($tx['bigtitle']==$i){ 
            	echo '<br>';  tb($tx['bigtitle']);  if($tx['bigtitle']==3){echo '��ÿ��'.$tx['sscore'].$l_score.'<br/ >';}else{echo $b_score.$tx['sscore'].$l_score.'<br/ >';} //����
	             foreach ($arr as $val ){
                     $title=sql_select("select * from small_test where id=$val and  bigtitle_id = $i");
                      while ($titles=@mysql_fetch_array($title)){
           	             echo '<font color="#3366ff">'.$titles['smalltitle'].'</font>'.'<br>';   //���
           	             //С��ѡ�ʼ
           	             $smresult=sql_select("select * from small_result where smalltitle_id=$val order by xx asc");
			             while($xx=mysql_fetch_array($smresult)){ //С���Ӧѡ��
			         	      if($tx['bigtitle']==1){
			         	          echo '<input type="radio" name="t_'.$titles['id'].'[]" value="'.$xx['xx'].'" id="t_'.$titles['id'].'[]">'.$xx['xx'].' '.$xx['smalltitle_c'].'<br />';
			         	          $a[$titles['id']]=array("$xx[xx]");
				              }
				              if($tx['bigtitle']==2){	
			         	           echo '<input type="checkbox" name="t_'.$titles['id'].'[]" value="'.$xx['xx'].'" id="t_'.$titles['id'].'[]">'.$xx['xx'].' '.$xx['smalltitle_c'].'<br />';				         	
				                   $a[$titles['id']]=array("$xx[xx]");
				               }			         				         	
			             } 
	        	         if($tx['bigtitle']==3){	
			         	      echo '�𰸣�<input type="text" name="t_'.$titles['id'].'[]" value="" id="t_'.$titles['id'].'[]" maxlength="150"><br>';		         	
				              $a[$titles['id']]=array("$titles[bt_answer]");
	        	         }					         			          
				         if($tx['bigtitle']==4){
			         	     echo '<input type="radio" name="t_'.$titles['id'].'[]" value="1" id="t_'.$titles['id'].'[]">��<input type="radio" name="t_'.$titles['id'].'[]" value="0" id="t_'.$titles['id'].'[]">��<br>';				         	
				             $a[$titles['id']]=array("$titles[bt_answer]");    
				         }
				       //С��ѡ�����
                     }
	             }  
            }
		}
    }
}
?>
<input type="submit"  name="tj" id="tj" value="�ύ">
</form>
<div style="background:#eeeeee;margin:10px;padding:5px">
<?php
//�͹�������
if($_POST[tj]){
if($_GET['ms']==lx){  //��ϰģʽ����ʼ
   echo '<font color=blue>������</font><br><br>';
   while(list($k,$v) = each($a)){
      $regs=$_REQUEST['t_'.$k];
      if(!$regs){echo 'ûѡ,';}
         $value=@implode(array_values($regs));
         $ans=sql_operate("select * from small_test where id = $k"); 
         $pf=sql_operate("select * from big_test where test_subject_id = $ans[subject_id] and bigtitle = $ans[bigtitle_id] ");
         //��ѡ����ѡ���ж����ִ���
         if($ans['bt_answer']==$value && $ans['bigtitle_id'] != 3){
             echo '<font color=red>�����</font>';
             $scor[$k]=$pf[sscore];
         } // ��ѡ����ѡ���ж����ִ������
         //�����������
         elseif($ans['bigtitle_id']==3) {
                  if(strspn($value,"$ans[bt_answer]")){
                       $num = 0; 
                       $arr=explode(",",$ans['bt_answer']);
                       while (list($ke,$va)=each($arr)){
                          if(@substr_count($value,$va)>0){
                              $num++; 
                              $scor[$k]=$pf['sscore']*$num;
                           }
                       }
                       if($num>0){echo '<font color=red>�����</font>��ȷ�𰸣�'.$ans['bt_answer'];}
                  }else {echo '��ȷ�𰸣�'.$ans['bt_answer'];}
          } //������ִ������
          //�ж������ʾ����
          elseif($ans['bigtitle_id']==4) {
          	if($ans['bt_answer']==1){echo '���� ��ȷ�𰸣���';}
          	if($ans['bt_answer']==0){echo '���� ��ȷ�𰸣���';}
          } //�ж������ʾ�������
          //��ѡ����ѡ���ж���ȷ����ʾ
          else { echo '���� ��ȷ�𰸣�'.$ans['bt_answer']; } 
   	      echo '<br>';
   	} 
    $sums = @implode("+",array_values($scor));
    if($sums){eval("echo '<br><font color=red>���������ܷ֣�</font>',$sums,'��';");}else{echo '<br><font color=red>���������ܷ֣�0</font>';}
} //��ϰģʽ����
//����ģʽ����ʼ
if($_GET['ms']==ks){
   	   while(list($k,$v) = each($a)){
      $regs=$_REQUEST['t_'.$k];
         $value=@implode(array_values($regs));
         $ans=sql_operate("select * from small_test where id = $k");
         $pf=sql_operate("select * from big_test where test_subject_id = $ans[subject_id] and bigtitle = $ans[bigtitle_id] ");
         if($ans['bt_answer']==$value && $ans['bigtitle_id'] != 3){
             $scor[$k]=$pf['sscore'];
          }
         //�����������
         if($ans['bigtitle_id']==3) {
                  if(strspn($value,"$ans[bt_answer]")){
                       $num = 0; 
                       $arr=explode(",",$ans['bt_answer']);
                       while (list($ke,$va)=each($arr)){
                          if(substr_count($value,$va)>0){
                              $num++; 
                              $scor[$k]=$pf['sscore']*$num;
                           }
                       }
                  }
          } //������ִ������
   	} 
    $sums = @implode("+",array_values($scor));
   	if($sums){
   		$upscore=sql_update("update chengji set kscore=$sums,testdate=now() where subject=$_GET[sid] and students=$_GET[uid]");
   	    if($upscore){echo "<script language=\"javascript\">alert('�ύ�ɹ���')</script>";}
   	}else{
   		$upscore=sql_update("update chengji set kscore=0,testdate=now() where subject=$_GET[sid] and students=$_GET[uid]");
   	    if($upscore){echo "<script language=\"javascript\">alert('�ύ�ɹ���')</script>";}
   	}
   }  //����ģʽ����
}
?>
</div>
<?php
if($_GET['ms']==ks){
	echo '<center><a href="index.php?action=logout"><img src="pic/logouttest.jpg" alt="�����˳�ϵͳ" border="0"></a></center>';
}
?>
<br><br><br><hr width="78%"><center><?=$copyright?></center>
</div>
</body></html>