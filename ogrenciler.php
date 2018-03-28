<?php if($_SESSION["oturum"]){ ?>
<div class="sagbaslik">ÖĞRENCİLER</div>
<div class="sonbascurular">
<ul style="padding:10px;">

<?php

$OgrenciBul = mysql_query("select * from ogrenci");
while ($OgrenciSonuc = mysql_fetch_array($OgrenciBul)) {
$LiseID = $OgrenciSonuc["OkulID"];
$OkulBul = mysql_query("select * from okul where id = '$LiseID'");
$OkulCikar = mysql_fetch_array($OkulBul);
?>
<li style="padding:5px;"><a href="<?php echo "ogrenci/".$OgrenciSonuc["OgrenciSef"].""; ?>" class="sifreDuzenle"><b><?php echo $OgrenciSonuc["Ad"].' '.$OgrenciSonuc["Soyad"]; ?></b> ( <?php echo $OkulCikar["OkulAdi"].' - '.ilbulret($OkulCikar["il"]); ?> ) </a></li>
<?php } ?></ul></div>
<div class="buyukalt"></div>
<?php
}else{
Header("Location:index.php");
}
 ?>
 