'use strict'

angular.module('leLabApp').controller 'TrophiesCtrl', ($scope, Trophies, notify) ->

    # Set an empty trophy
    setTrophy = ->
        $scope.newTrophy =
            trophy_name: ''
            trophy_type: ''
            trophy_description: ''

    # List trophies
    $scope.trophiesPromise = Trophies.list().then (data) ->
        $scope.trophies = data

    # Add a trophy
    $scope.addTrophy = ->
        Trophies.add($scope.newTrophy).then (data) ->
            $scope.trophies.push(angular.copy($scope.newTrophy))
            setTrophy()
            notify('Trophy added!')

    # Delete a trophy
    $scope.deleteTrophy = (trophyId, index) ->
        Trophies.delete(trophyId).then (data) ->
            $scope.trophies.splice(index, 1)
            notify('Trophy deleted!')

    # Save a trophy
    $scope.saveTrophy = (data, id) -> 
        console.log data
        console.log id 
        Trophies.update(id, data).then (response) ->
            notify('Trophy updated!')
            return true

    # Init
    setTrophy()
