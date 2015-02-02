(function() {
  'use strict';
  angular.module('leLabApp').controller('CreditsCtrl', function($scope) {
    return $scope.currentYear = new Date().getFullYear();
  });

  angular.module('leLabApp').controller('CreditsCtrl.List', function($scope, $state, $filter, $timeout, Credits, ngDialog, notify) {
    $scope.limit = 25;
    $scope.offset = 0;
    $scope.loader = {
      busy: false
    };
    $scope.getCredits = function() {
      $scope.loader.busy = true;
      return Credits.list($scope.limit, $scope.offset).then(function(data) {
        var credit, _i, _len;
        if (data.length) {
          if ($scope.creditsList != null) {
            for (_i = 0, _len = data.length; _i < _len; _i++) {
              credit = data[_i];
              $scope.creditsList.push(credit);
            }
          } else {
            $scope.creditsList = data;
          }
          $scope.offset = $scope.offset + $scope.limit;
          return $scope.loader.busy = false;
        } else {

        }
      });
    };
    $scope.searchCredits = function() {
      return $scope.creditsPromise = Credits.search($scope.searchTerm).then(function(data) {
        return $scope.creditsList = data;
      });
    };
    $scope.deleteCredit = function(idx) {
      $scope.creditToDeleteIndex = idx;
      $scope.creditToDelete = $scope.creditsList[idx];
      return ngDialog.open({
        template: 'views/partials/confirm.html',
        scope: $scope
      });
    };
    return $scope.doDelete = function() {
      return Credits["delete"]($scope.creditToDelete.id).then(function(data) {
        $scope.creditsList.splice($scope.creditToDeleteIndex, 1);
        notify('Credit deleted!');
        return ngDialog.closeAll();
      });
    };
  });

  angular.module('leLabApp').controller('CreditsCtrl.Edit', function($scope, $state, $stateParams, Credits, Engineers, Genres, notify) {
    Credits.get($stateParams.creditId).then(function(data) {
      var credit;
      credit = data;
      if (data.genre.length && (data.genreName != null)) {
        $scope.selectedGenre = data.genreName[0];
        return $scope.credit = credit;
      } else {
        $scope.credit = {
          genreName: [
            {
              name: "",
              id: ""
            }
          ]
        };
        return $scope.credit = _.extend($scope.credit, credit);
      }
    });
    return $scope.saveCredit = function() {
      return Credits.update($scope.credit).then(function(data) {
        notify('Credit updated!');
        return $state.go('credits');
      });
    };
  });

  angular.module('leLabApp').controller('CreditsCtrl.New', function($scope, $state, Credits, Engineers, Genres, Images, notify) {
    $scope.credit = {
      genreName: [
        {
          name: ""
        }
      ],
      year: $scope.currentYear,
      engineer_id: "1",
      credit: "Mastering",
      homepage_flag: 1
    };
    return $scope.saveCredit = function() {
      return Credits.save($scope.credit).then(function(data) {
        notify('Credit saved!');
        return $state.go('credits');
      });
    };
  });

}).call(this);

//# sourceMappingURL=credits.js.map
