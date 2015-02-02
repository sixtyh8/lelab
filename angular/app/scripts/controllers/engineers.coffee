'use strict'

angular.module('leLabApp').controller 'EngineersCtrl', ($scope, Engineers, notify) ->

	$scope.engineersPromise = Engineers.list().then (data) ->
		$scope.engineers = data

	$scope.deleteEngineer = (id, index) ->
		Engineers.delete(id).then (data) ->
			notify('Engineer deleted!')
			$scope.engineers.splice(index, 1)

	$scope.saveEngineer = (data, engineer_id) ->
		Engineers.update(engineer_id, data).then (data) ->
			notify('Engineer saved!')
			return true
