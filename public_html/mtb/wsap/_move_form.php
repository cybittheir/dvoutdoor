<?php

$sel_type[]="<select name=type>";
$sel_type[]="<option value=''".$disabled.">Укажите тип</option>";
$sel_type[]="<option value='' disabled>-----</option>";

$types_q="SELECT * FROM _type_units WHERE 1 ORDER BY name ASC ";

if ($types=dbQuery($types_q,'mf')){

    while ($t = mysqli_fetch_array($types)) {
        
        if (isset($type) AND $t['id_type']==$type){

            $sel=" selected";

        } else {

            $sel=$disabled;

        }

        $sel_type[]="<option value='".$t['id_type']."'".$sel.">".$t['name']."</option>";

    }

}

$sel_type[]="</select>";

$sel_types=implode("\n",$sel_type);
unset($sel_type);

$player_type[]="<select name=player_type>";
$player_type[]="<option value=''>Укажите плеер</option>";
$player_type[]="<option value=''>-----</option>";

$player_q="SELECT * FROM _val_player WHERE 1 ORDER BY player_name ASC ";

if ($players=dbQuery($player_q,'mf')){

    while ($p = mysqli_fetch_array($players)) {
        
        if (isset($_mf_player_type) AND $p['id_player']==$_mf_player_type){

            $sel=" selected";

        } elseif(!empty($p['_default']) AND $p['_default']==1) {

            $sel=" selected";

        } else {

            $sel="";

        }

        $player_type[]="<option value='".$p['id_player']."'".$sel.">".$p['player_name']."</option>";

    }

}

if (isset($_POST['code'])){$code=$_POST['code'];}
else {$code="";}

$player_type[]="</select>";

$player=implode("\n",$player_type);
unset($player_type);

if (!isset($model)) {
    $model="";
}

if (!isset($power)) {
    $power="";
}


if (!isset($anydesk)) {
    $anydesk="";
}

if (!isset($mac1)) {
    $mac1="";
}

if (!isset($mac2)) {
    $mac2="";
}

if (!isset($info)) {
    $info="";
}

if (mb_substr($form_action,0,4)=="edit" OR $form_action=="add"){

    $use_code="<input type=text name=code value='' size=5  placeholder='Код'>&nbsp;";

} else {

    $use_code="";

}

$text_rows=4;

if (isset($type) AND intval($type)==5){

    $memo_rows="rowspan=3 ";
    $add_read_head="<th>Дополнительно</th><th>Доп. добавить</th>";
    $add_read="<td ".$memo_rows."valign=top><textarea name=info_read rows=".$text_rows." readonly>".$info."</textarea>
    <td ".$memo_rows."valign=top><textarea name=info rows=".$text_rows."></textarea></td>";

} elseif (isset($_GET['add'])){

    $memo_rows="rowspan=4 ";
    $add_read_head="<th>Дополнительно</th>";
    $add_read="<td ".$memo_rows."valign=top><textarea name=info rows=6></textarea></td>";

} else {
    
    $memo_rows="";
    $add_read_head="<th>Дополнительно</th><th>Доп. добавить</th>";
    $add_read="<td ".$memo_rows."valign=top><textarea name=info_read rows=".$text_rows." readonly>".$info."</textarea>
    <td ".$memo_rows."valign=top><textarea name=info rows=".$text_rows."></textarea></td>";

}

if (!empty($unit_id)) {$show_id="<br><br><b>ID".$unit_id."</b>";}
else {$show_id="";}

$list_arr[]="
<tr bgcolor=#C0C0C0><th>С даты</th><th>Адрес</th><th>ISP</th><th>IP</th><th>IP внеш.</th>".$add_read_head."</tr>
<tr><td valign=top align=center>".$sel_types.$show_id."</td><td valign=top><input type=text name=model value='".$model."'></td><td valign=top><input type=text name=mac1 value='".$mac1."'></td><td valign=top><input type=text name=power value='".$power."'></td>".$add_read."</tr>";

$list_arr[]="
<tr><td colspan=6 align=right>".$pre_button.$use_code."<input type=submit name=add_eq value='".$button_name."'></td></tr>
";

$list_txt=implode("",$list_arr);

unset($list_arr);

?>