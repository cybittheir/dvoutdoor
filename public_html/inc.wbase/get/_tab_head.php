<?php

$tab_list_q="SELECT * FROM _TAB_BILL ORDER BY field_order ASC";

$tab_list=mysqli_query($odb,$tab_list_q);

while ($trec=mysqli_fetch_array($tab_list)){

    $tabName[$trec['field_ind']]=$trec['field_name'];
    $tabOrder[$trec['field_ind']]=$trec['field_order'];
    if(!empty($trec['field_w'])) {$tabWidth[$trec['field_ind']]=" width='".$trec['field_w']."px'";}
    else {$tabWidth[$trec['field_ind']]="";}
    $tabSort[$trec['field_ind']]=$trec['field_sort'];
    if(!empty($trec['field_c'])) {$tabAlign[$trec['field_ind']]=" class='clong";}
    else {$tabAlign[$trec['field_ind']]=" class='long";}
    $tabHide[$trec['field_ind']]=$trec['field_hide'];
    $tabDesc[$trec['field_ind']]=" alt='".$trec['field_description']."' title='".$trec['field_description']."'";

}

?>
