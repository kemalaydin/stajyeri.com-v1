		
		<?php 

$tarayici=$_SERVER['HTTP_USER_AGENT'];

if(stristr($tarayici,"MSIE 7.0") || stristr($tarayici,"MSIE 6.0") || stristr($tarayici,"MSIE 8.0") || stristr($tarayici,"MSIE 9.0") || stristr($tarayici,"MSIE 10.0") ){
echo '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Stajyer-i.com | Stajyer ile İş Verenin Buluşması</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css" media="all" />
        	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js	"></script>
	<script type="text/javascript" src="js/Cufon.js"></script>
	<script type="text/javascript" src="Myriad_Pro_600.font.js"></script>
    	<script type="text/javascript" src="js/stajyeri.js"></script>

	<link rel="stylesheet" href="/general.css" type="text/css" media="screen" />
			<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>
			<script src="/popup.js" type="text/javascript"></script>
			<script>
				$(document).ready(function(){
				centerPopup();
				loadPopup();
				});
			</script>
<div id="backgroundPopup"></div>
<div id="popupContact">

		<h3>Lütfen Tarayıcınızı Güncelleyiniz</h3>
		<p id="contactArea">
			Sitemizi en iyi şekilde kullanabilmeniz için Tarayıcıların Güncel Sürümünü Kullanınız.
			<br/><br/>
			<a target="_blank" href="https://www.google.com/chrome/index.html?hl=tr&brand=CHMB&utm_campaign=tr&utm_source=tr-ha-emea-tr-sk&utm_medium=ha">En Güncel <b>Google Chrome</b> Sürümünü İndirmek İçin Tıklayın. ( TAVSİYE EDİLEN )</a><br />
			<a target="_blank" href="http://www.mozilla.org/tr/firefox/new/"> En Güncel <b>Firefox</b> Sürümünü İndirmek İçin Tıklayın.</a><br />
			<a target="_blank" href="http://www.opera.com/download/">En Güncel <b>Opera</b> Sürümünü İndirmek İçin Tıklayın.</a><br />
			<a target="_blank" href="http://www.apple.com/safari/">En Güncel <b>Safari</b> Sürümünü İndirmek İçin Tıklayın.</a><br />
			<br/><br/>

</p>
	</div>
	<div id="girisLogo"></div>
	<div style="clear: both;"></div>
	<div id="backgroundPopup"></div>
	';

}else{

		if($_SESSION["oturum"]){
		require("uyeana.php");
		}else{
		unset($_SESSION["oturum"]);
		?>
		<!-- STAJYER-I.COM | 2011-2012 -->
		<!-- PROGRAMLAMA : KEMAL AYDIN -->
		<!-- PROGRAMLAMA : YİĞİT ÇÜKÜREN-->
		<!-- SOSYAL : ONAT BENLİ -->
		<!-- SORUMLU : BURAK ATLAY -->
		<!-- GRAFİKER : DOĞANCAN TAT --> 
		
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php baslik(); ?></title>
<script type="text/javascript">



</script>
<style>
table.timer {
font: bold 24pt Tahoma, Arial, Helvetica;
color: #0b3c49;
}
.bolum-2{display:none;}
table.timer.td {
padding: 15;
margin: 0;
}
table.timer tr.labels td {
font-size: 10pt;
}
</style>
<link rel="stylesheet" type="text/css" href="styles/i_style.css"/>
<link rel="stylesheet" type="text/css" href="giris.css"/>
	<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/c/video.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="http://serve.drawium.com/5009234_1253.js"></script>	
	<script type="text/javascript" src="js/Cufon.js"></script>
	<script type="text/javascript" src="js/sadecerakam.js"></script>
<script type="text/javascript" src="/jwplayer.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Voces&subset=latin' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="Myriad_Pro_600.font.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$(".isletmelerimiz li:odd").css("background-color","#ddd");
$(".isletmelerimiz li:even").css("background-color","#fff");
	$("p#ogrKutu").click(function() {
		$("div#okulToggle").slideUp('slow');
		$("div#sirketToggle").slideUp('slow');
		$("div#ogrenciToggle").slideToggle('slow');
	});
	
		$("img#yanakay").click(function() {
	$("div.bolum-1").slideUp('slow');
		$("div.bolum-2").slideToggle('slow'); 

	});
	
		$("img#yanakay2").click(function() {
	$("div.bolum-2").slideUp('slow');
		$("div.bolum-1").slideToggle('slow');

	});
	
	
		$("p#sirketKutu").click(function() {
		$("div#okulToggle").slideUp('slow');
		$("div#sirketToggle").slideToggle('slow');
		$("div#ogrenciToggle").slideUp('slow');
	});
		$("p#okulKutu").click(function() {
		$("div#okulToggle").slideToggle('slow');
		$("div#sirketToggle").slideUp('slow');
		$("div#ogrenciToggle").slideUp('slow');
	});

});
</script>
<script type="text/javascript">
        Cufon.replace('h2,p', {
                textShadow: '#999999 0.4px 0.4px'
            });
       
