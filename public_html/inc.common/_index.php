<?php

/*

parent: [folder]/index.php;    

*/

$MainTitle="Наружная реклама во Владивостоке и Приморье";
$main_menu="Наружная реклама ДВ. Реклама во Владивостоке. Реклама в Приморском крае";

include_once ($comm_path."/lib/include.php");
include_once ($comm_path."/lib/func_files.php");
include_once ($comm_path."/lib/func_map.php");
include_once ($comm_path."/_db.php");

include_once ($comm_path."/_title.php");

if (isset($_GET['sub'])){

	$design_sw['sub']="-";

} else {

	$design_sw['sub']="";

}

$design_sw['utm_content']="-";
$design_sw['utm_medium']="-";

if (isset($_GET['side']) AND intval($_GET['side'])>0){

	$design_sw['side']=intval($_GET['side']);

} elseif(isset($_GET['code']) AND intval($_GET['code'])>0){

	$design_sw['side']=intval($_GET['code']);

}

include_once ($inc_path."/search/_search.php");
include_once ($inc_path."/get/_area.php");
include_once ($inc_path."/get/_types.php");

if (isset($_GET['card'])){

	include_once ($inc_path."/get/_card.php");
	include_once ($comm_path."/tpl/_card_tpl.php");

} else {

	include_once ($inc_path."/get/_tab_head.php");
	include_once ($inc_path."/get/_list.php");
	include_once ($comm_path."/tpl/_main_tpl.php");
}

?>
