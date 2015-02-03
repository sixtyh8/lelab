'use strict'

angular.module('leLabApp').service 'Engineers', (Restangular, $q) ->

    list: ->
        deferred = $q.defer()

        Restangular.one("engineers").get().then (results) ->
            deferred.resolve results

        deferred.promise

    add: (name) ->
        deferred = $q.defer()

        Restangular.all("engineers").post(name).then (results) ->
            deferred.resolve results

        deferred.promise

    update: (id, name) ->
        deferred = $q.defer()

        engi = Restangular.one("engineers", id).get().then (result) ->
            result[0].name = name
            result.put().then (data) ->
                deferred.resolve data

        deferred.promise

    delete: (id) ->
        deferred = $q.defer()

        engi = Restangular.one("engineers", id)
        engi.remove().then (data) ->
            deferred.resolve data
