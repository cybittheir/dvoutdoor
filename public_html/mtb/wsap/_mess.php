<?php

if (isset($mf)) {

    $where="mf_check.media_id='".$mf."'";

} else {

    $where="1";
}

$name="экранов";

$err_mess_q="SELECT mf_check.*,_list.object_id,_list.name,_uplink.uptime,_uplink.pc_id,_uplink.uptime_max FROM mf_check 
LEFT JOIN _list ON id=media_id
LEFT JOIN _uplink ON _uplink.media_id=mf_check.media_id
WHERE ".$where." 
ORDER BY event_id DESC LIMIT 100";

# echo $err_mess_q;

if ($err_messages=dbQuery($err_mess_q,'mf')){

    while ($m = mysqli_fetch_array($err_messages)) {

        $duration="<font color=red><b>ACTUAL!</b></font>";

        if (!empty($m['repair_time'])){

            $err_arr=explode(" ",$m['broke_time']);
            $err_date=explode("-",$err_arr[0]);
            $err_time=explode(":",$err_arr[1]);

            $rep_arr=explode(" ",$m['repair_time']);
            $rep_date=explode("-",$rep_arr[0]);
            $rep_time=explode(":",$rep_arr[1]);

            $rep_cod=mktime($rep_time[0],$rep_time[1],$rep_time[2],$rep_date[1],$rep_date[2],$rep_date[0]);
            $err_cod=mktime($err_time[0],$err_time[1],$err_time[2],$err_date[1],$err_date[2],$err_date[0]);

            $duration_all=$rep_cod-$err_cod;
            $duration_hour=floor($duration_all/3600);
            $duration_min=floor(($duration_all%3600)/60);

            if ($duration_hour>1){

                $duration="<font color=red><u>".$duration_hour." ч ".$duration_min." мин</u></font>";

            } elseif ($duration_hour>0){

                $duration=$duration_hour." ч ".$duration_min." мин";

            } else {

                $duration=$duration_min." мин";

            }

        }

        $warn_mess_arr=explode("esk:",$m['warning']);

        $warning_mess=str_replace("AnyD","",$warn_mess_arr[0]);
        $warning_mess=str_replace("anyd","",$warning_mess);
        $warning_mess=str_replace("===","",$warning_mess);

        unset($warn_mess_arr);

        if ($obj_id=getObj($m['media_id'])) {
        
            $obj_link="<a href='?mobj=".$obj_id."&q=".$iticket."'>**</a>";
        
        } else {
            
            $obj_link="";
        
        }

        if ($pc_id=getPC($m['media_id'])) {
        
            $pc_link="<a href='?pc=".$pc_id."&q=".$iticket."'>*</a> (";
        
        } else {
            
            $pc_link="(";
        
        }

        $sel_link=$obj_link.") </i> ".getAnyDeskLink($m['pc_id'])." [<a href='?messmf=".$m['media_id']."&q=".$iticket."'>выбрать</a>]:<i>";

        $warning_mess=str_replace("):",$sel_link,$warning_mess);

        $warning_mess=str_replace(" (","(",$warning_mess);

        $warning_mess=str_replace("(",$pc_link,$warning_mess);

        if(intval($m['warn_uptime'])>0) {
            $warn_uptime=getUpTime($m['warn_uptime']);
        } else {
            $warn_uptime="no record";
#            $warn_uptime=getUpTime($m['uptime']);
        }

        $err_mess[]="<td>".rusDateTime($m['broke_time'],1)."</td><td><i>".nl2br(trim($warning_mess))."</i></td><td>".rusDateTime($m['repair_time'],1)."</td><td>".$duration."</td><td>".rusDateTime($m['rec_time'],1)."</td><td>".$warn_uptime."</td><td>".getUpTime($m['uptime_max'])."</td>";

        unset($warning_mess);
        unset($sel_link);

        if (isset($mf) AND !empty($name)){$name="'<a href='?mobj=".$m['object_id']."&q=".$iticket."'>".$m['name']."</a>'";}

    }

}

if (isset($err_mess)) {
    
    reset ($err_mess);

    $list_txt=implode("</tr>\n",$err_mess)."</tr>";
        
} else {

    $list_txt="";
    
}

$header="Последние 100 сообщений о работе ".$name." на ".date("d/m/Y H:i",time());

$result_table="

<table border=1 cellspacing=1 cellpadding=5>
<tr bgcolor=lightgrey><th>Время фиксации</th><th>Сообщение</th><th>Восстановлено</th><th>Длительность сбоя</th><th>Время записи</th><th>UpTime</th><th>UpTime(max)</th></tr>

".$list_txt."

</table>
";

?>