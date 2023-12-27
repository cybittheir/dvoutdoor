<?php

    $syearlnk="";

    if (date("m",time())>11){$ryear=date("Y",time()+3600*24*31);} else {$ryear=date("Y",time());}
    if (date("m",time())<12 AND $syear==$this_year){$mchange="2";} 
    elseif (date("m",time())>11 AND $syear>$this_year) {$mchange="1";} 
    else {$mchange="";}
    
    if (isset($syear) AND !empty($syear)){$syearlnk="&year=".$syear;}
    
    if (isset($citySelected)){
    	$cityTitle=implode(", ",$citySelected);
    	if ($cityTitle!="все"){$PageTitle=$cityTitle;}
    }
    
    if (isset($syear) AND !empty($syear) AND isset($PageTitle)){
    	$PageTitle.=". 20".$syear;
    } elseif (isset($syear) AND !empty($syear)){
    	$PageTitle="20".$syear;
    }

    include ($inc_path."/_db.php");
    
    include ($inc_path."/_dbib.php");

    $qwsurf="SELECT ADB_ID,ADB_NAME,ADCONS_ID FROM Surf_List";

    $qwbsurf=mysqli_query($srf_db,$qwsurf);

    while ($srow = mysqli_fetch_array($qwbsurf)){
    	$AdbIDsurf[$srow['ADB_ID']]=$srow['ADB_ID'];
    	$AdbNAMEsurf[$srow['ADB_ID']]=$srow['ADB_NAME'];
    	$AdbCONSsurf[$srow['ADB_ID']]=$srow['ADCONS_ID'];
    }

#$exc="Cons_List.USE_BEFORE>'".date("Y-m-d",time())."'";
#if (!isset($qcitywhere) OR empty($qcitywhere)){$qcitywhere="WHERE ".$exc;}
#else {$qcitywhere.=" AND ".$exc;}

    $qwb="SELECT * FROM Cons_List 
    	LEFT JOIN csLinks ON csLinks.CONS = Cons_List.C_ID 
    	LEFT JOIN Side_List ON Side_List.SIDE_ID = csLinks.SIDE 
    	LEFT JOIN Surf_List ON Surf_List.SURFACE_ID = csLinks.SURF
    	".$qcitywhere;

 echo "<!-- !!! QUERY !!!\n".$qwb."\n -->";

?>