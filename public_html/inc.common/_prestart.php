<?php

/*

parent: inc.common/_index.php;

*/

date_default_timezone_set('Asia/Vladivostok');

header('Content-Type: text/html; charset=utf-8'); // кодировка UTF-8

// Закрыть после отладки
// error_reporting(E_ALL | E_STRICT) ; 
// ini_set('display_errors', 'On');
// ini_set('display_startup_errors', 'On');
//

mb_internal_encoding("UTF-8");

ini_set('session.gc_maxlifetime', 366000);
ini_set('session.save_path', 'tmp/id');

session_start();

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$_SESSION['ip']=$ip;

if (!isset($_SESSION['startat'])){$_SESSION['startat']=date("Y/m/d H:i:s",time());}
$_SESSION['lastref']=date("Y/m/d H:i:s",time());

unset($ip);

global $messages;
$messages=array();

$live=600;

?>