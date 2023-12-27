<?php

/*

parent: inc.common/_index.php;

*/

$phead="";
$phead.="<title>:: ".@$MainTitle;

if (isset($show)){
	$phead.=" - ".$mTitle[$show].$TitleFin2;
} elseif (isset($new)){
	$phead.=" - добавление ".$mTitle[$new].$TitleFin2;
} elseif (isset($cShow)){
	$phead.=" - ".$mTitle[$cShow].$TitleFin2;
}

if (isset($tSelect) AND !empty(trim($tSelect))) {$phead.=" - ".trim($tSelect);}

$phead.=" ::</title>\n";

$show=parseQuery('show');

$new=parseQuery('new');

$csshead="";

?>