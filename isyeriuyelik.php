	<?php 
	session_start();
	// Öğrenci Okulunu Bulma
	// Mesaj Sayma 
	$MesajSayisi = mysql_query("select * from mesajlar");
	$kactane = 0;
	while($MesajBak = mysql_fetch_array($MesajSayisi)){

	$Alan = $MesajBak["Kime"];
		$Kimden = $MesajBak["Kimden"];
		
		$KimeUyelikTuru = substr($Alan, 0, 1);
		
		if($KimeUyelikTuru == $_SESSION["UyelikTuru"]){
		
$KimeUyelikSahibi = substr($Alan, 2);
			
			
		if($KimeUyelikSahibi == $_SESSION["uid"]){
				$saykac = 1;
				extract($MesajBak);
				
				$KullaniciID = $Alan;
				if($Okunma == 0){
				$KimeGonderdiki = $_SESSION["UyelikTuru"].'-'.$KimeUyelikSahibi;
				$MesajSorgu1 = mysql_query("select * from mesajlar where Kime='$KimeGonderdiki' && AliciSil ='0'");
				$SaySayMesaj = mysql_num_rows($MesajSorgu1);
				if($Yenivar == 1){
				$varmiyokmu = 'mesajiconno';
				}else{
				$kactane = $SaySayMesaj;
				$varmiyokmu = 'mesajiconno';
				}
				}else{
				$Yenivar = 1;
				$varmiyokmu = 'mesajicon';
				}
			}else{

			}
		
		}
	}
	
	
	// İstatistik Öğrenme
	$ogrencikac = mysql_query("select * from ogrenci where onay='1'");
	$ogrencisay = mysql_num_rows($ogrencikac);
	$isyerikac = mysql_query("select * from isyeri where onay='1'");
	$isyerisay = mysql_num_rows($isyerikac);
	$okulkac = mysql_query("select * from okul where onay='1'");
	$okulsay = mysql_num_rows($okulkac);
	$ilankac = mysql_query("select * from ilanbasvuru where onay='1'");
	$ilansay = mysql_num_rows($ilankac);

	$ProfilTamamlamaIsyeri = 1;


	?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title><?php baslik(); ?></title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css" media="all" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js	"></script>
	<script type="text/javascript" src="js/Cufon.js"></script>
	<script type="text/javascript" src="Myriad_Pro_600.font.js"></script>
	<script src='js/googleapis.js'></script>
	<script src='js/ajaxgoogle.js'></script>
	<script type="text/javascript" src="sistem/ckeditor/ckeditor.js"></script> 
    <script type="text/javascript" src="js/stajyeri.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {		
	$(".sonbascurular li:first-child").css("border", "none");

		  

});

        Cufon.replace('.menu li,.sagbaslik, .sonbasvurubaslik', {
                textShadow: '#c8b495 1px 1px',
				hover: '#fff'
			
            });
       
	</script>
	<script type="text/javascript">
        Cufon.replace('.sonbasvurubaslik', {			
            });
       
	</script>

	
