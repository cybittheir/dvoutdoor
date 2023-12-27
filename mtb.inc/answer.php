<?php

// делаем запрос в БД и выдаем ответ как json

$request_code=$_GET['getr'];

if (isset($request_code) AND mb_strlen($request_code)==18){
    
    include_once("_db.php");

    $tg_askQ="SELECT REQUEST, RTXT FROM tg_query WHERE REQUEST='".$request_code."'";

    $tg_askR=sql_query($tg_askQ);

    while($res=mysqli_fetch_array($tg_askR)){
        $tg_ask['REQUEST']=$res['REQUEST'];
        $tg_ask['RTXT']=$res['RTXT'];
    }
}

if (!isset($tg_ask) OR !is_array($tg_ask)){
    $tg_ask['REQUEST']=$request_code;
    $tg_ask['RTXT']='RTXT';
    $tg_ask['ERROR']='TRUE';
}

reset ($tg_ask);

$result=json_encode($tg_ask, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

# print_r($result);

print_r ($tg_ask['RTXT']);

?>