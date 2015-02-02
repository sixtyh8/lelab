(function() {
  'use strict';
  angular.module('leLabApp').service('Whitepapers', function(Restangular, $q) {
    var whitepapers;
    whitepapers = Restangular.all("whitepapers");
    return {
      list: function() {
        var deferred;
        deferred = $q.defer();
        whitepapers.getList().then((function(results) {
          return deferred.resolve(results);
        }), function(response) {
          console.log(response);
          return deferred.reject(response);
        });
        return deferred.promise;
      },
      get: function(id) {
        var deferred;
        deferred = $q.defer();
        Restangular.one('whitepapers', id).get().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      save: function(whitepaper) {
        var deferred;
        deferred = $q.defer();
        whitepapers.post({
          'data': whitepaper
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      update: function(obj) {
        var deferred, id;
        deferred = $q.defer();
        id = obj.id;
        Restangular.one('whitepapers', id).get().then(function(result) {
          result = obj;
          return result.put().then(function(data) {
            return deferred.resolve(data);
          });
        });
        return deferred.promise;
      },
      "delete": function(id) {
        var deferred;
        deferred = $q.defer();
        Restangular.one('whitepapers', id).remove().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      search: function(searchTerm) {
        var deferred;
        deferred = $q.defer();
        Restangular.one('whitepapers/search').get({
          'keyword': searchTerm
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      }
    };
  });

}).call(this);

//# sourceMappingURL=whitepapers.js.map
