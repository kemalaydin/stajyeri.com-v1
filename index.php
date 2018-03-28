<?php


session_start(); // Session Başlatma 
ob_start();



require ("sistem/baglan.php"); // baglan.php dosyası çağır
require ("sistem/sistem.php");  // sistem.php dosyası çağır



if ($site_durumu){
	require ("anasayfa.php");
	
}else{ // Sistem açık değil ise bakim.php sayfasını göster.
	
require("bakim.php");

}
ob_end_flush();

?>