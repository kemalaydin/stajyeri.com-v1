<?php 
if($_SESSION["oturum"]){
	if($_SESSION["UyelikTuru"] == 0){
	$OgrenciID = $_GET["ogrid"];
	$OkulID =$_SESSION["uid"];
	$OgrenciSorgu = mysql_query("select * from ogrenci where id = '$OgrenciID' && OkulID = '$OkulID'");
	$OgrenciSay = mysql_num_rows($OgrenciSorgu);
	
	if($OgrenciSay > 0){
	$OgrenciCikar = mysql_fetch_array($OgrenciSorgu);
	extract($OgrenciCikar);
	?>
	<!--- JavaScript Dosyaları ---->
	<script type="text/javascript" src="js/jqueryv1.js"></script>
	<script type="text/javascript" src="js/profgoogle.js"></script>
	<script type="text/javascript" >
		
		
		// İlçeleri Seçmek
		$(function(){
			$("select[name=il]").change(function(){
				var id = $(this).val(); // il id'sini ajax metodu ile bir ajax dosyasına gönderelim
				$.ajax({
					type: "post",
					url: "ilce_cek.php",
					data: {"id":id},
					success: function(cevap){
					$("select[name=ilce]").html(cevap);
					
					}
				});
			});
		});
				// Okul Türünü Seçmek
		$(function(){
			$("select[name=LiseAdi]").change(function(){
				var id = $(this).val(); // il id'sini ajax metodu ile bir ajax dosyasına gönderelim
				$.ajax({
					type: "post",
					url: "lise_turucek.php",
					data: {"id":id},
					success: function(cevap3){
					$("select[name=LiseTuru]").html(cevap3);
					
					}
				});
			});
		});
		// Dal Seçmek
		$(function(){
			$("select[name=Alan]").change(function(){
				var id = $(this).val(); // il id'sini ajax metodu ile bir ajax dosyasına gönderelim
				$.ajax({
					type: "post",
					url: "alan_cek.php",
					data: {"id":id},
					success: function(cevap3){
					$("select[name=Dal]").html(cevap3);
					
					}
				});
			});
		});
		</script>
	<div class="sagbaslik">ÖĞRENCİ DÜZENLEME : <span style="color:#fcfcfc;"><?php echo $Ad.' '.$Soyad.' - '.$Sinif. ' / '.$Sube.' - '.lisetururet($LiseTuru); ?></span> </div>
		<div class="profilduzenle">
		<form action="index.php?git=okulduzogr&id=<?php echo $id; ?>" method="post" />
			<li style="float: right; width: 125px; background-color: #eaeaea;"><span><img style="width:99px;height:99px;" src="<?php echo $Resim; ?>" style="float: left; margin: 5px; border: 1px solid #000; padding: 1px;" /><br /><center><input type="file" name="ogrresim" class="profilinpsa"></center></span></li>
			
		<li style="border-top:none;"><span> <b> Adı : </b></span><input type="text" name="Adi" Value="<?php echo $Ad; ?>" class="profilinp"/></li>
		<li><span> <b> Soyadı : </b></span><input type="text" name="Soyadi" Value="<?php echo $Soyad; ?>" class="profilinp"/></li>
		<li><span> <b> Cinsiyet : </b></span></span><select name="Cinsiyet" class="profilsel">
						<?php if($Cinsiyet=="Erkek"){echo '<option value="Erkek" selected>Erkek</option><option value="Bayan">Bayan</option>';}else if ($Cinsiyet=="Bayan"){
						echo '<option value="Erkek">Erkek</option><option value="Bayan" selected>Bayan</option>';
						}else{ 
						echo '<option disabled="disabled">SEÇİNİZ</option><option value="Erkek">Erkek</option><option value="Bayan">Bayan</option>';
						}?>
		</select> </li>
		<li><span> <b> Doğum Tarihi : </b></span><?php echo $DogumTarihi; ?></li>
		<li><span> <b> E-Mail : </b></span><input type="text" name="Mail" Value="<?php echo $Mail; ?>" class="profilinp"/></li>
		<li><span> <b> T.C. No : </b></span><?php echo tccoz($TCNo); ?></li>
		<li><span> <b> Telefon : </b></span><input type="text" name="Telefon" Value="<?php echo $Telefon; ?>" class="profilinp"/></li>
		<li><span> <b> Adres : </b></span><textarea rows="0" cols="0" name="Adres" class="profiltxt"><?php echo $Adres; ?></textarea></li>
		<li><span> <b> İl : </b></span><select name="il" class="profilsel">
		<?php 
		$ilsorgu = mysql_query("select * from iller");
		while($ilcikar = mysql_fetch_array($ilsorgu)){
		if($il == $ilcikar["id"]){
		echo '<option value="'.$ilcikar["id"].'" selected>'.$ilcikar["il"].'</option>';
		}else{ 
		echo '<option value="'.$ilcikar["id"].'">'.$ilcikar["il"].'</option>';
		}
		}
		?>
		</select></li>
		<li><span> <b> İlçe : </b> 
		</span><select name="ilce" class="profilsel">
		<?php if(empty($il)){ ?>
		<option value="0">Seçiniz</option>
		<?php }else{ 
		$ilcesorgu = mysql_query("select * from ilceler where il_id='$il'");
		while($ilcecikar = mysql_fetch_array($ilcesorgu)){
		if($ilce == $ilcecikar["id"]){
		echo '<option value="'.$ilcecikar["id"].'" selected>'.$ilcecikar["ilce"].'</option>';
		}else{ 
		echo '<option value="'.$ilcecikar["id"].'">'.$ilcecikar["ilce"].'</option>';
		}
		}
		} ?>
		</select></li>
		<li><span> <b> Lise Türü : </b> 
		</span><select name="LiseTuru" class="profilsel">
		<?php 
		if(empty($LiseTuru) || $LiseTuru == 0){
		$liseturler = mysql_query("select * from liseturu");
		while($liseturcikar = mysql_fetch_array($liseturler)){
		echo '<option value="'.$liseturcikar["id"].'" selected>'.$liseturcikar["liseturu"].'</option>';
		}
		}else{			
		$liseturler = mysql_query("select * from liseturu");
		while($liseturcikar = mysql_fetch_array($liseturler)){
		if($LiseTuru == $liseturcikar["id"]){
		echo '<option value="'.$liseturcikar["id"].'" selected>'.$liseturcikar["LiseTuru"].'</option>';
		}else{
		echo '<option value="'.$liseturcikar["id"].'">'.$liseturcikar["LiseTuru"].'</option>';
		}
		}
		}
		?> </select>
		</li>
		
		<li><span> <b> Alan : </b> 
		</span><select name="Alan" class="profilsel">
		<?php 
		if(empty($Bolum) || $Bolum == 0){
		$alanlar = mysql_query("select * from alanlar");
		while($alanlarcik = mysql_fetch_array($alanlar)){
		echo '<option value="'.$alanlarcik["id"].'" selected>'.$alanlarcik["Alan"].'</option>';
		}
		}else{			
		$alanlar = mysql_query("select * from alanlar");
		while($alanlarcik = mysql_fetch_array($alanlar)){
		if($Bolum == $alanlarcik["id"]){
		echo '<option value="'.$alanlarcik["id"].'" selected>'.$alanlarcik["Alan"].'</option>';
		}else{
		echo '<option value="'.$alanlarcik["id"].'">'.$alanlarcik["Alan"].'</option>';
		}
		}
		}
		?> </select>
		</li>
		
		<li><span> <b> Dal : </b> 
		</span><select name="Dal" class="profilsel">
		<?php 
		if(empty($Dal) || $Dal == 0){
		$dallar = mysql_query("select * from dallar");
		while($dallarcik = mysql_fetch_array($dallar)){
		echo '<option value="'.$dallarcik["id"].'" selected>'.$dallarcik["Dal"].'</option>';
		}
		}else{			
		$dallar = mysql_query("select * from dallar where alanID = '$Bolum'");
		while($dallarcik = mysql_fetch_array($dallar)){
		if($Dal == $dallarcik["id"]){
		echo '<option value="'.$dallarcik["id"].'" selected>'.$dallarcik["Dal"].'</option>';
		}else{
		echo '<option value="'.$dallarcik["id"].'">'.$dallarcik["Dal"].'</option>';
		}
		}
		}
		?> </select>
		</li>
		
		<li><span> <b> Hakkında : </b></span><textarea rows="0" cols="0" name="Hakkinda" class="profiltxt"><?php echo $Hakkinda; ?></textarea></li>
		
		<li style="background-color:#fde5e5"><span> <b> Disiplin Suçu  : </b></span></span><select name="Disiplin" class="profilsel">
			<?php if($Disiplin=="1"){echo '<option value="1" selected>Var</option><option value="2">Yok</option>';}else if ($Disiplin=="2"){
			echo '<option value="1">Var</option><option value="2" selected>Yok</option>';
			}else{ 
			echo '<option disabled="disabled" value="0">SEÇİNİZ</option><option value="1">Var</option><option value="2">Yok</option>';
			}?>
		</select> </li>		
		
		<li style="background-color:#fde5e5"><span> <b> Not Ortalaması  : </b></span></span><select name="NotOrtalamasi" class="profilsel">
			<?php if($NotOrtalamasi=="1"){echo '<option value="1" selected> 1.00 (0-44) </option><option value="2">2.00 (45-54)</option><option value="3">3.00 (55-69)</option><option value="4">4.00 (70-84)</option><option value="5">5.00 (85-100)</option>';
			}else if ($NotOrtalamasi=="2"){
			echo '<option value="1"> 1.00 (0-44) </option><option value="2" selected>2.00 (45-54)</option><option value="3">3.00 (55-69)</option><option value="4">4.00 (70-84)</option><option value="5">5.00 (85-100)</option>';
			}else if ($NotOrtalamasi=="3"){
			echo '<option value="1"> 1.00 (0-44) </option><option value="2">2.00 (45-54)</option><option value="3" selected>3.00 (55-69)</option><option value="4">4.00 (70-84)</option><option value="5">5.00 (85-100)</option>';
			}else if ($NotOrtalamasi=="4"){
			echo '<option value="1"> 1.00 (0-44) </option><option value="2">2.00 (45-54)</option><option value="3">3.00 (55-69)</option><option value="4" selected>4.00 (70-84)</option><option value="5">5.00 (85-100)</option>';
			}else if ($NotOrtalamasi=="5"){
			echo '<option value="1"> 1.00 (0-44) </option><option value="2">2.00 (45-54)</option><option value="3">3.00 (55-69)</option><option value="4">4.00 (70-84)</option><option value="5" selected>5.00 (85-100)</option>';
			}
			else{ 
			echo '<option disabled="disabled">SEÇİNİZ</option><option value="1"> 1.00 (0-44) </option><option value="2">2.00 (45-54)</option><option value="3">3.00 (55-69)</option><option value="4">4.00 (70-84)</option><option value="5">5.00 (85-100)</option>';
			
			}?>
		</select> </li>
		
		<li style="background-color:#fde5e5"><span> <b> Kullandığı Protez  : </b></span></span><select name="Protez" class="profilsel">
			<?php if($KullandigiProtez=="1"){echo '<option value="1" selected>Var</option><option value="2">Yok</option>';}else if ($KullandigiProtez=="2"){
			echo '<option value="1">Var</option><option value="2" selected>Yok</option>';
			}else{ 
			echo '<option disabled="disabled">SEÇİNİZ</option><option value="1">Var</option><option value="2">Yok</option>';
			}?>
		</select> </li>	

		<li><span> <b> Sınıf  : </b></span></span><select name="Sinif" class="profilsel">
			<?php if($Sinif=="9"){
			echo '<option value="9" selected>9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			';
			}else if ($Sinif=="10"){
			echo '<option value="9">9</option>
			<option value="10" selected>10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			';
			}else if ($Sinif=="11"){
		    echo '<option value="9">9</option>
			<option value="10">10</option>
			<option value="11" selected>11</option>
			<option value="12">12</option>
			';
			}else if ($Sinif=="12"){
			echo '<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12" selected>12</option>
			';
			}else{ 
			echo '<option disabled="disabled">SEÇİNİZ</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			';
			}?>
		</select> </li>	
		
		<li><span><b> Şube : </b> </span>
				
				<?php 
				
					echo '<select name="Sube" class="profilsel" >';
					
					for($r =65; $r<=90; $r++){
					$asciiac = chr($r);
					if($Sube == $asciiac){
					echo '<option value="'.$asciiac.'" selected>'.$asciiac.'</option>';
					}else{
					echo '<option value="'.$asciiac.'">'.$asciiac.'</option>';
					}
					} 
					echo '</select>';
				
				
				?> 
		</li>
		<li><span> <b> Okul No : </b></span><input type="text" name="OkulNo" Value="<?php echo $OkulNo; ?>" class="profilinp"/></li>
		
		<li style="background-color:#fde5e5"><span> <b> Okul Onayı  : </b></span></span><select name="OkulOnay" class="profilsel">
			<?php if($OkulOnay=="0"){echo '<option value="0" selected>Onaylı Değil</option><option value="1">Onaylı</option>';}else if ($OkulOnay=="1"){
			echo '<option value="0">Onaylı Değil</option><option value="1" selected>Onaylı</option>';
			}else{ 
			echo '<option disabled="disabled">SEÇİNİZ</option><option value="0">Onaylı Değil</option><option value="1">Onaylı</option>';
			}?>
		</select> </li>	
		<?php if($StajBaslama){ ?>
		<li style="background-color:#fde5e5"><span> <b> SSK NO  : </b></span><input type="text" name="SSKNo" Value="<?php echo $SSKNo; ?>" class="profilinp"/></li>
		<li style="background-color:#fde5e5"><span> <b> GİRİŞ TARİHİ  : </b></span><input type="text" name="GirisTarihi" Value="<?php echo $GirisTarihi; ?>" class="profilinp"/></li>
		<li style="background-color:#fde5e5"><span> <b> ÇIKIŞ TARİHİ  : </b></span><input type="text" name="CikisTarihi" Value="<?php echo $CikisTarihi; ?>" class="profilinp"/></li>
		<?php } ?>
		
		<br /><p style="float:right; margin-right: 10px;"><input type="submit" value="Öğrenci Düzenle" class="duzenlebut" /></p>
		<a style="margin-left: 10px;" href="index.php?git=okuldadegil&ogrid=<?php echo $id; ?>" class="tooltip">[ Bu Öğrenci Okulumuzda Değil ]
		<span class="classic"> Bu Bağlantıya Tıkladığınız Zaman Öğrencinin Hesabı Kalıcı Olarak Askıya Alınır. Bu İşlemi Yapmanız Durumunda Öğrenci Sisteme Bir Daha
		Giremeyecek. Lütfen Emin Olmadan Bu Link'e Tıklamayınız. </span>
		</a>
		<div style="clear: both;"></div>
		</form>
		</div>
	 <div class="buyukalt"></div>
	
	<?php 
		}else{bilgi("Bu Öğrenci Sizin Okulunuzda Değil !","Düzenlemeye Çalıştığınız Öğrenci Sizin Okulunuzda Değil","bilgi");}
	}else{Header("Location:../index.php");}
}else{Header("Location:../index.php");}

?>
