<?php

$request_code = generateSID('18');

if (($chatID)<>0){ // при участии в группах ID чата отрицательная

    $query_txt=$update['message']['text'];

    $tg_query_Rec=str_replace("\\","\\\\",$tg_query);

    // запись делается в одну общую таблицу для всех прикрепленных ботов

    $story_requestQ="INSERT INTO tg_query(MESSAGE_ID, REQUEST, RTXT) VALUES ('".$chatID."','".$request_code."','".$tg_query_Rec."')";

    if(sql_query($story_requestQ)){$content=$tg_query."\n\n".$story_requestQ."\n\n";} // для отладки. Изменить
    else {$content=$tg_query."\n\n";}

//отправляем на сервер id запроса с telegram и читаем результат

    $get_url=$base_url."?req=".urlencode($request_code);

    if ($result=file_get_contents($get_url)) {

        $result_arr=json_decode($result,true);

    }

}

# include_once($inc_path."bDebug.php"); // для отладки подключаем

//Формируем строку запроса – отправка пользователю сообщения

if (isset($result_arr)){

    $msg_txt=str_replace("\r\n","%0A",$result_arr['text']);

} elseif (isset($result)) {

    $msg_txt="Ошибка: некорректный запрос или команда. Или функционал команды находится в процессе разработки. Список возможных команд - /help";

} else {

    $msg_txt="Ошибка: Нет ответа от основного сервера";

}

if ($output=send2Bot($url,$chatID,$msg_txt)) {

    // удаляем все следы запроса
    
                $delQ="DELETE FROM tg_query WHERE REQUEST='".$request_code."'";
    
    #	    	$delQ="DELETE FROM tg_query WHERE REQUEST IS NOT NULL"; // очистить базу
    
                sql_query($delQ); 
    
}
    
?>