<?php if($_SESSION["oturum"]){ ?>
<div class="sagbaslik">ŞİRKETLER</div>
<div class="sonbascurular">
<ul style="padding:10px;">
<?php

$isyeribul = mysql_query("select * from isyeri");

	while($isyeribulgoster = mysql_fetch_array($isyeribul)){
	extract($isyeribulgoster);
	
	echo '<li style="padding:5px;"><a href="index.php?git=profilisyeri&id='.$id.'">'.$IsyeriAdi.'</a></li>'  ;
	}


 ?>
 </ul></div>
<div class="buyukalt"></div>
 <?php

}else{
Header("Location:index.php");
}

?>