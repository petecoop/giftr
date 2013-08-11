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

	$scope.products = [
        {
            "id": "1",
            "name": "Inflatable Palm Tree",
            "description": "Giant inflatable palm tree.  Measures 180cm tall.One of the most popular inflatable props, this large palm tree is a perfect decoration for Hawaiian themed parties and outdoor summer events.",
            "price": "12.97",
            "image": "http://images.productserve.com/preview/56/35049305.jpg"
        },
        {
            "id": "2",
            "name": "Inflatable Mace",
            "description": "Large inflatable Halloween mace  Measures 73cm.A great prop for Halloween or Roman fancy dress.",
            "price": "1",
            "image": "http://images.productserve.com/preview/56/35049308.jpg"
        },
        {
            "id": "3",
            "name": "Inflatable Beach Ball",
            "description": "Bright coloured inflatable beach ball.  Measures 121cm.Great to take the seaside this Inflatable Beach Ball will offer hours of fun. Colours may vary but fun will always be the same!",
            "price": "1.12",
            "image": "http://images.productserve.com/preview/56/35049309.jpg"
        },
        {
            "id": "4",
            "name": "Inflatable Guitar",
            "description": "Assorted coloured inflatable guitar.  Measures 106cm.Brightly coloured inflatable guitars for the wannabee rock stars. Colour of guitar may vary, we regret colour cannot be chosen. Price is for one inflatable only.",
            "price": "1.12",
            "image": "http://images.productserve.com/preview/56/35169263.jpg"
        }
    ];

	$scope.submitProfile = function(){
		ProfileService.post($scope.profile).success(function(data){
			var profile = data.profile;
			$scope.profile.id = data.user_id;
			$scope.products = data.products;
		});
		$scope.gotDetails = true;
	};

	$scope.rate = function(rating, product){
		product[rating] = true;
		//post a taste rating
		ProductService.postTaste({
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
		postTaste: function(taste){
			return $http.post('/rest/taste', taste);
		}
	};
});

app.config(function($httpProvider){
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
});