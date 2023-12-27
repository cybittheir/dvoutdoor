<?php
$err_ya="";
if (!isset ($TempArr_coord) OR empty($TempArr_coord)){
    $err_ya="Координаты отсутствуют";
} else {			# подготовка нанесения метки на карту
    $CoordArrYa=explode(",",$TempArr_coord);
	$CoordYa=$CoordArrYa[1].",".$CoordArrYa[0];

	$ctx = stream_context_create(array('https' => array('timeout' => 15)));	# если происходит таймаут, то ничего не загружается и модуль карт не подключается
	$ya= file_get_contents('https://dvoutdoor.ru/', 0, $ctx);
	if (empty($ya)){$err_ya="Карты Яндекс недоступны";}
}
?>
<?php if (isset($ya) AND !empty($ya)):?>
<script type="text/javascript">
    // Как только будет загружен API и готов DOM, выполняем инициализацию
    ymaps.ready(init);

    function init () {
        var myMap = new ymaps.Map("map", {center: [<?=$CoordYa?>],zoom: 16,controls:[]}),
        // Первый способ задания метки
        myPlacemark = new ymaps.Placemark([<?=$CoordYa?>]);
        // Добавляем метки на карту
        myMap.geoObjects.add(myPlacemark);
    }
</script>
<?php endif;?>