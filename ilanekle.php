<?php
if($_SESSION["oturum"]){
?> 
<script type="text/javascript">


$('#il').live('change', function(e){
                         var il = $('#il option:selected').attr("value");
                        $.ajax({
                        type: 'GET',
                        url: 'il.php',
                        data: 'il='+il,
                        success: function(msg) {
                            $("#ilKapsa").html(msg);
						
							}});
});
$('#alan').live('change', function(e){
                         var alan = $('#alan option:selected').attr("value");
                        $.ajax({
                        type: 'GET',
                        url: 'alan.php',
                        data: 'alan='+alan,
                        success: function(msg) {
                            $("#alanKapsa").html(msg);
						
							}});
});

	


</script>
<?php		if($_SESSION["UyelikTuru"] == 2){
		?>
		<?php if(date('d.m') != "01.07"){ ?>	
				<div class="sagbaslik">İLAN EKLE</div>
			<div class="ilandetayim">	

			<form action="ilanekleniyor/" method="post">
			<li style="height:20px;"><span><b> İlan Dönemi : </b></span><!-- <input type="text" name="StajDonemi" class="profilinp" value="" /> -->Yaz Dönemi ( 15.06.2012 - 15.09.2012 )</li>
			<li> <span><b>Staj Dönemi : </b></span><select name="stajdonemi" class="profilsel" style="width: 250px;">
			<option value="18 Haziran - 4 Temmuz ( 100 SAAT )">18 Haziran - 4 Temmuz ( 100 SAAT )</option>
			<option value="4 Temmuz - 20 Temmuz ( 100 SAAT )">4 Temmuz - 20 Temmuz ( 100 SAAT )</option>
			<option value="20 Haziran - 8 Ağustos ( 100 SAAT )">20 Haziran - 8 Ağustos ( 100 SAAT )</option>
			<option value="18 Haziran - 20 Temmuz (200 SAAT )">18 Haziran - 20 Temmuz ( 200 SAAT )</option>
			<option value="18 Haziran - 8 Ağustos (300 SAAT )">18 Haziran - 8 Ağustos ( 300 SAAT )</option>
			<option value="18 Haziran - 8 Ağustos ( HEPSİ )" selected>18 Haziran - 8 Ağustos ( HEPSİ )</option>
			</select></li>
			<li><span><b> İlan Başlık : </b></span><input type="text" name="IlanBaslik" class="profilinp" style="width: 250px;"/></li>
			<li><span><b> İlan Detay : </b></span><textarea rows="0" cols="0" class="profiltxt" style="height: 150px; width: 450px;" name="ilandetay"/></textarea></li>
			
			<!---<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'ilandetay',
					{
					
					extraPlugins : 'uicolor',
		toolbar : [ [ 'Bold', 'Italic','Underline' ,'-', 'NumberedList', 'BulletedList'  ], ],
		uiColor: '#1B646F',
					skin : 'kama'
					
					});

			//]]>
			</script> --->
            </li></ul><ul id="ilKapsa">
            		<li><span><b> İl : </b></span><select id="il" name="il" class="profilsel">
            
			<?php
			$IsAlani = mysql_query("select * from iller");
			$isid = $_SESSION["uid"];
			$IsyeriAdi = mysql_query("select * from isyeri where id = '$isid'");
			$IsyeriCikarsa = mysql_fetch_array($IsyeriAdi);
			while($ICikar = mysql_fetch_array($IsAlani)){
			if($IsyeriCikarsa["il"] == $ICikar["id"]){
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["il"].'</option>';
			}else{
			echo '<option value="'.$ICikar["id"].'">'.$ICikar["il"].'</option>';
			}
			}
			
			?>
			</select></li>
                		<li><span><b> İlçe : </b></span><select name="ilce" class="profilsel">
            
			<?php
			$IsAlani = mysql_query("select * from ilceler");
			$isid = $_SESSION["uid"];
			$IsyeriAdi = mysql_query("select * from isyeri where id = '$isid'");
			$IsyeriCikarsa = mysql_fetch_array($IsyeriAdi);
			while($ICikar = mysql_fetch_array($IsAlani)){
			if($IsyeriCikarsa["ilce"] == $ICikar["id"]){
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["ilce"].'</option>';
			}else{
			echo '<option value="'.$ICikar["id"].'">'.$ICikar["ilce"].'</option>';
			}
			}
			
			?>
			</select></li></ul><ul id="alanKapsa">
			<li><span><b> İş Alanı : </b></span><select id="alan" name="isalani" class="profilsel">
            
			<?php
			$IsAlani = mysql_query("select * from alanlar");
			$isid = $_SESSION["uid"];
			$IsyeriAdi = mysql_query("select * from isyeri where id = '$isid'");
			$IsyeriCikarsa = mysql_fetch_array($IsyeriAdi);
			while($ICikar = mysql_fetch_array($IsAlani)){
			if($IsyeriCikarsa["IsAlani"] == $ICikar["id"]){
		    $alann = $ICikar['IsAlani'];
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["Alan"].'</option>';
			}else{
			echo '<option value="'.$ICikar["id"].'">'.$ICikar["Alan"].'</option>';
			}
			}
			
			?>
			</select></li>
            		<li><span><b> İş Dalı : </b></span><select name="isdal" class="profilsel">
       
			<?php
			$suankiDal = $IsyeriCikarsa['IsAlani'];
			
			$IsAlani = mysql_query("select * from dallar where alanID='$suankiDal'");
			$isid = $_SESSION["uid"];	
			while($ICikar = mysql_fetch_array($IsAlani)){
			echo '<option value="'.$ICikar["id"].'" selected>'.$ICikar["Dal"].'</option>';

		
			}
			
			?>
			</select></li></ul><ul>
            			<li><span><b> İşyeri Adres : </b></span><textarea rows="0" cols="0" class="profiltxt" style="height: 75px; width: 450px;" name="isadres"><?php 
						$adres = mysql_fetch_array(mysql_query("select * from isyeri where id='$isid'"));
						echo $adres['Adres'];
						
						?></textarea></li>
			<li><span><b>Alınacak Stajyer Sayısı : </b></span><input type="number" name="alinacakstajyer" value="1" min="1" class="profilinp"/></li>
			
			
		
			<li><p><input type="checkbox" name="kural" value="1" checked/><a href="javascript:void(0)" id="sifreDuzenle"> Stajyer Talep Kurallarını Okudum ve Kabul Ediyorum. ( Okumak İçin Tıklayın )</p></li>		
				<div class="sifre" style="overflow:auto;">
				 <script type="text/javascript">
				$(document).ready(function(){
				$("#sifreDuzenle").click(function(){
				$(".sifre").slideToggle('slow');
					});
				});</script>
				<p style="display:block; margin: 7px;"><b> Stajyer Talep Kuralları ; </b>
				<p style="display:block; margin: 7px;">1.) İşletme tarafından verilen ilanların iptal edilme durumu söz konusu olmamakla birlikte doğabilecek sorunlardan tarafımızca sorumluluk kabul edilmez.</p>
				<p style="display:block; margin: 7px;">2.) Kullanıcılar tarafından tarafımıza gelen sorunlar olması halinde ilgili işletme neden sorulmaksızın kalıcı olarak engellenecektir.</p>
				<p style="display:block; margin: 7px;">3.) İşletmeler başvuruda belirttiği sayıda stajyeri alma zorunluluğundadır. Belirtilen kontejyan dolmadan ilanın kaldırılması hiçbir türlü söz konusu olamaz.</p>
				<p style="display:block; margin: 7px;">4.) İşletme ile Stajyer arasında oluşan olumsuz durumlarda (devamsızlık, uyum sorunu vb.) işletme sahibinin tarafımıza ve stajyerin bağlı bulunduğu okulun yetkilisine haber vermesi gerekmektedir.</span>
				<p style="display:block; margin: 7px;">5.) Vereceğiniz ilanlar 15 Haziran 2011 tarihine kadar yayında kalacaktır.</p>

			
				
				</div>

			<p STYLE="float:right;"><input type="submit" value="STAJYER TALEBİ OLUŞTUR" class="duzenlebut">
		
			</li></ul>
			</form>
			<div style="clear:both;"></div>
			</div>
			<div class="buyukalt"></div>
		<?php
		}else{
		bilgi("Stajyer Talep Dönemi Sona Ermiştir.","Stajyer Taleplerinizi En Geç 01 Temmuz Tarahine Kadar Yapabilirsiniz.","bilgi");
		
		} }else{
		Header("Location:../index.php"	);
		}

	}else{
	Header("Location:../index.php"	);
	}
?>
