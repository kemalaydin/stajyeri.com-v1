	
	<!---- Oturum Kontrol --------->
	<?php if(!$_SESSION["oturum"]){
	Header("Location:../index.php"	);
	}else{ 
	//<!---- Üyelik Türü Öğrenci İse ---->
	if($_SESSION["UyelikTuru"] == "1"){
		$idsi = $_SESSION["uid"];
		$bilgilericek = mysql_query("select * from ogrenci where id = '$idsi'");
		$bilgilerigoster = mysql_fetch_array($bilgilericek);
		extract($bilgilerigoster);
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
		// Okulları Seçmek
		$(function(){
			$("select[name=il]").change(function(){
				var id = $(this).val(); // il id'sini ajax metodu ile bir ajax dosyasına gönderelim
				$.ajax({
					type: "post",
					url: "okul_cek.php",
					data: {"id":id},
					success: function(cevap2){
					$("select[name=LiseAdi]").html(cevap2); 
					
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
		
	<!--- Öğrenci Profil Alanı ---->	
	<div class="sagbaslik">Profilim (<i> <?php echo $Ad.' '. $Soyad; ?> </i>)</div>
<div class="profilduzenle">	

				<form enctype="multipart/form-data" action="profilguncellendi/" method="post">
				<li style="float: right; width: 125px; background-color: #eaeaea; -moz-border-radius:5px;
-webkit-border-radius:5px;
border-radius:5px;
"><span><img style="width:99px;height:99px;" src="<?php echo $Resim; ?>" style="float: left; margin: 5px; border: 1px solid #000; padding: 1px;" /><br /><center><input type="file" name="ogrresim" class="profilinpsa"></center></span></li>
				<li><span> <b> Adınız : </b></span> <?php echo $Ad; $ogrr = $_SESSION['uid'];
$ilal = mysql_fetch_array(mysql_query("select * from ogrenci where id='$ogrr'"));
$ogril = $ilal['il']; ?> </li>
				<li><span> <b> Soyadınız : </b></span><?php echo $Soyad; ?></li>
				<li><span> <b> T.C. No : </b> </span><?php echo tccoz($TCNo); ?> </li>
				<li><span> <b> Doğum Tarihiniz :  </b> </span><?php echo $DogumTarihi; ?> </li>
				<li><span> <b> Mail : </b> </span><input type="text" value="<?php echo $Mail; ?>" name="Mail" class="profilinp"/> </li>
				<li><span> <b> Cinsiyet : </b> 
				
				</span><select name="Cinsiyet" class="profilsel">
						<?php if($Cinsiyet=="Erkek"){echo '<option value="Erkek" selected>Erkek</option><option value="Bayan">Bayan</option>';}else if ($Cinsiyet=="Bayan"){
						echo '<option value="Erkek">Erkek</option><option value="Bayan" selected>Bayan</option>';
						}else{
						echo '<option disabled="disabled">SEÇİNİZ</option><option value="Erkek">Erkek</option><option value="Bayan">Bayan</option>';
						}?>
				</select> </li>
				
				<li><span> <b> Telefon : </b> </span><input type="text" value="<?php echo $Telefon; ?>" name="Telefon" class="profilinp"/> </li>
				<li><span> <b> Adres : </b> </span><textarea rows="0" cols="0" name="Adres" class="profiltxt"><?php echo $Adres; ?></textarea></li>
				<li><span> <b> İl : </b> 
				
				</span><select name="il" class="profilsel" >
				<?php iller(); ?> 
				</select></li>
				<li><span> <b> İlçe : </b> 
				
				</span><select name="ilce" class="profilsel">
				<?php if(empty($il)){ ?>
				<option value="0">Seçiniz</option>
				<?php }else{ ilceler(); } ?>

				</select></li>
				
				
				<li style="height:30px;"><span> <b> Okulunuz : </b></span> <?php 
				
				if(empty($OkulID)){
				?> <select name="LiseAdi" class="profilsel">
					<?php
						if(isset($il)) {
						$okulbul = mysql_query("select * from okul where il='$il'");

		while ($okul = mysql_fetch_array($okulbul)){
			
  
		echo '<option value="'.$okul["id"].'">'.$okul["OkulAdi"].'</option>';
		}}else {
		echo '<option value="0">Seçiniz</option>';
		
		}
						

					?>
				</select><?php
				}else{
				$OkulBul = mysql_query("select * from okul where id = '$OkulID'");
				$OkulSay = mysql_num_rows($OkulBul);
				if($OkulSay > 0){
				$OkulCikar = mysql_fetch_array($OkulBul);
				echo $OkulCikar["OkulAdi"];
 				}else{
				echo "Bir Sorunn Meydana Geldi";
				}
				}
				?> </li>
				
				<li><span> <b> Lise Türü : </b> 
				
				</span>
				
				<?php 
				if(empty($LiseTuru) || $LiseTuru == 0){
				liseturleri();
				}else{			
				liseturun(); 
				}
				 ?> 
				</li>
				
				<li><span> <b> Bölüm : </b> 
				
				</span>
				
				<?php 
				if(empty($Bolum)){
				bolumler();
				}else{			
				alanbul($Bolum); 
				}
				 ?> 
				</li>
				
				<li><span> <b> Dal : </b> 
				
				</span>
				<?php if(empty($Dal)){ ?>
				<select name="Dal" class="profilsel">
				<option value="0">Seçiniz</option>
				</select>
				<?php }else{ dalbul($Dal); } ?>

				</li>
				
				<li><span> <b> Hakkında : </b> </span><textarea rows="0" cols="0" name="Hakkinda" class="profiltxt"><?php echo $Hakkinda; ?></textarea></li>
				
				<li><span><b> Sınıf : </b> </span>
				
				<?php 
				if(empty($Sinif)){
					echo '<select name="Sinif" class="profilsel" ><option disabled>Seçiniz</option>';
					for($i =9; $i<=12; $i++){
					echo '<option value="'.$i.'">'.$i.'</option>';
					} 
					echo '</select>';
				}else{
					echo $Sinif;
				}
				?> 
				</li>
				
				<li><span><b> Şube : </b> </span>
				
				<?php 
				if(empty($Sube)){
					echo '<select name="Sube" class="profilsel" ><option disabled>Seçiniz</option>';
					
					for($r =65; $r<=90; $r++){
					$asciiac = chr($r);
					echo '<option value="'.$asciiac.'">'.$asciiac.'</option>';
					}
					echo "Ü";
					echo '</select>';
				}else{
					echo $Sube;
				}
				
				?> 
				</li>
				
				<li><span><b> Okul Numaran : </b> </span>
				
				<?php 
				if(empty($OkulNo)){
					echo '<input type="text" name="OkulNo" class="profilinp"/>';
				}else{
					echo $OkulNo;
				}
				
				?> 
				</li>
				<a href="javascript:void(0)" class="sifreDuzenle" style="padding:5px;"><b>[ Şifre Düzenle ]</b></a>
				<div class="sifre" style="overflow:auto;">
				 <script type="text/javascript">
				$(document).ready(function(){
				$(".sifreDuzenle").click(function(){
				$(".sifre").slideToggle('slow');
					});
				});</script>
				
				<li><span> <b> Kullandığınız Şifre : </b></span> <input type="password" name="EskiSifre" class="profilinp"/> </li>
				<li><span> <b> Yeni Şifre : </b></span> <input type="password"  name="YeniSifre" class="profilinp"/> </li>
				<li><span> <b> Yeni Şifre (Tekrar) : </b></span> <input type="password" name="YeniSifreTekrar" class="profilinp"/> </li>
				</div><br /><br />
				<p style="padding: 5px;">Stajyer-i.com ' a <b><?php echo $KayitTarihi; ?></b> de Kayıt Oldunuz. Disiplin Kaydınız <?php  

					if($Disiplin > 0){
					echo '<b> YOK </b>';
					}else if(empty($Disiplin)){
					echo '<b> Henüz Sisteme Girilmemiş </b>';
					}else{
					echo '<b> VAR </b>';
					}
					

				?>, Protez <?php  

					if($KullandigiProtez == 0){
					echo '<b> KULLANMIYORSUNUZ </b>';
					}else if(empty($KullandigiProtez)){
					echo 'Bilginiz <b>  Henüz Sisteme Girilmemiş </b>';
					}else{
					echo '<b> KULLANIYORSUNUZ </b>';
					}
					

				?></p>
				<p style="float:right; margin-right: 10px;"><input type="submit" value="Değişiklikleri Kaydet" class="duzenlebut"></p>
				</span>
				</form>
<div style="clear: both;"></div>
				</div>
<div class="buyukalt"></div>
<?php 

}else{bilgi("Bu Alan Sadece Öğrenciler İçindir !","Ulaşmak İstediğiniz Alana Sadece Öğrenci Üyeliği Erişebilir!!","bilgi");}} ?>
