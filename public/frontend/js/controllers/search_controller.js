
PriceHelperApp.controller('SearchController', function ($scope, $http) {

	$scope.city = "",
	$scope.keyword = "",
	$scope.searched = false,

	$scope.listings = [],
	$scope.selected_listings = [],

	$scope.lowest = 0,
	$scope.highest = 0,
	$scope.average = 0,

	$scope.performSearch = function() {
      		$http.get('api/index.php/search/' + $scope.city + '/' + $scope.keyword).success(function(data) {
			$scope.listings = data;
			for(var i = 0; i < $scope.listings.length; i++) {
				$scope.listings[i].selected = false;
				$scope.buildUrl($scope.listings[i]);
			}
			$scope.searched = true;
		});
	},

	$scope.getTotal = function() {
		if($scope.selected_listings.length > 0) {
			return $scope.selected_listings.length;
		}
		else
		{
			return 0;
		}
	},

	$scope.removeFromSelected = function(listing) {
		listing.selected = false;
		for(var i = 0; i < $scope.listings.length; i++) {
			if(listing.link == $scope.listings[i].link) {
				$scope.selected_listings.splice($scope.listings[i], 1);
			}
		}
		
		$scope.getHighest();
		$scope.getAverage();
		$scope.getLowest();
	},

	$scope.buildUrl = function(listing) {
		var url = "";
		var s = listing.link;
		console.log(s);

		var contains = s.indexOf("http");
		console.log(contains);
		if(contains === 0) {
			listing.url = listing.link;
		}
		else
		{
			listing.url = "http://"+$scope.city+".craigslist.com"+listing.link;
		}
		
		return listing;
	},

	$scope.addToSelected = function(listing) {
		
		listing.selected = true;
		$scope.selected_listings.push(listing);
		
		$scope.getHighest();
		$scope.getAverage();
		$scope.getLowest();
	},

	$scope.getHighest = function() {
		if($scope.selected_listings.length > 0) {
			for(var i = 0; i < $scope.selected_listings.length; i++) {
				if($scope.highest < $scope.selected_listings[i].price) {
					$scope.highest = $scope.selected_listings[i].price;
				}
			}
		}
		else {
			$scope.highest = 0;
		}
	},

	$scope.getAverage = function() {
		var prices = [];
		if($scope.selected_listings.length > 0) {
			for(var i = 0; i < $scope.selected_listings.length; i++) {
				prices.push($scope.selected_listings[i].price);
			}

			var total = prices.reduce(function(a, b) {
				  return parseInt(a) + parseInt(b);
			});
			console.log(total);

			// Calculate Average
			$scope.average = total / prices.length;
			$scope.average.toFixed(2);
		}
		else {
			$scope.average = 0;
		}
	},

	$scope.getLowest = function() {
		if($scope.selected_listings.length > 0) {
			for(var i = 0; i < $scope.selected_listings.length; i++) {
				if($scope.lowest == 0 || $scope.lowest > $scope.selected_listings[i].price) {
					$scope.lowest = $scope.selected_listings[i].price;
				}
			}
		}
		else {
			$scope.lowest = 0;
		}
	}
});
