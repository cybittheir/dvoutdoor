<?php

$sched_light_q="SELECT * FROM _sched WHERE _payment IS NULL ORDER by _month ASC, _day ASC";

if ($sched_light=dbQuery($sched_light_q,'mf')){
    
    $i=0;

        while ($sched_l_row = mysqli_fetch_array($sched_light)) {
            $i++;
            if (!empty($sched_l_row['fixed_at'])){$fixed_at=rusDate($sched_l_row['fixed_at']);}
            else {$fixed_at="";}

            $light_list[]="<td>".$i."</td><td><input type=text name=_day[".$sched_l_row['sh_ID']."] value=".$sched_l_row['_day']." size=2></td>
            <td><input type=text name=_month[".$sched_l_row['sh_ID']."] value=".$sched_l_row['_month']." size=2></td>
            <td><input type=text name=_sunrise[".$sched_l_row['sh_ID']."] value=".mb_substr($sched_l_row['sunrise_start'],0,5)." size=2></td>
            <td><input type=text name=_daylight[".$sched_l_row['sh_ID']."] value=".mb_substr($sched_l_row['daylight'],0,5)." size=2></td>
            <td><input type=text name=_sunset[".$sched_l_row['sh_ID']."] value=".mb_substr($sched_l_row['sunset_start'],0,5)." size=2></td>
            <td><input type=text name=_night[".$sched_l_row['sh_ID']."] value=".mb_substr($sched_l_row['night'],0,5)." size=2></td>
            <td>".$fixed_at."</td>";
        }
    }

    for ($ai=1;$ai<3;$ai++){
        $i_a=$ai+$i;
    $light_list[]="<td>".$i_a."</td><td><input type=text name=_day_n[".$ai."] value='' size=2></td>
    <td><input type=text name=_month_n[".$ai."] value='' size=2></td>
    <td><input type=text name=_sunrise_n[".$ai."] value='' size=2></td>
    <td><input type=text name=_daylight_n[".$ai."] value='' size=2></td>
    <td><input type=text name=_sunset_n[".$ai."] value='' size=2></td>
    <td><input type=text name=_night_n[".$ai."] value='' size=2></td>
    <td> </td>";
    }

// $sched_payment_q="SELECT * FROM _sched WHERE _payment IS NOT NULL ORDER by _day ASC";

$use_code="<input type=text name=code value='' size=5  placeholder='Код'>&nbsp;";
$pre_button="";
$button_name="Сохранить";

$light_list[]="
<tr><td colspan=8 align=right>".$pre_button.$use_code."<input type=submit name=add_eq value='".$button_name."'></td></tr>
";

$list_txt=implode("</tr>\n<tr>",$light_list);

$header="Планировщик на ".date("d/m/Y H:i",time());

$result_table="
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>№</th><th>Число</th><th>Месяц</th><th>Восход</th><th>День</th><th>Закат</th><th>Ночь</th><th>Дата фиксации</th></tr>

".$list_txt."

</table>
";


?>