<?php

$result_mess="";

if (isset($iticket) AND $_GET['q']==$iticket){

    if (isset($_GET['pc']) AND intval($_GET['pc'])>0) {

        $pc_id=intval($_GET['pc']);

    } elseif(isset($_GET['cancelpc']) AND intval($_GET['cancelpc'])>0) {

        $pc_id=intval($_GET['cancelpc']);

        if (isset($_POST['code']) AND $_POST['code']=="ID".$pc_id AND isset($_GET['CONFIRM'])) {

            $fix_cancel_q="UPDATE _units_pc SET canceled_pc='".date("Y-m-d",time())."', cancel_reason_pc='".strip_tags($_POST['reason'])."' WHERE id_pc=".$pc_id;

            if ($fix_cancel=dbQuery($fix_cancel_q,'mf')) {

                $del_link_q="DELETE FROM _uplink WHERE pc_id=".$pc_id;

                $del_link=dbQuery($del_link_q,'mf');

            }


        }

    } elseif (isset($_GET['reservpc']) AND intval($_GET['reservpc'])>0) {

        $pc_id=intval($_GET['reservpc']);

        if (isset($_POST['code']) AND $_POST['code']=="ID".$pc_id AND isset($_GET['CONFIRM'])) {

            $fix_use_q="UPDATE _move_pc SET used_before='".date("Y-m-d",time())."' WHERE pcId=".$pc_id." AND used_before='9999-12-31'";

            if ($fix_use=dbQuery($fix_use_q,'mf')){

                $fix_reserv_q="INSERT INTO _move_pc (pcId,object_id,installed,used_before) VALUES ($pc_id,1,'".date("Y-m-d",time())."','2000-01-01')";

                $fix_reserv=dbQuery($fix_reserv_q,'mf');

            }


        }

    } elseif (isset($_GET['movepc']) AND intval($_GET['movepc'])>0) {

        $pc_id=intval($_GET['movepc']);

#        echo "#A \n";

        if (isset($_POST['code']) AND $_POST['code']=="ID".$pc_id AND isset($_GET['edit']) AND isset($_GET['CONFIRM']) AND isset($_POST['object']) AND intval($_POST['object'])>0) {

#            echo "#B \n";

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

                $info="";

                $read_q="SELECT *
                    FROM _move_pc
                    WHERE unitId=".$pc_id." AND object_id='".intval($_POST['object'])."' AND used_before='9999-12-31'";

                if ($unitInfo=dbQuery($read_q,'mf')){
       
                    while ($v_i = mysqli_fetch_array($unitInfo)) {

                        if (!empty($v_i['info'])) {$info=$v_i['info'];}
                
                    }

                }
                
                $set_rec[]="info='".date("d/m/Y H:i",time()).": ".strip_tags($_POST['info'])."'\n".$info;
            
            }

            if (isset($set_rec)) {$set_params=implode(", ",$set_rec);}

            $fix_move_q="UPDATE _move_pc SET ".$set_params." WHERE pcId=".$pc_id." AND object_id='".intval($_POST['object'])."' AND used_before='9999-12-31'";

#            echo $fix_move_q;

            if ($fix_move=dbQuery($fix_move_q,'mf')){

                $result_mess="<font color=darkgreen>Новые данные записаны</font>";

            } else {

#                echo $fix_move_q;

            }

        } else {

            if (isset($_POST['code']) AND $_POST['code']=="ID".$pc_id AND isset($_GET['CONFIRM']) AND (isset($_POST['obj']) AND intval($_POST['obj'])>0)) {
    
                $new_object=intval($_POST['obj']);
    
                $fix_use_q="UPDATE _move_pc SET used_before='".date("Y-m-d",time())."' WHERE pcId=".$pc_id." AND object_id=1 AND used_before='2000-01-01'";
    
                if ($fix_use=dbQuery($fix_use_q,'mf')){
    
                    $fix_reserv_q="INSERT INTO _move_pc (pcId,object_id,installed) VALUES ($pc_id,$new_object,'".date("Y-m-d",time())."')";
    
                    $fix_reserv=dbQuery($fix_reserv_q,'mf');
    
                }
    
    
            }
        
        }

    } else {

        $pc_id=0;

    }

    $formAction="";

    $pcHistory_q="SELECT _move_pc.id_move,
    _type_units.name AS type,
    _units_pc.id_pc,
    _units_pc.model_pc,
    _units_pc.MAC1,
    _units_pc.MAC2,
    _units_pc.anydesk,
    _units_pc.power_pc,
    _units_pc.memo_pc,
    _units_pc.reg_date_pc,
    _move_pc.object_id,
    _move_pc.installed,
    _move_pc.used_before,
    _units_pc.pc_life_time,
    _type_units.life_time,
    _providers.revName,
    _move_pc.id_prv,
    _move_pc.ip_ext,
    _move_pc.ip_addr,
    _units_pc.canceled_pc,
    _list.id,
    _list.name AS address,
    _move_pc.info 
    FROM _units_pc  
        LEFT JOIN _type_units ON id_type=5
        LEFT JOIN _move_pc ON pcId=id_pc
        LEFT JOIN _links ON _links.pc_lnk=id_pc
        LEFT JOIN _list ON _list.id=media_lnk
        LEFT JOIN _providers ON _providers.prvId=id_prv
    WHERE id_pc=".$pc_id." ORDER BY installed DESC,id_move DESC";
    
