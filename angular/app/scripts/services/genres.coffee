'use strict'

angular.module('leLabApp').service 'Genres', (Restangular, $q) ->

    list: ->
    	deferred = $q.defer()

    	Restangular.all("genres").getList().then (results) ->
    		deferred.resolve results

    	deferred.promise


    add: (name) ->
        deferred = $q.defer()

        Restangular.all("genres").post({ 'data': name, 'id': null, 'action': 'POST' }).then (results) ->
            deferred.resolve results

        deferred.promise


    update: (id, name) ->
        deferred = $q.defer()

        Restangular.all("genres").post({ 'data': name, 'id': id, 'action': 'PUT' }).then (results) ->
            deferred.resolve results

        deferred.promise


    delete: (id) ->
        deferred = $q.defer()

        Restangular.all("genres").post({ 'data': null, 'id': id, 'action': 'DELETE' }).then (results) ->
            deferred.resolve results

        deferred.promise


    search: (term) ->
        deferred = $q.defer()

        Restangular.all("genres").get("search", {"keyword": term}).then (results) ->
            deferred.resolve results

        deferred.promise
