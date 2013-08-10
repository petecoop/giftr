<!doctype html>
<html ng-app="giftr" lang="en">
<head>
	<meta charset="UTF-8">
	<title>Giftr</title>
	<link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="components/angular/angular.min.js"></script>
	<script src="js/app.js"></script>
</head>
<body ng-controller="IndexController">
	<div class="container">
		<div class="col-6 col-offset-3">
			<div class="headline">
				<h1 class="logo">Giftr</h1>
				<p>Smart gift recommendations</p>
			</div>
			<form class="stuffhere" ng-submit="submitProfile()">
				<input class="form-control" ng-model="profile.age" placeholder="Age" type="text">
				<select ng-model="profile.gender">
					<option value="">Select Gender</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
				<select ng-model="profile.occasion">
					<option value="">Select Occasion</option>
					<option value="birthday">Birthday</option>
					<option value="Wedding">Wedding</option>
					<option value="anniversary">Anniversary</option>
					<option value=""></option>
					<option value=""></option>
				</select>
				<input class="form-control" placeholder="Budget" ng-model="profile.budget" type="text">
				<button type="submit" class="btn btn-default">Get Suggested Gifts</button>
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
		</div>
	</div>
</body>
</html>