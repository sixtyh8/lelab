'use strict'

angular.module('leLabApp').config ($routeProvider, RestangularProvider, $locationProvider, $stateProvider, $urlRouterProvider) ->

    #$locationProvider.html5Mode(true)

    RestangularProvider.setBaseUrl('http://api.lelab.local/')
    # RestangularProvider.setBaseUrl('http://api.lelabmastering.com/')
    # RestangularProvider.setRestangularFields({ id: "_id" })

angular.module('leLabApp').constant 'APP_CONFIG',
    ENV: 'DEV'
    DEV:
        CDN_URL: 'http://cdn.lelab.local'
    PROD:
        CDN_URL: 'http://lelabmastering.com/cdn'

