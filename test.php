<?php
 
$dosya_adi="dosya.xml";
 
if (file_exists($dosya_adi))
{
echo "Dosya zaten var!";
}
else
 
{
touch($dosya_adi);
echo "Dosya oluşturuldu.";
}
 
?>