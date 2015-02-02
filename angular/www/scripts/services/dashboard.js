(function() {
  'use strict';
  angular.module('leLabApp').service('Dashboard', function(Restangular, $q) {
    return {
      get: function() {
        var deferred;
        deferred = $q.defer();
        Restangular.one('dashboard').get().then(function(data) {
          return deferred.resolve(data);
        });
        return deferred.promise;
      }
    };
  });

}).call(this);

//# sourceMappingURL=dashboard.js.map