<?php
if($_SESSION["UyelikTuru"] == "2"){
$idsi = $_SESSION["uid"];
$bilgilericek = mysql_query("select * from isyeri where id = '$idsi'");
$bilgisay = mysql_num_rows($bilgilericek);
$bilgilerigoster = mysql_fetch_array($bilgilericek);
extract($bilgilerigoster);
if(empty($VergiNo) || empty($il) || empty($ilce) || empty($Telefon) || empty($Adres) || empty($IsAlani) || empty($UstaOgretici1))
					{	
					
					 if($_GET["git"] == "profilduzenleisyeri"){
					 $ProfilTamamlamaIsyeri = 1;
					 }else if($_GET["git"] == "cikis" || $_GET["git"] == "isyeriproguncel" || $_GET["git"] == "HataBul"){
					 $ProfilTamamlamaIsyeri = 1;
					 
					 }else{
					$ProfilTamamlamaIsyeri = 0;
						
						?>
			<link rel="stylesheet" href="general.css" type="text/css" media="screen" />
			
			<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
			<script src="/popup.js" type="text/javascript"></script>
			<script>
				$(document).ready(function(){
				centerPopup();
				loadPopup();
				});
			</script>
	
					<?php }} ?>
		</head>
		<body>
		
<?php if($ProfilTamamlamaIsyeri == 0){

echo '
<div id="backgroundPopup"></div>
<div id="popupContact">
		
		<h3>Tamamlanmamış Bilgileriniz Mevcut !</h3>
		<p id="contactArea">
			Sistemi Kullanabilmek İçin Önce Aşağıda Listelenmiş Eksik Bilgilerinizi Giriniz
			<br/><br/>
			Stajyer-i.com Olarak Daha İyi Bir Hizmet İçin Sistemi Profiliniz Tam Olmadan Kullanamayacaksınız.
			<br/><br/>

			';
			
			if(empty($VergiNo)){
			echo '<b> Vergi Numaranız <br />';
			}
			if(empty($il)){
			echo '<b> İliniz <br />';
			}
			if(empty($ilce)){
			echo '<b> İlçeniz <br />';
			}
			if(empty($Telefon)){
			echo '<b> Telefon Numaranız  <br />';
			}
			if(empty($Adres)){
			echo '<b> Adresiniz <br />';
			}	
			if(empty($IsAlani)){
			echo '<b> İş Alanınız <br />';
			}	
			if(empty($UstaOgretici1)){
			echo '<b> Usta Öğreticiniz <br />';
			}	
			
			
		
		echo '</p>
		<a href="profilduzenleisyeri/"><button class="buton onayla" type="submit"><span class="islem evet"> > Profilini Tamamla ></span></button></a>
		<a href="cikis/"><button class="buton onaylama nomargin close"><span class="islem hayir">X Çıkış Yap</span></button></a>
	</div>
	<div id="backgroundPopup"></div>
	';

} }

?>
	<div id="header">
	<div class="header">
	<div class="logo"></div>
	<div class="istatistik">
	<span><center>Sistemde Şuan <b> <?php echo $ogrencisay; ?> Öğrenci </b>, <b> <?php echo $okulsay; ?> Okul </b> ve <b> <?php echo $isyerisay; ?> İş Yeri </b> Kayıtlı</center></span>
	</div>
	</div>
	</div>
	<div id="menu">
	<div class="menu" style="padding: 7px;">
	<center>
	<li><a href="index.php">ANA SAYFA</a></li>
	<li><a href="ogrenciler/">ÖĞRENCİLER</a></li>
	<li><a href="sirketler/">ŞİRKETLER</a></li>
	<li><a href="okullar/">OKULLAR</a></li>
	<li><a href="ilanlar/">İLANLAR</a></li>
	<li><a href="sss/">SIKÇA SORULAN SORULAR</a></li>
	<li><a href="hakkimizda/">HAKKIMIZDA</a></li>
	<li><a href="/blog">BLOG</a></li>
	<li style="background: none;"><a href="iletisim/">İLETİŞİM</a></li>
	</center>
	</div>
	</div>
	<div class="uyari">
	<span>Sistemimiz şu an Beta Olarak Test Edilmektedir. Karşılaşacağınız Hataları Lütfen Bize Bildiriniz.</span><a href="HataBul/"> <img src="img/geribildirbtn.png" alt="HATA BİLDİR" /></a>
	</div>
	
	<div id="genel">
		<div class="sol">
			<div class="sonbasvurubaslik">Üye Profili</div>
			<div class="uyekosesi">
			<img class="kulresim" src="<?php 
			$isyerii = $_SESSION['uid'];
			$resim = mysql_fetch_array(mysql_query("select * from isyeri where id='$isyerii'"));
			echo $resim['Resim'];?>" alt="Kullanıcı Resim" />
			<span><b><a href="isyeri/<?php echo $_SESSION["SefLink"];?>"><?php echo $_SESSION["Ad"] . ' ' .$_SESSION["Soyad"]; ?> </a></b></span>
			<span>İşyeri</span>
			<span style="margin-bottom: 15px; padding-right: 3px;"><?php echo $_SESSION["IsyeriAdi"]; ?></span>
			<div class="bosluk"></div>
			<ul>
			<?php if($_SESSION["UyelikTuru"] == "2"){ ?>
			<li><img src="img/menulisi.png"><a href="profilduzenleisyeri/"> Hesabı Düzenle</a></li>
			<li><img src="img/menulisi.png"><a href="ilanekle/"> İlan Ekle</a></li>
			<li><img src="img/menulisi.png"><a href="stajyerlerim/"> Stajyerlerim</a></li>
			<?php }?>
			<li><img src="img/menulisi.png"><a href="index.php?git=mesajlarim"> Mesajlarım </a><a class="<?php echo $varmiyokmu; ?>" href="mesajlarim/"> <?php echo $kactane; ?></a></a></li>
			<li><img src="img/menulisi.png"><a href="cikis/"> Çıkış</a></li>
			</ul>
			</div>
			<div class="solaltkos"></div>
			
			<div class="sonbasvurubaslik">İlanlarınız</div>
			<div class="sonbascurular">
			<ul>
			<?php ilanlarim(); ?> 
			</ul>
			</div>
			<div class="solaltkos"></div>
			
			
			<div class="sonbasvurubaslik">Takip Edin</div>
			<div class="sonbascurular">
			<center><a href="http://www.facebook.com/StajyeriCom" target="_blank"><img style="margin-top: 9px;" src="img/facebook.png" /></a><br />
			<a href="https://twitter.com/#!/stajyericom" target="_blank"><img src="img/twitter.png" /></a></center>

			</div>
			<div class="solaltkos"></div>
		</div>
	
		<div class="sag">
		<?php goster(); ?>

		</div>
	</div>
