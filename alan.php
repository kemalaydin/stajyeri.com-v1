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
$alan = @$_GET['alan'];
?>
<li><span><b> İş Alanı : </b></span><select id="alan" name="isalani" class="profilsel">
            
			<?php
			$IsAlani = mysql_query("select * from alanlar");
			$isid = $_SESSION["uid"];
			while($ICikar = mysql_fetch_array($IsAlani)){
			if($alan == $ICikar["id"]){
		    $alann = $ICikar['IsAlani'];
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["Alan"].'</option>';
			}else{
			echo '<option value="'.$ICikar["id"].'">'.$ICikar["Alan"].'</option>';
			}
			}
			
			?>
			</select></li>
            		<li><span><b> İş Dalı : </b></span><select name="isdal" class="profilsel">
       
			<?php
			$IsAlani = mysql_query("select * from dallar where alanID = '$alan'");
			$isid = $_SESSION[“uid”];
			while($ICikar = mysql_fetch_array($IsAlani)){
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["Dal"].'</option>';

		
			}
			
			?>
			</select></li>
