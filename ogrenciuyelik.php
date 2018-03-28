<?php
session_start();
	// Ã–ÄŸrenci Okulunu Bulma
	$OgrID = $_SESSION["uid"];
	$Ogrencim = mysql_query("select * from ogrenci where id = '$OgrID'");
	$OgrenciKim = mysql_fetch_array($Ogrencim);
	
	$OkulID = $OgrenciKim["OkulID"];
	$DogumTarihi = $OgrenciKim["DogumTarih"];
	
	$Okulum = mysql_query("select * from okul where id = '$OkulID'");
	$Mysql_num = mysql_num_rows($Okulum);
	if($Mysql_num > 0){
	$OkulCikar = mysql_fetch_array($Okulum);
	$Okulu = $OkulCikar["OkulAdi"];
	}else{
	$Okulu = "Okul Bilgisi Yok";
	}
	// Mesaj Sayma 
	$MesajSayisi = mysql_query("select * from mesajlar");
	$kactane = 0;
	$Yenivar = 0;
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
	
	
	// Ä°statistik Ã–ÄŸrenme
	$ogrencikac = mysql_query("select * from ogrenci where onay='1'");
	$ogrencisay = mysql_num_rows($ogrencikac);
	$isyerikac = mysql_query("select * from isyeri where onay='1'");
	$isyerisay = mysql_num_rows($isyerikac);
	$okulkac = mysql_query("select * from okul where onay='1'");
	$okulsay = mysql_num_rows($okulkac);
	$ilankac = mysql_query("select * from ilanbasvuru where onay='1'");
	$ilansay = mysql_num_rows($ilankac);

	$ProfilTamamlamaOgrenci = 1;


	?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title><?php baslik(); ?></title>
	<?php if(stristr($tarayici,"MSIE 8.0") || stristr($tarayici,"MSIE 9.0") || stristr($tarayici,"MSIE 10.0") ){ ?>
<link rel="stylesheet" type="text/css" href="styles/stylesie.css" media="all" />
<?php } else { ?>
<link rel="stylesheet" type="text/css" href="styles/styles.css" media="all" />
<?php } ?>
	
        	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js	"></script>
	<script type="text/javascript" src="js/Cufon.js"></script>
	<script type="text/javascript" src="Myriad_Pro_600.font.js"></script>
    	<script type="text/javascript" src="js/stajyeri.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500&subset=latin,latin-ext' rel='stylesheet' type='text/css'>



	<script type="text/javascript">
	$(document).ready(function() {		
	$(".sonbascurular li:first-child").css("border", "none");

		  $('#slider').coinslider({width:670,height:200,opacity:1});

});

        Cufon.replace('.sagbaslik, .sonbasvurubaslik', {
                textShadow: '#c8b495 1px 1px',
				hover: '#fff'
			
            });
       
	</script>
	<script type="text/javascript">
        Cufon.replace('.sonbasvurubaslik', {			
            });
       
	</script>
	<script type="text/javascript">
		
	
	
	$(window).load(function(){

	
		var toplamLi = $("#s li").length;
		var liGenislik = $("#s li").width();
		var toplamGenislik = toplamLi*liGenislik;
			toplamGenislik = toplamGenislik + "px";
		$("#s").css("width",toplamGenislik);
		$("#slider").prepend('');
		
		var a = 0;
		var d = 7000;
		
		var GeriGit = toplamLi*liGenislik-liGenislik+"px";
		$(".sonraki").click(function(){
		
			if (a == toplamLi-1){
				$("#s").animate({"marginLeft":"+="+GeriGit});
				a = 0;
			}else {
				a++;
				$("#s").animate({"marginLeft":"-="+liGenislik}, "slow");
			}
		});

		$(".onceki").click(function(){
		
			if (a == 0){
				$("#s").animate({"marginLeft":"-="+GeriGit});
				a = toplamLi-1;
			}else {
				a--;
				$("#s").animate({"marginLeft":"+="+liGenislik}, "slow");
			}	
		});
		var int=self.setInterval(function(){
			if (a == toplamLi-1){
				$("#s").animate({"marginLeft":"+="+GeriGit});
				a = 0;
			}else {
				a++;
				$("#s").animate({"marginLeft":"-="+liGenislik}, "slow");
			}
		},d);
	});
	
	
	</script>
	
