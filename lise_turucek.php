<?php 
require("sistem/baglan.php");


mysql_query (" SET CHARACTER SET utf-8");

// gerekli vt bağlantı dosyasını çağırdığını varsayalım
$id = (int)$_POST["id"];
$okulbul = mysql_query("select * from okul where id='$id'");
$okul = mysql_fetch_array($okulbul);

$okulturu = $okul["LiseTuru"];

	$parcala = explode(",",$okulturu);
					

		foreach($parcala as $okultur){
							
							
							$durum = mysql_query("select * from liseturu where id='$okultur'");
							$durumsay = mysql_num_rows($durum);
							if($durumsay > 0){
							while($okulunturu=mysql_fetch_array($durum)){
							extract($okulunturu);
							echo '<option value="'.$id.'">'.$LiseTuru.'</option>';
							
							}
							}else{
							echo '<option>Hata Meydana Geldi !</option>';
							}	
						
		}
							



?>