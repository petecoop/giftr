<!doctype html>
<html ng-app="giftr" lang="en">
<head>
	<meta charset="UTF-8">
	<title>Giftr</title>
	<link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.css">
	<script src="comoponents/angular/angular.min.js"></script>
	<script src="js/app.js"></script>
</head>
<body ng-controller="IndexController">
	<form ng-submit="submitProfile()">
		Age:<input ng-model="profile.age" type="text">
		gender:<input ng-model="profile.gender" type="text">
		occasion:<input ng-model="profile.occasion" type="text">
		budget:<input ng-model="profile.budget" type="text">
		<button ng-click="submitProfile()">GIFT ME BITCH</button>
	</form>
	<ul>
		<li ng-repeat="product in products">
			<h2>{{ product.name }}</h2>
			<p>{{ product.price }}</p>
			<button ng-click="rate('dislike', product.id)">dislike</button>
			<button ng-click="rate('like', product.id)">like</button>
			<button ng-click="rate('perfect', product.id)">perfect</button>
		</li>
	</ul>
</body>
</html>