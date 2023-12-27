<!-- _fmtab -->
<table cellpadding=0 cellspacing=0 align=center width=100% valign=top border=0<?=$cdiv?>><tr><td>

<table align=center border=0 width=100% cellpadding=1 cellspacing=1>
<tr><td width=175 valign=top bgcolor=#FFFFFF>
<div style='position:fixed;'>
<div>
<table align=center border=0 width=175 cellpadding=1 cellspacing=1><tr>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$pyear?>';"><font size=-2>&lt;&lt;</font></td>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$pmonthtm?>';"><font size=-1>&lt;</font></td>
<td valign=middle align=center onclick="location.href='?clshow=full';"><font size=-2><b><?=$rmonth[$month]?>, <?=$year?></b></font></td>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$nmonthtm?>';"><font size=-1>&gt;</font></td>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$nyear?>';"><font size=-2>&gt;&gt;</font></td>
</tr></table>
</div>

<div>
<!-- new -->
<table align=center border=0 width=175 cellpadding=1 cellspacing=1 bgcolor=#CCCCCC><thead>
<?php for($jh=1;$jh<=7;$jh=$jh+1): ?>
<th bgcolor=#A0A0A0 align=center width=20><font color=#FFFFFF size=-2><?=$ws[$jh]?></font></th>
<?php endfor; ?>
</thead>
<tbody>

<!-- ==== -->

<?php for($ir=0;$ir<$wrow;$ir++): ?>
<tr>
<?php for($ic=0;$ic<=6;$ic++): ?>
<td valign=top align=center onclick="location.href='?tm=<?=$cgo[$ir][$ic]?>';" width=<?=$wd?>% bgcolor="<?=$celcol[$ir][$ic]?>">
<font size=-2 color="<?=$fontcol[$ir][$ic]?>"><?=$celinf[$ir][$ic]?></font></td>
<?php endfor; ?>
</tr>
<?php endfor; ?>
</tbody>
</table>
</div></div>
</td><td valign=top>