#        echo $pcHistory_q;
    
    if ($pcHistory=dbQuery($pcHistory_q,'mf')){
    
        while ($v = mysqli_fetch_array($pcHistory)) {
    
            if (!empty($v['MAC1'])) {$mac[]=showMAC($v['MAC1']);}
                
            if (!empty($v['MAC2'])) {$mac[]=showMAC($v['MAC2']);}

            if (isset($mac)){$mac_id=implode("; ",$mac).";";}
            else {$mac_id="";}
                
            $mediaURL="'?md=".$v['id']."&q=".$iticket."'";
    
            if (!empty($v['model_pc'])) {$model=$v['model_pc'];}
            else {$model="?noname?";}

            if (!empty($v['memo_pc'])) {$memo=nl2br($v['memo_pc']);}
            else {$memo="-";}

            if (!empty($v['power_pc'])) {$power=" <b>Питание:</b> ".$v['power_pc'].";";}
            else {$power="";}

            if (!empty($v['id_prv'])) {$power=" <b>Питание:</b> ".$v['power_pc'].";";}
            else {$power="";}

            if (!empty($v['anydesk'])) {$anydesk=" <a href=anydesk:".$v['anydesk']."><b>Anydesk</b></a>;<br>";}
            else {$anydesk="";}

            $pc_id=$v['id_pc'];
    
            if (!empty($v['type'])) {$type=$v['type'];}
            else {$type="?type?";}

            if (!empty($v['address']) AND $v['used_before']!="2000-01-01" AND !isset($_GET['edit'])) {
                
                $address="<a href=".$mediaURL.">".$v['address']."</a>";

                if (isset($_GET['reservpc'])){

                    $action="<FORM
                    id='conf_cancel' action='?reservpc=".$pc_id."&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                    <input type=text name='code' value='".@$_POST['code']."' size=5>
                    <input type='submit' value='Подтвердить резерв'>
                    </FORM>";

                } else {

                    $action="&nbsp;<a href='?movepc=".$pc_id."&q=".$iticket."&edit' alt='изменить данные настроек' title='изменить данные настроек' style='text-decoration:none;font-size:14px;background-color:white;'>🖋️</a> | <a href='?reservpc=".$pc_id."&q=".$iticket."'>в резерв</a>";
                
                }

            } elseif(isset($_GET['pc']) OR isset($_GET['reservpc'])) {
                
                $address="<a href='?q=".$iticket."'>РЕЗЕРВ</a>";
                $action="<a href='?movepc=".$pc_id."&q=".$iticket."'>на экран</a> | <a href=?cancelpc=".$pc_id."&q=".$iticket.">списать</a>";
            
            } elseif(isset($_GET['cancelpc'])) {

                $address="<a href='?q=".$iticket."'>РЕЗЕРВ</a>";
                $action="<FORM
                id='conf_cancel' action='?cancelpc=".intval($_GET['cancelpc'])."&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                <input type=text name='reason' value='' placeholder='коротко укажите причину списания' size=80>
                <input type=text name='code' value='".@$_POST['code']."' size=5>
                <input type='submit' value='Подтвердить списание'>
                </FORM>";

            } elseif(isset($_GET['movepc']) AND isset($_GET['edit'])) {

                $address=$v['address'];

                $ISPselection=getISPForm($v['id_prv']);

                $formAction="<FORM
                id='conf_edit' action='?movepc=".$pc_id."&edit&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                <input type=hidden name='object' value='".$v['object_id']."'>";

                $action="<input type=text name='code' value='".@$_POST['code']."' size=5>
                <input type='submit' value='Сохранить'>
                </FORM>";
                
            } elseif(isset($_GET['movepc'])) {

                $address="<a href='?q=".$iticket."'>РЕЗЕРВ</a>";

                $selection=getObjectForm();

                $action="<FORM
                id='conf_cancel' action='?movepc=".$pc_id."&q=".$iticket."&CONFIRM' name='conf' method='POST'>
                ".$selection."
                <input type=text name='code' value='".@$_POST['code']."' size=5>
                <input type='submit' value='Переместить'>
                </FORM>";
                
            } else {

                $address="?";
                $action="?";

            }

            if (!empty($v['reg_date_pc'])){$reg_date=$v['reg_date_pc'];}
            else {$reg_date="нет отметки";}

            if (!empty($v['used_before']) AND $v['used_before']!='9999-12-31' AND $v['used_before']!='2000-01-01') {
                
                $used_before=$v['used_before'];
                $action=" ";
            
            } else {
                
                $used_before=" - ";
            
            }
    
            if (!empty($v['life_time']) AND !empty($v['reg_date_pc'])) {
    
                $tmp_time_arr=explode("-",$v['reg_date_pc']);
    
                $year_exp=$v['life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];

                $installed=$v['reg_date_pc'];
        
                $lifetime=" <b>Срок эксплуатации до</b> ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];
    
            } elseif (!empty($v['life_time']) AND !empty($v['installed'])) {
    
                $tmp_time_arr=explode("-",$v['installed']);
    
                $year_exp=$v['life_time'] + $tmp_time_arr[0];
                $month_exp=$tmp_time_arr[1];
                $date_exp=$tmp_time_arr[2];
        
                $installed=$v['installed'];

                $lifetime=" <b>Срок эксплуатации до</b> ".$year_exp."-".$tmp_time_arr[1]."-".$tmp_time_arr[2];
    
            } elseif (!empty($v['life_time'])) {
    
                $lifetime=" <b>Срок эксплуатации до</b> ".$v['life_time']." лет.";
        
                $installed="-";

            } else {
            
                $lifetime=" <b>Срок эксплуатации</b> не известен или не ограничен.";
        
                $installed="?";

            }

            if(!empty($v['revName'])){$isp=$v['revName'];}
            else {$isp="-";}

            if(!empty($v['ip_addr'])){$ip_addr=$v['ip_addr'];}
            else {$ip_addr="-";}

            if(!empty($v['ip_ext'])){$ip_ext=$v['ip_ext'];}
            else {$ip_ext="-";}

            if (!empty($v['installed'])){$installed=$v['installed'];}
    
            if (!empty($v['info'])) {$info=$v['info']."<br>\n";}
            else {$info="";}
    
            if ($v['canceled_pc']<date("Y-m-d",time()+3600*24) AND !isset($is_canceled)) {

                $step[0][]=$v['canceled_pc']."</td><td><a href='?canceled&q=".$iticket."'>СПИСАНО</a></td><td>-</td><td>-</td><td>";  
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
    $num=1;
    while (list($u,$st)=each($step)){

        $result[]="<tr><td>".$num."</td><td>".implode("</td></tr>\n<tr><td>",$st)."</td></tr>";
        $num++;

    }

    $list_txt=implode("\n",$result);

    if(isset($is_canceled)) {$lifetime="Устройство списано.";}

    $header="<div style='float:left;'>История оборудования на ".date("d/m/Y H:i",time())."</div><div id='0' style='position:relative;top:-6px;'>&nbsp;<a href=?editpc=".$pc_id."&q=".$iticket." alt='изменить данные компьютера' title='изменить данные компьютера' style='text-decoration:none;font-size:14px;background-color:white;'>🖋️</a></div>";

    $result_text="
<b>".$type.":</b> '".$model."'; <b>MAC:</b> ".$mac_id.$power." <b>ID</b>".$pc_id.";<br>
<b>Доп.:</b> <i>".$memo."</i><br>
".$anydesk."
<b>Регистрация в базе:</b> <i>".$reg_date."</i><br>
<i>".$lifetime."</i><br>";

$result_table="
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>№</th><th>С даты</th><th>Адрес</th><th>ISP</th><th>IP</th><th>IP внеш.</th><th>По дату</th><th>Примечание</th><th>Действия</th></tr>
".$list_txt."

</table>
".$result_mess;
    
}

?>