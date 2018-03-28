<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>İlçe Girme Ekranı</title>
</head>
<body>
	<?php
		$baglan=mysql_connect("localhost","stajyeri_stajyer","61189437") or die (mysql_error);
$db = mysql_select_db("stajyeri_stajyer",$baglan) or die (mysql_error);

mysql_query (" SET CHARACTER SET utf-8");
?>
<div style="float: left; width:500px; background-color: #ccc; border: 1px dotted #333; margin-right: 7px;">
<h1> soldaki kutucuk ilçe adı, sağdaki kutucu il id si </h1>
<form action="ilcegondermesi.php" method="post">
<input type="text" name="ilce1" value="" style="float: left;"/> 
<input type="text" name="il1" value="" style="display:block;"/><br/>
<input type="text" name="ilce2" value="" style="float: left;"/>
<input type="text" name="il2" value="" style="display:block;"/><br/>
<input type="text" name="ilce3" value="" style="float: left;"/>
<input type="text" name="il3" value="" style="display:block;"/><br/>
<input type="text" name="ilce4" value="" style="float: left;"/>
<input type="text" name="il4" value="" style="display:block;"/><br/>
<input type="text" name="ilce5"  value="" style="float: left;"/>
<input type="text" name="il5" value="" style="display:block;"/><br/>
<input type="text" name="ilce6" value="" style="float: left;"/>
<input type="text" name="il6" value="" style="display:block;"/><br/>
<input type="text" name="ilce7" value="" style="float: left;"/>
<input type="text" name="il7" value="" style="display:block;"/><br/>
<input type="text" name="ilce8" value="" style="float: left;"/>
<input type="text" name="il8" value="" style="display:block;"/><br/>
<input type="text" name="ilce9" value="" style="float: left;"/>
<input type="text" name="il9" value="" style="display:block;"/><br/>
<input type="text" name="ilce10" value="" style="float: left;"/>
<input type="text" name="il10" value="" style="display:block;"/><br/>
<input type="text" name="ilce11" value="" style="float: left;"/>
<input type="text" name="il11" value="" style="display:block;"/><br/>
<input type="text" name="ilce12" value="" style="float: left;"/>
<input type="text" name="il12" value="" style="display:block;"/><br/>
<input type="text" name="ilce13" value="" style="float: left;"/>
<input type="text" name="il13" value="" style="display:block;"/><br/>
<input type="text" name="ilce14" value="" style="float: left;"/>
<input type="text" name="il14" value="" style="display:block;"/><br/>
<input type="text" name="ilce15" value="" style="float: left;"/>
<input type="text" name="il15" value="" style="display:block;"/><br/>
<input type="text" name="ilce16" value="" style="float: left;"/>
<input type="text" name="il16" value="" style="display:block;"/><br/>
<input type="text" name="ilce17" value="" style="float: left;"/>
<input type="text" name="il17" value="" style="display:block;"/><br/>
<input type="text" name="ilce18" value="" style="float: left;"/>
<input type="text" name="il18" value="" style="display:block;"/><br/>
<input type="text" name="ilce19" value="" style="float: left;"/>
<input type="text" name="il19" value="" style="display:block;"/><br/>
<input type="text" name="ilce20" value="" style="float: left;"/>
<input type="text" name="il20" value="" style="display:block;"/><br/>
<input type="submit" value="Gönder" />
</form>
</div>
<div style="float:left; width: 600px; background-color: #ccc;">
<center><h1> Son 20 Kayıt </h1></center>
<?php 
$sors = mysql_num_rows(mysql_query("select * from ilceler"));
if($sors > 0){
$ilcelericikar = mysql_query("select * from ilceler order by id desc limit 0,20");
	while($cikcik = mysql_fetch_array($ilcelericikar)){
	echo '<li style="padding: 2px; list-style-type:none;">'.$cikcik["id"].'-'.$cikcik["ilce"].'</li>'; 
	}
}else{
echo "HENÜZ İLÇE GİRİLMEMİŞ";
}
?>

</div>

</body>
</html>