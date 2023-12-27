<table width=100% border=0 cellpadding=6 cellspacing=3>
<tr>
<?php if(isset($descErr)): ?>
<center><font size=+1 color=red><?=$descErr ?></font></center>
<?php else: ?>
<td align=center valign=top width=350px>
<?php include_once($inc_path."/map/_yandex.php"); ?>
<?php include_once($inc_path."/_visio.php"); ?>
<?=$ShowPic ?>
</td><td align=center valign=top>
<table width=100% border=0 cellpadding=3 cellspacing=3>
<tr><td align=left valign=top><font size=+1 color=#FF1010><?=$NameShow?></font></td></tr>
<tr><td align=center><?php include_once($inc_path."/tpl/_condition.php");?></td></tr>
<tr><td align=right><?=$ShowMap ?></td></tr>
<tr><td align=center>
<?=$desc ?>
<?=$desc_c ?>
<?=$desc_a ?>
<?=$desc_d ?>
<?=$desc_e ?>
</td></tr></table>
<?php endif; ?>
</td></tr></table>
