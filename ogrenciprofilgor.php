	
	<!---- Oturum Kontrol --------->
	<?php if(!$_SESSION["oturum"]){
	Header("Location:../index.php"	);
	}else{ 
	
	$OgrenciID = $_GET["id"];
	
	$OgrenciSorgu = mysql_query("select * from ogrenci where id='$OgrenciID'");
	$OgrenciSay = mysql_num_rows($OgrenciSorgu);
	
	if($OgrenciSay > 0){
	$CikarOgrenciBilgi = mysql_fetch_array($OgrenciSorgu);
	extract($CikarOgrenciBilgi);
	?>

	
	<!--- Öğrenci Profil Alanı ---->	
	<div class="sagbaslik"><i> <?php echo $Ad.' '. $Soyad; ?> </i></div>
<div class="profilduzenle">	
			
				
				<li style="float: right; width: 125px; background-color: #E0EDF2; -moz-border-radius:5px;
-webkit-border-radius:5px;
border-radius:5px;
/*IE 7 AND 8 DO NOT SUPPORT BORDER RADIUS*/
"><span><img style="width:99px;height:99px;" src="<?php echo $Resim; ?>" style="float: left; margin: 5px; border: 1px solid #000; padding: 1px;" /><br /></span></li>
				<li style="height:20px;"><span> <b> Adı : </b></span> <?php echo $Ad; ?> </li>
				<li style="height:20px;"><span> <b> Soyadı : </b></span><?php echo $Soyad; ?></li>
				<li style="height:20px;"><span> <b> Doğum Tarihi :  </b> </span><?php echo $DogumTarihi; ?> </li>
				<li style="height:20px;"><span> <b> Cinsiyeti : </b></span><?php echo $Cinsiyet; ?></li>
						

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
				
				
				<li style="height:20px;"> <span> <b> Okulu : </b></span>  
				
				<?php 
				$SorguOkul = mysql_query("select * from okul where id='$OkulID'");
				$OkulCikarSorgu = mysql_fetch_array($SorguOkul);
				$Okul = $OkulCikarSorgu["OkulAdi"];
				echo $Okul; 
				?>
				
				 </li>
				
				<li style="height:20px;"><span> <b> Lise Türü : </b> 	</span>
				<?php 
				$SorguLiseTuru = mysql_query("select * from liseturu where id='$LiseTuru'");
				$TuruCikarSorgu = mysql_fetch_array($SorguLiseTuru);
				$LiseTuru = $TuruCikarSorgu["LiseTuru"];
				echo $LiseTuru; 
				?>
			
				
				</li>
				<li style="height:20px;"><span> <b> Bölümü : </b> </span>
				<?php 
				$BolumSorgu = mysql_query("select * from alanlar where id='$Bolum'");
				$BolumSorguCik = mysql_fetch_array($BolumSorgu);
				$alan = $BolumSorguCik["Alan"];
				echo $alan; 
				?>
				
				</li>
				
				<li style="height:20px;"><span> <b> Dalı : </b> 
				
				</span>
				
				<?php 
				$BolumSorgussa = mysql_query("select * from dallar where id='$Dal'");
				$BolumSorguCikssa = mysql_fetch_array($BolumSorgussa);
				$dal = $BolumSorguCikssa["Dal"];
				echo $dal; 
				?>
				</li>
				
				<li style="height:20px;"><span> <b> Hakkında : </b> </span><?php echo $Hakkinda; ?></li>
			<?php if($_SESSION["UyelikTuru"]==2 || $_SESSION["UyelikTuru"]==0){ ?><li style="height:20px;"><span> <b> Not Ortalaması : </b> </span><?php echo $NotOrtalamasi; ?></li><?php } ?>
				
				<?php if($_SESSION["UyelikTuru"] == 2 || $_SESSION["UyelikTuru"] == 0){ ?>
				<li style="height:20px;"><span><b>SSK No : </b></span><?php echo $SSKNo; ?></li>
				<li style="height:20px;"><span><b>SSK Giriş Tarihi : </b></span><?php echo $GirisTarihi; ?></li>
				<li style="height:20px;"><span><b>SSK Çıkış Tarihi : </b></span><?php echo $CikisTarihi; ?></li>	
				<?php } ?>
				
			
				
			
				<p style="padding: 7px;">Stajyer-i.com ' a <b><?php echo $KayitTarihi; ?></b> de Kayıt Olmuş. <?php if($_SESSION["UyelikTuru"]==2 || $_SESSION["UyelikTuru"]==0){ ?>  Disiplin Kaydı <?php  

					if($Disiplin > 0){
					echo '<b> YOK </b>';
					}else if(empty($Disiplin)){
					echo '<b> Henüz Sisteme Girilmemiş </b>';
					}else{
					echo '<b> VAR </b>';
					}
					}

				?>  <?php if($_SESSION["UyelikTuru"]==2 || $_SESSION["UyelikTuru"]==0){ ?>, Protez <?php  

					if($KullandigiProtez == 1){
					echo '<b> KULLANIYOR </b>';
					}else if(empty($KullandigiProtez)){
					echo 'Bilginiz <b>  Henüz Sisteme Girilmemiş </b>';
					}else{
					echo '<b> KULLANMIYOR </b>';
					}
					
				}
				?></p>
			<?php if($_SESSION["UyelikTuru"]==2){ ?>	<div class="yanitlabutton"><a href="#"> Stajyer Olarak Çağır</a></div><div class="yanitlabutton"><a href="mesajgonder/<?php echo $OgrenciID; ?>"> Mesaj Gönder </a></div></span> <?php } ?>
			<?php if($_SESSION["UyelikTuru"]==0 && $OkulID == $_SESSION[“uid”]){ ?>	<div class="yanitlabutton"><a href="index.php?git=ogrduzenleme&ogrid=<?php echo $OgrenciID; ?>"> Öğrenci Düzenle</a></div>
			<?php if($OkulOnay == 2 || $OkulOnay == 0){ ?><div class="yanitlabutton"><a href="index.php?git=uyelikonayla&ogrid=<?php echo $OgrenciID; ?>"> Hızlı Onayla </a></div><?php } ?></span> <?php } ?>
			
<div style="padding: 15px;"></div>				
</div>

<div class="buyukalt"></div>
<?php }else{
bilgi("Böyle Bir Öğrenci Yok.","Sistemimize Kayıtlı Böyle Bir Öğrenci Bulamadık");
}} ?>
