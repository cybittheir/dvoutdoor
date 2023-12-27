<?php

function GetPath($type=""){
    
    $comm_path="inc.common";
    $inc_path="inc.wbase";
    
    if (empty($type)) {return FALSE;}
    elseif($type=='common' OR $type=='comm'){return $comm_path;}
    elseif($type=='selected' OR $type=='inc' OR $type=='part'){return $inc_path;}
    else {
        return FALSE;
    }
    
}

function GetListFiles($folder,$mask=FALSE,$ext=FALSE,$ex_mask=FALSE){
/*
result[1] = array of pathes and filenames
result[2] = array of sizes in bytes
result[3] = array of timecodes

*/

    if (empty($mask)){$mask=FALSE;}

#    if (empty($ext_arr)){$ext=FALSE;}

    if (file_exists($folder) AND $fp=opendir($folder)){

        while($cv_file=readdir($fp)) {

            if(is_file($folder."/".$cv_file)) {

                if (!($mask) AND !($ext)){

                    $all_files[1][]=$folder."/".$cv_file;
                    $all_files[2][]=filesize($folder."/".$cv_file);
                    $all_files[3][]=filemtime($folder."/".$cv_file);

                } else {

                    $addflag=1;

                    if ($mask!=false AND sizeof(explode($mask,$cv_file))==1){$addflag="";}
                    if ($ex_mask!=false AND sizeof(explode($ex_mask,$cv_file))>1){$addflag="";}
                    if ($ext!=false AND $ext!=GetFileExtention($cv_file)){$addflag="";}

                    if ($addflag==1){

//                        echo "<!-- [".$ext."]".GetFileExtention($cv_file)." ->\n\n";

                        $all_files[1][]=$folder."/".$cv_file;
                        $all_files[2][]=filesize($folder."/".$cv_file);
                        $all_files[3][]=filemtime($folder."/".$cv_file);
                    }
                }
            } elseif ($cv_file!="." && $cv_file!=".." && is_dir($folder."/".$cv_file)){
                $addflag=1;

                if (($mask) AND sizeof(explode($mask,$cv_file))==1){$addflag="";}

                if ($addflag==1){
                    $all_files[0][]=$folder."/".$cv_file;
                }
            }
        }
        closedir($fp);

    } else {return false;}

    if (isset($all_files)){return($all_files);}
    else {return false;}
}


function GetFileExtention($filename){

    $tmp_filename=str_replace("\\","/",$filename);
    $filepath_arr=explode("/",trim($tmp_filename));

    $filename_only=$filepath_arr[sizeof($filepath_arr)-1];
    $ext_arr=explode(".",trim($filename_only));

    if(sizeof($ext_arr)>1){
        $ext=$ext_arr[sizeof($ext_arr)-1];
        return $ext;
    } else {return false;}

}

function GetFileSize($filepath="",$full=true,$base_range=0){
    if (!empty($filepath) AND file_exists($filepath)){
        
        $sname_base="Байт";
        
        $bytesize=filesize($filepath);

        if ($bytesize<0){
            $fsize=0;
            $sname="> 2 Г".$sname_base;
            $range=9;
        } elseif ($bytesize/1024<1){
            $fsize=$bytesize;
            $range=0;
        } elseif ($bytesize/1024/1024<1){
            $fsize=$bytesize/1024;
            $sname="К".$sname_base;
            $range=1;
        } elseif ($bytesize/1024/1024/1024<1){
            $fsize=$bytesize/1024/1024;
            $sname="М".$sname_base;
            $range=2;
        } else {
            $fsize=$bytesize/1024/1024/1024;
            $sname="Г".$sname_base;
            $range=3;
        }

        if (round($fsize,2)>0){$print_size=round($fsize,2)." ".$sname;}
        else {$print_size=$sname;}

        return $print_size;

    } else {
        return FALSE;
    }
}

function addVarLog($inc_path,$compid,$log_txt,$err=""){
    $mode=0777;

    $log_year=date("Y",time());

    if (empty($err)){
        $log_to="records.log";
    } else {
        $log_to="errors.log";
    }

    $log_year_path=$inc_path."/logs/".$log_year.".".$compid."/".$log_to;

    $LogFile=fopen($log_file,"a+");
	fputs($LogFile,$log_txt);
	fclose($LogFile);
}

function get_folders($side_id){

    $folder_100=intval(intval($side_id)/100);
    $folder_10=intval((intval($side_id)-$folder_100*100)/10);

    return $folder_100."/".$folder_10."/".$side_id;

}

function get_folders_arr($side_id,$dec=''){


    $folder[100]=intval(intval($side_id)/100);
    $folder[10]=intval((intval($side_id)-$folder[100]*100)/10);
    $folder[1]=$side_id;

	if (!empty($dec) AND isset($folder[$dec])) {return $folder[$dec];}
	else {return $folder;}

}

