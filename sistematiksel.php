<?php
ob_start();
#########################################
## UYARI MESAJLARINDA ##
// hata : K�rm�z�  
// bilgi : Sar� 
// onay : Ye�il    Renklidir !!

// header("Location:index.php"	);
// header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
// header( "Refresh: 3; url=/index.php" );
// $GLOBALS["tema_adresi"]."/konu-ekle.php"

// $tarih = date("d.m.Y H:i");

#########################################

## Site Dinamik Ba�l��� ##
function baslik(){

	
		$git = $_GET["git"];
	
	switch($git) {
		
		case "kayit";
		echo $GLOBALS["site_basligi"]." - KAYIT OL";
		break;
		
		case "giris";
		echo $GLOBALS["site_basligi"]." - G�R��";
		break;
		
		case "profil";
		if($sefUye = strip_tags($_GET["uye"])){	

$uyeBul = mysql_query("select * from uyeler where kadi_sef='$sefUye'");
$uyeSay = mysql_num_rows($uyeBul);
if($uyeSay){

$uyeGoster = mysql_fetch_array($uyeBul);

echo $uyeGoster["kadi"]." - Profil";

}else{
echo "HATA!";
}
}

		break;
		
		case "etiketler";
			if($link = strip_tags($_GET["link"])){	
			
				$etiketBul = mysql_query("select * from etiketler where etiket_sef='$link'");
				$etiketSay = mysql_num_rows($etiketBul);
				
				if($etiketSay > 0){
					
					$etiketGoster = mysql_fetch_array($etiketBul);
					$etiketasil = $etiketGoster["etiket"];
					
					echo "Etiketler - " .$etiketasil;
					
				}else{
				
				echo " Etiket Bulunamad� ";	
					
				}
			}

		break;
		
		case "konu_ekle";
		echo $GLOBALS["site_basligi"]." - KONU EKLE";
		break;
		
		case "konu";
		if($link = $_GET["link"]){
		$bul = mysql_query("select konu_basligi,konu_sef_link from konular where konu_sef_link='$link'"	);
		$say = mysql_num_rows($bul);
		if($say > 0){
		$goster = mysql_fetch_array($bul);
		echo $goster["konu_basligi"];	
		}else{
		echo $GLOBALS["site_basligi"]." - 404";
		}
		}
		break;
		
		case "cikis";
		echo $GLOBALS["site_basligi"]." - �IKI�";
		break;
		
		default;
			echo $GLOBALS["site_basligi"];
		break;
	}
	
	
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

## Uyar� Mesajlar� ##
function bilgi($baslik,$mesaj,$sinif="hata"){
	
	echo "<div class='{$sinif}'><strong>{$baslik}</strong><br /> {$mesaj} </div>";
	
	}
	
## Sayfa Fonk ( Sabit Sayfa ) ##
function sayfa(){
	
	if($link = $_GET["link"]){
		
		$sayfaBul = mysql_query("select * from sayfalar where baslik_sef='$link'");
		$sayfaSay = mysql_num_rows($sayfaBul);
		
		if($sayfaSay > 0){
			
			$sayfaGoster =  mysql_fetch_array($sayfaBul);
			extract ($sayfaGoster);
			$guncelle = mysql_query("update sayfalar set okunma=okunma+1 where id='$id'");
			require($GLOBALS["tema_adresi"]."/sayfa.php");
		}else{
			
	require($GLOBALS["tema_adresi"]."/404.php");
		}
		
		
	}else{
		 header("Location:index.php"	);
		
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
    $find = array('�', '�', '�', '�', '�', '�', '�', '�');
    $url = str_replace ($find, 'e', $url);
    $find = array('�','�', '�', '�', 'I', '�', '�', '�', '�', '�', '�');
    $url = str_replace ($find, 'i', $url);
    $find = array('�', '�', '�', '�', '�', '�', '�', '�');
    $url = str_replace ($find, 'o', $url);
    $find = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�');
    $url = str_replace ($find, 'a', $url);
    $find = array('�', '�', '�', '�', '�', '�', '�', '�');
    $url = str_replace ($find, 'u', $url);
    $find = array('�', '�');
    $url = str_replace ($find, 'c', $url);
    $find = array('�', '�');
    $url = str_replace ($find, 's', $url);
    $find = array('�', '�');
    $url = str_replace ($find, 'g', $url);   
    $find = array('Y');
    $url = str_replace ($find, 'y', $url);  
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $url = preg_replace ($find, $repl, $url);
    $url = str_replace ('--', '-', $url);
    return $url;
}

## �yelik Fonks. ##
function uyelik(){
	
	if($_SESSION["oturum"]){
		
		require	($GLOBALS["tema_adresi"]."/panel.php");
		
	}else{
	
		require	($GLOBALS["tema_adresi"]."/giris.php");

	}
	
}

## Konu Okuma ##
function konu_okuma(){

if($link = $_GET["link"]){
	
	$bul = mysql_query("select * from konular where konu_sef_link='$link'");
	$say = mysql_num_rows($bul);
	
	if($say > 0){
		
		// konu �ek
		
		$goster = mysql_fetch_array($bul);
		extract($goster);
		$konu_icerik = nl2br($konu_icerik);
		require($GLOBALS["tema_adresi"]."/konu_oku.php");
		
		// okuma g�ncelle
		$okumaGuncelle = mysql_query("update konular set okunma=okunma+1 where id='$id'");
		
		// Kategori Bulma
		$katBul = mysql_query("select * from kategoriler where id='$kategori_id'");
		$katGoster = mysql_fetch_array($katBul);
		$kategori = $katGoster["kategori_adi"];
		
		// Yorum Say�s� Bulma
		$yorBul = mysql_query("select * from yorumlar where konuID='$id' && onay=1");
		$yorGoster = mysql_num_rows($yorBul);
		$ysayisi = $yorGoster;
		if($ysayisi < 1){
		$ysayisi = "Yorum Yok";	
			
		}
		
		
	}else{
	bilgi("B�yle Bir Ba�l�k Yok","Arad���n�z ba�l�k sitemizde bulunmuyor","bilgi");	
	header( "Refresh: 3; url=/index.php" );
	}
	
}else{
	header("Location:index.php"	);
}
	
	
}

## Kategori Fonk ##
function kategori(){

if($link = $_GET["url"]){
	
	$katBul = mysql_query("select * from kategoriler where kategori_sef_link='$link'");
	$katSay = mysql_num_rows($katBul);
	
	if($katSay > 0){
		
		$katGoster = mysql_fetch_array($katBul);
		echo '<div id="katlists"><div id="katlistbas"><h1><em>'.$katGoster["kategori_adi"].'</em> Kategorisinde Bulunan Yaz�lar ;</h1></div>';
		echo '<div id="katlistbas"><span>'.$katGoster["kategori_aciklamasi"].'</span></div></div>';
		$katID = $katGoster["id"];
		$sayfa = $_GET["sayfa"];
		if (empty($sayfa) || !is_numeric($sayfa)){
		$sayfa = 1;
		}
		$kacar = $GLOBALS["sayfa_limiti"];
		$ksayisi = mysql_num_rows(mysql_query("select * from konular where kategori_id='$katID'"));
		$ssayisi = ceil($ksayisi/$kacar);
		$nereden = ($sayfa*$kacar)-$kacar;
		if($ksayisi > 0){
		if ($sayfa > $ssayisi){
		require($GLOBALS["tema_adresi"]."/404.php");
		header( "Refresh: 3; url=/index.php" );
		
	}else{
		
		$konuBul = mysql_query("select * from konular where kategori_id='$katID' order by id desc limit $nereden,$kacar");
		
		while($goster=mysql_fetch_array($konuBul)){
			extract($goster);
			extract($goster);
			$konu_basligi = stripslashes($konu_basligi);
		$konu_anasayfa = stripslashes($konu_anasayfa);
		$konu_anasayfa = nl2br($konu_anasayfa);
			$sorsor = mysql_query("select * from uyeler where id='$ekleyen'");
			$kimo = mysql_fetch_array($sorsor);
			$ekleyen = $kimo["kadi"];
		
		// Kategori Bulma
		$katBul = mysql_query("select * from kategoriler where id='$kategori_id'");
		$katGoster = mysql_fetch_array($katBul);
		$kategori = $katGoster["kategori_adi"];
		
		
		// Yorum Say�s� Bulma
		$yorBul = mysql_query("select * from yorumlar where konuID='$id'");
		$yorGoster = mysql_num_rows($yorBul);
		$ysayisi = $yorGoster;
		if($ysayisi < 1){
		$ysayisi = "Yorum Yok";	
			
		}
		
		
		
		$link = $GLOBALS["site_adresi"].$konu_sef_link.".html";
		//$link = "index.php?git=konu&link=".$konu_sef_link;
		
		require($GLOBALS["tema_adresi"]."/konu_anasayfa.php");
		
		
			}
		 if($ksayisi > $kacar){
			 echo '<center><div class="sayfala">';
	for ($i=1;$i <= $ssayisi; $i++){
		
		echo '<a href="/kategori/'.$katGoster["kategori_sef_link"].'/'.$i.'"';
		if ($sayfa == $i) {
		echo 'class="aktif"';
		}
		echo '>'.$i.'</a>';
		
		}
		echo '</div></center>';
		 }

	}}else{
		bilgi("Bu Kategoriye Konu Girilmemi�.","Hen�z Bu Kategoriye Bi�ey Yaz�lmam��","bilgi");
		
		}
		}else{
			bilgi("B�yle Bir Kategori Bulunamad�.","Sitede b�yle bir kategori yok. Hadi ana sayfaya");
			header( "Refresh: 3; url=/index.php" );
			
			}
	
}else{
header("Location:index.php"	);
}
	
}

## Konu Ekle ##
function konu_ekle(){

if($_SESSION["oturum"]){
	
	if($GLOBALS["konu_ekleme"]){
		
		if($_POST){
			
			$baslik = mysql_real_escape_string(strip_tags(trim($_POST["k_baslik"])));
			$konu_sef = sef_link($baslik);
			$anasayfa = mysql_real_escape_string(htmlspecialchars(trim($_POST["k_anasayfa"])));
			$icerik = mysql_real_escape_string(htmlspecialchars(trim($_POST["k_icerik"])));
			$etiketler = mysql_real_escape_string(strip_tags(trim($_POST["etiketler"])));
			$tarih = date("d.m.Y H:i");
			$onay = 1;
			$ekleyen=$_SESSION["uye_id"];
			$kategori = $_POST["kategori"];
			
			// Daha �nce var m� yok mu
			$sor = mysql_query("select id,konu_basligi from konular where konu_basligi='$baslik'");
			$say = mysql_num_rows($sor);
			
			if(empty($baslik) || empty($anasayfa) || empty($icerik) || empty($etiketler)){
			
			bilgi("Bo� Alan B�rakt�n!","Bo� alan b�rakmadan tekarar dene...");	
			header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
			}else if($say > 0){
				
				bilgi("Bu Konu Sitede Mevcut","Eklmeye �al��t���n�z konu sitemizde bulunuyor","bilgi");
				
			}else{				
		
				// konu ekleme
				$ekle = mysql_query("insert into konular (konu_basligi,konu_sef_link,konu_anasayfa,konu_icerik,etiketler,kategori_id,ekleyen,eklenme_tarihi,onay) values ('$baslik','$konu_sef','$anasayfa','$icerik','$etiketler','$kategori','$ekleyen','$tarih','$onay')");
				
				if($ekle){
					if($onay){
					
				bilgi ("Konu G�nderildi!","Konu Ba�ar�yla G�nderildi","onay");	
				
				header( "Refresh: 3; url=/index.php" );
					}else{
						bilgi ("Konu G�nderildi!","Konu Ba�ar�yla G�nderildi. Onayland�ktan sonra yay�nlanacakt�r.","bilgi");	
						header( "Refresh: 3; url=/index.php" );
						}
						
						// etiket ekle
						
						$konu_id = mysql_insert_id();
						
						$parcala = explode(",",$etiketler);
						foreach($parcala as $etiket){
							
							$durum = mysql_num_rows(mysql_query("select * from etiketler where etiket='$etiket'"));
							if($durum > 0){
							
							$durum = 1;
								
							}else{
									
							$durum = 0;
							}
							
							$etiket = trim($etiket);
							$etiket_sef = sef_link($etiket);
							
							$kayit = mysql_query("insert into etiketler (konu_id,etiket,etiket_sef,durum) values ('$konu_id','$etiket','$etiket_sef','$durum')");	
						
							}
				
					
				}else{
				bilgi ("HATA !"	, "Bir Hata Meydana Geldi !");
				}
			
			}
			
		}else{
			
			require($GLOBALS["tema_adresi"]."/konu-ekle.php");
		}
		
		
	}else{
		
		bilgi("D�KKAT!","Kullan�c�lar�n Konu Eklemesi Kapat�lm��t�r","bilgi");
		
		}
	
	
}else{ // oturum a��lmam�� ise
	header("Location:index.php"	);
}	
	
}

## Konu Listesi ##
function konu_listesi(){
	
	// Sayfalama
	$sayfa = $_GET["sayfa"];
	if (empty($sayfa) || !is_numeric($sayfa)){
		$sayfa = 1;
		}
		$lim = $GLOBALS["sayfa_limiti"];
		$ksayisi = mysql_num_rows(mysql_query("select id,onay from konular where onay='1'"));
		$ssayisi = ceil($ksayisi/$lim);
		$nereden = ($sayfa*$lim)-$lim;
	
	// Sayfa Varlik Kontrol�
	if ($sayfa > $ssayisi){
		require($GLOBALS["tema_adresi"]."/404.php");
		header( "Refresh: 3; url=/index.php" );
		
	}else{
	// Listeletme
	$bul = mysql_query("select * from konular where onay='1' order by id desc limit $nereden,$lim");
	while($goster=mysql_fetch_array($bul)){
		extract($goster);
		$konu_basligi = stripslashes($konu_basligi);
		$konu_anasayfa = stripslashes($konu_anasayfa);
		$konu_anasayfa = nl2br($konu_anasayfa);
			$sorsor = mysql_query("select * from uyeler where id='$ekleyen'");
			$kimo = mysql_fetch_array($sorsor);
			$ekleyen = $kimo["kadi"];
		
		// Kategori Bulma
		$katBul = mysql_query("select * from kategoriler where id='$kategori_id'");
		$katGoster = mysql_fetch_array($katBul);
		$kategori = $katGoster["kategori_adi"];
		
		
		// Yorum Say�s� Bulma
		$yorBul = mysql_query("select * from yorumlar where konuID='$id'  && onay=1");
		$yorGoster = mysql_num_rows($yorBul);
		$ysayisi = $yorGoster;
		if($ysayisi < 1){
		$ysayisi = "Yorum Yok";	
		}
		
		$link = $GLOBALS["site_adresi"].$konu_sef_link.".html";
		//$link = "index.php?git=konu&link=".$konu_sef_link;
		
		// G�venlik
		$_SESSION["kod1"]=rand(1,50);
		$_SESSION["kod2"]=rand(2,50);
		$guvenlik = $_SESSION["kod1"]."+".$_SESSION["kod2"];
	
		require($GLOBALS["tema_adresi"]."/konu_anasayfa.php");
	     }
		 if($ksayisi > $lim){
			 echo '<center><div class="sayfala">';
	for ($i=1;$i <= $ssayisi; $i++){
		
		echo '<a href="/sayfa/'.$i.'"';
		if ($sayfa == $i) {
		echo 'class="aktif"';
		}
		echo '>'.$i.'</a>';
		
		}
		echo '</div></center>';
		 }
	}
}

## Yorum Bul ##
function yorumlar($id){
$yorumBul = mysql_query("select * from yorumlar where konuID='$id' && onay='1'");
	$yorumSay = mysql_num_rows($yorumBul);
	
	if($yorumSay < 1){
	bilgi ("Bu Ba�l��a Hi� Yorum Eklenmemi�","�lk Yorumu Siz Yapabilirsiniz ?","bilgi");	
	}else{
	while($yorumGoster=mysql_fetch_array($yorumBul)){
	extract($yorumGoster);
	$yorum = nl2br($yorum);
	require($GLOBALS["tema_adresi"]."/yorum.php");
		
	}	
		
	}
	
}
	
## Yorum Yapma ##
function yorum_yap($id){
if($_POST){
	
	if(!$_SESSION["oturum"]){
		
		$kadi = strip_tags(addslashes(trim($_POST["kadi"])));
		$eposta = strip_tags(addslashes(trim($_POST["eposta"])));
		$website = strip_tags(addslashes(trim($_POST["site"])));
		

	}else{
		
		$kadi = $_SESSION["uye_id"];
		$eposta = $_SESSION["eposta"];
						
	}
	
	$yorum = strip_tags(addslashes(trim($_POST["yorum"])));
	$eposta_kontrol = filter_var($eposta, FILTER_VALIDATE_EMAIL);
	$ip = IPAdres();
	$rutbeID = $_SESSION["uye_grubu"];
	$rutbeBul = mysql_fetch_array(mysql_query("select * from rutbeler where id='$rutbeID'"));
	$onay = $rutbeBul["yorumonay"];
	$tarih = date("d.m.Y H:i");
	$guvenlik_gelen = $_POST["guvenlik"];
	$guvenlik = $_SESSION["kod1"] + $_SESSION["kod2"];
	
	$guvenlik_gelen = $guvenlik;	
		
	
	 
		if(empty($kadi) || empty($eposta) || empty($yorum)){
			bilgi("D�KKAT !"," Yorum yaparken bo� alan b�rakt�n�z ");
			header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
			}elseif(!$eposta_kontrol){
				
			bilgi("Ge�erli E-Mail Giriniz","Girdi�iniz mail ge�ersizdir.");	
			header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
			}elseif($guvenlik != $guvenlik_gelen){
			
				bilgi("Kod Ge�ersiz !","G�venlik Kodu Ge�ersiz");	
			header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
				
			}else{
				
				if(!$_SESSION["oturum"] && is_numeric($kadi)){
					
					bilgi ("Bir Sorun Meydana Geldi","Ad - Soyad Numaradan Olu�amaz");
					header( "Refresh: 5; url={$_SERVER["HTTP_REFERER"]}" );
					
				}else if($_SESSION["oturum"]){
				// �ye Yorum Ekleme
				$uyeBul = mysql_query("select * from uyeler where id='$kadi'");
				$uyeCek = mysql_fetch_array($uyeBul);
				$kadi = $uyeCek["kadi"];
				$rutbe = $uyeCek["uye_grubu"];
				$uyelik = 3;
				
				if($rutbe == 1){
				$uyelik = 1;		
					
				}else if($rutbe == 2){
				$uyelik = 2;	
				}
				
				$uyeYorumGonder = mysql_query("insert into yorumlar (yazan,eposta,yorum,tarih,onay,yorumIP,uyelik,konuID) values('$kadi','$eposta','$yorum','$tarih','$onay','$ip','$uyelik','$id')");
				if($uyeYorumGonder){
					
					if($onay){
				
				bilgi("Yorumunuz Ba�ar�yla G�nderildi","Yorumunuz Ba�ar�yla G�nderildi","onay");	
				header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
					}else{
						bilgi("Yorumunuz Ba�ar�yla G�nderildi","Yorumunuz onayland�ktan sonra g�z�kecektir.","onay");	
					}
				}else{
				bilgi("Bir Sorun Meydana Geldi","Sistemsel Bir Hata Meydana Geldi L�tfen Tekrar Deneyin");	
				}
				
								
				}else{
				// Ziyaret�i Yorum Ekleme	
				
				$ziyYorumGonder = mysql_query("insert into yorumlar (yazan,eposta,website,yorum,tarih,onay,yorumIP,uyelik,konuID) values('$kadi','$eposta','$website','$yorum','$tarih','$onay','$ip','0','$id')");
				if($ziyYorumGonder){
					
				bilgi("Yorumunuz Ba�ar�yla G�nderildi","Yorumunuz Ba�ar�yla G�nderildi","onay");	
				header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
					
				}else{
				bilgi("Bir Sorun Meydana Geldi","Sistemsel Bir Hata Meydana Geldi L�tfen Tekrar Deneyin");	
				}
				}
				
			
		
		}
	
}else{
	
require($GLOBALS["tema_adresi"]."/yorum_yap.php");

}	
	
}	
	
## Giri� Kontrol ##
function giris_kontrol(){
	if(!$_SESSION["oturum"]){
	if($_POST){
		
		$kadi = mysql_real_escape_string(strip_tags(trim($_POST["kadi"])));
		$sifre = mysql_real_escape_string(strip_tags(trim($_POST["sifre"])));
		
		if(empty($kadi) || empty($sifre)) {
		
			bilgi("Bir Sorun Var!","Bo� alan b�rakmadan dene. Hadi ko� y�nlendiriliyosun...");
			header( 'refresh: 3; url=/index.php' );
			
		}else{
			
			$sifre_ss = sha1(md5($sifre));
	 		$bul = mysql_query("select * from uyeler where kadi ='$kadi' && sifre ='$sifre_ss'");
			$say = mysql_num_rows($bul);
			if($say > 0){
				
				// Oturumu ba�lat
				$goster = mysql_fetch_array($bul);
				
				$_SESSION["oturum"] = true;
				$_SESSION["uye_id"] = $goster["id"];
				$_SESSION["kadi"] = $goster["kadi"];
				$_SESSION["kadi_sef"] = $goster["kadi_sef"];
				$_SESSION["eposta"] = $goster["eposta"];
				$_SESSION["hakkinda"] = $goster["hakkinda"];
				$_SESSION["onay"] = $goster["onay"];
				$_SESSION["uye_grubu"] = $goster["uye_grubu"];
				bilgi("Giri� Ba�ar�l�","Ba�ar�l� �ekilde Giri� Yapt�n�z","onay");
				header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
				
			}else{
				
				bilgi("Yanl�� Giri�!","Kullan�c� Ad� veya �ifren Yanl��");
				header( "Refresh: 3; url=/index.php" );
			}
		
		}
		
	}else{
	Header("Location:index.php"	);
	}
	}else{
	bilgi("Giri� yapm�� olup tekrar giri� yapmay� deneyen tek ki�iye ;","Giri� yapm��s�n dostum sadece 1 kere giri� yapman bizim i�in yeter hadi geri d�n bakay�m...");	
	header( 'refresh: 3; url=/index.php' );
	}
	
}

## Cikis Yap ##
function cikis_kontrol(){
	if($_SESSION["oturum"]){
	
	$_SESSION = array();
	session_destroy();
	bilgi("Ba�ar�yla ��k�� Yapt�n�z.","��k�� i�lemi ba�ar�l�","bilgi");
	header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
	
	}else{
		
		header("Location:index.php"	);
		
	}	

	
}

## Profil Fonksiyonu ##
function profil(){
	
	if($GLOBALS["uyelik"]){

if($sefUye = strip_tags($_GET["uye"])){	

$uyeBul = mysql_query("select * from uyeler where kadi_sef='$sefUye'");
$uyeSay = mysql_num_rows($uyeBul);

	if($uyeSay > 0){
		
		$uyeGoster = mysql_fetch_array($uyeBul);
		extract($uyeGoster);
		
		// �ye R�tbesi Bulma
		$rutbeBul = mysql_query("select * from rutbeler where id='$uye_grubu'");
		$rutbeGoster = mysql_fetch_array($rutbeBul);
		$rutbe = $rutbeGoster["rutbe"];
		
		// D�zenleme Bul
		if($kadi == $_SESSION["kadi"]){
		
		$duzenle = '<a href="javascript:void(0)" id="profilDuzenle">[D�zenle]</a>';	
			
		}
		
		// Avatar Bulma
		if(!$avatar){
		$avatar = $GLOBALS["site_adresi"].$GLOBALS["tema_adresi"]."/resim/avataryok.png";
		}
		
		if($_POST){
			
			// G�ncelle
			
			$sifre_new = $_POST["sifre"];
			$hakkimda = strip_tags(addslashes(trim($_POST["hakkimda"])));
			$epostam = addslashes(trim($_POST["epostam"]));
			$eposta_kontrol = filter_var($epostam, FILTER_VALIDATE_EMAIL);
			$avatarn = strip_tags(addslashes(trim($_POST["avatarnew"])));
			if(!empty($sifre_new)){
				
				$sifre_new = sha1(md5($sifre_new));
				$uyeGuncelle = mysql_query("update uyeler set sifre='$sifre_new', eposta='$epostam',hakkinda='$hakkimda',avatar='$avatarn' where id='$id'");
			
			if($uyeGuncelle){
				
				bilgi("BA�ARILI!","<strong>�ifreniz</strong> ve di�er ayarlar�n�z kaydedildi.","onay");
				header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
				
			}else{
			bilgi("G�ncelleme Yap�lamad�","Bir Hata Meydana Geldi");	
			header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
			}
				
			}else{
			
			
			
			$uyeGuncelle = mysql_query("update uyeler set eposta='$epostam',hakkinda='$hakkimda',avatar='$avatarn' where id='$id'");
			
			if($uyeGuncelle){
				
				bilgi("BA�ARILI Yap�lamad�","ayarlar�n�z kaydedildi.","onay");
				header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
				
			}else{
			bilgi("G�ncelleme Yap�lamad�","Bir Hata Meydana Geldi");	
			header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}" );
			}
			}
			
			
		}else{
		
		require($GLOBALS["tema_adresi"]."/profil.php");
		
		}
		
	}else{
	bilgi("Profil Bulunamad�","Sitede B�yle Bir Profil Yok","bilgi");	
	header( "Refresh: 3; url=/index.php" );
	}


}else{
header("Location:index.php"	);
}
	}else{
		header("Location:index.php"	);
		}
}

## Tema Fonks.
function klasor_listele($klasor){
	$klasoru_ac = opendir($klasor) or die ("Hata!");
	while($goster = readdir($klasoru_ac)){
		if(! ereg("[.]",$goster)){
			echo '<option value="'.$goster.'"';
			if ("/tema/".$goster == $GLOBALS["tema_adresi"]){
				echo 'selected="selected"';
			}
			echo '>'.$goster.'</option>';
		}
	}
}

## Etiket G�ster ##
function etiket_goster(){
	
	if($link = strip_tags($_GET["link"])){
		
		$etiketBul = mysql_query("select * from etiketler where etiket_sef = '$link'");
		$etiketSay = mysql_num_rows($etiketBul);
		
		if($etiketSay > 0){
			
			echo '<div id="katlists"><div id="katlistbas"><h1><em>'.$etiketGoster["etiket"].'</em> Etiketine Ait Yaz�lar ;</h1></div>';
				echo '<div id="katlistbas"><span>'.$etiketGoster["etiket"].'</span></div></div>';
			while($etiketGoster = mysql_fetch_array($etiketBul)){
			
				
				$konuid = $etiketGoster["konu_id"];
				$konuBul = mysql_query("select * from konular where id='$konuid'");
				$konuGoster = mysql_fetch_array($konuBul);
				extract($konuGoster);
		$konu_basligi = stripslashes($konu_basligi);
		$konu_anasayfa = stripslashes($konu_anasayfa);
		$konu_anasayfa = nl2br($konu_anasayfa);
			$sorsor = mysql_query("select * from uyeler where id='$ekleyen'");
			$kimo = mysql_fetch_array($sorsor);
			$ekleyen = $kimo["kadi"];
		
		// Kategori Bulma
		$katBul = mysql_query("select * from kategoriler where id='$kategori_id'");
		$katGoster = mysql_fetch_array($katBul);
		$kategori = $katGoster["kategori_adi"];
		
		
		// Yorum Say�s� Bulma
		$yorBul = mysql_query("select * from yorumlar where konuID='$id'  && onay=1");
		$yorGoster = mysql_num_rows($yorBul);
		$ysayisi = $yorGoster;
		if($ysayisi < 1){
		$ysayisi = "Yorum Yok";	
			
		}
		
		$link = $GLOBALS["site_adresi"].$konu_sef_link.".html";
		//$link = "index.php?git=konu&link=".$konu_sef_link;
		
		// G�venlik
		$_SESSION["kod1"]=rand(1,50);
		$_SESSION["kod2"]=rand(2,50);
		$guvenlik = $_SESSION["kod1"]."+".$_SESSION["kod2"];
	
		require($GLOBALS["tema_adresi"]."/konu_anasayfa.php");
	     
			}
			
		}else{
		bilgi("Etiket Bulunamad�","Sitemizde B�yle Bir Etiket Yok","bilgi");	
		}
		
		
	}else{
		header("Location:index.php"	);
		
	}
	
}

## Etiket Bulutu ##
function etiket_bulutu(){

$etiketBul = mysql_query("SELECT * FROM etiketler
GROUP BY etiketler.etiket");
echo '<div id="katlists"><div id="katlistbas"><h1><em>Etiketler</em></h1></div>';
		echo '<div id="katlistbas"><span>Sitedeki B�t�n Etiketler</span></div></div>';
while ($etiketGoster = mysql_fetch_array($etiketBul)){
	
	echo "<div class='but_etiket'>";

	echo " <a href='/etiket/{$etiketGoster["etiket_sef"]}'>{$etiketGoster["etiket"]}</a>";
	echo "</div>";
}	


}

## Durum Fonks.
function durum($a,$b,$c){

if($a == 1){
echo '<option value="1" selected>'.$b.'</option><option value="0">'.$c.'</option>';	
	
}else{
echo '<option value="1">'.$b.'</option><option value="0" selected>'.$c.'</option>';	
	
}	
	
}

## Kategori Listesi ##
function kategori_listesi(){

$bul = mysql_query("select * from kategoriler");
while($goster=mysql_fetch_array($bul)){
	
$link = "/kategori/{$goster["kategori_sef_link"]}";
echo "<a href='{$link}'>{$goster["kategori_adi"]}</a>";
	
	
}
	
	
}

## Men� Fonksiyonu ##
function menu(){
	

$eBul = mysql_query("select * from menuler where gorunur='1'");
$eSay = mysql_num_rows($eBul);
if($eSay > 0){
while ($etiketGoster = mysql_fetch_array($eBul)){

	if($etiketGoster["resim"]!='' && $etiketGoster["link_yapisi"]){
	echo " <a href='{$etiketGoster["link"]}' target=_blank><img src='{$etiketGoster["resim"]}' /> {$etiketGoster["baslik"]}</a>";
	}else if($etiketGoster["resim"]!=''){ 
	echo " <a href='{$etiketGoster["link"]}'><img src='{$etiketGoster["resim"]}' /> {$etiketGoster["baslik"]}</a>";
	}elseif($etiketGoster["link_yapisi"]){
	echo " <a href='{$etiketGoster["link"]}' target=_blank>{$etiketGoster["baslik"]}</a>";
	}else{
	echo " <a href='{$etiketGoster["link"]}'>{$etiketGoster["baslik"]}</a>";
	}
}	

}



}

## Kay�t ##
function kayit(){
if($GLOBALS["uyelik"]){
if(!$_SESSION["oturum"]){
	if($_POST){
		
	$kadi = mysql_real_escape_string(strip_tags(trim($_POST["kadi"])));
	$kadi_sef = sef_link($kadi);
	$sifre = sha1(md5(strip_tags(trim(mysql_real_escape_string($_POST["sifre"])))));
	$sifre2 = sha1(md5(strip_tags(trim(mysql_real_escape_string($_POST["sifre2"])))));
	$eposta = strip_tags(trim(mysql_real_escape_string($_POST["eposta"])));
	$eposta_kontrol = filter_var($eposta, FILTER_VALIDATE_EMAIL);
	$hakkinda = strip_tags(trim(mysql_real_escape_string($_POST["hakkinda"])));
	$tarih = date("d.m.Y H:i");
	$uye_grubu = 4 ;
	
	if(empty($kadi) ||empty($sifre) ||empty($eposta)){
	
	bilgi("Bo� Alan B�rakt�n!","Dostum kay�t olmak i�in bo� veriler g�nderme biraz elini �al��t�r ve oraya istenileni yaz. �imdi Y�nlendiriliyosun tekrar hadi...");	
		header( 'refresh: 3; url=/index.php?git=kayit' );
	}else if ($sifre != $sifre2){
		bilgi ("�ifreler Uyu�mad�","�ifrelerinin ikisinide ayn� gir!");		
		}else if (!$eposta_kontrol){
		bilgi ("E-Posta Ge�ersiz","E-Posta adresini l�tfen do�ru gir");	
		}else{
		$sorgu = mysql_query("select * from uyeler where kadi='$kadi' || eposta = '$eposta'");
		$say = mysql_num_rows($sorgu);
		
		if ($say > 0 ) {
			
			bilgi("HATA !","Bu <b>Kullan�c� Ad�</b> veya <b>EPosta</b> ile daha �nce kay�t olunmu�");
			header( 'refresh: 3; url=/index.php?git=kayit' );
		}else{
		
		// Veri Taban� Kay�t
		$ekle = mysql_query("insert into uyeler (kadi,kadi_sef,sifre,eposta,hakkinda,kayit_tarih,uye_grubu,onay) values ('$kadi','$kadi_sef','$sifre2','$eposta','$hakkinda','$tarih','$uye_grubu',1)");
		
		if($ekle){
		bilgi("Kay�t Ba�ar�l�!","Siteme $kadi Kullan�c� Ad�yla Ba�ar�l� �ekilde �ye Oldun. Giri� Yapabilirsin.","onay");
		header( 'refresh: 3; url=/index.php' );
		}else{
		bilgi("Bir Sorun Meydana Geldi!","Kay�t Eklenirken Bir Sorun Meydana Geldi! Tekrar Deneyin");
		header( 'refresh: 3; url=/index.php?git=kayit' );
		}
		

	}
	}
	}else{
		
		require	($GLOBALS["tema_adresi"]."/kayit.php");

		
	}
}else{
	
	header("Location:index.php"	);
	}
}else{
	
	bilgi ("D�KKAT!","Siteye �ye Al�m� Yoktur...","bilgi");
	}
	}
	
## Sosyal A� Fonksiyonu ##
function sosyal_ag(){

$eBul = mysql_query("select * from sosyal_ag");
$eSay = mysql_num_rows($eBul);
if($eSay > 0){
while ($etiketGoster = mysql_fetch_array($eBul)){

	echo "<div class='sosyal_agsimg'> <a href='{$etiketGoster["ag_linki"]}' target=_blank><img style='margin: 0; padding: 0;' src='{$etiketGoster["ag_resim"]}' /></a></div>";

}	

}else{
echo "Sosyal A� Girilmemi�";	
}



}
	
## Etiketler ## 
function etiketler(){

$etiketBul = mysql_query("SELECT * FROM etiketler
GROUP BY etiketler.etiket limit 10");
$eBul = mysql_query("select id from etiketler GROUP BY etiketler.etiket");
$eSay = mysql_num_rows($eBul);
while ($etiketGoster = mysql_fetch_array($etiketBul)){

	echo " <a href='/etiket/{$etiketGoster["etiket_sef"]}'>{$etiketGoster["etiket"]}</a>,";
	
}	

if($eSay > 10){

echo "<div class='tum_etiketler'><a href='/etiket-bulutu' class='tum_etiketler'><strong style='color:#601A0A;'>B�t�n Etiketler</strong></a></div>";	
	
}

}

## Arama ##
function arama(){
if($_POST){
	
	$kelime = $_POST["kelime"];
	if(empty($kelime)){
	bilgi("Bo� Alan Var","Aranacak Kelime Girmediniz!");	
	}else{
	$konuBul = mysql_query("select * from konular where konu_basligi like '%$kelime%'");
	$konuSay = mysql_num_rows($konuBul);
	
	if($konuSay > 0){
		
		
	// Listeletme
	while($goster=mysql_fetch_array($konuBul)){
		extract($goster);
		$konu_basligi = stripslashes($konu_basligi);
		$konu_anasayfa = stripslashes($konu_anasayfa);
		$konu_anasayfa = nl2br($konu_anasayfa);
			$sorsor = mysql_query("select * from uyeler where id='$ekleyen'");
			$kimo = mysql_fetch_array($sorsor);
			$ekleyen = $kimo["kadi"];
		
		// Kategori Bulma
		$katBul = mysql_query("select * from kategoriler where id='$kategori_id'");
		$katGoster = mysql_fetch_array($katBul);
		$kategori = $katGoster["kategori_adi"];
		
		
		// Yorum Say�s� Bulma
		$yorBul = mysql_query("select * from yorumlar where konuID='$id'  && onay=1");
		$yorGoster = mysql_num_rows($yorBul);
		$ysayisi = $yorGoster;
		if($ysayisi < 1){
		$ysayisi = "Yorum Yok";	
			
		}
		
		$link = $GLOBALS["site_adresi"].$konu_sef_link.".html";
		//$link = "index.php?git=konu&link=".$konu_sef_link;
		
		// G�venlik
		$_SESSION["kod1"]=rand(1,50);
		$_SESSION["kod2"]=rand(2,50);
		$guvenlik = $_SESSION["kod1"]."+".$_SESSION["kod2"];
	
		require($GLOBALS["tema_adresi"]."/konu_anasayfa.php");
	    
		
	}
		
	}else{
	bilgi ("Arama Sonu�lar�","Arad���n�z anahtar kelimeye ait hi� bir ba�l�k bulamad�k...","bilgi");	
	}	
	}}else{

	header("Location:index.php"	);
	
}	
	
}

##Eposta kay�t ##
function epostak(){
if($_POST){

$eposta = $_POST["eposta"];
$sorgu = mysql_query ("select * from epostalist where eposta = '$eposta'");
$say = mysql_num_rows($sorgu);
if($say > 0){
bilgi("D�KKAT!","Bu mail adresi daha �nce listemize kay�t edildi.","bilgi");
}else{
$ip = IPAdres();
$tarih = date("d.m.Y H:i");

$gonder = mysql_query ("insert into epostalist (eposta,tarih,ip) values('$eposta','$tarih','$ip')");
if($gonder){
bilgi("Ba�ar�yla kay�t oldunuz.","E�er sistemimiz aktif ise her yaz�da taraf�n�za bilgi maili g�nderilecektir.","onay");

$alici = $eposta;
$konu = 'Kemal Ayd�n Blog Takip Listesi';
$mesaj = 'kmlaydin.com adresi i�in ba�l�k takip listesine eklendiniz. Art�k yeni yaz�larda taraf�n�za mail g�nderilecektir.';
$basliklar = 'From: kemal@kmlaydin.com' . "\r\n" .
    'Content-type: text/html; charset=utf-8' . "\r\n" .
    'Reply-To: kemik_95@hotmail.com' . "\r\n" .
    'Cc: $eposta' . "\r\n"; 

mail($alici, $konu, $mesaj, $basliklar);
}else{
bilgi("Olmad� ama...","Ne yaz�kki sistemsel bir sorun nedeniyle kay�t yap�lamad�");
}
}
}else{
header("Location:index.php"	);
}
}


## Rastgele Konu ##
function rastgele(){

$konusay = mysql_query("SELECT * FROM konular ORDER BY id DESC LIMIT 1 ");
$sonkonu = mysql_fetch_array($konusay);
$sonoku = $sonkonu["id"];
$sonkonsu=rand(30,$sonoku);
$konubul = mysql_query("SELECT * FROM konular WHERE id='$sonkonsu'");
$konuoho = mysql_num_rows($konubul);

if($konuoho > 0) {
$konucek = mysql_fetch_array($konubul);
$sef_konu = $konucek["konu_sef_link"];
$bul = mysql_query("select * from konular where konu_sef_link='$sef_konu'");
	$say = mysql_num_rows($bul);
	
	if($say > 0){
		
		// konu �ek
		
		$goster = mysql_fetch_array($bul);
		extract($goster);
		$konu_icerik = nl2br($konu_icerik);
		require($GLOBALS["tema_adresi"]."/konu_oku.php");
		
		// okuma g�ncelle
		$okumaGuncelle = mysql_query("update konular set okunma=okunma+1 where id='$id'");
		
		// Kategori Bulma
		$katBul = mysql_query("select * from kategoriler where id='$kategori_id'");
		$katGoster = mysql_fetch_array($katBul);
		$kategori = $katGoster["kategori_adi"];
		
		// Yorum Say�s� Bulma
		$yorBul = mysql_query("select * from yorumlar where konuID='$id' && onay=1");
		$yorGoster = mysql_num_rows($yorBul);
		$ysayisi = $yorGoster;
		if($ysayisi < 1){
		$ysayisi = "Yorum Yok";	
			
		}
		
		
	}else{
	bilgi("B�yle Bir Ba�l�k Yok","Arad���n�z ba�l�k sitemizde bulunmuyor","bilgi");	
	header( "Refresh: 3; url=/index.php" );
	}


}else{
bilgi ("Konu Silinmi�","Bu konu siteden kald�r�lm��","bilgi");
}

}



# G�ster Foknsiyonu ( Sol Taraf�n De�i�me Alan� ) ##
function goster(){
	$git = $_GET["git"];
	
	switch($git) {
		
		case "kayit";
		kayit();
		break;
		
		case "giris";
		giris_kontrol();
		break;
		
		case "konu_ekle";
		konu_ekle();
		break;
		
		case "konu";
		konu_okuma();
		break;
		
		case "kategori";
		kategori();
		break;
		
		case "sayfa";
		sayfa();
		break;
		
		case "arama";
		arama();
		break;
				
		case "cikis";
		cikis_kontrol();
		break;
		
		case "etiketler";
		etiket_goster();
		break;
		
		case "etiket-bulutu";
		etiket_bulutu();
		break;
		
		case "profil";
		profil();
		break;
		
		case "epostakayit";
		epostak();
		break;
		
		case "rastgele";
		rastgele();
		break;
		
		default;
		konu_listesi();
		break;
	}
	
	}
	




ob_end_flush();
?>