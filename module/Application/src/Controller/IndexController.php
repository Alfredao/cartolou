<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
	
	public function ligaAction()
	{
		$container = new \Zend\Container\Session();
		$slug = 'bbx-champions-league';
		
		
		// LOGIN
		header('Access-Control-Allow-Origin: *');  
		header('Content-type: application/json');

		if (! $container->offSetExists('glbId')) {			
			$email = getenv('email');
			$password = getenv('senha');
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
			  //echo $result;
			}

			curl_close($c);

			$parseJson = json_decode($result, TRUE);
			$container->glbId = $parseJson['glbId'];
			
		}
		
		// $orderBy: campeonato, turno, mes, rodada, patrimonio
		$orderBy = "";
		//if (isset($_GET["orderBy"]) && $_GET["orderBy"] != "") {
		//	$orderBy = "?orderBy=" . $_GET["orderBy"];
		//}
		
		// $page: 1, 2, 3...
		$page = "";
		//if (isset($_GET["page"]) && $_GET["page"] != "") {
		//	if (! array_key_exists("orderBy", $_GET)) {
		//		$page = "?page=" . $_GET["page"];
		//	} else {
		//		$page = "&page=" . $_GET["page"];
		//	}
		//}
		
		$url = "https://api.cartolafc.globo.com/auth/liga/" . $slug . $orderBy . $page;

		
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
		
		echo $result;
		exit;
	}
}
