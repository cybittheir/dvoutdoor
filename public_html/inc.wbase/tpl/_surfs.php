<?php include_once($inc_path."/tpl/_head.php"); ?>
<div style="position:fixed;left:0px;top:150px;right:0px;bottom:60px;">
<table width=100% border=0 cellpadding=0 cellspacing=0><tr><td colspan=2>
<div style="position:fixed;left:0px;top:120px;height:150px;overflow-y:auto;right:<?=$tright?>px;">
<div style="position:relative;padding-left:20px;padding-right:20px;">
<?php if (!empty($old_err)): ?>
<?=$old_err?><br>
<?php endif; ?>
<font size=-2><?=$SelectQue?></font>
</div>
</div>
<script language="JavaScript">
function toggle_check(aId,source) {
	if (aId=='all') {
		checkboxes = document.getElementsByTagName('input'); 
	} else {
		checkboxes = document.getElementsByName(aId); 
	}
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
}
</script>
</td></tr>

<?php 
if (isset($tpl) AND $tpl=="map"){include_once($inc_path."/map/_pre_bmap.php");}
 ?>
<?=$res_head.$res;?>
</tbody></table></div>
</td></tr></table>
</form>
