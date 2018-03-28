<script type="text/javascript">
$(document).ready(function() {
    
    $(".ilanD").click(function() {
        $("#duzenlemeMod").fadeIn(1000);
        return false;
    });
    
    $("#ilanDetayInline li p").css("display","inline");
    $("#ilanDetayInline li p#ilanDurum").css("display","inline");
    $("#ilanDetayInline li p#ilanDetay").css("display","inline");


});
</script>
<style>
form {display:inline;}
input[type=text] {width:125px;border:1px solid #ddd;padding:3px;}
textarea {width:65%;height:50px;border:1px solid #ddd;padding:3px;}
#duzenlemeMod {display:none;}
</style>
<?php
if($_POST) {
    
    $id = $_POST['id'];
    $degisken = $_POST['degisken'];
    $alan = $_POST['alan'];
    $guncelle = mysql_query("update ilanlar set $alan='$degisken' where id = '$id'");
    if(!$guncelle ) {
        
        echo  "olmadı".mysql_error();   
    }else { 
        
        header("Location:".$_SERVER['HTTP_REFERER']."");
    }
}else {
 
 ?>


<?php
if($_SESSION["oturum"]){
$varmiboyleilan = mysql_num_rows(mysql_query("select * from ilanlar where id='$id'"));
if($varmiboyleilan > 0){
	if($_SESSION["UyelikTuru"] == 1){
	$OgrenciID = $_SESSION["uid"];
	$OgrenciArama = mysql_query("select * from ogrenci where id='$OgrenciID'");
	$OgrenciCikar = mysql_fetch_array($OgrenciArama);
	$StajDurumu = $OgrenciCikar["StajBaslama"];
	}
$AlinanStajyer = mysql_query("select * from ilanbasvuru where IlanID = '$id' && OkulOnay = '1' && IsyeriOnay = '1' && OgrenciOnay = '1' && Onay = '1'");
$cikarilan = mysql_fetch_array($AlinanStajyer);

$AlinanStajyerSay = mysql_num_rows($AlinanStajyer);
if($Durum == 0 || $AlinanStajyerSay == $AlinacakStajyer){
$Durum = "Kapalı";
}else{
$Durum = "Açık";
}
$IsyeriBul = mysql_query("select * from isyeri where id = '$IsyeriID'");
$IsyeriCikar = mysql_fetch_array($IsyeriBul);

if($_SESSION["ZiyaretciOn"]){}else{
$ZiyaretEkle = mysql_query("UPDATE ilanlar SET Ziyaretci = Ziyaretci+1 where id='$id'");
$_SESSION["ZiyaretciOn"] = true;
}



?>
<div class="sagbaslik"><?php echo $Baslik ?> ( <?php isyeri_fonk($IsyeriID); ?> )</div>
<div class="hatabildir" style="padding:5px;">
<div class="ilanicerik" id="ilanDetayInline"> 

<div id="duzenlemeMod" style="border:none;" class="onay">İlan düzenleme modu açıldı. Düzenlemek istediğiniz ilan özelliğinin değerine çift tıklayın ve düzenleyin.</div>
<ul>
<li style="width:46%;padding:10px;margin: 3px 4px 5px 3px;"><b>İlanı Açan Firma : </b> <?php isyeri_fonk($IsyeriID); ?></li>
<li style="width:46%;padding:10px;margin: 3px 0px;"><b>İş Alanı : </b> <?php alanbul($IsAlani); ?></li>
<li style="width:46%;padding:10px;margin: 3px 4px 5px 3px;"><b>Alınacak Stajyer Sayısı : </b><p rel="<?php echo $ilanID; ?>" class="AlinacakStajyer "><?php echo $AlinacakStajyer.'</p> Kişi '; ?></li>
<li style="width:46%;padding:10px;margin: 3px 0px;"><b>İlan Tarihi : </b><p rel="<?php echo $ilanID; ?>" class="IlanTarihi"><?php echo $IlanTarihi; ?></p></li>
<li style="width:46%;padding:10px;margin: 3px 4px 5px 3px;"><b>Staj Dönemi : </b><?php echo $StajDonem; ?></li>
<li style="width:46%;padding:10px;margin: 3px 0px;">İlan Şuan <p style="font-weight:bold;" id="ilanDurum" rel="<?php echo $ilanID; ?>"><?php echo $Durum; ?></p></li>
<li style="width:94.5%;padding:15px;margin: 3px 4px 5px 3px;"> <p id="ilanDetay" rel="<?php echo $ilanID; ?>" class="Detay"><?php echo nl2br($Detay); ?></p> </li>
<li style="width:46%;padding:10px;margin: 3px 3px;"> <b>Bu ilan <?php echo $Ziyaretci; ?> kez ziyaret edilmiştir.</b></li>
<li style="width:46%;padding:10px;margin: 3px 0px 5px 3px;"> <b>Başvuran Sayısı : </b> <?php echo $BasvuruSayisi; ?></li>
<li style="width:46%;padding:10px;margin: 3px 3px;"> <b>Alınan Stajyer : </b> <?php echo $AlinanStajyerSay. ' / '.$AlinacakStajyer; ?>  </li>
<li style="width:46%;padding:10px;margin: 3px 0px 5px 3px;"> <b>Firma Adresi : </b> <?php echo $Adres; ?>  </li>
<li style="width:46%;padding:10px;margin: 3px 3px;"> <b>Firma İli : </b> <?php ilbul($il); ?>  </li>
<li style="width:46%;padding:10px;margin: 3px 0px 5px 3px;"> <b>Firma İlçesi : </b> <?php ilcebul($ilce); ?>  </li>
<li style="width:46%;padding:10px;margin: 3px 0px 5px 3px;"> <b>Staj Süresi : </b> <?php echo $StajDonemi; ?>  </li>
</ul>
<div style="float:right; padding: 5px; margin: 5px;">

<div class="saribut"> <center><a href="isyeri/<?php echo $IsyeriCikar['IsyeriSef']; ?>">Firma Profili</a></center></div>
<?php if($_SESSION["UyelikTuru"] == 1){ 
if($StajDurumu){

}else{
	$OGID = $_SESSION["uid"];
	$AlinanStajyer2 = mysql_query("select * from ilanbasvuru where IlanID = '$id' && OgrenciID = '$OGID'");
	$cikarilan2 = mysql_fetch_array($AlinanStajyer2);
	if($cikarilan2["OgrenciID"] == $_SESSION["uid"]){ ?> 
	<div class="kirmizibut"> <center><a href="index.php?git=IlanBasvuruIptal&id=<?php echo $id; ?>">Başvuru İptal </a></center></div> 
	
	<?php }else{?><div class="yesilbut"> <center><a href="#">Mesaj Gönder</a></center></div> 
	<?php if($Durum != "Kapalı"){?><div class="yesilbut"> <center><a href="index.php?git=IlanBasvur&id=<?php echo $id; ?>">BAŞVUR !</a></center></div><?php }}?> 

<?php }} ?>

<?php if($_SESSION["UyelikTuru"] == 2){ if($IsyeriID == $_SESSION["uid"]){?>
<script type="text/javascript">
$(document).ready(function() {
    
    $(".ilanD").click(function() {
        $("#duzenlemeMod").fadeIn(1000);
        return false;
    });
    
    $("#ilanDetayInline li p").css("display","inline");
    $("#ilanDetayInline li p#ilanDurum").css("display","inline");
    $("#ilanDetayInline li p#ilanDetay").css("display","inline");
    $("#ilanDetayInline li p").dblclick(function() {
	var icerik = $(this).text();
	var id = $(this).attr("rel");
	var alan = $(this).attr("class");
	$("form").hide();
	$("#ilanDetayInline li p").show();
	$(this).hide();
	$(this).after('<form action="" method="post"><input type="text" value="'+icerik+'" name="degisken" /><input type="hidden" value="'+id+'" name="id" /><input type="hidden" value="'+alan+'" name="alan" /><input type="submit" value="OK"/></form>');
	
});

 $("#ilanDetayInline li p#ilanDetay").dblclick(function() {
	var icerik = $(this).text();
	var id = $(this).attr("rel");
	var alan = $(this).attr("class");
	$("form").hide();
	$("#ilanDetayInline li p").show();
	$(this).hide();
	$(this).after('<form action="" method="post"><textarea name="degisken" >'+icerik+'</textarea><input type="hidden" value="'+id+'" name="id" /><input type="hidden" value="'+alan+'" name="alan" /><input type="submit" value="OK"/></form>');
	
});

 $("#ilanDetayInline li p#ilanDurum").dblclick(function() {
	var icerik = $(this).text();
	var id = $(this).attr("rel");
	$("form").hide();
	$("#ilanDetayInline li p").show();
	$(this).hide();
	$(this).after('<form action="" method="post"><select name="degisken"><option value="0">Kapalı</option><option value="1">Açık</option></select><input type="hidden" value="'+id+'" name="id" /><input type="hidden" value="Durum" name="alan" /><input type="submit" value="OK"/></form>');
	
});

});
</script>
<div class="yesilbut"> <center><a href="javascript:void(0)" class="ilanD" >İlanı Düzenle</a></center></div>
<div class="yesilbut"> <center><a href="basvuranlar/<?php echo $id; ?>">Başvuran Öğrenciler</a></center></div>
<?php } } ?>
</div></div>
<div style="clear:both"></div></div>
	<div class="buyukalt"></div>
<?php
}else{
bilgi("Böyle Bir İlan Sitemizde Yok","Sitemizde Böyle Bir İlan Bulamadık","bilgi");
}}else{
Header("Location:../index.php");
}
?>
<?php } ?>
