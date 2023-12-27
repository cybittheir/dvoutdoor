<?php if (!isset($err_access)):?>
<?php @include($inc_path."/_basic.php"); ?>
<?php else:?><?=$err_access;?>
<?php endif;?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<div style='display: inline-block; position: fixed; float:left;width:100%;top:55px;bottom:65px;min-height:300px;'>

    <div id="fullpage" style='position: relative;'>

        <div id="window_bar" style='height:20px;right:426px;'>Список поверхностей</div>
        <div id="window_body" style='top:29px;height:30px;right:426px;'>
            <?php include_once($inc_path."/tpl/_options.php"); ?>
        </div>
        <div id="window_body" style='top:68px;height:25px;right:426px;padding:0px;'>
            <?php include_once($inc_path."/tpl/_tab_head.php"); ?>
        </div>
        <div id="window_body" style='top:96px;bottom:1px;right:426px;'>
            <?php include_once($inc_path."/tpl/_list.php"); ?>
        </div>

        <?php if (isset($cX) AND isset($cY)):?>
            <div id="window_rbar" style="right:1px;height:20px;width:410px;">Карта выбранных сторон</div>
            <div id="window_rbody" style="right:1px;top:29px;width:410px;bottom:1px;">
            <div id='allmap' style='display:inline-block;position:relative;width:400px;height:100%;'></div>

                <?php include_once($inc_path."/tpl/_map.php"); ?>

            </div>
        <?php else: ?>
            <div id="window_rbar" style="right:1px;height:20px;width:410px;">Карточка поверхности</div>
            <div id="window_rbody" style="right:1px;top:29px;width:410px;bottom:1px;">

                <?php include_once($inc_path."/get/_card.php"); ?>

            </div>
        <?php endif; ?>

    </div>
</div>
