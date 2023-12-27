<?php

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
                            $this_string_arr[$key][$order[$col_name]]=$str_val;    
                            $this_string_arr[$key][$order["Y".$col_name]]=$value['y'];    
                            $this_string_arr[$key][$order["X".$col_name]]=$value['x'];    
                        } else {
                            $str_val=implode(",",$value);
                            $this_string_arr[$key][$order[$col_name]]=$str_val;    
                        }
                    } elseif($col_name=="DIGITAL" AND $value=="YES") {

                        $this_string_arr[$key][$order[$col_name]]="digital";

                    } else {

                        $this_string_arr[$key][$order[$col_name]]=$value;
                    }

                    if ($col_name=="ADDRESS"){
                        $sort_address[$key]=$value;
                    }

                }

            }

            $this_string_arr[$key][$order['MNTH'.$i]]='свободно';

            if ($i==0) {
                $this_string_arr[$key][$order['MNTH1']]=' ';
            } elseif ($i==1 AND isset($all_strings_arr[$key][$order['MNTH0']])){
                $all_strings_arr[$key][$order['MNTH1']]="свободно";
            } elseif ($i==1){
                $this_string_arr[$key][$order['MNTH0']]=" ";
                $this_string_arr[$key][$order['MNTH1']]="свободно";
            }

        }



        if (isset($this_string_arr[$key])){

            $this_string_arr[$key][$order['URL']]="https://dvoutdoor.ru/?ad=".$key;
            
            reset($this_string_arr[$key]);
            ksort($this_string_arr[$key]);

            if (!isset($all_strings_arr[$key])){

                $all_strings_arr[$key]=$this_string_arr[$key];

            }
        
            unset($this_string_arr[$key][$order['MNTH1']]);
            unset($this_string_arr[$key][$order['MNTH0']]);

            $this_string[$i][]=implode(";",$this_string_arr[$key]);

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

    $title="Выборка свободных поверхностей на ".$get_month[$i]."/".$get_year[$i]." от ".date("d/m/Y, H:i",time())." (Владивосток)";

    while(list($order_name,$num)=each($order)){

        if ($order_name=="ADDRESS") {
            $headers_arr[]=$field_name[$order_name].". ".$title;
        } elseif ($order_name=="MNTH0" OR $order_name=="MNTH1") {
            ;
        } else {
            $headers_arr[]=$field_name[$order_name];
        }
        
    }

    include ("_csv.php");

}

?>