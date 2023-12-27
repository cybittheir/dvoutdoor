<?php
$c="";
$qwhere="";
$ad_qcitywhere="";
$res="";
$changes_title="РАБОЧИЙ ГОД: ".$syear."; ТЕКУЩИЙ ГОД: ".$this_year."\n\n";
$changes="";
$old_err="";
$s_str="";
$nwinWidth=1100;

if (isset($_GET['map'])){$nwinWidth=1200;}

if (isset($_GET['stat']) AND isset($_GET['mnth'])){include ($inc_path."/_qstat.php");}

# if ((isset($_POST['ss']) AND !empty($_POST['ss'])) OR (isset($_SESSION['adb_search']) AND !empty($_SESSION['adb_search']))){
	include_once($inc_path."/search/_search.php");
# }

/*
if (isset($_GET['city']) AND !empty($_GET['city'])){
	include_once($inc_path."/search/_select.php");
}
*/

include_once($inc_path."/get/_query.php");
include_once($inc_path."/get/_surfs.php");

?>
