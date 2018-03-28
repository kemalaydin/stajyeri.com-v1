<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
    function ajax_utf_temizle($dizi) {
    return is_array($dizi) ? array_map('ajax_utf_temizle', $dizi) : iconv("UTF-8","ISO-8859-9//TRANSLIT",$dizi);
    }
    $_GET = ajax_utf_temizle($_GET);
    $_POST = ajax_utf_temizle($_POST);
    $_REQUEST = ajax_utf_temizle($_REQUEST); 
require("sistem/baglan.php");
$id = @$_GET['basvuruid'];
$IlanID =  @$_GET['ilanid'];

$ogrenciOnayla = mysql_query("update ilanbasvuru set IsyeriOnay='1' where id='$id'");
$BasvuruCikar = mysql_query("select * from ilanbasvuru where IlanID='$IlanID' order by id desc");
				$BasvuruVarmi = mysql_num_rows($BasvuruCikar);
				if($BasvuruVarmi > 0){
				while($BasvuruSonuc = mysql_fetch_array($BasvuruCikar)){
					
					extract($BasvuruSonuc);
$OgrenciBul = mysql_query("select * from ogrenci where id ='$OgrenciID'");
$OgrenciSonuc = mysql_fetch_array($OgrenciBul);
$LiseID = $OgrenciSonuc["OkulID"];
$OkulBul = mysql_query("select * from okul where id = '$LiseID'");
$OkulCikar = mysql_fetch_array($OkulBul);	
$basvuruid = $BasvuruSonuc['id'];
?>
<li style="padding:10px;border:none;"><a href="javascript:void(0)" class="sifreDuzenle"><b><?php echo $OgrenciSonuc["Ad"].' '.$OgrenciSonuc["Soyad"]; ?></b> ( <?php echo $OkulCikar["OkulAdi"]; ?> ) </a>

<?php if($BasvuruSonuc['IsyeriOnay'] == 2) {
echo '<img id="'.$basvuruid.'" title="Onayla" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;" class="ogrenciOnay" src="img/ogrenciOnay.png" alt="'.$IlanID.'" />';
echo '<img id="'.$basvuruid.'" title="Reddet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;margin-right:5px;" class="ogrenciRet" src="img/ogrenciRet.png" alt="'.$IlanID.'" />';
echo '<span style="float:right;font-weight:bold;font-size:14px;margin-right:10px;color:#EBA400;font-family:Arial;">Bekliyor</span>';
}
elseif($BasvuruSonuc['IsyeriOnay'] == 0) {
echo '<img id="'.$basvuruid.'" title="Onayla" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;" class="ogrenciOnay" src="img/ogrenciOnay.png" alt="'.$IlanID.'" />';
echo '<img id="'.$basvuruid.'" title="Beklet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;margin-right:5px;" class="ogrenciBekle" src="img/ogrenciBekle.png" alt="'.$IlanID.'" />';
echo '<span style="float:right;font-weight:bold;font-size:14px;margin-right:10px;color:#D40019;font-family:Arial;">Reddedildi</span>';
}
elseif($BasvuruSonuc['IsyeriOnay'] == 1) {
echo '<img id="'.$basvuruid.'" title="Reddet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;margin-right:5px;" class="ogrenciRet" src="img/ogrenciRet.png" alt="'.$IlanID.'" />';
echo '<img id="'.$basvuruid.'" title="Beklet" style="width:32px;height:32px;float:right;margin-top:-7px;cursor:pointer;" class="ogrenciBekle" src="img/ogrenciBekle.png" alt="'.$IlanID.'" />';
echo '<span style="float:right;font-weight:bold;font-size:14px;margin-right:10px;color:#1AB000;font-family:Arial;">Onaylandi</span>';
}



 ?>
 </li>
 
 <?php
 		}
	
			}else{
			bilgi("Henüz Bu Ýlana Baþvuru Yok!","Sistemimizden henüz bir baþvuru gelmedi","bilgi");
			}
 
  ?>
 	