<?php

date_default_timezone_set('Asia/Vladivostok');

header('Content-Type: text/html; charset=utf-8'); // кодировка UTF-8

// Закрыть после отладки
 error_reporting(E_ALL | E_STRICT) ; 
 ini_set('display_errors', 'On');
 ini_set('display_startup_errors', 'On');
//

mb_internal_encoding("UTF-8");

ini_set('session.gc_maxlifetime', 366000);
ini_set('session.save_path', 'tmp/id');

$comm_path="../inc.common";

include_once ($comm_path."/lib/include.php");
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

$order['TYPE_ID']=0;
$order['ENABLE']=0;

echo "<ul>Список свободных поверхностей:\n";

for ($i=0;$i<2;$i++){

    unset($this_string);

    $file_url="https://csapi.adlab.ru/export/query.php?task=bb&json&month=".$get_month[$i]."&year=".$get_year[$i]."&q=".urlencode("Iub28nIUBiy*6^%Rd65r^%C^%X");

    $job=file_get_contents($file_url);

    $import = json_decode($job,true);

    $num=0;

    while (list($key,$item)=each($import)){

        if ($key!="0000"){

            unset($this_string_arr);

            while (list($col_name,$value)=each($item)){

                if (isset($order[$col_name]) AND $order[$col_name]>0){

                    if (is_array($value)){
                        if ($col_name=="COORD"){
                            $str_val="https://maps.google.ru/?f=q&source=s_q&hl=ru&q=".str_replace(" ","%20",$item['ADDRESS'])."@".$value['y'].",".$value['x']."&z=17&iwloc=addr";
                            $this_string_arr[$order[$col_name]]=$str_val;    
                        } else {
                            $str_val=implode(",",$value);
                            $this_string_arr[$order[$col_name]]=$str_val;    
                        }
                    } elseif($col_name=="DIGITAL" AND $value=="YES") {

                        $this_string_arr[$order[$col_name]]="digital";

                    } else {

                        $this_string_arr[$order[$col_name]]=$value;
                    }

                }

            }

            $this_string_arr['MNTH'.$i]='+';

        }



        if (isset($this_string_arr)){

            $this_string_arr[$order['URL']]="https://dvoutdoor.ru/?ad=".$key;
            
            reset($this_string_arr);
            ksort($this_string_arr);

            $this_string[]=implode(";",$this_string_arr);
    
            unset($this_string_arr);
    
        }

    }

    unset($file_url);
    unset($import);
    
    $new_name=$get_year[$i]."/".$get_month[$i];
    $new_file_xml=$get_year[$i]."_".$get_month[$i].".xml";

    unset($order['TYPE_ID']);
    unset($order['ENABLE']);

    reset($order);
    asort($order);

    while(list($order_name,$num)=each($order)){
        
        if ($order_name=="ADDRESS") {
            $headers_arr[]=$field_name[$order_name].". Выборка свободных поверхностей на ".$get_month[$i]."/".$get_year[$i]." от ".date("d/m/Y, H:i",time());
        } else {
            $headers_arr[]=$field_name[$order_name];
        }
        
    }

    include ("_csv.php");

}

echo "</ul>";

?>