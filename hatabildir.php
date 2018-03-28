<?php if(!$_SESSION["oturum"]){
Header("Location:index.php"	);
}else{

if($_POST){
$AdiSoyadi = $_POST["adisoyadi"];
$Mail = $_POST["mail"];
$HataSayfasi = $_POST["yonsayfa"];
$Mesaj = $_POST["mesaji"];
$uyeno = $_POST["uyeno"];
$uyelikturu = $_POST["uyelikturu"];
$uyeMail = mysql_fetch_array(mysql_query("select Mail from ogrenci where id='$uyeno' and UyelikTuru='$uyelikturu' "));
$uyeMailAdres = $uyeMail['Mail'];

$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
$mailBilgi .= 'Content-type: text/html;' . "\r\n";
$mailBilgi .= 'From: '.$uyeMailAdres.' <'.$uyeMailAdres.'>' . "\r\n";
$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

$aliciAdres= 'bilgi@stajyer-i.com';
$epostaKonu = 'Hata Bildirim Formu';
$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;"><div style="background:#0099FF;padding:8px;text-align:center;"><img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>'.$uyeno.' üye numaralı <strong>'.$AdiSoyadi.'</strong> isimli üyeden; <br/><br/>'.  $Mesaj.' </div>';
mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
bilgi("İlginiz İçin Teşekkürler","Hata Bildirim Mesajınız Başarıyla İletildi","onay");
header( "Refresh: 2; url=$HataSayfasi" );

 /*$adres = "yigitnerukuc@stajyer-i.com";
$konu = "Hata Bildirim  Formu";
$mesaj = ''.$uyeno.' numaralı '.$AdiSoyadi.' isimli üyeden; <br/> '.  $Mesaj.' ';
mail("$adres","$konu","$mesaj");
echo "İletildi."; */


}else{
?>
<form action="" method="post">
				<div class="sagbaslik">Hata Bildir</div>
		<div class="hatabildir">
	
	
				<input type="hidden" name="adisoyadi" value="<?php echo $_SESSION["Ad"].' '.$_SESSION["Soyad"]; ?>">
				<input type="hidden" name="mail" value="<?php echo $_SESSION["Mail"]; ?>"> 
				<input type="hidden" name="uyeno" value="<?php echo $_SESSION["uid"]; ?>">
				<input type="hidden" name="uyelikturu" value="<?php echo $_SESSION["UyelikTuru"]; ?>">
				<input type="hidden" readonly="readonly" name="yonsayfa" value="<?php echo $GonderdigiYer; ?>"> 
				<li> <span><b>Mesajınız : </b></span><textarea rows="0" cols="0" name="mesaji" class="profiltxthata">Merhaba ;
Sitenizin <?php echo $GonderdigiYer; ?> Adresinde Bir Hatayla Karşılaştım, Bilginize</textarea></li>
<span style="float: right; margin-top: -25px;"><input type="submit" value="Bildirim Gönder" class="duzenlebut"></span>

		</div>
			<div class="buyukalt"></div>
</form>
<?php
}} ?>
