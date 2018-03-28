<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Stajyer-i.com | Staj Dilekçesi</title>
	<style>
	body {margin: 0 auto; font:14px/19px Tahoma;}
	a {text-decoration:none;color:#000;}
	img {border:none;}
	:focus {outline:none;}
	h1,h2,h3,h4,h5,h6,p,ul,li,form,input,textarea,p {padding:0;margin:0;border:none;list-style-type:none; }
	ul {list-style-type:none;}
	
	</style>
	
    	<script type="text/javascript" src="js/stajyeri.js"></script>
		
        	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js	"></script>
	<script type="text/javascript">
		$(document).ready(function() {window.print(); });

				
			</script>
</head>
<body>
	<?php
$AdiSoyadi = $_POST["AdiSoyadi"];
$SirketAdi = $_POST["SirketAdi"];
$Bolum = $_POST["Bolum"];
$Sinif = $_POST["Sinif"];
$Numarasi = $_POST["Numarasi"];
$Cinsiyet = $_POST["Cinsiyet"];
$Tarih = $_POST["Tarih"];
$OkulAdi = $_POST["OkulAdi"];
$yetkilisi = $_POST["Yetkili"];
?>
<br />
<br /><br />
<br />
<p style="font-size: 18px;"><b><a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $SirketAdi; ?></a> ŞİRKETİ MÜDÜRLÜĞÜNE</b> </p><br />
<p>Velisi bulunduğum <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Bolum; ?></a> , 
<a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Sinif; ?></a> Sınıfı,
 <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Numarasi; ?></a> 
 numaralı <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Cinsiyet; ?></a> <b> 
 <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $AdiSoyadi; ?></a> </b> 
 'in 100/200 saat tutarındaki staj çalışmasını Temmuz / 
 Ağustos döneminde sigortası okul müdürlüğü tarafından yapılmak üzere işletmenizde staj yapması için gereğini bilgilerinize arz ve rica ederim. </p>
 <br />
 <p style="float:right"><?php echo date("d.m.Y"); ?></p><br/>
 <p style="float:right">Veli Adı Soyadı / İmza</p>  
 
 <div style="clear: both;"></div>
 <br /><br /><br /><br /><br />
 <p style="border-bottom: 1px dashed #000;"></p><br />
 <p style="font-size: 18px;"><a href="#" style="color:#000; border-bottom: 1px dotted #000;"><b><?php echo $OkulAdi; ?> </a> MÜDÜRLÜĞÜNE</b></p><br />
 <p>Velisi bulunduğum <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Bolum; ?></a> ,
 <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Sinif; ?></a> Sınıfı,
 <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Numarasi; ?></a> 
 numaralı <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $Cinsiyet; ?></a> <b> 
 <a href="#" style="color:#000; border-bottom: 1px dotted #000;"><?php echo $AdiSoyadi; ?></a> </b> 
 'in 100/200 saat tutarındaki staj çalışmasını Temmuz / 
 Ağustos döneminde sigortası okul müdürlüğü tarafından yapılmak üzere <a href="#" style="color:#000; border-bottom: 1px dotted #000;">
 <?php echo $SirketAdi; ?></a> İşletmesinde yapmasını uygun görüyorum.
 <br />
 Bilgilerinizi ve gereğini arz ederim.<p><br />
 <p style="float:right"><?php echo date("d.m.Y"); ?></p><br/>
 <p style="float:right">Veli Adı Soyadı / İmza</p>
 <div style="clear: both;"></div> 
 <br /><br /><br /><br /><br />
 <p style="border-bottom: 1px dashed #000;"></p><br />
 <p style="font-size: 18px;"><a href="#" style="color:#000; border-bottom: 1px dotted #000;"><b><?php echo $OkulAdi; ?></a> MÜDÜRLÜĞÜNE</b> </p><br />
 <p> Okulunuzda okuyan ve dilekçesinde kimliği belirtilen öğrenciniz şahsen, velinin yazılı müracaatı ile işletmemizde staj yapma talebinde bulunarak 100/200 saatlik yaz stajını işletmemiz bünyesinde yapmak istemektedir.</br>
 İlgilinin işletmemizde staj yapması uygun görülmüştür.
 <br />
 Bilgilerinizi ve gereğini arz ve rica ederiz.<br/></p>
 <p style="float:right"><?php echo date("d.m.Y"); ?></p><br/>
 <p style="float:right"><?php echo $yetkilisi; ?></p><br/>
 <p style="float:right">Kaşe - İmza</p><br /><br />
 <?php 
header( "Refresh: 3; url={$_SERVER["HTTP_REFERER"]}");   
 ?>
</body>
</html>
<?php 
ob_end_flush(); ?>
