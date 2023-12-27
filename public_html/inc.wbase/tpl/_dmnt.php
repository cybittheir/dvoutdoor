
<form id=dmnt action="" name="dmnt" method="POST">
    <center><font size=+2><b>Таблица демонтажей</b></font><font size=+1> на месяц даты <input type=date name='curr_date' onchange="document.getElementById('dmnt').submit(); return false;" value='<?=$curr_date?>'></font></center> 
</form>
        <font size=+0><b>Итого</b> поверхностей на демонтаж: <?=@$count_dmnt?></font>
<div id='dmnt' style='display:inline-block;position:relative;width:99%;height:250px;'>
<div id=dmntin style='display:inline-block;width:100%;height:100%;margin:5px;margin-bottom:0px;overflow:auto;'>
        <table id='rounded-corner' width='96%' align=center>
        <thead><tr><th align='left'><?php echo implode("</th><th align='left'>",$tab_head)?></th></tr></thead>
<?php while(list($k,$v)=each($billboard)):?>
    <tr>
<?php while(list($bk,$bv)=each($v)): ?>
        <td
<?php if (isset($bgc[$k][$bk])) :?><?=$bgc[$k][$bk]?><?php endif ;?>
><?=$bv?></td>
<?php endwhile; ?>
    </tr>
<?php endwhile; ?>
</table>
</div>
</div>