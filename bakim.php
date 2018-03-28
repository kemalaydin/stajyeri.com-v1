<?php
session_start(); // Session Başlatma 
ob_start();



require ("sistem/baglan.php"); // baglan.php dosyası çağır
require ("sistem/sistem.php");  // sistem.php dosyası çağır

if ($site_durumu){ Header("Location:../index.php");}
else{ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Stajyer-i.com Bakımda</title>
	<link rel="stylesheet" type="text/css" href="../styles/bakimcss.css" media="all" />
</head>
<body>
	<img src="../img/bakim.png" alt="Sistem Bakımda" title="Sistem Bakımda" />
	<h1 class="hasbir">Stajyer-i.com Kısa Bir Süreliğine Bakımda</h1>
	<h3>En Kısa Sürede Tekrar Yayında Olacaktır</h3>
	<p>2012 / 2013 Eğitim Yılın İçin Hazırlık Çalışmaları.</p><br/>
	<span> bilgi @ stajyer-i.com </span>
</body>
</html>

<?php }
ob_end_flush(); ?>