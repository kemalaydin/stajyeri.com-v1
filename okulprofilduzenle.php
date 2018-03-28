	
	<!---- Oturum Kontrol --------->
	<?php if(!$_SESSION["oturum"]){
	Header("Location:index.php"	);
	}else{ 
	//<!---- Üyelik Türü Öğrenci İse ---->
	if($_SESSION["UyelikTuru"] == "0"){
		$idsi = $_SESSION["uid"];
		$bilgilericek = mysql_query("select * from okul where id = '$idsi'");
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
		

		</script>
		
	<!--- Öğrenci Profil Alanı ---->	
		<div class="sagbaslik">Profilim (<i> <?php echo $OkulAdi; ?> </i>)</div>
<div class="profilduzenle">	
				<form action="index.php?git=okulprofilguncelle" method="post">
				<li style="float: right; width: 125px; background-color: #E0EDF2; -moz-border-radius:5px;
-webkit-border-radius:5px;
border-radius:5px;
/*IE 7 AND 8 DO NOT SUPPORT BORDER RADIUS*/
"><span><img src="<?php echo $Resim; ?>" style="float: left; margin: 5px; border: 1px solid #000; padding: 1px;" /><br /><input type="file" name="asd" class="profilinpsa"></span></li>
				<li><span> <b> Okul Adı : </b></span> <?php echo $OkulAdi; ?> </li>
				<li><span> <b> Yetkili Adı : </b></span> <input type="text" value="<?php echo $Ad; ?>" name="Ad" class="profilinp"/> </li>
				<li><span> <b> Yetkili Soyadı : </b></span><input type="text" value="<?php echo $Soyad; ?>" name="Soyad" class="profilinp"/></li>
				<li><span> <b> Ünvan : </b> </span><select name="Unvan" class="profilsel">
						<?php if($Cinsiyet=="BasMudurYardimcisi"){echo '<option value="BasMudurYardimcisi" selected>Baş Müdür Yardımcısı</option><option value="MudurYardimcisi">Müdür Yardımcısı</option>';}else if ($Cinsiyet=="MudurYardimcisi"){
						echo '<option value="BasMudurYardimcisi">Baş Müdür Yardımcısı</option><option value="MudurYardimcisi" selected>Müdür Yardimcisi</option>';
						}else{
						echo '<option disabled="disabled">SEÇİNİZ</option><option value="BasMudurYardimcisi">Baş Müdür Yardımcısı</option><option value="MudurYardimcisi">Müdür Yardımcısı</option>';
						}?>
				</select> </li>
				<li><span> <b> Lise Türü :  </b> </span>
				<?php
				// Lise Türlerini Çek ( Daha Önceden Var ise )
				$sesid = $_SESSION["uid"];
				$OkulSorgusu = mysql_query("select * from okul where id = '$sesid'");
				$OkulCikarTuru = mysql_fetch_array($OkulSorgusu);
				$LiseTuruVarmi = $OkulCikarTuru["LiseTuru"];
				if(empty($LiseTuruVarmi)){

				}else{ 
					$parcala = explode(",",$LiseTuruVarmi);
					foreach($parcala as $liseturu){
					echo '<span class="yigit" style="display:none;">'.$liseturu.'</span>';
				}
				} ?>
				
				<input type="checkbox" name="LiseTuru[]"  value="1" /> Anadolu Teknik Lisesi <br />
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="2" <?php if($liseturu[1] == 2){echo 'checked';} ?>/> Ticaret Meslek Lisesi </p> 
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="3" /> Endüstri Meslek Lisesi </p> 
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="4" /> Kız Meslek Lisesi </p>
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="5" /> Anadolu Meslek Lisesi </p>
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="6" /> Anadolu Ticaret Meslek Lisesi </p>
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="7" /> Anadolu Kız Meslek Lisesi </p> 
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="8" /> Kız Teknik Lisesi </p>
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="9" /> Anadolu Kız Teknik Lisesi </p> 
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="10" /> Anadolu Otelcilik Ve Turizm Meslek Lisesi </p> 
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="11" /> Anadolu İletişim Meslek Lisesi </p>
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="12" /> Anadolu Tapu Ve Kadastro Meslek Lisesi </p>
				<p style="margin-left: 160px;"><input type="checkbox" name="LiseTuru[]" value="13" /> Teknik Lise </p>
				
				</li>
				<li><span> <b> Mail : </b> </span><input type="text" value="<?php echo $Mail; ?>" name="Mail" class="profilinp"/> </li>			
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
			<li><span> <b> Kurum Kodu : </b> </span><input type="text" value="<?php echo $KurumKodu; ?>" name="KurumKodu" class="profilinp"/> </li>			
			<li><span> <b> Fax : </b> </span><input type="text" value="<?php echo $Fax; ?>" name="Fax" class="profilinp"/> </li>			
			<li><span> <b> Web Sayfası : </b> </span><input type="text" value="<?php echo $WebSayfasi; ?>" name="WebSayfasi" class="profilinp"/> </li>			
			<li><span> <b> Kurum Müdürü : </b> </span><input type="text" value="<?php echo $KurumMuduru; ?>" name="KurumMuduru" class="profilinp"/> </li>			
			<li><span> <b> Sigorta Sicil No : </b> </span><input type="text" value="<?php echo $SigortaSicilNo; ?>" name="SigortaSicilNo" class="profilinp"/> </li>			
				
				
			
			<br/>
				<a style="margin-left: 15px;" href="javascript:void(0)" id="sifreDuzenle"><b>[ Şifre Değiştir ]</b></a>
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
			
				<p style="padding: 7px;">Stajyer-i.com ' a <b><?php echo $KayitTarihi; ?></b> de Kayıt Oldunuz.</p>
				
				<p style="float:right;margin-right:5px"><input type="submit" value="Değişiklikleri Kaydet" class="duzenlebut"></p>
			
				</form><div style="clear:both"></div>
</div>
<div class="buyukalt"></div>
<?php 

}else{bilgi("Bu Alan Sadece Okullar İçindir !","Ulaşmak İstediğiniz Alana Sadece Okul Üyeliği Erişebilir!!","bilgi");}} ?>
