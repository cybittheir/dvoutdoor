<?php

function get_site_img($page_url,$num,$tag_separate){
	$pictx = stream_context_create(array('http' => array('timeout' => 1)));
	$pictemp=@file_get_contents($page_url,$num,$pictx);
	if (!empty($pictemp) AND is_array($tag_separate)){
		$ImgSiteTMP=explode($tag_separate[0],$pictemp);
		unset ($pictemp);
		if (isset($ImgSiteTMP[1])){
			$ImgSite=explode($tag_separate[1],$ImgSiteTMP[1]);
			$img_result[0]=$ImgSite[0];
			$ImgSite2=str_replace(".preview","",$ImgSite[0]);
			$img_result[1]=str_replace(".thumbnail","",$ImgSite2);
		  return $img_result;
		}
  } elseif(!empty($pictemp)){unset ($pictemp);return TRUE;} 
	else {return FALSE;}
}

?>