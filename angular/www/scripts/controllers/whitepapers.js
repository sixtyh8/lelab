(function() {
  'use strict';
  angular.module('leLabApp').controller('WhitepapersCtrl', function($scope, $filter) {});

  angular.module('leLabApp').controller('WhitepapersCtrl.List', function($scope, $state, Whitepapers, notify) {
    $scope.whitepapersPromise = Whitepapers.list().then(function(data) {
      return $scope.whitepapers = {
        list: data,
        config: {
          itemsPerPage: 10,
          fillLastPage: true
        }
      };
    });
    $scope.searchWhitepapers = function() {
      return $scope.whitepapersPromise = Whitepapers.search($scope.searchTerm).then(function(data) {
        return $scope.whitepapers.list = data;
      });
    };
    return $scope.deleteWhitepaper = function(whitepaperID, index) {
      return Whitepapers["delete"](whitepaperID).then(function(data) {
        $scope.whitepapers.list.splice(index, 1);
        return notify('Whitepaper deleted!');
      });
    };
  });

  angular.module('leLabApp').controller('WhitepapersCtrl.Edit', function($scope, $state, $stateParams, $filter, Whitepapers, notify) {
    Whitepapers.get($stateParams.whitepaperId).then(function(data) {
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
    return $scope.saveWhitepaper = function() {
      var newDate;
      newDate = new Date();
      $scope.now = $filter('date')(newDate, 'short');
      $scope.whitepaper.updated_at = $scope.now;
      return Whitepapers.update($scope.whitepaper).then(function(data) {
        notify('Whitepaper updated!');
        return $state.go('whitepapers');
      });
    };
  });

  angular.module('leLabApp').controller('WhitepapersCtrl.New', function($scope, $state, $filter, Whitepapers, notify) {
    $scope.whitepaper = {
      created_at: null,
      tags: []
    };
    return $scope.saveWhitepaper = function() {
      var newDate;
      newDate = new Date();
      $scope.now = $filter('date')(newDate, 'short');
      $scope.whitepaper.created_at = $scope.now;
      return Whitepapers.save($scope.whitepaper).then(function(data) {
        notify('Whitepaper saved!');
        return $state.go('whitepapers');
      });
    };
  });

}).call(this);

//# sourceMappingURL=whitepapers.js.map
