<?php

function checkWebHook($token,
                    $hookURL="https://botapi.dvoutdoor.ru/mtb/",
                    $apiURL="https://api.telegram.org/bot") {

    $test_url=$apiURL.$token."/getWebHookInfo";

	$set_url=$apiURL.$token.'/setWebhook?url='.$hookURL;

    $test=file_get_contents($test_url);
    
    $test_arr=json_decode($test,true);
    
    if ($test_arr['result']['url']!=$hookURL) {

        $set=file_get_contents($set_url);

        if (isset($_GET['start']) AND $_GET['start']=='NOW') {return $set;}
        
    } elseif (isset($_GET['start']) AND $_GET['start']=='NOW') {return $test;}

}

function checkWHook() {

    $tgConf=tgConfig();

    $test_url=$tgConf['api'].$tgConf['token']."/getWebHookInfo";

	$set_url=$tgConf['api'].$tgConf['token'].'/setWebhook?url='.$tgConf['hook'];


    $test=file_get_contents($test_url);
    
    $test_arr=json_decode($test,true);
    
    if ($test_arr['result']['url']!=$tgConf['hook']) {

        $set=file_get_contents($set_url);

        if (isset($_GET['start']) AND $_GET['start']=='NOW') {
        
            return $set;
        
        }
        
    } elseif (isset($_GET['start']) AND $_GET['start']=='NOW') {
    
        return $test;
    
    }

}

function send2Bot($url,$chatID,$msg_txt,$mode="html"){

    if (!isset($chatID) OR empty($chatID) OR !isset($msg_txt) OR empty($msg_txt)){

        return false;

    } else {

        // отправка больших сообщений партиями

        if (mb_strlen($msg_txt)>4030) {

            $msg_arr=explode("%0A",$msg_txt);

			reset($msg_arr);
            
            $msg_num=1;

            foreach ($msg_arr as $mstr) {

                if (mb_strlen($mstr)<4020) {

                    $msg_test[]=$mstr;

                    if(mb_strlen(implode("\r\n",$msg_test))<4021){;}
                    else {

                        $msg_num++;
                        unset($msg_test);
                        $msg_test[]=$mstr;

                    }

                    $msg_part[$msg_num][]=$mstr;

                }

			}
			
        } else {$msg_part['0'][]=$msg_txt;}

		reset ($msg_part);

		$con = curl_init();

        foreach($msg_part as $msg_array){

			if (is_array($msg_array)){

				$msg_txt_rn=implode("\r\n",$msg_array);
				$msg_txt=str_replace("\r\n","%0A",$msg_txt_rn);

			} else {

				$msg_txt=$msg_array;

			}

            if (empty($mode)){$mode="html";}

            if($tgConf=tgConfig()){
            
                $url_query=$tgConf['url']."/sendMessage?chat_id=".$chatID."&parse_mode=".$mode."&text=".$msg_txt;
            
                $msg_query="chat_id=".$chatID."&parse_mode=".$mode."&text=".$msg_txt;

                parse_str($msg_query,$msg_fields);

//Настраиваем запрос
                curl_setopt($con, CURLOPT_URL, $url_query);
                curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($con, CURLOPT_POST, 1);

//            curl_setopt($con, CURLOPT_POSTFIELDS, $msg_fields);
                curl_setopt($con, CURLOPT_HEADER, 0);

//Выполняем запрос
                $output[] = curl_exec($con);

            }

        
		}

//Закрываем запрос

        if (isset($output)){
			
		    curl_close($con);
		
		    return implode("",$output);
        
        } else {

            return false;

        }
 
	}

}

function siteRedirect(){

    echo "<html>
<head>
<title>WRONG PATH OR URL</title>
<META http-equiv='refresh' content='0; url=https://dvoutdoor.ru'>
</head>
<body>
there is WRONG PATH OR URL
</body>
</html>";

}

?>