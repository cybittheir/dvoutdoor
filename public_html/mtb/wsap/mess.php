<?php

$err_mess_q="SELECT * FROM mf_check WHERE 1 ORDER BY event_id DESC LIMIT 100";

if ($err_mess=dbQuery($err_mess_q,'mf')){

    while ($m = mysqli_fetch_array($err_mess)) {

        $err_date=explode(" ",$m['broke_time']);

        $err_mess[]="<td>".$v['broke_time']."</td><td><i>".$m['warning']."</i><br><a href='?messmf=".$m['media_id']."&q=".$iticket."'>показать выборку по экрану</a></td><td>".$m['repair_time']."</td><td>".$m['rec_time']."</td>";


    }

}

reset ($err_mess);

$list_txt=implode("</tr>\n",$all_mess)."</tr>";

$header="Последние 100 сообщений о работе экранов на ".date("d/m/Y H:i",time());

$result_table="
<table border=1 cellspacing=1 cellpadding=5>
<tr bgcolor=lightgrey><th>Время фиксации</th><th>Сообщение</th><th>Восстановлено</th><th>Время записи</th></tr>

".$list_txt."

</table>
";

?>