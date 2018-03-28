<?php
//error_reporting(0);
if($site_durumu == 0){

}else{
/*
header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}"); 
header( "Refresh: 3; url=index.php");
Header("Location:../index.php");
strip_tags(addslashes(trim(
date("d.m.Y H:i");
*/
ob_start();

// Sistem saatini Türkiye 'ye Eşitleme
date_default_timezone_set('Europe/Istanbul');

// TR 
function turkceKarakter($veri) {
    return strtoupper (str_replace(array ('ı', 'i', 'ğ', 'ü', 'ş', 'ö', 'ç' ),array ('I', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç' ),$veri));
}

## IP Adresi Alma ## 
function IPAdres(){
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
    return $ip;
}

## İlleri Listeleme ##
function illerilistele(){
$IlleriCikar = mysql_query("select * from iller");
while($ilcikars = mysql_fetch_array($IlleriCikar)){
$id = $ilcikars["id"];
if($id == "1" || $id == "2" || $id == "3" || $id == "4" || $id == "5" || $id == "6" || $id == "7" || $id == "8" || $id == "9" ){
$id = '0'.$id;
}
echo '<option value="'.$ilcikars["id"].'">'.$id.' - '.$ilcikars["il"].'</option>';
}
}

## Öğrenci Slider Alanı ##
function sliderreklam(){
$ReklamCek = mysql_query("select * from reklam where Durum = '1'");


	while($ReklamSiraliCikar = mysql_fetch_array($ReklamCek)){
	echo '<li><a href="'.$ReklamSiraliCikar["Link"].'" target="_blank"><img src="'.$ReklamSiraliCikar["ReklamBanner"].'" alt="SLİDE GÖRÜNTÜLENEMİYOR !" /></a></li>';
	}



}

## Sef Link Fonksiyonu ##
function sef_link($url){
    $url = trim($url);
    $url = strtolower($url);
    $find = array('<b>', '</b>');
    $url = str_replace ($find, '', $url);
    $url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
    $find = array(' ', '"', '&', '&', '\r\n', '\n', '/', '\\', '+', '<', '>');
    $url = str_replace ($find, '-', $url);
    $find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
    $url = str_replace ($find, 'e', $url);
    $find = array('í','ì', 'î', 'ï', 'I', 'ı', 'İ', 'Í', 'Ì', 'Î', 'Ï');
    $url = str_replace ($find, 'i', $url);
    $find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
    $url = str_replace ($find, 'o', $url);
    $find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
    $url = str_replace ($find, 'a', $url);
    $find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
    $url = str_replace ($find, 'u', $url);
    $find = array('ç', 'Ç');
    $url = str_replace ($find, 'c', $url);
    $find = array('ş', 'Ş');
    $url = str_replace ($find, 's', $url);
    $find = array('ğ', 'Ğ');
    $url = str_replace ($find, 'g', $url);   
    $find = array('Y');
    $url = str_replace ($find, 'y', $url);  
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $url = preg_replace ($find, $repl, $url);
    $url = str_replace ('--', '-', $url);
    return $url;
}

## Stajyerlerim [ İşyeri ] ## ######################## ÖĞRENCİ YORUM GİR vs. ÖZELLİKLERİ EKLE ! ###############################
function stajyerlerim(){
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 2){
	
		$IsyeriID = $_SESSION["uid"];
		$IsciBul = mysql_query("select * from isgiris where IsyeriID = '$IsyeriID' && Durum = '1'");
		$IsciSay = mysql_num_rows($IsciBul);
		echo '<div class="sagbaslik">STAJYERLERİM</div><div class="sonbascurular">
<ul style="padding:10px;">';
		if($IsciSay > 0){
		$IsciBulIki = mysql_query("select * from isgiris where IsyeriID = '$IsyeriID' && Durum = '1' order by id desc");
		while($IlanCikar = mysql_fetch_array($IsciBulIki)){
		$OgrenciID = $IlanCikar["OgrenciID"];
		$OgrenciBul = mysql_query("select * from ogrenci where id ='$OgrenciID'");
		$OgrenciCikar = mysql_fetch_array($OgrenciBul);
		$LiseID = $OgrenciCikar["OkulID"];
		$OkulBul = mysql_query("select * from okul where id = '$LiseID'");
		$OkulCikar = mysql_fetch_array($OkulBul);
		
		echo '<li style="padding:5px;"><a href="ogrenci/'.$OgrenciCikar["OgrenciSef"].'">'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' ( '.$OkulCikar["OkulAdi"].' )</a></li>';
		
		}
	
		}else{
		bilgi("İş yerinize giriş yapmış stajyer bulunmuyor","Sitemiz aracılığıyla henüz bir stajyer bulmadınız","bilgi");
		
		}
		echo '</ul></div><div class="buyukalt"></div>';
	}else{Header("Location:../index.php"	);}
}else{Header("Location:../index.php"	);}

}

## Basvuru Listesi Ana Sayfa ##
function basvurulist(){

$OgrID = $_SESSION["uid"]; // Başvuruları Listelemek İçin Öğrencinin id Sini çekiyoruz.

$sorgu = mysql_query("select * from  ilanbasvuru where OgrenciID='$OgrID'");
$say = mysql_num_rows($sorgu);

	
		if($say>0){ // Adına Başvuru var ise ;
			while($basgoster=mysql_fetch_array($sorgu)){
			extract($basgoster);
			$ilancek = mysql_query("select * from ilanlar where id='$IlanID'");
			$ilangoster = mysql_fetch_array($ilancek);
			
			$isyeriid = $ilangoster["IsyeriID"];
			
			$isyericek = mysql_query("select * from isyeri where id='$isyeriid'");
			$isyerigoster= mysql_fetch_array($isyericek);
			
			$isyeriadi = $isyericek["IsyeriAdi"];
			
			
			
			$isyeriadi = $isyerigoster["IsyeriAdi"];
			
		
			echo '<li><a href="index.php?git=basvurudetay&id='.$_SESSION["uid"].'&basvuruid='.$id.'">+ '.$isyeriadi.'</a></li>';
			
			
			}
		
			
		}else{ // Adına Başvur Yok İse ;
		echo '<div class="basvurulariyok"><a href="#"><li class="bosyok">Aktif Başvurunuz Bulunamadı</li></a></div>';
		}



}

## Başvuran Öğrenciler [ İş yeri onaylama vs ] ##
function basvuranogrenci(){

	if($_SESSION["oturum"]){
		if($_SESSION["UyelikTuru"] == 2){
			$IlanID = $_GET["ilanid"];
			$ilanid = $_GET['ilanid'];
			$IsyeriID = $_SESSION["uid"];
			$IlanCikar = mysql_query("select * from ilanlar where id='$IlanID'");
			$IlanSonuc = mysql_fetch_array($IlanCikar);
			
			if($IlanSonuc["IsyeriID"] == $_SESSION["uid"]){
					echo '<div class="sagbaslik"> İlanıma Başvuranlar ( '.$IlanSonuc["Baslik"].' )</div><div class="sonbascurular">
		<ul id="ogrenciBasvuran" style="padding:10px;">'; ?>
			<script type="text/javascript">
            $(document).ready(function() {
            
            $('.ogrenciOnay').live('click', function(e){
                                    var basvuru = $(this).attr("id");
                                     var ilan = $(this).attr("alt");
                                    
                                    $.ajax({
                                    type: 'GET',
                                    url: 'ogrenciOnay.php',
                                    data: 'basvuruid='+basvuru+'&ilanid='+ilan,
                                    success: function(msg) {
            
                                        $("#ogrenciBasvuran").html(msg);
            
                                        }});
            });
            
            $('.ogrenciRet').live('click', function(e){
                                    var basvuru = $(this).attr("id");
                                     var ilan = $(this).attr("alt");
                                    
                                    $.ajax({
                                    type: 'GET',
                                    url: 'ogrenciRet.php',
                                    data: 'basvuruid='+basvuru+'&ilanid='+ilan,
                                    success: function(msg) {
            
                                        $("#ogrenciBasvuran").html(msg);
            
                                        }});
            });
            
            $('.ogrenciBekle').live('click', function(e){
                                    var basvuru = $(this).attr("id");
                                     var ilan = $(this).attr("alt");
                                    
                                    $.ajax({
                                    type: 'GET',
                                    url: 'ogrenciBekle.php',
                                    data: 'basvuruid='+basvuru+'&ilanid='+ilan,
                                    success: function(msg) {
                                       $("#ogrenciBasvuran").html(msg);
            
                                }});
            });
            });	
            </script>
<?php
				$BasvuruCikar = mysql_query("select * from ilanbasvuru where IlanID='$IlanID' order by id desc");
				$BasvuruVarmi = mysql_num_rows($BasvuruCikar);
				if($BasvuruVarmi > 0){
				while($BasvuruSonuc = mysql_fetch_array($BasvuruCikar)){
					
					extract($BasvuruSonuc);
					require("basvuranlar.php");
				}
	
			}else{
			bilgi("Henüz Bu İlana Başvuru Yok!","Sistemimizden henüz bir başvuru gelmedi","bilgi");
			}
								echo'</ul></div>
				<div class="buyukalt"></div>';
			}
			
			
		echo '</div>';
	}else{Header("Location:../index.php");}}else{Header("Location:../index.php");}
}

## İlanlarına Bak ##
function ilanlarinabak(){

if(!$_SESSION['oturum']) {header("Location:index.php");} else {

	$IsyeriID = $_GET["id"];
	
	$IlanBul = mysql_query("select * from ilanlar where IsYeriID='$IsyeriID'");
	$IlanSay = mysql_num_rows($IlanBul);
	$firmaIsim = mysql_fetch_array(mysql_query("select * from isyeri where id='$IsyeriID'"));
	echo '<div class="sagbaslik">'.$firmaIsim['IsyeriAdi'].' Firmasının İlanları</div><div class="sonbascurular"><ul style="padding:10px;">';
	if($IlanSay > 0){
		while($basgoster=mysql_fetch_array($IlanBul)){
			extract($basgoster);
			echo '<li style="padding:5px;border-bottom:1px solid #ddd;"><a href="index.php?git=ilan&id='.$id.'">'.$Baslik.'</a></li>';
	}
	}else{
	echo '<a href="#"><li> Bu Firmanın Henüz İlanı Yok ! </li></a>';
	}
	echo '</ul></div><div class="buyukalt"></div>';
	

}}

## Başvuru İptali [ Öğrenci ] ##
function IlanIptal(){

if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == "1"){

		$IlanID = $_GET["id"];
		$OgrenciID = $_SESSION["uid"];
		
		$BasvuruSorgu = mysql_query("select * from ilanbasvuru where IlanID='$IlanID' && OgrenciID = '$OgrenciID'");
		$BasvuruSay = mysql_num_rows($BasvuruSorgu);
		
		if($BasvuruSay > 0){
			$BasvuruSil = mysql_query("delete from ilanbasvuru where IlanID='$IlanID' && OgrenciID = '$OgrenciID'");
			if($BasvuruSil){
			bilgi("Staj Talebiniz Geri Çekildi!","Artık bu talebe başvuruda bulunmuş sayılmayacaksınız","onay");
			}else{
			bilgi("Bir sorun meydana geldi","Lütfen daha sonra tekrar deneyiniz");
			}
		}else{
		bilgi("Böyle Bir Başvuru Yok","Tarafınızdan yapmış olduğunuz başvuru bulunamadı","bilgi");
		}
	
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php"	);}

}

## İlan Ekleme ( İŞYERİ ) ##
function ilanekleniyor(){
if($_SESSION["oturum"]){
	if($_POST){
		if($_SESSION["UyelikTuru"] == 2){
		
			$IsYeriID = $_SESSION["uid"];
			$IlanBasligi = strip_tags(addslashes(trim($_POST["IlanBaslik"])));
			$IlanBasligiEklendimi = mysql_num_rows(mysql_query("select * from ilanlar where Baslik = '$IlanBasligi' && IsYeriID = '$IsYeriID'"));
			if($IlanBasligiEklendimi == 0){
			
			$Tarih = date("d.m.Y H:i");
			$IlanDetayi = strip_tags(addslashes(trim($_POST["ilandetay"])));
			
			$TemizIlan = preg_replace('/\s+/',' ',$IlanDetayi);
			$IsAlani = $_POST["isalani"];
			$AlinacakStajyer = $_POST["alinacakstajyer"];
			$stajdonemi = $_POST["stajdonemi"];
			
			$Adres = strip_tags(addslashes(trim($_POST["isadres"])));
			$il = $_POST['il'];
			$ilce = $_POST['ilce'];
			$IsDali = $_POST['isdal'];
			$GecerlilikSuresi = "15.06.2012";
			
			$Kural = $_POST["kural"];
			$Ziyaretci = 0;
			
			$TalepKodu = md5($IsYeriID.' - '.$IlanBasligi);
			$BasvuruSayisi = 0;
			/* $StajDonem = $_POST["StajDonemi"]; */
			$StajDonem = "Yaz Dönemi ( 15.06.2012 ~ 15.09.2012 )";
			$Durum = 1;
			$Onay = 0;
			
			if($Kural == 1){
			
				if(empty($IlanBasligi) || empty($IlanDetayi) || empty($IsAlani) || empty($AlinacakStajyer)){
				
						bilgi("Boş alan bıraktınız.","Lütfen boş alan bırakmadan tekrar deneyin");	
				}else{$YeniTalepEkle = mysql_query("insert into ilanlar (Baslik,Detay,IsAlani,AlinacakStajyer,Ziyaretci,IlanTarihi,IsYeriID,TalepKodu,BasvuruSayisi,StajDonem,Durum,Onay,il,ilce,Adres,IsDali,GecerlilikSuresi,StajDonemi) values ('$IlanBasligi','$IlanDetayi','$IsAlani','$AlinacakStajyer','$Ziyaretci','$Tarih','$IsYeriID','$TalepKodu','$BasvuruSayisi','$StajDonem','$Durum','$Onay','$il','$ilce','$Adres','$IsDali','$GecerlilikSuresi','$stajdonemi')");
					
					if($YeniTalepEkle){
						
						bilgi("Başarıyla Talep Gönderdiniz.","Stajyer Talebiniz Başarıyla Gönderildi. Stajyer Talep Kodunuz : $TalepKodu","onay");
						header( "Refresh: 3; url=../index.php" );
					}else{bilgi("Bir Hata Meydana Geldi!","Bir sorunla karşılaştık. Çözmek için uğraşıyoruz");}	
				
				}}else{
			bilgi("Talep Kurallarını Kabul Etmeniz Gerekmektedir.","Lütfen Önce Stajyer Talep Kurallarını Kabul Ediniz.","bilgi");
			}}else{
			bilgi("Bu Başlık Sistemimize Daha Önce Eklenmiş. ","Bu Başlık Sistemimize Daha Önce Eklenmiş. Lütfen Kontrol Edip Tekrar Deneyiniz...","bilgi");
			}
		}else{Header("Location:../index.php");}
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

}

## Başvuru List Geniş Olan Yer Ana Sayfada ##
function basvurulistana(){

$OgrID = $_SESSION["uid"]; // Başvuruları Listelemek İçin Öğrencinin id Sini çekiyoruz.

$sorgu = mysql_query("select * from  ilanbasvuru where OgrenciID='$OgrID'");
$say = mysql_num_rows($sorgu);

	
		if($say>0){ // Adına Başvuru var ise ;
			while($basgoster=mysql_fetch_array($sorgu)){
			extract($basgoster);
			$ilancek = mysql_query("select * from ilanlar where id='$IlanID'");
			$ilangoster = mysql_fetch_array($ilancek);
			
			$isyeriid = $ilangoster["IsyeriID"];
			
			$isyericek = mysql_query("select * from isyeri where id='$isyeriid'");
			$isyerigoster= mysql_fetch_array($isyericek);
			
			$isyeriadi = $isyericek["IsyeriAdi"];
			
			
			
			$isyeriadi = $isyerigoster["IsyeriAdi"];
			
			if($IsyeriOnay=="1" && $OkulOnay=="1"){ // Başvurusu Onaylanmış İse ;
			echo '<div class="basvuru_durum"><li><a href="index.php?git=basvurudetay&id='.$_SESSION["uid"].'&basvuruid='.$id.'">'.$isyeriadi.' <b> ( Başvurunuz Kabul Edilmiştir ) </b></a></li></div>';
			}else if($IsyeriOnay=="1" || $OkulOnay=="1"){ // Başvuruyu Sadece Okul veya İşyeri Onaylamış İse ;
			echo '<div class="basvuru_durum"><li class="tekonay"><a href="index.php?git=basvurudetay&id='.$_SESSION["uid"].'&basvuruid='.$id.'">'.$isyeriadi.' <b> ( Başvuruyu Okul veya İş Yeri Onayladı )</b> </a></li></div>';
			}else if(!$IsyeriOnay || !$OkulOnay){ // Başvuru İki Taraftan Biri Reddetmişse ;
			echo '<div class="basvuru_durum"><li class="iptalbas"><a href="index.php?git=basvurudetay&id='.$_SESSION["uid"].'&basvuruid='.$id.'">'.$isyeriadi.'<b> ( Başvurunuz Reddedilmiştir )</b> </a></li></div>';
			}else if($IsyeriOnay=="2" && $OkulOnay=="2"){// Henüz Bir İşlem Yapılmamış İse ;
			echo '<div class="basvuru_durum"><li class="beklemede"><a href="index.php?git=basvurudetay&id='.$_SESSION["uid"].'&basvuruid='.$id.'">'.$isyeriadi.'<b>  ( Henüz İşlem Yapılmamış ) </b> </a></li></div>';
			}
			
			}
		
			
		}else{ // Adına Başvur Yok İse ;
		echo '<div class="basvuru_durum"><li class="bosyok">Aktif Başvurunuz Bulunamadı</li></div>';
		}


}

## İşyeri Adı Çekme ##
function isyeri_fonk($id){
$isyeriSorgu = mysql_query("select * from isyeri where id='$id'");
$isyeriCikar = mysql_fetch_array($isyeriSorgu);
echo $isyeriCikar["IsyeriAdi"];

}

## İşyeri Adı Çekme ( Return ile yazdırma )##
function isyeri_fonkret($id){
$isyeriSorgu = mysql_query("select * from isyeri where id='$id'");
$isyeriCikar = mysql_fetch_array($isyeriSorgu);
return $isyeriCikar["IsyeriAdi"];

}

## Öğrenci Profil Güncellemesi ##
function ogrprofilgunc(){

	if($_POST){
		
		$id = $_SESSION["uid"];
		$Cinsiyet = $_POST["Cinsiyet"];
		$Telefon = strip_tags(addslashes(trim($_POST["Telefon"])));
		$Adres = strip_tags(addslashes(trim($_POST["Adres"])));
		$il = $_POST["il"];
		$ilce = $_POST["ilce"];
		$eposta = $_POST["Mail"];
		$LiseTuru = $_POST["LiseTuru"];
		$Hakkinda = strip_tags(addslashes(trim($_POST["Hakkinda"])));
		$dosyaadi = $_FILES["ogrresim"]["name"];

		$OgrenciSorgu = mysql_fetch_array(mysql_query("select * from ogrenci where id='$id'"));

		
		if(empty($OgrenciSorgu["OkulID"])){
		$LiseAdi = $_POST["LiseAdi"];
		}else{
		$LiseAdi = $OgrenciSorgu["OkulID"];
		}
		
		if(empty($OgrenciSorgu["OkulID"])){
		$LiseAdi = $_POST["LiseAdi"];
		}else{
		$LiseAdi = $OgrenciSorgu["OkulID"];
		}
		
		if(empty($OgrenciSorgu["Bolum"])){
		$Bolum = $_POST["Alan"];
		}else{
		$Bolum = $OgrenciSorgu["Bolum"];
		}
		
		if(empty($OgrenciSorgu["Dal"])){
		$Dal = $_POST["Dal"];
		}else{
		$Dal = $OgrenciSorgu["Dal"];
		}
		
		if(empty($OgrenciSorgu["LiseTuru"])){
		$LiseTuru = $_POST["LiseTuru"];
		}else{
		$LiseTuru = $OgrenciSorgu["LiseTuru"];
		}
		
		if(empty($OgrenciSorgu["Sinif"])){
		$Sinif = $_POST["Sinif"];
		}else{
		$Sinif = $OgrenciSorgu["Sinif"];
		}
		
		if(empty($OgrenciSorgu["Sube"])){
		$Sube = $_POST["Sube"];
		}else{
		$Sube = $OgrenciSorgu["Sube"];
		}
		
		if(empty($OgrenciSorgu["OkulNo"])){
		$OkulNo = $_POST["OkulNo"];
		}else{
		$OkulNo = $OgrenciSorgu["OkulNo"];
		}
		
				if(empty($dosyaadi)) {
	$yeniresim = substr($OgrenciSorgu['Resim'],-14);
	$OgrenciGuncelle = mysql_query("UPDATE ogrenci SET Cinsiyet='$Cinsiyet',Telefon='$Telefon',Adres='$Adres' ,il='$il',ilce='$ilce' ,LiseTuru='$LiseTuru',OkulID='$LiseAdi',Bolum='$Bolum',Dal='$Dal',Hakkinda='$Hakkinda',Sinif='$Sinif',Mail = '$eposta',Sube='$Sube',OkulNo='$OkulNo',Resim='profil/ogrenci/$yeniresim' WHERE id=$id");
		if($OgrenciGuncelle){
		bilgi("Güncelleme Başarılı","Profilinizi Başarıyla Güncellediniz","onay");
		header( "Refresh: 3; url=../profilduzenle/" );
		}else{
		bilgi("Bir Hata Meydana Geldi","Sunucudan Kaynaklı Bir Sorun Meydana Geldi Lütfen Tekrar Deneyin");
		}
		}else {
		$dosyatipi = $_FILES["ogrresim"]["type"];
		$dboyut = $_FILES["ogrresim"]["size"];
		$uzanti = substr($dosyaadi, -4);
		$yeniad = substr(md5(uniqid(rand())), 0,10);
		$yeniresim = $yeniad.$uzanti;
		
		
		if($uzanti != ".jpg" && $uzanti != ".png" && $uzanti != ".jpeg" && $uzanti != ".gif" && $uzanti != ".PNG" && $uzanti != ".JPG") {
bilgi("Yüklemeye çalıştığınız dosya bir resim değil!","Dosya uzantısı $uzanti");

}else {
		$ResimGuncelle = move_uploaded_file($_FILES["ogrresim"]["tmp_name"],'profil/ogrenci/'.$yeniresim);
		$OgrenciGuncelle = mysql_query("UPDATE ogrenci SET Cinsiyet='$Cinsiyet',Telefon='$Telefon',Adres='$Adres' ,il='$il',ilce='$ilce' ,LiseTuru='$LiseTuru',OkulID='$LiseAdi',Bolum='$Bolum',Dal='$Dal',Hakkinda='$Hakkinda',Sinif='$Sinif',Sube='$Sube',OkulNo='$OkulNo',Resim='profil/ogrenci/$yeniresim' WHERE id=$id");
		
		if($OgrenciGuncelle && $ResimGuncelle){
		bilgi("Güncelleme Başarılı","Profilinizi Başarıyla Güncellediniz","onay");
		header( "Refresh: 3; url=../profilduzenle/" );
		}else{
		bilgi("Bir Hata Meydana Geldi","Sunucudan Kaynaklı Bir Sorun Meydana Geldi Lütfen Tekrar Deneyin");
		}
		
		}
		
		}

	
	}else{
	Header("Location:../index.php"	);
	}

}

## İlan Görüntüleme ##
function ilandetay(){

if($_SESSION["oturum"]){

	$ilanID = $_GET["id"];
	$ilanSorgu = mysql_query("select * from ilanlar where id='$ilanID'");
	$ilanCikarma = mysql_fetch_array($ilanSorgu);
	extract($ilanCikarma);
	require("ilan.php");
	
}else{
Header("Location:../index.php");
}

}

## Son 5 Mesajı ( OKUL ) ##
function sonbesmesajokul(){
	$Kimeki = $_SESSION["UyelikTuru"].'-'.$_SESSION["uid"];
	$kactane = mysql_query("select * from mesajlar WHERE Kime = '$Kimeki' && AliciSil = '0' ");
	$SayAma = mysql_num_rows($kactane);
	if($SayAma > 0){
	$Ilanlar = mysql_query("select * from mesajlar WHERE Kime = '$Kimeki' && AliciSil = '0' order by  id desc limit 0,5");
	while($CikarMesaj = mysql_fetch_array($Ilanlar)){
	$Yollayan = substr($CikarMesaj['Kimden'],2);
	$YollayanAl = mysql_fetch_array(mysql_query("select * from ogrenci where id='$Yollayan'"));
	$Yollayann = $YollayanAl['Ad']. " ". $YollayanAl['Soyad'];
	
		if($CikarMesaj["Okunma"] == 0){
				echo '<li><a href="mesajoku/'.$CikarMesaj["id"].'">'.$CikarMesaj["Konu"].' ( '.$Yollayann.' )</a></li>';
		}else{
				echo '<li><a href="mesajoku/'.$CikarMesaj["id"].'">'.$CikarMesaj["Konu"].'( '.$Yollayann.' ) - OKUNMAMIŞ !</a></li>';
		}
	
	}
	
	}else{
	echo '<li><a href="#">Henüz Tarafınıza Gönderilmiş Bir Mesaj Yok...</a></li>';
	}
}

## Son 5 Mesajı ( İŞYERİ ) ##
function sonbesmesaj(){
	$Kimeki = $_SESSION["UyelikTuru"].'-'.$_SESSION["uid"];
	$kactane = mysql_query("select * from mesajlar WHERE Kime = '$Kimeki' && AliciSil = '0' ");
	$SayAma = mysql_num_rows($kactane);
	if($SayAma > 0){
	$Ilanlar = mysql_query("select * from mesajlar WHERE Kime = '$Kimeki' && AliciSil = '0' order by  id desc limit 0,5");
	while($CikarMesaj = mysql_fetch_array($Ilanlar)){
	$Yollayan = substr($CikarMesaj['Kimden'],2);
	$YollayanAl = mysql_fetch_array(mysql_query("select * from ogrenci where id='$Yollayan'"));
	$Yollayann = $YollayanAl['Ad']. " ". $YollayanAl['Soyad'];
	
		if($CikarMesaj["Okunma"] == 0){
				echo '<li><a href="mesajoku/'.$CikarMesaj["id"].'">'.$CikarMesaj["Konu"].' ( '.$Yollayann.' )</a></li>';
		}else{
				echo '<li><a href="mesajoku/'.$CikarMesaj["id"].'">'.$CikarMesaj["Konu"].'( '.$Yollayann.' ) - OKUNMAMIŞ !</a></li>';
		}
	
	}
	
	}else{
	echo '<li><a href="#">Henüz Tarafınıza Gönderilmiş Bir Mesaj Yok...</a></li>';
	}
}

## Şirkete Mesaj Gönder ##
function smesajgonder() {
if(!$_SESSION['oturum']) {
header("Location:../index.php");
}elseif ($_SESSION['UyelikTuru'] == 2) { header("Location:../index.php");}else {
if($_POST) { 
$kime = "2-".$_POST['uyeno'];
$kimden =  $_SESSION['UyelikTuru']."-".$_SESSION['uid'];
$konu = $_POST['konu'];
$mesaj = $_POST['mesaj'];
if(empty($konu) || empty($mesaj)) {
bilgi("Mesajınız iletilemedi","Lütfen boş alan bırakmayınız");
header("Refresh: 2; url=../mesajlarim/" );
}else {
$mesajgonder = mysql_query("insert into mesajlar (Kimden,Kime,Konu,Mesaj) values ('$kimden','$kime','$konu','$mesaj')");
if($mesajgonder) {
bilgi("Mesajınız başarıyla iletildi.","Yönlendiriliyorsunuz, lütfen bekleyin..","onay");
header( "Refresh: 2; url=../mesajlarim/" );
}else {
echo "Olmadı";}
}


}else { 
$isyeriid = $_GET['id'];
?>
	<div class="sagbaslik">ŞİRKETE MESAJ GÖNDER</div>
		<div class="hatabildir" style="padding:10px;">
<form action="" method="post">

				<input type="hidden" name="uyeno" value="<?php echo $isyeriid; ?>">
                <li style="border:none;margin-bottom:5px;"> <b><p>Konu : </p></b><input type="text" name="konu" class="profiltxt" /></li>
				<li style="border:none;"> <b><p>Mesajınız : </p></b><textarea rows="0" cols="0" name="mesaj" class="profiltxthata"></textarea></li>
<li style="border:none;"><span><input type="submit" value="Mesajını İlet" class="duzenlebut"></span></li>
	<div style="clear:both"></div>	
</form>
</div>
<div class="buyukalt"></div>
 <?php

}}
}

## Öğrenciye Mesaj Gönder ## 
function mesajgonder() {
if(!$_SESSION['oturum']) {
header("Location:../index.php");
}elseif ($_SESSION['UyelikTuru'] == 1) { header("Location:../index.php");}else {
if($_POST) { 
$kime = "1-".$_POST['uyeno'];
$kimden =  $_SESSION['UyelikTuru']."-".$_SESSION['uid'];
$konu = $_POST['konu'];
$mesaj = $_POST['mesaj'];
if(empty($konu) || empty($mesaj)) {
bilgi("Mesajınız iletilemedi","Lütfen boş alan bırakmayınız");
header("Refresh: 2; url=../mesajlarim/" );
}else {
$mesajgonder = mysql_query("insert into mesajlar (Kimden,Kime,Konu,Mesaj) values ('$kimden','$kime','$konu','$mesaj')");
if($mesajgonder) {
bilgi("Mesajınız başarıyla iletildi.","Yönlendiriliyorsunuz, lütfen bekleyin..","onay");
header( "Refresh: 2; url=../mesajlarim/" );
}else {
echo "Olmadı";}
}


}else { 
$ogrenciid = $_GET['id'];
?>
	<div class="sagbaslik">ÖĞRENCİYE MESAJ GÖNDER</div>
		<div class="hatabildir" style="padding:10px;">
<form action="" method="post">

			
				<input type="hidden" name="uyeno" value="<?php echo $ogrenciid; ?>">
                <li style="margin-bottom:5px;border:none;"> <span><b><p>Konu : </p></b></span><input type="text" name="konu" class="profiltxt" /></li>
				<li style="border:none;"> <span><b><p>Mesajınız : </p></b></span><textarea rows="0" cols="0" name="mesaj" class="profiltxthata"></textarea></li>
		
<li style="border:none;float:right;"><span><input style="cursor:pointer;" type="submit" value="Mesajını İlet" class="duzenlebut"></span></li>
		<div style="clear:both"></div>	
</form>
</div>
<div class="buyukalt"></div>

 <?php

}}
}

## Mesaj Yanıtla ##
function mesajyanitla () {
if(!$_SESSION['oturum']) {
header("Location:../index.php");
}else {

if($_POST) {
$konu = $_POST['konu'];
$mesaj = $_POST['mesaj'];
$kime = $_POST['uyeno'];
$kimuyelik =  $_POST['uyelikturu'];
$kimden =  $_SESSION['id'];
$kimdenuyelik = $_SESSION['UyelikTuru'];
$kimtam = $kimuyelik."-".$kime;
$kimdentam = $kimdenuyelik."-".$kimden;
if(empty($konu) || empty($mesaj)) {
bilgi("Mesajınız iletilemedi","Lütfen boş alan bırakmayınız");
header("Refresh: 2; url=../mesajlarim/" );
}else {
$mesajyolla = mysql_query("insert into mesajlar (Kimden,Kime,Konu,Mesaj) values ('$kimdentam','$kimtam','$konu','$mesaj')");
if($mesajyolla) {
bilgi("Mesajınız başarıyla iletildi.","Yönlendiriliyorsunuz, lütfen bekleyin..","onay");
header( "Refresh: 2; url=../mesajlarim/" );
}else { echo "olmadı";}}


} else {

$uyeliktur =  $_GET['tur'];
$uyeid = $_GET['kime']; 

?>
	<div class="sagbaslik">MESAJ YANITLA</div>
		<div class="hatabildir" style="padding:10px;">
<form action="" method="post">

				<input type="hidden" name="uyeno" value="<?php echo $uyeid; ?>">
				<input type="hidden" name="uyelikturu" value="<?php echo $uyeliktur; ?>">
                <li style="border:none;margin-bottom:5px;"> <span><b><p>Konu : </p></b></span><input type="text" name="konu" class="profiltxt" /></li>
				<li style="border:none;"><span><b><p>Mesajınız : </p></b></span><textarea rows="0" cols="0" name="mesaj" class="profiltxthata"></textarea></li>
<li style="border:none;float:right;"><span><input type="submit" value="Mesajını İlet" class="duzenlebut"></span></li>
	<div style="clear:both"></div>	
</div>
</form>
<div class="buyukalt"></div>
<?php
}
}
} 

## Mesajları Okuma ##
function mesajoku(){

	if($_SESSION["oturum"]){
	$MesajID = $_GET["mesajid"];


	$MesajSorgu = mysql_query("select * from mesajlar where id='$MesajID'");
	$Say = mysql_num_rows($MesajSorgu);
	
	if($Say > 0){
	
	
	
	$MesajOku = mysql_fetch_array($MesajSorgu);
	
	$Kimden = $MesajOku ["Kimden"];
	$Kime = $MesajOku["Kime"];
	$Kimki =  substr($Kimden,0,1);
	$KimeUyelikTuru = substr($Kime,2 );

	$KimdenKi =  substr($Kimden,2 );
	if($_SESSION["uid"] == $KimeUyelikTuru){
	
	extract($MesajOku);
	$OkunduGoruk = mysql_query("UPDATE mesajlar SET Okunma='0' WHERE id='$MesajID'");
	
	echo '<div class="sagbaslik"><h3>'.$Konu.'</h3></div>
	<div class="mesajoku">
	<div style="padding: 5px; margin-right: 5px; margin-bottom: 5px; margin-left: 5px;"><span>'.$Mesaj.'</span></div>
	
	
	<div style="clear: boath;"></div>
	<div class="yanitlabutton"> <a href="mesajyanitla/'.$KimdenKi.'-'.$Kimki.'">YANITLA</a> </div><div class="yanitlabutton"> <a href="okunmadisay/'.$id.'">OKUNMADI SAY</a> </div><div class="silbutton"> <a href="mesajsil/'.$id.'">SİL</a> </div>
	</div><div class="buyukalt"></div>';
	}else{
	
	Header("Location:../index.php");
	
	}
	
	}else{
	
	bilgi("Böyle Bir Mesaj Yok","Sistemimizde Kayıtlı Böyle Bir Mesaj Yok Bulunamadı");
	
	}

	}else{
	Header("Location:../index.php");
	}

}

## Öğrenci İlana Başvuru ##
function OgrIlanBasvuru(){
	
	if($_SESSION["oturum"]){
		if($_SESSION["UyelikTuru"] == 1){
		
			$IlanID = $_GET["id"];
			$OgrenciID = $_SESSION["uid"];
			
			
			$IlanCikar = mysql_query("select * from ilanlar where id = '$IlanID'");
			$IlanSonuc = mysql_fetch_array($IlanCikar);
			
			$Tarih = date("d.m.Y H:i");
			$Ogrcik = mysql_fetch_array(mysql_query("select * from ogrenci where id = '$OgrenciID'"));
			$OkulID = $Ogrcik["OkulID"];
			$BasvuruEkle = mysql_query("insert into ilanbasvuru (OgrenciID,IlanID,OkulOnay,IsyeriOnay,OgrenciOnay,Onay,BasvuruTarihi,OkulID ) values ('$OgrenciID','$IlanID','2','2','2','1','$Tarih','$OkulID')");
			
			if($BasvuruEkle){
			
				$Kimden = "2-1";
				$Kime = '1-'.$_SESSION["uid"];
				$Konu = "Staj Başvurusu Onaylandı!";
				$Mesaj = "Merhaba; Stajyer-i.com üzerinden başvurmuş olduğun staj talebi onaylanmıştır. Şimdi Staj yeri ve Okulun onaylamasını beklemelisin...";
				$OGRID = $_SESSION["uid"];
				$MesajGonder =  mysql_query("insert into mesajlar (Kimden,Kime,Konu,Mesaj) values ('$Kimden','$Kime','$Konu','$Mesaj')");
				if(!$MesajGonder){
				bilgi("Bir Sorun Meydana Geldi","Lütfen Daha Sonra Tekrar Deneyin");
				}
				$OGRID2 = $_SESSION["uid"];
				$IsyeriID = $IlanSonuc["IsyeriID"];
				$IlanBaslik = $IlanSonuc["Baslik"];
				$IlanID = $IlanSonuc["id"];
				$BasvuranOgrenci = mysql_query("select * from ogrenci where id='$OGRID2'");
				$OgrenciSonuc = mysql_fetch_array($BasvuranOgrenci);
				$OgrenciAdi = $OgrenciSonuc["Ad"].' '.$OgrenciSonuc["Soyad"];
				
				$Kimden2 = '2-1';
				$Kime2 = '2-'.$IsyeriID;
				$Konu2 = 'Stajyer Talebinize Yeni Bir Başvuru Var !';
				$Mesaj2 = 'Merhaba; Stajyer-i.com üzerinden açmış olduğunuz <a href=\"index.php?git=ilan&id='.$IlanID.'"><b>"'.$IlanBaslik.'"</b></a> Başlıklı stajyer talebinize <a href=\"index.php?git=profilogrenci&id='.$OGRID2.'"><b>"'. $OgrenciAdi .'"</b></a> Adlı öğrenci başvuruda bulundu. Şimdi ilanınıza giderek öğrenciyi onaylayabilirsiniz. ';
				$MesajGonder2 = mysql_query("insert into mesajlar (Kimden,Kime,Konu,Mesaj) values ('$Kimden2','$Kime2','$Konu2','$Mesaj2')");
				if(!$MesajGonder2){
				bilgi("Bir Sorun Meydana Geldi","Lütfen Daha Sonra Tekrar Deneyin");
				}
				$IlanBul = mysql_fetch_array(mysql_query("select * from isyeri where id = '$IsyeriID'"));
				$IlanSahibi = $IlanBul["IsyeriAdi"]; 
				$Kimden3 = "2-1";
				$Kime3 = '0-'.$OkulID;
				$Konu3 = "Bir Öğrenciniz Staj Başvurusunda Bulundu";
				$Mesaj3 = 'Merhaba; <br /> Öğrencilerinizden<b>'.$Ogrcik["Ad"].' '.$Ogrcik["Soyad"].'</b> Aşağıda ki ilana başvurmuştur. İş Girişi Bekleyen Öğrenciler Kısmında Bu Öğreninizin İş Girinişini Onaylaya Bilirsiniz <br /><br/>
				<a href="index.php?git=ilan&id='.$IlanID.'"><b> "'.$IlanBaslik.' - '.$IlanSahibi.'"</b></a>';
				$MesajGonder3 = mysql_query("insert into mesajlar (Kimden,Kime,Konu,Mesaj) values ('$Kimden3','$Kime3','$Konu3','$Mesaj3')");
				
				 
				bilgi("Başvurunuz Alındı.","Staj başvurunuz alındı, detaylı bilgi için gelen kutunuza bakınız","onay");
				
			
			}else{
			bilgi("Bir Sorun Meydana Geldi","Lütfen tekrar Deneyiniz...");
			}
		
		}else{
		bilgi("Bu alan sadece öğrenciler içinidir.","Yetkiniz olmayan bir alana girmeye çalıştınız!!","bilgi");
		}
	}else{
	Header("Location:../index.php"	);
	}

}

## Öğrenci Başvuru Detayı ##
function basvurudetay(){

	if($_SESSION["oturum"]){
		
		$OgrenciID = $_SESSION["uid"];
		$BasvuruID = $_GET["basvuruid"];
		if($_SESSION["uid"] == $OgrenciID){
		
		$BasvuruSorgula = mysql_query("select * from ilanbasvuru where id='$BasvuruID' && OgrenciID='$OgrenciID'");
		$BasvuruSay = mysql_num_rows($BasvuruSorgula);
		
		if($BasvuruSay > 0){
		
			$DetayCik = mysql_fetch_array($BasvuruSorgula);

			require("basvurudetay.php");
		
		}else{
		bilgi("Böyle Bir Başvuru Yok !","Size Ait Böyle Bir Başvuru Bulunamadı");
		
		}
	}else{
	bilgi("Bu alana giriş yetkiniz yok","Bu alan size ait değildir");
	}
	}else{
		Header("Location:../index.php"	);
	}

}

## Öğrenci Bilgilerini Düzenleme ( OKUL ) ##
function okulduzenleogr(){
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 0){
	// Gelen Bilgileri Al
	$OgrID = $_GET["id"];
	$Adi = $_POST["Adi"];
	$Soyadi = $_POST["Soyadi"];
	$SefLinkVeri = $Adi.' '.$Soyadi.' '.$OgrID;
	$SefLink = sef_link($SefLinkVeri);
	$Cinsiyet = $_POST["Cinsiyet"];
	$Mail = $_POST["Mail"];
	$Telefon = $_POST["Telefon"];
	$Adres = $_POST["Adres"];
	$il = $_POST["il"];
	$ilce = $_POST["ilce"];
	$LiseTuru = $_POST["LiseTuru"];
	$Alan = $_POST["Alan"];
	$Dal = $_POST["Dal"];
	$Hakkinda = $_POST["Hakkinda"];
	$Disiplin = $_POST["Disiplin"];
	$NotOrtalamasi = $_POST["NotOrtalamasi"];
	$Protez = $_POST["Protez"];
	$Sinif = $_POST["Sinif"];
	$Sube = $_POST["Sube"];
	$OkulNo = $_POST["OkulNo"];
	$OkulOnay = $_POST["OkulOnay"];
	$Resim = $_POST["ogrresim"];
	$SSKNo = $_POST["SSKNo"];
	$GirisTarihi = $_POST["GirisTarihi"];
	$CikisTarihi = $_POST["CikisTarihi"];
	
	if(empty($Resim)){
	$OgrenciResimSorgu = mysql_query("select * from ogrenci where id = '$OgrID'");
	$Ogrencicikar = mysql_fetch_array($OgrenciResimSorgu);
	$Resim = $Ogrencicikar["Resim"];
	}
	
	$OgrenciGuncelle = mysql_query("update ogrenci set 	Ad = '$Adi', Soyad ='$Soyadi', OgrenciSef = '$SefLink',Cinsiyet='$Cinsiyet',Mail='$Mail',Telefon='$Telefon',Adres='$Adres',il='$il',ilce='$ilce',LiseTuru='$LiseTuru',Bolum='$Alan',Dal='$Dal',Hakkinda='$Hakkinda',Disiplin='$Disiplin',NotOrtalamasi='$NotOrtalamasi',KullandigiProtez='$Protez',Resim='$Resim',Sinif='$Sinif',Sube='$Sube',OkulNo='$OkulNo',OkulOnay='$OkulOnay', SSKNo = '$SSKNo', GirisTarihi ='$GirisTarihi', CikisTarihi='$CikisTarihi' where id = '$OgrID'");
	if($OgrenciGuncelle){
	bilgi("Güncelleme Başarılı","Öğrencinizi Başarıyla Güncellediniz. Yönlendiriliyorsunuz ...","onay");
	header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}"); 
	}else{
	bilgi("Güncelleme YAPILAMADI !","Güncelleme Bir Sorundan Dolayı Yapılamadı. Lütfen Tekrar Deneyin. Yönlendiriliyorsunuz...");
	header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}"); 
	}
	
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

}

## Okul Bul ##  
function okulbul(){

	$OkulID = $_SESSION["OkulID"];
	$SorguOkul = mysql_query("select * from okul where id='$OkulID'");
	$SorguOkulAc = mysql_fetch_array($SorguOkul);
	extract($SorguOkulAc);

	echo $OkulAdi;
}

## Lise Türü Bul ##
function liseturun(){

	$LiseTuru = $_SESSION["LiseTuru"];
	$SorguOkulTuru = mysql_query("select * from liseturu where id='$LiseTuru'");
	$SorguOkulTuruAc = mysql_fetch_array($SorguOkulTuru);
	extract($SorguOkulTuruAc);

	echo $LiseTuru;
}

## İlan Ekleme ( İŞ YERİ ) ##
function ilanekle(){

	if($_SESSION["oturum"]){

		if($_SESSION["UyelikTuru"] == 2){
		
			require("ilanekle.php");
		
		}else{
		Header("Location:../index.php"	);
		}

	}else{
	Header("Location:../index.php"	);
	}
}

## Bölüm - Alanı Boş İse Yazdırma ##
function bolumler(){

$BolumSorgulama = mysql_query("select * from alanlar");
echo '<select class="profilsel" name="Alan"> <option value="0" disabled="disabled">Seçiniz</option>';
while($BolumGoster = mysql_fetch_array($BolumSorgulama)){
	
	echo '<option value="'.$BolumGoster["id"].'">'.$BolumGoster["Alan"].'</option>';

}
echo '</select>';

}

## Başvuruda Bulunabileceği Şirketler ##
function basvurulabil(){

$il = $_SESSION["il"];
$bolum = $_SESSION["Bolum"];

$isyeribul = mysql_query("select * from isyeri where il='$il' && IsAlani ='$bolum' && StajyerTalebi = '1'");
$isyeribulsay = mysql_num_rows($isyeribul);

if($isyeribulsay > 0){

	while($isyeribulgoster = mysql_fetch_array($isyeribul)){
	extract($isyeribulgoster);
	
	echo '<div class="tavsiyeisyeri"><li><a href="index.php?git=profilisyeri&id='.$id.'">'.$IsyeriAdi.'</a></li></div>'  ;
	}

}else{
echo "Tarafınıza Uygun Staj Yeri Listelenemedi ";
}


}

## İşyeri Profil Güncelleme ##
function isyeriguncelle(){

	if($_SESSION["oturum"]){
		
		if($_POST){
		$id = $_SESSION["uid"];
			$ogrencisorgu = mysql_query("select * from isyeri where id='$id'");
			$OgrenciCikar = mysql_fetch_array($ogrencisorgu);
			$OgrenciEskiSifresi = $OgrenciCikar["Sifre"];
			$IsyeriAdi = $_POST["IsyeriAdi"];
			$IsyeriSef = sef_link($IsyeriAdi);
			$Adi = $_POST["Ad"];
			$Soyadi = $_POST["Soyad"];
			$Unvan = $_POST["Unvan"];
			$VergiNo = $_POST["VergiNo"];
			$Telefon = $_POST["Telefon"];
			$fax = $_POST["Fax"];
			$Adres = $_POST["Adres"];
			$il = $_POST["il"];
			$ilce = $_POST["ilce"];
			$ustaogr1 = $_POST["ustaogr1"];
			$ustaogr2 = $_POST["ustaogr2"];
			$ustaogr3 = $_POST["ustaogr3"];
			$isalani = $_POST["isalani"];
			$dosyaadi = $_FILES["firmaresim"]["name"];
			
			$IsyeriSorgu = mysql_fetch_array(mysql_query("select * from isyeri where id='$id'"));
	
		
			$Md5siz = $_POST["EskiSifre"];
			$EskiSifre = md5(sha1($_POST["EskiSifre"]));
			if($Md5siz == ""){
				if(empty($dosyaadi)) {
				
		$yeniresim = substr($IsyeriSorgu['Resim'],-14);
				$IsyeriGuncelle =  mysql_query("UPDATE isyeri SET Ad = '$Adi', Soyad ='$Soyadi',Unvan = '$Unvan',IsyeriAdi='$IsyeriAdi',IsyeriSef='$IsyeriSef', VergiNo='$VergiNo',Telefon='$Telefon',Adres ='$Adres', il='$il', ilce ='$ilce',IsAlani='$isalani',Fax='$fax',UstaOgretici1='$ustaogr1', UstaOgretici2='$ustaogr2', UstaOgretici3 = '$ustaogr3',Resim='profil/isyeri/$yeniresim' WHERE id='$id'");
					if($IsyeriGuncelle){
					bilgi("Profiliniz Başarıyla Güncellendi.","Profilinizi Başarıyla Güncellediniz...","onay");
					}else{
					bilgi("Bir Hatayla Karşılaştınız","Bilgileriniz Güncellenemedi");
					}
		}else {
		$dosyatipi = $_FILES["firmaresim"]["type"];
		$dboyut = $_FILES["firmaresim"]["size"];
		$uzanti = substr($dosyaadi, -4);
		$yeniad = substr(md5(uniqid(rand())), 0,10);
		$yeniresim = $yeniad.$uzanti;
		if($uzanti != ".jpg" && $uzanti != ".png" && $uzanti != ".jpeg" && $uzanti != ".gif" && $uzanti != ".PNG" && $uzanti != ".JPG") {
bilgi("Yüklemeye çalıştığınız dosya bir resim değil!","Dosya uzantısı $uzanti");

}else {
		$ResimGuncelle = move_uploaded_file($_FILES["firmaresim"]["tmp_name"],'profil/isyeri/'.$yeniresim);
			$IsyeriGuncelle =  mysql_query("UPDATE isyeri SET Ad = '$Adi', Soyad ='$Soyadi',Unvan = '$Unvan',IsyeriAdi='$IsyeriAdi',IsyeriSef='$IsyeriSef', VergiNo='$VergiNo',Telefon='$Telefon',Adres ='$Adres', il='$il', ilce ='$ilce',IsAlani='$isalani',Fax='$fax',UstaOgretici1='$ustaogr1', UstaOgretici2='$ustaogr2', UstaOgretici3 = '$ustaogr3',Resim='profil/isyeri/$yeniresim' WHERE id='$id'");
					if($IsyeriGuncelle){
					bilgi("Profiliniz Başarıyla Güncellendi.","Profilinizi Başarıyla Güncellediniz...","onay");
					}else{
					bilgi("Bir Hatayla Karşılaştınız","Bilgileriniz Güncellenemedi");
					}}
		}
			
			}else{
			$YeniSifre = md5(sha1($_POST["YeniSifre"]));
			$YeniSifreTekrar = md5(sha1($_POST["YeniSifreTekrar"]));
			
			if($EskiSifre == $OgrenciEskiSifresi){
			
				if($YeniSifre == $YeniSifreTekrar){

					$IsyeriGuncelle =  mysql_query("UPDATE isyeri SET Ad = '$Adi', Soyad ='$Soyadi',Unvan = '$Unvan',IsyeriAdi='$IsyeriAdi',IsyeriSef='$IsyeriSef', Sifre='$YeniSifre', VergiNo='$VergiNo',Telefon='$Telefon',Adres ='$Adres', il='$il', ilce ='$ilce',IsAlani='$isalani',Fax='$fax',UstaOgretici1='$ustaogr1', UstaOgretici2='$ustaogr2', UstaOgretici3 = '$ustaogr3' WHERE id='$id'");
					if($IsyeriGuncelle){
					bilgi("Profiliniz Başarıyla Güncellendi.","Profilinizi Başarıyla Güncellediniz...","onay");
					}else{
					bilgi("Bir Hatayla Karşılaştınız","Bilgileriniz Güncellenemedi");
					}
				
				}else{
				bilgi("Yeni Şifreleriniz Uyuşmuyor !","Girmiş olduğunu şifreler uyuşmuyor. Lütfen Tekrar Deneyin","bilgi");
				}
				
				
			}else{
			bilgi("Şifreniz Uyuşmuyor !","Girmiş olduğunuz aktif şifreniz şu anki şifreniz değildir, Güncelleme Yapılamadı","bilgi");
			}
			}
			
			
		
		}else{
		Header("Location:index.php"	);
		}

	}else{
	Header("Location:index.php"	);

	}

}

## Öğrenci Stajyeri ##
function stajyerim(){

if($_SESSION["oturum"]){

	if($_SESSION["UyelikTuru"] == 1){
	$OgrenciID = $_SESSION["uid"];
	$BasvurusuVarmıKi = mysql_query("select * from ilanbasvuru where OgrenciID = '$OgrenciID' && OkulOnay = '1' && IsyeriOnay='1' && OgrenciOnay='1' && Onay = '1'");
	$Onaylimi = mysql_num_rows($BasvurusuVarmıKi);
	
		if($Onaylimi > 0){
		$GosterBasvuru= mysql_fetch_array($BasvurusuVarmıKi);
		$IlanID = $GosterBasvuru["IlanID"];
		$IlanCek = mysql_query("select * from ilanlar where id='$IlanID'");
		$IlanVarMi = mysql_num_rows($IlanCek);
		
			if($IlanVarMi > 0){
			$IlanGoster = mysql_fetch_array($IlanCek);
			
				$IsyeriID = $IlanGoster["IsyeriID"];
				
				$IsyeriCek = mysql_query("select * from isyeri where id = '$IsyeriID'");
				$IsyeriSay = mysql_num_rows($IsyeriCek);
				
				if($IsyeriSay > 0){
				
					$IsyeriOrtayaDok = mysql_fetch_array($IsyeriCek);
					extract($IsyeriOrtayaDok);
					require("stajyerim.php");
				
				}else{
				bilgi(" Bu İşyeri Sistemimizden Silinmiştir.","Bu işyeri sistemimizden silinmiştir, Lütfen bizimle iletişime geçiniz.","bilgi"); 
				header( "Refresh: 3; url=../index.php" );
				}
			
			}else{
			bilgi(" Bu İlan Sistemden Silinmiştir","İlan silinmesinden dolayı staj yeri bilgilerine ulaşamıyoruz. Lütfen bizimle iletişime geçiniz","bilgi"); 
			header( "Refresh: 3; url=../index.php" );
			}
		}else{
		bilgi("Henüz Stajyeri Girişiniz Bulunmuyor","Giriş Yapmış Olduğunuz Stajyeri Bulunamadı","bilgi");
		}
	
	}else{
	Header("Location:../index.php"	);
	}
}else{
Header("Location:../index.php"	);
}

}

## Başvuru Onaylama [Öğrenci]
function basvuruonaylama(){
if($_SESSION["oturum"]){

	$BasvuruID = $_GET["basvuruid"];
	
	$BasvuruSorgu = mysql_query("select * from ilanbasvuru where id='$BasvuruID'");
	$BasvuruCikar = mysql_fetch_array($BasvuruSorgu);
	extract($BasvuruCikar);
	
	if($OkulOnay == 1 && $IsyeriOnay == 1 && $Onay == 1 && $OgrenciOnay == 2){
		$OgrenciID = $_SESSION["uid"];
		$OgrenciCikarmasi = mysql_fetch_array(mysql_query("select * from ogrenci where id = '$OgrenciID'"));
		$OkulID = $OgrenciCikarmasi["OkulID"];
		$IsyeriGiris = mysql_query("UPDATE ilanbasvuru SET OgrenciOnay = '1' WHERE id='$BasvuruID'");
		if($IsyeriGiris){
			
			$OgrenciBasvurulari = mysql_query("select * from ilanbasvuru where OgrenciID='$OgrenciID' && OgrenciOnay='2'");
			$OgrenciBasvuruSay = mysql_num_rows($OgrenciBasvurulari);
			
			if($OgrenciBasvuruSay > 0){
			while($OgrenciBasvuruDus = mysql_fetch_array($OgrenciBasvurulari)){
			
				$BasvuruID = $OgrenciBasvuruDus["id"];
				$BasvuruDusArtik = mysql_query("UPDATE ilanbasvuru SET OgrenciOnay = '0' WHERE OgrenciID='$OgrenciID' && OgrenciOnay='2'");
				
				
				
				
				
				if(!$BasvuruDusArtik){
				bilgi("Bir Sorun Meydana Geldi!","Lütfen Daha Sonra Tekrar Deneyin");
				}
		
				
			
			}
			}
				$IlanBul = mysql_query("select * from ilanlar where id='$IlanID'");
				$IlanSonuc = mysql_fetch_array($IlanBul);
				$IsyeriID = $IlanSonuc["IsyeriID"];
				
				#### işlem kodu oluşturma, 3 kere kontrol ediyor. ilk olmayanı veritabanına kayıt ediyor #####
				$IslemKoduOlustur = rand(1000,60000);  // İşlem kodu oluşturma. 
				$IslemKoduSorgu = mysql_query("select * from isgiris where IslemKodu ='$IslemKoduOlustur'");
				$IslemKoduKac = mysql_fetch_array($IslemKoduSorgu);
				if($IslemKoduKac > 0){
				
				$IslemKoduOlustur = rand(1000,60000); 
					$IslemKoduSorgu = mysql_query("select * from isgiris where IslemKodu ='$IslemKoduOlustur'");
					$IslemKoduKac = mysql_fetch_array($IslemKoduSorgu);
					if($IslemKoduKac > 0){
					$IslemKoduOlustur = rand(1000,60000);
					}
				}
				#################################################################################################
				
				$IsGirisiOlustur = mysql_query("insert into isgiris (IsyeriID,OgrenciID,IlanID,IslemKodu,Durum,Onay,OkulID) values ('$IsyeriID','$OgrenciID','$IlanID','$IslemKoduOlustur','1','1','$OkulID')");
			
				$Kimden = "2-1";
				$Kime = '1-'.$_SESSION["uid"];
				$Konu = "Yeni Stajın Hakkında!";
				$Mesaj = "Merhaba; Stajyer-i.com u kullanarak stajyerini buldun! Artık seninde bir stajyerin var. Unutmadan söyleyelim Sistemdeki diğer başvuruların iptal edildi.";
				$OGRID = $_SESSION["uid"];
				$OgrenciDurumuGit = mysql_query("UPDATE ogrenci SET StajBaslama = '1' WHERE id='$OgrenciID'");
				$MesajGonder =  mysql_query("insert into mesajlar (Kimden,Kime,Konu,Mesaj) values ('$Kimden','$Kime','$Konu','$Mesaj')");
				if(!$MesajGonder){
				bilgi("Bir Sorun Meydana Geldi","Lütfen Daha Sonra Tekrar Deneyin");
				}
		bilgi("TEBRİKLER ! Artık Bir Stajyerin Var. ","Detaylar İçin Mesajlarına Bak. Orada Gerekli Açıklamalar Yer Alıyor.","onay");
		}else{
		bilgi("Bir Sorun Meydana Geldi","Lütfen Daha Sonra Tekrar Deneyin");
		}
		
	}else{
	bilgi("Onaylanacak İlan Bulunamadı","Onaylamanız Gereken İlan Bulunamadı","bilgi");
	}
	
	

}else{
Header("Location:index.php"	);
}



}

## Mesajlarım ##
function mesajlarim(){

	if($_SESSION["oturum"]){
	echo '<div class="sagbaslik">Mesajlarım</div>
		<div class="sonbascurular">';
	$Kimeki = $_SESSION["UyelikTuru"].'-'.$_SESSION["uid"];
	$kactane = mysql_query("select * from mesajlar WHERE Kime = '$Kimeki' && AliciSil = '0' ");
	$varmiki = mysql_num_rows($kactane);
	$sayfa = $_GET["sayfa"];
	if (empty($sayfa) || !is_numeric($sayfa)){
	$sayfa = 1;
	}
		$kacar = 10;
		$ksayisi = mysql_num_rows(mysql_query("select * from mesajlar WHERE Kime = '$Kimeki' && AliciSil = '0'"));
		$ssayisi = ceil($ksayisi/$kacar);
		$nereden = ($sayfa*$kacar)-$kacar;
		
		if ($sayfa > 9999999){
		require("404.php");
		}else{
		$Ilanlar = mysql_query("select * from mesajlar WHERE Kime = '$Kimeki' && AliciSil = '0' order by  id desc limit $nereden,$kacar");
	$saykac = 0;
	$gosterdim = 0;
	if($varmiki > 0){
	while($MesajlaraBak = mysql_fetch_array($Ilanlar)){
	
	
	
		$Kimden = $MesajlaraBak["Kimden"];
		$Kime = $MesajlaraBak["Kime"];
		
		$KimeUyelikTuru = substr($Kime, 0, 1);
		$KimeUyelikSahibi = substr($Kime, 2);
	
			
			if($KimeUyelikSahibi == $_SESSION["uid"] and $KimeUyelikTuru == $_SESSION["UyelikTuru"] and $_SESSION["UyelikTuru"] == 1){
				$saykac = 1;
				extract($MesajlaraBak);
				$Kimden = substr($Kimden, 2);
				$GonderenBul = mysql_query("select * from isyeri where id='$Kimden'");
				$GonderenCikar = mysql_fetch_array($GonderenBul);
				$KimmisO = $GonderenCikar["IsyeriAdi"];
				
				if($Okunma == 0){
				echo '<div class="mesaj_baslik"><h3><a href="mesajoku/'.$id.'">'.$Konu.' ( '.$KimmisO.' )</a></h3></div>';
				}else{
				echo '<div class="mesaj_baslikyeni"><h3><a href="mesajoku/'.$id.'">'.$Konu.'( '.$KimmisO.' ) - OKUNMAMIŞ !</a></h3></div>';
				}
			}
			elseif($KimeUyelikSahibi == $_SESSION["uid"] and $KimeUyelikTuru == $_SESSION["UyelikTuru"] and $_SESSION["UyelikTuru"] == 2){
				$saykac = 1;
				extract($MesajlaraBak);
				$Kimden = substr($Kimden, 2);
				$GonderenBul = mysql_query("select * from ogrenci where id='$Kimden'");
				$GonderenCikar = mysql_fetch_array($GonderenBul);
				$KimmisO = $GonderenCikar["Ad"];
				$KimmisO .= " ".$GonderenCikar["Soyad"];
				
				if($Okunma == 0){
				echo '<div class="mesaj_baslik"><h3><a href="mesajoku/'.$id.'">'.$Konu.' ('.$KimmisO.'  )</a></h3></div>';
				}else{
				echo '<div class="mesaj_baslikyeni"><h3><a href="mesajoku/'.$id.'">'.$Konu.'( '.$KimmisO.' ) - OKUNMAMIŞ !</a></h3></div>';
				}
			}elseif($KimeUyelikSahibi == $_SESSION["uid"] and $KimeUyelikTuru == $_SESSION["UyelikTuru"] and $_SESSION["UyelikTuru"] == 0){
				$saykac = 1;
				extract($MesajlaraBak);
				$Kimden = substr($Kimden, 2);
				$GonderenBul = mysql_query("select * from isyeri where id='$Kimden'");
				$GonderenCikar = mysql_fetch_array($GonderenBul);
				$KimmisO = $GonderenCikar["IsyeriAdi"];
				
				if($Okunma == 0){
				echo '<div class="mesaj_baslik"><h3><a href="mesajoku/'.$id.'">'.$Konu.' ('.$KimmisO.'  )</a></h3></div>';
				}else{
				echo '<div class="mesaj_baslikyeni"><h3><a href="mesajoku/'.$id.'">'.$Konu.'( '.$KimmisO.' ) - OKUNMAMIŞ !</a></h3></div>';
				}
			}
			else{
			
			if($saykac == 0){
			
				if($gosterdim == 0){
				bilgi("Hiç Mesajınız Yok","Tarafınıza Gönderilmiş Hiç Mesaj Yok","bilgi");
				$gosterdim = 1;
				
				}
				
			}
			
			}
		
	
	}
				if($ksayisi > $kacar){
			 echo '<center><div class="sayfala">';
			for ($i=1;$i <= $ssayisi; $i++){
				
				echo '<a href="index.php?git=mesajlarim&sayfa='.$i.'"';
				if ($sayfa == $i) {
				echo 'class="aktif"';
				}
				echo '>'.$i.'</a>';
				
				}
				echo '</div></center>';
				 }
				 echo '</div><div class="buyukalt"></div>';
	}else{
	bilgi("Hiç Mesajınız Yok","Tarafınıza Gönderilmiş Hiç Mesaj Yok","bilgi");
	echo '</div><div class="buyukalt"></div>';
	}}}else{
	
	Header("Location:../index.php"	);
	
	}


}

## Lise Türü Çekme ##
function liseturleri(){
$sorgu = mysql_query("select * from liseturu");
 echo '<select name="LiseTuru" class="profilsel">

 ';
 
	while($cikar = mysql_fetch_array($sorgu)){

		extract($cikar);

			if($_SESSION["LiseTuru"] == $id){
				
				echo '<option value="'.$id.'" selected>'.$LiseTuru.'</option>';
				
			}else{
				echo '<option value="'.$id.'">'.$LiseTuru.'</option>';
			} 

	}
	echo '</select>';
}

## İş yeri kayıt ##
function isyerikayit(){

	if(!$_SESSION["oturum"]){
			if($_POST){
			$IsyeriAdi = strip_tags(addslashes(trim($_POST["isyeri"])));
			$Sifre = strip_tags(addslashes(trim($_POST["parola"])));
			$Sifre2 = strip_tags(addslashes(trim($_POST["parola2"])));
			$sonid = mysql_fetch_array(mysql_query("select * from isyeri order by id desc limit 1"));
			$sonids=$sonid["id"];
			///////////////////////////
			$EklenecekID = $sonids + 1;
			$EPosta = strip_tags(addslashes(trim($_POST["eposta"])));
			$EPosta2 = strip_tags(addslashes(trim($_POST["eposta2"])));
			$VergiNo = strip_tags(addslashes(trim($_POST["vergino"])));
			
			$il = strip_tags(addslashes(trim($_POST["il"])));
			/// Son Veritabanındaki kayıtı bulma
			$sonid = mysql_fetch_array(mysql_query("select * from isyeri order by id desc limit 1"));
			$sonids=$sonid["id"];
			///////////////////////////
			$EklenecekID = $sonids + 1;
			$IsyeriSefOlustur = $IsyeriAdi.' '.$EklenecekID;
			$IsyeriBuyuk = turkceKarakter($IsyeriAdi);
			$IsyeriSef = sef_link($IsyeriSefOlustur);
			$IPAdres = IPAdres();
			$KayitTarihi = date("d.m.Y H:i");
			$kural = $_POST['kural'];
			if(!$kural) { bilgi("Gizlilik politikamızı kabul etmelisiniz","Kaydınız gerçekleştirilemedi."); }
			elseif(empty($IsyeriAdi) || empty($Sifre) || $il == "0" || empty($EPosta) || empty($VergiNo) ||  $IsyeriAdi == "İşletme Adı" || $Sifre == "Şifre" || $EPosta == "E-Posta" || $VergiNo == "Vergi No" || $Telefon == "Telefon"){
			bilgi("Boş Alan Bırakmadan Tekrar Deneyiniz.","Lütfen Formda Boş Alan Bırakmadan Tekrar Kayıt Olun.");
			
			}else if($Sifre != $Sifre2){
			bilgi("Şifreler uyuşmuyor!","Girmiş olduğunuz şifreler uyuşmuyor. Lütfen iki kutucuğada aynı şifreyi giriniz. ");
			}else if($EPosta != $EPosta2){
			bilgi("Mailler uyuşmuyor!","Girmiş olduğunuz mailler uyuşmuyor. Lütfen iki kutucuğada aynı maili giriniz. ");
			}
			
			else{
			$SifreMDle = md5(sha1($Sifre));
			$BuIsyeriVarmi = mysql_num_rows(mysql_query("select * from isyeri where IsyeriAdi = '$IsyeriAdi' || Mail = '$EPosta'"));
			if($BuIsyeriVarmi > 0){
			bilgi("Bu işyeri daha önce zaten kayıt olmuş","Sistemimide bu işyeri zaten bulunuyor. Yönlendiriliyorsunuz.");
			header( "Refresh: 3; url=index.php" );
			}else{
			$VerileriKayitEt = mysql_query("insert into isyeri (IsyeriAdi,IsyeriSef,Mail,Sifre,VergiNo,il,KayitTarihi,IPAdres,Onay,UyelikTuru)	values ('$IsyeriBuyuk','$IsyeriSef','$EPosta','$SifreMDle','$VergiNo','$il','$KayitTarihi','$IPAdres','0','2')");
			if($VerileriKayitEt){
			bilgi("Başarıyla Kayıt Oldunuz","Kayıt işlemi başarılı, yönlendiriliyorsunuz...","onay");
			$MailAdresiAl = $EPosta;
			$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
			$mailBilgi .= 'Content-type: text/html;' . "\r\n";
			$mailBilgi .= 'From: bilgi@stajyer-i.com <bilgi@stajyer-i.com>' . "\r\n";
			$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

			$aliciAdres= $MailAdresiAl;
			$epostaKonu = 'Stajyer-i.com | Yeni Uyelik';
			$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;"><div style="background:#0099FF;padding:8px;text-align:center;">
			<img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>Merhaba <strong>'.$IsyerıBuyuk.'</strong> ; <br/>
			<br/>Stajyer-i.com a başarıyla üye oldunuz. Artık sizde yeni ilanlar açarak stajyer alabilirsiniz. Moderatörlerimiz 24 saat içerisinde
			hesabınızı kontrol edip tarafınıza ulaşacaktır. <br /><br />Stajyer-i.com u seçtiğiniz için teşekkür ederiz. <br /><br /><br /><b>Stajyer-i.com Ekibi </b>
			</div>';
			mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
			header( "Refresh: 3; url=index.php" );
			}else{
			bilgi("Bir sorun meydana geldi","Sunucu kaynaklı bir sorun meydana geldi, yönlendiriliyorsunuz");
			header( "Refresh: 3; url=index.php" );
			}
			}
		
			}
			
			}else{
			Header("Location:index.php");
			}
		}else{
		Header("Location:index.php");
		}

}

## İlçeler ##
function ilceler(){
mysql_query (" SET CHARACTER SET utf-8");
$ogrenci = $_SESSION['uid'];
if($_SESSION["UyelikTuru"] == 1){
$ogr = mysql_fetch_array(mysql_query("select * from ogrenci where id='$ogrenci'"));
}else if($_SESSION["UyelikTuru"] == 2){$ogr = mysql_fetch_array(mysql_query("select * from isyeri where id='$ogrenci'"));}else if($_SESSION["UyelikTuru"] == 0){$ogr = mysql_fetch_array(mysql_query("select * from okul where id='$ogrenci'"));}
$ogril = $ogr['il'];
$ogrilce = $ogr['ilce'];
$ilcecek = mysql_query("select * from ilceler where il_id='$ogril'");
echo '<option disabled>Seçiniz </option>';
while($ilcegoster = mysql_fetch_array($ilcecek)){
extract($ilcegoster);
if($ogrilce == $id){
echo '<option value="'.$id.'"  selected>'.$ilce.'</option>';
}else{
echo '<option value="'.$id.'">'.$ilce.'</option>';
}
}

}

## İller ##
function iller(){
mysql_query (" SET CHARACTER SET utf-8");
$ilcek = mysql_query("select * from iller");
echo '<option disabled>Seçiniz </option>';
while($il = mysql_fetch_array($ilcek)){
extract($il);
$ogrenci = $_SESSION['uid'];
if($_SESSION["UyelikTuru"] == 1){
$ogr = mysql_fetch_array(mysql_query("select * from ogrenci where id='$ogrenci'"));
$ogril = $ogr['il'];
}else if($_SESSION["UyelikTuru"] == 2){
$ogr = mysql_fetch_array(mysql_query("select * from isyeri where id='$ogrenci'"));
$ogril = $ogr['il'];
}else if($_SESSION["UyelikTuru"] == 0){
$ogr = mysql_fetch_array(mysql_query("select * from okul where id='$ogrenci'"));
$ogril = $ogr['il'];
}
if($ogril == $id){
echo '<option value="'.$id.'"  selected>'.$il.'</option>';
}else{
echo '<option value="'.$id.'">'.$il.'</option>';
}

}

}

## İllerden İlçe Bulma ##
function ildenilce(){


// gerekli vt bağlantı dosyasını çağırdığını varsayalım
// gerekli vt bağlantı dosyasını çağırdığını varsayalım
$id = (int)$_POST["id"];
$ilceBul = mysql_query("select * from ilceler where il_id='$id'");
while ($ilce = mysql_fetch_array($ilceBul)){
echo '<option value="'.$ilce["id"].'">'.$ilce["ilce"].'</option>';
}



}

## İş Alanı ( İŞ YERİ ) ##
function isalaniis(){
$IsAlani = $_SESSION["IsAlani"];
$SorguIsAlani = mysql_query("select * from alanlar");

while($SorguCikar = mysql_fetch_array($SorguIsAlani)){

	if($SorguCikar["id"] == $IsAlani){
	echo '<option value="'.$SorguCikar["id"].'" selected>'.$SorguCikar["Alan"].'</option>';
	}else{
	echo '<option value="'.$SorguCikar["id"].'">'.$SorguCikar["Alan"].'</option>';
	}

}
}

## Mesaj Silme ##
function mesajsil(){

if($_SESSION["oturum"]){
	$MesajID = $_GET["mesid"];

	
	$MesajSorgu = mysql_query("select * from mesajlar where id='$MesajID' && AliciSil='0'");
	$Say = mysql_num_rows($MesajSorgu);
	
	if($Say > 0){
	
	
	
	$MesajOku = mysql_fetch_array($MesajSorgu);
	
	
	$Kime = $MesajOku["Kime"];
		
	$KimeUyelikTuru = substr($Kime,2 );
	
	if($_SESSION["uid"] == $KimeUyelikTuru){
	
	extract($MesajOku);
	$MesajOkunmadiSay = mysql_query("UPDATE mesajlar SET AliciSil='1' WHERE id='$MesajID'");
	
	if($MesajOkunmadiSay){
	bilgi("Mesajınız Silindi","Mesajınızı Başarıyla Silindi","bilgi");
	header( "Refresh: 3; url=../mesajlarim/" );
	}else{
	bilgi("Bir Hata Meydana Geldi","Hay Aksi! , Bir Sorunla Karşılaştık Daha Sonra Tekrar Dene");
	header( "Refresh: 3; url=../mesajlarim/" );
	}
	
	
	}else{
	
	Header("Location:../index.php");
	
	}
	}else{
	bilgi("Böyle Bir Mesaj Yok!","Siztemimizde Böyle Bir Mesaj Bulunamadı");
	}
}else{

Header("Location:../index.php");

}
}

## T.C. Kimlik Şifrele ##
function tcsifrele($tcno){
$Sifreler = Array("zR","xQ","iP","ZT","tK","PO","Uj","aE","yR","Ii");
$TCNO = $tcno;
$c = 0;
for($i = 0; $i <= 10; $i++){

$GelenTc = substr($TCNO, $c, 1);
$Sifrelenmis = $Sifreler[$GelenTc];

$SonHali = $SonHali.$Sifrelenmis;

$c++;
}
return $SonHali;
}

## T.C. Kimlik Çözme ##
function tccoz($tcno){
$Sifreler = Array("zR","xQ","iP","ZT","tK","PO","Uj","aE","yR","Ii");
$TCNO = $tcno;
$c = 0;
for($i = 0; $i <= 10; $i++){

$GelenTc = substr($TCNO, $c, 2);
if($GelenTc == $Sifreler[0]){
$Aranacak = "0";
}else if($GelenTc == $Sifreler[1]){
$Aranacak = "1";
}else if($GelenTc == $Sifreler[2]){
$Aranacak = "2";
}else if($GelenTc == $Sifreler[3]){
$Aranacak = "3";
}else if($GelenTc == $Sifreler[4]){
$Aranacak = "4";
}else if($GelenTc == $Sifreler[5]){
$Aranacak = "5";
}else if($GelenTc == $Sifreler[6]){
$Aranacak = "6";
}else if($GelenTc == $Sifreler[7]){
$Aranacak = "7";
}else if($GelenTc == $Sifreler[8]){
$Aranacak = "8";
}else if($GelenTc == $Sifreler[9]){
$Aranacak = "9";
}

$SonHali = $SonHali.$Aranacak;

$c += 2;
}
return $SonHali;
}

## Mesajı Okunmadı Saymak ##
function mesajiokunmadi(){

if($_SESSION["oturum"]){
	$MesajID = $_GET["mesid"];

	
	$MesajSorgu = mysql_query("select * from mesajlar where id='$MesajID' && AliciSil='0'");
	$Say = mysql_num_rows($MesajSorgu);
	
	if($Say > 0){
	
	
	
	$MesajOku = mysql_fetch_array($MesajSorgu);
	
	
	$Kime = $MesajOku["Kime"];
		
	$KimeUyelikTuru = substr($Kime,2 );
	
	if($_SESSION["uid"] == $KimeUyelikTuru){
	
	extract($MesajOku);
	$MesajOkunmadiSay = mysql_query("UPDATE mesajlar SET Okunma='1' WHERE id='$MesajID'");
	
	if($MesajOkunmadiSay){
	bilgi("Mesajınız Okunmadı Olarak İşaretlendi","Mesajınızı Başarıyla Okunmadı Olarak İşaretlediniz","onay");
	header( "Refresh: 3; url=../mesajlarim/" );
	}else{
	bilgi("Bir Hata Meydana Geldi","Hay Aksi! , Bir Sorunla Karşılaştık Daha Sonra Tekrar Dene");
	header( "Refresh: 3; url=../mesajlarim/" );
	}
	
	
	}else{
	
	Header("Location:../index.php");
	
	}
	}else{
	bilgi("Bu Mesaj Sizin Tarafınızdan Silinmiştir","Bu Mesaja Silinmiştir");
	}
}else{

Header("Location:../index.php");

}
}

## Öğrenci Kayıt ##
function ogrencikayit(){
	
	if(!$_SESSION["oturum"]){	 // Session Yok ise
		if($_POST){ // Post var ise 

		$Ad = strip_tags(addslashes(trim($_POST["Ad"])));
		$Soyad = strip_tags(addslashes(trim($_POST["Soyad"])));
				$sonid = mysql_fetch_array(mysql_query("select * from ogrenci order by id desc limit 1"));
			$sonids=$sonid["id"];
			///////////////////////////
			$EklenecekID = $sonids + 1;

		$DogumTarihi = strip_tags(addslashes(trim($_POST["DogumTarihi"])));
		$Sifre = strip_tags(addslashes(trim($_POST["Sifre"])));
		$Sifre2 = strip_tags(addslashes(trim($_POST["Sifre2"])));
		$Email = strip_tags(addslashes(trim($_POST["Email2"])));
		$Email2 = strip_tags(addslashes(trim($_POST["Email"])));
		$TCNo = strip_tags(addslashes(trim($_POST["TCNo"])));
		$SifreliTc = tcsifrele($TCNo);
		$SefeEkle = substr($TCNo, 0, 3);
		$SefLinkVeri = $Ad.' '.$Soyad.' '.$EklenecekID;
		$SefLink = sef_link($SefLinkVeri);
		$IPAdres = IPAdres();
		$KayitTarihi = date("d.m.Y H:i");

		$kural = $_POST['kural'];
		if(!$kural) { bilgi("Gizlilik politikamızı kabul etmelisiniz","Kaydınız gerçekleştirilemedi."); }
		
		
		elseif(empty($Ad) || empty($Soyad) || empty($Sifre) || empty($Email) || empty($TCNo)){
		
		bilgi("Kayıt Başarısız !","Boş Alan Bırakmadan Lütfen Tekrar Üye Olunuz");
		header( "Refresh: 3; url=index.php" );
		}else if(!is_numeric($TCNo)){
		
		bilgi("T.C. Numaranız Sadece 11 Haneli Sayıdan Oluşabilir","Lütfen T.C. Numaranızı Formatlara Uygun Giriniz");
		header( "Refresh: 3; url=index.php" );
		
		}else if($Sifre != $Sifre2){
		bilgi("Şifreleriniz Uyuşmuyor","Girmiş olduğunuz şifreler birbiriyle uyuşmuyor. Lütfen iki kutucuğada aynı şifreyi giriniz. Yönlendiriliyorsunuz...");
		header( "Refresh: 3; url=index.php" );
		}else if($Email != $Email2){
		bilgi("Mailleriniz Uyuşmuyor","Girmiş olduğunuz mailler birbiriyle uyuşmuyor. Lütfen iki kutucuğada aynı maili giriniz. Yönlendiriliyorsunuz...");
		header( "Refresh: 3; url=index.php" );
		}else{
			
			$Sifremd = md5(sha1($Sifre));
			$DogumYili = substr($DogumTarihi, 6, 4);
				function tr($str){
				$bul = array("ı","ğ","ü","ş","ö","ç","i");
				$degistir = array("I","Ğ","Ü","Ş","Ö","Ç","İ");
				return str_replace($bul, $degistir, $str);
				}

				$ad = strtoupper(tr($_POST["Ad"]));
				$soyad = strtoupper(tr($_POST["Soyad"]));
				$dyili = strtoupper(tr($DogumYili));
				$tc = $_POST["TCNo"];
				settype($tc, "double");

			try {

				// Web Servisine Bağlantı
				$baglanti = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
				
				// Verileri Diziye Aktar
				$degerler = array(
					"TCKimlikNo" => $tc,
					"Ad" => $ad,
					"Soyad" => $soyad,
					"DogumYili" => $dyili
				);
				
				// Verileri Gönder
				$sonuc = $baglanti->TCKimlikNoDogrula($degerler);
				
				// Sonuca Göre İşlem Yapalım
				if ($sonuc->TCKimlikNoDogrulaResult){
					
					// Öğrenci Daha Önce Eklenmiş mi ?
					$cekverileri = mysql_query("select * from ogrenci where TCNo='$TCNo' || Mail = '$Email'");
					$say = mysql_num_rows($cekverileri);
					
					header( "Refresh: 3; url=index.php" );

					if($say > 0){
					bilgi("Bu Öğrenci Daha Önce Eklendi!","Bu Öğrenci Bilgileri Zaten Sistemimizde Kayıtlı","bilgi");
					
					}else{
					// Öğrenci Kayıt İşlemi
					$kayit = mysql_query("insert into ogrenci (Ad,Soyad,OgrenciSef,DogumTarihi,Mail,Sifre,TCNo,KayitTarihi,IPAdres,Onay) values ('$ad','$soyad','$SefLink','$DogumTarihi','$Email','$Sifremd','$SifreliTc','$KayitTarihi','$IPAdres','1')");
					if($kayit){
					bilgi("Başarıyla Kayıt Oldunuz Sayın $Ad $Soyad","Artık Sisteme Giriş Yapabilirsiniz.","onay");
					$MailAdresiAl = $EPosta;
					$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
					$mailBilgi .= 'Content-type: text/html;' . "\r\n";
					$mailBilgi .= 'From: bilgi@stajyer-i.com <bilgi@stajyer-i.com>' . "\r\n";
					$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

					$aliciAdres= $Email;
					$epostaKonu = 'Stajyer-i.com | Yeni Uyelik';
					$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;"><div style="background:#0099FF;padding:8px;text-align:center;">
					<img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>Merhaba <strong>'.$Ad.' '.$Soyad.'</strong> ; <br/>
					<br/>Stajyer-i.com a başarıyla üye oldunuz. Artık sende kendine uygun bir stajyer-i araya bilirsin. Fakat önce okulunun seni onaylaması gerek 
					bunun daha hızlı gerçekleşmesi için hesabına giriş yapıp okul bilgilerini gir ve yetkili müdür yardımcısına üyeliğin hakkında bilgi vererek onaylamasını iste.
					<br /><br />Stajyer-i.com u seçtiğin için teşekkür ederiz. <br /><br /><br /><b>Stajyer-i.com Ekibi </b>
					</div>';
					mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
					header( "Refresh: 3; url=index.php" );
					}else{
					bilgi("Bir Sorun Meydana Geldi.","Sisteme Kayıt Olurken Bir Hata Meydana Geldi Lütfen Tekrar Deneyin");
					header( "Refresh: 3; url=index.php" );
					}
					}
					
				}else {
					bilgi("Girmiş Olduğunuz Bilgiler Eşlemiyor!","Girdiğiniz Bilgiler ile T.C. Kimlik Numaranız Eşleşmiyor. T.C. Kimlik Numaranız Hiç Bir Şekilde 3. Şahıslarla Paylaşılmayacaktır.");
					header( "Refresh: 3; url=index.php" );
				}

			}catch (Exception $hata){
				echo $hata->getMessage();
				header( "Refresh: 3; url=index.php" );
			}
		
		}
		}else{
		Header("Location:index.php"	);
		}
		
	}else{
	Header("Location:index.php"	);
	}

}

## Büyük Harfe Çevirme ##
function toLowerCase( $input ){	
return strtolower(strtr( $input,'ğüşıiöç','ĞÜŞIİÖÇ'));
}

## Okul Kayıt ##
function okulkayit(){

	if(!$_SESSION){
		if($_POST){
		
		$KurumKodu = strip_tags(addslashes(trim($_POST["KurumKodu"])));
		$Sifre2 = strip_tags(addslashes(trim(md5(sha1($_POST["Sifre2"])))));
		$Sifre = strip_tags(addslashes(trim(md5(sha1($_POST["Sifre"])))));
		$OkulAdi = strip_tags(addslashes(trim($_POST["OkulAdi"])));
		$mail = strip_tags(addslashes(trim($_POST["EPosta"])));
		$mail2 = strip_tags(addslashes(trim($_POST["EPosta2"])));
		$il = strip_tags(addslashes(trim($_POST["il"])));
		$OkulAdiBuyuk = turkceKarakter($OkulAdi);
		$IPAdres = IPAdres();
		$KayitTarihi = date("d.m.Y H:i");
			$xmlrand = rand(1111,9999);
		$OkulSefOlustur = $KurumKodu.$il.$xmlrand;
		$OkulSef = sef_link($OkulSefOlustur);
		$XmlSef = $OkulSef.'.xml';
	
		
		
		$kural = $_POST['kural'];
		if(!$kural) { bilgi("Gizlilik politikamızı kabul etmelisiniz","Kaydınız gerçekleştirilemedi."); }
		elseif(empty($KurumKodu) || empty($mail) || empty($Sifre) || empty($OkulAdi) || $il == "0" ||  $mail == "E-Posta" || $KurumKodu == "Kurum Kodu" || $Sifre == "Şifre" || $OkulAdi == "Okul Adı"){
		bilgi("Boş Alan Bırakmayınız","Boş Alan Bırakmadan Tekrar Deneyiniz");
	
		}else if(!is_numeric($KurumKodu)){
		bilgi("Kurum Kodu Sadece Rakamlardan Oluşur.","Bilgileri Düzenleyip Tekrar Deneyiniz");

		}else if($Sifre2 != $Sifre){
		bilgi("Şifreler uyuşmuyor!","Girmiş olduğunuz şifreler uyuşmuyor. Lütfen iki kutucuğada aynı şifreyi giriniz. ");
		}else if($mail != $mail2){
		bilgi("Mailler uyuşmuyor!","Girmiş olduğunuz mailler uyuşmuyor. Lütfen iki kutucuğada aynı maili giriniz. ");
		}
		
		else{
		
		$sorgu = mysql_query("select * from okul where KurumKodu = '$KurumKodu'");
		$say = mysql_num_rows($sorgu);
	
		if($say > 0){
		bilgi("Bu Okul Daha Önce Sistemimize Kayıt Edildi.","Bu Kurum Koduyla Daha Önce Üyelik Açılmıştır.","bilgi");
		header( "Refresh: 3; url=index.php" );
		}else{
			$gonder = mysql_query("insert into okul (Mail,KurumKodu,Sifre,OkulAdi,il,KayitTarihi,IPAdres,xmlyolu) values ('$mail','$KurumKodu','$Sifre','$OkulAdiBuyuk','$il','$KayitTarihi','$IPAdres','$XmlSef')");
			
			if($gonder){

		touch("OkulXML/".$XmlSef);
		
		bilgi("Başarıyla Kayıt Oldunuz","<b> $OkulAdiBuyuk </b> Sistemimize Eklenmiştir. Yönlendiriliyorsunuz.","onay");
		header( "Refresh: 3; url=index.php" );
			
			}else{
			bilgi("Sistemde Bir Sorun Meydana Geldi","Lütfen Tekrar Kayıt Olmayı Deneyiniz");
			header( "Refresh: 3; url=index.php" );
			}
		}
		
		}
		
		}else{
			Header("Location:index.php"	);
		}

	}else{
		Header("Location:index.php"	);
	}


}

## Uyarı Mesajları ##
function bilgi($baslik,$mesaj,$sinif="hata"){ // 3 parametre atadık. 1. parametre başlık alanı 2. parametre mesaj alanı ve son olarak hata sınıfı
	
	/*
	sınıf parametresi boş gönderilirse HATA. onay yazılırsa YEŞİL. bilgi yazılırsa SARI rengi alır
	*/
	echo "<div class='{$sinif}'><strong>{$baslik}</strong><br /> {$mesaj} </div>"; 
	
	}

## Öğrencinin Okuldan Olmadığı durumlar ( Okul Üyeliği ) ##
function ogrenciokuldegil(){
	if($_SESSION["oturum"]){
		if($_SESSION["UyelikTuru"] == 0){
		$OgrenciID = $_GET["ogrid"];
		$OkulID = $_SESSION["uid"];
		$OgrenciBigileri = mysql_query("select * from ogrenci where id = '$OgrenciID' && OkulID = '$OkulID'");
		$OgrenciSay = mysql_num_rows($OgrenciBigileri);
		if($OgrenciSay > 0){
		$OgrenciCikar = mysql_fetch_array($OgrenciBigileri);
		$OgrenciAdi = $OgrenciCikar["Ad"];
		$OgrenciSoyadi = $OgrenciCikar["Soyad"];
		$OgrenciMail = $OgrenciCikar["Mail"];
		$OkulBilgileri = mysql_fetch_array(mysql_query("select * from okul where id = '$OkulID'"));
		$OkulAdi = $OkulBilgileri["OkulAdi"];
		
		$OgrenciOkuldanCik = mysql_query("update ogrenci set OkulID = '', LiseTuru ='', Bolum='',Dal ='',Disiplin='',NotOrtalamasi='',Sinif='',Sube='',OkulNo='', OkulOnay = '', KullandigiProtez='' where id ='$OgrenciID'");
		$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
		$mailBilgi .= 'Content-type: text/html;' . "\r\n";
		$mailBilgi .= 'From: bilgi@stajyer-i.com <bilgi@stajyer-i.com>' . "\r\n";
		$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

		$aliciAdres= $OgrenciMail;
		$epostaKonu = 'Stajyer-i | Hesabınız Okul Tarafından Silindi';
		$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;"><div style="background:#0099FF;padding:8px;text-align:center;">
		<img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>Merhaba <strong>'.$OgrenciAdi.' '.$OgrenciSoyadi.'</strong> ; <br/>
		<br/>Üyeliğiniz <strong>'.$OkulAdi.' </strong> Tarafından Silinmiştir. Lütfen Sisteme Giriş Yaparak Doğru Bilgilerinizle Hesabınızı
		Tekrar Düzenleyiniz.<br /><br/><br/><br/>
		<br /><br/>
		<strong> Stajyer-i.com Ekibi </strong>
		bilgi@stajyer-i.com
		</div>';
		mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
		
		bilgi("Öğrenci Başarılı Şekilde Sistemden Düşüldü","Eğer Bir Hata Yaptığınızı Düşünüyorsanız Öğrenci Bilgilerini Tekrar Gönderme Hakkına Sahiptir.","onay");
		echo '<a href="/index.php?git=ogrencilerim"> Öğrencilerim Sayfasına Geri Dön </a>';
		}else{bilgi("Bu Öğrenciye Erişme İzniniz Yok!","Sadece Kendi Okulunuzda Bulunan Öğrencilere Müdahale Edebilirsiniz","bilgi");}
		}else{Header("Location:../index.php");}
	}else{Header("Location:../index.php");}
}
	
## İlanlarım ( İŞ YERİ ) ##
function ilanlarim(){

	$IsyeriID = $_SESSION["uid"];
	
	$IlanBul = mysql_query("select * from ilanlar where IsYeriID='$IsyeriID'");
	$IlanSay = mysql_num_rows($IlanBul);
	
	if($IlanSay > 0){
		while($basgoster=mysql_fetch_array($IlanBul)){
			extract($basgoster);
			echo '<li><a href="ilan/'.$id.'">+ '.$Baslik.'</a></li>';
	}
	}else{
	echo '<a href="#"><li> Henüz İlanınız Yok ! </li></a>';
	}
	

}
	
## Hata Bulma Fonksiyonu ##
function hatabul(){
$GonderdigiYer = $_SERVER['HTTP_REFERER']; //( gönderen site )
require("hatabildir.php");

}
	
## İl Bulma Fonksiyonu ## 
function ilbul($ilid){
$Il_ID = $ilid;
$Il_Bul = mysql_query("select * from iller where id = '$Il_ID'");
$IL_CIKAR = mysql_fetch_array($Il_Bul);
echo $IL_CIKAR["il"];
}

## Üyelik Onayla ##
function uyelikonayla(){
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 0){
	$OgrenciID = $_GET["ogrid"];
	$OkulID = $_SESSION["uid"];
	$OgrenciSorgu = mysql_query("select * from ogrenci where id = '$OgrenciID' && OkulID = '$OkulID'");
	$OgrenciSay = mysql_num_rows($OgrenciSorgu);
	
	if($OgrenciSorgu > 0){
	$OgrenciOnaylama = mysql_query("update ogrenci set OkulOnay = '1' where id ='$OgrenciID' &&  OkulID = '$OkulID'");
		if($OgrenciOnaylama){
	header( "Location:{$_SERVER["HTTP_REFERER"]}" );
	}
	else{
	bilgi("Bir Sorun Meydana Geldi","İşleminiz gerçekleştirilemedi, Lütfen tekrar deneyin. Yönlendiriliyorsunuz...");
	header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
	}
	}else{
	bilgi("Size ait olmayan bir alana ulaşamazsınızi","Bu alana girme izniniz bulunmuyor.");
	header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
	}
	
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

}

## Üyelik Reddet ( OKUL - Öğrenci İçin ) ##
function uyelikcevir(){
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 0){
	$OgrenciID = $_GET["ogrid"];
	$OkulID = $_SESSION["uid"];
	
	$OgrenciSorgu = mysql_query("select * from ogrenci where id = '$OgrenciID' && OkulID = '$OkulID'");
	$OgrenciSay = mysql_num_rows($OgrenciSorgu);
	
	if($OgrenciSorgu > 0){
	$OgrenciOnaylama = mysql_query("update ogrenci set OkulOnay = '2' where id ='$OgrenciID' &&  OkulID = '$OkulID'");
		if($OgrenciOnaylama){
	header( "Location:{$_SERVER["HTTP_REFERER"]}" );
	}
	else{
	bilgi("Bir Sorun Meydana Geldi","İşleminiz gerçekleştirilemedi, Lütfen tekrar deneyin. Yönlendiriliyorsunuz...");
	header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
	}
	}else{
	bilgi("Size ait olmayan bir alana ulaşamazsınızi","Bu alana girme izniniz bulunmuyor.");
	header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
	}
	
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

}

## İl Bulma Fonksiyonu ##
function ilbulret($ilid){
$Il_ID = $ilid;
$Il_Bul = mysql_query("select * from iller where id = '$Il_ID'");
$IL_CIKAR = mysql_fetch_array($Il_Bul);
return $IL_CIKAR["il"];
}

## İlce Bulma Fonksiyonu ##
function ilcebul($ilceid){
$Ilce_ID = $ilceid;
$Ilce_Bul = mysql_query("select * from ilceler where id = '$Ilce_ID'");
$ILce_CIKAR = mysql_fetch_array($Ilce_Bul);
echo $ILce_CIKAR["ilce"];
}

## İlce Bulma Fonksiyonu ret ##
function ilcebulret($ilceid){
$Ilce_ID = $ilceid;
$Ilce_Bul = mysql_query("select * from ilceler where id = '$Ilce_ID'");
$ILce_CIKAR = mysql_fetch_array($Ilce_Bul);
return $ILce_CIKAR["ilce"];
}

## İş yeri girişi bekleyen öğrenciler [ okul ] ##
function isgirisbekleyen(){
$OkulID = $_SESSION["uid"];
$IlanlariCikar = mysql_query("select * from ilanbasvuru where OkulOnay = '2' && OkulID = '$OkulID' order by id asc limit 0,10");
$IlanVarmi = mysql_num_rows($IlanlariCikar);
if($IlanVarmi > 0){
while($IlanSonucu = mysql_fetch_array($IlanlariCikar)){
$OgrenciID = $IlanSonucu["OgrenciID"];
$IlanID = $IlanSonucu["IlanID"];
$OgrenciyiSorgu = mysql_query("select * from ogrenci where id = '$OgrenciID' && OkulID = '$OkulID'");
$FirmayiSorgu = mysql_query("select * from ilanlar where id = '$IlanID'");
$Ilandayday = mysql_fetch_array($FirmayiSorgu);
$OsyeriID = $Ilandayday["IsyeriID"];
$IsyeriSorgu = mysql_query("select * from isyeri where id='$OsyeriID'");
$IsyeriCikar = mysql_fetch_array($IsyeriSorgu);
$OgrenciCikar = mysql_fetch_array($OgrenciyiSorgu);
echo '<li><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; margin-right: 10px;" src="'.$OgrenciCikar["Resim"].'" alt="'.$OgrenciCikar["Ad"].'"/><a href="/ogrenci/'.$OgrenciCikar["OgrenciSef"].'"><b>'.$OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"].' </b>- '.$OgrenciCikar["OkulNo"].' - '.$OgrenciCikar["Sinif"].' / '.$OgrenciCikar["Sube"].' - </a>'.$IsyeriCikar["IsyeriAdi"].'</li>';

}

}else{
echo '<li>Onay Bekleyen, Öğrenci işyeri girişi yok...</li>';
}

}

## Okul onayı bekleyen öğrenciler [ okul ] ##
function okuldanonaybek(){
$OkulID = $_SESSION["uid"];
$OgrenciSorgu = mysql_query("select * from ogrenci where OkulID = '$OkulID' && OkulOnay = '0' order by id asc limit 0,10");
$OgrenciSay = mysql_num_rows($OgrenciSorgu);

if($OgrenciSay > 0){

while($OgrenciCikarOkul=mysql_fetch_array($OgrenciSorgu)){

echo '<li><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; margin-right: 10px;" src="'.$OgrenciCikarOkul["Resim"].'" alt="'.$OgrenciCikarOkul["Ad"].'"/><a href="/ogrenci/'.$OgrenciCikarOkul["OgrenciSef"].'">'.$OgrenciCikarOkul["Ad"].' '.$OgrenciCikarOkul["Soyad"].' - '.$OgrenciCikarOkul["OkulNo"].' - '.$OgrenciCikarOkul["Sinif"].'/'.$OgrenciCikarOkul["Sube"].'</a><a href="/index.php?git=uyelikonayla&ogrid='.$OgrenciCikarOkul["id"].'" style="float: right; padding: 5px; background-color:#77b157; color: #33591f; border: 1px solid #618b4a;">ONAYLA</a><a href="/index.php?git=uyelikcevir&ogrid='.$OgrenciCikarOkul["id"].'" style="float: right; padding: 5px; background-color:#9f6a6a; color: #591f1f; border: 1px solid #773c3c; ">REDDET</a></li>';
}

}else{
echo '<li> Onay Bekleyen Öğrenciniz Yok...</li>';
}

}

## Okul onayı bekleyen öğrenciler sol alan[ okul ] ##
function okuldanonaybeks(){
$OkulID = $_SESSION["uid"];
$OgrenciSorgu = mysql_query("select * from ogrenci where OkulID = '$OkulID' && OkulOnay = '0' order by id asc limit 0,10");
$OgrenciSay = mysql_num_rows($OgrenciSorgu);

if($OgrenciSay > 0){

while($OgrenciCikarOkul=mysql_fetch_array($OgrenciSorgu)){

echo '<li><img style="border: 1px solid #ccc; padding: 1px; width: 30px; height: 30px; vertical-align: middle; margin-right: 10px;" src="'.$OgrenciCikarOkul["Resim"].'" alt="'.$OgrenciCikarOkul["Ad"].'"/><a href="/ogrenci/'.$OgrenciCikarOkul["OgrenciSef"].'">'.$OgrenciCikarOkul["Ad"].' '.$OgrenciCikarOkul["Soyad"].' - '.$OgrenciCikarOkul["OkulNo"].' - '.$OgrenciCikarOkul["Sinif"].'/'.$OgrenciCikarOkul["Sube"].'</a></li>';
}

}else{
echo '<li> Onay Bekleyen Öğrenciniz Yok...</li>';
}

}

## Okul Bilgilerini Güncelleme [ OKUL ÜYELİĞİ ] ##
function okulguncelle(){
if($_SESSION["UyelikTuru"] == 0){
	if($_POST){
	$OkulID = $_SESSION["uid"];
	$Ad = $_POST["Ad"];
	$Soyad = $_POST["Soyad"];
	$Unvan = $_POST["Unvan"];
	$LiseTuru = implode($_POST['LiseTuru'],',');
	$Mail = $_POST["Mail"];
	$Telefon = $_POST["Telefon"];
	$Adres = $_POST["Adres"];
	$il = $_POST["il"];
	$ilce = $_POST["ilce"];
	$KurumKodu = $_POST["KurumKodu"];
	$Fax = $_POST["Fax"];
	$WebSayfasi = $_POST["WebSayfasi"];
	$KurumMuduru = $_POST["KurumMuduru"];
	$SigortaSicilNo = $_POST["SigortaSicilNo"];
	$EskiSifre = $_POST["EskiSifre"];
	
	if(empty($Ad) || empty($Soyad) || empty($Unvan) || empty($LiseTuru) || empty($Mail) || empty($Telefon) || empty($Adres) || empty($il) || empty($ilce) || empty($KurumKodu) || empty($Fax) || empty($KurumMuduru) || empty($SigortaSicilNo)){
	bilgi("Lütfen Önemli Yerleri Boş Bırakmayın","Önemli Alanları Boş Bıraktınız");
	}else{
		if(empty($EskiSifre)){
			$OkulVeriGuncelle = mysql_query("update okul set Ad ='$Ad', Soyad = '$Soyad', Unvan = '$Unvan', LiseTuru = '$LiseTuru', Mail = '$Mail', Telefon = '$Telefon', Adres = '$Adres', il = '$il', ilce ='$ilce', KurumKodu = '$KurumKodu', Fax ='$Fax', WebSayfasi = '$WebSayfasi', KurumMuduru = '$KurumMuduru', SigortaSicilNo = '$SigortaSicilNo' where id='$OkulID'");
			if($OkulVeriGuncelle){
			bilgi("Bilgileriniz Başarıyla Güncellendi","Bilgilerinizi Başarıyla Güncellediniz. Yönlendiriliyorsunuz...","onay");
			header( "Refresh: 3; url=index.php" );
			}else{
			bilgi("Bilgileriniz Güncellenemedi","Sistemde Bir Hata Meydana Geldi, Lütfen Tekrar Deneyin");
			}
		}else{
			$SifreMD5 = md5(sha1($EskiSifre));
			$YeniSifre = $_POST["YeniSifre"];
			$YeniSifretek = $_POST["YeniSifreTekrar"];
			$OkulSifresiniCek = mysql_fetch_array(mysql_query("select * from okul where id = '$OkulID'"));
			$OkulEskiSifresi = $OkulSifresiniCek["Sifre"];
			
			if($SifreMD5 == $OkulEskiSifresi){
				if($YeniSifre == $YeniSifretek){
				$SifreGonmd = md5(sha1($YeniSifre));
				$OkulVeriGuncelle = mysql_query("update okul set Ad ='$Ad', Soyad = '$Soyad', Unvan = '$Unvan', Sifre = '$SifreGonmd' , LiseTuru = '$LiseTuru', Mail = '$Mail', Telefon = '$Telefon', Adres = '$Adres', il = '$il', ilce ='$ilce', KurumKodu = '$KurumKodu', Fax ='$Fax', WebSayfasi = '$WebSayfasi', KurumMuduru = '$KurumMuduru', SigortaSicilNo = '$SigortaSicilNo' where id='$OkulID'");
				if($OkulVeriGuncelle){
				bilgi("Bilgileriniz Başarıyla Güncellendi","Bilgilerinizi Başarıyla Güncellediniz. Şifrenizi Değiştirdiniz,  Yönlendiriliyorsunuz...","onay");
				header( "Refresh: 3; url=index.php" );
				}else{
				bilgi("Bilgileriniz Güncellenemedi","Sistemde Bir Hata Meydana Geldi, Lütfen Tekrar Deneyin");
				}
				}else{
				bilgi("Girdiğiniz şifreler uyuşmuyor","Girdiğiniz yeni şifreler uyuşmuyor lütfen tekrar deneyiniz");
				}
			
			}else{
			bilgi("Eski Şifrenizi Yanlış Girdiniz.","Eski Şifrenizi Yanlış Girdiniz, Lütfen Geri Dönüp Tekrarlayınız");
			}
		} 	
	
	} 
	
	
	
	}else{Header("Location:../index.php");}}else{Header("Location:../index.php");}

}

## Alan Bulma Fonksiyonu ## 	
function alanbul($alanid){
$alanidsi = $alanid;
$AlanBul = mysql_query("select * from alanlar where id ='$alanidsi'");
$AlanSay = mysql_num_rows($AlanBul);

if($AlanSay > 0){

	$AlanGoster =mysql_fetch_array($AlanBul);
	echo $AlanGoster["Alan"];
	
}else{

bilgi("Alan Verisi Alınamadı","Alan Verisi Alınamadı","bilgi");

}

}

## Alan Bulma Fonksiyonu ( Return lü ) ## 	
function alanbulret($alanid){
$alanidsi = $alanid;
$AlanBul = mysql_query("select * from alanlar where id ='$alanidsi'");
$AlanSay = mysql_num_rows($AlanBul);

if($AlanSay > 0){

	$AlanGoster =mysql_fetch_array($AlanBul);
	return $AlanGoster["Alan"];
	
}else{

bilgi("Alan Verisi Alınamadı","Alan Verisi Alınamadı","bilgi");

}

}

## Dal Bulma Fonksiyonu ##
function dalbul($dalid){
$DalBul = mysql_query("select * from dallar where id = '$dalid'");
$DalSay = mysql_num_rows($DalBul);

if($DalSay > 0){

	$DalGoster =mysql_fetch_array($DalBul);
	echo $DalGoster["Dal"];
	
}else{

bilgi("Dal Verisi Alınamadı","Dal Verisi Alınamadı","bilgi");

}

}

## Lise Türü Return ##
function lisetururet($liseturu){
$liseturuid = $liseturu;
$AlanBul = mysql_query("select * from liseturu where id ='$liseturuid'");
$AlanSay = mysql_num_rows($AlanBul);

if($AlanSay > 0){

	$AlanGoster =mysql_fetch_array($AlanBul);
	return $AlanGoster["LiseTuru"];
	
}else{

return 'Lise Türü Girmemiş';
}
}	

## Öğrenci Giriş Fonksiyonu ##
function uyegiris(){
	if($_SESSION["oturum"]){
	Header("Location:index.php");
	}else{
		if($_POST){
		$mail = mysql_real_escape_string(strip_tags(trim($_POST["Mail"]))); 
		$sifre = mysql_real_escape_string(strip_tags(trim($_POST["Sifre"])));
		if(empty($mail) || empty($sifre) || $sifre == "Şifre" || $mail == "E-Posta"){ 
		bilgi("Boş Bilgi Gönderdiniz","Lüften Doğru ve Boş Kutucuk Olmayan Bilgiler Girerek Tekrar Deneyin...","bilgi");
		}else{ 
		$Sifrele = md5(sha1($sifre));
		$OgrenciSorgu = mysql_query("select * from ogrenci where Mail = '$mail' && Sifre = '$Sifrele' && Onay = '1'");
		$OgrenciSay = mysql_num_rows($OgrenciSorgu);
		$Tarih = date("d.m.Y H:i");
		$IPAdres = IPAdres();
			if($OgrenciSay > 0){

				$GirisKayitAl = mysql_query("insert into giriskayitlari (GirisYapan,UyelikTuru,Tarih,IPAdres,GirisBasarili) values ('$mail','1','$Tarih','$IPAdres','1')");
				$goster = mysql_fetch_array($OgrenciSorgu);
				$_SESSION["oturum"] = true;
				$_SESSION["uid"] = $goster["id"];
				$_SESSION["Ad"] = $goster["Ad"];
				$_SESSION["Soyad"] = $goster["Soyad"];
				$_SESSION["Cinsiyet"] = $goster["Cinsiyet"];
				$_SESSION["DogumTarihi"] = $goster["DogumTarihi"];
				$_SESSION["Mail"] = $goster["Mail"];
				$_SESSION["TCNo"] = $goster["TCNo"];
				$_SESSION["Telefon"] = $goster["Telefon"];
				$_SESSION["Adres"] = $goster["Adres"];
				$_SESSION["il"] = $goster["il"];
				$_SESSION["ilce"] = $goster["ilce"];
				$_SESSION["LiseTuru"] = $goster["LiseTuru"];
				$_SESSION["OkulID"] = $goster["OkulID"];
				$_SESSION["Bolum"] = $goster["Bolum"];
				$_SESSION["Dal"] = $goster["Dal"];
				$_SESSION["Hakkinda"] = $goster["Hakkinda"];
				$_SESSION["Disiplin"] = $goster["Disiplin"];
				$_SESSION["KayitTarihi"] = $goster["KayitTarihi"];
				$_SESSION["NotOrtalamasi"] = $goster["NotOrtalamasi"];
				$_SESSION["KullandigiProtez"] = $goster["KullandigiProtez"];
				$_SESSION["Resim"] = $goster["Resim"];
				$_SESSION["Sinif"] = $goster["Sinif"];
				$_SESSION["Sube"] = $goster["Sube"];
				$_SESSION["UyelikTuru"] = $goster["UyelikTuru"];
				$_SESSION["SefLink"] = $goster["OgrenciSef"];
				Header("Location:../index.php");

			}else{
			$IsyeriSorgu = mysql_query("select * from isyeri where Mail = '$mail' && Sifre = '$Sifrele'");
			$IsyeriSay = mysql_num_rows($IsyeriSorgu);
				if($IsyeriSay > 0){
					$GirisKayitAl = mysql_query("insert into giriskayitlari (GirisYapan,UyelikTuru,Tarih,IPAdres,GirisBasarili) values ('$mail','2','$Tarih','$IPAdres','1')");
				
					$goster = mysql_fetch_array($IsyeriSorgu);
					$_SESSION["oturum"] = true;
					$_SESSION["uid"] = $goster["id"];
					$_SESSION["Ad"] = $goster["Ad"];
					$_SESSION["Soyad"] = $goster["Soyad"];
					$_SESSION["Unvan"] = $goster["Unvan"];
					$_SESSION["IsyeriAdi"] = $goster["IsyeriAdi"];
					$_SESSION["Mail"] = $goster["Mail"];
					$_SESSION["VergiNo"] = $goster["VergiNo"];
					
					$_SESSION["IsAlani"] = $goster["IsAlani"];
					$_SESSION["KayitTarihi"] = $goster["KayitTarihi"];
					$_SESSION["IPAdres"] = $goster["IPAdres"];
					$_SESSION["Fax"] = $goster["Fax"];
					$_SESSION["UstaOgretici1"] = $goster["UstaOgretici1"];
					$_SESSION["UstaOgretici2"] = $goster["UstaOgretici2"];
					$_SESSION["UstaOgretici3"] = $goster["UstaOgretici3"];
					$_SESSION["UyelikTuru"] = $goster["UyelikTuru"];
					$_SESSION["Resim"] = $goster["Resim"];
					$_SESSION["SefLink"] = $goster["IsyeriSef"];
					Header("Location:index.php");
				}else{
				$OkulSorgu = mysql_query("select * from okul where Mail = '$mail' && Sifre = '$Sifrele'");
				$OkulSay = mysql_num_rows($OkulSorgu);
				if($OkulSay > 0){
				$GirisKayitAl = mysql_query("insert into giriskayitlari (GirisYapan,UyelikTuru,Tarih,IPAdres,GirisBasarili) values ('$mail','0','$Tarih','$IPAdres','1')");
				
				$goster = mysql_fetch_array($OkulSorgu);
				$_SESSION["oturum"] = true;
				$_SESSION["uid"] = $goster["id"];
				$_SESSION["Mail"] = $goster["Mail"];
				$_SESSION["UyelikTuru"] = $goster["UyelikTuru"];
				Header("Location:index.php");
				}else{
				$UyelikTuruYok = "Kayıtlı Üyelik Değil";
				$GirisKayitAl = mysql_query("insert into giriskayitlari (GirisYapan,UyelikTuru,Tarih,IPAdres,GirisBasarili) values ('$mail','$UyelikTuruYok','$Tarih','$IPAdres','0')");
				bilgi("Sistemde Böyle Bir Kullanıcı Yok","Sistemimizde Böyle Bir Kullanıcı Bulamadık !");
				}
				}
			}
		}
	}else{Header("Location:index.php");}

	}
}

## Çıkış Fonksiyonu ##
function cikis(){
if($_SESSION["oturum"]){
	
	$_SESSION = array();
	session_destroy();
	header("Location:../index.php"	);
	
	}else{
		
		header("Location:../index.php"	);
		
	}	

}

## Büyük Harf Çevirme ##
function toUpperCase($input){
return strtoupper(strtr($input,'ğ&uuml;şıi&ouml;çüÜ', 'Ğ&Uuml;ŞIİ&Ouml;ÇüÜ'));
}

## Staj Belgesi Yapma ##
function stajbelgesiyap(){
$OgrenciID = $_SESSION["uid"];
$Basvurusu = mysql_query("select * from isgiris where OgrenciID = '$OgrenciID'");
$Say = mysql_num_rows($Basvurusu);
if($Say > 0){
$Cikarma = mysql_fetch_array($Basvurusu);
$IsID = $Cikarma["IsyeriID"];
$OkulID = $Cikarma["OkulID"];
$IsyeriAdi = mysql_fetch_array(mysql_query("select * from isyeri where id ='$IsID'"));
$IsyerininAdi = $IsyeriAdi["IsyeriAdi"];
$OgrenciAdi = mysql_fetch_array(mysql_query("select * from ogrenci where id ='$OgrenciID'"));
$OkulBul = mysql_fetch_array(mysql_query("select * from okul where id = '$OkulID'"));
$yetkilisi = $IsyeriAdi["Ad"].' '.$IsyeriAdi["Soyad"];
require("StajBelgesi.php");

}else{
bilgi("Bir Sorun Meydana Geldi","Bu Alana Ulaşabilmeniz İçin Öncelikle Staj Girişi Yapmış Olmanız Gerekmektedir.","bilgi");
}
}

## Şifre Sıfırlama ( şifremi unuttum ) ##
function sifresifirla(){
$Mail = $_GET["mail"];
$Sifre = $_GET["pass"];
$TalepSorgu = mysql_query("select * from sifretalep where Mail = '$Mail' && SifreTalep = '$Sifre' && TalepOnay = '0'");
$TalepSay = mysql_num_rows($TalepSorgu);
if($TalepSay > 0){
$TalepSonuc = mysql_fetch_array($TalepSorgu);

$UyelikTuru = $TalepSonuc["UyelikTuru"];
$UyeID = $TalepSonuc["UyeID"];
	if($UyelikTuru == 0){
	$Guncelle = mysql_query("UPDATE okul SET Sifre='$Sifre' WHERE id='$UyeID'");
	
	}else if($UyelikTuru == 1){
	$Guncelle = mysql_query("UPDATE ogrenci SET Sifre='$Sifre' WHERE id='$UyeID'");
	}else if($UyelikTuru == 2){
	$Guncelle = mysql_query("UPDATE isyeri SET Sifre='$Sifre' WHERE id='$UyeID'");
	} 
	$Guncelle2 = mysql_query("UPDATE sifretalep SET TalepOnay='1' where Mail = '$Mail' && SifreTalep = '$Sifre' && TalepOnay = '0'");
	if($Guncelle){
	bilgi("Şifreniz Değiştirildi","Şifreniz Talebiniz Doğrultusunda Sıfırlandı","onay");
	header( "Refresh: 2; url=index.php" );
	}else{
	bilgi("Şifre Değiştirilemedi","Sistem bir hatayla karşılaştı");
	header( "Refresh: 2; url=index.php" );
	}
}else{
bilgi("Şifre talebi bulunamadı","Sistemimizde böyle bir şifre talebi yok.","bilgi");
}
}

## Site Başlığı ##
function baslik(){

	$git = $_GET["git"];
	
	
	switch($git) {
		
		
		case "ogrencilerim";
		echo 'Öğrencilerim | Stajyer-i.com';
		break;
		
		
		case "stajyerim";
		echo 'Stajyerim | Stajyer-i.com';
		break;
		
		case "ilanlar";
		echo 'İlanlar | Stajyer-i.com';
		break;
		
		case "hakkimizda";
		echo 'Hakkımızda | Stajyer-i.com';
		break;
 
 		case "ogrenciler";
		echo 'Öğrenci Listesi | Stajyer-i.com';
		break;

 		case "sirketler";
		echo 'İşletme Listesi | Stajyer-i.com';
		break;

 		case "dosyalar";
		echo 'Dosyalar | Stajyer-i.com';
		break;

 		case "sss";
		echo 'Sıkça Sorulan Sorular | Stajyer-i.com';
		break;
  
   		case "iletisim";
		echo 'İletişim | Stajyer-i.com';
		break;

 		case "okullar";
		echo 'Okul Listesi | Stajyer-i.com';
		break;
		

 		case "staj";
		echo 'Staj Hakkında | Stajyer-i.com';
		break;
 
		case "profilokul";
		echo 'Okul | Stajyer-i.com';
		break;
		
		
		case "mesajoku";
		echo 'Mesajım | Stajyer-i.com';
		break;
		
		case "ogrencikayit";
		echo 'Öğrenci Üyeliği Aç| Stajyer-i.com';
		break;

		
		case "profilduzenleisyeri";
		echo 'Profil Düzenle | Stajyer-i.com';
		break;
		
		case "profilduzenle";
		echo 'Profil Düzenle | Stajyer-i.com';
		break;
		
		case "okulprofilguncelle";
		echo 'Profil Düzenle | Stajyer-i.com';
		break;
		
		case "okulprofilduzenle";
		echo 'Profil Düzenle | Stajyer-i.com';
		break;
		
		case "SifremiUnuttum";
		echo 'Şifremi Unuttum | Stajyer-i.com';
		break;
		
		case "isyerlerimiz";
		echo 'İşletme Listesi | Stajyer-i.com';
		break;
		
		case "okullarimiz";
		echo 'Okul Listesi | Stajyer-i.com';
		break;
		
		default; 
		echo 'Stajyer-i.com | İşveren ile Stajyerin Buluşması';
		break;
		
		
	}
}

## SHK e-Bildirge Oluşturma ##
function sgkindirt(){
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 0){
	
	
	}
else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

}





## Genel Orta Alan ##
function goster(){
	
	
	$git = $_GET["git"];
	
	
	switch($git) {
		
			
		case "giris";
		uyegiris();
		break;
		
		case "cikis";
		cikis();
		break;
		
		case "girisonaybekleyen";
		require("onaybekleyenogr.php");
		break;
		
		case "StajDosyasi";
		if(empty($_GET["sayfa"])){
		require("StajDosyasi.php");
		}else{
		$sayfasi = $_GET["sayfa"];
		if($sayfasi == "1"){
		require("StajDosyasiSayfa1.php");
		}
		}
		
		break;
		
		case "sgkbildirge";
		require("sgkbildirge.php");
		break;
		
		case "uyelikcevir";
		uyelikcevir();
		break;
		
		case "ogrenciekle";
		require("ogrenciekle.php");
		break;
		
		case "ogrduzenleme";
		require("ogrenciduzenle.php");
		break;
		
		case "okulduzogr";
		okulduzenleogr();
		break;
		
		case "uyelikonayla";
		uyelikonayla();
		break;
		
		case "okuldadegil";
		ogrenciokuldegil();
		break;
		
		case "basvuranogrenciler";
		basvuranogrenci();
		break;
		
		case "IlanBasvur";
		OgrIlanBasvuru();
		break;
		
		
		case "stajyerlerim";
		stajyerlerim();
		break;
		
		case "ogrencilerim";
		require("ogrencilerim.php");
		break;
		
		case "IlanBasvuruIptal";
		IlanIptal();
		break;
		
		case "stajyerim";
		stajyerim();
		break;
		
		case "ilanlar";
		require("ilanlar.php");
		break;
		
		case "hakkimizda";
		require("hakkimizda.php");
		break;
 
 		case "ogrenciler";
		require("ogrenciler.php");
		break;

 		case "sirketler";
		require("sirketler.php");
		break;

 		case "dosyalar";
		require("dosyalar.php");
		break;

 		case "sss";
		require("sss.php");
		break;
  
   		case "iletisim";
		require("iletisim.php");
		break;

 		case "okullar";
		require("okullar.php");
		break;
		
		case "isyerikayit";
		isyerikayit();
		break;

 		case "staj";
		require("staj.php");
		break;
        
		case "profilisyeri";
		require("isyeriprofil.php");
		break;
		
		case "ilanekleniyor";
		ilanekleniyor();
		break;
		
		case "okulkayit";
		okulkayit();
		break;
		
		case "BasvuruKabulEt";
		basvuruonaylama();
		break;
		
		case "StajBelgesi";
		stajbelgesiyap();
		break;
		
		case "HataBul";
		hatabul();
		break;
		
	
		
		case "ilan";
		ilandetay();
		break;
		
		case "ilanlarinabak";
		ilanlarinabak();
		break;
		
		case "isyeriprofilguncellendi";
		isyeriguncelle();
		break;
		
		case "basvurudetay";
		basvurudetay();
		break;
		
		case "mesajlarim";
		mesajlarim();
		break;
		
		case "mesajyanitla";
		mesajyanitla();
		break;
		
		case "mesajgonder";
		mesajgonder();
		break;
		
		case "smesajgonder";
		smesajgonder();
		break;
		
		case "mesajsil";
		mesajsil();
		break;
		
		case "profilogrenci";
		require("ogrenciprofilgor.php");
		break;
		
		case "profilguncellendi";
		ogrprofilgunc();
		break;
		
		case "ilanekle";
		ilanekle();
		break;
		
		case "profilokul";
		require("okulprofil.php");
		break;
		
		case "SifreDegistirOnay";
		sifresifirla();
		break;
		
		case "mesajoku";
		mesajoku();
		break;
		
		case "ogrencikayit";
		ogrencikayit();
		break;
		
		case "mesajokunmadisay";
		mesajiokunmadi();
		break;
		
		case "profilduzenleisyeri";
		require("isyeri_profil.php");
		break;
		
		case "ildenilce";
		ildenilce();
		break;
		
		case "profilduzenle";
		require("ogrenciprofil.php");
		break;
		
		case "okulprofilguncelle";
		okulguncelle();
		break;
		
		case "okulprofilduzenle";
		require("okulprofilduzenle.php");
		break;
		
		case "SifremiUnuttum";
		require("sifreunuttum.php");
		break;
		
		case "sgkolusturuluyor";
		sgkindirt();
		break;
		
		case "isyerlerimiz";
		require("isyerlerilist.php");
		break;
		
		case "nedemisler";
		require("nedemisler.php");
		break;
		
		case "okullarimiz";
		require("okullarimizlist.php");
		break;
		
		default; 
		
		if($_SESSION["oturum"]){
		
			if($_SESSION["UyelikTuru"] == "1"){
			require("ogrenciana.php");
			}else if($_SESSION["UyelikTuru"] == "2"){
			require("isyeriana.php");
			}else if($_SESSION["UyelikTuru"] == "0"){
			require("okulana.php");
			}
		}else{
	
	/*echo '
	<div class="bolum-1"><h2 style="margin-bottom:10px;margin-top:7px;color:#1c5b6c;">Stajyer-i.com İlk Ödülünü Aldı !!</h2>
		<center><span style="font-family: \'Voces\', cursive;"><br>
		<span style="font-size: 14px;">I. Liseler Arası İşletme ve Ekonomi Proje Yarışması,  </span>
		<br><br><br><h3 style="font-size: 22px;"> ÖDÜLÜMÜZÜ ALDIK </h3>
		<img id="yanakay" style="position: relative; left: 250px; top: 20px;" src="img/oksag.png" title="Sonraki" />
	
		<br><br/>
	

		</span><br/>
		
		<br />
	
		<img width= "70" height="71" src="img/istanbuluni.PNG" title="İstanbul Üniversitesi" />
		<img width= "70" height="71" src="img/istanbuluniisletme.PNG" title="İstanbul Üniversitesi - İşletme Fakültesi" />
		</center>
		<br /><span><a href="http://www.fb.com/StajyeriCom" target="_blank"  style="color:#3b5998; text-decoration:underline">Facebook</a></span> ve <span><a href="http://www.twitter.com/stajyericom" target="_blank"  style="color:#4290c8; text-decoration:underline">Twitter</a></span> Hesaplarımızdan Bizi Takip Ederek, Stajyer-i Kurucularının İstanbul\'da Yaşadıklarını Anı Anına Görebilirsin.
		</div>
		
		<div class="bolum-2" style="display:none;"><h2 style="margin-bottom:10px;margin-top:7px;color:#1c5b6c;">Stajyer-i.com Ekibi EGE TV Yayını  !</h2>
	<img id="yanakay2" style="position: relative; left: -5px; top: 70px;" src="img/oksol.png" title="Sonraki" />
	
		<span style="font-family: \'Voces\', cursive;">Stajyer-i.com Kurucuları <a href="http://kemalaydin.kimdir.com" target="_blank"style="color:red">Kemal AYDIN</a> ve 
		<a href="http://onatbenli.kimdir.com" target="_blank" style="color:red">Onat BENLİ</a> EgeTV - Berna ERGİN \'in sunduğu Gökkuşağı programına konuk oldu. Yayının 1. bölümünü aşağıdan izleyebilirsiniz ;
		</span><br/><center>		<video id="my_video_1" class="video-js vjs-default-skin" controls
  preload="auto" width="465" height="250" poster="my_video_poster.png"
  data-setup="{}">
  <source src="kml_onat_egetv.mp4" type=\'video/mp4\'>
</video></center><br>
		<!--- <br /><center><a href="index.php?git=isyerlerimiz" style="font-size: 16px;"> ŞİRKETLER </a> | <a href="index.php?git=okullarimiz" style="font-size: 16px;"> OKULLAR </a></center><br/>
		<center><h2><a href="index.php?git=nedemisler" style="color:red; font-size: 20px;">BİZİM İÇİN NE DEDİLER ?</a></h2></center> -->
		
		
		</div>
	';*/
	
	echo '<h2 style="margin-bottom:10px;margin-top:7px;color:#1c5b6c;">Stajyer-i.com Değişiyor...</h2>
		<span style="font-family: \'Voces\', cursive;"><br>
		<span style="font-size: 14px;">Uzun süredir siz kullanıcılarımıza hizmet aden stajyer-i.com 
		büyük bir yapılanmaya giriyor. Bundan sonra stajyeri.com yazarak sitemize ulaşabileceksiniz. 
		Ayrıca yenilen tasarım ve logolarımızda mevcut. 2012 / 2013 Eğitim yılına Tamamen değişmiş bir
		stajyeri.com ile görüşmek dileğiyle...</span>
		<br><br><br>
	
		<br><br/>
		<center>
	<a href="https://twitter.com/intent/tweet?button_hashtag=YeniStajyeriCom&text=Stajyeri.com%20tamamen%20yap%C4%B1lanarak%20yeniden%20kullan%C4%B1c%C4%B1lar%C4%B1na%20sunuluyor..." class="twitter-hashtag-button" data-lang="tr" data-size="large" data-related="StajyeriCom" data-url="http://www.stajyeri.com" data-dnt="true">Tweet #YeniStajyeriCom</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		</span><br/>
		
		<br />

		</center>
		
		';
	
	/* EGE TV YAYIN 1.BÖLÜM ALANI
echo ' 
		';
	
		*/
		
		/* Yayından Sonra Eklenecek alan
		
		echo '<h2 style="margin-bottom:10px;margin-top:7px;color:#1c5b6c;">Şirketleri takip et! Stajyer Ol!</h2>
		<span style="font-family: \'Voces\', cursive;">Avrupa \'da 15. yüzyılda sanat dalında başlayan yenilikçilik hareketleri 18. yüzyılda 
		özellikle bilim ve teknoloji konularına da yayıldı. Geleneksel bilgileri kabul edenlerin yerini merak eden bilim insanları aldı. 
		Bu döneme Aydınlanma Çağı denmektedir. Birçok bilim adamı fiziksel ve astronomik olaylara getirdiği akılcı açıklamalarla bilimde yeni 
		bir çağ açmıştır. Büyüyen ve hızlanan bilim ve teknolojik çalışmalarında bilim insanları kendilerine yardımcı olabilecek kişilerin 
		arayışına geçtiler. Bu noktada konuda eğitimli olan kişiler mucitlerin yardımına koşmuşlardır. Mucitler yanlarına aldıkları tarihin ilk
		stajyerleriyle ekip oluşturarak yeni icatların yapılmasını sağladı. Bazı stajyerler kendi icatlarını yapıp tarihe isimlerini yazdırmışlardır.
		Bu sayede tarihin ilk stajyerleri sanayi devrimi yapılmasını sağladı. Stajyerler tarihin en önemli noktalarından birinde ortaya çıkmış, tarihin 
		akışına yön vermişlerdir. Stajyer-i.com\'un amacı yeni stajyerlerin yetişmesine yardımcı olup ilerde tarihe yön vermelerini sağlamaktır.</span><br/>
		<br /><center><a href="index.php?git=isyerlerimiz" style="font-size: 16px;"> ŞİRKETLER </a> | <a href="index.php?git=okullarimiz" style="font-size: 16px;"> OKULLAR </a></center><br/>
		<center><h2><a href="index.php?git=nedemisler" style="color:red; font-size: 20px;">BİZİM İÇİN NE DEDİLER ?</a></h2></center>
		
		';
		*/
		}
		break;
		
		
	}
	
	}
	

ob_end_flush();

}
?>
