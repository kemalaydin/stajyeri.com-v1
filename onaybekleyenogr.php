<?php
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 0){
	?>
	<div class="sagbaslik">İŞ GİRİŞİ BEKLEYEN ÖĞRENCİLER</div>
	<div class="sonbascurular">
	<?php
	$OkulID = $_SESSION["uid"]; 
	$Ilanlar = mysql_query("select * from ilanbasvuru where OkulID = '$OkulID' && OkulOnay = '2'");
	$Say = mysql_num_rows($Ilanlar);
	if($Say > 0){
	while($Ilancikar = mysql_fetch_array($Ilanlar)){
	$Ogrid = $Ilancikar["OgrenciID"];
	$OgrenciCikar = mysql_fetch_array(mysql_query("select * from ogrenci where id = '$Ogrid'"));
	
	echo '<li><a href="">'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].'</li></a>';
	
	}
	}else{
	bilgi("İş Girişi Bekleyen Öğrenciniz Yok","Sistemde İş Girişi Bekleyen Bir Öğrenciniz Yok","bilgi");
	}
	?> </div><?php
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

?>
