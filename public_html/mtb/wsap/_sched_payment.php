<?php

$sched_payment_q="SELECT * FROM _sched 
LEFT JOIN _objects ON id_obj=_payment
WHERE _payment IS NOT NULL ORDER by _day ASC";

$active_row['']="";
$active_row['1']="Выкл.";

if ($sched_payment=dbQuery($sched_payment_q,'mf')){
    
    $i=0;

        while ($sched_p_row = mysqli_fetch_array($sched_payment)) {
            
            $i++;

            if (!empty($sched_p_row['fixed_at'])){$fixed_at=rusDate($sched_p_row['fixed_at']);}
            else {$fixed_at="";}

            $payment_list[]="<td>".$i."</td><td><input type=text name=_day[".$sched_p_row['sh_ID']."] value=".$sched_p_row['_day']." size=2></td>
            <td><input type=text name=_object[".$sched_p_row['sh_ID']."] value='".$sched_p_row['address']."' size=15></td>
            <td><input type=text name=_not_active[".$sched_p_row['sh_ID']."] value='".$active_row[$sched_p_row['not_active']]."' size=5></td>
            <td>".$fixed_at."</td>";
        }
    }

    for ($ai=1;$ai<3;$ai++){
        $i_a=$ai+$i;
    $payment_list[]="<td>".$i_a."</td><td><input type=text name=_day_n[".$ai."] value='' size=2></td>
    <td><input type=text name=_object_n[".$ai."] value='' size=2></td>
    <td> </td>";
    }

$use_code="<input type=text name=code value='' size=5  placeholder='Код'>&nbsp;";
$pre_button="";
$button_name="Сохранить";

$payment_list[]="
<tr><td colspan=8 align=right>".$pre_button.$use_code."<input type=submit name=add_eq value='".$button_name."'></td></tr>
";

$list_txt=implode("</tr>\n<tr>",$payment_list);

$header="Планировщик платежей на ".date("d/m/Y H:i",time());

$result_table="
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>№</th><th>Число</th><th>Объект</th><th>Вкл.</th><th>Дата платежа</th></tr>

".$list_txt."

</table>
";


?>