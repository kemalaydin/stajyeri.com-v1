<?php 
require("sistem/baglan.php");

$id = $_POST["id"];

$guncelle = mysql_query("select * from mesajlar WHERE Kime='$id' ORDER BY id DESC LIMIT 0,1");

$deger = mysql_fetch_array($guncelle);

$sonid= $deger["id"];


$guncelle = mysql_query("UPDATE mesajlar SET durumu='0' WHERE id='$sonid'");

if($guncelle){
echo "evet";
}else{
echo "hayir";
} 

?> 