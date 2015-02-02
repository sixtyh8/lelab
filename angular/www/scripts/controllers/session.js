(function() {
  'use strict';
  angular.module('leLabApp').controller('SessionCtrl', function($scope, $state, User, Session) {
    return $scope.login = function() {
      return User.login($scope.email, $scope.password).then(function(data) {
        if (data.status === 200) {
          console.log(data);
          return Session.create(data.user).then(function(data) {
            return $state.go("index");
          });
        } else {
          return console.log("Login Failed");
        }
      });
    };
  });

}).call(this);

//# sourceMappingURL=session.js.map
