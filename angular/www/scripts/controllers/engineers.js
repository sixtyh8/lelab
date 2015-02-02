(function() {
  'use strict';
  angular.module('leLabApp').controller('EngineersCtrl', function($scope, Engineers, notify) {
    $scope.engineersPromise = Engineers.list().then(function(data) {
      return $scope.engineers = data;
    });
    $scope.deleteEngineer = function(id, index) {
      return Engineers["delete"](id).then(function(data) {
        notify('Engineer deleted!');
        return $scope.engineers.splice(index, 1);
      });
    };
    return $scope.saveEngineer = function(data, engineer_id) {
      return Engineers.update(engineer_id, data).then(function(data) {
        notify('Engineer saved!');
        return true;
      });
    };
  });

}).call(this);

//# sourceMappingURL=engineers.js.map
