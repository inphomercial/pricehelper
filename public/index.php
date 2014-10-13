<!DOCTYPE html>
<html lang="en" ng-app="PriceHelperApp">
<head>
    <title>Price Helper</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/main.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/paper/bootstrap.min.css" rel="stylesheet">

    <!-- JQuery CDN -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="navbar navbar-inverse">
	<div class="col-xs-8 col-xs-offset-1">
		<a class="navbar-brand" href="#">Search / Price / Sell</a>
	</div>
</div>

    <div class=="row">
	<!-- All of our Angular views go here /public/partials/* -->
	<div class="container" class="row">
	    <div class="col-xs-12">
	        <div ng-view></div>
	    </div>
        </div>
    </div>

    <!-- Source Venders -->
    <script type="text/javascript" src="frontend/js/vendors/angular.min.js"></script>
    <script type="text/javascript" src="frontend/js/vendors/angular-route.min.js"></script>

    <!-- Source PriceHelerApp -->
    <script type="text/javascript" src="frontend/js/apps/PriceHelper.js"></script>

    <!-- Source Services -->
    <!-- <script type="text/javascript" src="frontend/js/services/test.js"></script> -->

    <!-- Source Controllers -->
    <script type="text/javascript" src="frontend/js/controllers/search_controller.js"></script>

    <!-- Source Directives -->

    <!-- Source Routes -->
    <script type="text/javascript" src="frontend/js/routes/routes.js"></script>

</body>
</html>
