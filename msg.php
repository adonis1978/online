<div id="usermiddle">
<table  width="250" border="0" cellspacing="1" cellpadding="4" width="260" style="border: 1px solid #698CC3" bgcolor="#D6E0EF">
  <tr>
    <td colspan="3" bgcolor="#698CC3" align="center"><nobr><b><font color="#FFFFFF" size="3">������Ϣ</font></b></nobr></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><font color="#CC3333">�������Ϣ�������˳��������Ա��ϵ</font></td>
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
    <td width="78"><a href="change.php?uid=<?=$row['id']?>" target="_blank"><img src="pic/changem.jpg" alt="�޸�����" border="0"></a></td>
    <td width="102"><a href="index.php?action=logout"><img src="pic/loginout.jpg" alt="�˳���¼" border="0"></a></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><font color="#CC3333">����ϵͳĬ�������¼�뼰ʱ�޸�����</font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td ><a href="test.php?uid=<?=$row['id']?>&ms=lx" target="_blank"><img src="pic/lx.jpg" alt="��ϰģʽ" border="0"></a></td>
   <td >   
    <?php 
    if($rowlock['locked']==0){
    echo "<a href=\"test.php?uid=$row[id]&ms=ks\"><img src=\"pic/sttest.jpg\" alt=\"���뿼��\" border=\"0\"></a>";
    }elseif ($rowlock['locked']==1){ echo ''; }
    ?>
    
    </td>
  </tr>
  <tr>
  <td colspan="3" bgcolor="#8BAEE5" height="20"></td>
  </tr>
</table>
</div>