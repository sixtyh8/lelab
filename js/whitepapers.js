angular.module('leLabApp').config(function($urlRouterProvider, $stateProvider) {
	$urlRouterProvider.otherwise("/index");
	$urlRouterProvider.when("/", "/index");

	$stateProvider.state("index", {
      url: "/index",
      views: {
        main: {
          templateUrl: "/views/index.html"
        }
      }
    }).state("whitepaper", {
    	url: "/detail/:whitepaperId",
    	views: {
    		main: {
    			templateUrl: "/views/detail.html"
    		}
    	}
    });
});

angular.module('leLabApp').controller('WhitepapersCtrl', function($scope, Whitepapers, Tags){

    $scope.whitepapersPromise = Whitepapers.list().then(function(data) {
      $scope.whitepapers = data;
    });

    $scope.tagsPromise = Tags.list().then(function(data) {
      $scope.tags = data;
    });

});

angular.module('leLabApp').controller('WhitepapersCtrl.Detail', function($scope, $stateParams, Whitepapers){

	Whitepapers.get($stateParams.whitepaperId).then(function(data){
		var tag, _i, _len, _ref, _results;
		
		$scope.whitepaper = data;
		$scope.whitepaper.tags = [];
		
		_ref = data.tagsList;
		_results = [];
		
		for (_i = 0, _len = _ref.length; _i < _len; _i++) {
			tag = _ref[_i];
			_results.push($scope.whitepaper.tags.push(tag[0].name));
		}
		
		return _results;
	});

})
