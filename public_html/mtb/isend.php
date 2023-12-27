<?php

//@labmedia_alarm_bot
// sending MSG as bot-proxy

date_default_timezone_set('Asia/Vladivostok');

header('Content-Type: text/html; charset=utf-8'); // кодировка UTF-8
mb_internal_encoding("UTF-8");

if ($_SERVER['HTTP_HOST']=="botapi.dvoutdoor.ru"){
    
    $inc_path="../../mtb.inc/";

    require_once ($inc_path."bErrSet.php"); // подключаем файл для отображения ошибок

    $tgConf=require_once $inc_path."bConfig.php"; // конфиг бота

    require_once ($inc_path."bIncludes.php"); // подключение необходимых функций

//    $job=checkWebHook($token,$hook_url);

    $job=checkWHook();

    
//читаем результат из стандартного потока, в который PHP записывает полученные данные

    $lst_query=file_get_contents('php://input');

    $update = json_decode($lst_query,true);

//получаем значение chat_id – идентификатор чата с пользователем, отправившим сообщение

    if (is_array($update)){
        
        $chatID=$update['message']['chat']['id'];
        $query_txt=$update['message']['text'];

        $msg_txt=str_replace("\r\n","%0A",$query_txt);
    
 include_once($inc_path."bSendDebug.php"); //подключаем при необходимости отладки

        $output=send2Bot($tgConf['url'],$chatID,$msg_txt);

} else {

        $msg_txt="Just test message";
    }

}

if (isset($output) AND is_string($output) AND mb_strlen($output)>0){echo "TRUE";}
else {echo "FALSE";}

?>