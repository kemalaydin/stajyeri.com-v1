<?php if(!$_SESSION["oturum"]){
	Header("Location:index.php"	);
	}else{ ?>
	
	<!-- YENİLİKLER -->

		
		<!-- YENİLİKLER SON -->	
		<div class="sagbaslik">SON 5 MESAJINIZ</div>
		<div class="sonbascurular">
		
				
				<?php sonbesmesaj(); ?> 
			
	</div>
			<div class="buyukalt"></div>
		<div class="sagbaslik">İLANLARINIZ</div>
				<div class="sonbascurular">
				<?php ilanlarim(); ?> 
				</div>

						<div class="buyukalt"></div>

	
	<?php }?>