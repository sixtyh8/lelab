'use strict'

angular.module('leLabApp').controller 'UsersCtrl', ($scope, $filter, Trophy, Session, notify) ->

    setTrophy = ->
        $scope.newTrophy =
            name: ''
            type: ''
            desciption: ''

    $scope.trophiesPromise = Trophy.list().then (data) ->
        $scope.trophies = data

    $scope.addTrophy = ->
        Trophy.create($scope.newTrophy).then (data) ->
            $scope.trophies.push(data)
            setTrophy()
            notify('Trophy added!')


    # Delete a credit
    $scope.deleteTrophy = (trophyId, index) ->
        Trophy.delete(trophyId).then (data) ->
            $scope.trophies.splice(index, 1)
            notify('Trophy deleted!')

    $scope.saveTrophy = (data, id) ->
                
        Trophy.update(id, data).then (data) ->
            notify('Trophy updated!')
            return true

    setTrophy()
