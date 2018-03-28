<?php
session_start(); // Session Başlatma 
ob_start();
require("sistem/baglan.php");
require("sistem/sistem.php");

$tnoo = $_POST["tcno"];
$ad = $_POST["ad"];
$soyad = $_POST["soyad"];
$pek = $_POST["pek"];
$uipek = $_POST["uipek"];
$gun = $_POST["gun"];
$cgun = $_POST["cgun"];
$eksgun = $_POST["eksgun"]; 
$egn = $_POST["egn"];

$sicilnosu = $_POST["sicilnosu"];
$kontrolno = $_POST["kontrolno"];
$isyeriaracno = $_POST["isyeriaracno"];
$isyeriunvan = $_POST["isyeriunvan"];
$adres = $_POST["adres"];
$vergino = $_POST["vergino"];


$count = count($tnoo);
$basliklar = '<?xml version="1.0" encoding="UTF-8"?>
<AYLIKBILDIRGELER>';
$isyeriBilgi = '<ISYERI ISYERISICIL="'.$sicilnosu.'" KONTROLNO="'.$kontrolno.'" ISYERIARACINO="'.$isyeriaracno.'" ISYERIUNVAN="'.$isyeriunvan.'" ISYERIADRES="'.$adres.'" ISYERIVERGINO="'.$vergino.'"/>
	<BORDRO DONEMAY="03" DONEMYIL="2012" BELGEMAHIYET="A"/>
	<BILDIRGELER BELGETURU="19" KANUN="00000"><SIGORTALILAR>';
for($i=0;$i<$count;$i++) {
$sn = $i + 1;
$mesaj = $mesaj.'<SIGORTALI SIRA="'.$sn.'" TCKNO="'.$tnoo[$i].'" AD="'.$ad[$i].'" SOYAD="'.$soyad[$i].'" PEK="'.$pek[$i].'" UIPEK="'.$uipek[$i].'" GUN="'.$gun[$i].'" CIKISGUN="'.$cgun[$i].'" EKSIKGUNSAYISI="'.$eksgun[$i].'" EKSIKGUNNEDENI="'.$egn[$i].'" />';
}

$sonbolum = '</SIGORTALILAR>
	</BILDIRGELER>
</AYLIKBILDIRGELER>';

$hepsinitopla = $basliklar.$isyeriBilgi.$mesaj.$sonbolum ;

$OkulID = $_SESSION["uid"];
$Okularamara=mysql_fetch_array(mysql_query("select * from okul where id = '$OkulID'"));
$xmlyolu = $Okularamara["xmlyolu"];

$dosya = 'OkulXML/'.$xmlyolu; // senin xml dosyanın adı 
echo $dosya;
$baglan = fopen($dosya,'w'); //dosyaya yazdırıyoruz 
fwrite($baglan,$hepsinitopla); 
fputs($baglan,""); // mesajın sonunda ne yazılacağını belirtiyoruz 
fclose($baglan); 

header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename='.$xmlyolu);
readfile($dosya); 

ob_end_flush();
?>