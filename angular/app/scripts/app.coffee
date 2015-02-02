'use strict'

angular.module('leLabApp', [
  'ngCookies',
  'ngResource',
  'ngSanitize',
  'ngRoute',
  'restangular',
  'ui.router',
  'cgBusy',
  'xeditable',
  'confirmClick',
  'pasvaz.bindonce',
  'ui.bootstrap',
  'webStorageModule',
  'angular-data.DSCacheFactory',
  'infinite-scroll',
  'textAngular',
  'angularFileUpload',
  'bootstrap-tagsinput',
  'cgNotify',
  'ngDialog'
])

  .run ($rootScope, $state, editableOptions, $filter, Session) ->
    # Assign current state to rootScope to make it available for the menu highlight
    $rootScope.$state = $state

    # enumerate routes that don't need authentication
    routesThatDontRequireAuth = ['/login']
    # enumerate routes that require admin
    routesThatRequireAdmin = ['/users']

    # check if requested route matches authenticated routes
    routeClean = (route) ->
        filtered = $filter("isInArray")(routesThatDontRequireAuth, route)
        filtered

    # check if requested route matches admin routes
    routeAdmin = (route) ->
        filtered = $filter("isInArray")(routesThatRequireAdmin, route)
        filtered

    # Check if a user is trying to access a route without being authenticated
    $rootScope.$on "$stateChangeStart", (event, toState, toParams, fromState, fromParams) ->

        # if route requires admin
        if routeAdmin(toState.url) and not Session.isAdmin()
            # stop the transition
            event.preventDefault()
            # redirect back to index
            $state.go "index"

        # if route requires auth and user is not logged in
        if not routeClean(toState.url) and not Session.logged()
            # stop the transition
            event.preventDefault()
            # redirect back to login
            $state.go "login"

    # xEditable Theme
    # set to bootstrap3 theme. Can be also 'bs2', 'default'
    editableOptions.theme = 'bs3';

  .value 'cgBusyDefaults',
    templateUrl: 'views/directives/loading.html'
