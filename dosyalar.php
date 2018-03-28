<?php if($_SESSION["oturum"]){ ?>
<div class="sagbaslik">DOSYALAR</div>
<div class="sonbascurular">
<ul style="padding:10px;">
Bekleyen Bir Dosyanız Yok</ul></div>
<div class="buyukalt"></div>

<?php

}else{
Header("Location:index.php");
}

?>