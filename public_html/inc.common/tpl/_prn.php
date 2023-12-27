<!DOCTYPE html>
<HTML lang="ru">
  <HEAD>
    <meta charset="utf-8">
    <TITLE><?=$MainTitle?><?php if (!empty($MainSubTitle)): ?>: <?=$MainSubTitle?><?php endif; ?><?php if (!empty($PageTitle)): ?>. <?=$PageTitle?><?php endif; ?></TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="/comm/favicon.ico" />
<?php if (file_exists($inc_path."/_css.inc")) {include_once($inc_path."/_css.inc");} ?>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/css/sstyle.css" type="text/css">
  </HEAD>
  <body>
  <!-- tpl.prn -->
<?php if (!isset($err_access)):?>
<?php if (file_exists($inc_path."/_basic.php")):?>
<?php include($inc_path."/_basic.php"); ?>
<?php elseif (file_exists($inc_path."/_basic.inc")):?>
<?php include($inc_path."/_basic.inc"); ?>
<?php else: ?>Ошибка в структуре сайта (отсутствует basic)!!!
<?php endif;?>
<?php else:?><?=$err_access;?>
<?php endif;?>
<?php @include_once($inc_path."/_tpl.php"); ?>

<script type="text/javascript">
  window.onload = function() { window.print(); }
</script>
</BODY>
</HTML>