function GetLastImage($side_index){ // не используется?
#    echo "!!!!!!!!!!!!!!!<br>++++++++++++++<br>";
    $pics_root="pics/";

    $preview_list=GetListFiles($pics_root.get_folders($side_index),'preview','jpg');

    $timelist=$preview_list[3];

    arsort($timelist);

    while(list($k,$v)=each($timelist)){

        if (!empty($preview_list[1][$k])){

            $last_image['preview']=$preview_list[1][$k];

            $show_image['preview']=str_replace($pics_root,'',$last_image['preview']);

            $full_img_name=str_replace('preview.','fullsize.',$last_image['preview']);

            if (file_exists($full_img_name)) {
                $last_image['full']=$full_img_name;
                $show_image['full']=str_replace($pics_root,'',$last_image['full']);
                
                imageresize("__".$outfile,$full_img_name,'400','200','90');

            } else {

                $full_img_name=str_replace('preview.','',$last_image['preview']);

                if (file_exists($full_img_name)) {
                    $last_image['full']=$full_img_name;
                    $show_image['full']=str_replace($pics_root,'',$last_image['full']);
                }
            }
            
            break;
        }
    }


    if (isset($show_image)){return $show_image;}
    else {return FALSE;}

}

function GetImageList($side_index){

    $pics_root="pics/";

    $fullsize_list=GetListFiles($pics_root.get_folders($side_index),'fullsize.','jpg');

    $timelist=$fullsize_list[3];

    arsort($timelist);

    $list_num=0;

    while(list($k,$v)=each($timelist)){

        if (!empty($fullsize_list[1][$k]) AND is_file($fullsize_list[1][$k])){

            $last_image['preview']=str_replace('fullsize.','preview.',$fullsize_list[1][$k]);

            $show_image[$list_num]['preview']=str_replace($pics_root,'',$last_image['preview']);

            $full_img_name=str_replace('preview.','fullsize.',$last_image['preview']);

            if (file_exists($full_img_name)) {
                $last_image['full']=$full_img_name;
                $show_image[$list_num]['full']=str_replace($pics_root,'',$last_image['full']);

                if(!file_exists($last_image['preview'])){
#                    echo $last_image['preview'];
                    imageresize_preview($last_image['full']);
                }

            } else {

                $full_img_name=str_replace('preview.','',$last_image['preview']);

                if (file_exists($full_img_name)) {
                    $last_image['full']=$full_img_name;
                    $show_image[$list_num]['full']=str_replace($pics_root,'',$last_image['full']);
                }
            }

            $list_num++;
            
        }
    }


    if (isset($show_image)){return $show_image;}
    else {return FALSE;}

}

function GetImageList_preview($side_index){

    $pics_root="pics/";

    $preview_list=GetListFiles($pics_root.get_folders($side_index),'preview','jpg');

    $timelist=$preview_list[3];

    arsort($timelist);

    $list_num=0;

    while(list($k,$v)=each($timelist)){

        if (!empty($preview_list[1][$k]) AND is_file($preview_list[1][$k])){

            $last_image['preview']=$preview_list[1][$k];

            $show_image[$list_num]['preview']=str_replace($pics_root,'',$last_image['preview']);

            $full_img_name=str_replace('preview.','fullsize.',$last_image['preview']);

            if (file_exists($full_img_name)) {
                $last_image['full']=$full_img_name;
                $show_image[$list_num]['full']=str_replace($pics_root,'',$last_image['full']);

            } else {

                $full_img_name=str_replace('preview.','',$last_image['preview']);

                if (file_exists($full_img_name)) {
                    $last_image['full']=$full_img_name;
                    $show_image[$list_num]['full']=str_replace($pics_root,'',$last_image['full']);
                }
            }

            $list_num++;
            
        }
    }


    if (isset($show_image)){return $show_image;}
    else {return FALSE;}

}

function ArchiveImageList($side_index){

    $pics_root="pics/";

    $fullsize_list=GetListFiles($pics_root.get_folders($side_index),'fullsize.','jpg');

    $timelist=$fullsize_list[3];

    arsort($timelist);

    $list_num=0;

    $arr_size=sizeof($timelist);

    foreach($timelist as $k=>$v){

        if ($list_num>0) {

            if (!empty($fullsize_list[1][$k]) AND is_file($fullsize_list[1][$k])){

                $last_image['preview']=str_replace('fullsize.','preview.',$fullsize_list[1][$k]);

                $full_img_name=str_replace('preview.','fullsize.',$last_image['preview']);


                if (file_exists($full_img_name)) {

                    if (filemtime($full_img_name)<(time()-3600*24*365)){

                        $bakImgName=str_replace(".jpg",".bak",$full_img_name);
                    
                        rename($full_img_name,$bakImgName);

                        $bakPreViewName=str_replace(".jpg",".bak",$last_image['preview']);

                        if(file_exists($last_image['preview'])){

                            $previewName=$last_image['preview'];

                            rename($previewName,$bakPreViewName);

                        }

                    }

                }
            
            }

        }

        $list_num++;
//        $arr_size=$arr_size-1;

//        if ($arr_size==1){break;}

    }

}

?>