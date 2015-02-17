'use strict'

angular.module('leLabApp').service 'Engineers', (Restangular, $q) ->

    list: ->
        deferred = $q.defer()

        Restangular.one("engineers").get().then (results) ->
            deferred.resolve results

        deferred.promise

    add: (name) ->
        deferred = $q.defer()

        Restangular.all("engineers").post({ 'data': name, 'id': null, 'action': 'POST' }).then (results) ->
            deferred.resolve results

        deferred.promise

    update: (id, name) ->
        deferred = $q.defer()

        Restangular.all("engineers").post({ 'data': name, 'id': id, 'action': 'PUT' }).then (results) ->
            deferred.resolve results

        deferred.promise

    delete: (id) ->
        deferred = $q.defer()

        Restangular.all("engineers").post({ 'data': null, 'id': id, 'action': 'DELETE' }).then (results) ->
            deferred.resolve results

        deferred.promise
