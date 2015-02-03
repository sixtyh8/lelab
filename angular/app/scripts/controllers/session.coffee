'use strict'

angular.module('leLabApp').controller 'SessionCtrl', ($scope, $state, User, Session) ->

    $scope.login = ->

        User.login($scope.email, $scope.password).then (data) ->
            if data.status == 200
                console.log data
                Session.create(data.user).then (data) ->
                    $state.go "index"
            else
                console.log "Login Failed"