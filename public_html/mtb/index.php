<?php

//@labmedia_alarm_bot

date_default_timezone_set('Asia/Vladivostok');

header('Content-Type: text/html; charset=utf-8'); // кодировка UTF-8
mb_internal_encoding("UTF-8");

if ($_SERVER['HTTP_HOST']=="botapi.dvoutdoor.ru"){
    
    $inc_path="../../mtb.inc/";

    require_once ($inc_path."bErrSet.php"); // подключаем файл для отображения ошибок

    $tgConf=require_once $inc_path."bConfig.php"; // конфиг бота

    require_once ($inc_path."bIncludes.php"); // подключение необходимых функций

    $job=checkWHook();

    if (isset($_GET['start']) and $_GET['start']=="NOW") { // для отладки 

    	echo $job;

    } else {

/*
// читаем результат из стандартного потока, в который PHP записывает полученные данные

    	$tg_query=file_get_contents('php://input');

    	$update = json_decode($tg_query,true);

// получаем значение chat_id – идентификатор чата с пользователем, отправившим сообщение

    	if (is_array($update) AND $chatID=$update['message']['chat']['id']) {
      
            require_once ($inc_path."bSwitch.php");

            require_once ($inc_path."bLocal.php");
        
        } else {

            // перекидываем на основной сайт, если обращение идет к другому домену
    
            siteRedirect();

        }

    }
*/


        require_once("../../mtb.lib/classes.tb.php");

        $content="";
        $tg_query="";

        $update = new TGBot($tgConf['token']);

        $get_url=$tgConf['token'];

        //echo "<pre>";

        $result_arr=getIncoming($update);

        //print_r($result_arr);

        //echo "</pre>";

        require_once("../../mtb.inc/bDebug.php");

    }

} else {

    // перекидываем на основной сайт, если обращение идет к другому домену
    
    siteRedirect();

}

?>