<?php
include_once("config.ini.php");
//���ݿ�����������ڲ�ѯ
function sql_operate($sql){
	connect_sql();
	$result=mysql_query($sql);
	$row=@mysql_fetch_array($result);
	return $row;
	mysql_close($conn);
}
function sql_select($sql){
	connect_sql();
	$result=mysql_query($sql);
	return $result;
	mysql_close($conn);
}
//ѡ���¼�����ϼƺ���
function  connect_sql_total($sql){
    connect_sql();
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	return $total;
	mysql_close($conn);
}
//���ڸ���,ɾ������
function sql_update($sql){
	connect_sql();
	$result=mysql_query($sql);
	return $result;
	@mysql_close($conn);
}
//�����������
function sql_insert($sql){
    connect_sql();
    $result=mysql_query($sql);
    return $result;	
	mysql_close($conn);
}
//��ʾ��Ϣ����
$settings=array(
	'timeoffset' => 8,
	'datetimeformat' => 'Y.m.d H:i',
	'dateformat' => 'Y��m��d��',
	'timeformat' => 'Hʱi��',
    'adminout'=>'300',
	'pagenum' => 10,

	'rstime' => 3,

	'adminnum' => 20,
	'adminout' => 1000,

	'allimgwidth' => 640,

	'mfrcols' => 5,
	'mfrrows' => 5,

	'lognum' => 20,

	'logowidth'=> 88,
	'logoheight'=> 31,

	'mainwidth' => '100%',
	'mainbgcolor' => '#9EB6D8',

	'bordercolor' => '#698CC3',
	'borderbgcolor' => '#D6E0EF',

	'headercolor' => '#FFFFFF',
	'headerbgcolor' => '#698CC3',

	'titlecolor' => '#000000',
	'titlebgcolor' => '#EFEFEF',

	'altbgcolor1' => '#FFFFFF',
	'altbgcolor2' => '#EEEEEE',
	'altbgcolor3' => '#8BAEE5',
);
function msg($message,$url){
	global $settings;
	echo "<center><meta http-equiv=\"refresh\" content=\"$settings[rstime];url=$url\">\n<br><br>\n<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"60%\" style=\"border: 1px solid $settings[bordercolor]\" bgcolor=\"$settings[borderbgcolor]\">\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[headerbgcolor]\"><font color=\"$settings[headercolor]\"><b>��ʾ��Ϣ</b></font></td>\n\t</tr>\n\t<tr>\n\t\t<td bgcolor=\"$settings[altbgcolor1]\"><br>����$message<br><br></td>\n\t</tr>\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[altbgcolor2]\">$settings[rstime] ����Զ�ˢ�£��粻��ȴ��� <a href=\"$url\">�������</a> ��</td>\n\t</tr>\n</table>\n<br><br>\n</center>";
}
function msge($message){
	global $settings;
	echo "<center><br><br>\n<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"60%\" style=\"border: 1px solid $settings[bordercolor]\" bgcolor=\"$settings[borderbgcolor]\">\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[headerbgcolor]\"><font color=\"$settings[headercolor]\"><b>��ʾ��Ϣ</b></font></td>\n\t</tr>\n\t<tr>\n\t\t<td bgcolor=\"$settings[altbgcolor1]\"><br>   $message<br><br></td>\n\t</tr>\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[altbgcolor2]\"></td>\n\t</tr>\n</table>\n<br><br>\n</center>";
}
//��������֤����
function checksint($sint)
{
  $check='/^([1-9])(\d{0,})(\d{0,})$/';
  if(preg_match($check,$sint))
     {
       return true;
     }
     else{return false;}
}
//ѧ����֤
function checknum($sint)
{
  $check="/^[0-9]{1,30}$/";
  if(preg_match($check,$sint))
     {
       return true;
     }
     else{return false;}
}
//������֤
function checkpass($pass)
{
  $check="/^[a-zA-Z0-9]{5,15}$/";

  if(preg_match($check,$pass))
     {
       return true;
     }
     else{return false;}
}
//���ηǷ�����
function seuser(){
   if(!$_SESSION['username']){
        header("location: index.php");
        exit();
    }
}
function stu(){
   if(!$_SESSION['stu']){
        header("location: index.php");
        exit();
    }
}
//�����ж�
function btest($btitle){
	if($btitle==1){echo '��ѡ';}
	if($btitle==2){echo '��ѡ';}
	if($btitle==3){echo '���';}
	if($btitle==4){echo '�ж�';}
	if($btitle==5){echo '���';}
}
function mj($btitle){
	if($btitle==1){echo '<a href="#dx">��ѡ</a> ';}
	if($btitle==2){echo '<a href="#dux">��ѡ</a> ';}
	if($btitle==3){echo '<a href="#tk">���</a> ';}
	if($btitle==4){echo '<a href="#pd">�ж�</a> ';}
	if($btitle==5){echo "<a href=\"brief.php?ms=$_GET[ms]&sid=$_GET[sid]&uid=$_GET[uid]\" target=\"_blank\">���</a> ";}
}
function tb($btitle){
	if($btitle==1){echo '<a name="dx"></a><font color="#FF0000">��ѡ</font>';}
	if($btitle==2){echo '<a name="dux"></a><font color="#FF0000">��ѡ</font>';}
	if($btitle==3){echo '<a name="tk"></a><font color="#FF0000">���</font> [���ж��������<font color="red">Ӣ�ĵĶ���</font>�ָ�������"��"��,����𰸻᲻��ȷ]';}
	if($btitle==4){echo '<a name="pd"></a><font color="#FF0000">�ж�</font>';}
}
//�ַ��滻
$text=array(chr(13)=>"<br>",
            chr(32)=>"&nbsp;");
