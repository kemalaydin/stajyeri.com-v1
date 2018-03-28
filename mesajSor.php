<?php 
require("sistem/baglan.php");

$id = $_POST["id"];


$sor = mysql_query("SELECT * FROM mesajlar WHERE Kime='$id' ORDER BY id DESC ");

$w = mysql_fetch_array($sor);
if($Say = mysql_num_rows($sor) > 0){
if($w["durumu"]!="0"){
	echo $w["Konu"];
}else{
echo "hayir";
}
}
else{echo "hayir";}
?>