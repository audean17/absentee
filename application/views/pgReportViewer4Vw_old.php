<?php 
	session_start();
	include_once ("report/myVar.php");
	include_once ("report/myPdoSql.php");
	//include_once ("report/myForm.php");
	include_once ("report/myPhpMethod.php");
	//$pg=new myForm("PAGE BROWSER", $_SERVER['PHP_SELF'], "150", "center", "center");
	$pg=array();
	$db=new myPdoSql($server,$database,$user,$password);

	 
	
	$pg['period_method']="period";
	
	if (strlen($rptName)>0 or $rptName<>"") {
	  $pg['rpt_id']=$rptName;	
	} else {
	  $pg['rpt_id']=$rptName;	
	}
	
	if (strlen($tahunAnggaran)>0 or $tahunAnggaran<>"") {
	  $pg['my_year']=$tahunAnggaran;	
	} else {
	  $pg['my_year']=date('Y');
	}


	if (strlen($year)>0 or $year<>"") {
	  $pg['year_date']=$year;	
	} else {
	  $pg['year_date']=date('Y');
	}

	if (strlen($month)>0 or $month<>"") {
	  $pg['month_date']=$month;	
	} else {
	  $pg['month_date']=date('m'); 
	}

    
	
	
		
	$pg['draw_report_header']=true;
?>
<script language="javascript">
	document.captureEvents(Event.KEYPRESS);
	document.onkeydown=keyJump;
	
	function keyJump(e) {
		if (e.which==27) {
			self.close();
		}
	}
	function goto_page(url) {
		location.href = url;
	}	
</script>
<html><head>
<script language="javascript1.2" src="report/myFunction.js"></script>
<title>REPORT VIEWER</title>
	<style type="text/css">	
		html, body {
			font-family:Arial, Tahoma, Century Gothic, Helvetica, sans-serif;
			font-size:11px;
			margin: 0px 0px 0px 0px;
			padding: 0px 0px 0px 0px;
			border: 0px;
			height:100%;
			cursor:default;
		}

		table.reportTable {
			font-family:Arial, Tahoma, Century Gothic, Helvetica, sans-serif;
			font-size:11px;
		}
		
		tr.rowHeader {
			font-weight:bold;
			background-color:#E2E2DB;
			color:#60605B;
			height:25px;
		}
		
		td.headerLeft, td.headerLeftU {
			text-align:left;
		}
 
 		td.headerRight, td.headerRightU {
			text-align:right;
		}
		
		td.headerLeftU, td.headerRightU {
			border-bottom:1px solid;
		}
		
		tr.rowGroup {
			height:25px;
			text-transform:uppercase;
		}
		
		td.groupLeft, td.groupLeftU {
			background-color:#E8ECB0;
			font-weight:bold;
			color:#0E005E;
			text-align:left;
		}

		td.groupRight, td.groupRightU {
			background-color:#E8ECB0;
			font-weight:bold;
			color:#0E005E;
			text-align:right;
		}
		
		td.groupLeftU, td.groupRightU {
			border-bottom:1px solid;
		}
		
		tr.rowDetail {
			height:22px;
			background-color:#FFFFFF;
		}
		
		tr.rowDetail:hover {
			background-color:#CCCCCC;
		}
		
		td {
			padding:2px 5px 2px 5px;
		}
		
		td.detailLeft, td.detailLeftU {
			text-align:left;
		}
		
		td.detailRight, td.detailRightU {
			text-align:right;
		}

		td.detailLeftU, td.detailRightU {
			border-bottom:1px dotted;
		}

		.menuGrafik {
			color:#FF0000;
			font-weight:bold;
			border-bottom:0px;
			text-decoration:none;
		}
		
		.menuGrafik:hover {
			color:#990066;
		}
		
	</style>
</head>
<body onLoad="window.focus();">
<?php

	$report_name=$report_name;
	$report_file=$pg['rpt_id'].".php";
	include_once($report_file);
	$akufau="fauzan";
	unset($pg); unset($db);
