<?php

function preMap($id, $yx="",$baloon="",$disabled=FALSE){

	if (!empty($yx) AND !empty($baloon)){
        if ($disabled){$icon='grey';}
        else {$icon='red';}

		$result='myPlacemark = new ymaps.Placemark(
			['.$yx.'],
			{iconContent: '.$id.',
			balloonContent: "'.$baloon.'"},
			{preset: \'islands#'.$icon.'Icon\',}
			);
			myMap.geoObjects
			.add(myPlacemark);
			';
	}

	if (isset($result) AND !empty($result)){return $result;}
	else {return "";}

}

function buildMap($cX,$cY,$allPoints,$zoom=12){
    
#    if ($zoom<5){$zoom=5;}

    $script='ymaps.ready(init);
    function init () {
        var myMap = new ymaps.Map("allmap", {
        center: ['.$cY.','.$cX.'],
        zoom: ['.$zoom.'],
        type: "yandex#map",
        controls: []}),
        ';
    $script.=implode("",$allPoints);
    $script.="\n}\n";

    return $script;
}

function googleMAP ($x,$y){

    return "<a href='https://www.google.com/maps/place/".$y.",".$x."/@".$y.",".$x.",16z' target='_gmap' alt='смотреть на Картах Google' title='смотреть на Картах Google'>";
    
}

?>
