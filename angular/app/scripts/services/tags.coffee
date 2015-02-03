'use strict'

angular.module('leLabApp').service 'Tags', (Restangular, $q) ->

    list: ->
        deferred = $q.defer()

        Restangular.one("tags").get().then (results) ->
            deferred.resolve results

        deferred.promise

    add: (name) ->
        deferred = $q.defer()

        Restangular.all("tags").post({ 'data': name }).then (results) ->
            deferred.resolve results

        deferred.promise

    update: (id, name) ->
        deferred = $q.defer()

        tag = Restangular.one("tags", id).get().then (results) ->
            results[0].name = name
            results.put().then (data) ->
                deferred.resolve data

        deferred.promise

    delete: (id) ->
        deferred = $q.defer()

        tag = Restangular.one("tags", id)
        tag.remove().then (data) ->
            deferred.resolve data
