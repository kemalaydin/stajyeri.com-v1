	<?php 
	if(!$_SESSION["oturum"]){
	require("anasayfa.php");
	
	}else{
	 if($_SESSION["oturum"]){
	$UyelikTuru = $_SESSION["UyelikTuru"];
	echo ' <head><base href="http://www.kmlaydin.com/referanslar/stajyeriCom_Eski/"> </head>';
	if($UyelikTuru == "1"){
	require("ogrenciuyelik.php");
	}else if($UyelikTuru == "2"){
	require("isyeriuyelik.php");
	}else if($UyelikTuru == "0"){
	require("okuluyelik.php");
	}
	}

 } ?>
