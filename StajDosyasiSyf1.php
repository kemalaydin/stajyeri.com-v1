<?php session_start(); 
 ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>STAJ DOSYASI</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css"/>
	<script type="text/javascript" src="js/stajyeri.js"></script>
		
        	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js	"></script>
	<script type="text/javascript">
		$(document).ready(function() {window.print(); });

				
			</script>
</head>
<body>
	<?php 
if($_SESSION["oturum"]){
	if($_POST){
	
	// Öğrenci Bilgileri Alma
	$OgrenciAdi = $_POST["OgrenciAdi"];
	$OgrenciSinifi = $_POST["OgrenciSinifi"];
	$OgrenciNo = $_POST["OgrenciNumarasi"];
	$OgrenciTel = $_POST["OgrenciTelefon"];
	$MeslekDali = $_POST["MeslekDali"];
	$TCNo = $_POST["TCNo"];
	$SGKNo = $_POST["SGKNo"];
	
	// İşyeri Bilgileri Alma
	$IsyeriAdi = $_POST["IsyeriAdi"];
	$IsyeriAdresi = $_POST["IsyeriAdresi"];
	$IsyeriMail = $_POST["IsyeriEposta"];
	$IsyeriTelefon = $_POST["IsyeriTelefon"];
	$IsyeriFax = $_POST["IsyeriFax"];
	$YetkiliEgitmen = $_POST["EgitimYetkilisi"];
	
	// Okul Bilgileri Alma
	$OkulAdi = $_POST["OkulAdi"];
	$OkulAdresi = $_POST["OkulAdresi"];
	$OkulEposta = $_POST["OkulEposta"];
	$OkulTelefon = $_POST["OkulTelefon"];
	$OkulFax = $_POST["OkulFax"];
	$OkulWebSite = $_POST["OkulWebsitesi"];
	?>
	<div class="sagbaslik" style="background: none;"></div>
<div class="stajdosyasi">
<h1>STAJ DOSYASI</h1>
<h2>OKULUN</h2>
<div class="dosyaicbir">
<ul style="height: 160px;">
<li><span class="dosyaicbirspan">ADI </span> <span class="beyazdosyali"><?php echo $OkulAdi; ?></span></li>
<li><span class="dosyaicbirspan">ADRESİ </span> <span class="beyazdosyali"><?php echo $OkulAdresi; ?></span></li>
<li><span class="dosyaicbirspan">E-POSTA </span> <span class="beyazdosyali" style="width: 173px; margin-right: 4px;"><?php echo $OkulEposta; ?></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OkulTelefon; ?></span></li>
<li><span class="dosyaicbirspan">FAKS </span> <span class="beyazdosyali" style="width: 173px; margin-right: 4px;"><?php echo $OkulFax; ?></span></li>
<li><span class="dosyaicbirspan">WEB SİTESİ </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 19px;"><?php echo $OkulWebSite; ?></span></li>
</ul>
<div style="clear:both;"></div>
</div>
<h2>ÖĞRENCİNİN</h2>
<div class="dosyaicbir">
<ul style="height: 155px;">
<li><span class="dosyaicbirspan">ADI VE SOYADI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OgrenciAdi; ?></span></li>
<li style="height: 50px;"><span class="dosyaicbirspan">SINIFI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OgrenciSinifi; ?></span></li>
<li><span class="dosyaicbirspan">NUMARASI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OgrenciNo; ?></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 19px;"><?php echo $OgrenciTel; ?></span></li>
<li style="height: 50px;"><span class="dosyaicbirspan">MESLEK DALI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $MeslekDali; ?></span></li>
<li><span class="dosyaicbirspan">T.C. KİMLİK NO </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"> <?php echo $TCNo; ?></span></li>
<li><span class="dosyaicbirspan">SGK NO </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 19px;"><?php echo $SGKNo; ?></span></li>
</ul>
<div style="clear:both;"></div>
</div>
<h3>Stajdan sorumlu yönetici veya öğretmenin</h3>
<div class="dosyaicbir">
<ul style="height: 70px;">
<li><span class="dosyaicbirspan">ADI VE SOYADI </span> <span class="beyazdosyali" style="height: 19px;"></span></li><br/>
<li><span class="dosyaicbirspan">ÜNVANI </span> <span class="beyazdosyali" style="width: 171px; margin-right: 5px;height: 19px;"></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 171px; margin-right: 5px;height: 19px;"></span></li>
</div>
<h2>İŞLETMENİN</h2>
<div class="dosyaicbir">
<ul style="height: 165px;">
<li><span class="dosyaicbirspan">ADI</span> <span class="beyazdosyali"><?php echo $IsyeriAdi;?></span></li>
<li><span class="dosyaicbirspan">ADRESİ </span> <span class="beyazdosyali"><?php echo $IsyeriAdresi; ?></span></li>
<li><span class="dosyaicbirspan">E-POSTA </span> <span class="beyazdosyali"><?php echo $IsyeriMail; ?></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 19px;"><?php echo $IsyeriTelefon; ?></span></li>
<li><span class="dosyaicbirspan">FAKS </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $IsyeriFax; ?></span></li>
<li><span class="dosyaicbirspan">EĞİTİM YETKİLİSİ</span> <span class="beyazdosyali"> <?php echo $YetkiliEgitmen; ?></span></li>
</ul>
<div style="clear:both;"></div>
</div>
<h3>AÇIKLAMALAR</h3>
<li>1-) Öğrenci staja başladığında staj dosyasındaki staja başlama yazısı doldurularak okula gönderilir.</li>
<li>2-) Staj sonunda, staj dosyasındaki iki suret staj sonu değerlendirme raporu staj eğitim yetkilisi  tarafından doldurulduktan sonra staj dosyası ile birlikte kapalı zarf içinde okula gönderilir.</li>
<br/><br/>
	<?php
	}else{
	Header("Location:../index.php");
	}
 }else{
Header("Location:../index.php");
}

?>
</body>
</html>
<?php 
ob_end_flush(); ?>
