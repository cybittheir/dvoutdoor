<?php

$list_txt="";

if (isset($iticket) AND $_GET['q']==$iticket){

    $to_day=date("Y-m-d",time());

    $objects_q="SELECT _objects.*,_owners.owner_name,_list.name,_list.cityscreen_id FROM `_objects` 
    LEFT JOIN _links ON _links.object_lnk=id_obj
    LEFT JOIN _list ON id=_links.media_lnk
    LEFT JOIN _owners ON _owners.id_owner=_objects.owner
    WHERE _list.used_before>'".$to_day."' AND _list.not_control IS NULL AND _list.hide IS NULL AND _objects.obj_used_before>'".$to_day."'
    ORDER BY _objects.address ASC";
    
    #    echo $reserves_q;
    
    if ($objects=dbQuery($objects_q,'mf')){
        
        while ($v = mysqli_fetch_array($objects)) {

        }
    }

}

echo "
<h2>Список объектов на ".date("d/m/Y H:i",time())."</h2>
".$menu."
<table border=1 cellspacing=0 cellpadding=3>
<tr bgcolor=lightgrey><th>№ п/п</th><th>Адрес</th><th>Собственник</th><th>Дата запуска</th><th>Координаты</th><th>Точка подключения</th><th>Доступ</th><th>Дополнения</th><th>Экран</th><th>CityScreenID</th></tr>

".$list_txt."

</table>
".$menu;

?>