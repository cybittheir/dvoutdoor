<?php

// скрипт не используется

if (isset($citySelected)){

	if (empty($qcitywhere) AND empty($qwhere)){
		
        $qcitywhere=" WHERE ";
		$ad_qcitywhere=" WHERE ";
	
    } else {
	
        $qcitywhere.=" AND ";
		$ad_qcitywhere.=" AND ";
	
    }
	
    reset($citySelected);
	
    while (list($sck,$scv)=each($citySelected)){
	
        if(!empty($scv)){

            $city_tmp_arr=explode(" ",$scv);
            
            if (sizeof($city_tmp_arr)>1){

                while (list($tmpk,$tmpv)=each($city_tmp_arr)) {

                    if (mb_strlen($tmpv)>3){

                        $qscity_search[]="ADB_NAME LIKE '%".$tmpv."%' OR ADDR_CITY LIKE '%".$tmpv."%'";
                        $ad_qscity_search[]="ADRESS LIKE '%".$tmpv."%' OR CITY LIKE '%".$tmpv."%'";
        
                    }

                }

                unset($city_tmp_arr);

            } else {

                $qscity_search[]="ADB_NAME LIKE '%".$scv."%' OR ADDR_CITY LIKE '%".$scv."%'";
			    $ad_qscity_search[]="ADRESS LIKE '%".$scv."%' OR CITY LIKE '%".$scv."%'";

            }
	
        }
	
    }
	
    if (sizeof($qscity_search)>1){
	
        $qscitysearch=implode(" OR ",$qscity_search);
		$ad_qscitysearch=implode(" OR ",$ad_qscity_search);
	
    } else {
	
        $qscitysearch=implode("",$qscity_search);
		$ad_qscitysearch=implode("",$ad_qscity_search);
	
    }
	
    $ad_qcitywhere.="(".$ad_qscitysearch.")";
	$qcitywhere.="(".$qscitysearch.")";

}


echo "\n<!-- SELECTION \n";
echo $qcitywhere;
echo "\n===\n";
echo $ad_qcitywhere;
echo "\n -->\n";

?>