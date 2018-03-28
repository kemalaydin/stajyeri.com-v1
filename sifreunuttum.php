<?php if(!$_SESSION["oturum"]){ ?> <h2 style="margin-bottom:10px;margin-top:7px;color:#1c5b6c;font-size:24px;">Şifremi Unuttum ( Yeni Şifre Talebi ) </h2>
<?php if($_POST){
$uzunluk = 6;
function sifreuret($length=6,$level=2){

   list($usec, $sec) = explode(' ', microtime());
   srand((float) $sec + ((float) $usec * 100000));

   $validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
   $validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
   $validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";

   $password  = "";
   $counter   = 0;

   while ($counter < $length) {
     $actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);

     
     if (!strstr($password, $actChar)) {
        $password .= $actChar;
        $counter++;
     }
   }

   return $password;
}


$MailAdresiAl = $_POST["mail"];
$UyelikTuru = $_POST["uyelikturu"];
$SifreOlustur = sifreuret();
$SifreMD = md5(sha1($SifreOlustur));
$MailMD = md5(sha1($MailAdresiAl));
$Tarih = date("d.m.Y H:i");
$IPAdres = IPAdres();
$Link = 'http://stajyer-i.com/index.php?git=SifreDegistirOnay&pass='.$SifreMD.'&mail='.$MailMD; // local yazısını yayına alırken SİL !
if($UyelikTuru == 0){
$Okuls = mysql_query("select * from okul where Mail = '$MailAdresiAl'");
$OkulSorgu = mysql_num_rows($Okuls);

	if($OkulSorgu > 0){

	$Okul = mysql_fetch_array($Okuls);
	$UyeID = $Okul["id"];
	$DahaOnceAcik = mysql_query("select * from sifretalep where UyeID = '$UyeID' && TalepOnay = '0' && UyelikTuru = '0'");
	$DahaOnceVarmi = mysql_num_rows($DahaOnceAcik);
	
	if($DahaOnceVarmi > 0){
	bilgi("Bir Sorun Meydana Geldi!!","Daha Önce Böyle Bir Talepte Zaten Bulundunuz!");
	}else{
	
	$TalepEkle = mysql_query("insert into sifretalep(UyeID,UyelikTuru,SifreTalep,TalepOnay,IPAdres,Tarih,Mail) values ('$UyeID','0','$SifreMD','0','$IPAdres','$Tarih','$MailMD')");
	$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
	$mailBilgi .= 'Content-type: text/html;' . "\r\n";
	$mailBilgi .= 'From: bilgi@stajyer-i.com <bilgi@stajyer-i.com>' . "\r\n";
	$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

	$aliciAdres= $MailAdresiAl;
	$epostaKonu = 'Stajyer-i.com | Yeni Sifre Talebi';
	$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;"><div style="background:#0099FF;padding:8px;text-align:center;">
	<img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>Merhaba <strong>'.$Okul["Ad"].' '.$Okul["Soyad"].'</strong> ; <br/>
	<br/>Yeni Sifre talebinizi aldık. Eğer bu talebi siz yapmadıysanız lütfen kısa sürede bizimle iletişime geçiniz. Sifrenizi değiştirmek için aşağıdaki linke Tıklayınız <br /><br/><strong> ONAYLAMANIZ DURUMUNDA YENİ SifreNİZ : </strong>'.$SifreOlustur.'<br /><br/><br/><br/><a href="'.$Link.'">'.
	$Link.'</a><br />
	</div>';
	mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
	bilgi("Yeni Sifre Gönderildi","Yeni Sifre Talebinizi Mail Adresinize Gönderdik","onay");
	header( "Refresh: 2; url=index.php" );
	}
	}else{
	bilgi("Böyle Bir Mail Kayıtlı Değil","Sistemimizde Okul Üyeliğini Bu Mail ile Açmış Hiç Bir Okul Bulamadık","bilgi");
	}

}else if($UyelikTuru == 1){
$Ogrencis = mysql_query("select * from ogrenci where Mail = '$MailAdresiAl'");
$OgrenciSorgu = mysql_num_rows($Ogrencis);

	if($OgrenciSorgu > 0){
	$Ogrenci = mysql_fetch_array($Ogrencis);
	$UyeID = $Ogrenci["id"];
	$DahaOnceAcik = mysql_query("select * from sifretalep where UyeID = '$UyeID' && TalepOnay = '0' && UyelikTuru = '1'");
	$DahaOnceVarmi = mysql_num_rows($DahaOnceAcik);
	
	if($DahaOnceVarmi > 0){
	bilgi("Bir Sorun Meydana Geldi!!","Daha Önce Böyle Bir Talepte Zaten Bulundunuz!");
	}else{
	$TalepEkle = mysql_query("insert into sifretalep(UyeID,UyelikTuru,SifreTalep,TalepOnay,IPAdres,Tarih,Mail) values ('$UyeID','1','$SifreMD','0','$IPAdres','$Tarih','$MailMD')");
	$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
	$mailBilgi .= 'Content-type: text/html;' . "\r\n";
	$mailBilgi .= 'From: bilgi@stajyer-i.com <bilgi@stajyer-i.com>' . "\r\n";
	$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

	$aliciAdres= $MailAdresiAl;
	$epostaKonu = 'Stajyer-i.com | Yeni Sifre Talebi';
	$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;"><div style="background:#0099FF;padding:8px;text-align:center;">
	<img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>Merhaba <strong>'.$Ogrenci["Ad"].' '.$Ogrenci["Soyad"].'</strong> ; <br/>
	<br/>Yeni Sifre talebinizi aldık. Eğer bu talebi siz yapmadıysanız lütfen kısa sürede bizimle iletişime geçiniz. Sifrenizi değiştirmek için aşağıdaki linke Tıklayınız. <b> Sistemden Bu Talebe Onay Verene Kadar Şifre Talep Edemiyeceksiniz. Lütfen Bilginiz Dışı Bir Bildirim İse Tarafımıza Bildiriniz</b> <br /><br/><strong> ONAYLAMANIZ DURUMUNDA YENİ ŞİFRENİZ : </strong>'.$SifreOlustur.'<br /><br/><br/><br/><a href="'.$Link.'">'.
	$Link.'</a><br />
	</div>'; 
	mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
	bilgi("Yeni Sifre Gönderildi","Yeni Sifre Talebinizi Mail Adresinize Gönderdik","onay");
	header( "Refresh: 2; url=index.php" );
	}
	}else{
	bilgi("Böyle Bir Mail Kayıtlı Değil","Sistemimizde Öğrenci Üyeliğini Bu Mail ile Açmış Hiç Bir Öğrenci Bulamadık","bilgi");
	} 
}else if($UyelikTuru == 2){
$Isyeris = mysql_query("select * from isyeri where Mail = '$MailAdresiAl'");
$IsyeriSorgu = mysql_num_rows($Isyeris);
 
	if($IsyeriSorgu > 0){
	$Isyeri = mysql_fetch_array($Isyeris);
	$UyeID = $Isyeri["id"];
	$DahaOnceAcik = mysql_query("select * from sifretalep where UyeID = '$UyeID' && TalepOnay = '0' && UyelikTuru = '2'");
	$DahaOnceVarmi = mysql_num_rows($DahaOnceAcik);
	
	if($DahaOnceVarmi > 0){
	bilgi("Bir Sorun Meydana Geldi!!","Daha Önce Böyle Bir Talepte Zaten Bulundunuz!");
	}else{
	$TalepEkle = mysql_query("insert into sifretalep(UyeID,UyelikTuru,SifreTalep,TalepOnay,IPAdres,Tarih,Mail) values ('$UyeID','2','$SifreMD','0','$IPAdres','$Tarih','$MailMD')");
	$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
	$mailBilgi .= 'Content-type: text/html;' . "\r\n";
	$mailBilgi .= 'From: bilgi@stajyer-i.com <bilgi@stajyer-i.com>' . "\r\n";
	$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

	$aliciAdres= $MailAdresiAl;
	$epostaKonu = 'Stajyer-i.com | Yeni Sifre Talebi';
	$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;"><div style="background:#0099FF;padding:8px;text-align:center;">
	<img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>Merhaba <strong>'.$Isyeri["Ad"].' '.$Isyeri["Soyad"].'</strong> ; <br/>
	<br/>Yeni Sifre talebinizi aldık. Eğer bu talebi siz yapmadıysanız lütfen kısa sürede bizimle iletişime geçiniz. Sifrenizi değiştirmek için aşağıdaki linke Tıklayınız <br /><br/><strong> ONAYLAMANIZ DURUMUNDA YENİ SifreNİZ : </strong>'.$SifreOlustur.'<br /><br/><br/><br/><a href="'.$Link.'">'.
	$Link.'</a><br />
	
	</div>';
	mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
	bilgi("Yeni Sifre Gönderildi","Yeni Sifre Talebinizi Mail Adresinize Gönderdik","onay");
	header( "Refresh: 2; url=index.php" );
	}
	}else{
	bilgi("Böyle Bir Mail Kayıtlı Değil","Sistemimizde İşyeri Üyeliğini Bu Mail ile Açmış Hiç Bir İşyeri Bulamadık","bilgi");
	}
}



}else{ ?>
<div style="margin-top:50px;"></div>
<form action="" method="post">
<center>
<span style="font-size: 14px;"><input type="text" name="mail" class="girisSagText" value="E-Posta Adresiniz" onFocus="if(this.beenchanged!=true){ this.value = ''}" onBlur="if(this.beenchanged!=true) { this.value='E-Posta Adresiniz' }" onChange="this.beenchanged = true;"/></span><br /><br />
<input type="radio" name="uyelikturu" value="1" checked="checked"/> <span>Öğrenci</span>
		<input type="radio" name="uyelikturu"  value="2" /> <span>İş Yeri</span>
		<input type="radio" name="uyelikturu"  value="0" /> <span>Okul</span><br /><br />
<span ><input type="submit" value="Yeni Sifre Gönder" class="girisSagSubmit" /></span>
<br /><br />
<a href="index.php"><h2 style="color:#1c5b6c;">Ana Sayfa</h2></a></center>
</form>

<?php }}else{
Header("Location:index.php");
} ?>