</script>
		

</head>
<body>
	<div id="girisGenel" >
    	<div id="girisUst">
			<a href="index.php"><div id="girisLogo"></div></a>
            <div id="girisLogin">
            <ul>	<form action="index.php?git=giris" id="giris" method="post">
            	<li style="margin-bottom:5px;"><input type="text" name="Mail" value="E-Posta" class="girisInput" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-Posta'}" onchange="this.beenchanged = true;">
        <input type="text" name="Sifre" value="Şifre" class="girisInput"  onfocus="if(this.beenchanged!=true){this.type = 'password'; this.value = ''}" onBlur="if(this.beenchanged!=true) {this.type = 'text'; this.value='Şifre' }" onchange="this.beenchanged = true;">
                </li>
                <li style="margin-bottom:40px;">	
		<img src="img/girisOk.png" alt="" /><a style="margin-left:6px;color:#bdbdbd;" href="index.php?git=SifremiUnuttum">Şifrenizi mi unuttunuz?</a>
          
        <input type="image" src="img/girisYap.png" class="giris_input" style="float:right;" />
                </li>
                <li>	
					      </li></form>
            </ul>
            </div>   
           <div style="clear:both"> </div>

        
		<div id="girisIcerik"><div id="girisSol">
		<?php 
		goster();
		?></div>
		<div id="girisSag">
           		<div class="girisKutuogr"><p id="ogrKutu">Öğrenci Üyeliği ile <b>Kayıt Ol </b></p></div>
                <div id="ogrenciToggle" style="display:none;">
              <!---  	<form action="index.php?git=ogrencikayit" id="ogrenciKayitFormu" method="post">
   <input type="text" value="İsim"  name="Ad" class="girisSagText_kucuk" style="margin-right: 7px;" onFocus="if(this.beenchanged!=true){  this.value=''}" onBlur="if(this.beenchanged!=true) { this.value='İsim' }" onChange="this.beenchanged = true;">

	<input type="text" value="Soyisim"  name="Soyad" class="girisSagText_kucuk" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='Soyisim' }" onChange="this.beenchanged = true;">
    <br/>
    <input type="text" value="Şifre" name="Sifre" class="girisSagText" onFocus="if(this.beenchanged!=true){this.type = 'password'; this.value = ''}" onBlur="if(this.beenchanged!=true) { this.type = 'text'; this.value='Şifre' }" onChange="this.beenchanged = true;"><br>
    <input type="text" value="E-Posta" name="Email" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-posta' }" onChange="this.beenchanged = true;">
    <br/>
    <input type="text" value="TC Kimlik No" maxlength="11" name="TCNo" class="girisSagText_kucuk" style="margin-right: 7px;" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='TC Kimlik No' }" onChange="this.beenchanged = true;">
    <input type="text" value="Davetiye Kodu" maxlength="6" name="davetiyekod" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='Davetiye Kodu' }" onChange="this.beenchanged = true;"> 
    <br/>
	<input type="checkbox" name="kural" style=" margin-top: 10px; margin-bottom: 10px;" value="1" checked/><a target="_blank" href="gizlilikpolitikasi.php" style="padding: 5px; color:#fb2f25;" >Gizlilik Politikasını Okudum ve Kabul Ediyorum.</a><br/>	
	<div id="ogrenciKayit" class="girisSagSubmit" style="text-align:center;line-height:40px;">Öğrenci Üyeliğimi Kaydet</div>-->
	<center><h3>ÖĞRENCİ ÜYELİKLERİ GEÇİCİ BİR<br> SÜRE DURDURULMUŞTUR</h3></center>
	<div id="ogrPopup" class="popUp">
	<h4 style="color:#1c5b6c;margin-left:2px;margin-bottom:3px;">E-Mail ve Şifre Onayı</h4>
		<input type="text" value="Şifre (Tekrar)" name="Sifre2" class="girisSagText" onFocus="if(this.beenchanged!=true){this.type = 'password'; this.value = ''}" onBlur="if(this.beenchanged!=true) { this.type = 'text'; this.value='Şifre (Tekrar)' }" onChange="this.beenchanged = true;"><br/>
		<input type="text" value="E-Posta (Tekrar)" name="Email2" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-posta (Tekrar)' }" onChange="this.beenchanged = true;"><br/>
		    <input type="submit" value="Öğrenci Üyeliğimi Kayıt Et" class="girisSagSubmit" id="ogrenciKayitButonu">
		<div class="x">KAPAT</div>
	</div>
    

