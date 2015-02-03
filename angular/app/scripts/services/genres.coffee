'use strict'

angular.module('leLabApp').service 'Genres', (Restangular, $q) ->

    list: ->
    	deferred = $q.defer()

    	Restangular.all("genres").getList().then (results) ->
    		deferred.resolve results

    	deferred.promise

    add: (name) ->
        deferred = $q.defer()

        Restangular.all("genres").post(name).then (results) ->
            deferred.resolve results

        deferred.promise

    update: (id, name) ->
        deferred = $q.defer()

        genre = Restangular.one("genres", id).get().then (result) ->
            result[0].name = name
            result.put().then (data) ->
                deferred.resolve data

        deferred.promise

    delete: (id) ->
        deferred = $q.defer()

        genre = Restangular.one("genres", id)
        genre.remove().then (data) ->
            deferred.resolve data

    search: (term) ->
        deferred = $q.defer()

        Restangular.all("genres").get("search", {"keyword": term}).then (results) ->
            deferred.resolve results

        deferred.promise
