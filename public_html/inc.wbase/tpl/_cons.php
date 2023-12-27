<table width=100% border=0 cellpadding=3 cellspacing=3 BGCOLOR=#a4b9cf>
<tr><td valign=top><b>Редактирование параметров конструкции</b>
</td></tr>
<tr><td valign=top>
<table width=100% border=0 cellpadding=0 cellspacing=0 bgcolor=white>
<tr><td>
<?php include_once ($inc_path."/form/_cons.php"); ?>
</tr></table>
</td></tr>
<?php if ($saveobj==$save_obj[2]): ?>
<tr><td>
<?php include_once ($inc_path."/_surf_side_list.php"); ?>
<?php include ($inc_path."/_4site.php"); ?>
</td></tr>
<?php endif; ?>
</table>
</td><td width=400 align=center valign=top bgcolor="#C0FFC0">
<?php if ($saveobj!=$save_obj[0]): ?>
<?php include_once($inc_path."/map/_yandex.php"); ?>
<?php include_once($inc_path."/_visio.php"); ?>
<?=$ShowMap ?><?=$ShowPic ?>
<?php else: ?>&nbsp;<?php endif; ?>
</td></tr></table>
