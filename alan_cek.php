<?php 
require("sistem/baglan.php");

mysql_query (" SET CHARACTER SET utf-8");

// gerekli vt bağlantı dosyasını çağırdığını varsayalım
$id = (int)$_POST["id"];
$alanbul = mysql_query("select * from dallar where alanID='$id'");
$alanSay = mysql_num_rows($alanbul);

	if($alanSay > 0){
	echo '<option disabled>Seçiniz </option>';
		while ($alan = mysql_fetch_array($alanbul)){


		echo '<option value="'.$alan["id"].'">'.$alan["Dal"].'</option>';
		}
}else{
echo '<option>Sisteme Kayıtlı Dal Yok</option>';
}



?>