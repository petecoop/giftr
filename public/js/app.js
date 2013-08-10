var app = angular.module('giftr', []);

app.controller('IndexController', function($scope, ProfileService, ProductService){

	$scope.profile = {
		age: "",
		gender: "",
		occasion: "",
		budget: ""
	};

	$scope.products = [];

	$scope.submitProfile = function(){
		ProfileService.post($scope.profile).success(function(data){
			var profile = data.profile;
			$scope.profile.id = data.profile.id;
			$scope.products = data.products;
		});
	};

	$scope.rate = function(rating, id){
		//post a taste rating
		ProductService.postTaste({
			id: id,
			rating: rating,
			user: $scope.profile.id
		}).success(function(data){
			//get a new product back
			$scope.products.push(data);
		});
	};

});

app.factory('ProfileService', function($http){
	return {
		post: function(profile){
			return $http.post('/rest/profile', profile, {headers : {'Content-Type': 'application/x-www-form-urlencoded'}});
		}
	};
});

app.factory('ProductService', function($http){
	return {
		postTaste: function(taste){
			return $http.post('/rest/taste', taste);
		}
	};
});

// app.config(function($httpProvider){
// 	$httpProvider.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded';

// });