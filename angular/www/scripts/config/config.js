(function() {
  'use strict';
  angular.module('leLabApp').config(function($routeProvider, RestangularProvider, $locationProvider, $stateProvider, $urlRouterProvider) {
    RestangularProvider.setBaseUrl('http://api.lelab.local/');
    return RestangularProvider.setRestangularFields({
      id: "_id"
    });
  });

  angular.module('leLabApp').constant('APP_CONFIG', {
    ENV: 'DEV',
    DEV: {
      CDN_URL: 'http://cdn.lelab.local'
    },
    PROD: {
      CDN_URL: 'http://lelabmastering.com/cdn'
    }
  });

}).call(this);

//# sourceMappingURL=config.js.map
