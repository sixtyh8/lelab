(function() {
  'use strict';
  angular.module('leLabApp').service('Tags', function(Restangular, $q) {
    return {
      list: function() {
        var deferred;
        deferred = $q.defer();
        Restangular.one("tags").get().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      add: function(name) {
        var deferred;
        deferred = $q.defer();
        Restangular.all("tags").post({
          'data': name
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      update: function(id, name) {
        var deferred, tag;
        deferred = $q.defer();
        tag = Restangular.one("tags", id).get().then(function(results) {
          results[0].name = name;
          return results.put().then(function(data) {
            return deferred.resolve(data);
          });
        });
        return deferred.promise;
      },
      "delete": function(id) {
        var deferred, tag;
        deferred = $q.defer();
        tag = Restangular.one("tags", id);
        return tag.remove().then(function(data) {
          return deferred.resolve(data);
        });
      }
    };
  });

}).call(this);

//# sourceMappingURL=tags.js.map