<!----------------------------------------->
<div class="ileti">

</div>
<?php $birlesmis = $_SESSION["UyelikTuru"].'-'.$_SESSION["uid"]; ?>

<script type="text/javascript">

	function iletiSor(){

		var id  = "<?php echo $birlesmis; ?>";


		var deger = "id="+id;


			$.ajax({

			type:"POST",
			data:deger,
			url:"mesajSor.php",
			success:function(donen2){

				if(donen2!="hayir"){
					
					$(".ileti").fadeIn("slow",function(){
						$(".ileti").empty();
							$(this).append("<span style='display:block; font-weight:bold; '>Yeni mesjınız var</span>"+donen2).delay(2000).fadeOut("slow");

							$.ajax({
									type:"POST",
									data:deger,
									url:"degistir.php",
									success:function(donen3){
											
										}
									

								});

					
						
							
					});
				}
				
				}


						});
			
		


	}


	setInterval("iletiSor();",4000);

</script>

<!------------------------------------------>
	<div style="clear:both"> </div>
	<div id="footer">
	<div class="footer"><br />
	<span>&copy 2012 Stajyer-i.com. Bütün Hakkı Saklıdır</span><br />
	 
	<span style="float:right; margin-top: -42px;"><b>Hosting Sponsoru </b><br /><a href="http://www.hozzt.com/panel/link.php?id=16" target="_blank"><img style="padding-bottom: 5px; border-bottom: 1px dotted #605442; width: 120px; height: 30px;" src="img/hozztlogo.png"></a><br/>
	<a href="http://www.yandex.com.tr" target="_blank" title="Yandex Haritalar"><img style="margin-top: 5px; width: 50px; height: 19px; margin-right: 16px;" src="img/yandexlogo.png"></a>	<a href="http://www.tamindir.com" target="_blank" title="indir"><img style="margin-top: 5px; width: 50px; height: 21px;" src="img/tamindirlogo.png"></a>
	</span>
	</div>
	</div>
</body>
</html>
