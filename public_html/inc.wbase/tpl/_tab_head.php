

<table id="rounded-corner" width="100%">
<tr>

<?php
reset($tabName);
while(list($ti,$tv)=each($tabName)){
    echo "<td".$tabWidth[$ti].$tabDesc[$ti].$tabAlign[$ti]."'>&nbsp;<b>".$tv."<b>&nbsp;</td>\n";
}
?>
<td width='20px' class='clong'>&nbsp;</td>
</tr>
</table>

