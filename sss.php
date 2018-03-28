<?php if($_SESSION["oturum"]){ ?>
<div class="sagbaslik">SIKÇA SORULAN SORULAR</div>
<div class="sss">
<ul style="padding:10px;">
<?php if($_SESSION["UyelikTuru"] == 1){ ?>
<li><b>1-) Stajyer-i.com 'a Üye Oldum Fakat Okulum Sistemde Yok </b></li>
<span> Stajyer-i.com, üyeliğiniz sürece yapacağınız işlemleri okul onayı ile birlikte yapacağı için kayıtlı olmayan okullara hizmet veremiyor.
Eğer okulunuz sistemimizde kayıtlı değil ise Destek Bildirimi veya İletişim bölümünden iletebilirsiniz.</span>
<br /><br />
<li><b>2-) Stajyer-i.com 'a Verdiğim T.C. Numarası Ne İçin Kullanılıyor ? </b></li>
<span> T.C. Kimlik numaranız işyerleri ve öğrenci güvenliği için gereklidir. Yapacağınız dosya  işlemlerinde T.C. Kimlik numaranız kullanılacaktır.
Bir diğer istenme amacı, gerçekliliğin kontrolüdür. Sistemden sahte hesapları uzak tutmak için kontrol yapılmaktadır.</span>
<br /><br /><li><b>3-) Staj Başvurumu Onayladım İlanlarım İptal Edildi Gözüküyor ? </b></li>
<span> Stajyer-i.com, işyeri giriş onayı verdiğiniz ilanlarınızdan sonra otomatik olarak sistemde kayıtlı olan diğer başvurularınızı sizin adınıza iptal eder. Bunlar geri alınamaz</span>
<br /><br /><li><b>4-) Üyeliğimle İlgili Bildirimler Mailime Gelmiyor ? </b></li>
<span> İlk önce Gereksiz/Junk klasörüne bakmanızı öneririz. Ardından tarafımıza bir Destek Bildirimi ( Genel Sorunlar ) açtığınız taktirde size gerekli dönüş yapılacaktır.</span>
<?php } ?>


<?php if($_SESSION["UyelikTuru"] == 2){ ?>
<li><b>1-) Stajyer-i.com 'a Farklı Departmanlardan Nasıl İlan eklerim ? </b></li>
<span> İşyerlerinin herhangi bir ilan sınırlaması yoktur. İsterseniz farklı dönemlere ait aynı ilanı bir kaç defa verebilirsiniz. Fakat aynı dönem ve aynı içeriğe sahip ilanlar moderatörlerimiz tarafından sistemden silinecektir.</span>
<br /><br />
<li><b>2-) Öğrenci İşyerine Gelmedi Ne Yapmalıyım ? </b></li>
<span> Koordinatör öğretmen işyerinize geldiği zaman  bu durumu ona bildirmelisiniz. Ayrıca sistemimizden okulu mesaj atarak bu durumu belirtebilirsiniz.</span>
<br /><br /><li><b>3-) Staj Başvurularını Onayladım Fakat Öğrenci Giriş Yapmadı ? </b></li>
<span> Stajyer-i.com, çalışma prensibi gereği öğrenci sizin ilanınıza başvurmuş olsa bile son onay kısmını öğrenciye gösterir. Öğrenci okul ve işyeri onayı aldıktan sonra kendi panelinden " Bu İşyerine Giriş Yap " butonuna tıklayarak onay verir. Böyle sistemde ki diğer başvurularo silinir ve " Stajyerlerim " alanında gözükmeye başlar. Bu durumda tarafınıza bir bilgi mesajı gönderilir</span>
<br /><br /><li><b>4-) Üyeliğimle İlgili Bildirimler Mailime Gelmiyor ? </b></li>
<span> İlk önce Gereksiz/Junk klasörüne bakmanızı öneririz. Ardından tarafımıza bir Destek Bildirimi ( Genel Sorunlar ) açtığınız taktirde size gerekli dönüş yapılacaktır.</span>
<?php } ?>
</ul></div>
<div class="buyukalt"></div>

<?php

}else{
Header("Location:index.php");
}

?>