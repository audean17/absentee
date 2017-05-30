<?php

mysql_connect("localhost","root","");
mysql_select_db("db_my_home");
$propinsi = $_REQUEST['myValue'];
$kota = mysql_query("SELECT kabupaten_kota_id,kabupaten_kota_name FROM tm_kabupaten_kota WHERE propinsi_id='$propinsi' order by kabupaten_kota_name");
echo "<option>-- Pilih Kabupaten/Kota --</option>";
while($k = mysql_fetch_array($kota)){
    echo "<option value=\"".$k['kabupaten_kota_id']."\">".$k['kabupaten_kota_name']."</option>\n";
}
?>