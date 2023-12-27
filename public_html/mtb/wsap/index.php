
<?php

date_default_timezone_set('Asia/Vladivostok');

header('Content-Type: text/html; charset=utf-8'); // кодировка UTF-8
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

mb_internal_encoding("UTF-8");

error_reporting(E_ALL | E_STRICT) ; 
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);

 error_reporting(E_ALL); 


$iticket="d65r^".date("m",time())."%C^%XIubn".date("d",time())."IUBiy*6".date("y",time())."^%R";

if (isset($_GET['qserv']) AND $_GET['qserv']==$iticket) {

    $_GET['service']=true;
    $_GET['q']=$_GET['qserv'];
    
} elseif(isset($_GET['qmess']) AND $_GET['qmess']==$iticket){

    $_GET['messages']=true;
    $_GET['q']=$_GET['qmess'];
    
}

$metas="";
$title="";
$header="";
$result_text="";
$result_table="";
$menu="";

if (isset($_GET['q']) AND $_GET['q']==$iticket) {

    $comm_path="../../inc.common";
    $inc_path="../../inc.mface";

    #    require ('tb/tbLibServ.php');
    require_once ($comm_path."/lib/func_gen.php");

    require_once ($comm_path."/lib/func_query.php");
    require_once ($comm_path."/lib/func_files.php"); // математика
//    require_once ($comm_path."/lib/func_doc.php");
    require_once ($comm_path."/lib/func_db.php");
//    require_once ($comm_path."/lib/func_days.php");
//    require_once ($inc_path."/lib/_func.php");

    include ("_switch.php");

} else {
    
    $header="Error!";
    $result_text="Valid parametres required";

}

require_once("main.tpl.php");
?>
