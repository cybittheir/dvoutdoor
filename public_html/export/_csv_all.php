<?php

$all_file_csv=$get_year[0]."_".$get_month[0]."-".$get_year[1]."_".$get_month[1].".csv";

$CsvPath="files/".$client_folder."/".$all_file_csv;

$new_name=$get_year[0]."/".$get_month[0]."-".$get_year[1]."/".$get_month[1];

reset ($all_strings);

$CsvFileContentUTF=implode(";",$all_headers_arr)."\n".implode("\n",$all_strings);

$CsvFileContent=mb_convert_encoding($CsvFileContentUTF,'windows-1251');

unset($all_headers_arr);

if ($CsvAddrFile=fopen($CsvPath,"w+")){

    fputs($CsvAddrFile,$CsvFileContent);
    
    fclose($CsvAddrFile);
   
    echo "<li><a href='files/".$client_folder."/".$all_file_csv."'>".$new_name."</a>";
    echo " (CSV, ";
    echo intval(filesize($CsvPath)/1024);
    echo "KB, ";
    echo date("d/m/Y, H:i",filemtime($CsvPath));
    echo ") </li>\n";

} else {
    echo "Ошибка открытия файла";
}

?>