<?php
include_once("config.ini.php");
//数据库操作函数用于查询
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
//选择记录条数合计函数
function  connect_sql_total($sql){
    connect_sql();
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	return $total;
	mysql_close($conn);
}
//用于更新,删除数据
function sql_update($sql){
	connect_sql();
	$result=mysql_query($sql);
	return $result;
	@mysql_close($conn);
}
//用于添加数据
function sql_insert($sql){
    connect_sql();
    $result=mysql_query($sql);
    return $result;	
	mysql_close($conn);
}
//提示信息函数
$settings=array(
	'timeoffset' => 8,
	'datetimeformat' => 'Y.m.d H:i',
	'dateformat' => 'Y年m月d日',
	'timeformat' => 'H时i分',
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
	echo "<center><meta http-equiv=\"refresh\" content=\"$settings[rstime];url=$url\">\n<br><br>\n<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"60%\" style=\"border: 1px solid $settings[bordercolor]\" bgcolor=\"$settings[borderbgcolor]\">\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[headerbgcolor]\"><font color=\"$settings[headercolor]\"><b>提示信息</b></font></td>\n\t</tr>\n\t<tr>\n\t\t<td bgcolor=\"$settings[altbgcolor1]\"><br>　　$message<br><br></td>\n\t</tr>\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[altbgcolor2]\">$settings[rstime] 秒后自动刷新，如不想等待可 <a href=\"$url\">点击这里</a> 。</td>\n\t</tr>\n</table>\n<br><br>\n</center>";
}
function msge($message){
	global $settings;
	echo "<center><br><br>\n<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" width=\"60%\" style=\"border: 1px solid $settings[bordercolor]\" bgcolor=\"$settings[borderbgcolor]\">\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[headerbgcolor]\"><font color=\"$settings[headercolor]\"><b>提示信息</b></font></td>\n\t</tr>\n\t<tr>\n\t\t<td bgcolor=\"$settings[altbgcolor1]\"><br>   $message<br><br></td>\n\t</tr>\n\t<tr>\n\t\t<td align=\"center\" bgcolor=\"$settings[altbgcolor2]\"></td>\n\t</tr>\n</table>\n<br><br>\n</center>";
}
//正整数验证函数
function checksint($sint)
{
  $check='/^([1-9])(\d{0,})(\d{0,})$/';
  if(preg_match($check,$sint))
     {
       return true;
     }
     else{return false;}
}
//学号验证
function checknum($sint)
{
  $check="/^[0-9]{1,30}$/";
  if(preg_match($check,$sint))
     {
       return true;
     }
     else{return false;}
}
//密码验证
function checkpass($pass)
{
  $check="/^[a-zA-Z0-9]{5,15}$/";

  if(preg_match($check,$pass))
     {
       return true;
     }
     else{return false;}
}
//屏蔽非法访问
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
//题型判断
function btest($btitle){
	if($btitle==1){echo '单选';}
	if($btitle==2){echo '多选';}
	if($btitle==3){echo '填空';}
	if($btitle==4){echo '判断';}
	if($btitle==5){echo '简答';}
}
function mj($btitle){
	if($btitle==1){echo '<a href="#dx">单选</a> ';}
	if($btitle==2){echo '<a href="#dux">多选</a> ';}
	if($btitle==3){echo '<a href="#tk">填空</a> ';}
	if($btitle==4){echo '<a href="#pd">判断</a> ';}
	if($btitle==5){echo "<a href=\"brief.php?ms=$_GET[ms]&sid=$_GET[sid]&uid=$_GET[uid]\" target=\"_blank\">简答</a> ";}
}
function tb($btitle){
	if($btitle==1){echo '<a name="dx"></a><font color="#FF0000">单选</font>';}
	if($btitle==2){echo '<a name="dux"></a><font color="#FF0000">多选</font>';}
	if($btitle==3){echo '<a name="tk"></a><font color="#FF0000">填空</font> [如有多个空请用<font color="red">英文的逗号</font>分隔开添入"答案"中,否则答案会不正确]';}
	if($btitle==4){echo '<a name="pd"></a><font color="#FF0000">判断</font>';}
}
//字符替换
$text=array(chr(13)=>"<br>",
            chr(32)=>"&nbsp;");
Function mytext($myString){ 
	global $text;
$myString=strtr($myString,$text); 
return $myString;
}


