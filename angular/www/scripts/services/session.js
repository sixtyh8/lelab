(function() {
  'use strict';
  angular.module('leLabApp').service('Session', function($q, webStorage) {
    return {
      logged: function() {
        return !!webStorage.session.get('authenticated');
      },
      isAdmin: function() {
        return !!webStorage.session.get('admin');
      },
      create: function(user) {
        var deferred;
        deferred = $q.defer();
        $q.all([webStorage.session.add('authenticated', true), webStorage.session.add('username', user.username), webStorage.session.add('userId', user.userId), webStorage.session.add('email', user.email), webStorage.session.add('admin', user.admin)]).then(function() {
          deferred.resolve();
        });
        return deferred.promise;
      },
      remove: function() {
        return webStorage.session.clear();
      },
      info: function() {
        return {
          authenticated: webStorage.session.get("authenticated"),
          username: webStorage.session.get("username"),
          userId: webStorage.session.get("userId"),
          email: webStorage.session.get("email"),
          admin: webStorage.session.get("admin")
        };
      }
    };
  });

}).call(this);

//# sourceMappingURL=session.js.map
