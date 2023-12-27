<?php

function imageresize($outfile,$infile,$neww,$newh,$quality) { // не используется?

//	echo "!!!!!!!!!!!!!!!";

	$im=imagecreatefromjpeg($infile);
	$k1=$neww/imagesx($im);
	$k2=$newh/imagesy($im);
	if (imagesy($im)/imagesx($im)>1){
	    $k=$k1>$k2?$k2:$k1;
	} else {
		$k=$k1;
	}

	$w=intval(imagesx($im)*$k);
	$h=intval(imagesy($im)*$k);

	$im1=imagecreatetruecolor($w,$h);
	imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

	imagejpeg($im1,$outfile,$quality);
	imagedestroy($im);
	imagedestroy($im1);
}

function imageresize_preview($infile,$outfile=FALSE) {

	$neww=400;
	$newh=200;
	$quality=80;

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

#	    echo $infile."\n====\n<b>".$k0." <> ".$k." : </b>".imagesx($im).":".imagesy($im)." / ".$sx.":".$sy." / ".$wn."(".$w.")".":".$hn."(".$h.")"."\n<br>\n";

	if($outfile==FALSE){

		$outfile=str_replace('fullsize.','preview.',$infile);
	
	}

	imagejpeg($im2,$outfile,$quality);

	imagedestroy($im);
	imagedestroy($im1);
	imagedestroy($im2);

}

/*
function GetImage($side_index){

	$preview_list=GetListFiles(get_folders($side_index),'preview','jpg');

}
*/

?>