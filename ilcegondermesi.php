<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>fasdf</title>
</head>
<body>
	<?php
	$baglan=mysql_connect("localhost","stajyeri_stajyer","61189437") or die (mysql_error);
$db = mysql_select_db("stajyeri_stajyer",$baglan) or die (mysql_error);

mysql_query (" SET CHARACTER SET utf-8");

$ilce1 = $_POST["ilce1"];
$ilce2 = $_POST["ilce2"];
$ilce3 = $_POST["ilce3"];
$ilce4 = $_POST["ilce4"];
$ilce5 = $_POST["ilce5"];
$ilce6 = $_POST["ilce6"];
$ilce7 = $_POST["ilce7"];
$ilce8 = $_POST["ilce8"];
$ilce9 = $_POST["ilce9"];
$ilce10 = $_POST["ilce10"];
$ilce11 = $_POST["ilce11"];
$ilce12 = $_POST["ilce12"];
$ilce13 = $_POST["ilce13"];
$ilce14 = $_POST["ilce14"];
$ilce15 = $_POST["ilce15"];
$ilce16 = $_POST["ilce16"];
$ilce17 = $_POST["ilce17"];
$ilce18 = $_POST["ilce18"];
$ilce19 = $_POST["ilce19"];
$ilce20 = $_POST["ilce20"];

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
$il16 = $_POST["il16"];
$il17 = $_POST["il17"];
$il18 = $_POST["il18"];
$il19 = $_POST["il19"];
$il20 = $_POST["il20"];

$sq1 = mysql_query("insert into ilceler (il_id,ilce) values ('$il1','$ilce1')");
$sq2 = mysql_query("insert into ilceler (il_id,ilce) values ('$il2','$ilce2')");
$sq3 = mysql_query("insert into ilceler (il_id,ilce) values ('$il3','$ilce3')");
$sq4 = mysql_query("insert into ilceler (il_id,ilce) values ('$il4','$ilce4')");
$sq5 = mysql_query("insert into ilceler (il_id,ilce) values ('$il5','$ilce5')");
$sq6 = mysql_query("insert into ilceler (il_id,ilce) values ('$il6','$ilce6')");
$sq7 = mysql_query("insert into ilceler (il_id,ilce) values ('$il7','$ilce7')");
$sq8 = mysql_query("insert into ilceler (il_id,ilce) values ('$il8','$ilce8')");
$sq9 = mysql_query("insert into ilceler (il_id,ilce) values ('$il9','$ilce9')");
$sq10 = mysql_query("insert into ilceler (il_id,ilce) values ('$il10','$ilce10')");
$sq11 = mysql_query("insert into ilceler (il_id,ilce) values ('$il11','$ilce11')");
$sq12 = mysql_query("insert into ilceler (il_id,ilce) values ('$il12','$ilce12')");
$sq13 = mysql_query("insert into ilceler (il_id,ilce) values ('$il13','$ilce13')");
$sq14 = mysql_query("insert into ilceler (il_id,ilce) values ('$il14','$ilce14')");
$sq15 = mysql_query("insert into ilceler (il_id,ilce) values ('$il15','$ilce15')");
$sq16 = mysql_query("insert into ilceler (il_id,ilce) values ('$il16','$ilce16')");
$sq17 = mysql_query("insert into ilceler (il_id,ilce) values ('$il17','$ilce17')");
$sq18 = mysql_query("insert into ilceler (il_id,ilce) values ('$il18','$ilce18')");
$sq19 = mysql_query("insert into ilceler (il_id,ilce) values ('$il19','$ilce19')");
$sq20 = mysql_query("insert into ilceler (il_id,ilce) values ('$il20','$ilce20')");
if($sq1 && $sq2 && $sq3 && $sq4 && $sq5 && $sq6 && $sq7 && $sq10){
echo 'KAYIT BAŞARILI';
}else{
echo 'Kayıt yapılamadı';
}
echo'<a href="http://www.stajyer-i.com/ilcegirme.php">GERİ DÖN</a>';

	
	?>
</body>
</html>