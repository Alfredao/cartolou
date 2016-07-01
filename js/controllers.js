angular.module('app.controllers', [])
  
.controller('homeCtrl', function($scope) {

})
   
.controller('parciaisCtrl', function($scope, $http) {
	$http({
	  method: 'GET',
	  url: '/api/time.php'
	}).then(function successCallback(response) {
		var atletas = response.data.atletas;
		var foto;
		for (i in atletas) {
			foto = atletas[i].foto
			atletas[i].foto = foto.replace('FORMATO', '50x50');
		}
		$scope.jogadores = atletas;
	});	
})
   
.controller('ligasCtrl', function($scope, $http) {
	$http({
	  method: 'GET',
	  url: '/api/liga.php'
	}).then(function successCallback(response) {
		$scope.times = response.data.times;
	});	
})
    
