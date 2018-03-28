<?php if(!$_SESSION["oturum"]){
	Header("Location:../index.php"	);
	}else{ ?>
	
	<!-- YENİLİKLER -->
		
		<div class="sagbaslik">ONAY BEKLEYEN ÖĞRENCİLER ( İLK 10 )</div>
		<div class="sonbascurular">
		<?php okuldanonaybek(); ?>
		
		</div>
		<div class="buyukalt"></div>
		<div class="sagbaslik">SON 5 MESAJ</div>
		<div class="sonbascurular">
		<?php sonbesmesaj(); ?> 
		
		</div>
		<div class="buyukalt"></div>
		
	<div class="sagbaslik">İŞ GİRİŞİ BEKLEYEN ÖĞRENCİLER ( İLK 10 )</div>
	<div class="sonbascurular">
	<?php isgirisbekleyen(); ?> 
		
	</div>
	<div class="buyukalt"></div>
	
	<?php }?>
	
	