?>
<?php
	function getReportConfiguration($pg) {
		 
		$pg['rptDetailIndex']=1;
		$pg["cnfIsCrossingExist"]=false;
		
		for($i=0;$i < count($pg["rptFieldStruct"]["fieldName"]);$i++) { 
			switch ($pg['rptFieldStruct']['fieldType'][$i]) {
			case "sumint":
			case "sumcur":
			case "sumprec":
			case "sumprec4":
				$pg["cnfFieldToSummarize"][]=$pg["rptFieldStruct"]["fieldName"][$i];
				break;
			case "sumcurcross":
				$pg["cnfIsCrossingExist"]=true;
				$pg["cnfFieldToCrossing"][]=$pg["rptFieldStruct"]["fieldName"][$i];
				break;
			}
		}
	
		for($i=0;$i< count($pg['rptStruct']);$i++) { 
			$pg['rptGroup'][]=array("value"=>"NONE", "valueTitle"=>"", "drawSummary"=>0, "summary"=>array(0));
			//if (strlen($pg['rptContents'][$i]['groupBy'])==0) { $pg['rptDetailIndex']=$i; } //fauzan check lagi
			//for($ii=0;$ii< $pg->maxColLength;$ii++) { $pg->rptGroup[$i]['summary'][]=0; }
		}
	}

	function calculateCrossSummarize($fieldName) {
		global $pg;
		$tempCrossConfig=getCrossConfigName($fieldName);
		
		if (isset($pg->pv['resultCross'.$tempCrossConfig])) {
			$pg->pv['resultCross'.$tempCrossConfig]+=$pg->row[$fieldName];
		} else {
			$pg->pv['resultCross'.$tempCrossConfig]=$pg->row[$fieldName];
		}
	}

	function getCrossConfigName($fieldName) {
		global $pg;
		$tempCrossConfig="";

		for($a=0;$a< count($pg->pv['rptCrossConfig'][$fieldName]);$a++) {
			$tempCrossConfig.=$pg->row[$pg->pv['rptCrossConfig'][$fieldName][$a]];
		}

		return $tempCrossConfig;
	}
	
	function getReportHeader() {
		global $pg;
		global $db;


		$html="
			<table class=\"reportTable\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			<tr><td colspan=\"2\" style=\"font-weight:bold;\">".$pg->pv['report_name']."</td></tr>
		";


		if (isset($_REQUEST["cnfYear"])) { 
			$html.="<tr><td style=\"padding-right:5px;\">Year</td><td>: ".$pg->pv['selected_year']."</td></tr>";
		}
		
		if (isset($_REQUEST["cnfDate"])) { 
			if (strlen($pg->pv['begin_date'])<>0) { $period.=" Per "."<strong>".formatDate($pg->pv['begin_date'],"d-M-Y")."</strong>"; }
			$html.="<tr><td style=\"padding-right:5px;\">Year</td><td>: ".$period."</td></tr>";
		}
		
		if (isset($cnfDateBegin)) { 
			$period="<strong>".formatDate($pg->pv['begin_date'],"d-M-Y")."</strong>";
			$periodCaption="Period";
			if (strlen($pg->pv['end_date'])<>0) { $period.=" to "."<strong>".formatDate($pg->pv['end_date'],"d-M-Y")."</strong>"; }
			
		 
		}

		if (isset($_REQUEST["cbCnfFinPeriodBegin"])) { 
			if (strlen($pg->pv['financePeriodEnd'])==0) {
				$html.="<tr><td style=\"padding-right:5px;\">Finance Period</td><td>: <strong>".$pg->pv['financePeriodBegin']."</strong></td></tr>";
			} else {
				$html.="<tr><td style=\"padding-right:5px;\">Finance Period</td><td>: <strong>".$pg->pv['financePeriodBegin']."</strong> To <strong>".$pg->pv['financePeriodEnd']."</strong></td></tr>";
			}
		}
		
		$html.="</table>";
		
		return $html;
	}
	
	function drawReport($pg,$db) {
		//global $pg['query'];
		//global $db;
	 	$pg["cnfIsCrossingExist"]=false;
		$pg['rptGroup'][]=array();
		$rowCount=0;
		 
		getReportConfiguration($pg);
		/*
		if ($pg->pv['rptType']=="linkServer") {
			$db->conn->exec('SET ANSI_WARNINGS ON');
			$db->conn->exec('SET ANSI_NULLS ON');
		}
		*/
		$stmt = $db->conn->prepare($pg['query']);
		$stmt->execute();
		$myArray = array();
		$sortArray = array();

		while ($pg['row'] = $stmt->fetch()) {
			if ($pg["cnfIsCrossingExist"]==true) {
				for($i=0;$i < count($pg->pv["cnfFieldToCrossing"]);$i++) {
					calculateCrossSummarize($pg["cnfFieldToCrossing"][$i]);
				}
			}

	
			for($i=0;$i<count($pg['rptStruct']);$i++) {
				if (strlen($pg['rptStruct'][$i]['groupBy'])<>0) {
					if ($pg['rptGroup'][$i]['value']<>$pg['row'][$pg['rptStruct'][$i]['groupBy']]) {
						for ($a=$i;$a <= count($pg->pv['rptStruct']);$a++) {
							$pg['rptGroup'][$a]['value']="NONE";
						}
						
						$pg->rptGroup[$i]['value']=$pg->row[$pg->pv['rptStruct'][$i]['groupBy']];
						
						if ($rowCount<>0) { 
							for ($a=(count($pg->pv['rptStruct'])-$i)+1;$a >= $i;$a--) {
								if ($pg->rptGroup[$a]['drawSummary']==1) {
									$rptHtml.=getSumTagHtml($a);
									$rptHtmlSum=getSumTagHtml($a);
									$myArray[]=array("provinsi"=>$pg->row[$pg->pv['rptStruct'][$i]['groupBy']],"number"=>"summary","html"=>$rptHtmlSum);
									//echo "provinsi: ".$pg->row[$pg->pv['rptStruct'][$i]['groupBy']]." summary<br>";
									$pg->rptGroup[$a]['drawSummary']=0;
								}
							}
						}
						
						$rptHtml=getRowTagHtml($i,$pg->pv['rptStruct'][$i]['groupBy'],1);
					$rptHtmlBlank=getRowTagHtml($i,$pg->pv['rptStruct'][$i]['groupBy'],1);
				$myArray[]=array("provinsi"=>$pg->row["propinsi_name"],"number"=>"detail","html"=>$rptHtmlBlank);
									//echo "provinsi: ".$pg->row["propinsi_name"]." detail<br>";
						$pg->rptGroup[$i]['drawSummary']=1;
						
						$pg->rptGroup[$i]['valueTitle']=$pg->row[$pg->pv['rptStruct'][$i]['groupByTitle']];
						clearSummary($i);
					}
				} else {
					$rptHtml.=getRowTagHtml($i,$pg->pv['rptStruct'][$i]['groupBy'],0);
					$rptHtmlBlank=getRowTagHtml($i,$pg->pv['rptStruct'][$i]['groupBy'],0);
					$myArray[]=array("provinsi"=>$pg->row["propinsi_name"],"number"=>"detail","html"=>$rptHtmlBlank);
									//echo "provinsi: ".$pg->row["propinsi_name"]." detail<br>";
				}
				
				for($a=0;$a< count($pg->pv['rptFieldStruct']['fieldName']);$a++) {
					switch ($pg->pv['rptFieldStruct']['fieldType'][$a]) {
					case "sumint":
					case "sumprec":
					case "sumprec4":
					case "sumcur":
						$pg->rptGroup[$i]['summary'][$a] += ($pg->row[$pg->pv['rptFieldStruct']['fieldName'][$a]]);
						break;
					}
				}
				
				$rptHtml.=$tempSum;
			}
			
			$rowCount+=1;
		}
		
		$i=count($pg->pv['rptStruct'])-1;

		for ($a=$i;$a >= 0;$a--) {
			if (strlen($pg->pv['rptStruct'][$a]['groupBy'])<>0) {
				$rptHtml=getSumTagHtml($a);
				$getSumTagHtml=getSumTagHtml_b($a);/*fauzan*/
				$arrResult=explode("|",$getSumTagHtml);
	//			echo "oke: ".$arrResult[0];
				//echo $getSumTagHtml;
				//echo "test: ".$rptHtml;
				if ($arrResult[0]==1){
					$myPropinsi="   ";
				}else{
					$myPropinsi=$arrResult[0];
				}
				
				$myArray[]=array("provinsi"=>$myPropinsi,"number"=>"detail","html"=>$arrResult[1]);
									//echo "provinsi: ".$myPropinsi." detail<br>";
			
			}
		}
$rptHtml="";

/******** fauzan */
foreach($myArray as $k=>$v) {
    $sort['provinsi'][$k] = $v['provinsi'];
    $sort['number'][$k] = $v['number'];
}
/*
$sortArray = array();

foreach($people2 as $person2){
    foreach($person2 as $key=>$value){
        if(!isset($sortArray[$key])){
            $sortArray[$key] = array();
        }
        $sortArray[$key][] = $value;
    }
}
*/
array_multisort($sort['provinsi'],SORT_ASC, $sort['number'], SORT_ASC,$myArray);

for ($y=0;$y<count($myArray);$y++)
{
	//echo $myArray[$y]["provinsi"]." - ".$myArray[$y]["number"]."<br>";
	$rptHtml.= $myArray[$y]["html"];
}		
		$rptHtmlHeader=getReportHeader();
		
		if($pg->pv['draw_report_header']==true) {
			$rptHtml = "
				<center>
				<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
				<tr>
					<td>".$rptHtmlHeader."</td>
				</tr>
				<tr>
					<td>".
						"<table class=\"reportTable\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">".getDefaultColumn().$pg->rptColumnHeader.$rptHtml."</table>".
					"</td>
				</tr>
				</table>
				</center>";
		} else {
			$rptHtml = "<table class=\"reportTable\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">".getDefaultColumn().$pg->rptColumnHeader.$rptHtml."</table>";
		}
				
		return $rptHtml;
	}


		
	function getRowTagHtml($i,$groupByField,$clearCrossSummaryValue) {
		global $pg;
		if (strlen(trim($groupByField)) != 0) {
			$temp=$pg->arrTemp[$pg->pv['rptStruct'][$i]['tempIndex']];
		} else {
			$temp=$pg->arrTemp[$pg->row["rptTemplateSection"]];
			if (strlen(trim($temp))==0) { $temp=$pg->arrTemp[$pg->pv['rptStruct'][$i]['tempIndex']]; }
		}

		for($b=0;$b< count($pg->pv['rptFieldStruct']['fieldName']);$b++) {
			switch ($pg->pv['rptFieldStruct']['fieldType'][$b]) {
			case "sumcurcross":
				$tempCrossConfig=getCrossConfigName($pg->pv['rptFieldStruct']['fieldName'][$b]);
				$value=$pg->pv['resultCross'.$tempCrossConfig];
				$temp=str_replace("#".$pg->pv['rptFieldStruct']['fieldName'][$b]."#",formatValue($value,"sumcurcross"),$temp);
				break;

			default:
				$temp=str_replace("#".$pg->pv['rptFieldStruct']['fieldName'][$b]."#",formatValue($pg->row[$pg->pv['rptFieldStruct']['fieldName'][$b]],$pg->pv['rptFieldStruct']['fieldType'][$b]),$temp);
			}
		}

		return $temp;
	}

	function getSumTagHtml($i) {
		global $pg;
		
		if ($pg->pv['rptStruct'][$i]['showSummary']==true) {
			$temp=$pg->arrTemp[$pg->pv['rptStruct'][$i]['tempFooterIndex']];
			for($b=0;$b< count($pg->pv['rptFieldStruct']['fieldName']);$b++) {
				$tempIndex=$b + 1;
				$temp=str_replace("#".$pg->pv['rptFieldStruct']['fieldName'][$b]."#",formatValue($pg->rptGroup[$i]['summary'][$b],$pg->pv['rptFieldStruct']['fieldType'][$b]),$temp);
			}
	
			$temp=str_replace("#sum:".$pg->pv['rptStruct'][$i]['groupByTitle']."#",$pg->rptGroup[$i]['valueTitle'],$temp);
		} else {
			$temp="";
		}		

		return $temp;
	}

	function getSumTagHtml_b($i) {
		global $pg;
		
		if ($pg->pv['rptStruct'][$i]['showSummary']==true) {
			$temp=$pg->arrTemp[$pg->pv['rptStruct'][$i]['tempFooterIndex']];
			for($b=0;$b< count($pg->pv['rptFieldStruct']['fieldName']);$b++) {
				$tempIndex=$b + 1;
				$temp=str_replace("#".$pg->pv['rptFieldStruct']['fieldName'][$b]."#",formatValue($pg->rptGroup[$i]['summary'][$b],$pg->pv['rptFieldStruct']['fieldType'][$b]),$temp);
			}
	
			$temp=str_replace("#sum:".$pg->pv['rptStruct'][$i]['groupByTitle']."#",$pg->rptGroup[$i]['valueTitle'],$temp);
		} else {
			$temp="";
		}		

		return $pg->rptGroup[$i]['valueTitle']."|".$temp;
	}
	
	function clearSummary($i) {
		global $pg;
		
		for($a=0;$a< count($pg->pv['rptFieldStruct']['fieldName']);$a++) {
			$pg->rptGroup[$i]['summary'][$a]=0;
		}
	}
	
	function getDefaultColumn() {
		global $pg;
		
		$defaultColumn="<tr>";
		
		for($a=0;$a < count($pg->pv['columnWidth']);$a++) {
			if ($pg->pv['columnWidth'][$a]<>0) {
				$defaultColumn.="<td style=\"width:".$pg->pv['columnWidth'][$a]."px;\">&nbsp;</td>";
			} else {
				$defaultColumn.="<td>&nbsp;</td>";
			}
		}
		$defaultColumn.="</tr>";
		
		return $defaultColumn;
	}

	function formatValue2($value,$fieldType) {
		$value=trim($value);

		switch ($fieldType) {
		case "int":
		case "sumint":
			return number_format($value,0);
			break;
		case "cur":
		case "sumcur":
		case "sumcurcross":
			return number_format($value,0);
			break;
		case "prec":
		case "sumprec":
			return number_format($value,2);
			break;
		case "sumprec4":
			return number_format($value,4);
			break;
		case "date":
			if (strlen($value)<>0) {
				return str_replace("12:00AM", "", $value);
			} else {
				return "&nbsp;";
			}
			break;
		default:
			if (strlen($value)<>0) {
				return $value;
			} else {
				return "&nbsp;";
			}
		}
	}
	
	function formatDate($date, $format) {
		$date=str_replace("-","/",$date);
		$arrDate=explode("/",$date);
	
		$year = $arrDate[0];
		$month = $arrDate[1];
		$day = $arrDate[2];
		$hour = 0;
		$minute = 0;
		$second = 0;
		
		return date($format, mktime(0,0,0,$month,$day,$year));
	}
	


?>
</body>
</html>
