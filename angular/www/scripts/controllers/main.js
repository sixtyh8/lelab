(function() {
  'use strict';
  angular.module('leLabApp').controller('MainCtrl', function($scope, $state, Session, APP_CONFIG, $rootScope) {
    $scope.environment = APP_CONFIG.ENV;
    $scope.cdnUrl = APP_CONFIG[$scope.environment].CDN_URL;
    $rootScope.cdnUrl = APP_CONFIG[$scope.environment].CDN_URL;
    $scope.user = Session.info();
    return $scope.logout = function() {
      Session.remove();
      return $state.go("login");
    };
  });

}).call(this);

//# sourceMappingURL=main.js.map
