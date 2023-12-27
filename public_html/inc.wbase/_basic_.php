<?php
if ($basecat[1]=="addr") {

	if (!isset($_POST['msg'])){
		include_once($inc_path."/form/_addr.php");
	} else {
		include_once($inc_path."/vars/_addr.php");
		include_once($inc_path."/addr/_addr.php");
	}

} elseif ($basecat[1]=="adbase"){

	include_once($inc_path."/vars/_vars.php");
	include_once($inc_path."/vars/_adv_db.php");
	include_once($inc_path."/_db.php");
	include_once($inc_path."/vars/_vars_db.php");

	if (isset($_GET['sedit']) AND $MoreOptions==true) {
		$tpl="side";
	} elseif (isset($_GET['dmnt'])) {
		$tpl="dmnt";
	} elseif (isset($_GET['sedit'])) {
		$tpl="vside";
	} elseif (isset($_GET['cedit']) AND $MoreOptions==true) {
		$tpl="cons";
	} elseif (isset($_GET['cedit'])) {
		$tpl="vside";
	} elseif (isset($_GET['map'])) {
		$tpl="map";$nwinTitle="Карта конструкций";
	} elseif (isset($_GET['new']) AND $MoreOptions==true) {
		$tpl="new".$_GET['new'];
	} elseif(isset($_GET['vcards']) AND trim($_GET['vcards'])=="YES" AND $MoreOptions==true) {
		$tpl="import";
	} elseif (isset($_GET['code']) AND isset($_GET['id']) AND $MoreOptions==false) {
		$tpl="join";
	} else {
		$tpl="surfs";
	}

	include_once($inc_path."/_list.php");

}
?>