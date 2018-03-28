	
	<!---- Oturum Kontrol --------->
	<?php if(!$_SESSION["oturum"]){
	Header("Location:../index.php"	);
	}else{ 
	
	$IsyeriID = $_GET["id"];
	
	$OgrenciSorgu = mysql_query("select * from isyeri where id='$IsyeriID'");
	$OgrenciSay = mysql_num_rows($OgrenciSorgu);
	
	if($OgrenciSay > 0){
	$CikarOgrenciBilgi = mysql_fetch_array($OgrenciSorgu);
	extract($CikarOgrenciBilgi);
	?>

	
	<!--- Öğrenci Profil Alanı ---->	
	<div class="sagbaslik"><?php echo $IsyeriAdi; ?> </div>
<div class="profilduzenle">	
				
				<li style="float: right; width: 125px; background-color: #E0EDF2; -moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;">
				<span><img style="width:99px;height:99px;" src="<?php echo $Resim; ?>" style="float: left; margin: 5px; border: 1px solid #000; padding: 1px;" /><br /></span></li>
				<li style="height:20px;"><span> <b>Yetkili Adı : </b></span> <?php echo $Ad; ?> </li>
				<li style="height:20px;"><span> <b>Yetkili Soyadı : </b></span><?php echo $Soyad; ?></li>
				<li style="height:20px;"><span> <b>Telefon :  </b> </span><?php echo $Telefon; ?> </li>
				<li style="height:20px;"><span> <b>Fax : </b></span><?php echo $Fax; ?></li>
				<li style="height:20px;"><span> <b>Adres : </b></span><?php echo $Adres; ?></li>
						

				<li style="height:20px;"><span> <b> İl : </b> 
				
				</span>
				<?php 
				$SorguIl = mysql_query("select * from iller where id='$il'");
				$SogruCikar = mysql_fetch_array($SorguIl);
				$ils = $SogruCikar["il"];
				echo $ils;  ?> 
				</li>
				<li style="height:20px;"><span> <b> İlçe : </b> 
				
				</span><?php 
				$SorguIlce = mysql_query("select * from ilceler where id='$ilce'");
				$SogruceCikar = mysql_fetch_array($SorguIlce);
				$ilces = $SogruceCikar["ilce"];
				echo $ilces;  ?> </li>
				
				
				
				
				<li style="height:20px;"><span> <b> İş Alanı : </b> 	</span>
				<?php 
				$SorguLiseTuru = mysql_query("select * from alanlar where id='$IsAlani'");
				$TuruCikarSorgu = mysql_fetch_array($SorguLiseTuru);
				$LiseTuru = $TuruCikarSorgu["Alan"];
				echo $LiseTuru; 
				?>
			
				
				</li>
				<?php if($_SESSION["UyelikTuru"]==0){ ?>
				<li style="height:20px;"><span> <b>Vergi No :  </b> </span><?php echo $VergiNo; ?> </li>

				<?php } ?>
			
				
			
				<p style="padding: 7px;">Stajyer-i.com ' a <b><?php echo $KayitTarihi; ?></b> de Kayıt Olmuş. 
			<?php if($_SESSION["UyelikTuru"]==1){ ?>	<span><div class="yanitlabutton"><a href="ilanlarinabak/<?php echo $IsyeriID; ?>"> İlanlarına Bak </a></div><div class="yanitlabutton"><a href="sirketmesaj/<?php echo $IsyeriID; ?>"> Mesaj Gönder </a></div></span> <?php } ?>
				</p>
			<div style="padding: 15px;"></div>			
</div>
	
<div class="buyukalt"></div>
<?php }else{
bilgi("Böyle Bir Öğrenci Yok.","Sistemimize Kayıtlı Böyle Bir Öğrenci Bulamadık");
}} ?>