<?php 

include_once($inc_path."/_list.php");
# include_once($inc_path."/_surfs.php");
include_once($inc_path."/tpl/_surfs.php"); 

if (isset($tpl) AND !empty($tpl) AND $tpl!="surfs"){
	include_once($comm_path."/_nwin.php");
}
?>
