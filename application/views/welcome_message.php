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
				<div class="form-group clearfix">
					<label class="control-label col-2">Age</label>
					<div class="col-10">
						<input class="form-control" placeholder="e.g 25.00" ng-model="profile.age" type="text">
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="control-label col-2">Budget</label>
					<div class="col-10">
						<input class="form-control" placeholder="e.g 25.00" ng-model="profile.budget" type="text">
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<select class="form-control" ng-model="profile.gender">
							<option value="">Gender</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<div class="col-6">
						<select class="form-control" ng-model="profile.occasion">
							<option value="">Occasion</option>
							<option value="birthday">Birthday</option>
							<option value="wedding">Wedding</option>
							<option value="anniversary">Anniversary</option>
							<option value=""></option>
							<option value=""></option>
						</select>
					</div>
				</div>
				<br>
				<button type="submit" class="btn btn-primary">Get Suggested Gifts</button>
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