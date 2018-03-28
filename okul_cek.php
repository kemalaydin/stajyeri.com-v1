<?php 
require("sistem/baglan.php");

mysql_query (" SET CHARACTER SET utf-8");

// gerekli vt bağlantı dosyasını çağırdığını varsayalım
$id = (int)$_POST["id"];
$okulbul = mysql_query("select * from okul where il='$id'");
$okulvarmi = mysql_num_rows($okulbul);
if($okulvarmi > 0) {
		while ($okul = mysql_fetch_array($okulbul)){
			
  
		echo '<option value="'.$okul["id"].'">'.$okul["OkulAdi"].'</option>';
		}} else {
		echo '<option value="0">Bu İle Ait Kayıtlı Okul Bulunamadı.</option>';
		}




?>