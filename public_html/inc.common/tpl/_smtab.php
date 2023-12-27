<!-- _smtab -->
<div>
<table align=center border=0 width=175 cellpadding=1 cellspacing=1><tr>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$pyear?><?=@$q_page?><?=@$q_jk?>
<?=@$qdrv?>';"><font size=-2>&lt;&lt;</font></td>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$pmonthtm?><?=@$q_page?><?=@$q_jk?>
<?=@$qdrv?>';"><font size=-1>&lt;</font></td>
     <!-- onclick="location.href='?clshow=full';" -->
<td valign=middle align=center><font size=-2><b><?=$rmonth[$month]?>, <?=$year?></b></font></td>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$nmonthtm?><?=@$q_page?><?=@$q_jk?>
<?=@$qdrv?>';"><font size=-1>&gt;</font></td>
<td width=15 valign=middle align=center onclick="location.href='?tm=<?=$nyear?><?=@$q_page?><?=@$q_jk?>
<?=@$qdrv?>';"><font size=-2>&gt;&gt;</font></td>
</tr></table>
</div>
<div>
<table align=center border=0 width=175 cellpadding=1 cellspacing=1 bgcolor=#CCCCCC><thead>
<?php for($jh=1;$jh<=7;$jh=$jh+1): ?>
<th bgcolor=#A0A0A0 align=center width=20><font color=#FFFFFF size=-2><?=$ws[$jh]?></font></th>
<?php endfor; ?>
</thead>
<tbody>
<?php for($ir=0;$ir<$wrow;$ir++): ?>
<tr>
<?php for($ic=0;$ic<=6;$ic++): ?>
<td valign=top align=center onclick="location.href='?tm=<?=$cgo[$ir][$ic]?><?=@$q_page?><?=@$q_jk?><?=@$qdrv?>';" width=<?=$wd?>% bgcolor="<?=$celcol[$ir][$ic]?>">
<?php
if (isset($datedir)){
    $fsize="-2";
    $df=date("Ymd",$cgo[$ir][$ic]);
    $yf=date("Y",$cgo[$ir][$ic]);
    $mf=date("m",$cgo[$ir][$ic]);

    $date_file=$datedir."/".$df."/".$df.".lsd";
    $date_arch=$datedir."/".$yf."/".$df."/".$df.".lsd";

    $date_nfile=$datedir."/".$df."/n".$df.".lsd";
    $date_narch=$datedir."/".$yf."/".$df."/n".$df.".lsd";

    $start_b="";$stop_b="";$fsize="-2";$start_u="";$stop_u="";

    if (Check_PlayFile($date_file) OR Check_PlayFile($date_arch)){
        $start_b="<b>";$stop_b="</b>";$fsize="-1";
        $use_day=$cgo[$ir][$ic];
    } elseif (isset($use_day)){
        $prev_day[$cgo[$ir][$ic]]=$use_day;
    }

    if (Check_PlayFile($date_nfile) OR Check_PlayFile($date_narch)){
        $start_u="<u>";$stop_u="</u>";$fsize="-1";
        $use_night=$cgo[$ir][$ic];
    } elseif (isset($use_night)){
        $prev_night[$cgo[$ir][$ic]]=$use_night;
    }


} else {
    $fsize="-2";

    if (isset($use_day)){
        $prev_day[$cgo[$ir][$ic]]=$use_day;
    }

    if (isset($use_night)){
        $prev_night[$cgo[$ir][$ic]]=$use_night;
    }
}
?>
<font size=<?=$fsize ?> color="<?=$fontcol[$ir][$ic]?>">
<?=@$start_b ?><?=@$start_u ?><?=$celinf[$ir][$ic]?><?=@$stop_u ?><?=@$stop_b ?></font></td>
<?php endfor; ?>
</tr>
<?php endfor; ?>
</tbody>
</table>
</div>
<!-- \\_smtab -->
