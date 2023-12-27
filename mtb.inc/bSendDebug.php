<?php

$request_code=$update['message']['req'];

$lst_query_Rec=str_replace("\\","\\\\",$lst_query);

// на период отладки записываем запросы в файлы

$filename="qq/".date("His",time()).".txt";

/*

//отправляем на сервер id запроса с telegram и читаем результат

$get_url="http://csapi.adlab.ru/tgmedia/list.php?req=".urlencode($request_code);

$result=file_get_contents($get_url);

$result_arr=json_decode($result,true);

// обрабатываем результат для формирования ответа

###################################################################### - файл для отладки - #########################################################

while (list($r,$k)=each($result_arr)){
	$back_answ[]=$r." == ".$k;
}

$resultRQ="\n************************\n[[".implode("\n",$back_answ)."]]\n\n".$get_url;

*/

// file_put_contents($filename,$lst_query.$resultRQ);

if (isset($lst_query) AND is_array($lst_query)){$lst="Arr:\n".implode("\n",$lst_query);}
else {$lst=$lst_query;}

file_put_contents($filename,$lst."\n===chatid===\n".$chatID."\n===txt===\n".$query_txt."\n===req===\n".$request_code);

?>