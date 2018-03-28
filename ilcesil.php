<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
</head>
<body>
	<?php 
	$baglan=mysql_connect("localhost","root") or die (mysql_error);
	$db = mysql_select_db("stajyeri",$baglan) or die (mysql_error);

	$Ilce = $_GET["git"];
	echo $Ilce;
	mysql_query("DELETE FROM ilceler WHERE id='$Ilce'");

	?>
</body>
</html>