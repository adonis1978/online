<?php    
//============================    
//    FileName:    install.php    
//    Version:    0.0.1    
//    Author:        Leo    
//    Date C/M:    2007-06-08    
//    Content:    PHP install MySQL    
//============================    
function ErrorInfo()    
{    
return "<ul style='font-family:Courier;font-size:11px;background:#FDF5E6;color:#696969;margin:3px;padding:10px;border:1px solid #696969;'>Notice!: System Error<li style='font-family:Courier;list-style-type:none'>ErrInfo: ".mysql_error()."</li><li style='font-family:Courier;list-style-type:none'>ErrCode: ".mysql_errno()."</li><li style='font-family:Courier;list-style-type:none'>ErrURIs: ".$_SERVER['REQUEST_URI']."</li></ul>";    
}    

function runquery($sql) {
    global $lang, $tablepre, $db;

    $sql = str_replace("\r", "\n", $sql);
    $ret = array();
    $num = 0;
    foreach(explode(";\n", trim($sql)) as $query) {
        $queries = explode("\n", trim($query));
        foreach($queries as $query) {
            $ret[$num] .= $query[0] == '#' || $query[0].$query[1] == '--' ? '' : $query;
        }
        $num++;
    }
    unset($sql);

    foreach($ret as $query) {
        $query = trim($query);
        if($query) 
                mysql_query($query);
    }
}


if(isset($_POST['install']))    //�ύ����    
{    
    $dbserver=$_POST['dbhost'];    
    $conn=@mysql_connect($dbserver,$_POST['dbuser'],$_POST['dbpass']) or die(ErrorInfo());    //���ӵ�MySQL Server    
    if($conn)    //�ɹ�    
    {    
        if(isset($_POST['dropold']))@mysql_query("DROP DATABASE IF EXISTS `".$_POST['dbname']."` ;") or die(ErrorInfo());     //������ɾ��ԭDB    
        echo "<br />Creating Database ...";    
        @mysql_query("CREATE DATABASE IF NOT EXISTS `".$_POST['dbname']."` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;") or die(ErrorInfo());        //����DB    
        echo "OK!";    
        $linktodb=@mysql_select_db($_POST['dbname'],$conn) or die(ErrorInfo());    //�����ݿ�    
        echo "<br />Creating TABLEs ";    
        if($sqlfile = 'table.sql')    //������    
        {	    
$fp = fopen($sqlfile, 'rb');
$filesize=filesize($sqlfile);
$sql = fread($fp, $filesize);
fclose($fp);
$result=runquery($sql);
}    
//����Ϣд��config.inc.php    
if($fp=fopen("../admin/config.ini.php",'w')){    
$configstr='<?php
$mysql_server='.$_POST['dbhost'].';
$mysql_username='.$_POST['dbuser'].';
$mysql_password='.$_POST['dbpass'].';
$mysql_database='.$_POST['dbname'].';
@session_start();
//���ݿ����Ӻ���
function  connect_sql(){
	global $mysql_server,$mysql_username,$mysql_password,$mysql_database;
	$conn=mysql_connect($mysql_server,$mysql_username,$mysql_password) or die("<font color=red><b>���ݿ����Ӵ����������Ա��ϵ��</b></font>");	
	mysql_query("SET NAMES gb2312;",$conn);
	mysql_select_db($mysql_database) or die("<font color=red><b>���ݿ�ѡ��������й������ϵ��</b></font></b>");
}
define("each_pageview",50); //��ҳÿҳ��ʾ��Ŀ
?>';    
   
echo "<br />Writing <strong>config.ini.php</strong> ";    
  if(fwrite($fp,$configstr))    {    
    echo "OK!";    
    fclose($fp);    
  } else {    
   echo "Failed!";    
   fclose($fp);    
   exit();    
  }    
} else {    
   echo "<br /><strong>config.ini.phpд��������ֶ��޸�</strong>!";    
   exit();    
}    
echo "<br />LOCK install.php ";    
        if(rename('install.php', 'install.lock'))    
        {    
            echo "OK!";    
        }    
        else   
        {    
            echo "Failed!";    
        }    
   
        echo "<br />Install Succes!"; 
        echo "<br />Ϊϵͳ��ȫ���뽫installĿ¼ɾ��";  
    }    
    else   
    {    
        echo "<br /><strong>���ݿ⽨������</strong>";
        exit();    
    }    
}    
else   
{    
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transititonal.dtd">     <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn" lang="zh-cn" dir="ltr">    
        <head>    
            <meta http-equiv="Content-Type" content="text/html; charset=bg2312" />       
            <style>    
            <!--    
            #db{width:300px;background:#FAEBD7;padding:10px;}    
            p{margin:1px;padding:4px;font-family:Arial;border:1px solid #DCDCDC;}    
            -->    
            </style>    
            <title>Installer</title>    
            <script language="javascript">    
            <!--    
            function chkform(oForm)    
            {    
                return true;    
            }    
            -->    
            </script>    
        </head>    
        <body>    
        <h3>���߿���ϵͳ��װ</h3>    
        <div id="db">    
        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" onsubmit="return chkform(this)">    
        <p>���ݿ�ķ�����: <input type="text" name="dbhost" id="dbhost" value="localhost" /> *</p>    
        <p>���ݿ��û�����: <input type="text" name="dbuser" id="dbuser" value="root" /> *</p>    
        <p>���ݿ��û�����: <input type="password" name="dbpass" id="dbpass" /> *</p>    
        <p>[��������������ݿ����Ա����ȡ]</p>    
        <p>�贴�������ݿ�: <input type="text" name="dbname" id="dbname" value="yourdb"/></p>    
        <p><input type="checkbox" name="dropold" id="dropold" />ɾ��ͬ�������ݿ�(���ɻָ���)</p>    
        <p><input type="submit" name="install" id="install" value="��ʼ��װ" /> <input type="reset" value="�����д" /></p>    
        </form>    
        </div>    
        </body>    
    </html>    
    <?php    
}    
?>  