<?php
//	include_once ("report/myPhpMethod.php");
//	include_once ("report/myQuery.php");
//	include_once ("report/myForm.php");
//	include_once ("report/myVar.php");
//	include_once ("report/myPdo.php");



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
<script language="javascript1.2" src="include/myFunction.js"></script>
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

$err = $this->client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}
	
	$valReportName="ini dari web service";
	$valReportTitle="JUDUL LAPORAN";
	$valQuery="select 1 as group_total, a.* from tbl_lokasi a";
	$valQueryFilter="";
	$valArrRptFieldStructFieldName="group_total,KodeLokasi,NamaLokasi,StatusProduksi";
	$valArrRptFieldStructFieldType="int,string,string,sumint";
	$valArrRptStructGroup0="group_total,group_total,colGroup0,colSum0,true";
	$valArrRptStructGroup1="";
	$valArrRptStructGroup2="";
	$valArrRptStructGroup3="";
	$valArrColumnWidth="100,200,50";
	$valRptColumnHeader="";
	
	$valRptColumnHeader="
		<tr class=\"rowHeader\">
			<td class=\"headerLeftU\" style=\"border-left:1px solid;border-top:1px solid;\">Kode Lokasi</td>
			<td class=\"headerLeftU\" style=\"border-top:1px solid;\">NAMA LOKASI</td>
			<td class=\"headerRightU\" style=\"border-right:1px solid;border-left:1px solid;border-top:1px solid;text-align:center;\">Status</td>
		</tr>";
	
	$valArrTempColGroup0="";	
	$valArrTempColGroup1="";	
	$valArrTempColGroup2="";	
 	$valArrTempColGroup3="";	
	$valArrTempColDet1="";
	$valArrTempColSum0=" ";
	
	$valArrTempColDet1="
		<tr class=\"rowDetail\">
			<td style=\"border-left:1px solid;\" class=\"detailLeftU\" >#KodeLokasi#</td>
			<td class=\"detailLeftU\" >#NamaLokasi#</td>
			<td class=\"detailRightU\" style=\"border-right:1px solid;border-left:1px solid;\">#StatusProduksi#</td>
		</tr>";
	$valArrTempColSum0=" 		
		<tr class=\"rowGroup\">
			<td style=\"border-left:1px solid; background-color:#9FBC74;\" class=\"groupleftU\"  colspan=\"2\">TOTAL</td>
			<td class=\"groupRightU\" style=\"border-right:1px solid;  border-left:1px solid;background-color:#9FBC74;\">#StatusProduksi#</td>
		</tr>";	
		
	$valArrTempColSum1="";	
	$valArrTempColSum2="";	
 	$valArrTempColSum3="";	
 
	
	$arrParameterFilter="";
	$param = array('scd'=>'fauzan.net','reportName'=>$valReportName,'reportTitle'=>$valReportTitle,'query'=>$valQuery,'queryFilter'=>$valQueryFilter,'arrRptFieldStructFieldName'=>$valArrRptFieldStructFieldName,'arrRptFieldStructFieldType'=>$valArrRptFieldStructFieldType,'arrRptStructGroup0'=>$valArrRptStructGroup0,'arrRptStructGroup1'=>$valArrRptStructGroup1,'arrRptStructGroup2'=>$valArrRptStructGroup2,'arrRptStructGroup3'=>$valArrRptStructGroup3,'arrColumnWidth'=>$valArrColumnWidth,'rptColumnHeader'=>$valRptColumnHeader,'arrTempColGroup0'=>$valArrTempColGroup0,'arrTempColGroup1'=>$valArrTempColGroup1,'arrTempColGroup2'=>$valArrTempColGroup2,'arrTempColGroup3'=>$valArrTempColGroup3,'arrTempColDet1'=>$valArrTempColDet1,'arrTempColSum0'=>$valArrTempColSum0,'arrTempColSum1'=>$valArrTempColSum1,'arrTempColSum2'=>$valArrTempColSum2,'arrTempColSum3'=>$valArrTempColSum3,'arrParameterFilter'=>$arrParameterFilter);
	$result = $this->client->call('requestReport',array($param));

if (!empty($result)) {
	
		try {
 
			foreach ($result as $item) {
					//echo "<br>myResult: ". $item['myResult'];
					echo $item['myHtml'];
					//echo "<br>myStatus: ". $item['myStatus'];
				
				}
		} catch (Exception $e) {
			//$db->rollBack();
	
			//raiseError("errorPage.php",$e->getMessage(),"Try to process data (Save, Update or Delete)",$query,"1");
		}

}

?>
</body>
</html>