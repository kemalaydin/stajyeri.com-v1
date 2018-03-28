<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>İlçe Veri Tabanı Oluştur</title>
	<style>
	span {display: block;}
	#sol {float: left; width: 40%;}
	#sag {floar: right; }
	li{display: block; border-bottom: 1 px dotted #ccc;}
	</style>
</head>
<body>
	<?php

$baglan=mysql_connect("localhost","root") or die (mysql_error);
$db = mysql_select_db("stajyeri",$baglan) or die (mysql_error);

mysql_query (" SET CHARACTER SET utf-8");

if($_POST){
$il1 = $_POST["il1"];
$il2 = $_POST["il2"];
$il3 = $_POST["il3"];
$il4 = $_POST["il4"];
$il5 = $_POST["il5"];
$il6 = $_POST["il6"];
$il7 = $_POST["il7"];
$il8 = $_POST["il8"];
$il9 = $_POST["il9"];
$il10 = $_POST["il10"];
$il11 = $_POST["il11"];
$il12 = $_POST["il12"];
$il13 = $_POST["il13"];
$il14 = $_POST["il14"];
$il15 = $_POST["il15"];


$ekle1 = mysql_query("insert into isalani (IsAlani) values ('$il1')");
$ekle12 = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il2')");
$ekle13 = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il3')");
$ekle14 = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il4')");
$ekle15= mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il5')");
$ekle1s = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il6')");
$ekle1sa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il7')");
$ekle1asd = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il8')");
$ekle1aa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il9')");
$ekle1wqaaa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il10')");
$ekle1aewaa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il11')");
$eklqwe1aaa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il12')");
$eklewqe1aaa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il13')");
$ekle1aeqaa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il14')");
$ekeqwle1aaa = mysql_query("INSERT INTO isalani (IsAlani) VALUES ('$il15')");
if($ekle1){
echo "Eklendi";
Header("Location: /ilcegir.php");
}else{
echo "eklenemedi";
}


}else{
?>
<div id="sol">
<center>
<form action="" method="post">
<span> İL İD : <input type="text" name="il1" />  </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il2" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il3" />   </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il4" />  </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il5" />  </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il6" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il7" />  </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il8" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il9" />  </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il10" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il11" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il12" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il13" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il14" /> </span>
<hr width="80%" color="#000" size="1">
<span> İL İD : <input type="text" name="il15" /> </span>

<span> <input type="submit" value="Gönder"> </span>
<hr width="100%" color="#ccc" size="2"><hr width="100%" color="#ccc" size="2">
</form>
</center>
</div>
<div id="sag">
<h1> Eklenen Son 15 İlçe ve İl ID leri </h1>
<?php 
$IlceSorgu = mysql_query("SELECT * FROM isalani ORDER BY id DESC LIMIT 0,15");
while($ilce = mysql_fetch_array($IlceSorgu)){
echo '<li> + '.$ilce["IsAlani"].' - '.$ilce["id"].'</li>';
}
?>
</div>
<?php } ?>
</body>
</html>
<?php ob_flush(); ?>
