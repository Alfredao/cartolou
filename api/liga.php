<?php
namespace API;

require_once('init.php');

$container = new \Zend\Session\Container();

if (! $container->offSetExists('glbId')) {			
	require_once('login.php');	
}

// $orderBy: campeonato, turno, mes, rodada, patrimonio
// $page: 1, 2, 3...

$slug      = 'bbx-champions-league';

$url = "https://api.cartolafc.globo.com/auth/liga/" . $slug . "orderBy=rodada";


$c = curl_init();

curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_HTTPHEADER, array(
	'X-GLB-Token: ' . $container->glbId
));
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($c, CURLOPT_FRESH_CONNECT, TRUE);
curl_setopt($c, CURLOPT_VERBOSE, TRUE);

$result = curl_exec($c);

if ($result === FALSE) {
	die(curl_error($c));
}

curl_close($c);

header('Content-Type: application/json');
echo $result;
exit;