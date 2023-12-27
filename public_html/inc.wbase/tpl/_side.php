<table width=100% border=0 cellpadding=1 cellspacing=1 BGCOLOR=#a4b9cf>
<tr>
<td valign=top>
<table width=100% height=100% border=0 cellpadding=1 cellspacing=1>
<tr BGCOLOR=#c4e9ff>
<td>
<?php include_once($inc_path."/form/_rsurf.php"); ?>
</td></tr>
<tr><td>
<?php if(isset($F_ConsID)): ?>
<?php include_once($inc_path."/form/_side.php"); ?>
</td></tr>
<tr BGCOLOR=#D4F9ff><td bgcolor=white><?php include_once($inc_path."/_4site.php"); ?></td></tr>
<tr><td><?php include_once($inc_path."/form/_rcons.php"); ?>
<?php else: ?>
<center><font color=red>Нет конструкции в базе. Сначала нужно <a href='?cedit=<?=$_GET['sedit'] ?><?php if(isset($_GET['year'])): ?>&year=<?=$_GET['year'] ?><?php endif; ?>'>зарегистрировать конструкцию или сделать приязку поверхности к конструкции</a> </font></center>
<?php endif; ?>
</td>
<?php include_once($inc_path."/map/_yandex.php"); ?>
<!-- # выводим на экран карту и фото -->
<td width=400 align=center valign=top bgcolor="#C0FFC0">
<?php include_once($inc_path."/_visio.php"); ?>
<?=$ShowMap ?><?=$ShowPic ?>
</td></tr></table>
