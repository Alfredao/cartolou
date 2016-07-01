<?php
namespace API;

require_once('init.php');

$container = new \Zend\Session\Container();

if (! $container->offSetExists('glbId')) {			
	$email     = getenv('email');
	$password  = getenv('senha');
	$serviceId = 4728;

	$url = 'https://login.globo.com/api/authentication';

	$jsonAuth = array(
		'payload' => array(
		  'email' => $email,
		  'password' => $password,
		  'serviceId' => $serviceId
		)
	);

	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($c, CURLOPT_POST, true);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($jsonAuth));

	$result = curl_exec($c);

	if ($result === FALSE) {
		die(curl_error($c));
	} else {
// 			  echo $result;
	}

	curl_close($c);

	$parseJson = json_decode($result, TRUE);
	$container->glbId = $parseJson['glbId'];
}