'use strict'

angular.module('leLabApp').controller 'MainCtrl', ($scope, $state, Session, APP_CONFIG, $rootScope) ->

    # Configuration
    $scope.environment = APP_CONFIG.ENV
    $scope.cdnUrl = APP_CONFIG[$scope.environment].CDN_URL
    $rootScope.cdnUrl = APP_CONFIG[$scope.environment].CDN_URL

    # User information
    $scope.user = Session.info()

    # Logout
    $scope.logout = ->
        Session.remove()
        $state.go "login"