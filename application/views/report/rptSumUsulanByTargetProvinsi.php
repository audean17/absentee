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
	$valReportTitle="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td colspan=\"3\" style=\"text-align:left; text-transform:uppercase; font-size:11px; font-weight:bold;font-family:Arial, Helvetica, sans-serif;\">SUMMARY REPORT REQUEST BY TARGET-PROVINSI</td>
			</tr>

			<tr>
				<td style=\"width:130px;\">&nbsp;</td>
				<td style=\"width:5px;\">&nbsp;</td>
				<td >&nbsp;</td>
			</tr>
			<tr>
				<td style=\"text-align:left;  font-size:11px; font-family:Arial, Helvetica, sans-serif;\"><a href=\"#\">Download EXCEL</a></td>
				<td style=\"text-align:left;  font-size:11px; font-family:Arial, Helvetica, sans-serif;\">&nbsp;</td>
				<td style=\"text-align:left;  font-size:11px; font-family:Arial, Helvetica, sans-serif;\">&nbsp;</td>
			</tr>

		</table>";

  	
	
	if (strlen($typeReport)>0 or $typeReport<>"") {
	  $valTypeReport="sum";	
	} else {
	  $valTypeReport="sum";	
	}	

	if (strlen($year)>0 or $year<>"") {
	  $addQuery=" and request_year='".$year."' ";	
	} else {
	  $addQuery="";
	}	

	if (strlen($provinsiId)>0 or $provinsiId<>"") {
	  $addQuery.=" and umum_propinsi_id='".$provinsiId."' ";	
	} else {
	  $addQuery.="";
	}	


	
	if (strlen($targetId)>0 or $targetId<>"") {
	  $addQuery.=" and umum_target_id='".$targetId."' ";	
	} else {
	  $addQuery.="";
	}	

	if (strlen($userName)>0 or $userName<>"") {
	  $addQuery.=" and a.request_type in ('1001','1002') ";	
	} else {
	  $addQuery.=" and a.request_type='1001' ";
	}	
	
	
	if ($c=="g") { //green
	  $addQuery.=" and adm_total_score >= 80 ";	
	} else if ($c=="y") {//yellow
	  $addQuery.=" and adm_total_score >= 60 and adm_total_score < 80 ";	
	} else if ($c=="r") { // red
	  $addQuery.=" and adm_total_score < 60 ";	
	} else {
	  $addQuery.="";
	}	
 
	if (strlen($userName)>0 or $userName<>"") {
			$valQuery="
				select '1' as group_total, count(a.request_id) as jumlah_usulan, b.propinsi_name, target_name, sum(a.umum_unit) jumlah_unit
					from tp_request2 a 
					inner join tm_propinsi b on a.umum_propinsi_id = b.propinsi_id 
					inner join tm_target_group d on a.umum_target_id=d.target_id 
					where  b.status in (1) ".$addQuery." 
					group by propinsi_name,target_name
					order by target_name DESC,group_total
				";
	//				order by group_total,propinsi_name asc,kabupaten_kota_name asc, umum_tgl_surat
	} else {
		/*
		$valQuery="
			select '1' as group_total, a.request_id,a.umum_pengusul,b.propinsi_name,a.umum_tgl_surat,a.umum_kontak_person,
c.target_name,a.umum_lokasi,a.umum_unit,a.umum_luas_lahan,adm_val_surat_pemohonan,adm_val_proposal,adm_val_surat_dukungan,adm_val_surat_pernyataan,adm_val_surat_keterangan_dinas,adm_val_sertifikat_tanah,adm_val_harga_satuan_kota,adm_val_surat_pengantar_propinsi,adm_total_score,'' as prosess_pengajuan, case when adm_total_score < 80 then 'Belum Lengkap' else 'Data Lengkap' end as result_desc, 
case when adm_total_score >= 80 then '#0ea42d' when adm_total_score >= 60 and adm_total_score < 80 then '#eef937' else '#e7172f' end as my_color_result, attachment_file_path,
case when attachment_file_path='' then 'belum ada data' else CONCAT('<a href=\"images/berkas/',attachment_file_path,'\" class=\"menuDownload\" target=\"new\">Lihat Berkas</a>') end as lihat_berkas, CONCAT('".$myProcess."',a.request_id,'".$myProcess2."') as my_link,CONCAT('<a id=\"myLink\" title=\"Prosess Pengajuan\" href=\"#\" ".$myDetail."',a.request_id,'".$myDetail2."',' class=\"menuDownload\" target=\"new\">Detail Data</a>') as my_detail,kabupaten_kota_name, case when a.request_type='1002' then '#f7ab28' else '#ffffff' end as request_type_desc, 
	case when ((adm_val_surat_pemohonan+adm_val_sertifikat_tanah+adm_val_surat_rtrw)/3) =100 then '#0ea42d' else '#eef937' end as col_syarat,      
	case when ((adm_val_surat_pemohonan+adm_val_sertifikat_tanah+adm_val_surat_rtrw)/3) =100 then 'OK' else 'NO' end as val_syarat,      
	case when ((adm_val_surat_pemohonan+adm_val_sertifikat_tanah+adm_val_surat_rtrw)/3) <>100 then 'Belum Vertek' else case when is_vertek=1 then 'Sudah Vertek' else 'Siap Vertek' end end as status_vertek,
 case when is_vertek=0 then '#ffffff' else case when val_vertek=1 then '#0ea42d' else '#eef937' end end as col_vertek,
 case when is_vertek=0 then '' else case when val_vertek=1 then CONCAT('OK',', ',desc_vertek) else CONCAT('NO',', ',desc_vertek) end end as val_vertek       
				from tp_request2 a 
				inner join tm_propinsi b on a.umum_propinsi_id = b.propinsi_id 
				inner join tm_kabupaten_kota d on a.umum_kabupaten_kota_id=d.kabupaten_kota_id 
				inner join tm_target_group c on a.umum_target_id = c.target_id 
				where  b.status in (1) ".$addQuery." and is_process=0 
				order by propinsi_name DESC,group_total
			";
			*/
//				order by group_total,propinsi_name asc,kabupaten_kota_name asc, umum_tgl_surat
	}	

	
		
	
	$valQueryFilter="";
	$valArrRptFieldStructFieldName="group_total,propinsi_name,target_name,jumlah_usulan,jumlah_unit";
	$valArrRptFieldStructFieldType="string,string,string,sumint,sumint";
	$valArrRptStructGroup0="group_total,group_total,colGroup0,colSum0,true";
	$valArrRptStructGroup1="target_name,target_name,colGroup1,colSum1,true";
	$valArrRptStructGroup2="";
	$valArrRptStructGroup3="";

	if (strlen($userName)>0 or $userName<>"") {
			$valArrColumnWidth="220,100,100";
		
			$valRptColumnHeader="
				<tr class=\"rowHeader\">
						<td class=\"headerLeft\" colspan=\"3\" style=\"border-left:1px solid; border-right:1px solid; border-top:1px solid;\">TARGET/PERUNTUKAN</td>
					</tr>
					<tr class=\"rowHeader\">
						<td class=\"headerLeftU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" >Provinsi</td>
						 
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;\" >Jumlah Usulan</td>
						
			<td class=\"headerRightU\" style=\"border-left:1px solid;border-right:1px solid;border-top:1px solid;\">Jumlah Unit</td>

		</tr>";
			
			$valArrTempColGroup0="";	
			$valArrTempColGroup1="";	
			$valArrTempColGroup2="";	
			$valArrTempColGroup3="";	
			
			
			$valArrTempColDet1="
				<tr class=\"rowDetail\" >
						<td style=\"border-left:1px solid;text-align:center;\" class=\"detailLeftU\" >#propinsi_name#</td>
						 
						<td class=\"detailRightU\"  style=\"border-left:1px solid;\">#jumlah_usulan#</td>
						 
						<td class=\"detailRightU\" style=\"border-right:1px solid;border-left:1px solid;\">#jumlah_unit#</td>
					</tr>";
 			$valArrTempColSum0=" 		
				<tr class=\"rowGroup\">
						<td style=\"border-left:1px solid; background-color:#629C0C;\" class=\"groupLeftU\" >TOTAL</td>
						<td style=\"background-color:#629C0C;\" class=\"groupRightU\" >#jumlah_usulan#</td>
							<td class=\"groupRightU\" style=\"border-right:1px solid;  border-left:1px solid;background-color:#629C0C;\" >#jumlah_unit#</td>
					</tr>";	
				
			$valArrTempColSum1="<tr class=\"rowGroup\">
						<td style=\"border-left:1px solid; background-color:#9FBC74;\" class=\"groupLeftU\"  >#sum:target_name#</td>
						<td style=\"background-color:#9FBC74;\" class=\"groupRightU\" >#jumlah_usulan#</td>
							<td class=\"groupRightU\" style=\"border-right:1px solid;  border-left:1px solid;background-color:#9FBC74;\" >#jumlah_unit#</td>
					</tr>";	
			$valArrTempColSum2="";	
			$valArrTempColSum3="";	
	}else{
			/*
			$valArrColumnWidth="120,220,80,80,260,35,60,35,35,35,60,60";
		
			$valRptColumnHeader="
				<tr class=\"rowHeader\">

						<td class=\"headerLeft\" colspan=\"12\" style=\"border-left:1px solid; border-right:1px solid; border-top:1px solid;\">NAMA PROPINSI</td>
					</tr>
					<tr class=\"rowHeader\">
						<td class=\"headerLeftU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Kabupaten</td>
						<td class=\"headerLeftU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Pengusul</td>
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Kontak Person</td>
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Target Group</td>
			</td>
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Lokasi</td>
						
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Unit</td>
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Luas Lahan</td>
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" colspan=\"3\">Nilai Verifikasi</td>
						<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Status<br>Vertek</td>
						<td class=\"headerRightU\" style=\"border-right:1px solid;border-left:1px solid;border-top:1px solid;text-align:center;\" rowspan=\"2\">Lihat Dokument</td></tr>
		<tr class=\"rowHeader\">
			<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\">SYARAT</td>
			<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\">VERMIN</td>
			<td class=\"headerRightU\" style=\"border-left:1px solid;border-top:1px solid;text-align:center;\">VERTEK</td>

		</tr>";
			
			$valArrTempColGroup0="";	
			$valArrTempColGroup1="";	
			$valArrTempColGroup2="";	
			$valArrTempColGroup3="";	
			$valArrTempColDet1="";
			
			$valArrTempColDet1="<tr class=\"rowDetail\" #my_link# style=\"cursor:pointer; background-color:#request_type_desc#;\">
						<td style=\"border-left:1px solid;text-align:center;\" class=\"detailLeftU\" >#kabupaten_kota_name#</td>
						<td style=\"border-left:1px solid;text-align:center;\" class=\"detailLeftU\" >#umum_pengusul#</td>
						<td class=\"detailLeftU\" style=\"border-left:1px solid;\">#umum_kontak_person#</td>
						<td class=\"detailLeftU\"  style=\"border-left:1px solid;\">#target_name#</td>
						<td class=\"detailLeftU\"  style=\"border-left:1px solid;\">#umum_lokasi#</td>
						<td class=\"detailRightU\"  style=\"border-left:1px solid;\">#umum_unit#</td>
						<td class=\"detailRightU\"  style=\"border-left:1px solid;\">#umum_luas_lahan#</td>
						<td class=\"detailRightU\"  style=\"border-left:1px solid;background-color:#col_syarat#;text-align:center;\">#val_syarat#</td>
						<td class=\"detailRightU\"  style=\"border-left:1px solid;background-color:#my_color_result#;text-align:center;\">c</td>
						<td class=\"detailRightU\"  style=\"border-left:1px solid;background-color:#col_vertek#;text-align:center;\">#val_vertek#</td>
						<td class=\"detailLeftU\"  style=\"border-left:1px solid;\">#status_vertek#</td>
						<td class=\"detailLeftU\" style=\"border-right:1px solid;border-left:1px solid;\">#my_detail#</a></td>
					</tr>";
				$valArrTempColSum0="		
					<tr class=\"rowGroup\">
						<td style=\"border-left:1px solid; background-color:#629C0C;\" class=\"groupLeftU\"  colspan=\"5\">TOTAL</td>
						<td style=\"background-color:#629C0C;\" class=\"groupRightU\" >#umum_unit#</td>
							<td class=\"groupRightU\" style=\"border-right:1px solid;  border-left:1px solid;background-color:#629C0C;\" colspan=\"7\">&nbsp;</td>
					</tr>";
			
				$valArrTempColSum1="		
					<tr class=\"rowGroup\">
						<td style=\"border-left:1px solid; background-color:#9FBC74;\" class=\"groupLeftU\"  colspan=\"5\">#sum:propinsi_name#</td>
						<td style=\"background-color:#9FBC74;\" class=\"groupRightU\" >#umum_unit#</td>
							<td class=\"groupRightU\" style=\"border-right:1px solid;  border-left:1px solid;background-color:#9FBC74;\" colspan=\"7\">&nbsp;</td>
					</tr>";
			
				$valArrTempColSum2="		
					<tr class=\"rowGroup\">
						<td style=\"border-left:1px solid; background-color:#bfd3a1;\" class=\"groupLeftU\"  colspan=\"4\">#sum:kabupaten_kota_name#</td>
						<td style=\"background-color:#bfd3a1;\" class=\"groupRightU\" >#umum_unit#</td>
							<td class=\"groupRightU\" style=\"border-right:1px solid;  border-left:1px solid;background-color:#bfd3a1;\" colspan=\"5\">&nbsp;</td>
					</tr>"; 	
			$valArrTempColSum3="";	
			*/
	
	}
	
	$arrParameterFilter="";
	$param = array('scd'=>'fauzan.net','reportName'=>$valReportName,'reportTitle'=>$valReportTitle,'query'=>$valQuery,'queryFilter'=>$valQueryFilter,'arrRptFieldStructFieldName'=>$valArrRptFieldStructFieldName,'arrRptFieldStructFieldType'=>$valArrRptFieldStructFieldType,'arrRptStructGroup0'=>$valArrRptStructGroup0,'arrRptStructGroup1'=>$valArrRptStructGroup1,'arrRptStructGroup2'=>$valArrRptStructGroup2,'arrRptStructGroup3'=>$valArrRptStructGroup3,'arrColumnWidth'=>$valArrColumnWidth,'rptColumnHeader'=>$valRptColumnHeader,'arrTempColGroup0'=>$valArrTempColGroup0,'arrTempColGroup1'=>$valArrTempColGroup1,'arrTempColGroup2'=>$valArrTempColGroup2,'arrTempColGroup3'=>$valArrTempColGroup3,'arrTempColDet1'=>$valArrTempColDet1,'arrTempColSum0'=>$valArrTempColSum0,'arrTempColSum1'=>$valArrTempColSum1,'arrTempColSum2'=>$valArrTempColSum2,'arrTempColSum3'=>$valArrTempColSum3,'typeReport'=>$valTypeReport,'arrParameterFilter'=>$arrParameterFilter);
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