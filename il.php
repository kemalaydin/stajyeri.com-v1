<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
    function ajax_utf_temizle($dizi) {
    return is_array($dizi) ? array_map('ajax_utf_temizle', $dizi) : iconv("UTF-8","ISO-8859-9//TRANSLIT",$dizi);
    }
    $_GET = ajax_utf_temizle($_GET);
    $_POST = ajax_utf_temizle($_POST);
    $_REQUEST = ajax_utf_temizle($_REQUEST); 
require("sistem/baglan.php");
$il = @$_GET['il'];
?>
<li><span><b> İl : </b></span><select id="il" name="il" class="profilsel">
            
			<?php
			$IsAlani = mysql_query("select * from iller");
			$isid = $_SESSION[“uid”];
			while($ICikar = mysql_fetch_array($IsAlani)){
			if($il == $ICikar["id"]){
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["il"].'</option>';
			}else{
			echo '<option value="'.$ICikar["id"].'">'.$ICikar["il"].'</option>';
			}
			}
			
			?>
			</select></li>
                		<li><span><b> İlçe : </b></span><select name="ilce" class="profilsel">
            
			<?php
			$IsAlani = mysql_query("select * from ilceler where il_id='$il'");
			$isid = $_SESSION[“uid”];
			while($ICikar = mysql_fetch_array($IsAlani)){
			if($IsyeriCikarsa["ilce"] == $ICikar["id"]){
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["ilce"].'</option>';
			}else{
			echo '<option value="'.$ICikar["id"].'">'.$ICikar["ilce"].'</option>';
			}
			}
			
			?>
			</select></li>
