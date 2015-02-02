(function() {
  'use strict';
  angular.module('leLabApp').service('Engineers', function(Restangular, $q) {
    return {
      list: function() {
        var deferred;
        deferred = $q.defer();
        Restangular.one("engineers").get().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      add: function(name) {
        var deferred;
        deferred = $q.defer();
        Restangular.all("engineers").post(name).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      update: function(id, name) {
        var deferred, engi;
        deferred = $q.defer();
        engi = Restangular.one("engineers", id).get().then(function(result) {
          result[0].name = name;
          return result.put().then(function(data) {
            return deferred.resolve(data);
          });
        });
        return deferred.promise;
      },
      "delete": function(id) {
        var deferred, engi;
        deferred = $q.defer();
        engi = Restangular.one("engineers", id);
        return engi.remove().then(function(data) {
          return deferred.resolve(data);
        });
      }
    };
  });

}).call(this);

//# sourceMappingURL=engineers.js.map
