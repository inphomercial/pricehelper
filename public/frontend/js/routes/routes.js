PriceHelperApp.config(['$routeProvider', function($routeProvider)
{
	$routeProvider
	      .when('/', {
	          templateUrl: 'frontend/partials/search.html'
		})
	     .otherwise({
	          templateUrl: 'frontend/partials/search.html'
	     });
}]);
