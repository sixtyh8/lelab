(function() {
  'use strict';
  angular.module('leLabApp').service('Credits', function(Restangular, $q, DSCacheFactory) {
    var credits;
    credits = Restangular.all('credits');
    return {
      list: function(limit, offset) {
        var deferred;
        deferred = $q.defer();
        Restangular.one('credits').get({
          'limit': limit,
          'offset': offset
        }).then((function(results) {
          return deferred.resolve(results);
        }), function(response) {
          return deferred.reject(response);
        });
        return deferred.promise;
      },
      get: function(id) {
        var deferred;
        deferred = $q.defer();
        Restangular.one('credits', id).get().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      search: function(searchTerm) {
        var deferred;
        deferred = $q.defer();
        Restangular.one('credits/search').get({
          'keyword': searchTerm
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      save: function(credit) {
        var deferred;
        deferred = $q.defer();
        credit.genre = credit.genreName[0].name;
        credits.post({
          'data': credit
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      update: function(obj) {
        var credit, deferred, id;
        deferred = $q.defer();
        id = obj.id;
        if (obj.genreName[0].name) {
          obj.genre = obj.genreName[0].name;
        } else {
          obj.genre = obj.genreName[0];
        }
        console.log("Update:");
        console.log(obj);
        credit = Restangular.one('credits', id).get().then(function(result) {
          result = obj;
          return result.put().then(function(results) {
            return deferred.resolve(results);
          });
        });
        return deferred.promise;
      },
      "delete": function(id) {
        var deferred;
        deferred = $q.defer();
        Restangular.one('credits', id).remove().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      saveImage: function() {
        var deferred;
        return deferred = $q.defer();
      }
    };
  });

}).call(this);

//# sourceMappingURL=credits.js.map
