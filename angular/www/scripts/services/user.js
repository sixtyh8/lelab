(function() {
  'use strict';
  angular.module('leLabApp').service('User', function(Restangular, $q) {
    return {
      login: function(username, password) {
        var deferred;
        deferred = $q.defer();
        Restangular.all("auth").post({
          'username': username,
          'password': password
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      list: function() {
        var deferred;
        deferred = $q.defer();
        Restangular.all("users").getList().then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      create: function(user) {
        var deferred;
        deferred = $q.defer();
        Restangular.all("users").post({
          'data': user
        }).then(function(results) {
          return deferred.resolve(results);
        });
        return deferred.promise;
      },
      "delete": function(id) {
        var deferred, user;
        deferred = $q.defer();
        user = Restangular.one("users", id);
        user.remove().then(function(data) {
          return deferred.resolve(data);
        });
        return deferred.promise;
      },
      update: function(id, user) {
        var deferred, genre;
        deferred = $q.defer();
        genre = Restangular.one("users", id).get().then(function(result) {
          result.update = user;
          result.update.id = id;
          return result.put().then(function(data) {
            return deferred.resolve(data);
          });
        });
        return deferred.promise;
      },
      get: function(id) {
        var deferred;
        deferred = $q.defer();
        Restangular.one("users", id).get().then(function(user) {
          return deferred.resolve(user);
        });
        return deferred.promise;
      }
    };
  });

}).call(this);

//# sourceMappingURL=user.js.map
