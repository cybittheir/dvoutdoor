<div>
<?php while(list($lk,$lv)=each($left_info)):?>
&nbsp;<a href="javascript:wwopen('/<?=$ssub?>/?info=<?=$lk?>','admin','500','900')"><?=$lv?></a><br>
<?php endwhile;?>
<?php while(list($llk,$llv)=each($left_link)):?>
&nbsp;<a href="<?=$llk?>" target=_blank><?=$llv?></a><br>
<?php endwhile;?>
</div>
