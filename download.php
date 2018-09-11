<?php


$url = "www.computeremporium.hu/datafeed/?file=fel.csv&user=frektan&pass=Fvt07Xr1&query=teljes_minden&format=csv" ;
 
$file = $url;
$ch = curl_init($file);
$fp = @fopen("asd12.csv", "w");
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);
$file = "temp.csv";
$fp = fopen($file, "r");



?>