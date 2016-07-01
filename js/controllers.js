angular.module('app.controllers', [])
  
.controller('homeCtrl', function($scope) {

})
   
.controller('parciaisCtrl', function($scope) {

})
   
.controller('ligasCtrl', function($scope, $http) {
	$http({
	  method: 'GET',
	  url: '/cartolou/api/liga.php'
	}).then(function successCallback(response) {
		$scope.times = response.data.times;
	});	
})
    