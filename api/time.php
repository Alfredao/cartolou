<?php
namespace API;

require_once('init.php');

$slug = 'alfredoviski';

$url = "https://api.cartolafc.globo.com/time/" . $slug;

$c = curl_init();

curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($c, CURLOPT_FRESH_CONNECT, TRUE);
curl_setopt($c, CURLOPT_URL, $url);

$result = curl_exec($c);

curl_close($c);
	
header('Content-Type: application/json');
echo $result;
exit;