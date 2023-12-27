<?php

date_default_timezone_set('Asia/Vladivostok');

$inc_path="../../mtb.inc/";

require_once ($inc_path."bErrSet.php");
require_once ($inc_path."listen.includes.php");


if (isset($_GET) AND sizeof($_GET)>0){

    if (isset($_GET['UID']) AND mb_strlen($_GET['UID'])>10){

        if (isset($_GET['mfpin']) AND mb_strlen($_GET['mfpin'])==6) {

            foreach($_GET as $key=>$value){
                if (substr($key,0,2)=="x_" AND $value=="failed"){
                    $failed_devices[]=substr($key,2);
                } else {
                    $result['values'][$key]=$value;
                }
            }
            
          
            if (isset($failed_devices)){
                $result['status']['failed']=$failed_devices;
            } else {
                $result['err']="OK";
            }

        } else {

            $result['err']="Wrong parameters";

        }
    } else {
        $result['err']="Unknown request";
    }

} else {
    $result['err']="Nothing to say";
}

?>
<?php 
$top='<!DOCTYPE html>
<HTML lang="ru">
<HEAD>
    <meta charset="utf-8">
    <TITLE>MediaAgentServer</TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</HEAD>
<BODY>
';
 
$result['status']['time']=date("Y-m-d H:i:s",time());
$result_json=json_encode($result);

$bottom='
</BODY>
</HTML>';

// echo $top;
echo $result_json;
// echo $bottom;

?>