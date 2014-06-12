'use strict';

var nswm = angular.module('nswm', []);
/* factory */
nswm.factory('dataService', function($http){
	return{
		getData: function(result){
			$http({method: 'GET', url: '../data.php'}).success(result);
		}
	}
	
});
/* Controllers */
nswm.controller('formList', function($scope, dataService){
	$scope.hometowns = [{'name':'N/A'}];
	$scope.schools = [{'name':'N/A'}];
	$scope.majors = [{'name':'N/A'}];
	dataService.getData(function(data){
		$scope.hometowns = data.hometowns;
		$scope.schools = data.schools;
		$scope.majors = data.majors;
	});
});