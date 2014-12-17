<?php
$fp = fopen(__DIR__."/msg.txt", "r");
$r = array();
$zeile = fgets($fp);
echo trim($zeile);
while(!feof($fp))
{
	$r[] = fgets($fp);
}
fclose($fp);
$fp = fopen(__DIR__."/msg.txt", "w");
foreach($r as $t)
{
	fputs($fp, $t);
}
fclose($fp);
?>