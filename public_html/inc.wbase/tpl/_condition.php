<?=$cond_tab_head?>
<table width=400px bgcolor=#CCCCCC><thead><tr>
<th><font size=-2 color=#FFFFFF>№</font></th>
<th width=25px><font size=-2 color=#FFFFFF>ЯНВ</font></th>
<th width=25px><font size=-2 color=#FFFFFF>ФЕВ</font></th>
<th width=25px><font size=-2 color=#FFFFFF>МАР</font></th>
<th width=25px><font size=-2 color=#FFFFFF>АПР</font></th>
<th width=25px><font size=-2 color=#FFFFFF>МАЙ</font></th>
<th width=25px><font size=-2 color=#FFFFFF>ИЮН</font></th>
<th width=25px><font size=-2 color=#FFFFFF>ИЮЛ</font></th>
<th width=25px><font size=-2 color=#FFFFFF>АВГ</font></th>
<th width=25px><font size=-2 color=#FFFFFF>СЕН</font></th>
<th width=25px><font size=-2 color=#FFFFFF>ОКТ</font></th>
<th width=25px><font size=-2 color=#FFFFFF>НОЯ</font></th>
<th width=25px><font size=-2 color=#FFFFFF>ДЕК</font></th>
</tr></thead>
<?php while(list($ShowSurf,$Conditions)=each($ShowSurfCondition)): ?>
<tr>
<td align=center bgcolor='#СССССС' title='<?=$ShowSurf?>' alt='<?=$ShowSurf?>'>
<a href='?sedit=<?=$ShowSurf?>'>
<font color=white><?=$side_name[$ShowSurf]?>/<?=$surf_num[$ShowSurf];?></font></a></td>
<?php for ($m=1;$m<=12;$m++): ?>
<td align=center bgcolor='<?=$color[$Conditions[$m]]?>' title='<?=$signAlt[$Conditions[$m]]?>' alt='<?=$signAlt[$Conditions[$m]]?>'>
<font size=-1><?=$signAlt[$Conditions[$m]]?></font></td>
<?php endfor;?>
</tr>
<?php endwhile;?>
</table>