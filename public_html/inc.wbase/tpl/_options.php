<?php
$search_q['side']="-";
$search_q['id']="-";
$search_q['utm_content']="-";
$search_q['utm_medium']="-";

?>
<FORM id='search' action='/<?=UrlQuery($search_q);?>' name='search' method='POST'>
<table width=100% cellpadding=1 cellspacing=1 border=0px>
<tr>
<td style='width: 135px;'>
<select name='area' style='width: 130px;'>
<?=@$area_list;?>
</select>
</td>
<td style='width: 135px;'>
<select name='ctype' style='width: 130px;'>
<?=@$type_list;?>
</select>
</td>
<td style='width: 185px;'><font size="2.0em">
Адрес: <input type="text" style='width: 120px;' name="ss" value='<?=@$_SESSION['adb_search'];?>'></font>
</td>
<td style='width: 60px;'>
<select name='side'>
<option value='all'>А.+Б.</option>
<option value='A'<?=@$_SESSION['side_a']?>>А..</option>
<option value='B'<?=@$_SESSION['side_b']?>>Б..</option>
<option value='IN'<?=@$_SESSION['side_in']?>>Внутр.</option>
<option value='OUT'<?=@$_SESSION['side_out']?>>Внеш.</option>
</select>
</font></td>
<td style='width: 95px;'><font size="2.0em">
<select name="onsale">
<option value='all'>Все</option>
<option value='onsale'<?=@$_SESSION['onsale'];?>>В продаже</option>>
</select>
</font></td>
<td style='width: 80px;' align=center>
<input type="submit" name="choose" value="Выбрать">
</td>
<td style='width: 80px;' align=center>
<input type="submit" name="reset" value="Сброс">
</td>
<td>
</td>
</tr>
</table>
