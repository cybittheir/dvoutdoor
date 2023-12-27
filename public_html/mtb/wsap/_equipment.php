<?php

$obj_addr="";

$eq_url="&equipment&q=".$iticket;

if (isset($_GET['add']) OR isset($_GET['editun']) OR isset($_GET['editpc'])){

    $pre_button="";

    if (isset($_GET['add'])) {
        
        $header="Добавить оборудование.";

        $form_action="add";

        $disabled="";

        $button_name="Добавить";

        $form_id="add_eq";

        if (isset($_GET['CONFIRM']) AND isset($_POST['code']) AND intval($_POST['code'])=="5050867") {
            
            include ("_add_equip.php");

        }

    } elseif(isset($_GET['editun']) AND intval($_GET['editun'])>0) {
        
        $header="Изменить данные оборудования.";

        $unit_id=intval($_GET['editun']);
    
        $form_action="editun=".$unit_id;

        $disabled=" disabled";

        $button_name="Сохранить";

        $form_id="edit_eq";

        include ("_get_unit.php");

        if (!empty($_POST['code'])) {

            $code_arr=explode("ID",$_POST['code']);

            if (isset($_GET['CONFIRM']) AND intval($code_arr[1])==$unit_id) {
            
                include ("_save_un.php");

            }

            unset($code_arr);

        }

    } elseif(isset($_GET['editpc']) AND intval($_GET['editpc'])>0) {
        
        $header="Изменить данные компьютера.";

        $pc_id=intval($_GET['editpc']);
    
        $form_action="editpc=".$pc_id;

        $type=5;

        $disabled=" disabled";

        $button_name="Сохранить";

        $form_id="edit_eq";

        include ("_get_pc.php");

        if (!empty($_POST['code'])) {

            $code_arr=explode("ID",$_POST['code']);

            if (isset($_GET['CONFIRM']) AND intval($code_arr[1])==$pc_id) {
            
                include ("_save_pc.php");

            }

            unset($code_arr);
        
        }

    }

    include("_eq_form.php");

    $result_table="
    <FORM id='".$form_id."' action='?".$form_action."&equipment&q=".$iticket."&CONFIRM' name='conf' method='POST'>
    <table border=1 cellspacing=0 cellpadding=3>
        
    ".$list_txt."
    
    </table>
    </FORM>
    ";
    
} else {

    $list_txt="";

    if (isset($mf)){

        $where="id_obj='".$mf."' AND ";

    } elseif (isset($_GET['utype']) AND intval($_GET['utype'])>0 AND intval($_GET['utype'])<100){

        $utype=intval($_GET['utype']);
        
        $where="type_id='".$utype."' AND ";

    } else {

        $where="";

    }

$equip_q="SELECT _units.id_unit,_units.model,_units.MAC,_units.type_id,_units.reg_date,_units.un_life_time,_units.power,_units.memo,_type_units.name AS type,_type_units.life_time,_move_units.un_address,_move_units.dhcp_on,_move_units.ip_addr,_move_units.ip_ext,_move_units.installed,_move_units.tech,_move_units.info,_objects.id_obj,_objects.address,_objects.obj_installed,_objects.main_info,_objects.access_info,_providers.revName,_providers.techSupport FROM _units 
LEFT JOIN _type_units ON id_type=type_id
LEFT JOIN _move_units ON unitId=id_unit
LEFT JOIN _objects ON id_obj=_move_units.object_id
LEFT JOIN _providers ON _providers.prvId=_move_units.id_prv
WHERE ".$where."(_move_units.used_before>'".date("Y-m-d",time())."' AND _units.canceled>'".date("Y-m-d",time())."') 
ORDER BY address,type,un_address ASC";

#   echo $equip_q;

if ($equipment=dbQuery($equip_q,'mf')){

    while ($v = mysqli_fetch_array($equipment)) {

        if (!empty($v['MAC'])) {$mac_id=showMAC($v['MAC']);}
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

        if (!empty($v['ip_addr'])) {

            $ip[]=$v['ip_addr'];

        }

        if (!empty($v['ip_ext'])) {

            $ip[]=$v['ip_ext'];

        }

        if (isset($ip)){$ip_addr=implode(" // ",$ip);}
        else {$ip_addr="";}

        if (!empty($v['un_life_time']) AND !empty($v['reg_date'])) {

            $tmp_time_arr=explode("-",$v['reg_date']);

            $year_exp=$v['un_life_time'] + $tmp_time_arr[0];
            $month_exp=$tmp_time_arr[1];
            $date_exp=$tmp_time_arr[2];
    
            $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

        } elseif (!empty($v['life_time']) AND !empty($v['reg_date'])) {

            $tmp_time_arr=explode("-",$v['reg_date']);

            $year_exp=$v['life_time'] + $tmp_time_arr[0];
            $month_exp=$tmp_time_arr[1];
            $date_exp=$tmp_time_arr[2];
    
            $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

        } elseif (!empty($v['un_life_time']) AND !empty($v['installed'])) {

            $tmp_time_arr=explode("-",$v['installed']);

            $year_exp=$v['un_life_time'] + $tmp_time_arr[0];
            $month_exp=$tmp_time_arr[1];
            $date_exp=$tmp_time_arr[2];
    
            $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

        } elseif (!empty($v['life_time']) AND !empty($v['installed'])) {

            $tmp_time_arr=explode("-",$v['installed']);

            $year_exp=$v['life_time'] + $tmp_time_arr[0];
            $month_exp=$tmp_time_arr[1];
            $date_exp=$tmp_time_arr[2];
    
            $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

        } elseif (!empty($v['un_life_time'])) {

            $lifetime=" Срок эксплуатации до ".$v['un_life_time']." лет.";
    
        } elseif (!empty($v['life_time'])) {

            $lifetime=" Срок эксплуатации до ".$v['life_time']." лет.";
    
        } else {
        
            $lifetime=" Срок эксплуатации не известен или не ограничен.";
    
        }

        if (!empty($v['memo'])) {$info_all[]=$v['memo'];}
        if (!empty($v['info'])) {$info_all[]=$v['info'];}

        if (isset($info_all)){
        
            $info=implode(";\n",$info_all);
            unset($info_all);
        } else {$info="";}

        if ($v['tech']==1){

            $tc=" style='color:red;' alt='охранное оборудование' title='охранное оборудование'";

        } else {$tc="";}

        if (!empty($v['revName']) AND !isset($provider[$v['address']][$v['revName']])) {

            if (empty($v['techSupport'])){

                $provider[$v['address']][$v['revName']]="";

            } else {

                $provider[$v['address']][$v['revName']]="\n<i>".nl2br($v['techSupport'])."</i>";

            }

        } 


        
        $unite[$v['address']][]=$v['un_address']."</td><td".$tc."><a href='?utype=".$v['type_id'].$eq_url."'>".$v['type']."</a></td><td".$tc.">".$model."</td><td>".$mac_id."</td><td>".$ip_addr."</td><td>".rusDate($installed)."</td><td>".$lifetime."</td><td>".$info;
        
        $obj[$v['address']]=$v['id_obj'];

        unset($info);

        if (isset($count[$v['address']])) {
            $t_count=$count[$v['address']];
            $t_count++;
            $count[$v['address']]=$t_count;
        } else {$count[$v['address']]=1;}

        unset($model);
        unset($mac_id);
        unset($ip);
        unset($ip_addr);

    }  

}

if ((isset($_GET['utype']) AND intval($_GET['utype'])==5) OR !isset($_GET['utype'])) {

    if (isset($_GET['utype']) AND intval($_GET['utype'])==5) {$where="";}

    $pc_q="SELECT _units_pc.id_pc,_units_pc.model_pc,_units_pc.MAC1,_units_pc.MAC2,_units_pc.reg_date_pc,_units_pc.pc_life_time,_units_pc.power_pc,_units_pc.memo_pc,_type_units.name AS type,_type_units.life_time,_move_pc.un_address,_move_pc.dhcp_on,_move_pc.ip_addr,_move_pc.ip_ext,_move_pc.installed,_move_pc.tech,_move_pc.info,_objects.id_obj,_objects.address,_objects.obj_installed,_objects.main_info,_objects.access_info,_providers.revName,_providers.techSupport FROM _units_pc 
LEFT JOIN _move_pc ON pcId=id_pc
LEFT JOIN _type_units ON id_type=5
LEFT JOIN _objects ON id_obj=_move_pc.object_id
LEFT JOIN _providers ON _providers.prvId=_move_pc.id_prv
WHERE ".$where."(_move_pc.used_before>'".date("Y-m-d",time())."' AND _units_pc.canceled_pc>'".date("Y-m-d",time())."') 
ORDER BY address,type,un_address ASC";

#   echo $equip_q;

    if ($equip_pc=dbQuery($pc_q,'mf')){

        while ($v = mysqli_fetch_array($equip_pc)) {

            if (!empty($v['MAC1'])) {$mac[]=showMAC($v['MAC1']);}

            if (!empty($v['MAC2'])) {$mac[]=showMAC($v['MAC2']);}

            if (isset($mac)) {
        
                $mac_id=implode("; ",$mac);
                unset($mac);

            } else {
        
                $mac_id="";
        
            }

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

            if (!empty($v['ip_addr'])) {

                $ip[]=$v['ip_addr'];

            }

            if (!empty($v['ip_ext'])) {

                $ip[]=$v['ip_ext'];

            }

            if (isset($ip)){$ip_addr=implode(" // ",$ip);}
            else {$ip_addr="";}

            if (!empty($v['pc_life_time']) AND !empty($v['reg_date'])) {

                $tmp_time_arr=explode("-",$v['reg_date']);

                $year_exp=$v['pc_life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
    
                $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

            } elseif (!empty($v['life_time']) AND !empty($v['reg_date'])) {

                $tmp_time_arr=explode("-",$v['reg_date']);

                $year_exp=$v['life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
    
                $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

            } elseif (!empty($v['pc_life_time']) AND !empty($v['installed'])) {

                $tmp_time_arr=explode("-",$v['installed']);

                $year_exp=$v['pc_life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
    
                $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

            } elseif (!empty($v['life_time']) AND !empty($v['installed'])) {

                $tmp_time_arr=explode("-",$v['installed']);

                $year_exp=$v['life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
    
                $lifetime=" Срок эксплуатации до ".rusDate($year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2]);

            } elseif (!empty($v['pc_life_time'])) {

                $lifetime=" Срок эксплуатации до ".$v['pc_life_time']." лет.";
    
            } elseif (!empty($v['life_time'])) {

                $lifetime=" Срок эксплуатации до ".$v['life_time']." лет.";
    
            } else {
        
                $lifetime=" Срок эксплуатации не известен или не ограничен.";
    
            }

            if (!empty($v['memo'])) {$info_all[]=$v['memo'];}
            if (!empty($v['info'])) {$info_all[]=$v['info'];}

            if (isset($info_all)){
        
                $info=implode(";\n",$info_all);
                unset($info_all);

            } else {$info="";}

            if ($v['tech']==1){
                $tc=" style='color:red;' alt='охранное оборудование' title='охранное оборудование'";
            } else {$tc="";}

            if (!empty($v['revName']) AND !isset($provider[$v['address']][$v['revName']])) {

                if (empty($v['techSupport'])){

                    $provider[$v['address']][$v['revName']]="";

                } else {

                    $provider[$v['address']][$v['revName']]="\n<i>".nl2br($v['techSupport'])."</i>";

                }

            } 
       
            $unite[$v['address']][]=$v['un_address']."</td><td".$tc."><a href='?utype=5".$eq_url."'>".$v['type']."</a></td><td".$tc.">".$model."</td><td>".$mac_id."</td><td>".$ip_addr."</td><td>".rusDate($installed)."</td><td>".$lifetime."</td><td>".$info;

            $obj[$v['address']]=$v['id_obj'];

            unset($info);

            if (isset($count[$v['address']])) {
                
                $t_count=$count[$v['address']];
                $t_count++;
                $count[$v['address']]=$t_count;
            
            } else {$count[$v['address']]=1;}

            unset($model);
            unset($mac_id);
            unset($ip_addr);
            unset($ip);

        }

    }

}

if (isset($unite)) {

    reset($unite);

    $num=1;

    while (list($u,$un)=each($unite)){

        if (empty($c)) {$c=" bgcolor=lightblue";}
        else {$c="";}

        if (sizeof($un)>1){$rows=" rowspan=".sizeof($un);}
        else {$rows="";}

        if (isset($provider[$u])){
        
            while(list($isp_name,$tech_supp)=each($provider[$u])){

                $isp_arr[]="<b>".$isp_name."</b>".$tech_supp;

            }

            $isp=nl2br(implode("\n--\n",$isp_arr));

            unset($isp_arr);

        } else {

            $isp="";

        }

        $result[]="<tr".$c."><td".$rows.">".$num."</td><td".$rows."><a href=?mobj=".$obj[$u]."&q=".$iticket.">".$u."</a></td><td".$rows.">".$isp."</td><td>".implode("</td></tr>\n<tr".$c."><td>",$un)."</td></tr>";
        $num++;
        unset($obj_id);

        if (isset($mf)){$obj_addr="на ".$u." ";}

    }

    $list_txt=implode("\n",$result);

} else {

    $list_txt="";

}

$header="<div style='float:left;'>Список действующего оборудования ".$obj_addr."на ".date("d/m/Y H:i",time())."</div><div id='0' style='position:relative;top:-6px;'>&nbsp;<a href=?equipment&add&q=".$iticket." alt='добавить оборудование' title='добавить оборудование' style='text-decoration:none;font-size:14px;background-color:red;'>➕</a></div>";

$result_table="
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>№</th><th>Объект</th><th>Провайдер</th><th>Адрес установки</th><th>Тип оборудования</th><th>Модель</th><th>MAC-Адрес</th><th>IP</th><th>Установлено</th><th>Срок эксплуатации</th><th>Комментарий по оборудованию</th></tr>

".$list_txt."

</table>
";

}

?>