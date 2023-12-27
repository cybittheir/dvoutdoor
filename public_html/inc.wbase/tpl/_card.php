<table width=100% cellpadding=0 colspacing=0 border=0>
<tr>
<td align="center" width="140" valign="middle" style='max-width:140px';>
<div id=inf style='display:block;position:fixed;float:left;height:232px;background-color:lightgrey;top:93px;left:17px; max-width:140px;min-width:120px;'>
<?php if(!empty($s_row[$side_index]['reg'])):?>
<font size="6.0em" color="orange"><B>№<?=$s_row[$side_index]['reg'];?></B></font><hr>
<?php endif; ?>
<?php if(!empty($s_row[$side_index]['side'])):?>
<?php if($s_row[$side_index]['side']=="Внутренняя"):?>
<font size="7.0em" color="blue"><B>Вн</B></font><font size="1.0em" color="blue">утренняя</font>
<?php elseif($s_row[$side_index]['side']=="Внешняя"): ?>
<font size="7.0em" color="blue"><B>Нар</B></font><font size="1.0em" color="blue">ружняя</font>
<?php else: ?>
<font size="7.0em" color="blue"><B><?=$s_row[$side_index]['side'];?></B></font>
<?php endif; ?>
<?php else: ?>
<font size="7.0em" color="blue"><B>--</B></font>
<?php endif; ?>
<?php if(!empty($s_row[$side_index]['prz']) OR !empty($s_row[$side_index]['gmap']) OR !empty($s_row[$side_index]['lgt']) OR !empty($s_row[$side_index]['dgt'])):?>
<hr>
<?php endif; ?>
<?=lnk_icon($s_row[$side_index]);?>
</div>
</td>
<td valign=top>
<div style="position:relative;width:100%;padding:0px;margin:0px;height:232px;overflow:auto;">
<table width=100% cellpadding=4 colspacing=3 border=0>
<tr><td align=left valign=top>
<font size="4.0em"><?=$s_row[$side_index]['city'];?></font>
</td><td align=right valign=top>
<font size="2.0em"><b><u><?=$s_row[$side_index]['tp'];?></u></b></font><?=lnk_icon($s_row[$side_index],'yes');?>
</td></tr>
<tr><td align=left valign=top colspan=2>
<a href="<?=UrlQuery($card_query);?>" title="открыть карточку"><font size="5.0em"><b><?=$s_row[$side_index]['title'];?></B></font></a>
</td></tr>
<?php if($s_row[$side_index]['en']=="продано до конца года"):?>
<tr><td align=center valign=top colspan=2 bgcolor="darkred">
<font size="3.0em" color="yellow"><b><?=mb_strtoupper($s_row[$side_index]['en']);?></b></font>
</td></tr>
<?php else:?>
<tr><td align=left valign=top colspan=2>
<font size="1.0em" color="grey"><i><?=$s_row[$side_index]['en'];?></i></font>
</td></tr>
<?php endif;?>
<tr><td align=left valign=top colspan=2>
<span title="Названия поверхностей в адресной программе">
<font size=-2>&nbsp;-&nbsp;<?=implode(";<br>\n&nbsp;-&nbsp;",$addr_row);?>;</font></span>
</td></tr>
<tr><td align=right valign="bottom" colspan=2><?=lnk_icon($s_row[$side_index],'txt');?></td>
</tr>
</table>
</div>
</td>
<td width=420 align="center" valign=top>
<div class="image">
<?php include_once($inc_path."/tpl/_pics.php"); ?>
</div>
</td>
<td width=400>
<?php if($make_map):?>
<script type="text/javascript">
    // Как только будет загружен API и готов DOM, выполняем инициализацию
    ymaps.ready(init);

    function init () {
        var myMap = new ymaps.Map("map", {center: [<?=$s_row[$side_index]['Y'];?>,<?=$s_row[$side_index]['X'];?>],zoom: 16,controls:['trafficControl']}),
        // Первый способ задания метки
        myPlacemark = new ymaps.Placemark([<?=$s_row[$side_index]['Y'];?>,<?=$s_row[$side_index]['X'];?>]);
        // Добавляем метки на карту
        myMap.geoObjects.add(myPlacemark);
    }
</script>
<?php endif;?>
<div id=pre style='display:block;position:fixed;float:left;height:232px;border:solid 1px grey;top:93px;right:17px; width:400px;'>
<div id='map' style='display:inline-block;position:relative;width:100%;height:232px;'></div>
</div>
</td>
</tr>
</table>

<?php

unset($s_row);

?>