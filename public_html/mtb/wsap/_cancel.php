<?php

if (isset($iticket) AND $_GET['q']==$iticket){

    if (isset($_GET['cancelpc']) AND intval($_GET['cancelpc'])>0) {

        include("_pc.php");

        $header="Списание компьютера";

        if (isset($result_text)) {

            $result_text.="";

        } else {

            $result_text="";

        }

    } elseif(isset($_GET['cancelunit']) AND intval($_GET['cancelunit'])>0) {

        include("_unit.php");

        $header="Списание Оборудования";

        if (isset($result_text)) {

            $result_text.="";

        } else {

            $result_text="";

        }

    } elseif(isset($_GET['cancelunit']) OR isset($_GET['cancelpc']) OR isset($_GET['canceled'])) {

        $header="Список списанного оборудования";

    $equip_q="SELECT _units.id_unit,_units.model,_units.MAC,_units.reg_date,_units.un_life_time,_units.power,_units.memo,_units.canceled,_units.cancel_reason,_type_units.name AS type,_type_units.life_time FROM _units 
LEFT JOIN _type_units ON id_type=type_id
WHERE _units.canceled<'".date("Y-m-d",time()+3600*24)."' 
ORDER BY _units.canceled DESC";

        if ($equipment=dbQuery($equip_q,'mf')){

            while ($v = mysqli_fetch_array($equipment)) {

                if (!empty($v['MAC'])) {$mac_id=$v['MAC'];}
                else {$mac_id="";}

                $unitURL="'?un=".$v['id_unit']."&q=".$iticket."'";

                if (!empty($v['model'])) {$model="<a href=".$unitURL.">'".$v['model']."'</a>";}
                else {$model="<a href=".$unitURL.">?noname?</a>";}

                if (!empty($v['installed'])) {
            
                    $installed=$v['installed'];

                } elseif (!empty($v['obj_installed'])) {
            
                    $installed="<i><font color=darkgreen>".$v['obj_installed']."</i>";

                } else {
            
                    $installed="--";
        
                }

                $duration="-";

                $cancel_date=$v['canceled'];

                if (!empty($v['reg_date'])) {$registred=$v['reg_date'];}
                else {$registred="2016-01-01";}

                if (!empty($v['un_life_time']) AND !empty($v['reg_date'])) {

                    $tmp_time_arr=explode("-",$v['reg_date']);

                    $year_exp=$v['un_life_time'] + $tmp_time_arr[0];
                    $month_exp=$tmp_time_arr[1];
                    $date_exp=$tmp_time_arr[2];
    
                    $lifetime=" Срок эксплуатации до ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];

                } elseif (!empty($v['life_time']) AND !empty($v['reg_date'])) {

                    $tmp_time_arr=explode("-",$v['reg_date']);

                    $year_exp=$v['life_time'] + $tmp_time_arr[0];
                    $month_exp=$tmp_time_arr[1];
                    $date_exp=$tmp_time_arr[2];
    
                    $lifetime=" Срок эксплуатации до ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];

                } elseif (!empty($v['un_life_time']) AND !empty($v['installed'])) {

                    $tmp_time_arr=explode("-",$v['installed']);

                    $year_exp=$v['un_life_time'] + $tmp_time_arr[0];
                    $month_exp=$tmp_time_arr[1];
                    $date_exp=$tmp_time_arr[2];
    
                    $lifetime=" Срок эксплуатации до ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];

                } elseif (!empty($v['life_time']) AND !empty($v['installed'])) {

                    $tmp_time_arr=explode("-",$v['installed']);

                    $year_exp=$v['life_time'] + $tmp_time_arr[0];
                    $month_exp=$tmp_time_arr[1];
                    $date_exp=$tmp_time_arr[2];
    
                    $lifetime=" Срок эксплуатации до ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];

                } elseif (!empty($v['un_life_time'])) {

                    $lifetime=" Срок эксплуатации до ".$v['un_life_time']." лет.";
    
                } elseif (!empty($v['life_time'])) {

                    $lifetime=" Срок эксплуатации до ".$v['life_time']." лет.";
    
                } else {
        
                    $lifetime=" Срок эксплуатации не известен или не ограничен.";
    
                }

                if (!empty($v['memo'])) {
            
                    $info=nl2br($v['memo']);

                } else {

                    $info="";
        
                }

                if (!empty($v['cancel_reason'])) {
            
                    $info.="<br><b>:::: Причина списания:</b> ".nl2br($v['cancel_reason']);
        
                }

                if (isset($v['tech']) AND $v['tech']==1){

                    $tc=" style='color:red;' alt='охранное оборудование' title='охранное оборудование'";

                } else {$tc="";}

                $reg_arr=explode("-",$registred);
                $cancel_arr=explode("-",$cancel_date);

                $reg_cod=mktime(0,0,1,$reg_arr[1],$reg_arr[2],$reg_arr[0]);
                $cancel_cod=mktime(0,0,1,$cancel_arr[1],$cancel_arr[2],$cancel_arr[0]);
    
                $duration_all=$cancel_cod-$reg_cod;
                $duration=floor($duration_all/(3600*24));    

                if ($duration>365){

                    $duration_year=floor($duration/365);
                    $duration_days=floor($duration%365);

                    if ($duration_year<5){$year_rus=" г. ";}
                    else {$year_rus=" л. ";}
                    
                    $duration= $duration_year.$year_rus.$duration_days;
                    
                }

                $canceled[]="<td>".rusDate($cancel_date)."</td><td".$tc.">".$v['type']."</td><td>".$model."</td><td>".$mac_id."</td><td>".rusDate($registred)."</td><td>".$duration." дн.</td><td>".$info."</td>";

                unset($info);
                unset($cancel_date);
                unset($duration);
                unset($registred);
                unset($mac_id);
                unset($model);

            }

        }

        $pc_q="SELECT  _units_pc.id_pc,_units_pc.model_pc,_units_pc.MAC1,_units_pc.MAC2,_units_pc.reg_date_pc,_units_pc.pc_life_time,_units_pc.power_pc,_units_pc.memo_pc,_units_pc.canceled_pc,_units_pc.cancel_reason_pc,_type_units.name AS type,_type_units.life_time FROM _units_pc 
LEFT JOIN _type_units ON id_type=5
WHERE _units_pc.canceled_pc<'".date("Y-m-d",time()+3600*24)."' 
ORDER BY canceled_pc DESC";

#   echo $equip_q;

        if ($equip_pc=dbQuery($pc_q,'mf')){

            while ($v = mysqli_fetch_array($equip_pc)) {

                if (!empty($v['MAC1'])) {$mac[]=$v['MAC1'];}

                if (!empty($v['MAC2'])) {$mac[]=$v['MAC2'];}

                if (isset($mac)) {
        
                    $mac_id=implode("; ",$mac);
                    unset($mac);

                } else {
        
                    $mac_id="";
        
                }

                $duration="-";

                $cancel_date=$v['canceled_pc'];

                if (!empty($v['reg_date_pc'])) {$registred=$v['reg_date_pc'];}
                else {$registred="2016-01-01";}



                $pcURL="'?pc=".$v['id_pc']."&q=".$iticket."'";

                if (!empty($v['model_pc'])) {$model="<a href=".$pcURL.">'".$v['model_pc']."'</a>";}
                else {$model="<a href=".$pcURL.">?noname?</a>";}

                if (!empty($v['installed'])) {
            
                    $installed=$v['installed'];

                } elseif (!empty($v['obj_installed'])) {
            
                    $installed="<i><font color=darkgreen>".$v['obj_installed']."</i>";

                } else {
            
                    $installed="--";
        
                }

                if (!empty($v['memo_pc'])) {
            
                    $info=nl2br($v['memo_pc']);

                } else {

                    $info="";
        
                }

                if (!empty($v['cancel_reason_pc'])) {
            
                    $info.="<br><b>:::: Причина списания:</b> ".nl2br($v['cancel_reason_pc']);
        
                }

                $reg_arr=explode("-",$registred);
                $cancel_arr=explode("-",$cancel_date);

                $reg_cod=mktime(0,0,1,$reg_arr[1],$reg_arr[2],$reg_arr[0]);
                $cancel_cod=mktime(0,0,1,$cancel_arr[1],$cancel_arr[2],$cancel_arr[0]);
    
                $duration_all=$cancel_cod-$reg_cod;
                $duration=floor($duration_all/(3600*24));  
                
                if ($duration>365){

                    $duration_year=floor($duration/365);
                    $duration_days=floor($duration%365);

                    if ($duration_year<5){$year_rus=" г. ";}
                    else {$year_rus=" л. ";}
                    
                    $duration= $duration_year.$year_rus.$duration_days;
                }

                $canceled[]="<td>".rusDate($cancel_date)."</td><td>".$v['type']."</td><td>".$model."</td><td>".$mac_id."</td><td>".rusDate($registred)."</td><td>".$duration." д.</td><td>".$info."</td>";

                unset($info);
                unset($cancel_date);
                unset($duration);
                unset($registred);
                unset($mac_id);
                unset($model);

            }

        }

        if (!isset($canceled)) {
    
            $canceled[]="";

        }

        $list_txt=implode("</tr>\n",$canceled)."</tr>";

        $header="Списанное оборудование";

        $result_table="
        <table border=1 cellspacing=1 cellpadding=5>
        <tr bgcolor=lightgrey><th>Дата списания</th><th>Тип</th><th>Модель</th><th>MAC</th><th>Дата регистрации</th><th>Время работы</th><th>Дополнительно</th></tr>
        ".$list_txt."
        </table>
        ";

    } else {
    
        $list_txt="";
    
    }


}


?>