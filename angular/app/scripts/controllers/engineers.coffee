'use strict'

angular.module('leLabApp').controller 'EngineersCtrl', ($scope, Engineers, notify) ->

	$scope.newEngineer = {}

	$scope.engineersPromise = Engineers.list().then (data) ->
		$scope.engineers = data

	$scope.deleteEngineer = (id, index) ->
		Engineers.delete(id).then (data) ->
			$scope.engineers.splice(index, 1)
			notify('Engineer deleted!')

	$scope.saveEngineer = (data, engineer_id) ->
		Engineers.update(engineer_id, data).then (data) ->
			notify('Engineer saved!')
			return true

	$scope.addEngineer = ->
        if $scope.newEngineer.label?
            Engineers.add($scope.newEngineer.label).then (data) ->
                $scope.newEngineer.label = null
                # Add the tag to the scope
                $scope.engineers.push(data)
                notify('Engineer added!')
