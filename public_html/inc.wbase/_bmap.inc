<div style='display:inline-block;position:fixed;right:0px;top:130px;width:500px;'>
<?php 
$Xdef=$coordXmax-$coordXmin;
$Ydef=$coordYmax-$coordYmin;
$CenterX=($coordXmax+$coordXmin)/2;
$CenterY=($coordYmax+$coordYmin)/2;
$YaCenter=$CenterY.",".$CenterX;
$yaZoom=16;
$tzoom=log(max($Xdef,$Ydef)/0.003,2);
if ($tzoom>0){$yaZoom=$yaZoom=16-intval($tzoom);}
if(isset($_GET['city']) AND isset($Temp_YaCenter[$_GET['city']])){
	echo "<b>".$MenuCity[$_GET['city']]."</b>";
} else {
	echo "<b>Приморский край</b>";
	$reg="";
}
?>
</div>
<div id='allmap' style='display:inline-block;position:fixed;right:0px;top:160px;bottom:30px;width:500px;'></div>
<script type="text/javascript">
ymaps.ready(init);
function init () {
	var myMap = new ymaps.Map("allmap", {
	center: [<?=$YaCenter?>],
	zoom: [<?=$yaZoom?>],
	type: "yandex#map",
	controls: []}),
	<?=$mapsmarks;?>
}
</script>
</div>