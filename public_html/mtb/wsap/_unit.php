<?php

$result_mess="";

if (isset($iticket) AND $_GET['q']==$iticket){

    if (isset($_GET['un']) AND intval($_GET['un'])>0) {

        $unit_id=intval($_GET['un']);
    
    } elseif (isset($_GET['cancelunit']) AND intval($_GET['cancelunit'])>0) {

        $unit_id=intval($_GET['cancelunit']);

        if (isset($_POST['code']) AND $_POST['code']=="ID".$unit_id AND isset($_GET['CONFIRM'])) {

            $fix_cancel_q="UPDATE _units SET canceled='".date("Y-m-d",time())."', cancel_reason='".strip_tags($_POST['reason'])."' WHERE id_unit=".$unit_id;

            $fix_cancel=dbQuery($fix_cancel_q,'mf');

        }
        
    } elseif (isset($_GET['reservunit']) AND intval($_GET['reservunit'])>0) {

        $unit_id=intval($_GET['reservunit']);

        if (isset($_POST['code']) AND $_POST['code']=="ID".$unit_id AND isset($_GET['CONFIRM'])) {

            $fix_use_q="UPDATE _move_units SET used_before='".date("Y-m-d",time())."' WHERE unitId=".$unit_id." AND used_before='9999-12-31'";

            if ($fix_use=dbQuery($fix_use_q,'mf')){

                $fix_reserv_q="INSERT INTO _move_units (unitId,object_id,installed,used_before) VALUES ($unit_id,1,'".date("Y-m-d",time())."','2000-01-01')";

                $fix_reserv=dbQuery($fix_reserv_q,'mf');

            }

        }
        
    } elseif (isset($_GET['moveunit']) AND intval($_GET['moveunit'])>0) {

        $unit_id=intval($_GET['moveunit']);

        if (isset($_POST['code']) AND $_POST['code']=="ID".$unit_id AND isset($_GET['edit']) AND isset($_GET['CONFIRM']) AND isset($_POST['object']) AND intval($_POST['object'])>0) {

            if (!empty($_POST['isp'])) {

                $set_rec[]="id_prv='".$_POST['isp']."'";

            } else {

                $set_rec[]="id_prv=NULL";

            }

            if (!empty($_POST['ipaddr'])) {
                
                $set_rec[]="ip_addr='".$_POST['ipaddr']."'";
            
            } else {

                $set_rec[]="NULL";

            }

            if (!empty($_POST['ipext'])) {
                
                $set_rec[]="ip_ext='".$_POST['ipext']."'";

            } else {

                $set_rec[]="ip_ext=NULL";

            }

            if (!empty($_POST['info'])) {

                $read_q="SELECT *
                    FROM _move_units
                    WHERE unitId=".$unit_id." AND object_id='".intval($_POST['object'])."' AND used_before='9999-12-31'";

                if ($unitInfo=dbQuery($read_q,'mf')){
       
                    while ($v_i = mysqli_fetch_array($unitInfo)) {

                        if (!empty($v_i['info'])) {$info=$v_i['info'];}
                        else {$info="";}

                    }

                } else {$info="";}
                
                $set_rec[]="info='".date("d/m/Y H:i",time()).": ".strip_tags($_POST['info'])."'\n".$info;
            
            }

            if (isset($set_rec)) {$set_params=implode(", ",$set_rec);}

            $fix_move_q="UPDATE _move_units SET ".$set_params." WHERE unitId=".$unit_id." AND object_id='".intval($_POST['object'])."' AND used_before='9999-12-31'";

            if ($fix_move=dbQuery($fix_move_q,'mf')){

                $result_mess="<font color=darkgreen>Новые данные записаны</font>";

            } else {

                echo $fix_move_q;

            }

        } elseif (isset($_POST['code']) AND $_POST['code']=="ID".$unit_id AND isset($_GET['CONFIRM']) AND isset($_POST['obj']) AND intval($_POST['obj'])>0) {

            $fix_reserv_q="UPDATE _move_units SET used_before='".date("Y-m-d",time())."' WHERE unitId=".$unit_id." AND used_before='2000-01-01'";

            $obj_id=intval($_POST['obj']);

            if ($fix_reserv=dbQuery($fix_reserv_q,'mf')){

                $fix_move_q="INSERT INTO _move_units (unitId,object_id,installed,used_before) VALUES (".$unit_id.",".$obj_id.",'".date("Y-m-d",time())."','9999-12-31')";

                $fix_move=dbQuery($fix_move_q,'mf');

            }

        }
        
    } else {

        $unit_id=0;

    }

    $formAction="";
    $result_mess="";

    $unitHistory_q="SELECT _move_units.id_move,
    _units.model,
    _units.MAC,
    _units.power,
    _units.memo,
    _units.reg_date,
    _type_units.name AS type,
    _move_units.installed,
    _move_units.used_before,
    _objects.id_obj,
    _objects.address AS address,
    _objects.obj_installed,
    _units.un_life_time,
    _move_units.id_prv,
    _providers.revName,
    _type_units.life_time,
    _move_units.info,
    _move_units.ip_addr,
    _move_units.ip_ext,
    _units.canceled
        FROM _units 
        LEFT JOIN _type_units ON id_type=type_id 
        LEFT JOIN _move_units ON unitId=id_unit 
        LEFT JOIN _objects ON _objects.id_obj=_move_units.object_id 
        LEFT JOIN _providers ON _providers.prvId=_move_units.id_prv
    WHERE id_unit=".$unit_id." ORDER BY installed DESC,id_move DESC";
    
    #    echo $unitHistory_q;
    
    if ($unitHistory=dbQuery($unitHistory_q,'mf')){
    
    #        $_arr = mysqli_fetch_array($reserves);
    
        while ($v = mysqli_fetch_array($unitHistory)) {
    
            if (!empty($v['MAC'])) {$mac_id=showMAC($v['MAC']);}
            else {$mac_id="??";}
    
            $mediaURL="'?mobj=".$v['id_obj']."&q=".$iticket."'";
    
            if (!empty($v['model'])) {$model=$v['model'];}
            else {$model="?noname?";}
    
            if (!empty($v['memo'])) {$memo=nl2br($v['memo']);}
            else {$memo="";}
    
            if (!empty($v['power'])) {$power="; <b>Питание:</b> ".$v['power'];}
            else {$power="";}
    
            if (!empty($v['type'])) {$type=$v['type'];}
            else {$type="?type?";}

            if (!empty($v['address']) AND $v['used_before']!="2000-01-01" AND !isset($_GET['edit'])) {

                $address="<a href=".$mediaURL.">".$v['address']."</a>";

                if (isset($_GET['reservunit'])){

                    $action="<FORM
                    id='conf_cancel' action='?reservunit=".$unit_id."&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                    <input type=text name='code' value='".@$_POST['code']."' size=5>
                    <input type='submit' value='Подтвердить резерв'>
                    </FORM>";

                } else {

                    $action="&nbsp;<a href='?moveunit=".$unit_id."&edit&q=".$iticket."' alt='изменить данные настроек' title='изменить данные настроек' style='text-decoration:none;font-size:14px;background-color:white;'>🖋️</a> | <a href='?reservunit=".$unit_id."&q=".$iticket."'>в резерв</a>";

                }

            } elseif(isset($_GET['un']) OR isset($_GET['reservunit'])) {

                $address="<a href='?q=".$iticket."'>РЕЗЕРВ</a>";

                $action="<a href='?moveunit=".$unit_id."&q=".$iticket."'>на экран</a> | <a href=?cancelunit=".$unit_id."&q=".$iticket.">списать</a>";

            } elseif(isset($_GET['moveunit']) AND isset($_GET['edit'])) {

                $address=$v['address'];

                $ISPselection=getISPForm($v['id_prv']);

                $formAction="<FORM
                id='conf_edit' action='?moveunit=".$unit_id."&edit&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                <input type=hidden name='object' value='".@$v['id_obj']."'>";

                $action="<input type=text name='code' value='".@$_POST['code']."' size=5>
                <input type='submit' value='Сохранить'>
                </FORM>";
                
            } elseif(isset($_GET['moveunit'])) {

                $address="<a href='?q=".$iticket."'>РЕЗЕРВ</a>";

                $objects_q="SELECT id_obj,address FROM _objects WHERE obj_used_before>'".date("Y-m-d",time())."'";

#                echo $objects_q;
                
                $objects_list=dbQuery($objects_q,'mf');
    
                while ($s = mysqli_fetch_array($objects_list)) {

                    $selection[]="<option value='".$s['id_obj']."'>".$s['address']."</option>";

                }

                reset($selection);

                $action="<FORM
                id='conf_cancel' action='?moveunit=".$unit_id."&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                <select name=obj>
                ".implode("\n",$selection)."
                </select>
                <input type=text name='code' value='".@$_POST['code']."' size=5>
                <input type='submit' value='Переместить'>
                </FORM>";

            } elseif(isset($_GET['cancelunit'])) {

                $address="<a href='?q=".$iticket."'>РЕЗЕРВ</a>";
                $action="<FORM
                id='conf_cancel' action='?cancelunit=".$unit_id."&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                <input type=text name='reason' value='' placeholder='коротко укажите причину списания' size=80>
                <input type=text name='code' value='".@$_POST['code']."' size=5>
                <input type='submit' value='Подтвердить списание'>
                </FORM>";

            } else {

                $address="?";

                $action="?";

            }

            if(!empty($v['revName'])){$isp=$v['revName'];}
            else {$isp="-";}

            if(!empty($v['ip_addr'])){$ip_addr=$v['ip_addr'];}
            else {$ip_addr="-";}

            if(!empty($v['ip_ext'])){$ip_ext=$v['ip_ext'];}
            else {$ip_ext="-";}

            if (!empty($v['reg_date'])){$reg_date=$v['reg_date'];}
            else {$reg_date="нет отметки";}

            if (!empty($v['used_before']) AND $v['used_before']!='9999-12-31' AND $v['used_before']!='2000-01-01') {
                
                $used_before=$v['used_before'];
                $action="";
            
            } else {
                
                $used_before=" - ";
            
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
    
            if (!empty($v['installed'])){
                $installed=$v['installed'];
            } else if (!empty($v['reg_date'])) {
                $installed="<i>".$v['reg_date']."</i>";
            } else if (!empty($v['obj_installed'])) {
                $installed="<u>".$v['obj_installed']."</u>";
            } else {
                $installed="?";
            }

            if (!empty($v['info'])) {$info=$v['info']."<br>\n";}
            else {$info="";}

            if ($v['canceled']<date("Y-m-d",time()+3600*24) AND !isset($is_canceled)) {

                $step[0][]=$v['canceled']."</td><td><a href='?canceled&q=".$iticket."'>?СПИСАНО</a></td><td>-</td><td>-</td><td>";  
                $action=""; 

                if (isset($count[$v['id_move']])) {
                    $t_count=$count[$v['id_move']];
                    $t_count++;
                    $count[$v['id_move']]=$t_count;
                } else {$count[$v['id_move']]=1;}

                $is_canceled=1;
    
            }

            if (isset($is_canceled)) {$action="";}

            if (isset($_GET['edit']) AND (empty($used_before) OR trim($used_before)=="-")){

                if (trim($ip_addr=="-")) {$ip_addr="";}
                if (trim($ip_ext=="-")) {$ip_ext="";}

                $step[$v['id_move']][]=$installed.$formAction."</td><td>".$address."</td><td>".$ISPselection."</td><td><input name=ipaddr type=text size=10 value='".$ip_addr."'></td><td><input name=ipext type=text size=10 value='".$ip_ext."'></td><td>".$used_before."</td><td>".$info."<textarea name=info type=text rows=3></textarea></td><td>".$action;

            } else {

                $step[$v['id_move']][]=$installed."</td><td>".$address."</td><td>".$isp."</td><td>".$ip_addr."</td><td>".$ip_ext."</td><td>".$used_before."</td><td>".$info."</td><td>".$action;

            }
    
            if (isset($count[$v['id_move']])) {
                $t_count=$count[$v['id_move']];
                $t_count++;
                $count[$v['id_move']]=$t_count;
            } else {$count[$v['id_move']]=1;}
        
        }  
    
        reset($step);

    }

    /////

    while (list($u,$st)=each($step)){

        $result[]="<tr><td>".implode("</td></tr>\n<tr><td>",$st)."</td></tr>";

    }

    $list_txt=implode("\n",$result);

    $header="<div style='float:left;'>История оборудования на ".date("d/m/Y H:i",time())."</div><div id='0' style='position:relative;top:-6px;'>&nbsp;<a href=?editun=".$unit_id."&q=".$iticket." alt='изменить данные оборудования' title='изменить данные оборудования' style='text-decoration:none;font-size:14px;background-color:white;'>🖋️</a></div>";

    $result_text="
<b>".$type.":</b> '".$model."'; <b>MAC:</b> ".$mac_id.$power."; <b>ID</b>".$unit_id."<br>
<b>Доп.:</b> <i>".$memo."</i><br>
<b>Регистрация в базе:</b> <i>".$reg_date."</i><br>
<i>".$lifetime."</i><br>";

$result_table="
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>С даты</th><th>Адрес</th><th>ISP</th><th>IP</th><th>IP внеш.</th><th>По дату</th><th>Примечание</th><th>Действия</th></tr>
".$list_txt."

</table>
".$result_mess;

}

?>