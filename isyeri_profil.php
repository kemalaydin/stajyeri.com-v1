	
	<!---- Oturum Kontrol --------->
	<?php if(!$_SESSION["oturum"]){
	Header("Location:../index.php"	);
	}else{ 
	//<!---- Üyelik Türü Öğrenci İse ---->
	if($_SESSION["UyelikTuru"] == "2"){
		$idsi = $_SESSION["uid"];
		$bilgilericek = mysql_query("select * from isyeri where id = '$idsi'");
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
	<div class="sagbaslik">Profilim (<i> <?php echo $IsyeriAdi; ?> </i>)</div>
<div class="profilduzenle">	
		
				<form enctype="multipart/form-data" action="index.php?git=isyeriprofilguncellendi" method="post">
				<li style="float: right; width: 125px; background-color: #E0EDF2; -moz-border-radius:5px;
-webkit-border-radius:5px;
border-radius:5px;
/*IE 7 AND 8 DO NOT SUPPORT BORDER RADIUS*/
"><span><img style="width:99px;height:99px;" src="<?php echo $Resim; ?>" style="float: left; margin: 5px; border: 1px solid #000; padding: 1px;" /><br /><input type="file" name="firmaresim" class="profilinpsa"></span></li>
				<li><span> <b> İş Yeri Adı : </b></span> <input type="text" value="<?php echo $IsyeriAdi; ?>" name="IsyeriAdi" class="profilinp"/> </li>
				<li><span> <b> Adınız : </b></span> <input type="text" value="<?php echo $Ad; ?>" name="Ad" class="profilinp"/> </li>
				<li><span> <b> Soyadınız : </b></span> <input type="text" value="<?php echo $Soyad; ?>" name="Soyad" class="profilinp"/> </li>
				<li><span> <b> Ünvan : </b></span> <input type="text" value="<?php echo $Unvan; ?>" name="Unvan" class="profilinp"/> </li>
				<li><span> <b> Mail : </b></span><?php echo $Mail; ?></li>
				<li><span> <b> Vergi No : </b> </span><input type="text" value="<?php echo $VergiNo; ?>" name="VergiNo" class="profilinp"/> </li>
				<li><span> <b> Telefon : </b> </span><input type="text" value="<?php echo $Telefon; ?>" name="Telefon" class="profilinp"/> </li>
				<li><span> <b> Fax : </b> </span><input type="text" value="<?php echo $Fax; ?>" name="Fax" class="profilinp"/> </li>
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
				<li><span> <b> İş Alanı : </b> 
				</span><select name="isalani" class="profilsel">
				<?php 
				isalaniis();
				?>

				</select></li>
				<li><span> <b> Usta Öğretici - 1  : </b></span> <input type="text" name="ustaogr1" value="<?php echo $UstaOgretici1; ?>" class="profilinp"/> </li>
				<li><span> <b> Usta Öğretici - 2  : </b></span> <input type="text" name="ustaogr2" value="<?php echo $UstaOgretici2; ?>" class="profilinp"/> </li>
				<li><span> <b> Usta Öğretici - 3  : </b></span> <input type="text" name="ustaogr3" value="<?php echo $UstaOgretici3; ?>" class="profilinp"/> </li>
				<a href="javascript:void(0)" id="sifreDuzenle"style="padding:5px;"><b>[ Şifre Düzenle ]</b></a>
				<div class="sifre" style="overflow:auto;">
				 <script type="text/javascript">
				$(document).ready(function(){
				$("#sifreDuzenle").click(function(){
				$(".sifre").slideToggle('slow');
					});
				});</script>
				
				<li><span> <b> Kullandığınız Şifre : </b></span> <input type="password" name="EskiSifre" class="profilinp"/> </li>
				<li><span> <b> Yeni Şifre : </b></span> <input type="password"  name="YeniSifre" class="profilinp"/> </li>
				<li><span> <b> Yeni Şifre (Tekrar) : </b></span> <input type="password" name="YeniSifreTekrar" class="profilinp"/> </li>
				</div>
				<p style="padding: 7px;">Stajyer-i.com ' a <b><?php echo $KayitTarihi; ?></b> de Kayıt Oldunuz. </span>
				<p style="float:right; margin-top: -18px;"><input type="submit" value="Değişiklikleri Kaydet" class="duzenlebut"></p>
				</p>
				</form>
</div>
<div class="buyukalt"></div>
<?php 

}else{bilgi("Bu Alan Sadece Öğrenciler İçindir !","Ulaşmak İstediğiniz Alana Sadece Öğrenci Üyeliği Erişebilir!!","bilgi");}} ?>
