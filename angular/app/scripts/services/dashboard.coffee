'use strict'

angular.module('leLabApp').service 'Dashboard', (Restangular, $q) ->

	get: ->
		deferred = $q.defer()

		Restangular.one('dashboard').get().then (data) ->
			deferred.resolve data

		deferred.promise