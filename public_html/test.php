<?php

$quality=80;

$neww=1800;
$newh=900;

$infile="pics/0/0/1/test.00.jpg";
$outfile="pics/0/0/1/__test.00.jpg";

# imageresize_fullsize($outfile,$infile,$neww,$newh,$quality);

$neww=400;
$newh=200;

imageresize_preview($outfile,$infile,$neww,$newh,$quality);

echo "<br><img src='".$outfile."'>";

function imageresize_preview($outfile,$infile,$neww,$newh,$quality) {


	$im=imagecreatefromjpeg($infile);
	
    $k1=$neww/imagesx($im);
	$k2=$newh/imagesy($im);


    $k0=imagesy($im)/imagesx($im);

    if ($k0>1){
	    $k=$k1>$k2?$k2:$k1;
	} elseif($k0<0.5) {
		$k=$k2;
	} else {
		$k=$k1;
	}

	$w=intval(imagesx($im)*$k);
	$h=intval(imagesy($im)*$k);

$im1=imagecreatetruecolor($w,$h);

    if ($h>$newh AND $w==$neww){
        $hn=$newh;$wn=$w;
        $sx=imagesx($im);
        $sy=imagesx($im)/2;
    }
    elseif($h==$newh AND $w>$neww) {
        $hn=$h;$wn=$neww;
        $sy=imagesy($im);
        $sx=imagesy($im)*2;
    }
    else {
        $hn=$h;$wn=$w;
        $sy=imagesy($im);
        $sx=imagesx($im);
    };

    imagecopyresampled($im1,$im,0,0,0,0,$wn,$hn,$sx,$sy);
    
    $im2 = imagecrop($im1, ['x' => 0, 'y' => 0, 'width' => $wn, 'height' => $hn]);

//    echo "<b>".$k0." <> ".$k." : </b>".imagesx($im).":".imagesy($im)." / ".$sx.":".$sy." / ".$wn."(".$w.")".":".$hn."(".$h.")"."\n<br>\n";

    imagejpeg($im2,$outfile,$quality);
	imagedestroy($im);
	imagedestroy($im1);
	imagedestroy($im2);
}

function imageresize_fullsize($outfile,$infile,$neww,$newh,$quality) {


	$im=imagecreatefromjpeg($infile);
	
    $k1=$neww/imagesx($im);
	$k2=$newh/imagesy($im);


    $k0=imagesy($im)/imagesx($im);

    if ($k0>1){
	    $k=$k1>$k2?$k2:$k1;
	} elseif($k0<0.5) {
		$k=$k2;
	} else {
		$k=$k1;
	}

	$w=intval(imagesx($im)*$k);
	$h=intval(imagesy($im)*$k);

$im1=imagecreatetruecolor($w,$h);

    if ($h>200 AND $w==400){
        $hn=200;$wn=$w;
        $sx=imagesx($im);
        $sy=imagesx($im)/2;
    }
    elseif($h==200 AND $w>400) {
        $hn=$h;$wn=400;
        $sy=imagesy($im);
        $sx=imagesy($im)*2;
    }
    else {
        $hn=$h;$wn=$w;
        $sy=imagesy($im);
        $sx=imagesx($im);
    };

    imagecopyresampled($im1,$im,0,0,0,0,$wn,$hn,$sx,$sy);
    
    $im2 = imagecrop($im1, ['x' => 0, 'y' => 0, 'width' => $wn, 'height' => $hn]);

//    echo "<b>".$k0." <> ".$k." : </b>".imagesx($im).":".imagesy($im)." / ".$sx.":".$sy." / ".$wn."(".$w.")".":".$hn."(".$h.")"."\n<br>\n";

    imagejpeg($im2,$outfile,$quality);
	imagedestroy($im);
	imagedestroy($im1);
	imagedestroy($im2);
}

?>