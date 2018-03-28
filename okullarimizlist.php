<h2 style="margin-bottom:10px;margin-top:7px;color:#1c5b6c;">OKULLAR ( A dan Z ye ) <a href="index.php" style="color:#1c5b6c;"> - Ana Sayfa </a></h2>
<?php

	$sayfa = $_GET["sayfa"];
	if (empty($sayfa) || !is_numeric($sayfa)){
	$sayfa = 1;
	}
		$kacar = 13;
		$ksayisi = mysql_num_rows(mysql_query("select * from okul where onay = '1'"));
		$ssayisi = ceil($ksayisi/$kacar);
		$nereden = ($sayfa*$kacar)-$kacar;
		
$IsyerleriCikar = mysql_query("select * from okul where onay = '1' order by  OkulAdi asc limit $nereden,$kacar");
$IsyeriSay = mysql_num_rows($IsyerleriCikar);

while($IsyeriDisari = mysql_fetch_array($IsyerleriCikar)){
$Il = ilbulret($IsyeriDisari["il"]);
$Ilce = ilcebulret($IsyeriDisari["ilce"]).' / ';
if(empty($Il)){
$Il = "HENÜZ İL BİLGİSİ GİRİLMEMİŞ ";
$Ilce = "";
}
echo '<div class="isletmelerimiz"><li><b>'.$IsyeriDisari["OkulAdi"].'</b> - '.$Ilce.$Il.'</li></div><br />';

}

		if($ksayisi > $kacar){
			 echo '<center><div class="sayfala">';
			for ($i=1;$i <= $ssayisi; $i++){
				
				echo '<a href="index.php?git=okullarimiz&sayfa='.$i.'"';
				if ($sayfa == $i) {
				echo 'class="aktif"';
				}
				echo '>'.$i.'</a>';
				
				}
				echo '</div></center>';
				 }


?>