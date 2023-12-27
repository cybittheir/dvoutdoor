<?php

<div style='display: inline-block; position: relative; float:left;max-width:655px;text-align:left;top:0px;'>
<ul id="navmain">
<?php foreach($mmenu_item as $key=>$mitem): ?>
<li><a href=/<?=$mmenu_link[$key] ?><?php if($mmenu_class[$key]): ?> class=<?=$mmenu_class[$key] ?><?php endif; ?> target=<?=$mmenu_targ[$key] ?>><?=$mmenu_item[$key]?></a>
<?php if(isset($submenu_class[$key]) AND isset($submenu_item[$key])): ?>
<span <?php if($mmenu_class[$key]): ?>class=<?=$mmenu_class[$key] ?><?php endif; ?>>
<?php foreach($submenu_item[$key] as $skey=>$sitem): ?>
<a href=<?=$submenu_link[$key][$skey] ?><?php if($submenu_class[$key][$skey]): ?> class=<?=$submenu_class[$key][$skey] ?><?php endif; ?> target=<?=$submenu_targ[$key][$skey] ?>><?=$sitem ?></a>
<?php endforeach; ?>
</span>
<?php endif; ?>
</li>
<?php endforeach; ?>
</ul></div>


?>