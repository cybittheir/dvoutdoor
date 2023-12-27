<center>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<table width=820 cellpadding=0 colspacing=0 border=0 align=center>
<tr>
<td width=800 align="center" valign=top>
<div class="image">
<?php include_once($inc_path."/tpl/_pics.php"); ?>
</div>
</td></tr>
<tr><td>
<table width=100% cellpadding=0 colspacing=0 border=0 align=center>
<tr>
<td bgcolor="lightgrey" align="center" width="140" valign="middle">
<?php if(!empty($s_row[$side_index]['reg'])):?><span title="Уникальный номер регистрации в муниципалитете">
<font size="6.0em" color="orange"><B>№<?=$s_row[$side_index]['reg'];?></B></font></span><hr>
<?php endif; ?>
<?php if(!empty($s_row[$side_index]['side'])):?><span title="Сторона размещения">
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
</td>
<td valign=top>
<div style="position:relative;width:100%;padding:1px;">
<table width=100% cellpadding=4 colspacing=3 border=0>
<tr><td align=left valign=bottom>
<font size="4.0em"><?=$s_row[$side_index]['city'];?></font>
</td><td align=right valign=top>
<font size="2.0em"><b><u><?=$s_row[$side_index]['tp'];?></u></b></font><?=lnk_icon($s_row[$side_index],'yes');?>
</td></tr>
<tr><td align=left valign=top colspan=2>
<a href="<?=UrlQuery($show_side,'','side');?>" title="Карточка с таблицей адресов"><font size="5.0em"><b><?=$s_row[$side_index]['title'];?></B></font></a>
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
<tr><td align=left valign=top><span title="Названия поверхностей в адресной программе">
<font size=-2>&nbsp;-&nbsp;<?=implode(";<br>\n&nbsp;-&nbsp;",$addr_row);?>;</font></span>
</td>
<td align=right valign="bottom"><?=lnk_icon($s_row[$side_index],'txt');?><br>
<a href="<?=UrlQuery($show_all);?>" title="Перейти на все адреса"><font size=-1>Перейти на все адреса</font></a></td>
</tr>
<?php if(isset($cards_nav)):?>
<tr><td colspan=2 bgcolor=lightgrey>
<table width=100% cellpadding=0 colspacing=0 border=0>
<tr>
<td align=left bgcolor=lightgrey><?php if(isset($cards_nav['prev'])):?>
<a href="?card&side=<?=$cards_nav['prev']['id']?>">&lt; <font size=-2 color=black><?=$cards_nav['prev']['address']?></font></a>
<?php endif;?></td>
<td align=right><?php if(isset($cards_nav['next'])):?>
<a href="?card&side=<?=$cards_nav['next']['id']?>"><font size=-2 color=black><?=$cards_nav['next']['address']?></font> &gt;</a>
<?php endif;?></td>
</tr>
</table>
</td></tr>
<?php endif;?>
</table>
</div>
</td></tr></table>
</td></tr>
<tr>
<td width=100%>
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

<div id='map' style='display:inline-block;position:relative;width:100%;height:232px;'></div>

</td>
</tr>
</table>
<br><br><br>
</center>
