<?php if(isset($i)): ?>
<div style="position:fixed;left:0px;right:30px;bottom:30px;height:20px;
<table width="100%" id="pagehead">
<tbody>
<tr><td width=20>&nbsp;</td>
<td align=left>
<?php
	if (isset($_GET['show']) OR isset($_GET['new'])){
		print "<!-- подвал здесь -->\n";		
	} else {
		if (!trim($c_num)){$c_num="0";}
		if (!trim($w_num)){$w_num="0";}
		if (!trim($e_num)){$e_num="0";}
		if (!trim($r_num)){$r_num="0";}
if (isset($all_stat)){
	reset($all_stat);
	asort($all_stat);
	$list_stat="(".implode(", ",$all_stat).")";
} else{$list_stat="";}
if (isset($all_mnth)){
	reset($all_mnth);
	asort($all_mnth);
	$list_mnth="(".implode(", ",$all_mnth).")";
} else{$list_mnth="";}
if (isset($all_city)){
	reset($all_city);
	asort($all_city);
	$list_city="(".implode(", ",$all_city).")";
} else{$list_city="";}
if (isset($all_type)){
	reset($all_type);
	asort($all_type);
	$list_type="(".implode(", ",$all_type).")";
} else{$list_type="";}
if (isset($all_side)){
	reset($all_side);
	asort($all_side);
	$list_side="(".implode(", ",$all_side).")";
} else{$list_side="";}
		print "<b>Всего: </b><a href=? alt=\"показать все\" title=\"показать все\">";
		print $i."</a> ".$list_mnth;
		if ((isset($list_mnth) AND trim($list_mnth)) AND (isset($list_stat) AND trim($list_stat))) {echo "+";}
		print $list_stat."&nbsp;&nbsp;&nbsp;";
		print "<b>выбрано: </b><a href=?cshow=work alt=\"выбрано\" title=\"выбрано\">";
		print $j."</a> ".$list_side;
		if ((isset($list_side) AND trim($list_side)) AND (isset($list_type) AND trim($list_type))) {echo "+";}
		print $list_type;
		if (((isset($list_side) AND trim($list_side)) OR (isset($list_type) AND trim($list_type))) AND (isset($list_city) AND trim($list_city))) {echo "+";}
		print $list_city."&nbsp;&nbsp;&nbsp;";
		if ($iy>0){print "Поверхностей с необходимостью корректировки данных: ".$iy;}
}

?>
</td></tr>
</tbody>
</table>
</div>
<?php endif; ?>
