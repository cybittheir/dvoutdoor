<!DOCTYPE html>
<HEAD>
<TITLE><?=$MainTitle?><?php if (!empty($MainSubTitle)): ?>: <?=$MainSubTitle?><?php endif; ?><?php if (!empty($PageTitle)): ?>. <?=$PageTitle?><?php endif; ?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="/comm/favicon.ico" />
<?php if(!isset($_GET['q']) || $_GET['q']!="print"): ?>
<link rel="stylesheet" href="/css/sstyle.css" type="text/css">
<link rel="stylesheet" href="/css/forms.css" type="text/css">
<link rel="stylesheet" href="/css/mmenu.css" type="text/css">
<link rel="stylesheet" href="/css/footer.css" type="text/css">
<?php if (file_exists($inc_path."/_css.inc")) {include_once($inc_path."/_css.inc");} ?>
<?php if(isset($_GET['blank'])): ?>
<script src="/js/jquery-1.10.2.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/datepick.js"></script>
<link rel="stylesheet" href="/css/jquery-ui.css">
<?php else: ?>
<link rel="stylesheet" href="/css/pickmeup.css">
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/jquery.pickmeup.js" type="text/javascript"></script>
<script src="/js/demo.js" type="text/javascript"></script>
<?php if (file_exists($inc_path."/_js.inc")) {include_once($inc_path."/_js.inc");} ?>
<?php if (file_exists($inc_path."/_meta.inc")) {include_once($inc_path."/_meta.inc");} ?><?php endif; ?>
<script src="/js/wview.js" type="text/javascript"></script>
<?php elseif (file_exists($inc_path."/_css.inc")): include_once($inc_path."/_css.inc"); ?>
<?php else: ?>
<link rel="stylesheet" href="/css/style.css" type="text/css">
<link rel="stylesheet" href="/css/sstyle.css" type="text/css">
<?php endif; ?>
</HEAD>
<body>
<?php include($inc_path."/_nwin.php"); ?>
</BODY>
</HTML>
