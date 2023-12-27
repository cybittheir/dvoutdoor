<?php

if (isset($mf)) {

    $where="id='".$mf."'";

} else {

    $where="1";
}

$services_q="SELECT serv_Fixes.rec_time,serv_Fixes.user_id,serv_Fixes.job,serv_Fixes.items,serv_Fixes.photo, 
_list.name,_list.id,
serv_Activites.active_description, 
serv_Items.job_name,
serv_Tasks.started,serv_Tasks.started_by,serv_Tasks.fixed,serv_Tasks.fixed_by
FROM `serv_Fixes` 
LEFT JOIN _list ON id=mf_id
LEFT JOIN serv_Activites ON serv_Activites.id_active=job_kind
LEFT JOIN serv_Items ON serv_Items.id_job=job_id
LEFT JOIN serv_Tasks ON serv_Tasks.task_id=serv_Fixes.task_id
LEFT JOIN serv_Counter on fix_id=id_fix
WHERE ".$where." 
ORDER BY rec_time DESC LIMIT 50";

if ($services=dbQuery($services_q,'mf')){

    while ($v = mysqli_fetch_array($services)) {

        $task="..";

        $job_date=explode(" ",$v['rec_time']);

        if(!empty($v['count']) AND intval($v['count'])>1){$counter=$v['count'];}
        elseif(!empty($v['items']) AND intval($v['items'])>1){$counter=$v['items'];}
        else {$counter=1;}

        $jobs[$job_date[0]][$v['name']][]="<td><i>".$v['job']."</i></td><td align=center>".$counter."</td><td>".$task."</td>";

        $addr_url[$v['name']]="<a href='?servmf=".$v['id']."&q=".$iticket."'>".$v['name']."</a>";

    }

}

reset ($jobs);
krsort($jobs);


while(list($jd,$jarr)=each($jobs)){

    reset ($jarr);

    krsort($jarr);

    $job_rows=0;
    $date_rows=0;

    if (!isset($bgcolor) OR empty($bgcolor)){
        
        $bgcolor=" bgcolor=lightblue";

    } else {

        $bgcolor="";

    }
    
    while(list($j_addr,$job)=each($jarr)){

        $job_rows+=sizeof($job);

        if (sizeof($job)>1){

            $jobs_list[]="<td rowspan=".sizeof($job)." valign=top>".$addr_url[$j_addr]."</td>".implode("</tr>\n<tr".$bgcolor.">",$job);

        } else {

            $jobs_list[]="<td align=top>".$addr_url[$j_addr]."</td>".implode("</tr>\n<tr".$bgcolor.">",$job);

        }
    
    }

    unset($job);
    $jdate=rusDate($jd);

    if (sizeof($jarr)>1 AND $job_rows<sizeof($jarr)){

        $all_jobs[]="<tr".$bgcolor."><td rowspan=".sizeof($jarr)." valign=top><b>".$jdate."</b></td>".implode("</tr>\n<tr".$bgcolor.">",$jobs_list);

    } elseif ($job_rows>1) {

        $all_jobs[]="<tr".$bgcolor."><td rowspan=".$job_rows." valign=top><b>".$jdate."</b></td>".implode("</tr>\n<tr".$bgcolor.">",$jobs_list);

    } else {

        $all_jobs[]="<tr".$bgcolor."><td valign=top><b>".$jdate."</b></td>".implode("</tr>\n<tr".$bgcolor.">",$jobs_list);

    }

    unset($jobs_list);

}

$list_txt=implode("</tr>\n",$all_jobs)."</tr>";

$header="История обслуживания и ремонта оборудования на ".date("d/m/Y H:i",time());

$result_table="
<table border=1 cellspacing=1 cellpadding=5>
<tr bgcolor=lightgrey><th>Дата</th><th>Экран</th><th>Работа</th><th>Кол-во</th><th>Дополнительно</th></tr>

".$list_txt."

</table>
";


?>