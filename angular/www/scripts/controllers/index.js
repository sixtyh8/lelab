(function() {
  'use strict';
  angular.module('leLabApp').controller('IndexCtrl', function($scope, Dashboard) {
    return Dashboard.get().then(function(data) {
      return $scope.data = data;
    });
  });

}).call(this);

//# sourceMappingURL=index.js.map
