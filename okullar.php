<?php if($_SESSION["oturum"]){ ?>
<div class="sagbaslik">OKULLAR</div>
<div class="sonbascurular">
<ul style="padding:10px;">
<?php

$isyeribul = mysql_query("select * from okul");

	while($isyeribulgoster = mysql_fetch_array($isyeribul)){
	extract($isyeribulgoster);
	
	echo '<li style="padding:5px;"><a href="index.php?git=profilokul&id='.$id.'">'.$OkulAdi.' -  '.ilbulret($il).' / '.ilcebulret($ilce).'</a></li>'  ;
	}

 ?>
 </ul></div>
<div class="buyukalt"></div>
 <?php

}else{
Header("Location:index.php");
}

?>