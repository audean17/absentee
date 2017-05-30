<?php
	$dbtype="mysql";

 
	$dbtype="mssql";
	$server="localhost";
	$server190="localhost";
	$database="db_my_home";
	$databaseBersama="db_my_home";
	$databaseProteksindo="db_my_home";
	$user="root";
	$password="spasi5x!";



	$sizeImageMax=2000000;
	$setValidationPassword = 1;
    $TanggalTerakhirCoding="01 feb 2009";	

	$v_yesNo_id=array('1','0');
	$v_yesNo=array('Yes','No');

	$v_okNo_id=array('1','0');
	$v_okNo=array('OK','NO');

	$v_status_id=array('1','0');
	$v_status=array('Used','Un-Used');
	
	$v_align_id=array('0','1','2');
	$v_align=array('Left','Center','Right');
	

	$login_error_page="pgLoginErrorVw.php";
	$login_validation_page="incloginValidationVw.php";



		$vPublicSession="fauzan";

/*setting Email*/


	$emailSender=base64_decode("YWRtaW5AbWVrYXJ0dWFpLmNvbQ==");
	$namaSender=base64_decode("QWRtaW4gTWVrYXJ0dWFp");
	$passwordEmail=base64_decode("TVRFbnRAMzI0NDE=");
	$emailSmtp=base64_decode("bWFpbC5tZWthcnR1YWkuY29t");

	$v_process_id=array('0','1');
	$v_process=array('kembalikan ke tahun anggaran pengajuan','di proses ke tabel usulan');

	
	$v_10_def2_id=array('0','100');
//	$v_10=array('0%','5%','10%');
	$v_10_def2=array('0% (tidak ada)','100% (ada)');

/*
	$v_10_def_id=array('0','5','10');
	$v_10_def=array('0% (tidak ada)','5% (tidak sesuai format)','10% (Sesuai format)');

	$v_10_harga_satuan_id=array('0','5','10');
	$v_10_harga_satuan=array('0% (tidak ada)','5% (tidak ada tandatangan & cap resmi dari dinas terkait)','10% (tandatangan & cap resmi dari dinas terkait)');

	$v_20_pengantar_prov_id=array('0','5','10');
	$v_20_pengantar_prov=array('0% (tidak ada)','5% (tidak ada tandatangan kadis/tingkat I Prov terkait mengenai perumahan)','10% (tandatangan Gubernur)');
*/

	$v_20_def_id=array('0','10','20');
	$v_20_def=array('0% (tidak ada)','10% (tidak sesuai format)','20% (Sesuai format)');

	$v_20_harga_satuan_id=array('0','10','20');
	$v_20_harga_satuan=array('0% (tidak ada)','10% (tidak ada tandatangan & cap resmi dari dinas terkait)','20% (tandatangan & cap resmi dari dinas terkait)');

	$v_20_pengantar_prov_id=array('0','10','20');
	$v_20_pengantar_prov=array('0% (tidak ada)','10% (tidak ada tandatangan kadis/tingkat I Prov terkait mengenai perumahan)','20% (tandatangan Gubernur)');


	$v_20_id=array('0','5','10','15','20');
	$v_20=array('0%','5%','10%','15%','20%');
	
	$v_20_sertifikat_id=array('0','8','16','22','30');
	$v_20_sertifikat=array('0% (tidak ada)','8% (a/n Pribadi/Pemda/Surat keterangan Sekda)','16% (a/n pribadi/Pemda/Surat ket sekda+ AJB/hibah)','22% (a/n pribadi/Pemda/Surat ket Sekda + AJB + surat camat tdk sengketa)','30% (Sudah Sertifikat/Pelepasan Tanah Adat)');
	


	$v_request_type=array('1001','1002');
	$v_request=array('Reguler','Spesial');

	$v_requestYear_type=array('2015','2016','2017');
	$v_requestYear=array('2015','2016','2017');

	$v_requestMonth_type=array('01','02','03','04','05','06','07','08','09','10','11','12');
	$v_requestMonth=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

	$v_requestDate_type=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','07','08','22','23','24','25','26','27','28','29','30','31');
	$v_requestDate=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','07','08','22','23','24','25','26','27','28','29','30','31');


	$myFooter="<b>DIREKTORAT RUMAH KHUSUS<BR>DIREKTORAT JENDERAL PENYEDIAAN PERUMAHAN<BR>2015</b>";
?>
