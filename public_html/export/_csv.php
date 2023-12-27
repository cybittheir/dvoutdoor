<?php

$new_file_csv=$get_year[$i]."_".$get_month[$i].".csv";

$CsvPath="files/".$client_folder."/".$new_file_csv;


reset ($this_string);

$CsvFileContentUTF=implode(";",$headers_arr)."\n".implode("\n",$this_string[$i]);

$CsvFileContent=mb_convert_encoding($CsvFileContentUTF,'windows-1251');

unset($headers_arr);

if ($CsvAddrFile=fopen($CsvPath,"w+")){

    fputs($CsvAddrFile,$CsvFileContent);
    
    fclose($CsvAddrFile);
   
    echo "<li><a href='files/".$client_folder."/".$new_file_csv."'>".$new_name."</a>";
    echo " (CSV, ";
    echo intval(filesize($CsvPath)/1024);
    echo "KB, ";
    echo date("d/m/Y, H:i",filemtime($CsvPath));
    echo ") </li>\n";

} else {
    echo "Ошибка открытия файла";
}

?>