<?php
if($_SESSION["oturum"]){
$Ogridsisi = $_SESSION["uid"];
$OgrenciSorgusu = mysql_query("select * from ogrenci where id = '$Ogridsisi'");
$OgrenciSay = mysql_num_rows($OgrenciSorgusu);
if($OgrenciSay > 0){
$OgrenciCikar = mysql_fetch_array($OgrenciSorgusu);
$IsBilgileri = mysql_query("select * from isgiris where OgrenciID = '$Ogridsisi'");
$IsVarmi = mysql_num_rows($IsBilgileri);
if($IsVarmi > 0){
$IsCikar = mysql_fetch_array($IsBilgileri);
$IsyeriID = $IsCikar["IsyeriID"];
$OkulID = $IsCikar["OkulID"];
$OkulCikar = mysql_fetch_array(mysql_query("select * from okul where id = '$OkulID'"));
$IsyeriCikar = mysql_fetch_array(mysql_query("select * from isyeri where id = '$IsyeriID'"));
?>
<div class="sagbaslik">STAJ DOSYASI ( 1. SAYFA - STAJ DOSYASI )</div>
<div class="stajdosyasi">
<h1>STAJ DOSYASI</h1>
<h2>OKULUN</h2>
<div class="dosyaicbir">
<ul style="height: 160px;">
<li><span class="dosyaicbirspan">ADI </span> <span class="beyazdosyali"><?php echo $OkulCikar["OkulAdi"]; ?></span></li>
<li><span class="dosyaicbirspan">ADRESİ </span> <span class="beyazdosyali"><?php echo $OkulCikar["Adres"]; ?></span></li>
<li><span class="dosyaicbirspan">E-POSTA </span> <span class="beyazdosyali" style="width: 173px; margin-right: 4px;"><?php echo $OkulCikar["Mail"]; ?></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OkulCikar["Telefon"]; ?></span></li>
<li><span class="dosyaicbirspan">FAKS </span> <span class="beyazdosyali" style="width: 173px; margin-right: 4px;"><?php echo $OkulCikar["Fax"]; ?></span></li>
<li><span class="dosyaicbirspan">WEB SİTESİ </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 28px; overflow: auto;"><?php echo $OkulCikar["WebSayfasi"]; ?></span></li>
</ul>
<div style="clear:both;"></div>
</div>
<h2>ÖĞRENCİNİN</h2>
<div class="dosyaicbir">
<ul style="height: 155px;">
<li><span class="dosyaicbirspan">ADI VE SOYADI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"]; ?></span></li>
<li style="height: 50px;"><span class="dosyaicbirspan">SINIFI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OgrenciCikar["Sinif"].'/'.$OgrenciCikar["Sube"].' - '.lisetururet($OgrenciCikar["LiseTuru"]); ?></span></li>
<li><span class="dosyaicbirspan">NUMARASI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $OgrenciCikar["OkulNo"]; ?></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 19px;"><?php echo $OgrenciCikar["Telefon"]; ?></span></li>
<li style="height: 50px;"><span class="dosyaicbirspan">MESLEK DALI </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo alanbulret($OgrenciCikar["Bolum"]); ?></span></li>
<li><span class="dosyaicbirspan">T.C. KİMLİK NO </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"> <?php echo tccoz($OgrenciCikar["TCNo"]); ?></span></li>
<li><span class="dosyaicbirspan">SGK NO </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 19px;"><?php echo $OgrenciCikar["SSKNo"]; ?></span></li>
</ul>
<div style="clear:both;"></div>
</div>
<h3>Stajdan sorumlu yönetici veya öğretmenin</h3>
<div class="dosyaicbir">
<ul style="height: 70px;">
<li><span class="dosyaicbirspan">ADI VE SOYADI </span> <span class="beyazdosyali" style="height: 19px;"></span></li><br/>
<li><span class="dosyaicbirspan">ÜNVANI </span> <span class="beyazdosyali" style="width: 171px; margin-right: 5px;height: 19px;"></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 171px; margin-right: 5px;height: 19px;"></span></li>
</div>
<h2>İŞLETMENİN</h2>
<div class="dosyaicbir">
<ul style="height: 165px;">
<li><span class="dosyaicbirspan">ADI</span> <span class="beyazdosyali"><?php echo $IsyeriCikar["IsyeriAdi"];?></span></li>
<li><span class="dosyaicbirspan">ADRESİ </span> <span class="beyazdosyali"><?php echo $IsyeriCikar["Adres"]; ?></span></li>
<li><span class="dosyaicbirspan">E-POSTA </span> <span class="beyazdosyali"><?php echo $IsyeriCikar["Mail"]; ?></span></li>
<li><span class="dosyaicbirspan">TELEFON </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px; height: 19px;"><?php echo $IsyeriCikar["Telefon"]; ?></span></li>
<li><span class="dosyaicbirspan">FAKS </span> <span class="beyazdosyali" style="width: 170px; margin-right: 5px;"><?php echo $IsyeriCikar["Fax"]; ?></span></li>
<li><span class="dosyaicbirspan">EĞİTİM YETKİLİSİ</span> <span class="beyazdosyali"> <?php echo $IsyeriCikar["UstaOgretici1"]; ?></span></li>
</ul>
<div style="clear:both;"></div>
</div>
<h3>AÇIKLAMALAR</h3>
<li>1-) Öğrenci staja başladığında staj dosyasındaki staja başlama yazısı doldurularak okula gönderilir.</li>
<li>2-) İşletme tarafından öğrenciye staj dosyası tutturulur. Staj dosyasındaki boş sayfalara öğrencinin staj yetkilisi tarafından imzalanır.</li>
<li>3-) Staj sonunda, staj dosyasındaki iki suret staj sonu değerlendirme raporu staj eğitim yetkilisi  tarafından doldurulduktan sonra staj dosyası ile birlikte kapalı zarf içinde okula gönderilir.</li>
<br/><br/>
<form action="StajDosyasiSyf1.php" method="post">
<!--- İŞYERİ BİLGİLERİ GÖNDERME -->
<input type="hidden" name="IsyeriAdi" value="<?php echo $IsyeriCikar["IsyeriAdi"];?>" /> 
<input type="hidden" name="IsyeriAdresi" value="<?php echo $IsyeriCikar["Adres"]; ?>" /> 
<input type="hidden" name="IsyeriEposta" value="<?php echo $IsyeriCikar["Mail"]; ?>" /> 
<input type="hidden" name="IsyeriTelefon" value="<?php echo $IsyeriCikar["Telefon"]; ?>" /> 
<input type="hidden" name="IsyeriFax" value="<?php echo $IsyeriCikar["Fax"]; ?>" /> 
<input type="hidden" name="EgitimYetkilisi" value="<?php echo $IsyeriCikar["UstaOgretici1"]; ?>" /> 
<!--- OKUL BİLGİLERİ GÖNDERME -->
<input type="hidden" name="OkulAdi" value="<?php echo $OkulCikar["OkulAdi"]; ?>" /> 
<input type="hidden" name="OkulAdresi" value="<?php echo $OkulCikar["Adres"]; ?>" /> 
<input type="hidden" name="OkulEposta" value="<?php echo $OkulCikar["Mail"]; ?>" /> 
<input type="hidden" name="OkulTelefon" value="<?php echo $OkulCikar["Telefon"]; ?>" /> 
<input type="hidden" name="OkulFax" value="<?php echo $OkulCikar["Fax"]; ?>" /> 
<input type="hidden" name="OkulWebsitesi" value="<?php echo $OkulCikar["WebSayfasi"]; ?>" /> 
<!--- ÖĞRENCİ BİLGİLERİ GÖNDERME -->
<input type="hidden" name="OgrenciAdi" value="<?php echo $OgrenciCikar["Ad"].' '.$OgrenciCikar["Soyad"]; ?>" /> 
<input type="hidden" name="OgrenciSinifi" value="<?php echo $OgrenciCikar["Sinif"].'/'.$OgrenciCikar["Sube"].' - '.lisetururet($OgrenciCikar["LiseTuru"]); ?>" /> 
<input type="hidden" name="OgrenciNumarasi" value="<?php echo $OgrenciCikar["OkulNo"]; ?>" /> 
<input type="hidden" name="OgrenciTelefon" value="<?php echo $OgrenciCikar["Telefon"]; ?>" /> 
<input type="hidden" name="MeslekDali" value="<?php echo alanbulret($OgrenciCikar["Bolum"]); ?>" /> 
<input type="hidden" name="TCNo" value="<?php echo tccoz($OgrenciCikar["TCNo"]); ?>" /> 
<input type="hidden" name="SGKNo" value="<?php echo $OgrenciCikar["SSKNo"]; ?>" /> 

<input type="submit" value="YAZDIR" class="yazdirmatusu" />
</form>

<div style="clear: both;"></div>
</div>
<div class="buyukalt"></div>

<?php
}else{bilgi("İş Girişi Yok!","İş Girişi Bulunamadı","bilgi");}

}else{
bilgi("Bir Hata Meydana Geldi","Sistemde Öğrenci Bulunamadı","bilgi");
}

}else{

}

?>