<?php if($_SESSION["oturum"]){ ?>
<div id="iletisimpaneli">
<?php if($_POST){
$Adi = $_POST["adsoyad"];
$Mail = $_POST["mail"];
$UyelikTuru = $_POST["uyelikturu"];
$Mesaji = $_POST["mesaj"];
if($UyelikTuru == 1){
$UyeTur = "Öğrenci";
}else if($UyelikTuru == 2){
$UyeTur = "İşyeri";
}else if($UyelikTuru == 0){
$UyeTur = "Okul";
}else{
$UyeTur = "VERİ ALINAMADI !";
}

if(empty($Mesaji)){
bilgi("Boş Mesaj Gönderemezsiniz.","Lütfen Boş Alan Bırakmadan Tekrar Deneyin","bilgi");
}else{
$mailBilgi= 'MIME-Version: 1.0' . "\r\n";
$mailBilgi .= 'Content-type: text/html;' . "\r\n";
$mailBilgi .= 'From: '.$Mail.' <'.$Mail.'>' . "\r\n";
$mailBilgi .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

$aliciAdres= 'bilgi@stajyer-i.com';
$epostaKonu = 'İletişim Formu';
$epostaMesaj = '<div style="border:1px solid #ddd;padding:10px;">
<div style="background:#0099FF;padding:8px;text-align:center;">
<img src="http://www.stajyer-i.com/local/images/minilogo.png" alt="" /></div><br/></br/>'.$UyeTur.' Üyeliği bulunan <strong>'.$Adi.'</strong> isimli üyeden; <br/><br/>'.  $Mesaji.' </div>';
mail($aliciAdres, $epostaKonu, $epostaMesaj, $mailBilgi);
bilgi("Mesajınız Gönderildi","Mesajınız Tarafımıza Ulaştı. En Kısa Sürede Sizinle İletişime Geçeceğiz.","onay");
}


}else{ ?>
<div class="iletisimsol">
<form action="" method="post">
<input type="hidden" name="adsoyad" value="<?php echo $_SESSION["Ad"].' '.$_SESSION["Soyad"]; ?>" />
<input type="text" disabled="disabled" class="iletisimimp" value="<?php echo $_SESSION["Ad"].' '.$_SESSION["Soyad"]; ?>" /><br>
<input type="hidden" name="mail" value="<?php echo $_SESSION["Mail"]; ?>" />
<input type="text" disabled="disabled"  class="iletisimimp" value="<?php echo $_SESSION["Mail"]; ?>" />
<input type="hidden" name="uyelikturu" value="<?php echo $_SESSION["UyelikTuru"]; ?>" /><br>
<textarea cols="1" rows="1" name="mesaj" class="iletisimtxt"></textarea> <br /><br /> 
<input type="submit" style="float:right;" value="" class="mesajgonderbut" />
<div style="clear: both;"></div>
</form></div>
<div class="iletisimsag">
<h2>Stajyer-i.com Yönetim Ekibi</h2>
bilgi@stajyer-i.com mail adresinden veya 
0 555 742 0340 ~ 0 506 662 62 56 numaralı telefondan ulaşabilirsiniz.

</div>
<?php } ?>
</div>



<?php

}else{
Header("Location:index.php");
}

?>