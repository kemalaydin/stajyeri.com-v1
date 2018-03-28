<?php
if($_SESSION["oturum"]){
	
	if($_SESSION["UyelikTuru"] == 1){

$ogrid = $_SESSION["uid"];
$OgrenciSorgusu = mysql_query("select * from ogrenci where id='$ogrid'");
$OgrenciCikarma = mysql_fetch_array($OgrenciSorgusu);		

$IsAlan = $OgrenciCikarma["Bolum"];
$OgrenciIl = $OgrenciCikarma["il"];
$Ilanlars = mysql_query("select * from ilanlar where IsAlani = '$IsAlan'");
$IlanSay = mysql_num_rows($Ilanlars);
$alans = Alanbulret($IsAlan);
if($IlanSay < 1){
echo '<div class="sagbaslik">İLANLAR</div><div class="ilandetayim">	<p style="padding: 5px;"><center>Sadece <b>'.$alans.'</b> na Ait İlanlar Listeleniyor ... </center></p>';
bilgi("Alanınıza Uygun Staj İlanı Yok.","Sistemimizde Tarafınıza Uygun Staj İlanı Yoktur...","bilgi");
echo'</div><div class="buyukalt"></div>';
}else{
	$sayfa = $_GET["sayfa"];
		if (empty($sayfa) || !is_numeric($sayfa)){
		$sayfa = 1;
		}
	$kacar = 15;
		$ksayisi = mysql_num_rows(mysql_query("select * from ilanlar where IsAlani = '$IsAlan' && il='$OgrenciIl'"));
		$ssayisi = ceil($ksayisi/$kacar);
		$nereden = ($sayfa*$kacar)-$kacar;
		$ili = ilbulret($OgrenciIl);

		if ($sayfa > 99999999999){
		require("404.php");
		}else{
if($IlanSay < 1){
echo '<div class="sagbaslik">İLANLAR</div><div class="ilandetayim"><p style="padding: 5px;"><center>Sadece <b>'.$alans.'</b> na Ait İlanlar Listeleniyor ... </center></p><p style="padding: 5px;">';
bilgi("Alanınıza Uygun Staj İlanı Yok.","Sistemimizde Tarafınıza Uygun Staj İlanı Yoktur...","bilgi");
echo'</p></div><div class="buyukalt"></div>';
}else{
?>
		<div class="sagbaslik">İLANLAR</div>
		<div class="ilandetayim">	
		<div class="ilanlar">	
				<?php 
			echo '<p><center>Sadece <b>'.$alans.'</b> na Ait ve <b>'.$ili.'</b> İlindeki İlanlar Listeleniyor ... </center></p>'; ?>
			<?php 
			$Ilanlar = mysql_query("select * from ilanlar where IsAlani = '$IsAlan' order by  id desc limit $nereden,$kacar");
			while($IlanCikar = mysql_fetch_array($Ilanlar)){
			extract($IlanCikar);
			$IsyeriSorgu = mysql_query("select * from isyeri where id='$IsyeriID'");
			$IsyeriSonuc = mysql_fetch_array($IsyeriSorgu);
			$IsyeriIli = $IsyeriSonuc["il"];
		$IsAlaniNe = alanbulret($IsAlani);
			$IsyeriCikar = isyeri_fonkret($IsyeriID);
			if($Durum == 1){
			
			echo '<li><a href="index.php?git=ilan&id='.$id.'">'.$Baslik.' <b>('.$IsyeriCikar.' / '.$IsAlaniNe.')</b></a><h5><img src="img/acik.png" title="Başvurular Açık" /></h5></li>';
			}else{
			echo '<li><a href="index.php?git=ilan&id='.$id.'">'.$Baslik.' <b>('.$IsyeriCikar.' / '.$IsAlaniNe.')</b></a><h5><img src="img/kapali.png" title="Başvurular Kapalı"/></h5></li>';
			}
			}
			?>
		
</div>

<?php
			if($ksayisi > $kacar){
			 echo '<center><div class="sayfala">';
			for ($i=1;$i <= $ssayisi; $i++){
				
				echo '<a href="index.php?git=ilanlar&sayfa='.$i.'"';
				if ($sayfa == $i) {
				echo 'class="aktif"';
				}
				echo '>'.$i.'</a>';
				
				}
				echo '</div></center>';
				 }

				 echo'</div>
<div class="buyukalt"></div>'; }}}}else{ ?>
		<div class="ilanlar">	
		<?php
		
		$sayfa = $_GET["sayfa"];
		if (empty($sayfa) || !is_numeric($sayfa)){
		$sayfa = 1;
		}
		$kacar = 15;
		$ksayisi = mysql_num_rows(mysql_query("select * from ilanlar"));
		$ssayisi = ceil($ksayisi/$kacar);
		$nereden = ($sayfa*$kacar)-$kacar;
		$ilansay = mysql_num_rows(mysql_query("select * from ilanlar"));
		
		if($ilansay > 0){
		
		?>
				<div class="sagbaslik">İLANLAR</div>
		<div class="ilandetayim">	
			
			<?php 
			$Ilanlar = mysql_query("select * from ilanlar order by  id desc limit $nereden,$kacar");
			while($IlanCikar = mysql_fetch_array($Ilanlar)){
			extract($IlanCikar);
			$IsAlaniNe = alanbulret($IsAlani);
			$IsyeriCikar = isyeri_fonkret($IsyeriID);
			if($Durum == 1){
			
			echo '<li><a href="index.php?git=ilan&id='.$id.'">'.$Baslik.' <b>('.$IsyeriCikar.' / '.$IsAlaniNe.')</b></a><h5><img src="img/acik.png" title="Başvurular Açık" /></h5></li>';
			}else{
			echo '<li><a href="index.php?git=ilan&id='.$id.'">'.$Baslik.' <b>('.$IsyeriCikar.' / '.$IsAlaniNe.')</b></a><h5><img src="img/kapali.png" title="Başvurular Kapalı"/></h5></li>';
			}
			}
					 if($ksayisi > $kacar){
			 echo '<center><div class="sayfala">';
			for ($i=1;$i <= $ssayisi; $i++){
				
				echo '<a href="index.php?git=ilanlar&sayfa='.$i.'"';
				if ($sayfa == $i) {
				echo 'class="aktif"';
				}
				echo '>'.$i.'</a>';
				
				}
				echo '</div></center>';
				 }
			}else{bilgi("Sistemde Henüz İlan Yok","Sistemimizde Henüz Bir İlan Yok. İlk İlanı Siz Verebilirsiniz.","bilgi"); }?>
		
</div></div>
<div class="buyukalt"></div>
<?php
}
}else{
Header("Location:../index.php");
}

?>
