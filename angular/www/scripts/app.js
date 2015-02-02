(function() {
  'use strict';
  angular.module('leLabApp', ['ngCookies', 'ngResource', 'ngSanitize', 'ngRoute', 'restangular', 'ui.router', 'cgBusy', 'xeditable', 'confirmClick', 'pasvaz.bindonce', 'ui.bootstrap', 'webStorageModule', 'angular-data.DSCacheFactory', 'infinite-scroll', 'textAngular', 'angularFileUpload', 'bootstrap-tagsinput', 'cgNotify', 'ngDialog']).run(function($rootScope, $state, editableOptions, $filter, Session) {
    var routeAdmin, routeClean, routesThatDontRequireAuth, routesThatRequireAdmin;
    $rootScope.$state = $state;
    routesThatDontRequireAuth = ['/login'];
    routesThatRequireAdmin = ['/users'];
    routeClean = function(route) {
      var filtered;
      filtered = $filter("isInArray")(routesThatDontRequireAuth, route);
      return filtered;
    };
    routeAdmin = function(route) {
      var filtered;
      filtered = $filter("isInArray")(routesThatRequireAdmin, route);
      return filtered;
    };
    $rootScope.$on("$stateChangeStart", function(event, toState, toParams, fromState, fromParams) {
      if (routeAdmin(toState.url) && !Session.isAdmin()) {
        event.preventDefault();
        $state.go("index");
      }
      if (!routeClean(toState.url) && !Session.logged()) {
        event.preventDefault();
        return $state.go("login");
      }
    });
    return editableOptions.theme = 'bs3';
  }).value('cgBusyDefaults', {
    templateUrl: 'views/directives/loading.html'
  });

}).call(this);

//# sourceMappingURL=app.js.map
