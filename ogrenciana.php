<?php if(!$_SESSION["oturum"]){
	Header("Location:index.php"	);
	}else{ ?>
	
	<!-- YENİLİKLER -->
		
		<div id="slider">
		

		<a href="#"><img src="Slide/2.png" width="667" height="200" alt="" /></a>
		<a href="#"><img src="Slide/1.png" width="667" height="200" alt="" /></a>
		<?php /* sliderreklam(); */?>
	
		</div>
		<div style="margin-top: 10px;"></div>
		<div class="sagbaslik">BAŞVURULARINIZ</div>
		<div class="sonbascurular">
		<?php basvurulistana(); ?>
		
		</div>
		<div class="buyukalt"></div>
				<div class="sagbaslik">BAŞVURABİLECEĞİNİZ ŞİRKETLER</div>
		<div class="sonbascurular">
	<?php basvurulabil(); ?> 
		
		</div>
		<div class="buyukalt"></div>
	
	<?php }?>
	
	
