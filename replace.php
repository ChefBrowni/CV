<?php


$csv = file_get_contents("asd12.csv");
$search = "|||";
$replace = ",";
$csv = preg_replace("/(^|\\s)$search(\\s|$)/si","\\1$replace\\2",$csv);
file_put_contents("asdjo.csv",$csv);

?>