<!DOCTYPE html>
<HTML lang="ru">
  <HEAD>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="canonical" href="http://dvoutdoor.ru/" />
    <meta name="robots" content="NOODP"/>
    <link rel="shortcut icon" href="/img/favicon.ico" />
    <TITLE><?=@$MainTitle?><?php if (!empty($MainSubTitle)): ?>: <?=$MainSubTitle?><?php endif; ?><?php if (!empty($PageTitle)): ?>. <?=$PageTitle?><?php endif; ?></TITLE>
    <meta name="description" content="Рекламные услуги, размещение наружной рекламы. Владивосток. Приморский край. Для размещения рекламы звоните по телефону 8(423)243-49-70" />
    <meta name="Keywords" content="Наружная реклама, карта наружной рекламы, рекламные конструкции, рекламные поверхности, рекламные щиты, светодиодные экраны, щиты 3х6, реклама на щитах, аренда рекламной конструкции, реклама на медиа, LED-экраны, digital, LED, out-of-home, ooh" />
    <link rel="stylesheet" href="/css/sstyle.css" type="text/css">
    <link rel="stylesheet" href="/css/forms.css" type="text/css">
    <link rel="stylesheet" href="/css/mmenu.css" type="text/css">
    <link rel="stylesheet" href="/css/footer.css" type="text/css">
    <meta name="viewport" content="width=850, height=850, maximum-scale=1">
    <?=makeRefresh($odb);?>
  </HEAD>

<body>

<!-- Top100 (Kraken) Counter -->
<script>
    (function (w, d, c) {
    (w[c] = w[c] || []).push(function() {
        var options = {
            project: 1802728,
        };
        try {
            w.top100Counter = new top100(options);
        } catch(e) { }
    });
    var n = d.getElementsByTagName("script")[0],
    s = d.createElement("script"),
    f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src =
    (d.location.protocol == "https:" ? "https:" : "http:") +
    "//st.top100.ru/top100/top100.js";

    if (w.opera == "[object Opera]") {
    d.addEventListener("DOMContentLoaded", f, false);
} else { f(); }
})(window, document, "_top100q");
</script>

<noscript>
  <img src="//counter.rambler.ru/top100.cnt?pid=1802728" alt="Топ-100" />
</noscript>
<!-- END Top100 (Kraken) Counter -->

<div style='position: relative;height:100%;width:100%;min-width:1100px;'>

<nav>
<div id="top_menu" style='position: fixed;height:55px;width:100%;z-index:8;min-width:1100px;'>
<div id="top_menu_null"></div>
<div id="maintitle"><a href="/"><h1><span title="<?=$main_menu?>"> :: </span><?=@$MainTitle;?> </h1></a></div>
<div style='display: inline-block; font-size:10pt; width:220px; float:right;'>
<div style='display: inline-block;float:left;margin-top:6px;color:white;'>

<?php if(isset($_GET['sub'])):?><a href="<?php echo UrlQuery($design_sw,'','side');?>" title="горизонтальное расположение" alt="горизонтальное расположение"><img src=/img/hrz.png height=20px width=20px border=0></a>
<?php else:?><a href="<?php echo UrlQuery($design_sw,'','side');?>" title="вертикальное расположение" alt="вертикальное расположение"><img src=/img/vrt.png height=20px width=20px border=0></a>
<?php endif;?>
</div>
</div>
<div style='background:#640000; height:34px; width:100%;'></div>
</div></div>
<div id="top_menu" style='height:55px;min-width:1100px;'></div>
</nav>

<?php if (!isset($_GET['sub'])){
  $subquery="";
  include_once($inc_path."/tpl/_page.php");
} else {
  $subquery="sub&";
  include_once($inc_path."/tpl/_page2.php");
}
?>

<?php include_once($comm_path."/tpl/_footer.php");?>

<?php if($messages){doIndex();}?>

</BODY>
</HTML>
