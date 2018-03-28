<?php
if($_SESSION["oturum"]){
if($_SESSION["UyelikTuru"] == 0){
$OkulID = $_SESSION["uid"];
?>
<div class="sagbaslik">ÖĞRENCİLERİM</div>
<div class="sonbascurular">
<?php if($_POST){

	$OgrenciNo = $_POST["numara"];
	$Sinif = $_POST["siniflar"];
	$LiseTuru = $_POST["liseturu"];
	$TCNo = $_POST["tcno"];
	if(empty($OgrenciNo)){
		if(empty($TCNo)){
			$ButunOnayBek = $_POST["suz"];
			if($ButunOnayBek == "butonaybek"){
				$ogrencisuz = mysql_query("select * from ogrenci where OkulID = '$OkulID' && OkulOnay = '0'");
				$OgrenciSuzSay = mysql_num_rows($ogrencisuz);
				if($OgrenciSuzSay > 0){
					while($OgrenciCikar = mysql_fetch_array($ogrencisuz)){
					$LiseTurleri = $OkulCikar["LiseTuru"];
					$OkulOnaysi = $OgrenciCikar["OkulOnay"];
					if($OkulOnaysi == 1){
						echo '<li style="background-color: #d1fdc1">';
					}else if($OkulOnaysi == 2){
						echo '<li style="background-color: #fdc1c1">';
					}else{
						echo '<li>';
					}
					if($OkulOnaysi == 1){
						$OnayDurumu = 'Onaylı';
					}else if($OkulOnaysi == 2){
						$OnayDurumu = 'Onaylanmamış';
					}else{
						$OnayDurumu = 'Bekliyor...';
					}
					echo '<a class="tooltip" href=""><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; 
					margin-right: 10px;" src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/>
					<span class="classic">
					<b>Adı - Soyadı : </b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].'<br />
					<b> Okul Numarası : </b>'.$OgrenciCikar["OkulNo"].' <br/> 
					<b> Sınıfı : </b>'.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' <br />
					<b> Lise Türü : </b> '.lisetururet($LiseTuru).'<br />
					<b> T.C. Kimlik Numarası : </b>'.tccoz($OgrenciCikar["TCNo"]).'<br />
					<b> Onay Durumu : </b> '.$OnayDurumu.'<br />
					<b> Kayıt Tarihi : </b> '.$OgrenciCikar["KayitTarihi"].'<br />

					<img style="border: 1px solid #000; padding: 1px; width: 130px; height: 130px; vertical-align: middle; margin-right: 10px;" 
					src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/></center></span></a>
					<a href="/ogrenci/'.$OgrenciCikar["OgrenciSef"].'"><b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' </b>-
					'.$OgrenciCikar["OkulNo"].' - '.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' - '.lisetururet($LiseTuru).'</a>';
					 echo '<div style="float:right;" class="duzenlebuts"><center><a href="index.php?git=ogrduzenleme&ogrid='.$OgrenciCikar["id"].'">
 Düzenle</a></center></div>';	
					}
					echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
				}else{
					bilgi("Eşleşen Bir Öğrenci Bulunamadı","Okulunuza Ait, Onay Bekleyen Bir Öğrenci Bulunamadı...","bilgi");
					echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
				}
			}else{
				$LiseTuru = $_POST["liseturu"];
				$OnayDurumu = $_POST["suz"];
				if($OnayDurumu == "hepsi"){
					$ogrencisuz = mysql_query("select * from ogrenci where OkulID = '$OkulID' && LiseTuru = '$LiseTuru'");
					$OgrenciSuzSay = mysql_num_rows($ogrencisuz);
					if($OgrenciSuzSay > 0){
						while($OgrenciCikar = mysql_fetch_array($ogrencisuz)){
						$LiseTurleri = $OkulCikar["LiseTuru"];
						$OkulOnaysi = $OgrenciCikar["OkulOnay"];
						if($OkulOnaysi == 1){
							echo '<li style="background-color: #d1fdc1">';
						}else if($OkulOnaysi == 2){
							echo '<li style="background-color: #fdc1c1">';
						}else{
							echo '<li>';
						}
						if($OkulOnaysi == 1){
							$OnayDurumu = 'Onaylı';
						}else if($OkulOnaysi == 2){
							$OnayDurumu = 'Onaylanmamış';
						}else{
							$OnayDurumu = 'Bekliyor...';
						}
						echo '<a class="tooltip" href=""><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; 
						margin-right: 10px;" src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/>
						<span class="classic">
						<b>Adı - Soyadı : </b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].'<br />
						<b> Okul Numarası : </b>'.$OgrenciCikar["OkulNo"].' <br/> 
						<b> Sınıfı : </b>'.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' <br />
						<b> Lise Türü : </b> '.lisetururet($LiseTuru).'<br />
						<b> T.C. Kimlik Numarası : </b>'.tccoz($OgrenciCikar["TCNo"]).'<br />
						<b> Onay Durumu : </b> '.$OnayDurumu.'<br />
						<b> Kayıt Tarihi : </b> '.$OgrenciCikar["KayitTarihi"].'<br />

						<img style="border: 1px solid #000; padding: 1px; width: 130px; height: 130px; vertical-align: middle; margin-right: 10px;" 
						src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/></center></span></a>
						<a href="/ogrenci/'.$OgrenciCikar["OgrenciSef"].'"><b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' </b>-
						'.$OgrenciCikar["OkulNo"].' - '.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' - '.lisetururet($LiseTuru).'</a>';
					 echo '<div style="float:right;" class="duzenlebuts"><center><a href="index.php?git=ogrduzenleme&ogrid='.$OgrenciCikar["id"].'">
 Düzenle</a></center></div>';	
						}
						echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
					}else{
						bilgi("Eşleşen Bir Öğrenci Bulunamadı","Okulunuza Ait, Bir Öğrenci Bulunamadı...","bilgi");
						echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
					}
				}else{

					$LiseTuru = $_POST["liseturu"];
					$OnayDurumu = $_POST["suz"];
					$ogrencisuz = mysql_query("select * from ogrenci where OkulID = '$OkulID' && LiseTuru = '$LiseTuru' && OkulOnay = '$OnayDurumu'");
					$OgrenciSuzSay = mysql_num_rows($ogrencisuz);
					if($OgrenciSuzSay > 0){
					while($OgrenciCikar = mysql_fetch_array($ogrencisuz)){
					$LiseTurleri = $OkulCikar["LiseTuru"];
					$OkulOnaysi = $OgrenciCikar["OkulOnay"];
					if($OkulOnaysi == 1){
					echo '<li style="background-color: #d1fdc1">';
					}else if($OkulOnaysi == 2){
					echo '<li style="background-color: #fdc1c1">';
					}else{
					echo '<li>';
					}
					if($OkulOnaysi == 1){
					$OnayDurumu = 'Onaylı';
					}else if($OkulOnaysi == 2){
					$OnayDurumu = 'Onaylanmamış';
					}else{
					$OnayDurumu = 'Bekliyor...';
					}
					echo '<a class="tooltip" href=""><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; 
					margin-right: 10px;" src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/>
					<span class="classic">
					<b>Adı - Soyadı : </b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].'<br />
					<b> Okul Numarası : </b>'.$OgrenciCikar["OkulNo"].' <br/> 
					<b> Sınıfı : </b>'.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' <br />
					<b> Lise Türü : </b> '.lisetururet($LiseTuru).'<br />
					<b> T.C. Kimlik Numarası : </b>'.tccoz($OgrenciCikar["TCNo"]).'<br />
					<b> Onay Durumu : </b> '.$OnayDurumu.'<br />
					<b> Kayıt Tarihi : </b> '.$OgrenciCikar["KayitTarihi"].'<br />

					<img style="border: 1px solid #000; padding: 1px; width: 130px; height: 130px; vertical-align: middle; margin-right: 10px;" 
					src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/></center></span></a>
					<a href="/ogrenci/'.$OgrenciCikar["OgrenciSef"].'"><b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' </b>-
					'.$OgrenciCikar["OkulNo"].' - '.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' - '.lisetururet($LiseTuru).'</a>';
					 echo '<div style="float:right;" class="duzenlebuts"><center><a href="index.php?git=ogrduzenleme&ogrid='.$OgrenciCikar["id"].'">
 Düzenle</a></center></div>';	
					}
					echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
					}else{
					bilgi("Eşleşen Bir Öğrenci Bulunamadı","Okulunuza Ait, Eşleşen Bir Öğrenci Bulunamadı...","bilgi");
					echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
					}


				}
			}
		}else{
		$TcSifre = tcsifrele($TCNo);
		$ogrencisuz = mysql_query("select * from ogrenci where OkulID = '$OkulID' && TCNo = '$TcSifre'");
		$OgrenciSuzSay = mysql_num_rows($ogrencisuz);
		if($OgrenciSuzSay > 0){
		$OgrenciCikar = mysql_fetch_array($ogrencisuz);
		$LiseTurleri = $OkulCikar["LiseTuru"];
		$OkulOnaysi = $OgrenciCikar["OkulOnay"];
		if($OkulOnaysi == 1){
		echo '<li style="background-color: #d1fdc1">';
		}else if($OkulOnaysi == 2){
		echo '<li style="background-color: #fdc1c1">';
		}else{
		echo '<li>';
		}
		if($OkulOnaysi == 1){
		$OnayDurumu = 'Onaylı';
		}else if($OkulOnaysi == 2){
		$OnayDurumu = 'Onaylanmamış';
		}else{
		$OnayDurumu = 'Bekliyor...';
		}
		echo '<a class="tooltip" href=""><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; 
		margin-right: 10px;" src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/>
		<span class="classic">
		<b>Adı - Soyadı : </b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].'<br />
		<b> Okul Numarası : </b>'.$OgrenciCikar["OkulNo"].' <br/> 
		<b> Sınıfı : </b>'.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' <br />
		<b> Lise Türü : </b> '.lisetururet($LiseTuru).'<br />
		<b> T.C. Kimlik Numarası : </b>'.tccoz($OgrenciCikar["TCNo"]).'<br />
		<b> Onay Durumu : </b> '.$OnayDurumu.'<br />
		<b> Kayıt Tarihi : </b> '.$OgrenciCikar["KayitTarihi"].'<br />

		<img style="border: 1px solid #000; padding: 1px; width: 130px; height: 130px; vertical-align: middle; margin-right: 10px;" 
		src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/></center></span></a>
		<a href="/ogrenci/'.$OgrenciCikar["OgrenciSef"].'"><b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' </b>-
		'.$OgrenciCikar["OkulNo"].' - '.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' - '.lisetururet($LiseTuru).'</a>';
		 echo '<div style="float:right;" class="duzenlebuts"><center><a href="index.php?git=ogrduzenleme&ogrid='.$OgrenciCikar["id"].'">
 Düzenle</a></center></div>';	echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
		}else{
		bilgi("T.C. Numarası Eşleşen Bir Öğrenci Bulunamadı","Okulunuza Ait, T.C. Numarası $TCNo Olan Bir Öğrenci Bulunamadı...","bilgi");
		echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
		}
		}
	}else{
	$ogrencisuz = mysql_query("select * from ogrenci where OkulID = '$OkulID' && OkulNo = '$OgrenciNo'");
	$OgrenciSuzSay = mysql_num_rows($ogrencisuz);
	if($OgrenciSuzSay > 0){
	$OgrenciCikar = mysql_fetch_array($ogrencisuz);
	$LiseTurleri = $OkulCikar["LiseTuru"];
	$OkulOnaysi = $OgrenciCikar["OkulOnay"];
	if($OkulOnaysi == 1){
	echo '<li style="background-color: #d1fdc1">';
	}else if($OkulOnaysi == 2){
	echo '<li style="background-color: #fdc1c1">';
	}else{
	echo '<li>';
	}
	if($OkulOnaysi == 1){
	$OnayDurumu = 'Onaylı';
	}else if($OkulOnaysi == 2){
	$OnayDurumu = 'Onaylanmamış';
	}else{
	$OnayDurumu = 'Bekliyor...';
	}
	echo '<a class="tooltip" href=""><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; 
	margin-right: 10px;" src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/>
	<span class="classic">
	<b>Adı - Soyadı : </b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].'<br />
	<b> Okul Numarası : </b>'.$OgrenciCikar["OkulNo"].' <br/> 
	<b> Sınıfı : </b>'.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' <br />
	<b> Lise Türü : </b> '.lisetururet($LiseTuru).'<br />
	<b> T.C. Kimlik Numarası : </b>'.tccoz($OgrenciCikar["TCNo"]).'<br />
	<b> Onay Durumu : </b> '.$OnayDurumu.'<br />
	<b> Kayıt Tarihi : </b> '.$OgrenciCikar["KayitTarihi"].'<br />

	<img style="border: 1px solid #000; padding: 1px; width: 130px; height: 130px; vertical-align: middle; margin-right: 10px;" 
	src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/></center></span></a>
	<a href="/ogrenci/'.$OgrenciCikar["OgrenciSef"].'"><b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' </b>-
	'.$OgrenciCikar["OkulNo"].' - '.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' - '.lisetururet($LiseTuru).'</a>';
	 echo '<div style="float:right;" class="duzenlebuts"><center><a href="index.php?git=ogrduzenleme&ogrid='.$OgrenciCikar["id"].'">
 Düzenle</a></center></div>';	echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
	}else{
	bilgi("Numarası Eşleşen Bir Öğrenci Bulunamadı","Okulunuza Ait, Numarası $OgrenciNo Olan Bir Öğrenci Bulunamadı...","bilgi");
	echo '<br /><a href="index.php?git=ogrencilerim"> << Geri Dön << </a>';
	}
	}
}else{ ?>
<form action="" method="post"><center>
<p style="padding-left: 5px;padding-right: 5px; padding-bottom: 10px; padding-top: 10px;">
Numara : <input type="text" class="aramanumara" name="numara"> 
<img src="img/veya.png" style="vertical-align: middle; margin-top: -5px;"/> 
T.C. Kimlik Numarası : <input type="text" class="aramanumaratc" name="tcno"> <img src="img/veya.png" style="vertical-align: middle; margin-top: -5px;"/>
<input type="radio" name="suz" value="butonaybek"/> Bütün Onay Bekleyenler <img src="img/veya.png" style="vertical-align: middle; margin-top: -5px;"/>
 <br /> <br />

Lise Türü : <select name="liseturu" class="aramanumarasel">
<?php
$OkulSorgusu = mysql_query("select * from okul where id = '$OkulID'");
$OkulCikar = mysql_fetch_array($OkulSorgusu);
$LiseTurleri = $OkulCikar["LiseTuru"];
$parcala = explode(",",$LiseTurleri);
foreach($parcala as $etiket){
$TuruSorgu = mysql_query("select * from liseturu where id = '$etiket'");
$TuruCikar = mysql_fetch_array($TuruSorgu);
echo '<option value="'.$TuruCikar["id"].'">'.$TuruCikar["LiseTuru"].'</option>';

}


?>
</select>

<input type="radio" name="suz" value="hepsi" checked /> Hepsi
<input type="radio" name="suz" value="2"/> Onaylanmamış
<input type="radio" name="suz" value="0" /> Onay Bekleyen
<input type="radio" name="suz" value="1" /> Onaylı<br />
<input type="submit" value="Aramayı Daralt" class="aramadaralt" /></center>
<b><p style="color:#a50000;"><center>!! Öğrenciler Hakkında Detaylı Bilgi İçin Fotoğraflarının Üzerine Geliniz...</center></p></b>
<div style="padding-bottom: 15px; clear:both; " ></div>
</form>
</p>
<?php
$OgrenciBul = mysql_query("select * from ogrenci where OkulID = '$OkulID'");
$OgrenciSay = mysql_num_rows($OgrenciBul);

if($OgrenciSay > 0){ 

while($OgrenciCikar = mysql_fetch_array($OgrenciBul)){
$LiseTuru = $OgrenciCikar["LiseTuru"];
$OkulOnaysi = $OgrenciCikar["OkulOnay"];
if($OkulOnaysi == 1){
$OnayDurumu = 'Onaylı';
}else if($OkulOnaysi == 2){
$OnayDurumu = 'Onaylanmamış';
}else{
$OnayDurumu = 'Bekliyor...';
}

if($OkulOnaysi == 1){
echo '<li style="background-color: #d1fdc1">';
$durumbg = "onayli";

}else if($OkulOnaysi == 2){
echo '<li style="background-color: #fdc1c1">';
$durumbg = "warning";
}else{
echo '<li>';
$durumbg = "classic";
}
echo '<a class="tooltip" href=""><img style="border: 1px solid #315963; padding: 1px; width: 30px; height: 30px; vertical-align: middle; 
margin-right: 10px;" src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/>
<span class="'.$durumbg.'">
<b>Adı - Soyadı : </b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].'<br />
<b> Okul Numarası : </b>'.$OgrenciCikar["OkulNo"].' <br/> 
<b> Sınıfı : </b>'.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' <br />
<b> Lise Türü : </b> '.lisetururet($LiseTuru).'<br />
<b> T.C. Kimlik Numarası : </b>'.tccoz($OgrenciCikar["TCNo"]).'<br />
<b> Onay Durumu : </b> '.$OnayDurumu.'<br />
<b> Kayıt Tarihi : </b> '.$OgrenciCikar["KayitTarihi"].'<br />

<img style="border: 1px solid #000; padding: 1px; width: 130px; height: 130px; vertical-align: middle; margin-right: 10px;" 
src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/></center></span></a>
<a href="/ogrenci/'.$OgrenciCikar["OgrenciSef"].'"><b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' </b>-
 '.$OgrenciCikar["OkulNo"].' - '.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' - '.lisetururet($LiseTuru).'</a>';

 echo '<div style="float:right;" class="duzenlebuts"><center><a href="index.php?git=ogrduzenleme&ogrid='.$OgrenciCikar["id"].'">
 Düzenle</a></center></div>';
 
}

}else{
bilgi("Sisteme Henüz Öğrenciniz Kayıt Olmamıştır","Sistemde Okulunuza Ait Öğrenci Bulunamadı","bilgi");
}

}

?>		

</div>
<div class="buyukalt"></div>
<?php
}else{
Header("Location:../index.php"	);
}
}else{Header("Location:../index.php"	);
}

?>
