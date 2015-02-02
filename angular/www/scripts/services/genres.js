(function() {
  'use strict';
  angular.module('leLabApp').service('Genres', function(Restangular, $q) {
    return {
      list: function() {
        var deferred;
        deferred = $q.defer();
        Restangular.all("genres").getList().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      add: function(name) {
        var deferred;
        deferred = $q.defer();
        Restangular.all("genres").post(name).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      update: function(id, name) {
        var deferred, genre;
        deferred = $q.defer();
        genre = Restangular.one("genres", id).get().then(function(result) {
          result[0].name = name;
          return result.put().then(function(data) {
            return deferred.resolve(data);
          });
        });
        return deferred.promise;
      },
      "delete": function(id) {
        var deferred, genre;
        deferred = $q.defer();
        genre = Restangular.one("genres", id);
        return genre.remove().then(function(data) {
          return deferred.resolve(data);
        });
      },
      search: function(term) {
        var deferred;
        deferred = $q.defer();
        Restangular.all("genres").get("search", {
          "keyword": term
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      }
    };
  });

}).call(this);

//# sourceMappingURL=genres.js.map