<?php
if($_SESSION["UyelikTuru"] == "1"){
$idsi = $_SESSION["uid"];
$bilgilericek = mysql_query("select * from ogrenci where id = '$idsi'");
$bilgilerigoster = mysql_fetch_array($bilgilericek);
extract($bilgilerigoster);

	if(empty($Cinsiyet) || empty($il) || empty($ilce) || empty($LiseTuru) || empty($OkulID) || empty($Bolum) || empty($Dal) || empty($Sinif) || empty($Sube))
					{	
					
					 if($_GET["git"] == "profilduzenle"){
					 $ProfilTamamlamaOgrenci = 1;
					 }else if($_GET["git"] == "cikis" || $_GET["git"] == "profilguncellendi" || $_GET["git"] == "HataBul"){
					 $ProfilTamamlamaOgrenci = 1;
					 
					 }else{
					$ProfilTamamlamaOgrenci = 0;
						
						?>
			<link rel="stylesheet" href="/general.css" type="text/css" media="screen" />
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
<div class="genel">
	
<?php if($ProfilTamamlamaOgrenci == 0){

echo '
<div id="backgroundPopup"></div>
<div id="popupContact">
		
		<h3>Tamamlanmamış Bilgileriniz Mevcut !</h3>
		<p id="contactArea">
			Sistemi Kullanabilmek İçin önce Aşağıda Listelenmiş Eksik Bilgilerinizi Giriniz
			<br/><br/>
			Stajyer-i.com Olarak Daha İyi Bir Hizmet için Sistemi Profiliniz Tam Olmadan Kullanamayacaksınız.
			<br/><br/>

			';
			
			if(empty($Cinsiyet)){
			echo '<b> Cinsiyetiniz <br />';
			}
			if(empty($il)){
			echo '<b> İliniz <br />';
			}
			if(empty($ilce)){
			echo '<b> İlçeniz <br />';
			}
			if(empty($LiseTuru)){
			echo '<b> Lise Türünüz  <br />';
			}
			if(empty($OkulID)){
			echo '<b> Okulunuz <br />';
			}	
			if(empty($Bolum)){
			echo '<b> Bölümünüz <br />';
			}	
			if(empty($Dal)){
			echo '<b> Dalınız <br />';
			}	
			if(empty($Sinif)){
			echo '<b> Sınıfınız <br />';
			}
			if(empty($Sube)){
			echo '<b> Şubeniz <br />';
			}
			
		
		echo '</p>
		<a href="profilduzenle/"><button class="buton onayla" type="submit"><span class="islem evet"> > Profilini Tamamla ></span></button></a>
		<a href="cikis/"><button class="buton onaylama nomargin close"><span class="islem hayir">Çıkış Yap</span></button></a>
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
	<div class="menu">
	<center>
	<li><a href="index.php">ANA SAYFA</a></li>
	<li><a href="sirketler/">ŞİRKETLER</a></li>
	<li><a href="okullar/">OKULLAR</a></li>
	<li><a href="ilanlar/">İLANLAR</a></li>
	<li><a href="dosyalar/">DOWNLOAD</a></li>
	<li><a href="staj/">STAJ HAKKINDA</a></li>
	<li><a href="sss/">SIKÇA SORULAN SORULAR</a></li>
	<li><a href="hakkimizda/">HAKKIMIZDA</a></li>
	<!--<li><a href="/blog">BLOG</a></li>-->
	<li style="background: none;"><a href="iletisim/">İLETİŞİM</a></li>
	</center>
	</div>
	</div>
	<div class="uyari">
	<span>Sistemimiz Şu an Beta Olarak Test Edilmektedir. Karşılaşacağınız Hataları Lütfen Bize Bildiriniz.</span><a href="HataBul/"> <img src="img/geribildirbtn.png" alt="HATA BİLDİR" /></a>
	</div>
	
	<div id="genel">
		<div class="sol">
			<div class="sonbasvurubaslik">Üye Profili</div>
			<div class="uyekosesi">
			<img class="kulresim" src="<?php echo $Resim; ?>" alt="<?php echo $Ad . ' ' .$Soyad; ?>" />
			<span><b><a href="ogrenci/<?php echo $SefLink; ?>"><?php echo $Ad . ' ' .$Soyad; ?> </a></b></span>
			<span>Stajyer</span>
			<span style="margin-bottom: 15px; padding-right: 3px;"><?php echo $Okulu; ?></span>
			<div class="bosluk"></div>
			<ul>
			<?php if($_SESSION["UyelikTuru"] == "1"){ ?>
			<li><img src="img/menulisi.png"><a href="profilduzenle/"> Hesabı Düzenle</a></li>
			<li><img src="img/menulisi.png"><a href="stajyerim/"> Stajyerim</a></li>
			<?php if($StajBaslama == 1){ ?> <li><img src="img/menulisi.png"><a href="index.php?git=StajDosyasi" style="color:#1c5c6c; font-weight: bold;"> Staj Dosyam</a></li> 
			<li><img src="img/menulisi.png"><a href="index.php?git=StajBelgesi" style="color:#1c5c6c; font-weight: bold;"> Staj Dilekçesi</a></li> 
			<?php } ?>
			<?php }?>
			<li><img src="img/menulisi.png"><a href="mesajlarim/"> Mesajlarım</a> <a class="<?php echo $varmiyokmu; ?>" href="mesajlarim/"> <?php echo $kactane; ?></a></li>
			<li><img src="img/menulisi.png"><a href="cikis/"> Çıkış</a></li>
			</ul> 
			</div>
			<div class="solaltkos"></div>
			
			<div class="sonbasvurubaslik">Son Başvurular</div>
			<div class="sonbascurular">
			<ul>
			<?php basvurulist(); ?> 
			</ul>
			</div>
			<div class="solaltkos"></div>
			
			<div class="sonbasvurubaslik">Takip Edin</div>
			<div class="sonbascurular"><br/>
			<div class="facebook">
			<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FStajyeriCom&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21&amp;appId=240865879301985" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
			</div><br/>
			<div class="twitter">
			<a href="https://twitter.com/stajyericom" class="twitter-follow-button" data-show-count="false" data-lang="tr" data-show-screen-name="false">Takip et: @stajyericom</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<a style="margin-left: 6px;" href="http://stajyer-i.com/blog" target="_blank"><img src="img/blogtanit.png" /></a></center>

			</div>
			<div class="solaltkos"></div>
		</div>
	
		<div class="sag">
		<?php goster(); ?>

		</div>
		
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
							$(this).append("<span style='display:block; font-weight:bold; '>Yeni mesajınız var</span>"+donen2).delay(2000).fadeOut("slow");

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

	</div>
<div style="clear:both"> </div> 
	<div id="footer">
	<div class="footer"><br />
	<span>&copy 2012 Stajyer-i.com. Bütün Hakkı Saklıdır - <a href="http://www.stajyer-i.com/blog/version" target="_blank">1.0 [Beta]</a></span><br />
	 
	<span style="float:right; margin-top: -42px;"><b>Hosting Sponsoru </b><br /><a href="http://www.hozzt.com/panel/link.php?id=16" target="_blank"><img style="padding-bottom: 5px; border-bottom: 1px dotted #605442; width: 120px; height: 30px;" src="img/hozztlogo.png"></a><br/>
	<a href="http://www.yandex.com.tr" target="_blank" title="Yandex Haritalar"><img style="margin-top: 5px; width: 50px; height: 19px; margin-right: 16px;" src="img/yandexlogo.png"></a>	<a href="http://www.tamindir.com" target="_blank" title="indir"><img style="margin-top: 5px; width: 50px; height: 21px;" src="img/tamindirlogo.png"></a>
	</span>
	</div>
	</div>
</div>
</body>
</html>
