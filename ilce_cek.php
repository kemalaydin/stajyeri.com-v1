<?php 

require("sistem/baglan.php");

mysql_query (" SET CHARACTER SET utf-8");

// gerekli vt bağlantı dosyasını çağırdığını varsayalım
$id = (int)$_POST["id"];
$ilceBul = mysql_query("select * from ilceler where il_id='$id'");
while ($ilce = mysql_fetch_array($ilceBul)){
echo '<option value="'.$ilce["id"].'">'.$ilce["ilce"].'</option>';
}

?>