
<?php
$OgrenciBul = mysql_query("select * from ogrenci where id ='$OgrenciID'");
$OgrenciSonuc = mysql_fetch_array($OgrenciBul);
$LiseID = $OgrenciSonuc["OkulID"];
$OkulBul = mysql_query("select * from okul where id = '$LiseID'");
$OkulCikar = mysql_fetch_array($OkulBul);	
$basvuruid = $BasvuruSonuc['id'];
?>
<li style="padding:10px;border:none;"><a href="javascript:void(0)" class="sifreDuzenle"><b><?php echo $OgrenciSonuc["Ad"].' '.$OgrenciSonuc["Soyad"]; ?></b> ( <?php echo $OkulCikar["OkulAdi"]; ?> ) </a>
<?php if($BasvuruSonuc['IsyeriOnay'] == 2 && $BasvuruSonuc['OgrenciOnay'] == 2) {
echo '<img id="'.$basvuruid.'" title="Onayla" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;" class="ogrenciOnay" src="img/ogrenciOnay.png" alt="'.$ilanid.'" />';
echo '<img id="'.$basvuruid.'" title="Reddet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;margin-right:5px;" class="ogrenciRet" src="img/ogrenciRet.png" alt="'.$ilanid.'" />';
echo '<span style="float:right;font-weight:bold;font-size:14px;margin-right:10px;color:#EBA400;font-family:Arial;">Bekliyor</span>';
}
elseif($BasvuruSonuc['IsyeriOnay'] == 0 && $BasvuruSonuc['OgrenciOnay'] == 2) {
echo '<img id="'.$basvuruid.'" title="Onayla" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;" class="ogrenciOnay" src="img/ogrenciOnay.png" alt="'.$ilanid.'" />';
echo '<img id="'.$basvuruid.'" title="Beklet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;margin-right:5px;" class="ogrenciBekle" src="img/ogrenciBekle.png" alt="'.$ilanid.'" />';
echo '<span style="float:right;font-weight:bold;font-size:14px;margin-right:10px;color:#D40019;font-family:Arial;">Reddedildi</span>';
}
elseif($BasvuruSonuc['IsyeriOnay'] == 1 && $BasvuruSonuc['OgrenciOnay'] == 2) {
echo '<img id="'.$basvuruid.'" title="Beklet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;" class="ogrenciBekle" src="img/ogrenciBekle.png" alt="'.$ilanid.'" />';
echo '<img id="'.$basvuruid.'" title="Reddet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;margin-right:5px;" class="ogrenciRet" src="img/ogrenciRet.png" alt="'.$ilanid.'" />';
echo '<span style="float:right;font-weight:bold;font-size:14px;margin-right:10px;color:#1AB000;font-family:Arial;">Onaylandı</span>';
}
 ?> 
</li>
