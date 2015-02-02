(function() {
  'use strict';
  angular.module('leLabApp').controller('HeaderCtrl', function($scope, Session) {
    $scope.user = Session.info();
    $scope.authenticated = $scope.user.authenticated;
    return $scope.admin = $scope.user.admin;
  });

}).call(this);

//# sourceMappingURL=header.js.map
