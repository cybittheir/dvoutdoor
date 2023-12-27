<?php

if (isset($iticket) AND $_GET['q']==$iticket){

    $unitHistory_q="SELECT _list.*,_links.*,_move_units.*,_units.*,_type_units.name AS typename  FROM `_list` 
    LEFT JOIN _links ON _links.media_lnk=id
    LEFT JOIN _move_units ON _move_units.object_id=_links.object_lnk
    LEFT JOIN _units ON _units.id_unit=_move_units.unitId
    LEFT JOIN _type_units ON _type_units.id_type=_units.type_id
    WHERE id=".intval($_GET['md'])." ORDER BY installed DESC";
    
    #    echo $reserves_q;
    
    if ($unitHistory=dbQuery($unitHistory_q,'mf')){
    
    #        $_arr = mysqli_fetch_array($reserves);
    
        while ($v = mysqli_fetch_array($unitHistory)) {
    
            if (!empty($v['MAC'])) {$mac_id=$v['MAC'];}
            else {$mac_id="";}
    
            $unitURL="'?md=".$v['id']."&q=".$iticket."'";
    
            if (!empty($v['model'])) {$model=$v['model'];}
            else {$model="?noname?";}
    
            if (!empty($v['typename'])) {$type=$v['typename'];}
            else {$type="?type?";}

            if (!empty($v['name'])) {$address=$v['name'];}
            else {$address="?";}

            if (!empty($v['reg_date'])){$reg_date=$v['reg_date'];}
            else {$reg_date="нет отметки";}

            if (!empty($v['used_before']) AND $v['used_before']!='9999-12-31' AND $v['used_before']!='2000-01-01') {
                
                $used_before=$v['used_before'];
                $bg_color[$v['id_move']]=" bgcolor=orange";
            
            } else {
                
                $used_before=" - ";
                $bg_color[$v['id_move']]="";
            
            }
    
            if (!empty($v['life_time']) AND !empty($v['reg_date'])) {
    
                $tmp_time_arr=explode("-",$v['reg_date']);
    
                $year_exp=$v['life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
        
                $lifetime=" Срок эксплуатации до ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];
    
            } elseif (!empty($v['life_time']) AND !empty($v['installed'])) {
    
                $tmp_time_arr=explode("-",$v['installed']);
    
                $year_exp=$v['life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
        
                $lifetime=" Срок эксплуатации до ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];
    
            } elseif (!empty($v['life_time'])) {
    
                $lifetime=" Срок эксплуатации до ".$v['life_time']." лет.";
        
            } else {
            
                $lifetime=" Срок эксплуатации не известен или не ограничен.";
        
            }
    
            if (!empty($v['installed'])){$installed=$v['installed'];}
            else {$installed="нет данных";}
    
            if (!empty($v['info'])) {$info=$v['info'];}
            else {$info="";}
    
            $step[$v['id_move']][]=$installed."</td><td>".$type."</td><td>".$model."</td><td>".$mac_id."</td><td>".$used_before."</td><td>".$info;
    
            if (isset($count[$v['id_move']])) {
                $t_count=$count[$v['id_move']];
                $t_count++;
                $count[$v['id_move']]=$t_count;
            } else {$count[$v['id_move']]=1;}
        
        }  
    
        reset($step);

    }

    /////

    $num=1;

    while (list($u,$st)=each($step)){

        $result[]="<tr".$bg_color[$u]."><td>".$num."</td><td>".implode("</td></tr>\n<tr><td>",$st)."</td></tr>";
        $num++;

    }

    $list_txt=implode("\n",$result);

    echo "
<h2>История оборудования на ".date("d/m/Y H:i",time())."</h2>
<b>".$address.":</b> <br>
<b>Регистрация в базе:</b> <i>".$reg_date."</i><br>
".$menu."
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>№</th><th>С даты</th><th>Тип</th><th>Модель</th><th>MAC</th><th>По дату</th><th>Примечание</th></tr>
".$list_txt."

</table>
".$menu;

}

?>