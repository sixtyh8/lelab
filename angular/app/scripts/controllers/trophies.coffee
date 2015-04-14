'use strict'

angular.module('leLabApp').controller 'UsersCtrl', ($scope, Trophies, notify) ->

    # Set an empty trophy
    setTrophy = ->
        $scope.newTrophy =
            name: ''
            type: ''
            desciption: ''

    # List trophies
    $scope.trophiesPromise = Trophies.list().then (data) ->
        $scope.trophies = data

    # Add a trophy
    $scope.addTrophy = ->
        Trophies.add($scope.newTrophy).then (data) ->
            $scope.trophies.push(data)
            setTrophy()
            notify('Trophy added!')

    # Delete a trophy
    $scope.deleteTrophy = (trophyId, index) ->
        Trophies.delete(trophyId).then (data) ->
            $scope.trophies.splice(index, 1)
            notify('Trophy deleted!')

    # Save a trophy
    $scope.saveTrophy = (data, id) ->  
        Trophies.update(id, data).then (data) ->
            notify('Trophy updated!')
            return true

    # Init
    setTrophy()
