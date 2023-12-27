<?php

$menu="<p><b> ; </b>";

$menuList=array(
    "reserv"=>array(
        "query"=>"",
        "name"=>"Оборудование в резерве",
    ),
    "units"=>array(
        "query"=>"equipment",
        "name"=>"Полный список действующего оборудования",
    ),
    "service"=>array(
        "query"=>"service",
        "name"=>"История обслуживания и ремонта",
    ),

    "mess"=>array(
        "query"=>"messages",
        "name"=>"Последние 100 сообщений о работе экранов",
    ),

    "cancel"=>array(
        "query"=>"canceled",
        "name"=>"Список списанного оборудования",
    ),

    "sched"=>array(
        "query"=>"sched",
        "name"=>"Планировщик напоминаний",
    ),

    "payment"=>array(
        "query"=>"payment",
        "name"=>"Планировщик платежей",
    )

)

foreach ($menuList as $query => $value) {

    if (!empty($query)){

        $menuArr[]="<b><a href='?".$query."&q=".$iticket."'>".$value."</a></b>";

    } else {

        $menuArr[]="<b><a href='?q=".$iticket."'>".$value."</a></b>";

    }

}


if (isset($iticket) AND $_GET['q']==$iticket){

    if (isset($_GET['un']) AND intval($_GET['un'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_unit.php");

    } elseif (isset($_GET['editun']) AND intval($_GET['editun'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_equipment.php");

    } elseif (isset($_GET['editpc']) AND intval($_GET['editpc'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_equipment.php");

    } elseif (isset($_GET['pc']) AND intval($_GET['pc'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_pc.php");
    
    } elseif (isset($_GET['reservunit']) AND intval($_GET['reservunit'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_unit.php");
    
    } elseif (isset($_GET['reservpc']) AND intval($_GET['reservpc'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_pc.php");
    
    } elseif (isset($_GET['moveunit']) AND intval($_GET['moveunit'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_unit.php");
    
    } elseif (isset($_GET['servmf']) AND intval($_GET['servmf'])>0){

        $mf=intval($_GET['servmf']);

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_service.php");
    
    } elseif (isset($_GET['movepc']) AND intval($_GET['movepc'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_pc.php");
    
    } elseif (isset($_GET['md']) AND intval($_GET['md'])>0){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_media.php");
    
    } elseif (isset($_GET['canceled']) OR (isset($_GET['cancelpc']) AND intval($_GET['cancelpc'])>0)) {

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_cancel.php");
    
    } elseif (isset($_GET['canceled']) OR (isset($_GET['cancelunit']) AND intval($_GET['cancelunit'])>0)) {

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_cancel.php");
    
    } elseif (isset($_GET['objects'])){

        unset($menuArr['obj']);
        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_objects.php");
    
    } elseif (isset($_GET['service'])){

        unset($menuArr['service']);
        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_service.php");
    
    } elseif (isset($_GET['equipment'])){

        unset($menuArr['units']);
        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_equipment.php");
    
    } elseif (isset($_GET['mobj']) AND intval($_GET['mobj'])>0){

        $mf=intval($_GET['mobj']);

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_equipment.php");
    
    } elseif (isset($_GET['messages'])){

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_mess.php");
    
    } elseif (isset($_GET['sched'])){

        unset($menuArr['sched']);

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_scheduller.php");
    
    } elseif (isset($_GET['payment'])){

        unset($menuArr['payment']);

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_sched_payment.php");
    
    } elseif (isset($_GET['messmf']) AND intval($_GET['messmf'])>0){

        $mf=intval($_GET['messmf']);

        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_mess.php");
    
    } else {

        unset($menuArr['reserv']);
        $menu="<p>".implode("; ",$menuArr)."</p>";

        include ("_list.php");

    }

}

?>