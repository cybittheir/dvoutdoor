<div id=03 style='display:inline-block;width:100%;height:100%;overflow:auto;'>
<table id="rounded-corner" width=100%>

<?php

if (isset($tab_row) AND is_array($tab_row)){
    reset($tab_row);

while(list($k,$arr)=each($tab_row)){
    echo "<tr>\n";
    reset($arr);
    while(list($id,$v)=each($arr)){
        if ($k==@$side_id){echo "<td".$tabWidth[$id].$tabAlign[$id]."s'>";}
        else {echo "<td".$tabWidth[$id].$tabAlign[$id]."'>";}
        if ($id=='addr'){echo "<a href='/?".$subquery."side=".$k."#".$k."' name='".$k."'>";}
        if ($k==@$side_id AND !isset($disabled[$k])){
            echo "<font color='red'>";
        } elseif ($k==@$side_id AND isset($disabled[$k])){echo "<font color='orange'>";
        } elseif (isset($disabled[$k])){echo "<font color='grey'>";
        } else {
            echo "<font color='black'>";
        }
        echo $v;
        echo "</font>";
        if ($id=='addr'){echo "</a>";}
        echo "</td>\n";
    }
    echo "</tr>\n";
}

} else {echo "<tr><td>нет результатов</td></tr>";}

?>

</table>
</div>