/*****************************************
分页函数
pageup($pcount,$table,$order="")
（参数说明：
*$pcount参数是传入要分页的表的SQL语句
(这里的SQL语句是查询表中Count的),
*$table参数是传入表名(表名同$pcount参数),
*$order=""参数是预留的Order by,可为空）
*******************************************
function pagedown($amount,$id="")
（参数说明：
*$amount参数是pageup()函数返回的$amount
*$id参数是执行页面所带的其它Url参数(Get参数)
可为空）
*******************************************/

function pageup($pcount,$table,$order=""){
if(isset($_GET['page']))//如果以get传递的page的值存在 
{ 
$page=intval($_GET['page']);//得到以get传递的page的值的整数部分,并赋给变量$page intval()函数用于取得变量整数部分的值 
if($page<=0) { $page=1;} 
} 
else 
{ 
$page=1;//否则,$page=1 
} 
$pageSizeview=each_pageview;//每页显示记录条数 
$reArray=sql_operate($pcount);  //查询SQL
$amount=$reArray['count'];//得到总记录数
if($amount>0)
{
$pageOne=($page-1)*$pageSizeview;
$pageSql="select * from $table where 1=1 $order limit $pageOne,$pageSizeview" ;
$pageResult=mysql_query($pageSql); //查询SQL 直接传过来$pageOne,$pageSizeview用于分页
 return array($pageResult,$amount);
 //return $pageResult;
}
}
//pagedown()用于显示出分页结果
function pagedown($amount,$id=""){
$pageSizeview=each_pageview;
if($amount>0)//如果总记录数大于0 
{ 
if($amount<$pageSizeview)//如果总记录数小于每页显示的记录数 
{ 
$pageCount=1;//总页数为1 
} 
if($amount%$pageSizeview==0)//如果总记录可以整除每页记录数 
{ 
$pageCount=$amount/$pageSizeview;//获取它们相除的商,作为总页数 
} 
else//不能被整除 
{ 
$pageCount=intval($amount/$pageSizeview)+1;//获取它们相除的商,取其整数部分再加1,作为总页数 
} 
} 

if(@$page>$pageCount)//如果$page大于总页数 
{ 
echo "<script>window.location.href=\"?$id&page=$pageCount\";</script>";//这里的引号要小心 
} 
//考虑不同的情况 
if($pageCount==1 || $page==1)//如果总页数等于1或者当前页为1时 
{ 
echo '';//输出文字 
} 
else 
{ $uppage=$page-1;
echo "<a href=\"?$id&page=1\">首页</a>|";//输出链接 
echo "<a href=\"?$id&page=$uppage\">上一页</a>"; 
} 

$pageNum=5;//每一页面显示的页面链接数 
if(@$page%$pageNum==0) //如果当前页面可以整除去每一页显示页面的链接数 
{ 
for($i=@$page;$i<@$page+$pageNum;$i++)//将当前万状面的值赋给$i,$i循环的次数是每一页显示的数目 
{ 
if($i>=$pageCount)//如果当前页面数 >= 总页面数 
{ 
break; //跳出循环 
} 
$inextpage=$i+1;
echo "<a href=\"?$id&page=$inextpage\">[$inextpage]</a>";//将5下面的页数拉链是 6 7 8 9 10 
} 
} 
else//不能被整除 
{ /*******本代码难点就是在这里,这个公式化一定要记住***********/ 
$a=intval($page/$pageNum)*$pageNum+1;//当前页而 / 每页显示页面链接数后,取其整数部分 * 每页显示页面链接数,后在加一,的值再赋给 $a 
for($j=$a;$j<$a+$pageNum;$j++)// 将$a的值赋给$j,$j循环的次数是每一页显示的数目 
{ 
if($j>=$pageCount)//如果当前页面数 >= 总页面数 
{ 
break;//跳出循环 
} 
if($j==$page)//如果$j === 当前页面数 
{ 
echo '['.$j.']'; //输出文字 
} 
else//不等于 
{ 
echo "<a href=\"?$id&page=$j\">[$j]</a>";//输出链接 
} 
} 
} 
if($pageCount==1 || $pageCount==$page)//如果总页数为1或者当前页数等于总页数 
{ 
echo '';//输出文字 
} 
else 
{ 
	$nnextpage=$page+1;
echo "<a href=\"?$id&page=$nnextpage\">下一页</a>|" ;    //输出链接 
echo "<a href=\"?$id&page=$pageCount\">尾页</a>|" ; 
}
echo ' 　共<font color="red">'.$pageCount.'</font>页'; 
echo ' 　共<font color="red">'.$amount.'</font>条记录';
}
//传递字符串参数 _get('str') 代替 $_GET['str'] 
function _get($str){ 
$val = !empty($_GET[$str]) ? $_GET[$str] : null; 
return $val; 
} 

?>