Function mytext($myString){ 
	global $text;
$myString=strtr($myString,$text); 
return $myString;
}


/*****************************************
��ҳ����
pageup($pcount,$table,$order="")
������˵����
*$pcount�����Ǵ���Ҫ��ҳ�ı��SQL���
(�����SQL����ǲ�ѯ����Count��),
*$table�����Ǵ������(����ͬ$pcount����),
*$order=""������Ԥ����Order by,��Ϊ�գ�
*******************************************
function pagedown($amount,$id="")
������˵����
*$amount������pageup()�������ص�$amount
*$id������ִ��ҳ������������Url����(Get����)
��Ϊ�գ�
*******************************************/

function pageup($pcount,$table,$order=""){
if(isset($_GET['page']))//�����get���ݵ�page��ֵ���� 
{ 
$page=intval($_GET['page']);//�õ���get���ݵ�page��ֵ����������,����������$page intval()��������ȡ�ñ����������ֵ�ֵ 
if($page<=0) { $page=1;} 
} 
else 
{ 
$page=1;//����,$page=1 
} 
$pageSizeview=each_pageview;//ÿҳ��ʾ��¼���� 
$reArray=sql_operate($pcount);  //��ѯSQL
$amount=$reArray['count'];//�õ��ܼ�¼��
if($amount>0)
{
$pageOne=($page-1)*$pageSizeview;
$pageSql="select * from $table where 1=1 $order limit $pageOne,$pageSizeview" ;
$pageResult=mysql_query($pageSql); //��ѯSQL ֱ�Ӵ�����$pageOne,$pageSizeview���ڷ�ҳ
 return array($pageResult,$amount);
 //return $pageResult;
}
}
//pagedown()������ʾ����ҳ���
function pagedown($amount,$id=""){
$pageSizeview=each_pageview;
if($amount>0)//����ܼ�¼������0 
{ 
if($amount<$pageSizeview)//����ܼ�¼��С��ÿҳ��ʾ�ļ�¼�� 
{ 
$pageCount=1;//��ҳ��Ϊ1 
} 
if($amount%$pageSizeview==0)//����ܼ�¼��������ÿҳ��¼�� 
{ 
$pageCount=$amount/$pageSizeview;//��ȡ�����������,��Ϊ��ҳ�� 
} 
else//���ܱ����� 
{ 
$pageCount=intval($amount/$pageSizeview)+1;//��ȡ�����������,ȡ�����������ټ�1,��Ϊ��ҳ�� 
} 
} 

if(@$page>$pageCount)//���$page������ҳ�� 
{ 
echo "<script>window.location.href=\"?$id&page=$pageCount\";</script>";//���������ҪС�� 
} 
//���ǲ�ͬ����� 
if($pageCount==1 || $page==1)//�����ҳ������1���ߵ�ǰҳΪ1ʱ 
{ 
echo '';//������� 
} 
else 
{ $uppage=$page-1;
echo "<a href=\"?$id&page=1\">��ҳ</a>|";//������� 
echo "<a href=\"?$id&page=$uppage\">��һҳ</a>"; 
} 

$pageNum=5;//ÿһҳ����ʾ��ҳ�������� 
if(@$page%$pageNum==0) //�����ǰҳ���������ȥÿһҳ��ʾҳ��������� 
{ 
for($i=@$page;$i<@$page+$pageNum;$i++)//����ǰ��״���ֵ����$i,$iѭ���Ĵ�����ÿһҳ��ʾ����Ŀ 
{ 
if($i>=$pageCount)//�����ǰҳ���� >= ��ҳ���� 
{ 
break; //����ѭ�� 
} 
$inextpage=$i+1;
echo "<a href=\"?$id&page=$inextpage\">[$inextpage]</a>";//��5�����ҳ�������� 6 7 8 9 10 
} 
} 
else//���ܱ����� 
{ /*******�������ѵ����������,�����ʽ��һ��Ҫ��ס***********/ 
$a=intval($page/$pageNum)*$pageNum+1;//��ǰҳ�� / ÿҳ��ʾҳ����������,ȡ���������� * ÿҳ��ʾҳ��������,���ڼ�һ,��ֵ�ٸ��� $a 
for($j=$a;$j<$a+$pageNum;$j++)// ��$a��ֵ����$j,$jѭ���Ĵ�����ÿһҳ��ʾ����Ŀ 
{ 
if($j>=$pageCount)//�����ǰҳ���� >= ��ҳ���� 
{ 
break;//����ѭ�� 
} 
if($j==$page)//���$j === ��ǰҳ���� 
{ 
echo '['.$j.']'; //������� 
} 
else//������ 
{ 
echo "<a href=\"?$id&page=$j\">[$j]</a>";//������� 
} 
} 
} 
if($pageCount==1 || $pageCount==$page)//�����ҳ��Ϊ1���ߵ�ǰҳ��������ҳ�� 
{ 
echo '';//������� 
} 
else 
{ 
	$nnextpage=$page+1;
echo "<a href=\"?$id&page=$nnextpage\">��һҳ</a>|" ;    //������� 
echo "<a href=\"?$id&page=$pageCount\">βҳ</a>|" ; 
}
echo ' ����<font color="red">'.$pageCount.'</font>ҳ'; 
echo ' ����<font color="red">'.$amount.'</font>����¼';
}
//�����ַ������� _get('str') ���� $_GET['str'] 
function _get($str){ 
$val = !empty($_GET[$str]) ? $_GET[$str] : null; 
return $val; 
} 

?>