<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?=$MainTitle?><?php if (!empty($MainSubTitle)): ?>: <?=$MainSubTitle?><?php endif; ?><?php if (isset($left_title) AND !empty($left_title)): ?>. <?=$left_title?><?php endif; ?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="/comm/favicon.ico" />
<?php if(!isset($_GET['q']) || $_GET['q']!="print"): ?>
<link rel="stylesheet" href="/css/sstyle.css" type="text/css">
<link rel="stylesheet" href="/css/forms.css" type="text/css">
<link rel="stylesheet" href="/css/mmenu.css" type="text/css">
<?php if (file_exists($inc_path."/_css.inc")) {include_once($inc_path."/_css.inc");} ?>
<?php if(isset($_GET['blank'])): ?>
<script src="/js/jquery-1.10.2.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/datepick.js"></script>
<link rel="stylesheet" href="/css/jquery-ui.css">
<?php else: ?>
<link rel="stylesheet" href="/css/pickmeup.css">
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery.pickmeup.js"></script>
<script src="/js/demo.js"></script>
<?php if (file_exists($inc_path."/_meta.inc")) {include_once($inc_path."/_meta.inc");} ?>
<?php endif; ?>
<?php if (file_exists($inc_path."/_meta_".$basecat[1].".inc")) {include_once($inc_path."/_meta_".$basecat[1].".inc");} ?>
<?php elseif (file_exists($inc_path."/_css.inc")): include_once($inc_path."/_css.inc"); ?>
<?php else: ?>
<link rel="stylesheet" href="/css/style.css" type="text/css">
<link rel="stylesheet" href="/css/sstyle.css" type="text/css">
<?php endif; ?>
</HEAD>
<body>
<div style='padding:5px 20px 10px 20px;position:relative;font-size: 14px;'>
<?php if (!empty($MainSubTitle)): ?><h4><font color=grey><?=$MainSubTitle?></font></h4><?php endif; ?>
<?php if (isset($left_title) AND !empty($left_title)): ?><h2><?=$left_title?></h2><?php endif; ?>
<?=$left_text?>
</div>
</BODY>
</HTML>
