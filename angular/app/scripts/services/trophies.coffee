'use strict'

angular.module('leLabApp').service 'Trophies', (Restangular, $q) ->

    list: ->
        deferred = $q.defer()

        Restangular.all("trophies").getList().then (results) ->
            deferred.resolve results

        deferred.promise

    add: (data) ->
        deferred = $q.defer()

        Restangular.all("trophies").post({ 'data': data, 'id': null, 'action': 'POST' }).then (results) ->
            deferred.resolve results

        deferred.promise

    update: (id, data) ->
        deferred = $q.defer()

        Restangular.all("trophies").post({ 'data': data, 'id': id, 'action': 'PUT' }).then (results) ->
            deferred.resolve results

        deferred.promise

    delete: (id) ->
        deferred = $q.defer()

        Restangular.all("trophies").post({ 'data': null, 'id': id, 'action': 'DELETE' }).then (results) ->
            deferred.resolve results

        deferred.promise
