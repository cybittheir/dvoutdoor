<?php

# Собираем XML-файл;

$FullPath="txt/";

$all_file_xml=$get_year[0]."_".$get_month[0]."-".$get_year[1]."_".$get_month[1].".xml";
$all_file_xls=$get_year[0]."_".$get_month[0]."-".$get_year[1]."_".$get_month[1].".xml.xls";
$xml_file_name=$get_year[0]."/".$get_month[0]."-".$get_year[1]."/".$get_month[1];

$XmlPath="files/".$client_folder."/".$all_file_xml;
$XlsPath="files/".$client_folder."/".$all_file_xls;

$XmlSheetHeader=" <Worksheet ss:Name=\"dvoutdoor.ru\">\n";

if (isset($TabMainName)) {$XmlMainName=$TabMainName;}
else {$XmlMainName="";}

$XmlMainName.=$all_title;

# $FirstMerge=4;

$DataDef="<Data ss:Type=\"String\">";
$NumDef="<Data ss:Type=\"Number\">";
$CellDefNum="<Cell ss:StyleID=\"s22\">".$NumDef;
$CellDef="<Cell ss:StyleID=\"s22\">".$DataDef;
$CellDefURL="<Cell ss:StyleID=\"s24\" ss:HRef=\"";
$CellDefURLEnd="\">";
$CellDefStat="<Cell ss:StyleID=\"s28\">".$DataDef;
$CellClose="</Data></Cell>";

$ExpandedRow=3+sizeof($sort_address);
$ExpandedColumn=sizeof($order); // количество колонок равно размеру массива $order

$title_field_columns=$ExpandedColumn-1; // сколько колонок объединить под заголовок

reset ($all_strings_arr);
reset ($sort_address);
asort ($sort_address);

while(list($skey,$address)=each($sort_address)){

	while(list($n,$v)=each($all_strings_arr[$skey])){

		if ($n==$order['URL'] AND !empty($v)){
			$ttt[$skey][]=$CellDefURL.$v.$CellDefURLEnd.$DataDef."сайт".$CellClose;
		}
		elseif ($n==$order['COORD'] AND !empty($v)){
			$ttt[$skey][]=$CellDefURL.$v.$CellDefURLEnd.$DataDef."GoogleMap".$CellClose;
		}
		elseif ($n==$order['XCOORD'] AND !empty($v)){
			$ttt[$skey][]=$CellDef.$v.$CellClose;
		}
		elseif ($n==$order['YCOORD'] AND !empty($v)){
			$ttt[$skey][]=$CellDef.$v.$CellClose;
		}
		elseif ($n==$order['MNTH0'] AND !empty($v) AND $v=="свободно"){
			$ttt[$skey][]=$CellDefStat.$v.$CellClose;
		}
		elseif ($n==$order['MNTH1'] AND !empty($v) AND $v=="свободно"){
			$ttt[$skey][]=$CellDefStat.$v.$CellClose;
		}
		elseif ($n==$order['NUMBER'] OR $n==$order['PRICE'] AND !empty($v)){
			$ttt[$skey][]=$CellDefNum.$v.$CellClose;
		}
		else {$ttt[$skey][]=$CellDef.$v.$CellClose;}

	}

	$XmlRows[$skey]=implode("\n",$ttt[$skey]);
}

reset($XmlRows);

$XmlAddrList="\n<Row>'n".implode("\n</Row>\n<Row>\n",$XmlRows)."\n</Row>\n";

//$XmlTableHeader.="<Row ss:StyleID=\"s26\">\n";
//$XmlTableHeader.=implode("",$XmlTableHeaderList)."   </Row>\n";

reset ($order);
asort($order);

while(list($name,$num)=each($order)){
	$XmlWorkSheetArr[]="<Column ss:AutoFitWidth=\"1\" ss:Width=\"".$field_size[$name]."\"/>";
	$XmlTableMainHeaderArr[]="<Cell ss:StyleID=\"s26\">".$DataDef.$field_name[$name].$CellClose;
}


$XmlSheetHeader.="  <Table ss:ExpandedColumnCount=\"".$ExpandedColumn."\" ss:ExpandedRowCount=\"".$ExpandedRow."\"";
$XmlSheetHeader.=" x:FullColumns=\"1\" x:FullRows=\"1\">\n";

$XmlWorkSheet=implode("\n",$XmlWorkSheetArr)."\n";

$XmlTableMainHeader="<Row>\n<Cell ss:MergeAcross=\"".$title_field_columns."\" ss:StyleID=\"s26\"><Data ss:Type=\"String\">".$all_title."</Data></Cell>\n</Row>\n";

$XmlTableHeader="<Row ss:StyleID=\"s26\">\n".implode("\n",$XmlTableMainHeaderArr)."\n</Row>\n";

// стандартные заголовки

$XMLHeadFile=file($FullPath."xmlhead.txt");
$XmlHead=implode("",$XMLHeadFile);

$CreatedD=date("Y-m-d",time());
$CreatedT=date("H:i:s",time());

$XmlHeadDoc="  <Created>".$CreatedD."T".$CreatedT."Z</Created>\n";
$XmlHeadDoc.="  <LastSaved>".$CreatedD."T".$CreatedT."Z</LastSaved>\n";
$XmlHeadDoc.="  <Version>1.0</Version>\n";
$XmlHeadDoc.=" </DocumentProperties>\n";

$XMLStylesFile=file($FullPath."xmlstyles.txt");
$XmlStyles=implode("",$XMLStylesFile);

$XMLFooterFile=file($FullPath."xmlfooter.txt");
$XmlFooter=implode("",$XMLFooterFile);

// сборка содержимого файла

$XmlFileContent=$XmlHead;
$XmlFileContent.=$XmlHeadDoc;
$XmlFileContent.=$XmlStyles;

$XmlFileContent.=$XmlSheetHeader;
$XmlFileContent.=$XmlWorkSheet;
$XmlFileContent.=$XmlTableMainHeader;
$XmlFileContent.=$XmlTableHeader;
$XmlFileContent.=$XmlAddrList;

$XmlFileContent.=$XmlFooter;

// записываем в файл XML;

if ($XmlAddrFile=fopen($XmlPath,"w+")){
    
    fputs($XmlAddrFile,$XmlFileContent);
    fclose($XmlAddrFile);

	echo "<li><a href='files/".$client_folder."/".$all_file_xml."'>".$xml_file_name."</a>";
    echo " (<b>XML</b>, ";
    echo intval(filesize($XmlPath)/1024);
    echo "KB, ";
    echo date("d/m/Y, H:i",filemtime($XmlPath));
    echo ") - открывать с помощью Excel</li>\n";

} else {echo "XML file open ERROR";}

if ($XlsAddrFile=fopen($XlsPath,"w+")){
    
    fputs($XlsAddrFile,$XmlFileContent);
    fclose($XlsAddrFile);

	echo "<li><a href='files/".$client_folder."/".$all_file_xls."'>".$xml_file_name."</a>";
    echo " (<b>XLS</b>, ";
    echo intval(filesize($XlsPath)/1024);
    echo "KB, ";
    echo date("d/m/Y, H:i",filemtime($XlsPath));
    echo ") - игнорировать предупреждение Excel, ответить Да</li>\n";

} else {echo "XLS file open ERROR";}

?>