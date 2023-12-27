<?php

if (!isset($Temp_GisCity[$TempArr_city]) or empty($Temp_GisCity[$TempArr_city])){$Temp2gisCity="vladivostok";}
else {$Temp2gisCity=$Temp_GisCity[$TempArr_city];}

$URLLink=$URL_2gis[0];
$URLLink.=$Temp2gisCity;
$URLLink.=$URL_2gis[1];
$URLLink.=$TempArr_coord;
$URLLink.=$URL_2gis[5];
$URLLink.=$URL_2gis[2];
$URLLink.=$TempArr_coord;
$URLLink.=$URL_2gis[3];
$Temp2gisCity="";
?>