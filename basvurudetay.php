	<?php 
	$IlanIDsi = $DetayCik["IlanID"];
	$IlanBul = mysql_query("select * from ilanlar where id='$IlanIDsi'");
	$IlanCikar = mysql_fetch_array($IlanBul);
	extract($IlanCikar);
	
	if($DetayCik["OgrenciOnay"] == 0){
	bilgi("Bu Başvurunuz İPTAL Edilmiştir","Bu Staj Başvurunuz, Tarafınızdan Onaylanmamıştır","bilgi");
	}else{
	////// İŞYERİ BİLGİLERİ ///////
	$IsyeriBul = mysql_query("select * from isyeri where id='$IsyeriID'");
	$IsyeriCikar = mysql_fetch_array($IsyeriBul);
	
	$IsyeriAdi = $IsyeriCikar["IsyeriAdi"];
	$IsAlani = $IsyeriCikar["IsAlani"];
	$il = $IsyeriCikar["il"];
	$ilce = $IsyeriCikar["ilce"];
	
	/////// SEKTÖR BİLGİLERİ //////////
	$SektorBul = mysql_query("select * from alanlar where id='$IsAlani'");
	$SektorCikar = mysql_fetch_array($SektorBul);
	
	$SektorAdi = $SektorCikar["Alan"];
	
	/////// İL BİLGİLERİ ///////
	$IlBul = mysql_query("select * from iller where id='$il'");
	$IlCikar = mysql_fetch_array($IlBul);
	
	$Il = $IlCikar["il"];
	
	/////// İLÇE BİLGİLERİ /////
	$IlceBul = mysql_query("select * from ilceler where id='$ilce'");
	$IlceCikar = mysql_fetch_array($IlceBul);
	
	$Ilce = $IlceCikar["ilce"];
	
	///// BAŞVURU DURUM BİLGİLERİ /////
	if($Onay == 1){
	$OnayY = "Başvurunuz Moderatörler Tarafından Onaylanmıştır, İşyeri ve Okul Onay Verebilir veya Reddedebilir.";
	}else if($Onay == 0){
	$OnayY = "Başvurunuz HENÜZ Moderatörler Tarafından ONAYLANMAMIŞTIR";
	}
	
	//// DURUM BİLGİLER //////
	if($DetayCik["OkulOnay"]== 0 && $DetayCik["IsyeriOnay"] == 1){
	$Durums = "<b> Okul </b> Onay Vermedi ! ( İşyeri Onay Vermiştir )";
	}else if($DetayCik["IsyeriOnay"] == 0 && $DetayCik["OkulOnay"] == 1){
	$Durums = "<b> İşyeri </b> Onay Vermedi ! ( Okul Onay Vermiştir )";
	}else if($DetayCik["IsyeriOnay"] == 0 && $DetayCik["OkulOnay"] == 0){
	$Durums = "<b>Okul</b> ve <b>İşyeri </b> Onay Vermedi !";
	}else if($DetayCik["IsyeriOnay"]== 1 && $DetayCik["OkulOnay"] == 1){
	$Durums = "<b> Okul </b> ve <b> İşyeri </b> Onay Verdi, Onay vererek işyerine giriş yapabilirsiniz.";
	}else if($DetayCik["IsyeriOnay"] == 1 && $DetayCik["OkulOnay"] == 2){
	$Durums = "<b> İşyeri </b> Onay Verdi ! ( Okul Henüz İşlem Yapmadı )";
	}else if($DetayCik["OkulOnay"] == 1 && $DetayCik["IsyeriOnay"] == 2){
	$Durums = "<b> Okul </b> Onay Verdi !( İşyeri Henüz İşlem Yapmadı )";
	}else if($DetayCik["OkulOnay"] == 0 && $DetayCik["IsyeriOnay"] == 2){
	$Durums = "<b> Okul </b> Onay Vermedi ! , İşyeri Henüz Giriş Yapmamış";
	}else if($DetayCik["IsyeriOnay"] == 0 && $DetayCik["OkulOnay"] == 2){
	$Durums = "<b> İşyeri </b> Onay Vermedi ! , Okul Henüz Giriş Yapmamış";
	}else{
	$Durums = "<b> Okul </b> ve <b>İşyeri </b> Henüz İşlem Yapmamış";
	}
	
	/////// İLAN DURUMU //////
	if($Durum){
	$Durum = "AÇIK";
	}else{
	$Durum = "KAPALI";
	}
	
	?>
	<div class="sagbaslik"><h3>Başvurum :  <?php echo $IsyeriAdi; ?> </h3></div>
	<div class="sonbascurular">
	
	
	<ul>
	<li><b>İLAN BAŞLIĞI :</b> <?php echo $Baslik; ?> </li>
	<li><b>İLAN DETAYI :</b> <?php echo $Detay; ?> </li>
	<li><b>İLAN DURUMU :</b> <?php echo $Durum; ?></li>
	
	<li><b>TALEP EDEN ŞİRKET :</b> <?php echo $IsyeriAdi; ?></li>
	<li><b>SEKTÖR :</b> <?php echo $SektorAdi; ?></li>
	<li><b>BULUNDUĞU İL :</b> <?php echo $Il; ?> </li>
	<li><b>BULUNDUĞU İLÇE :</b><?php echo $Ilce; ?></li>
	<li><?php echo $Durums; ?></li>
	</ul>
<div style="padding-bottom: 50px;"></div>

<?php
	if($Onay == "Başvurunuz Moderatörler Tarafından Onaylanmıştır, İşyeri ve Okul Onay Verebilir veya Reddedebilir."){
	$Onay = 1;
	}else if($Onay == "Başvurunuz HENÜZ Moderatörler Tarafından ONAYLANMAMIŞTIR"){
	$Onay = 0;
	}
	if($DetayCik["OkulOnay"] == 1 && $DetayCik["IsyeriOnay"] == 1 && $DetayCik["OgrenciOnay"] == 2){
	

	
	echo '<div class="kirmizibut" style="margin-top: -40px; margin-left: 10px;"> <center><a href="index.php?git=IlanBasvuruIptal&ilanid='.$id.'">Başvuruyu Geri Çek !</a></center></div>';
	echo '<div class="yesilbut" style="margin-top: -40px; margin-left: 10px;"> <center><a href="index.php?git=BasvuruKabulEt&basvuruid='.$DetayCik["id"].'">İş Yerine Giriş Yap !</a></center></div>
	';
}
}
?>
	</div>
		<div class="buyukalt"></div>