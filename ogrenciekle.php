<?php
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 0){
	
	function generatePassword($length=6,$level=2){
	
   list($usec, $sec) = explode(' ', microtime());
   srand((float) $sec + ((float) $usec * 100000));


   $validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";


   $password  = "";
   $counter   = 0;

   while ($counter < $length) {
     $actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);

     // All character must be different
     if (!strstr($password, $actChar)) {
        $password .= $actChar;
			$counter++;
		 }
	   }

	   return $password;
	
	}
	

	$Sifrele = generatePassword();
	$sifrealdinmi = 0;
	

	if($_POST){
	$OkulCek = $_SESSION["uid"];
	$adi = turkceKarakter($_POST["adi"]);
	$soyadi = turkceKarakter($_POST["soyadi"]);
	$tcno = $_POST["tcno"];
	$tcsifrele = tcsifrele($tcno);
	$DogumTarihi = $_POST["dtarih"];
	$Sifreleme = md5(sha1($_POST["sifresi"]));
	$IPAdres = IPAdres();
	$Tarih = date("d.m.Y H:i");
	$sonid = mysql_fetch_array(mysql_query("select * from ogrenci order by id desc limit 1"));
	$sonids=$sonid["id"];
	///////////////////////////
	$EklenecekID = $sonids + 1;
	$SefLinkVeri = $adi.' '.$soyadi.' '.$EklenecekID;
	$ogrsef = sef_link($SefLinkVeri);
	$ogrkontrol = mysql_query("select * from ogrenci where TCNo = '$tcsifrele'");
	$ogrvarmi = mysql_num_rows($ogrkontrol);
	if($ogrvarmi > 0){
	bilgi("Bu öğrenci sisteme daha önce kayıt olmuş.","Eklemeye çalıştığınız öğrenci daha önce sisteme kayıt olmuştur.");
	}else{
	$YeniOgrenciEkle = mysql_query("insert into ogrenci (Ad,Soyad,OgrenciSef,DogumTarihi,Sifre,Mail,TCNo,OkulID,KayitTarihi,IPAdres,Onay,OkulOnay) values ('$adi','$soyadi','$ogrsef','$DogumTarihi','$Sifreleme','$tcno','$tcsifrele','$OkulCek','$Tarih','$IPAdres','1','1')");
	
	if($YeniOgrenciEkle){
	echo'
	<div class="sagbaslik">ÖĞRENCİ EKLE</div>
	<div class="profilduzenle"><div style="padding: 10px;">
	<h3> Öğrenci Başarıyla Kayıt Edildi </h3>
	<p>Aşağıdaki bilgileri öğrenciye ileterek sisteme girmesini sağlayabilirsiniz. </p>
	<div style="padding: 5px; border: 1px solid #ccc; width: 250px;">
	<p><b>E-Mail : </b> '.$tcno.'</p>
	<p><b>Şifre : </b> '.$_POST["sifresi"].'</p>
	 
	<p><b>Adı - Soyadı : </b> '.$adi.' '.$soyadi.'</p>
	
	</div>
	
	<div style="clear: both;"></div>		
	</div></div>
	
	<div class="buyukalt"></div>';
	}else{
	bilgi("Bir Sorun Meydana Geldi","Öğrenci eklenirken bir sorun meydana geldi. Lütfen tekrar deneyin.");
	}
	}
	}else{
	?>
	<div class="sagbaslik">ÖĞRENCİ EKLE</div>
		<div class="profilduzenle"><div style="padding: 10px;">
		
				<form action="" method="post">
				<ul>
				<li><span>Öğrencinin Adı : </span><input type="text" name="adi" class="profilinp" /></li>
				<li><span>Öğrencinin Soyadı : </span><input type="text" name="soyadi" class="profilinp" /></li>
				<li><span>Öğrencinin T.C. Kimlik No : </span><input type="text" name="tcno" class="profilinp" /></li>
				<li style="height: 35px;"><span>Öğrencinin Doğum Tarihi (GG.AA.YYYY) : </span><input type="text" name="dtarih" class="profilinp" /></li>
				<input type="hidden" name="sifresi" value="<?php echo $Sifrele; ?>" />
				<li style="height: 35px;"><span><b>Oluşturulan Şifre : </b></span><?php echo $Sifrele; ?></li>
				<p>* Oluşturulan Şifre, öğrencinin girişte kullanacağı şifredir. Lütfen öğrenciye bu şifreyi ulaştırın</p>
				<p><input type="submit" value="Öğrenci Ekle" style="float:right; margin-top: 7px;" class="duzenlebut"></p>  
				</ul> 
				</form>
			
	<div style="clear: both;"></div>		
	</div></div>
	
	<div class="buyukalt"></div>
	<?php
	}}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

?>