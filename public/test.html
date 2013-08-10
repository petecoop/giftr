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
<body ng-controller="IndexController" class="backgrounds" ng-class="bgClass">
	<div class="container">
		<div class="col-6 col-offset-3">
			<div class="headline">
				<h1 class="logo">Giftr</h1>
				<p>Smart gift recommendations</p>
			</div>
			<form class="theform" ng-submit="submitProfile()">
				<div class="no-details clearfix" ng-hide="gotDetails">
					<div class="form-group clearfix">
						<label class="control-label col-2">Age</label>
						<div class="col-10">
							<input class="form-control" placeholder="e.g 23" ng-model="profile.age" type="text">
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
							<select ng-change="background()" class="form-control" ng-model="profile.occasion">
								<option value="">Occasion</option>
								<option value="birthday">Birthday</option>
								<option value="christmas">Christmas</option>
								<option value="wedding">Wedding</option>
								<option value="valentines">Valentines</option>
							</select>
						</div>
					</div>
					<br>
					<button type="submit" class="pull-right btn btn-primary">Get Suggested Gifts</button>
				</div>
				<div class="details clearfix" ng-show="gotDetails">
					<p class="pull-left">{{ profile.age }}, {{ profile.budget | currency:"£" }}, {{ profile.gender }}, {{ profile.occasion }}</p>
					<div ng-click="editDetails()" class="pull-right btn btn-primary btn-small">Edit Details</div>
				</div>
			</form>
			<div class="row">	
				<div class="col-6" ng-repeat="product in products">
					<div class="product">
						<img class="img-thumbnail col-4" ng-src="{{ product.image }}">
						<div class="col-8">
							<h3>{{ product.name }}</h2>
							<h4>{{ product.price | currency:"£"}}</h4>
						</div>
						<button class="btn btn-danger btn-small" ng-click="rate('dislike', product.id)">dislike</button>
						<button class="btn btn-success btn-small" ng-click="rate('like', product.id)">like</button>
						<button class="btn btn-primary btn-small" ng-click="rate('perfect', product.id)">perfect</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>