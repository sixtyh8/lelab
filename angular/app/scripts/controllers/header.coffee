'use strict'

angular.module('leLabApp').controller 'HeaderCtrl', ($scope, Session) ->

    $scope.user = Session.info()

    $scope.authenticated = $scope.user.authenticated
    $scope.admin = $scope.user.admin