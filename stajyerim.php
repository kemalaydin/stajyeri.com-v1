<?php
// İşyeri İli
$IlBul = mysql_query("select * from iller where id='$il'");
$ili = mysql_fetch_array($IlBul);
$Il = $ili["il"];

// İşyeri İlçesi
$IlceBul = mysql_query("select * from ilceler where id='$ilce'");
$ilcesi = mysql_fetch_array($IlceBul);
$Ilce = $ilcesi["ilce"];

//Okul Bilgileri
$OkulIDsi = $_SESSION["OkulID"];
$OkulBul = mysql_query("select * from okul where id='$OkulIDsi'"); 
$OkulVeriCikar = mysql_fetch_array($OkulBul);

$OkulAdi = $OkulVeriCikar["OkulAdi"];
$OkulAdres = $OkulVeriCikar["Adres"];
$OkulIli = $OkulVeriCikar["il"];
$OkulIlcesi = $OkulVeriCikar["ilce"];
$OkulTelefon = $OkulVeriCikar["Telefon"];
$OkulKurumKodu = $OkulVeriCikar["KurumKodu"];

// Öğrenci Bilgileri
$OgrenciIl = $_SESSION["il"];
$OgrenciIlce = $_SESSION["ilce"];

$LiseTuruu = $_SESSION["LiseTuru"];
$LiseTuruBul = mysql_query("select * from liseturu where id='$LiseTuruu'");
$LiseCikar = mysql_fetch_array($LiseTuruBul);
$LiseTuru = $LiseCikar["LiseTuru"];
?>
<div class="sagbaslik">STAJYERİM</div>
<div class="stajyerim">
<div style="padding: 2px;"></div>
<div style="margin: 8px; padding: 5px; border-radius: 5px; background-color: #E4ECF4;">
<span><h4> İŞYERİ ; </h4></span><br />
<li><span><b> Adı : </b></span> <?php echo $IsyeriAdi; ?></li>
<li><span><b> Adresi : </b></span><?php echo $Adres.' / '.$Ilce.' / '.$Il; ?></li>
<li><span><b> Telefon : </b></span> <?php echo $Telefon; ?></li>
</div>


<div style="margin: 8px; padding: 5px; border-radius: 5px; background-color: #E4ECF4;">
<span><h4> OKUL ; </h4></span><br />
<li><span><b> Adı : </b></span><?php echo $OkulAdi; ?></li>
<li><span><b> Adresi : </b></span><?php echo $OkulAdres.' / '; ilcebul($OkulIlcesi); echo ' / '; ilbul($OkulIli);?></li>
<li><span><b> Telefon : </b></span><?php echo $OkulTelefon; ?></li>
<li><span><b> Kurum Kodu : </b> </span><?php echo $OkulKurumKodu; ?></li>
</div>

<div style="margin-top: 8px; margin-left: 8px; margin-right: 8px; padding: 5px;  border-radius: 5px; background-color: #E4ECF4;">
<span><h4> ÖĞRENCİ ; </h4></span><br />
<li><span><b>Adı Soyadı : </b> </span><?php echo $_SESSION["Ad"].' '.$_SESSION["Soyad"]; ?></li>
<li><span><b> Adresi : </b></span><?php echo $_SESSION["Adres"].' / '; ilcebul($OgrenciIlce); echo ' / '; ilbul($OgrenciIl);?></li>
<li><span><b>Telefon : </b></span> <?php echo $_SESSION["Telefon"]; ?></li>
<li><span><b> Mail : </b> </span><?php echo $_SESSION["Mail"]; ?></li>
<li><span><b> T.C. NO : </b></span> <?php echo tccoz($_SESSION["TCNo"]); ?></li>
<li><span><b>Lise Türü : </b></span> <?php echo $LiseTuru; ?></li>
</div>
<a href="" style="float:right; padding: 10px;">[ YAZDIR ]</a>
<div style="clear:both"></div>
</div>
<div class="buyukalt"></div>