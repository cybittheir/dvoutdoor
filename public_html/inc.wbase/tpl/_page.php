<?php if (!isset($err_access)):?>
<?php @include($inc_path."/_basic.php"); ?>
<?php else:?><?=$err_access;?>
<?php endif;?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<div style='display: inline-block; position: fixed; float:left;width:100%;top:55px;bottom:65px;min-height:300px;'>

    <div id="fullpage" style='position: relative;'>
        <?php if (isset($cX) AND isset($cY)):?>
        <div id="window_bar" style="height:20px;">Карта выбранных сторон</div>
        <div id="window_body" style="top:29px;height:250px;">
        <div id='allmap' style='display:inline-block;position:relative;width:100%;height:245px;'></div>

            <?php include_once($inc_path."/tpl/_map.php"); ?>

        </div>
        <?php else: ?>
        <div id="window_bar" style="height:20px;">Карточка поверхности</div>
        <div id="window_body" style="top:29px;height:250px;">

            <?php include_once($inc_path."/get/_card.php"); ?>

        </div>
        <?php endif;?>

        <div id="window_bar" style='top:285px;height:20px;'>Список поверхностей</div>
        <div id="window_body" style='top:313px;height:30px;padding:1px;';>
            <?php include_once($inc_path."/tpl/_options.php"); ?>
        </div>
        <div id="window_body" style='top:349px;height:25px;padding:0px;';>
            <?php include_once($inc_path."/tpl/_tab_head.php"); ?>
        </div>
        <div id="window_body" style='top:380px;bottom:1px;'>
            <?php include ($inc_path."/tpl/_list.php"); ?>
        </div>
    </div>
</div>
