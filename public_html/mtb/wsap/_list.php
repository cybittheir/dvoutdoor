<?php

$reserves_q="SELECT * FROM _units 
LEFT JOIN _type_units ON id_type=type_id
LEFT JOIN _move_units ON unitId=id_unit
WHERE object_id=1 AND used_before='2000-01-01' AND canceled>'".date("Y-m-d",time())."' ORDER BY type_id,model ASC";

#    echo $reserves_q;

if ($reserves=dbQuery($reserves_q,'mf')){

#        $_arr = mysqli_fetch_array($reserves);

    while ($v = mysqli_fetch_array($reserves)) {

        if (!empty($v['MAC'])) {$mac_id=showMAC($v['MAC']);}
        else {$mac_id="";}

        $unitURL="'?un=".$v['unitId']."&q=".$iticket."'";

        if (!empty($v['model'])) {$model="<a href=".$unitURL.">'".$v['model']."'</a>";}
        else {$model="<a href=".$unitURL.">?noname?</a>";}

        if (!empty($v['reg_date']) AND !empty($v['installed']) AND $v['installed']!=$v['reg_date']) {
            
            $used_from=" В работе с ".rusDate($v['reg_date']).", в резерве с ".rusDate($v['installed']).".";
        
        } elseif (!empty($v['reg_date']) AND empty($v['installed'])) {
            
            $used_from=" В работе с ".rusDate($v['reg_date']).".";

        } elseif ((empty($v['reg_date']) AND !empty($v['installed'])) OR (!empty($v['reg_date']) AND !empty($v['installed']) AND $v['installed']==$v['reg_date'])) {
            
            $used_from=" В резерве с ".rusDate($v['installed']).".";

        } else {
            
            $used_from=" Новое, или Срок использования не известен.";
        
        }

        if (!empty($v['life_time']) AND !empty($v['reg_date'])) {

            $tmp_time_arr=explode("-",$v['reg_date']);

            $year_exp=$v['life_time'] + $tmp_time_arr[0];
            $month_exp=$tmp_time_arr[1];
            $date_exp=$tmp_time_arr[2];
    
            $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

        } elseif (!empty($v['life_time']) AND !empty($v['installed'])) {

            $tmp_time_arr=explode("-",$v['installed']);

            $year_exp=$v['life_time'] + $tmp_time_arr[0];
            $month_exp=$tmp_time_arr[1];
            $date_exp=$tmp_time_arr[2];
    
            $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

        } elseif (!empty($v['life_time'])) {

            $lifetime=" Срок эксплуатации до ".$v['life_time']." лет.";
    
        } else {
        
            $lifetime=" Срок эксплуатации не известен или не ограничен.";
    
        }

        if (!empty($v['info'])) {$info=$v['info'];}
        else {$info="";}

        $unite[$v['name']][]=$model."</td><td>".$mac_id."</td><td>".$used_from."</td><td>".$lifetime."</td><td>".$info;

        if (isset($count[$v['name']])) {
            $t_count=$count[$v['name']];
            $t_count++;
            $count[$v['name']]=$t_count;
        } else {$count[$v['name']]=1;}

        unset($model);
        unset($mac_id);

    }  

    reset($unite);

// резервы компьютеров

    $reservesPC_q="SELECT * FROM _units_pc 
    LEFT JOIN _move_pc ON pcId=id_pc
    LEFT JOIN _type_units ON id_type=5
    WHERE object_id=1 AND used_before='2000-01-01' AND canceled_pc>'".date("Y-m-d",time())."' ORDER BY model_pc ASC";

# echo   $reservesPC_q;

    if ($reservesPC=dbQuery($reservesPC_q,'mf')){
    
        unset ($v);

        while ($v = mysqli_fetch_array($reservesPC)) {

            $pcURL="'?pc=".$v['pcId']."&q=".$iticket."'";

            if (!empty($v['MAC1'])) {$mac_[]=showMAC($v['MAC1']);}

            if (!empty($v['MAC2'])) {$mac_[]=showMAC($v['MAC2']);}

            if (isset($mac_)){
                $mac_id=implode("; ",$mac_);
                unset($mac_);
            } else {$mac_id="";}

            if (!empty($v['model_pc'])) {$model="<a href=".$pcURL.">'".$v['model_pc']."'</a>";}
            else {$model="<a href=".$pcURL.">?noname?</a>";}

            if (!empty($v['reg_date_pc']) AND !empty($v['installed']) AND $v['installed']!=$v['reg_date_pc']) {
            
                $used_from=" В работе с ".rusDate($v['reg_date_pc']).", в резерве с ".rusDate($v['installed']).".";

            } elseif (!empty($v['reg_date_pc']) AND empty($v['installed'])) {
                
                $used_from=" В работе с ".rusDate($v['reg_date_pc']).".";

            } elseif ((empty($v['reg_date_pc']) AND !empty($v['installed'])) OR (!empty($v['reg_date_pc']) AND !empty($v['installed']) AND $v['installed']==$v['reg_date_pc'])) {
                
                $used_from=" В резерве с ".rusDate($v['installed']).".";

            } else {
                
                $used_from=" Новое, или Срок использования не известен.";
            
            }
    
            if (!empty($v['pc_life_time']) AND !empty($v['reg_date_pc'])) {

                $tmp_time_arr=explode("-",$v['reg_date_pc']);

                $year_exp=$v['pc_life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
        
                $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

            } elseif (!empty($v['pc_life_time']) AND !empty($v['installed'])) {

                $tmp_time_arr=explode("-",$v['installed']);

                $year_exp=$v['pc_life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
        
                $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

            } elseif (!empty($v['pc_life_time'])) {

                $lifetime=" Срок эксплуатации до ".$v['pc_life_time']." лет.";
        
            } else {
            
                $lifetime=" Срок эксплуатации не известен или не ограничен.";
        
            }

            if (!empty($v['info'])) {$info=$v['info'];}
            else {$info="";}

            $unite[$v['name']][]=$model."</td><td>".$mac_id."</td><td>".$used_from."</td><td>".$lifetime."</td><td>".$info;

            if (isset($count[$v['name']])) {
                $t_count=$count[$v['name']];
                $t_count++;
                $count[$v['name']]=$t_count;
            } else {$count[$v['name']]=1;}

            unset($model);
            unset($mac_id);

        }  
    }

    reset($unite);

/////

    while (list($u,$st)=each($unite)){
        
        if (empty($c)) {$c=" bgcolor=lightblue";}
        else {$c="";}

        $result[]="<tr".$c."><td bgcolor=lightgreen rowspan=".$count[$u]."><b>".$u."</b>(".$count[$u].")</td><td>".implode("</td></tr>\n<tr".$c."><td>",$st)."</td></tr>";

    }

}

if (isset($result)){

    $list_txt=implode("\n",$result);

} else {$list_txt="";}

$header="Состояние резервов на ".date("d/m/Y H:i",time())."&nbsp;<a href=?equipment&add&q=".$iticket." alt='добавить оборудование' title='добавить оборудование' style='text-decoration:none;font-size:14px;background-color:red;'>➕</a>";

$result_table="
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>Тип</th><th>Модель</th><th>MAC-Адрес</th><th>Использование</th><th>Срок эксплуатации</th><th>Комментарий по резерву</th></tr>

".$list_txt."

</table>
";

?>