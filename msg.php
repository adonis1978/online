<div id="usermiddle">
<table  width="250" border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
  <tr>
    <td colspan="3" bgcolor="#698CC3" align="center"><nobr><b><font color="#FFFFFF" size="3">个人信息</font></b></nobr></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><font color="#CC3333">如个人信息有误请退出，与管理员联系</font></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$stunumber?></td>
    <td colspan="2" bgcolor="#FFFFFF"><?=$row['stunum']?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$realyname?></td>
    <td colspan="2" bgcolor="#FFFFFF"><?=$row['realyname']?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$stuclass?></td>
    <td colspan="2" bgcolor="#FFFFFF"><?=$row['stuclass']?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><?=$profession?></td>
    <td colspan="2" bgcolor="#FFFFFF"><?=$row['proression']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="78"><a href="change.php?uid=<?=$row['id']?>" target="_blank"><img src="pic/changem.jpg" alt="修改密码" border="0"></a></td>
    <td width="102"><a href="index.php?action=logout"><img src="pic/loginout.jpg" alt="退出登录" border="0"></a></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><font color="#CC3333">如以系统默认密码登录请及时修改密码</font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td ><a href="test.php?uid=<?=$row['id']?>&ms=lx" target="_blank"><img src="pic/lx.jpg" alt="练习模式" border="0"></a></td>
   <td >   
    <?php 
    if($rowlock['locked']==0){
    echo "<a href=\"test.php?uid=$row[id]&ms=ks\"><img src=\"pic/sttest.jpg\" alt=\"进入考试\" border=\"0\"></a>";
    }elseif ($rowlock['locked']==1){ echo ''; }
    ?>
    
    </td>
  </tr>
  <tr>
  <td colspan="3" bgcolor="#8BAEE5" height="20"></td>
  </tr>
</table>
</div>