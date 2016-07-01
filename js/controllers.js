angular.module('app.controllers', [])
  
.controller('homeCtrl', function($scope) {

})
   
.controller('parciaisCtrl', function($scope, $http) {
	$http({
	  method: 'GET',
	  url: '/api/time.php'
	}).then(function successCallback(response) {
		$scope.jogadores = response.data.atletas;
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
    
