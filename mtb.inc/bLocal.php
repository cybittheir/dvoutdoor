<?php

$query_txt=$update['message']['text'];

$msg_txt=$query_txt;

$output=send2Bot($tgConf['url'],$chatID,$msg_txt);

?>