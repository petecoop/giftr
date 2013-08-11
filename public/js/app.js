var app = angular.module('giftr', []);

app.controller('IndexController', function($scope, ProfileService, ProductService){

	$scope.profile = {
		age: "",
		gender: "",
		occasion: "gift",
		budget: ""
	};
	$scope.gotDetails = false;
	$scope.editDetails = function(){
		$scope.gotDetails = false;
	};

	$scope.products = [];

	$scope.submitProfile = function(){
		ProfileService.post($scope.profile).success(function(data){
			var profile = data.profile;
			console.log(data);
			$scope.profile.id = data.user_id;
			$scope.products = data.products;
		});
		$scope.gotDetails = true;
	};

	$scope.rate = function(rating, product){
		product[rating] = true;
		//post a taste rating
		ProductService.postRating({
			product_id: product.id,
			user_id: $scope.profile.id,
			rating: rating
		}).success(function(data){
			//get a new product back
			$scope.products.splice($scope.products.indexOf(product), 1);
			$scope.products.push(data);
		});
	};

});

app.factory('ProfileService', function($http){
	return {
		post: function(profile){
			return $http.post('/rest/profile', profile);
		}
	};
});

app.factory('ProductService', function($http){
	return {
		postRating: function(rating){
			return $http.post('/rest/rating', rating);
		}
	};
});

app.config(function($httpProvider){
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
});