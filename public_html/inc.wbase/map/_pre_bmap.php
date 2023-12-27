<?php

function preMap ($id, $yx="",$baloon=""){

	if (!empty($yx) AND !empty($baloon)){

		$result='myPlacemark = new ymaps.Placemark(
			['.$yx.'],
			{iconContent: '.$id.',
			balloonContent: "'.$baloon.'"},
			{preset: \'islands#redIcon\',}
			);
			myMap.geoObjects
			.add(myPlacemark);
			';
	}

	if (isset($result) AND !empty($result)){return $result;}
	else {return "";}

}

?>
