<?php require("sistem/baglan.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>dsadasd</title>
</head>
<body>
<?php 

if($_POST){
$d1 = $_POST["lisetur1"];
$d2 = $_POST["lisetur2"];
$d3 = $_POST["lisetur3"];
$d4 = $_POST["lisetur4"];
$d5 = $_POST["lisetur5"];
$d6 = $_POST["lisetur6"];
$d7 = $_POST["lisetur7"];
$d8 = $_POST["lisetur8"];
$d9 = $_POST["lisetur9"];
$d10 = $_POST["lisetur10"];
$d11 = $_POST["lisetur11"];
$d12 = $_POST["lisetur12"];
$d13 = $_POST["lisetur13"];

$verigon = mysql_query("insert into liseturu (LiseTuru) values ('$d1') ");
$verigon2 = mysql_query("insert into liseturu (LiseTuru) values ('$d2') ");
$verigon3 = mysql_query("insert into liseturu (LiseTuru) values ('$d3') ");
$verigon4 = mysql_query("insert into liseturu (LiseTuru) values ('$d4') ");
$verigon5 = mysql_query("insert into liseturu (LiseTuru) values ('$d5') ");
$verigon6 = mysql_query("insert into liseturu (LiseTuru) values ('$d6') ");
$verigon7 = mysql_query("insert into liseturu (LiseTuru) values ('$d7') ");
$verigon8 = mysql_query("insert into liseturu (LiseTuru) values ('$d8') ");
$verigon9 = mysql_query("insert into liseturu (LiseTuru) values ('$d9') ");
$verigon10 = mysql_query("insert into liseturu (LiseTuru) values ('$d10') ");
$verigon11 = mysql_query("insert into liseturu (LiseTuru) values ('$d11') ");
$verigon12 = mysql_query("insert into liseturu (LiseTuru) values ('$d12') ");
$verigon13 = mysql_query("insert into liseturu (LiseTuru) values ('$d13') ");


}else{ ?>
<form action="" method="post">
<input type="text" name="lisetur1" />
<input type="text" name="lisetur2" />
<input type="text" name="lisetur3" />
<input type="text" name="lisetur4" />
<input type="text" name="lisetur5" />
<input type="text" name="lisetur6" />
<input type="text" name="lisetur7" />
<input type="text" name="lisetur8" />
<input type="text" name="lisetur9" />
<input type="text" name="lisetur10" />
<input type="text" name="lisetur11" />
<input type="text" name="lisetur12" />
<input type="text" name="lisetur13" />
<input type="submit" />
</form>
<?php } ?>
</body>
</html>