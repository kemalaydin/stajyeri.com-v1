<?php 
if($OgrenciAdi["Cinsiyet"] == "Erkek"){
$Cins = "Oğlum";
}else{
$Cins = "Kızım";
}
?>
<div class="sagbaslik">STAJ DİLEKÇESİ </div>
<div class="sonbascurular" style="padding: 7px;">
<p style="font-size: 16px;"><b>SAYIN  <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $IsyerininAdi; ?></a> ŞİRKETİ MÜDÜRLÜĞÜNE</b> </p><br />
<p>Velisi bulunduğum <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo alanbulret($OgrenciAdi["Bolum"]); ?></a> , <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $OgrenciAdi["Sinif"]. '/'. $OgrenciAdi["Sube"]; ?></a> Sınıfı,
 <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $OgrenciAdi["OkulNo"]; ?></a> 
 numaralı <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Cins; ?></a> <b> <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $OgrenciAdi["Ad"].' '.$OgrenciAdi["Soyad"]; ?></a> </b> 
 'in 100/200 saat tutarındaki staj çalışmasını Temmuz / 
 Ağustos döneminde sigortası okul müdürlüğü tarafından yapılmak üzere işletmenizde staj yapması için gereğini bilgilerinize arz ve rica ederim. </p>
 <br />
 <p style="float:right"><?php echo date("d.m.Y"); ?></p><br/>
 <p style="float:right">Veli Adı Soyadı / İmza</p>  
 
 <div style="clear: both;"></div>
 <br />
 <p style="border-bottom: 1px dashed #000;"></p><br />
 <p style="font-size: 16px;"><a href="#" style="color:#000; border-bottom: 1px dotted #000;"><b><?php echo $OkulBul["OkulAdi"]; ?> </a> MÜDÜRLÜĞÜNE</b></p><br />
 <p>Velisi bulunduğum <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo alanbulret($OgrenciAdi["Bolum"]); ?></a> , <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $OgrenciAdi["Sinif"]. '/'. $OgrenciAdi["Sube"]; ?></a> Sınıfı,
 <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $OgrenciAdi["OkulNo"]; ?></a> 
 numaralı <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Cins; ?></a> <b> <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $OgrenciAdi["Ad"].' '.$OgrenciAdi["Soyad"]; ?></a> </b> 
 'in 100/200 saat tutarındaki staj çalışmasını Temmuz / 
 Ağustos döneminde sigortası okul müdürlüğü tarafından yapılmak üzere <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $IsyerininAdi; ?></a> İşletmesinde yapmasını uygun görüyorum.
 <br />
 Bilgilerinizi ve gereğini arz ederim.<p><br />
 <p style="float:right"><?php echo date("d.m.Y"); ?></p><br/>
 <p style="float:right">Veli Adı Soyadı / İmza</p>
 <div style="clear: both;"></div>
 <br />
 <p style="border-bottom: 1px dashed #000;"></p><br />
 <p style="font-size: 16px;"><a href="#" style="color:#000; border-bottom: 1px dotted #000;"><b><?php echo $OkulBul["OkulAdi"]; ?></a> MÜDÜRLÜĞÜNE</b> </p><br />
 <p> Okulunuzda okuyan ve dilekçesinde kimliği belirtilen öğrenciniz şahsen, velinin yazılı müracaatı ile işletmemizde staj yapma talebinde bulunarak 100/200 saatlik yaz stajını işletmemiz bünyesinde yapmak istemektedir.</br>
 İlgilinin işletmemizde staj yapması uygun görülmüştür.
 <br />
 Bilgilerinizi ve gereğini arz ve rica ederiz.<br/></p>
 <p style="float:right"><?php echo date("d.m.Y"); ?></p><br/>
 <p style="float:right"><?php echo $yetkilisi; ?></p><br/>
 <p style="float:right">Kaşe - İmza</p><br /><br />
 <p style="float:right"><form action="stajdilekceogr.php" method="post"> 
 <input type="hidden" name="SirketAdi" value="<?php echo $IsyerininAdi; ?>" />
 <input type="hidden" name="Bolum" value="<?php echo alanbulret($OgrenciAdi["Bolum"]); ?>" />
 <input type="hidden" name="Sinif" value="<?php echo $OgrenciAdi["Sinif"]. '/'. $OgrenciAdi["Sube"]; ?>" />
 <input type="hidden" name="Numarasi" value="<?php echo $OgrenciAdi["OkulNo"]; ?>" />
 <input type="hidden" name="AdiSoyadi" value="<?php echo $OgrenciAdi["Ad"].' '.$OgrenciAdi["Soyad"]; ?>" />
 <input type="hidden" name="Cinsiyet" value="<?php echo $Cins; ?>" />
 <input type="hidden" name="Tarih" value="<?php echo date("d.m.Y"); ?>" />
 <input type="hidden" name="OkulAdi" value="<?php echo $OkulBul["OkulAdi"]; ?>" />
 <input type="hidden" name="Yetkili" value="<?php echo $yetkilisi; ?>" />
 <input type="submit" value="YAZDIR" class="yazdirmatusu" />
  
 </form></p>
 <div style="clear: both;"></div> 
</div>
<div class="buyukalt"></div>