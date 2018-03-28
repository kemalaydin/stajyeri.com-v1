<?php
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == "0"){
	$OkulID = $_SESSION["uid"];
	$IseGirmisOgrenciler =  mysql_query("select * from isgiris where OkulID = '$OkulID'");
	$IsGirisSay = mysql_num_rows($IseGirmisOgrenciler);
	if($IsGirisSay > 0){
	$OkulCikar = mysql_fetch_array(mysql_query("select * from okul where id = '$OkulID'"));
	?>
	<div id="ortabolum">
	<div class="sagbaslik">SGK E-BİLDİRGE OLUŞTUR</div>
	<div class="ebildirge"><b><center>
	
	<div class="bildirgeust">
	 
	<form action="xmlindirme.php" method="post">
		<table>
	<tr>
	<td style="width: 400px;"><b>SİCİL NO </b></td>
	<td>:</td>
	<td><input type="text" name="sicilnosu" value="<?php echo $OkulCikar["SigortaSicilNo"]; ?>" style="width: 100px;" class="sgkinput"/></td>
	<td style="width: 40px;">
	</td> 
	<td><b>KONTROL NO</b></td>
	<td>:</td>
	<td><input type="text" name="kontrolno" value="68" class="sgkinput"/></td>
	</tr>
	<tr>
	<td><b>İŞYERİ ARAÇ NO</b></td>
	<td>:</td>
	<td><input type="text" name="isyeriaracno" value="000" class="sgkinput"/></td>
	<td>
	</td> 
	<td><b>İŞYERİ UNVAN </b></td>
	<td>:</td>
	<td><input type="text" name="isyeriunvan" value="<?php echo $OkulCikar["OkulAdi"]; ?>" style="width: 200px;" class="sgkinput"/></td>
	</tr>
	<tr>
	<td><b>ADRES</b></td>
	<td>:</td>
	<td><textarea style="border: 1px solid #f3f3f3;" name="adres" class="adresi" rows="0" cols="0"><?php echo $OkulCikar["Adres"]; ?></textarea></td>
	<td>
	</td>
	<td><b>VERGİ NO</b></td>  
	<td>:</td>
	<td><input type="vergino" name="vergino" value="" class="sgkinput"/></td>
	</tr>
	</table>
	 
	</div>
	<div class="icerigibu">
	<table>
	<tr style="background-color: #f3f3f3; font-weight: bold; text-align: center;">
	
	<td>S.N.</td>
	<td>TC NO</td>
	<td>ADI</td>
	<td>SOYADI</td>
	<td>PEK</td>
	<td>UIPEK</td>
	<td>GÜN</td>
	<td>ÇIKIŞ GÜN</td>
	<td>EKS. GÜN</td>
	<td>EGN</td>	
	</tr>
	
	


	
	<?php
	$SiraNo = 1;
	
	while($cikarsma = mysql_fetch_array($IseGirmisOgrenciler)){
	$ogrid = $cikarsma["OgrenciID"];
	$ogrencisorgu = mysql_query("select * from ogrenci where id = '$ogrid'");
	$OgrenciCikar = mysql_fetch_array($ogrencisorgu);
	
	?>
	<tr>
	<td><?php echo $SiraNo; ?></td>
	<td><?php echo tccoz($OgrenciCikar["TCNo"]); ?></td>
	<input type="hidden" name="tcno[]" value="<?php echo tccoz($OgrenciCikar["TCNo"]); ?>" />
	<td><?php echo $OgrenciCikar["Ad"]; ?></td>
	<input type="hidden" name="ad[]" value="<?php echo $OgrenciCikar["Ad"]; ?>" />
	<td><?php echo $OgrenciCikar["Soyad"]; ?></td>
	<input type="hidden" name="soyad[]" value="<?php echo $OgrenciCikar["Soyad"]; ?>" />
	<td style="text-align: center;"><input type="text" style="width: 35px; border: 1px solid #000;" name="pek[]" /></td>
	<td style="text-align: center;"><input type="text" style="width: 35px; border: 1px solid #000;" name="uipek[]" /></td>
	<td style="text-align: center;"><input type="text" style="width: 18px; border: 1px solid #000;" name="gun[]" /></td>
	<td style="text-align: center;"><input type="text" style="width: 35px; border: 1px solid #000;" name="cgun[]" /></td>
	<td style="text-align: center;"><input type="text" style="width: 20px; border: 1px solid #000;" name="eksgun[]" /></td>
	<td style="text-align: center;"><select name="egn[]" style="width: 40px; border: 1px solid #000;">
	<option value="">00 - YOK</option>
	<option value="07">07 - TEK NEDEN</option>
	</select></td>
	</tr>
    
	<?php
	
	$SiraNo++;
	}
	
	?>
	
	</table>
	</div>
	<div style="margin-top: 10px;"></div>
	<input type="submit" value="SGK E-BİLDİRGE XML OLUŞTUR" class="yazdirmatusu" /></form>
	</div> 
	<div style="clear:both;"></div>
	</div>
	
	<div class="buyukalt"></div>
	</div>
	<?php	
	}else{
	echo '<div class="sagbaslik">SGK E-BİLDİRGE OLUŞTUR</div>
	<div class="sonbascurular">';
	bilgi("Öğrenci Bulunamadı.","Sistemimizde staj girişi yapmış bir öğrenciniz yok.","bilgi");
	echo '</div>
	<div class="buyukalt"></div>';
	}
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

?>