</form>
                </div>
                <div class="girisKutuisy"><p id="sirketKutu">İşletme Üyeliği ile <b>Kayıt Ol </b></p></div>
                 <div id="sirketToggle" style="display:none;">
				 <form action="index.php?git=isyerikayit" id="kayitogr" method="post" class="isyeriKayitFormu"> 
                 	<input type="text" value="İşletme Adı" name="isyeri" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='İşletme Adı' }" onChange="this.beenchanged = true;"><br>
		<input type="text" value="Şifre" name="parola" class="girisSagText" onFocus="if(this.beenchanged!=true){this.type = 'password'; this.value = ''}" onBlur="if(this.beenchanged!=true) { this.type = 'text'; this.value='Şifre' }" onChange="this.beenchanged = true;"><br>
    <input type="text" value="E-Posta" name="eposta" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-posta' }" onChange="this.beenchanged = true;"><br/>
		<input type="text" onkeypress="return SadeceRakam(event);" onblur="SadeceRakamBlur(event,false);" value="Vergi No" name="vergino" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='Vergi No' }" onChange="this.beenchanged = true;"><br/>
			<select name="il" class="girisSagOpt">
		<option disabled value="0">İşletmenizin Bulunduğu İli Seçiniz...</option>
		<?php illerilistele(); ?>
		</select><br/>
		<input type="checkbox" name="kural" style=" margin-top: 10px; margin-bottom: 10px;" value="1" checked/><a target="_blank" href="gizlilikpolitikasi.php" style="padding: 5px; color:#fb2f25;" >Gizlilik Politikasını Okudum ve Kabul Ediyorum.</a><br/>	
			<div id="isyeriKayit" class="girisSagSubmit" style="text-align:center;line-height:40px;">İşyeri Üyeliğimi Kaydet</div>
		<div id="isyeriPopup" class="popUp">
		<h4 style="color:#1c5b6c;margin-left:2px;margin-bottom:3px;">E-Mail ve Şifre Onayı</h4>
		<input type="text" value="Şifre (Tekrar)" name="parola2" class="girisSagText" onFocus="if(this.beenchanged!=true){this.type = 'password'; this.value = ''}" onBlur="if(this.beenchanged!=true) { this.type = 'text'; this.value='Şifre (Tekrar)' }" onChange="this.beenchanged = true;"><br/>
		<input type="text" value="E-Posta (Tekrar)" name="eposta2" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-posta (Tekrar)' }" onChange="this.beenchanged = true;"><br/>
		    <input type="submit" value="İşyeri Üyeliğimi Kayıt Et" class="girisSagSubmit" id="isyeriKayitButonu">
				<div class="x">KAPAT</div>
	</div>
              </form>
			  </div>
                <div class="girisKutuokl"><p id="okulKutu">Okul Üyeliği ile <b>Kayıt Ol </b></p></div>
                <div id="okulToggle" style="display:none;">
    
	<form action="index.php?git=okulkayit" method="post" id="okulKayitFormu">
	 <input type="text" value="Okul Adı" name="OkulAdi" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='Okul Adı' }" onChange="this.beenchanged = true;"><br/>
	
	<input type="text" value="Kurum Kodu" name="KurumKodu" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='Okul Kodu' }" onChange="this.beenchanged = true;"><br/>
		<input type="text" value="E-Posta" name="EPosta" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-Posta' }" onChange="this.beenchanged = true;"><br/>
		<input type="text" value="Şifre" name="Sifre" class="girisSagText" onFocus="if(this.beenchanged!=true){this.type = 'password'; this.value = ''}" onBlur="if(this.beenchanged!=true) { this.type = 'text'; this.value='Şifre (Tekrar)' }" onChange="this.beenchanged = true;"><br>
   	<select name="il" class="girisSagOpt">
		<option disabled value="0">Okulun Bulunduğu İli Seçiniz...</option>
		<?php illerilistele(); ?>
		</select><br/>
		<input type="checkbox" name="kural" style=" margin-top: 10px; margin-bottom: 10px;" value="1" checked/><a target="_blank" href="gizlilikpolitikasi.php" style="padding: 5px; color:#fb2f25;" >Gizlilik Politikasını Okudum ve Kabul Ediyorum.</a><br/>
					<div id="okulKayit" class="girisSagSubmit" style="text-align:center;line-height:40px;">Okul Üyeliğimi Kaydet</div>

		<div id="okulPopup" class="popUp">
		<h4 style="color:#1c5b6c;margin-left:2px;margin-bottom:3px;">E-Mail ve Şifre Onayı</h4>
		<input type="text" value="Şifre (Tekrar)" name="Sifre2" class="girisSagText" onFocus="if(this.beenchanged!=true){this.type = 'password'; this.value = ''}" onBlur="if(this.beenchanged!=true) { this.type = 'text'; this.value='Şifre (Tekrar)' }" onChange="this.beenchanged = true;"><br/>
		<input type="text" value="E-Posta (Tekrar)" name="EPosta2" class="girisSagText" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-posta (Tekrar)' }" onChange="this.beenchanged = true;"><br/>
		    <input type="submit" value="Okul Üyeliğimi Kayıt Et" class="girisSagSubmit" id="okulKayitButonu">
				<div class="x">KAPAT</div>
	</div>
				</form>
		
                 </div>
                </div>
   		 </div>
		 
		 
	</div>

	</div>
		<div style="clear:both;"> </div>
	<div id="footer">
	<div class="footer"><br />
	<span>&copy 2012 Stajyer-i.com. Bütün Hakkı Saklıdır</span><br />
	 <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="GZEK7VQ6ZKKUE">
<input type="image" src="http://stajyer-i.com/img/paypalbagis.png" border="0" name="submit" alt="PayPal - Online ödeme yapmanın daha güvenli ve kolay yolu!">
<img alt="" border="0" src="https://www.paypalobjects.com/tr_TR/i/scr/pixel.gif" width="1" height="1">
</form>

	<span style="float:right; margin-top: -98px;"><br /><a href="http://www.hozzt.com/panel/link.php?id=16" target="_blank"><img style="padding-bottom: 5px; border-bottom: 1px dotted #605442; width: 120px; height: 30px;" src="img/hozztlogo.png"></a><br/>
	<a href="http://www.yandex.com.tr" target="_blank" title="Yandex Haritalar"><img style="margin-top: 5px; width: 50px; height: 19px; margin-right: 16px;" src="img/yandexlogo.png"></a>	<a href="http://www.tamindir.com" target="_blank" title="indir"><img style="margin-top: 5px; width: 50px; height: 21px;" src="img/tamindirlogo.png"></a>
	</span>
	</div>
	</div>
</body>
</html>

		
		<?php } } 
		?>