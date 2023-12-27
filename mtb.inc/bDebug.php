<?php

###################################################################### - файл для отладки - #########################################################

// на период отладки записываем запросы в файлы
	$filename="qq/".date("His",time()).".txt";

	if (is_array($result_arr))
    {

        $fin_txt="arr:".sizeof($result_arr)."\n(\n".reCompact($result_arr)."\n)";

    } 
    else 
    {
        $fin_txt="text:".$result_arr;
    }

	$resultRQ=$tg_query."\n************************\n\n[[".$fin_txt."\n]]\n\n".$get_url;

	file_put_contents($filename,$content.$resultRQ);

######################################################################

function reCompact($array,$parent=""){

    foreach($array as $key=>$value){

        if (is_array($value)){

            if (!empty($key)){$parent_new=$parent."[".$key."]";}

            $result[]=reCompact($value,$parent_new);

        } elseif(empty($level)) {

            $result[]=$parent."[".$key."]=".$value."\n";

        }

    }

    return implode("\n",$result);

}

?>