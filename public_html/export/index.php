<?php

$comm_path="../inc.common";

include_once ($comm_path."/lib/include.php");

/* date_default_timezone_set('Asia/Vladivostok');

mb_internal_encoding("UTF-8");

ini_set('session.gc_maxlifetime', 366000);
ini_set('session.save_path', 'tmp/id');
*/

?><!DOCTYPE html>
<HTML lang="ru">
  <HEAD>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="canonical" href="http://dvoutdoor.ru/" />
    <meta name="robots" content="NOODP"/>
    <link rel="shortcut icon" href="/img/favicon.ico" />
    <TITLE>Наружная реклама во Владивостоке и Приморье</TITLE>
    <meta name="description" content="Рекламные услуги, размещение наружной рекламы. Владивосток. Приморский край. Для размещения рекламы звоните по телефону 8(423)243-49-70" />
    <meta name="Keywords" content="Наружная реклама, карта наружной рекламы, рекламные конструкции, рекламные поверхности, рекламные щиты, светодиодные экраны, щиты 3х6, реклама на щитах, аренда рекламной конструкции, реклама на медиа, LED-экраны" />
    <meta name="viewport" content="width=850, height=850, maximum-scale=1">
      </HEAD>

<body>

<ul>Список свободных поверхностей:

<?php

include_once ($comm_path."/lib/func_files.php");

$client_folder=str_replace(".","_",$_SESSION['ip']);

if (!file_exists("files/".$client_folder)){

    mkdir("files/".$client_folder);

}

$get_month[0]=intval(date("m",time()));
$get_year[0]=intval(date("Y",time()));

if ($get_month[0]=="12"){
    $get_month[1]=1;
    $get_year[1]=$get_year[0]+1;
} else {
    $get_month[1]=$get_month[0]+1;
    $get_year[1]=$get_year[0];
}

reset ($get_month);

$order['NUMBER']=1;
$order['TYPE']=2;
$order['CITY']=3;
$order['ADDRESS']=4;
$order['SIDE']=5;
$order['LIGHT']=6;
$order['PRICE']=7;
$order['DIGITAL']=8;
$order['MNTH0']=9;
$order['MNTH1']=10;
$order['URL']=11;
$order['COORD']=12;
$order['YCOORD']=13;
$order['XCOORD']=14;

$field_size['NUMBER']=45;
$field_size['TYPE']=100;
$field_size['CITY']=80;
$field_size['ADDRESS']=320;
$field_size['SIDE']=55;
$field_size['LIGHT']=30;
$field_size['PRICE']=55;
$field_size['DIGITAL']=80;
$field_size['MNTH0']=73;
$field_size['MNTH1']=73;
$field_size['URL']=56;
$field_size['COORD']=80;
$field_size['YCOORD']=80;
$field_size['XCOORD']=80;

$field_name['NUMBER']="№";
$field_name['TYPE']="Тип конструкции";
$field_name['CITY']="Город";
$field_name['ADDRESS']="Адрес";
$field_name['SIDE']="Сторона";
$field_name['LIGHT']="Свет";
$field_name['PRICE']="Цена";
$field_name['DIGITAL']="Формат";
$field_name['MNTH0']=$get_month[0]."/".$get_year[0];
$field_name['MNTH1']=$get_month[1]."/".$get_year[1];
$field_name['URL']="Сайт";
$field_name['COORD']="Карта";
$field_name['YCOORD']="Широта";
$field_name['XCOORD']="Долгота";

$order['TYPE_ID']=0;
$order['ENABLE']=0;

include ("prepare.php");

reset($order);
asort($order);

$all_title="Выборка свободных поверхностей на ".$get_month[0]."/".$get_year[0]." - ".$get_month[1]."/".$get_year[1]." от ".date("d/m/Y, H:i",time())." (Владивосток)";

while(list($order_name,$num)=each($order)){

    if ($order_name=="ADDRESS") {
        $all_headers_arr[]=$field_name[$order_name].". ".$all_title;
    } else {
        $all_headers_arr[]=$field_name[$order_name];
    }
    
}

reset ($all_strings_arr);
reset ($sort_address);
asort ($sort_address);

while(list($skey,$address)=each($sort_address)){

    $all_strings[]=implode(";",$all_strings_arr[$skey]);
}

include ("_csv_all.php");

include ("_xml_all.php");

?>
</ul>

</BODY>
</HTML>