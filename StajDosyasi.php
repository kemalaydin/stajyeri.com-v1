<?php
if($_SESSION["oturum"]){
	$ogrid = $_SESSION["uid"];
	$OgrenciGirisi = mysql_query("select * from ogrenci where id = '$ogrid' && StajBaslama = '1'");
	$ogrsay = mysql_num_rows($OgrenciGirisi);
	if($ogrsay > 0){
	?>
	<div class="sagbaslik">Staj Dosyası</div>
	<div class="sonbascurular">
	<ul style="padding:10px;">
	<li><a href="index.php?git=StajDosyasi&sayfa=1">1. Sayfa ( STAJ DOSYASI )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=2">2. Sayfa ( STAJ ÇALIŞMALARI İLE İLGİLİ AÇIKLAMALAR )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=3">3. Sayfa ( MÜDÜR YAZISI )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=4">4. Sayfa ( STAJ TEKLİF YAZISI & VELİ İZİN BELGESİ )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=5">5. Sayfa ( STAJ ÇALIŞMASI UYGUNLUK YAZISI & STAJ BAŞLAMA YAZISI )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=6">6. Sayfa ( STAJ ÇALIŞMASI UYGUNLUK YAZISI - 2 & STAJ BAŞLAMA YAZISI - 2 )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=7">7. Sayfa ( STAJ ÇALIŞMASI DEĞERLENDİRME BELGESİ )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=8">8. Sayfa ( OKUL DIŞI STAJ ÇALIŞMASI KONTROL ÇİZELGESİ )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=9">9. Sayfa ( ÖĞRENCİ ÇALIŞMA GÜNLÜĞÜ )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=10">10. Sayfa ( ÖĞRENCİ ÇALIŞMA GÜNLÜĞÜ )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=11">11. Sayfa ( ÖĞRENCİ ÇALIŞMA GÜNLÜĞÜ )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=12">12. Sayfa ( ÖĞRENCİ ÇALIŞMA GÜNLÜĞÜ )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=13">13 ~ 33. Sayfa ( STAJDA YAPILAN ÇALIŞMALAR )</a></li>
	<li><a href="index.php?git=StajDosyasi&sayfa=34">34. Sayfa ( STAJ YERİ KROKİSİ )</a></li>
	</ul>
	<span>* Yukarıdaki alanlardan istediklerinizi yazdırabilirsiniz. </span>
	<div style="clear:both;"></div>
	</div>
	<div class="buyukalt"></div>
	<?php
	}else{
	bilgi("Bir Sorun Meydana Geldi !","Staj Dosyası Oluşturabilmek İçin Stajyer Olarak Bir Firmada Gözükmeniz Gerekmektedir","bilgi");
	}
}else{
Header("Location:../index.php");
}

?>